@if($projects->count())
    <p>{{ $projects->firstItem() }} to {{ $projects->lastItem() }} out of {{ $projects->total() }} projects</p>

    @foreach($projects as $project)
        <div class="col-md-12 mb-3 mb-4">
            <div class="project-div position-relative row g-0">
                <div class="col-md-4">
                    <a href="#" class="launch-btn">{{ $progress[$project->progress] }}</a>
                    <a href="{{ route('project.show', $project->slug) }}" class="card-img">
                        @php
                                                  
                            $gallery = $project->getMedia('project_gallery');
                            $firstImage = $gallery->first();  // Get the first media
                             
                        @endphp
                        @if(!empty($firstImage))
                            <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" alt="" width="100%">
                        @else
                            <img src="{{ asset('public/assets/img/no-image-1080x1080.png') }}" alt="" width="100%">
                        @endif
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="p-4">
                        <a href="{{ route('project.show', $project->slug) }}"><h6>{{ $project->project_title }}</h6></a>
                        <div class="logo-builder">
                            @if($project->logo_url)
                                <img src="{{ asset('public/'.$project->logo_url) }}" alt="Project Image"  >
                            @else
                                 <img src="{{ asset('public/assets/img/no-image-1080x1080.png') }}" alt="Builder Image">               
                            @endif

                        </div>
                        <p class="loc-txt"><i class="fa fa-map-marker"></i> {{ $project->location }}</p>
                        <p class="mb-3">{!! \Illuminate\Support\Str::limit(strip_tags($project->description), 100) !!}...</p>
                        <ul class="amenities">
                            <li><i class="fa fa-user"></i> {{ $project->builder->builder_name ?? 'N/A' }}</li>
                            <li><i class="fa fa-building"></i> {{ $project->offering }}</li>
                            <li><i class="fa fa-arrows"></i> {{ $project->offers->min('area') }} - {{ $project->offers->max('area') }} {{ $project->offers->first()->area_type }}</li>
                        </ul>
                        <hr>
                        <div class="row mt-4 align-items-center">
                            <div class="col-4">
                                <h6 class="crore-h"><span style="font-size: 13px;">Starting Price</span><br>{{ $project->offers->min('price_from') }} {{ $project->offers->first()->price_from_in_format }}</h6>
                            </div>
                            
                            <div class="col-8 text-end">
                                <a href="javascript:;" class="detail-btn btn-red addToCompare" data-id="{{ $project->id }}" data-title="{{ $project->project_title }}">Compare</a>
                                
                                <a href="{{ route('project.show', $project->slug) }}" class="detail-btn">More Details</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {!! $projects->links('vendor.pagination.custom') !!}
@else
    <p>No projects found.</p>
@endif
