@extends('layouts.app')

  
@section('content')


@include('layouts.includes.nav')




<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">

                <div class="filter-group">
                    <select class="filter-select select2 compare-select-box" multiple="" data-placeholder="Select Project">
                        @if(count($allProjects) > 0)
                            @foreach($allProjects as $project)
                                <option value="{{ $project->id }}" {{ in_array($project->id,$compare) ? 'selected' : '' }}>{{ $project->project_title }}</option>
                            @endforeach
                        @endif
                        
                    </select>
                    <span class="dropdown-arrow">▼</span>
                </div>

            </div>
            <div class="text-center"><button class="add-to-compare" onclick="addCompareMultiple();">Add to Compare</button></div>
        </div>

        @if(count($projects) > 1)
        <!-- Comparison Container -->
            <div class="comparison-container cols-{{ count($projects) }}">
                <div class="property-headers">
                    <div class="empty-header"></div>

                    {{-- Loop over each project --}}
                    @foreach($projects as $project)
                        @php
                            $gallery = $project->getMedia('project_gallery');
                            $firstImage = $gallery->first();  // Get the first media
                        @endphp
                        <div class="property-header">
                            <h2 class="property-title">
                                {{ strtoupper($project->project_title) }}
                            </h2>
                            @if(!empty($firstImage))
                                <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) ?? asset('assets/img/default.jpg') }}"
                                 alt="{{ $project->project_title }}"
                                 class="property-image">
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Location Row -->
                <div class="comparison-row">
                    <div class="row-label">Location</div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            <span class="location-icon">📍</span>
                            {{ $project->location }}
                        </div>
                    @endforeach
                </div>

                <!-- Builder Row -->
                <div class="comparison-row">
                    <div class="row-label">Builder</div>
                    @foreach($projects as $project)
                        <div class="row-value">{{ $project->builder->builder_name ?? ''}}</div>
                    @endforeach
                </div>

                <!-- Status Row -->
                <div class="comparison-row">
                    <div class="row-label">Progress</div>
                    @foreach($projects as $project)
                        <div class="row-value {{ $project->progress == 'ready' ? 'status-ready' : 'status-construction' }}">
                            {{ config('constants.progress.'.$project->progress) }}
                        </div>
                    @endforeach
                </div>

                <!-- Project Unit Row -->
                <div class="comparison-row">
                    <div class="row-label">Project Unit</div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            <span class="unit-type">
                                {{ $project->offering }} 
                                <span class="dropdown-small">▼</span>
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Unit Type Row -->
                <div class="comparison-row">
                    <div class="row-label">Unit Type</div>
                    @foreach($projects as $project)
                        <div class="row-value"></div>
                    @endforeach
                </div>

                <!-- Installment Plan -->
                <div class="comparison-row">
                    <div class="row-label">Installment Plan</div>
                    @foreach($projects as $project)
                        <div class="row-value text-center">
                            @if($project->installment_plan)
                                <a href="{{ $project->installment_plan }}" class="btn btn-red">Download</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Bed Dimensions -->
                <div class="comparison-row">
                    <div class="row-label">
                        <span class="bed-icon"><i class="fa fa-bed"></i></span>
                        Bed
                    </div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            <table class="dimensions-table">
                                <thead class="dimensions-header">
                                    <tr>
                                        <th>No of Rooms</th>
                                        <th>Dimensions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->offers as $index => $savedOffer)
                                        <tr class="dimensions-row">
                                            <td>{{ $savedOffer->bedrooms }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>

                <!-- Amenities -->
                <div class="comparison-row">
                    <div class="row-label">Features</div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            @foreach($project->features as $feature)
                                <span class="badge bg-dark">{{ $feature->name }}</span>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="comparison-row">
                    <div class="row-label"></div>
                    @foreach($projects as $project)
                        <div class="row-value ">
                            <a href="javascript:;" class="detail-btn btn-grey text-center"  onclick="removeCompare('{{ $project->id }}')" title="Remove from Compare">Remove</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif(count($projects) == 1)
            <div class="text-center"><h5>Please add minimum 2 projects to Compare!</h5></div>
        @else
            <div class="text-center"><h5>No projects selected for comparison.</h5></div>
        @endif

    </div>
</section>

  @include('layouts.includes.footer')     
       
@endsection