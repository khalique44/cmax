@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>{{ isset($project) ? 'Edit Project' : 'Add New Project' }}</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/projects')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ==== User Update        =======  -->
            <!--  ===============================  -->

            @if ($errors->any())
                <div class="alert alert-danger">
                    Please remove the following errors.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include("layouts.partials.messages")
            <div class="ajax-msg"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" enctype="multipart/form-data" class="has-filepond" id="{{ isset($project) ? 'project-form-update' : 'project-form' }}">
                            @csrf
                            @if(isset($project)) @method('PUT') <input type="hidden" name="project_id" value="{{ $project->id }}"> @endif
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title:<span>*</span></label>
                                        <input type="text" name="project_title" id="project_title" class="form-control" value="{{ old('project_title', $project->project_title ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($project->logo_url) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Logo:<span>*</span></label>
                                        <input type="file" name="project_logo" id="project_logo"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($project->logo_url))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$project->logo_url}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$project->logo_url}}" class="logo" title="Project Logo" alt="Logo" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Progress<span>*</span></label>
                                        <select name="progress" id="progress" class="form-control select2" required>
                                            <option value="">Select Progress</option>
                                            @foreach($progress as $key => $prog)
                                                <option value="{{ $key }}" {{ old('progress', $project->progress ?? '') === $key ? 'selected' : '' }}>{{ ucfirst($prog) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label select2">Builder<span>*</span></label>
                                        <select name="builder_id" id="builder_id" class="form-control select2" required>
                                            <option value="">Select Builder </option>
                                            @foreach($builders as $builder)
                                                <option value="{{ $builder->id }}" {{ old('builder_id', $project->builder_id ?? '') === $builder->id ? 'selected' : '' }}>{{ ucfirst($builder->builder_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                       
                            </div>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="txtEditor" class="form-control" >{{ old('description', $project->description ?? '') }}</textarea>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row my-location-wrapper">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">City<span>*</span></label>
                                        <select name="city_id" id="city_id" class="form-control select2" >
                                            <option value="">Select City</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}" {{ old('city_id', $project->city_id ?? '') === $city->id ? 'selected' : '' }}>{{ ucfirst($city->name)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                    

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Location<span>*</span></label>
                                        <input  type="text" name="location" class="form-control" value="{{ old('location', $project->location ?? '') }}" id="gmap-location" required >

                                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $project->latitude ?? '') }}">
                                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $project->longitude ?? '') }}">
                                    </div>                                    

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <div id="map" style="height: 300px; width: 100%;" class="m-2"></div>
                                    </div> 
                                </div>                                  

                                


                            <div class="row">                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Gallery Images</label>
                                        <input type="file" name="project_gallery[]" multiple class="form-control filepond"  >
                                        <input type="hidden" id="uploaded-files" name="uploaded_files[]" data-max-files="10" />
                                            <input type="hidden" id="deleted-files" name="deleted_files[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper" id="gallery-preview" data-upload-type="gallery" data-allow-reorder="true"   data-preview="gallery-preview" data-collection="project_gallery">
                                            @if(isset($project))
                                                @foreach($project->getMedia('project_gallery') as $media)
                                                <div class="preview-box remove-media" data-media-id="{{ $media->id }}">
                                                    <div>
                                                        <img src="{{ str_replace('storage','storage/app/public',$media->getUrl('thumb')) }}" alt="uploaded">
                                                    </div>
                                                    <div>
                                                        <span title="Remove" class="remove-media " >Remove</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif

                                         
                                                @if(isset($project))
                                                @php
                                                $existingImages = $project->getMedia('project_gallery')->map(function ($media) {
                                                    return [
                                                        'source' => $media->id,
                                                        'options' => [
                                                            'type' => 'local',
                                                            'file' => [
                                                                'name' => $media->file_name,
                                                                'size' => $media->size,
                                                                'type' => $media->mime_type,
                                                            ],
                                                            'metadata' => [
                                                                'poster' => $media->getUrl('thumb') // or getFullUrl()
                                                            ]
                                                        ]
                                                    ];
                                                });
                                                @endphp
                                                @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Offering<span>*</span></label>
                                        @php

                                            $offers = isset($project) ? explode(',',$project->offering) : "";
                                        
                                        @endphp
                      
                                        <ul class="list-inline property-form-ul">
                                            @foreach($offering as $offer)
                                                
                                                <li class="offer-{{ $offer }} list-inline-item">
                                                <input type="checkbox" class="btn-check offering" name="offering[]" id="offer-{{ $offer }}"  autocomplete="off" value="{{ $offer }}" {{ isset($project) &&  in_array($offer,$offers) ? 'checked' : '' }} >
                                                    <label class="btn btn-light" for="offer-{{$offer}}">{{$offer}}</label>
                                                    
                                                </li>
                                                
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                </div>

                                
                            </div>    

                            <div class="row">
                                <div class="accordion" id="project-offers">

                                    @foreach($offering as $key => $offer)
                                        <div class="accordion-item offer-item-{{$offer}}  {{ isset($project) &&  in_array($offer,$offers) ? '' : 'display-none' }} ">
                                            
                                            <h2 class="accordion-header" id="offer-heading-{{$key}}">
                                              <button class="accordion-button offer-item-btn-{{$offer}}" type="button" data-bs-toggle="collapse" data-bs-target="#offer-{{$key}}"
                                                aria-expanded="{{ isset($project) &&  in_array($offer,$offers) ? 'true' : 'false' }}" aria-controls="offer-{{$key}}">
                                                {{$offer}}
                                              </button>
                                            </h2>
                                            <div id="offer-{{$key}}" class="accordion-collapse collapse {{ isset($project) &&  in_array($offer,$offers) ? 'show' : '' }}" aria-labelledby="offer-heading-{{$key}}"
                                              >
                                                <div class="accordion-body">
                                                    <div class="repeatable-wrapper">
                                                        <div class="repeatable-fields">
                                                            @if(!empty($project->offers))
                                                                @foreach($project->offers as $savedOffer)
                                                                    @if($savedOffer->offer == strtolower($offer))
                                         
                                                                        <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                      <label class="form-label">Title <span>*</span></label>
                                                                                      <input type="text" name="{{$offer}}[title][]" class="form-control" value="{{ $savedOffer->title }}" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Area <span>*</span></label>
                                                                                        <input type="text" name="{{$offer}}[area][]" class="form-control" value="{{ $savedOffer->area }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Area Type</label>
                                                                                        <select name="{{$offer}}[area_type][]" class="form-control">
                                                                                            @foreach($area_types as $area_type)
                                                                                                <option value="{{ $area_type }}" {{ $savedOffer->area_type == $area_type ? 'selected' : '' }}>{{ ucfirst($area_type) }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-2">
                                                                                @if($offer != 'Plots' && $offer != 'Offices' && $offer != 'Shops')
                                                                                    <div class="col-md-2">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label">Bedrooms</label>
                                                                                            <select name="{{$offer}}[bedrooms][]" class="form-control">
                                                                                                <option value="">Select</option>
                                                                                                @foreach($bedrooms as $bedroom)
                                                                                                    <option value="{{ $bedroom }}" {{ $savedOffer->bedrooms == $bedroom ? 'selected' : '' }}>{{ $bedroom }}</option>
                                                                                                @endforeach
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label">Bathrooms</label>
                                                                                            <select name="{{$offer}}[bathroom][]" class="form-control">
                                                                                            <option value="">Select</option>
                                                                                                @foreach($bathrooms as $bathroom)
                                                                                                    <option value="{{ $bathroom }}" {{ $savedOffer->bathrooms == $bathroom ? 'selected' : '' }}>{{ $bathroom }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Price From <span>*</span></label>
                                                                                        <input type="number" name="{{$offer}}[price_from][]" class="form-control" min="0" step="any" inputmode="decimal" value="{{ $savedOffer->price_from }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Amount in</label>
                                                                                        <select name="{{$offer}}[price_type_from][]" id="price_type_from_{{$offer}}" class="form-control" >
                                                                                        
                                                                                            @foreach($price_types as $key => $price_type)
                                                                                                <option value="{{ $price_type }}" {{ old('price_type_from', $savedOffer->price_from_in_format ?? '') === $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Price To <span>*</span></label>
                                                                                        <input type="number" name="{{$offer}}[price_to][]" class="form-control" min="0" step="any" inputmode="decimal" value="{{ $savedOffer->price_to  }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Amount in</label>
                                                                                        <select name="{{$offer}}[price_type_to][]" id="price_type_to_{{$offer}}" class="form-control" >
                                                                                        
                                                                                            @foreach($price_types as $key => $price_type)
                                                                                                <option value="{{ $price_type }}" {{ old('price_type_to', $savedOffer->price_to_in_format ?? '') === $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>  
                                                                            <div class="text-end mt-2">
                                                                                <button type="button" class="btn btn-danger btn-sm remove-group" data-id="{{ $savedOffer->id }}">Remove</button>
                                                                                <input type="hidden" name="{{$offer}}[offer_id][]" value="{{$savedOffer->id}}">
                                                                            </div>
                                                                        </div>   
                                                                    @endif
                                                                @endforeach         
                                                            @endif
                                                            @if(!isset($project) || $project->count() > 0)
                                                                <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                              <label class="form-label">Title <span>*</span></label>
                                                                              <input type="text" name="{{$offer}}[title][]" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Area <span>*</span></label>
                                                                                <input type="text" name="{{$offer}}[area][]" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Area Type</label>
                                                                                <select name="{{$offer}}[area_type][]" class="form-control">
                                                                                    @foreach($area_types as $area_type)
                                                                                        <option value="{{ $area_type }}">{{ ucfirst($area_type) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-2">
                                                                        @if($offer != 'Plots' && $offer != 'Offices' && $offer != 'Shops')
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Bedrooms</label>
                                                                                    <select name="{{$offer}}[bedrooms][]" class="form-control">
                                                                                        <option value="">Select</option>
                                                                                        @foreach($bedrooms as $bedroom)
                                                                                            <option value="{{ $bedroom }}">{{ $bedroom }}</option>
                                                                                        @endforeach
                                                                                  </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Bathrooms</label>
                                                                                    <select name="{{$offer}}[bathroom][]" class="form-control">
                                                                                    <option value="">Select</option>
                                                                                        @foreach($bathrooms as $bathroom)
                                                                                            <option value="{{ $bathroom }}">{{ $bathroom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Price From <span>*</span></label>
                                                                                <input type="number" name="{{$offer}}[price_from][]" class="form-control" min="0" step="any" inputmode="decimal">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Amount in</label>
                                                                                <select name="{{$offer}}[price_type_from][]" id="price_type_from_{{$offer}}" class="form-control" >
                                                                                
                                                                                    @foreach($price_types as $key => $price_type)
                                                                                        <option value="{{ $price_type }}" {{ old('price_type_from', $project->price_type_from ?? '') === $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Price To <span>*</span></label>
                                                                                <input type="number" name="{{$offer}}[price_to][]" class="form-control" min="0" step="any" inputmode="decimal">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Amount in</label>
                                                                                <select name="{{$offer}}[price_type_to][]" id="price_type_to_{{$offer}}" class="form-control" >
                                                                                
                                                                                    @foreach($price_types as $key => $price_type)
                                                                                        <option value="{{ $price_type }}" {{ old('price_type_to', $project->price_type_to ?? '') === $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div> 
                                                                    </div>  
                                                                    <div class="text-end mt-2">
                                                                        <button type="button" class="btn btn-danger btn-sm remove-group" data-id="">Remove</button>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>

                                                        
                                                        <div class="mt-2">
                                                            <button type="button" id="add-more" class="btn btn-primary btn-sm add-more"><i class="fa fa-plus"></i> Add More</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>        
                            <div class="row p-3">
                                <div class="repeatable-wrapper" id="floorplans-wrapper">
                                    <label><strong>Floor Plans</strong></label>
                                  
                                    <div class="repeatable-fields">

                                        @if(isset($project))
                                            @if($project->floorPlan->count() > 0)
                                                @foreach($project->floorPlan as $floorPlan)

                                                    <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label class="form-label">Title<span>*</span></label>
                                                                  <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" value="{{ $floorPlan->title }}" >
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label class="form-label">Upload Image<span>*</span></label>
                                                                  <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" >
                                                                  <input type="hidden" name="floorplans[id][]" value="{{$floorPlan->id}}">
                                                              </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">                       
                                                                <div class="form-group">
                                                                    @if(!empty($floorPlan->media_url))
                                                                        <a href="{!! url('public') !!}/{{$floorPlan->media_url}}" target="_blank" class="available-image-area">
                                                                            
                                                                            <img src="{!! url('public') !!}/{{$floorPlan->media_url}}" class="logo" title="Project Logo" alt="Logo" width="50%">                                                    
                                                                        </a>                                          
                                                                    @endif
                                                                </div>                                                      
                                                            </div>
                                                            
                                                            <div class="text-end mt-2">
                                                                <button type="button" class="btn btn-danger btn-sm remove-group" data-floorplan-id="{{$floorPlan->id}}">Remove</button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                @endforeach
                                            @else
                                                <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                              <label class="form-label">Title<span>*</span></label>
                                                              <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" value="" >
                                                          </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                              <label class="form-label">Upload Image<span>*</span></label>
                                                              <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" >
                                                              <input type="hidden" name="floorplans[id][]" value="">
                                                          </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">                       
                                                            <div class="form-group">
                                                                
                                                            </div>                                                      
                                                        </div>
                                                        
                                                        <div class="text-end mt-2">
                                                            <button type="button" class="btn btn-danger btn-sm remove-group" data-floorplan-id="">Remove</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                        @else                                   
                                        
                                            <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label class="form-label">Title<span>*</span></label>
                                                          <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" value="" >
                                                      </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label class="form-label">Upload Image<span>*</span></label>
                                                          <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" >
                                                          <input type="hidden" name="floorplans[id][]" value="">
                                                      </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">                       
                                                        <div class="form-group">
                                                            
                                                        </div>                                                      
                                                    </div>
                                                    
                                                    <div class="text-end mt-2">
                                                        <button type="button" class="btn btn-danger btn-sm remove-group" data-floorplan-id="">Remove</button>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    
                                    <button type="button" class="btn btn-primary mt-2 btn-sm add-more"><i class="fa fa-plus"></i> Add More</button>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Payment Plan</label>
                                        <input type="file" name="payment_plan[]" multiple class="form-control filepond" id="payment_plan" >
                                        <input type="hidden" id="uploaded-files2" name="uploaded_files2[]" />
                                            <input type="hidden" id="deleted-files2" name="deleted_files2[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper" id="payment-preview" data-upload-type="payment_plan" data-allow-reorder="true" data-max-files="10" data-collection="payment_plan" data-preview="payment-preview">
                                            @if(isset($project))
                                                @foreach($project->getMedia('payment_plan') as $media)
                                                <div class="preview-box remove-media" data-media-id="{{ $media->id }}">
                                                    <div>
                                                        <img src="{{ str_replace('storage','storage/app/public',$media->getUrl('thumb')) }}" alt="uploaded">
                                                    </div>
                                                    <div>
                                                        <span title="Remove" class="remove-media " >Remove</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif

                                         
                                                @if(isset($project))
                                                @php
                                                $existingImages2 = $project->getMedia('payment_plan')->map(function ($media) {
                                                    return [
                                                        'source' => $media->id,
                                                        'options' => [
                                                            'type' => 'local',
                                                            'file' => [
                                                                'name' => $media->file_name,
                                                                'size' => $media->size,
                                                                'type' => $media->mime_type,
                                                            ],
                                                            'metadata' => [
                                                                'poster' => $media->getUrl('thumb') // or getFullUrl()
                                                            ]
                                                        ]
                                                    ];
                                                });
                                                @endphp
                                                @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 mb-3 mt-3">
                                <div class="form-group">
                                   
                                    <div class="form-check form-switch">
                                      <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                      <label class="form-check-label" for="is_active">Status</label>
                                    </div>                                    
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="deleted-offer[]" id="deleted-offer">
                                        <input type="hidden" name="deleted-floor-plan[]" id="deleted-floor-plan">
                                        <button type="submit" class="btn btn-success mt-3">{{ isset($project) ? 'Update' : 'Save' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>



</script>


<script>

let map;
let marker;
let autocomplete;
let geocoder;

function initMap() {

    // Show map at a default location (e.g., Karachi)
    const defaultLat = {{ old('latitude', $project->latitude ?? '24.8607343') }};
    const defaultLng = {{ old('longitude', $project->longitude ?? '67.0011364') }};
    const defaultLatLng = { lat: defaultLat, lng: defaultLng }; // default: Karachi

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLatLng,
        zoom: 12
    });

    marker = new google.maps.Marker({
        map: map,
        position: defaultLatLng
    });

    const input = document.getElementById('gmap-location');
    autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', onPlaceChanged);

    geocoder = new google.maps.Geocoder();

    $(document).on('change','select#city_id ', function(){
        console.log('city:',$(this).find('option:selected').text());
        const city = $(this).find('option:selected').text();
        if (city) {
            onCityChange(city);
        }
    })
}

function onPlaceChanged() {
    const place = autocomplete.getPlace();
    if (place.geometry) {
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);

        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    }
}

// when city is selected from dropdown
function onCityChange(cityName) {
    $("#gmap-location").attr('placeholder','Enter a Location');
    geocoder.geocode({ address: cityName }, function (results, status) {
        if (status === 'OK') {
            const location = results[0].geometry.location;
            map.setCenter(location);
            map.setZoom(12);
            marker.setPosition(location);

            // Set bounds for autocomplete
            const circle = new google.maps.Circle({
                center: location,
                radius: 30000 // ~30km
            });
            autocomplete.setBounds(circle.getBounds());
            $("#gmap-location").attr('placeholder','Search from '+cityName);
        } else {
            console.error('City not found: ' + status);
        }
    });
}


// Load on window
google.maps.event.addDomListener(window, 'load', initMap);

$(document).on("change", "input.offering", function(){
    var offer = $(this).val();
    if($(this).is(":checked")){
        $(".offer-item-"+offer).removeClass("display-none");
        $(".offer-item-btn-"+offer).trigger("click");
        $('html, body').animate({ scrollTop: $(".offer-item-"+offer).offset().top}, 100);
    }else{
        $(".offer-item-"+offer).addClass("display-none");
    }

});


$(document).ready(function () {
  // Handle Add More for all groups
  $('.repeatable-wrapper').on('click', '.add-more', function () {
    let $wrapper = $(this).closest('.repeatable-wrapper');
    let $group = $wrapper.find('.repeatable-group:first').clone();

    // Clear input/select values
    $group.find('input, select').val('');
    $group.find('button.remove-group').attr('data-id','');
    $group.find('button.remove-group').attr('data-floorplan-id','');
    $group.find('a.available-image-area').remove();
    
    $wrapper.find('.repeatable-fields').append($group);
  });

  // Handle Remove within groups
  $(document).on('click', '.repeatable-wrapper .remove-group', function () {
    let $fields = $(this).closest('.repeatable-fields');
    if ($fields.find('.repeatable-group').length > 1) {
        if($(this).data("id")  || $(this).data("floorplan-id")){
            Swal.fire({
                title: 'Are you sure?',
                text: "The record will be deleted after you save this form.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('.repeatable-group').remove();
                    var element_id = "deleted-offer";
                    var record_id = $(this).data("id");
                    if($(this).data("floorplan-id")){
                        element_id = "deleted-floor-plan";
                        record_id = $(this).data("floorplan-id");
                    }
                    
                    addDeletedRec(record_id,element_id);
                }
            });
        }else{

            $(this).closest('.repeatable-group').remove();
        }
      
    }
  });

    
});

function addDeletedRec(record_id,element_id) {
    const field = document.getElementById(element_id);
    let val = field.value ? JSON.parse(field.value) : [];
    val.push(record_id);
    field.value = JSON.stringify(val);
}

</script>
@if(!isset($project))
    <script>

    $(document).ready(function () {

        progress = sessionStorage.getItem('progress') || '';
        $('select#progress').val(progress).trigger('change');

        $('select#progress').on('change', function() {
            sessionStorage.setItem('progress', $(this).val());
        });

        builder_id = sessionStorage.getItem('builder_id') || '';
        $('select#builder_id').val(builder_id).trigger('change');

        $('select#builder_id').on('change', function() {
            sessionStorage.setItem('builder_id', $(this).val());
        });

        city_id = sessionStorage.getItem('city_id') || '';
        $('select#city_id').val(city_id).trigger('change');

        $('select#city_id').on('change', function() {
            sessionStorage.setItem('city_id', $(this).val());
        });
    });
    // Auto-fill form from sessionStorage
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('project_title').value = sessionStorage.getItem('project_title') || '';
        document.getElementById('txtEditor').value = sessionStorage.getItem('description') || '';
        document.getElementById('gmap-location').value = sessionStorage.getItem('gmap-location') || '';
        
    });

    // Save on input
    document.getElementById('project_title').addEventListener('input', e => {
        sessionStorage.setItem('project_title', e.target.value);
    });

    document.getElementById('gmap-location').addEventListener('input', e => {
        console.log(e.target.value);
        sessionStorage.setItem('gmap-location', e.target.value);
    });
        
    </script>
@endif
@endsection

