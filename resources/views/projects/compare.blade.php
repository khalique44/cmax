@extends('layouts.app')

  
@section('content')


@include('layouts.includes.nav')




<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">

                <div class="filter-group">
                    <select class="filter-select">
                        <option>Select Project</option>
                        <option>Chapal Courtyard 1</option>
                        <option>Chapal Grande Vista</option>
                        <option>Other Projects</option>
                    </select>
                    <span class="dropdown-arrow">▼</span>
                </div>




            </div>
            <div class="text-center"><button class="add-to-compare">Add to Compare</button></div>
        </div>

        <!-- Comparison Container -->
        <div class="comparison-container cols-{{ count($projects) }}">
            <div class="property-headers">
                <div class="empty-header"></div>

                {{-- Loop over each project --}}
                @foreach($projects as $project)
                    <div class="property-header">
                        <h2 class="property-title">
                            {{ strtoupper($project->name) }}
                        </h2>
                        <img src="{{ $project->image_url ?? asset('assets/img/default.jpg') }}"
                             alt="{{ $project->name }}"
                             class="property-image">
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
                    <div class="row-value">{{ $project->builder->name ?? ''}}</div>
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
                <div class="row-label">Unit Type</div>
                @foreach($projects as $project)
                    <div class="row-value">
                        <span class="unit-type">
                            {{ $project->offering }} {{ $project->unit_size }}
                            <span class="dropdown-small">▼</span>
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Unit Type Row -->
            <div class="comparison-row">
                <div class="row-label">Unit Type</div>
                @foreach($projects as $project)
                    <div class="row-value">{{ $project->unit_type }}</div>
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
                                    <th>S. No</th>
                                    <th>Dimensions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->bed_dimensions as $index => $dim)
                                    <tr class="dimensions-row">
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $dim }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>

            <!-- Amenities -->
            <div class="comparison-row">
                <div class="row-label">Amenities</div>
                @foreach($projects as $project)
                    <div class="row-value">
                        @foreach($project->amenities as $amenity)
                            <span class="badge bg-dark">{{ $amenity }}</span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

  @include('layouts.includes.footer')     
       
@endsection