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
                                        <label class="form-label">Progress<span>*</span></label>
                                        <select name="progress" id="progress" class="form-control select2" required>
                                            <option value="">Select Progress</option>
                                            @foreach($progress as $key => $prog)
                                                <option value="{{ $key }}" {{ old('progress', $project->progress ?? '') === $key ? 'selected' : '' }}>{{ ucfirst($prog) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                        <button type="submit" class="btn btn-primary mt-3">{{ isset($project) ? 'Update' : 'Save & Add Properties' }}</button>
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

/*let map;
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
google.maps.event.addDomListener(window, 'load', initMap);*/


</script>
@endsection

