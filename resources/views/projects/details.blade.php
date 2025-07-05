@extends('layouts.app')

  
@section('content')


  @include('layouts.includes.nav')
      
  <section class="gallery-area pt-5 pb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="breadcrumbs">
                    <ol class="breadcrumbs">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Projects List</li>
                    </ol>
               </div>
               <div class="position-relative">
                    <a href="#" class="launch-btn red-bg position-static">{{ $progress[$project->progress] }}</a>
                    <a href="#" class="launch-btn position-static">{{ $project->offering }}</a>
               </div>
               <h1 class="mt-2 mainhead-inner">{{ $project->project_title }}</h1>
               <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $project->location }} <a href="#">See on the Map</a></p>

            </div>
            <div class="col-md-5 text-end">
                <h2 class="Starting-price mb-4"><span>Starting From</span>
                    {{ $project->price_range['min']['amount'] .' '. $project->price_range['min']['unit'] }} 
                </h2>
                <div class="d-flex justify-content-end ">
                    <div class="call-btn mb-2">
                        <a href="tel:{{ $project->builder->mobile_number }}">
                            <img src="{{ asset('public/assets/img/phone-icon.svg') }}" alt="">
                            Call</a>
                    </div>
                    <div class="whatsapp-btn mb-3">
                        <a href="tel:{{ $project->builder->mobile_number }}">
                            <img src="{{ asset('public/assets/img/whatsapp-icon.svg') }}" alt="">
                            Whatsapp</a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row galleria mt-3">
          @php
            $gallery = $project->getMedia('project_gallery');
            $firstImage = $gallery->first();  // Get the first media
            $remainingImages = $gallery->slice(1);  // Skip the first media
          @endphp

            <div class="col-md-6">
                @if(!empty($firstImage))
                    <a href="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" data-lightbox="gallery-group">
                        <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" alt="" class="w-100">
                    </a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="row">
                    @if(!empty($remainingImages))
                      @foreach($remainingImages as $key => $media)
                        <div class="col-md-6">
                          <div class="galleria-inside">
                              <a href="{{   GeneralHelper::getMediaWithPublicDir($media->getUrl()) }}" data-lightbox="gallery-group"><img src="{{   GeneralHelper::getMediaWithPublicDir($media->getUrl()) }}" alt="" class="w-100"></a>
                              @if($project->getMedia('project_gallery')->count() == $key+1)
                                <a href="#" class="btn-showgal"><img src="{{ asset('public/assets/img/gallery-iconwhite.png') }}" alt=""> Show all photos</a>
                              @endif
                          </div>
                        </div>
                      @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
  </section>

  <section class="py-5">
     <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="page-navigation">
                    <nav id="navbar-example2" class="navbar navbar-light bg-light">
                        <ul class="nav nav-pills">
                          <li class="nav-item">
                            <a class="nav-link" href="#overview">Overview</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#unitt">Unit Types</a>
                          </li>                          
                          <li class="nav-item dropdown">
                            <a class="nav-link" href="#location">Location</a>
                          </li>
                         
                          @if( $project->floorPlan->count() > 0 )
                              <li class="nav-item dropdown">
                                <a class="nav-link" href="#floorplan">Floor Plan</a>
                              </li>
                          @endif
                        </ul>
                      </nav>
                </div>

                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="scrollspy-example" tabindex="0">
                    <div class="sec-gal mt-5 description-container" id="overview">
                        <h3 class="mb-3">Project Overview</h3>
                        @php
                            $limit = config('constants.project_text_limit'); // Limit characters
                            $description = $project->description;
                        @endphp
                        <div class="">
                            <div class="short-description">
                                {!! \Illuminate\Support\Str::limit($description, $limit) !!}
                            
                            </div>
                            <div class="full-description" style="display: none;">
                                {!! $description !!}
                            </div>

                            @if(strlen($description) > $limit)
                                <a href="javascript:void(0);" class="toggle-description text-primary">Show more</a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- <div class="sec-gal mt-4" id="poverview">
                        <h3 class="mb-3">Project Overview</h3>
                        <ul class="listwith">
                            <li><span>Property Id</span> 57C6</li>
                            <li><span>Rooms</span> 3, 4 & 5</li>
                            <li><span>Location</span> Scheme 33, Karachi</li>
                            <li><span>Added Times	1 Years</span> 57C6</li>
                            <li><span>Progress</span> Underconstruction</li>
                            <li><span>Types</span> Apartment</li>
                            <li><span>Price Range</span> 1 crore - 1 crore 80 lakh </li>
                        </ul>
                    </div> -->
                    <div class="sec-gal mt-4" id="unitt">
                        @php
                            $offering = explode(",",$project->offering);
                        @endphp
                        @foreach($offering as $offer)
                            <h3 class="mb-3">{{ $offer }} <span class="offer-price">

                                {{ $project->min_max }}
                                </span></h3>
                            <!-- <div class="sqrft">
                                <span>Type A - 541 Sq ft</span>
                                <span>Type B - 541 Sq ft</span>
                                <span>Type C - 541 Sq ft</span>
                                <span>2 Bedroom, Lounge & Drawing</span>
                            </div>

                            <ul class="listwith">
                                <li><span>Property Id</span> 57C6</li>
                                <li><span>Rooms</span> 2, 3 & 4</li>
                                <li><span>Location</span> Scheme 33, Karachi</li>
                                <li><span>Added Times	1 Years</span> 57C6</li>
                                <li><span>Progress</span> Underconstruction</li>
                                <li><span>Types</span> Apartment</li>
                            </ul> -->

                            <div>
                                <ul class="nav nav-tabs" id="myTab-{{ $offer }}" role="tablist">
                                    @if(!empty($project->offers))
                                        @foreach($project->offers as $key => $savedOffer)
                                            @if($savedOffer->offer == strtolower($offer))
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link {{ ($key == 0) ? 'active' : '' }}" id="offer-tab-{{ $savedOffer->id }}" data-bs-toggle="tab" data-bs-target="#home-offer-tab-{{ $savedOffer->id }}" type="button" role="tab" aria-controls="home-offer-tab-{{ $savedOffer->id }}" aria-selected="true">{{ $savedOffer->title }}</button>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                  </ul>
                                  <div class="tab-content pt-4" id="myTabContent-{{ $offer }}">
                                    @if(!empty($project->offers))
                                        @foreach($project->offers as $key => $savedOffer)
                                            @if($savedOffer->offer == strtolower($offer))
                                                <div class="tab-pane fade {{ ($key == 0) ? 'show active' : '' }}" id="home-offer-tab-{{ $savedOffer->id }}" role="tabpanel" aria-labelledby="offer-tab-{{ $savedOffer->id }}">
                                                    <ul class="listwith">
                                                        <li><span>Area Size</span> {{ $savedOffer->area }} {{ $savedOffer->area_type }}</li>
                                                        @if($offer != 'Plots' && $offer != 'Offices' && $offer != 'Shops')
                                                            <li><span>BedRooms</span> {{ $savedOffer->bedrooms }}</li>
                                                            <li><span>BathRooms</span> {{ $savedOffer->bathrooms }}</li>
                                                        @endif
                                                        <li><span>Price</span> 
                                                            <strong>
                                                                @if($savedOffer->price_from != $savedOffer->price_to)

                                                                    {{ GeneralHelper::cleanDecimal($savedOffer->price_from) }}
                                                                     {{ $savedOffer->price_from_in_format }} to
                                                                    {{ $savedOffer->price_to }} {{ $savedOffer->price_to_in_format }}
                                                                @else
                                                                    {{ GeneralHelper::cleanDecimal($savedOffer->price_from) }}
                                                                    {{ $savedOffer->price_from_in_format }}

                                                                @endif
                                                            </strong>

                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                    
                                  </div>
                            </div>
                        @endforeach

                    </div> 

                    <div class="sec-gal mt-4" id="location">
                        <h3 class="mb-3">Project Location</h3>
                        <div class="inside-map pt-4">
                            @php 
                                $latitude = $project->latitude;
                                $longitude = $project->longitude;
                            @endphp
                            <iframe 
                                width="100%" 
                                height="300" 
                                frameborder="0" 
                                style="border:0"
                                src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=es;z=14&output=embed"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            
                        </div>
                    </div>                 
                    
                    @if($project->floorPlan->count() > 0)
                        <div class="sec-gal mt-4" id="floorplan">
                            <h3 class="mb-3">Floor Plans</h3>
                            <div>
                                <ul class="nav nav-tabs" id="myTab-floorplan" role="tablist">
                                    
                                    @foreach($project->floorPlan as $key => $floorPlan)
                                        
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link {{ ($key == 0) ? 'active' : '' }}" id="floorplan-tab-{{ $floorPlan->id }}" data-bs-toggle="tab" data-bs-target="#home-floorplan-tab-{{ $floorPlan->id }}" type="button" role="tab" aria-controls="home-floorplan-tab-{{ $floorPlan->id }}" aria-selected="true">{{ $floorPlan->title }}</button>
                                        </li>
                                        
                                    @endforeach
                                    
                                    
                                  </ul>
                                  <div class="tab-content pt-4" id="myTabContent-floorplan">
                                    
                                    @foreach($project->floorPlan as $key => $floorPlan)
                                        
                                        <div class="tab-pane fade {{ ($key == 0) ? 'show active' : '' }}" id="home-floorplan-tab-{{ $floorPlan->id }}" role="tabpanel" aria-labelledby="floorplan-tab-{{ $floorPlan->id }}">
                                            <div>
                                                @if($floorPlan->media_url)
                                                    <a href="{{ asset('public/'.$floorPlan->media_url) }}" data-lightbox="gallery-group" class="card-img">
                                                        
                                                            <img src="{{ asset('public/'.$floorPlan->media_url) }}" alt="" width="50%">
                                                        
                                                        
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    @endforeach   
                                    
                                  </div>
                            </div>
                        </div>
                    @endif

                    <!-- <div class="sec-gal mt-4" id="attachments">
                        <h3 class="mb-3">Attachments</h3>
                        
                        <div class="down-btn pt-3">
                            <a href="#" class="btn btn-red">
                                <svg xmlns="http://www.w3.org/2000/svg') }}" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M28 24v-4a1 1 0 0 0-2 0v4a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-4a1 1 0 0 0-2 0v4a3 3 0 0 0 3 3h18a3 3 0 0 0 3-3zm-6.38-5.22-5 4a1 1 0 0 1-1.24 0l-5-4a1 1 0 0 1 1.24-1.56l3.38 2.7V6a1 1 0 0 1 2 0v13.92l3.38-2.7a1 1 0 1 1 1.24 1.56z" data-name="Download" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                Download Attachment</a>
                        </div>

                    </div> -->

                    

                </div>

            </div>



            <div class="col-md-3">

                <div class="calculator_budget">
                    <div class="text-center pb-3">
                        <h2 class="main-h mb-4">Get In Touch</h2>

                        <form class="calc-form">
                            <div class="form-group mt-3">
                                <input type="text" placeholder="Name" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" placeholder="Contact Number" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" placeholder="Provide your address" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <select name="" id="" class="form-select">
                                    <option value="">Select Unit</option>
                                    <option value="">Option</option>
                                </select>
                            </div>
                            
                            <div class="form-group mt-3">
                                <textarea name="" id="" placeholder="Message" class="form-textarea"></textarea>
                            </div>
                            
                            <div class="form-group mt-3">
                                <button class="btn btn-red w-100">Project In This Budget</button>
                            </div>
                        </form>

                     </div>
                </div>
            </div>
            
        </div>
        
     </div>
  </section>
