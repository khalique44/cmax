<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Property;
use App\Http\Helpers\GeneralHelper;
use App\Amenity;
use App\Category;
use App\Builder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index');
    }

    public function getProjects(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::getAllProjects();

            return DataTables::of($projects)
                ->addColumn('action', function ($project) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/projects/$project->id/edit").'" >
                                            Edit
                                        </a>
                                        <a class="btn btn-sm btn-success" target="_blank" href="'.url("/project/$project->slug/").'" >
                                            View
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/projects/'.$project->id.'" data-tableid="projectsTable"   data-id="'.$project->id.'">
                                            Delete
                                        </a>';
                })
                ->editColumn('progress', function($project) {
                    $progress = config('constants.progress');
                    return  $progress[$project->progress];
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);
        $price_types = config('constants.price_types');
        $offering = config('constants.offering');       
        
        
        return view('admin.projects.create', compact('users','builders','progress','offering','area_types','bedrooms','bathrooms','cities','price_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offering = config('constants.offering');

        $validated = $request->validate([

            'project_title' => 'required',                 
            'progress' => 'required',            
            'project_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'builder_id' => 'required',
            'city_id' => 'required',
            'location' => 'required',            
            'images.*' => 'image|max:10240',
            'offering' => 'required|array|min:1|in:'.implode(",",$offering),

            ],
            [                
                'project_logo.max' => 'The logo must not be larger than 10 MB.',
            ]
        );



        $rules = [];
        $messages = [];

        $offering = $request->has('offering') ? $request->offering : [];
        

        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);
                for ($i = 0; $i < $count; $i++) {
                    $rules["{$offer}.title.$i"] = 'required|string|max:255';
                    $rules["{$offer}.area.$i"] = 'required|string|min:0';
                    $rules["{$offer}.area_type.$i"] = 'required';
                    $rules["{$offer}.price_from.$i"] = 'required|numeric|min:0';
                    $rules["{$offer}.price_to.$i"] = 'required|numeric|min:0';
                    $rules["{$offer}.price_type_from.$i"] = 'required';
                    $rules["{$offer}.price_type_to.$i"] = 'required';
                    
                    // Flats might have bedrooms/bathrooms, plots might not
                    if (in_array($offer, ['flats', 'offices'])) {
                        $rules["{$offer}.bedrooms.$i"] = 'required|integer|min:0';
                        $rules["{$offer}.bathrooms.$i"] = 'required|integer|min:0';
                    }
                }
            }
        }

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {
                $rules["floorplans.title.$i"] = 'required|string|max:255';
                $rules["floorplans.image.$i"] = 'required|image|max:10240';
                $messages["floorplans.image.$i.max"] = "Image $i must not be greater than 10 MB.";
            }
        }       


        $request->validate($rules, $messages);

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'offering' => $request->has('offering') ? implode(',', $request->offering) : '',            
            'is_active' => $request->has('is_active') ? 1 : 0,            
            'added_by' => auth('admin')->user()->id,
        ]);

        $logo_url = "";

        if(!empty($request->project_logo)){
            $folderName = 'project_logos';
            $fileName = pathinfo($request->project_logo->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->project_logo->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->project_logo->move(public_path('uploads/'.$folderName), $fullFileName);
            $logo_url = 'uploads/'.$folderName.'/'.$fullFileName;
        }

        $request->merge([
            'logo_url' => $logo_url,
        ]);

        $project = Project::create($request->except('project_logo','project_gallery','payment_plan','_token'));

        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);
                for ($i = 0; $i < $count; $i++) {

                     $project->offers()->create([
                        //'project_id' => $project->id,
                        'offer' => $offer,
                        'title' => $request->$offer['title'][$i],
                        'area' => $request->$offer['area'][$i],
                        'area_type' => $request->$offer['area_type'][$i],
                        'bedrooms' => ($request->has("{$offer}.bedrooms.{$i}")) ? $request->$offer['bedrooms'][$i] : 0,
                        'bathrooms' => ($request->has("{$offer}.bathrooms.{$i}")) ? $request->$offer['bathrooms'][$i] : 0,
                        'price_from' => $request->$offer['price_from'][$i],
                        'price_to' => $request->$offer['price_to'][$i],
                        'price_from_in_format' => $request->$offer['price_type_from'][$i],
                        'price_to_in_format' => $request->$offer['price_type_to'][$i],
       
                    ]);
                   
                }
            }
        }



        $folderName = 'project_floor_plans_images';
        $mediaUrl = '';

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {

                if(!empty($request->floorplans['image'][$i])){
                    $image = $request->floorplans['image'][$i];
                    
                    $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);           
                    $fullFileName = $fileName."-".time().'.'.$image->getClientOriginalExtension();
                    $fullFileName = str_replace(" ","_",$fullFileName);
                    $image->move(public_path('uploads/'.$folderName), $fullFileName);
                    $mediaUrl = 'uploads/'.$folderName.'/'.$fullFileName;
                }


                $project->floorPlan()->create([
                    //'project_id' => $project->id,
                    'title' => $request->floorplans['title'][$i],
                    'media_url' => $mediaUrl,
                    
                ]);
            }
        }


        if ($request->has('media_ids')) {
            if (!empty($request->media_ids['project_gallery'])) {
                foreach ($request->media_ids['project_gallery'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'project_gallery'; // move it to real collection
                        $media->save();
                    }
                }
            }
            if (!empty($request->media_ids['payment_plan'])) {
                foreach ($request->media_ids['payment_plan'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'payment_plan'; // move it to real collection
                        $media->save();
                    }
                }
            }
        }



        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully!',
            'project' => $project
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);
        $price_types = config('constants.price_types');
        $offering = config('constants.offering');       
        
        
        return view('admin.projects.create', compact('project','users','builders','progress','offering','area_types','bedrooms','bathrooms','cities','price_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $offering = config('constants.offering');

        $validated = $request->validate([

            'project_title' => 'required',                 
            'progress' => 'required',            
            'project_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'builder_id' => 'required',
            'city_id' => 'required',
            'location' => 'required',            
            'images.*' => 'image|max:2048',
            'offering' => 'required|array|min:1|in:'.implode(",",$offering),

            ],
            [                
                'project_logo.max' => 'The logo must not be larger than 10 MB.',
            ]
        );



        $rules = [];
        $messages = [];

        $offering = $request->has('offering') ? $request->offering : [];
        

        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);
                for ($i = 0; $i < $count; $i++) {

                    $offer_id = $request->$offer['offer_id'][$i] ?? null;
                    // Skip validation for existing records (if you want to ignore these)
                    if (!empty($offer_id)) {
                        //continue; // Skip validation for this existing record
                    }

                    $rules["{$offer}.title.$i"] = 'required|string|max:255';
                    $rules["{$offer}.area.$i"] = 'required|string|min:0';
                    $rules["{$offer}.area_type.$i"] = 'required';
                    $rules["{$offer}.price_from.$i"] = 'required|numeric|min:0';
                    $rules["{$offer}.price_to.$i"] = 'required|numeric|min:0';
                    $rules["{$offer}.price_type_from.$i"] = 'required';
                    $rules["{$offer}.price_type_to.$i"] = 'required';
                    
                    // Flats might have bedrooms/bathrooms, plots might not
                    if (in_array($offer, ['flats', 'offices'])) {
                        $rules["{$offer}.bedrooms.$i"] = 'required|integer|min:0';
                        $rules["{$offer}.bathrooms.$i"] = 'required|integer|min:0';
                    }
                }
            }
        }

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {

                $floorplansId = $request->floorplans['id'][$i] ?? null;

                    // Skip validation for existing records (if you want to ignore these)
                    if (!empty($floorplansId)) {
                        //continue; // Skip validation for this existing record
                    }
                $rules["floorplans.title.$i"] = 'required|string|max:255';
                $rules["floorplans.image.$i"] = 'nullable|image|max:10240';
                $messages["floorplans.image.$i.max"] = "Image $i must not be greater than 10 MB.";
            }
        }

        $request->validate($rules, $messages);

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'offering' => $request->has('offering') ? implode(',', $request->offering) : '',            
            'is_active' => $request->has('is_active') ? 1 : 0,            
            'added_by' => auth('admin')->user()->id,
        ]);

        

        if(!empty($request->project_logo)){
            $folderName = 'project_logos';
            $fileName = pathinfo($request->project_logo->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->project_logo->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->project_logo->move(public_path('uploads/'.$folderName), $fullFileName);
            $logo_url = 'uploads/'.$folderName.'/'.$fullFileName;

            $request->merge([
                'logo_url' => $logo_url,
            ]);
        }        

        $project->update($request->except('project_logo','project_gallery','payment_plan'));


        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);
                for ($i = 0; $i < $count; $i++) {
                    $offerId = $request->$offer['offer_id'][$i] ?? null;
                    $project->offers()->updateOrCreate(
                        ['id' => $offerId],
                        [
                        'project_id' => $project->id,
                        'offer' => $offer,
                        'title' => $request->$offer['title'][$i],
                        'area' => $request->$offer['area'][$i],
                        'area_type' => $request->$offer['area_type'][$i],
                        'bedrooms' => ($request->has("{$offer}.bedrooms.{$i}")) ? $request->$offer['bedrooms'][$i] : 0,
                        'bathrooms' => ($request->has("{$offer}.bathrooms.{$i}")) ? $request->$offer['bathrooms'][$i] : 0,
                        'price_from' => $request->$offer['price_from'][$i],
                        'price_to' => $request->$offer['price_to'][$i],
                        'price_from_in_format' => $request->$offer['price_type_from'][$i],
                        'price_to_in_format' => $request->$offer['price_type_to'][$i],
       
                    ]);
                   
                }
            }
        }



        $folderName = 'project_floor_plans_images';
        $mediaUrl = '';

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {
                $floorplansId = $request->floorplans['id'][$i] ?? null;
                if(!empty($request->floorplans['image'][$i])){
                    $image = $request->floorplans['image'][$i];
                    
                    $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);           
                    $fullFileName = $fileName."-".time().'.'.$image->getClientOriginalExtension();
                    $fullFileName = str_replace(" ","_",$fullFileName);
                    $image->move(public_path('uploads/'.$folderName), $fullFileName);
                    $mediaUrl = 'uploads/'.$folderName.'/'.$fullFileName;
                    $project->floorPlan()->updateOrCreate(
                        ['id' => $floorplansId],
                        [
                    
                        'media_url' => $mediaUrl,
                        
                        ]
                    );
                }

                $project->floorPlan()->updateOrCreate(
                    ['id' => $floorplansId],
                    [
                    'project_id' => $project->id,
                    'title' => $request->floorplans['title'][$i],                  
                    
                ]);
            }
        }


        if ($request->has('media_ids')) {
            if (!empty($request->media_ids['project_gallery'])) {
                foreach ($request->media_ids['project_gallery'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'project_gallery'; // move it to real collection
                        $media->save();
                    }
                }
            }
            if (!empty($request->media_ids['payment_plan'])) {
                foreach ($request->media_ids['payment_plan'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'payment_plan'; // move it to real collection
                        $media->save();
                    }
                }
            }
        }



        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully!',
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project = Project::with('media')->findOrFail($project->id);

        foreach ($project->media as $media) {
            //Storage::disk('public')->delete('/assets/'.$media->file_name);
        }

        $project->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function addProperty(Request $request){

        $project = Project::findOrFail($request->id);
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);

        return view('admin.projects.add-property', compact('project','users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities'));
        
    }


    public function editProperty(Request $request){

        $project = Project::findOrFail($request->id);
        $property = Property::findOrFail($request->property_id);
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);

        return view('admin.projects.add-property', compact('project','property','users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities'));
        
    }
}
