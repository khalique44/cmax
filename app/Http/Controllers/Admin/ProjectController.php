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
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/projects/$project->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/projects/'.$project->id.'" data-tableid="projectsTable"   data-id="'.$project->id.'">
                                            Delete
                                        </a>
                                        <a type="button" href="'.url("admin/projects/add-property/$project->id/").'" class="btn btn-sm btn-success" >
                                            <i class="fa fa-house-medical"></i>
                                            Add Property
                                        </a>';
                })
                ->editColumn('progress', function($project) {
                    $progress = config('constants.progress');
                    return  $progress[$project->progress];
                })
                ->addColumn('properties', function ($project) {
                    return $project->properties->map(function ($property) {

                        return [
                            'property_id' => $property->id,
                            'title' => $property->property_title,
                            'price' => $property->price,
                            'type' => $property->property_type,
                            'status' => $property->is_active,
                        ];
                    })->toArray();
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
        $validated = $request->validate([

            'project_title' => 'required',                 
            'progress' => 'required',            
            'images.*' => 'image|max:2048',
            ]
        );

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,            
            'added_by' => auth('admin')->user()->id,
        ]);

        $project = Project::create($request->except('images','_token'));

        if ($request->has('media_ids')) {
            foreach ($request->media_ids as $mediaId) {
                $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                if ($media) {
                    $media->model_type = Project::class;
                    $media->model_id = $project->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
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
        $progress = config('constants.progress');
        
        return view('admin.projects.create', compact('progress','project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([

            'project_title' => 'required',                 
            'progress' => 'required',            
            'images.*' => 'image|max:2048',
            ]
        );

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $project->update($request->except('images','_token'));

        // Remove deleted images
        $deletedFiles = $request->input('deleted_files', []);

       if (!empty($deletedFiles)) {            
            foreach ($deletedFiles as $id) {
                if($id){
                    $id = (json_decode($id));
                    Media::whereIn('id', $id)->delete();
                }
                
            }
        }
        

        if ($request->has('media_ids')) {
            foreach ($request->media_ids as $mediaId) {
                $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                if ($media) {
                    $media->model_type = Project::class;
                    $media->model_id = $project->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
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
        $project = Project::with('media')->findOrFail($id);

        foreach ($project->media as $media) {
            Storage::disk('public')->delete($media->file_path);
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