@if($related_projects->count() > 0)
    <section class="py-5">
        <div class="container">
           <div class="row text-center pb-3">
              <h5 class="sub-h">See More</h5>
              <h2 class="main-h">Related Projects</h2>
           </div>
           <div class="row">
            @foreach($related_projects as $key => $related_project)
            @php
                $gallery = $related_project->getMedia('project_gallery');
                $firstImage = $gallery->first();  // Get the first media
                $remainingImages = $gallery->slice(1);  // Skip the first media
            @endphp
                <div data-aos="fade-up" class="col-md-4 {{ ($key <= 1) ? 'mb-3 mb-md-0' : '' }}">
                    <div class="project-div position-relative">
                        <a href="#" class="launch-btn">{{ $related_project->offering }}</a>
                        <a href="{{ route('project.show', $related_project->slug) }}">
                            @if(!empty($firstImage))
                                <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
                            @else
                                <img src="{{ asset('public/assets/img/no-image_1024x786x.png') }}" alt="No Image" style="border-radius: 20px 20px 0px 0px;" width="100%">
                                
                            @endif
                            
                        </a>
                        <div class="p-4">
                           <a href="{{ route('project.show', $related_project->slug) }}">
                           <h6>{{ $related_project->project_title }}</h6>
                           </a>
                           <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $related_project->location }}</p>
                           <p class="mb-4">
                              {{ $related_project->offers->min('area') }} - {{ $related_project->offers->max('area') }} {{ $related_project->offers->first()->area_type }} | {{ $related_project->offering }}
                           </p>
                           <hr>
                           <div class="row mt-4 align-items-center">
                              <div class="col-8">
                                 <h6 class="crore-h">
                                    {{ $related_project->price_range['min']['amount'] .' '. $related_project->price_range['min']['unit'] }}
                                     <span style="font-weight: 400; font-size: 13px;">Starting Price</span></h6>
                              </div>
                              <div class="col-4 text-end">
                                 <span class="heart-btn"><i class="fa fa-heart" aria-hidden="true"></i></span>
                              </div>
                           </div>
                        </div>
                    </div>
                </div>
            @endforeach
              
           </div>
          
        </div>
    </section>
@endif

  @include('layouts.includes.footer')     
       
@endsection