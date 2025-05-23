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
                                        <label class="form-label">Title<span>*</span></label>
                                        <input type="text" name="project_title" class="form-control" value="{{ old('project_title', $project->project_title ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Logo:</label>
                                        <input type="file" name="logo_url" id="logo_url"  class="form-control"  >

                                        @if(!empty($project->logo_url))
                                            <a href="{!! url('public') !!}/{{$project->logo_url}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$project->logo_url}}" class="logo" alt="Logo" width="50%">
                                                
                                            </a>
                                        @endif
                                        
                                    </div>
                                    
                                </div>
                                
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
                                            <option value="">Select Builder</option>
                                            @foreach($builders as $builder)
                                                <option value="{{ $builder->id }}" {{ old('builder_id', $property->builder_id ?? '') === $builder->id ? 'selected' : '' }}>{{ ucfirst($builder->builder_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                       
                            </div>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description<span>*</span></label>
                                        <textarea name="description" id="txtEditor" class="form-control" required>{{ old('description', $project->description ?? '') }}</textarea>
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
                                                <option value="{{ $city->id }}" {{ old('listed_by', $property->city_id ?? '') === $city->id ? 'selected' : '' }}>{{ ucfirst($city->name)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                    

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Location<span>*</span></label>
                                        <input  type="text" name="location" class="form-control" value="{{ old('location', $property->location ?? '') }}" id="gmap-location" required >

                                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $property->latitude ?? '') }}">
                                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $property->longitude ?? '') }}">
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
                                        <input type="file" name="filepond[]" multiple class="form-control" id="filepond">
                                        <input type="hidden" id="uploaded-files" name="uploaded_files[]" />
                                            <input type="hidden" id="deleted-files" name="deleted_files[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper" id="uploaded-preview">
                                            @if(isset($project))
                                                @foreach($project->getMedia('images') as $media)
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
                                                $existingImages = $project->getMedia('images')->map(function ($media) {
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
                                        <label class="form-label">Offering</label>
                      
                                        <ul class="list-inline property-form-ul">
                                            @foreach($offering as $offer)

                                                <li class="offer-{{ $offer }} list-inline-item">
                                                <input type="checkbox" class="btn-check offering" name="offering[]" id="offer-{{ $offer }}"  autocomplete="off" value="{{ $offer }}" {{ isset($project) && $project->offering->contains($offer) ? 'checked' : '' }} >
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
                                        <div class="accordion-item offer-item-{{$offer}} display-none">
                                            
                                            <h2 class="accordion-header" id="offer-heading-{{$key}}">
                                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#offer-{{$key}}"
                                                aria-expanded="true" aria-controls="offer-{{$key}}">
                                                {{$offer}}
                                              </button>
                                            </h2>
                                            <div id="offer-{{$key}}" class="accordion-collapse collapse" aria-labelledby="offer-heading-{{$key}}"
                                              data-bs-parent="#project-offers">
                                              <div class="accordion-body">
                                                  <div class="repeatable-wrapper">
                                                    <div class="repeatable-fields">
                                                      <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                        <div class="row">
                                                          <div class="col-md-4">
                                                            <div class="form-group">
                                                              <label class="form-label">Title <span>*</span></label>
                                                              <input type="text" name="{{$offer}}[title][]" class="form-control" required>
                                                            </div>
                                                          </div>
                                                          <div class="col-md-4">
                                                            <div class="form-group">
                                                              <label class="form-label">Area <span>*</span></label>
                                                              <input type="number" name="{{$offer}}[area][]" class="form-control" required>
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
                                                              <input type="number" name="{{$offer}}[price_from][]" class="form-control" min="0" required>
                                                            </div>
                                                          </div>
                                                          <div class="col-md-2">
                                                            <div class="form-group">
                                                              <label class="form-label">Amount in</label>
                                                              <select name="{{$offer}}[price_type_from][]" id="price_type_from_{{$offer}}" class="form-control select2" required>
                                                                
                                                                @foreach($price_types as $key => $price_type)
                                                                    <option value="{{ $price_type }}" {{ old('price_type_from', $project->price_type_from ?? '') === $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                          </div>
                                                          <div class="col-md-2">
                                                            <div class="form-group">
                                                              <label class="form-label">Price To <span>*</span></label>
                                                              <input type="number" name="{{$offer}}[price_to][]" class="form-control" min="0" required>
                                                            </div>
                                                          </div>
                                                          <div class="col-md-2">
                                                            <div class="form-group">
                                                              <label class="form-label">Amount in</label>
                                                              <select name="{{$offer}}[price_type_to][]" id="price_type_to_{{$offer}}" class="form-control select2" required>
                                                                
                                                                @foreach($price_types as $key => $price_type)
                                                                    <option value="{{ $price_type }}" {{ old('price_type_to', $project->price_type_to ?? '') === $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                          </div>
                                                          
                                                        </div>

                                                        <!-- Remove Button -->
                                                        <div class="text-end mt-2">
                                                            <button type="button" class="btn btn-danger btn-sm remove-group">Remove</button>
                                                        </div>
                                                      </div>
                                                    </div>

                                                    <!-- Add More Button -->
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
                                    <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label class="form-label">Title</label>
                                              <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" required>
                                          </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                              <label class="form-label">Upload Image</label>
                                              <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" required>
                                          </div>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                          <button type="button" class="btn btn-danger remove-group">×</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <button type="button" class="btn btn-primary mt-2 btn-sm add-more"><i class="fa fa-plus"></i> Add More</button>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="form-label">Payment Plan</label>
                                      <input type="file" name="payment_plan[]" class="form-control" accept="image/*" required multiple="">
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
    console.log($group);
    $wrapper.find('.repeatable-fields').append($group);
  });

  // Handle Remove within groups
  $('.repeatable-wrapper').on('click', '.remove-group', function () {
    let $fields = $(this).closest('.repeatable-fields');
    if ($fields.find('.repeatable-group').length > 1) {
      $(this).closest('.repeatable-group').remove();
    }
  });
});
</script>

@endsection

