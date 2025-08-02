<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;
use App\Project;
use App\Builder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('offers','floorPlan','builder')->where('is_active', true)->paginate(3);
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $offering = config('constants.offering');
        $searchedData    = '';

        //$projects = $projects->paginate(3);

        
        return view('project-search-results',compact('builders','progress','property_types','bedrooms','projects','offering','searchedData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::with('offers','floorPlan','builder')->where('slug',$slug)->firstOrFail();
        $related_projects = Project::with('offers','floorPlan','builder')->where('builder_id',$project->builder_id)->take(3)->get();
        $progress = config('constants.progress');

        return view('projects.details', compact('project','progress','related_projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     public function searchResults(Request $request){

        $searchArea      = $request->input('search-area');
        $builderId       = $request->input('builder_id');
        $isInstallment   = $request->input('is_installment');
        $progress        = $request->input('progress');
        $propertyType    = $request->input('property_type');
        $priceFrom       = $request->input('price_from');
        $priceTo         = $request->input('price_to');
        $bedrooms        = $request->input('bedrooms');
        $priceFrom       = GeneralHelper::detectNumberUnit($priceFrom);
        $priceTo         = GeneralHelper::detectNumberUnit($priceTo);
        $searchedData    = $request->all();
        
        \DB::enableQueryLog();


        $projects = Project::query()

        // Search area (assuming 'location' field)
        ->when($searchArea, function ($query, $searchArea) {
            $query->where('location', 'like', "%$searchArea%");
        })

        // Builder ID
        ->when($builderId && $builderId != 'Select', function ($query) use ($builderId) {
            $query->where('builder_id', $builderId);
        })

        // Is Installment (assuming 'is_installment' field)
        ->when($isInstallment && $isInstallment != 'Select', function ($query) use ($isInstallment) {
            $query->where('is_installment', $isInstallment);
        })

        // Progress (e.g., under-construction, completed)
        ->when($progress && $progress != 'Select', function ($query) use ($progress) {
            $query->where('progress', $progress);
        })

        // Property Type
        /*->when($propertyType, function ($query, $propertyType) {
            $query->whereIn('offering', explode(",",$propertyType));
        })*/

        // Bedrooms (assuming 'bedrooms' field in project_offers table)
        ->when($bedrooms, function ($query, $bedrooms) {
            $query->whereHas('offers', function ($q) use ($bedrooms) {
                $q->where('bedrooms', $bedrooms);
            });
        })
        
        // Price Range (in related project_offers table)
        ->when(($priceFrom && $priceTo && $propertyType), function ($query) use ($priceFrom, $priceTo, $propertyType) {
            $query->whereHas('offers', function ($q) use ($priceFrom, $priceTo, $propertyType) {
                $q->whereBetween('price_from', [$priceFrom['amount'], $priceTo['amount']]);
                $q->where('price_from_in_format', [$priceFrom['unit']]);
                $q->orWhere('price_to_in_format', [$priceTo['unit']]);
                $q->where('offer', [$propertyType]);
            });
        });

        

       

        $projects = $projects->paginate(3);
        //dd(\DB::getQueryLog());
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $offering = config('constants.offering');

        if ($request->ajax()) {
            return view('projects.partials.project_list', compact('builders','progress','property_types','bedrooms','projects','offering','searchedData'))->render();
        }

        

        
        return view('project-search-results',compact('builders','progress','property_types','bedrooms','projects','offering','searchedData'));

    }
}
