@foreach($projects as $key => $project)
  @php
      $gallery = $project->getMedia('project_gallery');
      $firstImage = $gallery->first();  // Get the first media
      $remainingImages = $gallery->slice(1);  // Skip the first media
  @endphp
  <div data-aos="fade-up" class="col-md-4 {{ ($key <= 1) ? 'mb-3 mb-md-0' : '' }}">
      <div class="project-div position-relative">
          <a href="#" class="launch-btn">{{ $project->offering }}</a>
          <a href="{{ route('project.show', $project->slug) }}">
              @if(!empty($firstImage))
                  <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
              @else
                  <img src="{{ asset('public/assets/img/no-image_1024x786x.png') }}" alt="No Image" style="border-radius: 20px 20px 0px 0px;" width="100%">
                  
              @endif
              
          </a>
          <div class="p-4">
             <a href="{{ route('project.show', $project->slug) }}">
             <h6>{{ $project->project_title }}</h6>
             </a>
             <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $project->location }}</p>
             <p class="mb-4">
                {{ $project->offers->min('area') }} - {{ $project->offers->max('area') }} {{ $project->offers->first()->area_type }} | {{ $project->offering }}
             </p>
             <hr>
             <div class="row mt-4 align-items-center">
                <div class="col-8">
                   <h6 class="crore-h">
                      {{ $project->price_range['min']['amount'] .' '. $project->price_range['min']['unit'] }}
                       <span style="font-weight: 400; font-size: 13px;">Starting Price</span></h6>
                </div>
               
                <div class="col-4 text-end">
                   <span class="heart-btn"><a href="javascript:;" class="add-to-compare" data-id="{{ $project->id }}" data-title="{{ $project->project_title }}" title="Compare"><i class="fa fa-exchange"></i> </a></span>
                </div>
             </div>
          </div>
      </div>
  </div>
@endforeach