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
                    <a href="#" class="launch-btn red-bg position-static">Under construction</a>
                    <a href="#" class="launch-btn position-static">Appartments</a>
               </div>
               <h1 class="mt-2 mainhead-inner">{{ $project->project_title }}</h1>
               <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $project->location }} <a href="#">See on the Map</a></p>

            </div>
            <div class="col-md-5 text-end">
                <h2 class="Starting-price mb-4"><span>Starting From</span>{{ $project->offers->min('price_from') }} {{ $project->offers->first()->price_from_in_format }} </h2>
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

            <div class="col-md-6"><a href="{{   \App\Http\Helpers\GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" data-lightbox="gallery-group"><img src="{{   \App\Http\Helpers\GeneralHelper::getMediaWithPublicDir($firstImage->getUrl()) }}" alt="" class="w-100"></a></div>
            <div class="col-md-6">
                <div class="row">
                  @foreach($remainingImages as $key => $media)
                    <div class="col-md-6">
                      <div class="galleria-inside">
                          <a href="{{   \App\Http\Helpers\GeneralHelper::getMediaWithPublicDir($media->getUrl()) }}" data-lightbox="gallery-group"><img src="{{   \App\Http\Helpers\GeneralHelper::getMediaWithPublicDir($media->getUrl()) }}" alt="" class="w-100"></a>
                          @if($project->getMedia('project_gallery')->count() == $key+1)
                            <a href="#" class="btn-showgal"><img src="{{ asset('public/assets/img/gallery-iconwhite.png') }}" alt=""> Show all photos</a>
                          @endif
                      </div>
                    </div>
                  @endforeach
                    <!-- <div class="col-md-6">
                      <div class="galleria-inside">
                        <a href="{{ asset('public/assets/img/gallry3.jpg') }}" data-lightbox="gallery-group"><img src="{{ asset('public/assets/img/gallry3.jpg') }}" alt="" class="w-100"></a></div>
                    </div>
                    <div class="col-md-6">
                      <div class="galleria-inside">
                        <a href="{{ asset('public/assets/img/gallry4.jpg') }}" data-lightbox="gallery-group"><img src="{{ asset('public/assets/img/gallry4.jpg') }}" alt="" class="w-100"></a></div>
                    </div>
                    <div class="col-md-6">
                      <div class="galleria-inside ">
                        <a href="{{ asset('public/assets/img/gallry5.jpg') }}" data-lightbox="gallery-group"><img src="{{ asset('public/assets/img/gallry5.jpg') }}" alt="" class="w-100"></a>
                        
                      </div>
                    </div> -->
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
                            <a class="nav-link" href="#features">Features</a>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link" href="#location">Location</a>
                          </li>
                        </ul>
                      </nav>
                </div>

                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="scrollspy-example" tabindex="0">
                    <div class="sec-gal mt-5" id="overview">
                        <h3 class="mb-3">Propert Overview</h3>
                        <p>Experience the best with our premium listing. Contact us to learn more and see why it’s exceptional. Discover standout features and how they align perfectly with your needs. We’re excited to showcase this offer and guide you through the next steps to secure your ideal property with confidence and ease.</p>
                    </div>
                    
                    <div class="sec-gal mt-4" id="poverview">
                        <h3 class="mb-3">Propert Overview</h3>
                        <ul class="listwith">
                            <li><span>Property Id</span> 57C6</li>
                            <li><span>Rooms</span> 3, 4 & 5</li>
                            <li><span>Location</span> Scheme 33, Karachi</li>
                            <li><span>Added Times	1 Years</span> 57C6</li>
                            <li><span>Progress</span> Underconstruction</li>
                            <li><span>Types</span> Apartment</li>
                            <li><span>Price Range</span> 1 crore - 1 crore 80 lakh </li>
                        </ul>
                    </div>
                    <div class="sec-gal mt-4" id="unitt">
                        <h3 class="mb-3">Unit Types</h3>
                        <div class="sqrft">
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
                        </ul>

                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Payment Plan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Floor Plan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Unit Types</button>
                                </li>
                              </ul>
                              <div class="tab-content pt-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <h5>Payment Plan</h5>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <h5>Floor Plan</h5>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <h5>Unit Types</h5>
                                </div>
                              </div>
                        </div>

                    </div>

                    <div class="sec-gal mt-4" id="features">
                        <h3 class="mb-3">Amenities & Facilities</h3>
                        <ul class="checked_list">
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Prayer Area
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Park
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Play Area
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Commerical Area
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Hospital
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Educational Area
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Educational Area
                            </li>
                        </ul>
                    </div>
                    <div class="sec-gal mt-4" id="features">
                        <h3 class="mb-3">Utilities</h3>
                        <ul class="checked_list">
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Electricity
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Gas
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Water
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Maintanence
                            </li>
                            
                        </ul>
                    </div>

                    <div class="sec-gal mt-4" id="features">
                        <h3 class="mb-3">Project Attachments</h3>
                        
                        <div class="down-btn pt-3">
                            <a href="#" class="btn btn-red">
                                <svg xmlns="http://www.w3.org/2000/svg') }}" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M28 24v-4a1 1 0 0 0-2 0v4a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-4a1 1 0 0 0-2 0v4a3 3 0 0 0 3 3h18a3 3 0 0 0 3-3zm-6.38-5.22-5 4a1 1 0 0 1-1.24 0l-5-4a1 1 0 0 1 1.24-1.56l3.38 2.7V6a1 1 0 0 1 2 0v13.92l3.38-2.7a1 1 0 1 1 1.24 1.56z" data-name="Download" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                Download Attachment</a>
                        </div>

                    </div>

                    <div class="sec-gal mt-4" id="location">
                        <h3 class="mb-3">Project Location</h3>
                        <div class="inside-map pt-4">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d212134.3798621259!2d66.73185119453126!3d24.827262700000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb3393e94175b1b%3A0x3a801b93118d7332!2sCmax.pk%20Scheme%2033%20Karachi!5e1!3m2!1sen!2s!4v1746400095231!5m2!1sen!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

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
  
  <section class="py-5">
    <div class="container">
       <div class="row text-center pb-3">
          <h5 class="sub-h">See More</h5>
          <h2 class="main-h">Related Projects</h2>
       </div>
       <div class="row">
          <div data-aos="fade-up" class="col-md-4 mb-3 mb-md-0">
             <div class="project-div position-relative">
                <a href="#" class="launch-btn">New Launch</a>
                <a href="#">
                <img src="{{ asset('public/assets/img/pp-1.png') }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
                </a>
                <div class="p-4">
                   <a href="#">
                   <h6>Chapal Courtyard 1</h6>
                   </a>
                   <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> 42 Avenue O, Brooklyn</p>
                   <p class="mb-4">
                      950 - 1450 Sq ft | Flats
                   </p>
                   <hr>
                   <div class="row mt-4 align-items-center">
                      <div class="col-8">
                         <h6 class="crore-h">1 Crore <span style="font-weight: 400; font-size: 13px;">Starting Price</span></h6>
                      </div>
                      <div class="col-4 text-end">
                         <span class="heart-btn"><i class="fa fa-heart" aria-hidden="true"></i></span>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div data-aos="fade-up" class="col-md-4 mb-3 mb-md-0">
             <div class="project-div position-relative">
                <a href="#" class="launch-btn red-bg">Under construction</a>
                <a href="#">
                <img src="{{ asset('public/assets/img/pp-1.png') }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
                </a>
                <div class="p-4">
                   <a href="#"><h6>Chapal Courtyard 1</h6></a>
                   <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> 42 Avenue O, Brooklyn</p>
                   <p class="mb-4">
                      950 - 1450 Sq ft | Flats
                   </p>
                   <hr>
                   <div class="row mt-4 align-items-center">
                      <div class="col-8">
                         <h6 class="crore-h">1 Crore <span style="font-weight: 400; font-size: 13px;">Starting Price</span></h6>
                      </div>
                      <div class="col-4 text-end">
                         <span class="heart-btn"><i class="fa fa-heart" aria-hidden="true"></i></span>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div data-aos="fade-up" class="col-md-4">
             <div class="project-div position-relative">
                <a href="#">
                <img src="{{ asset('public/assets/img/pp-1.png') }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
             </a>
                <div class="p-4">
                   <a href="#">
                   <h6>Chapal Courtyard 1</h6>
                </a>
                   <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> 42 Avenue O, Brooklyn</p>
                   <p class="mb-4">
                      950 - 1450 Sq ft | Flats
                   </p>
                   <hr>
                   <div class="row mt-4 align-items-center">
                      <div class="col-8">
                         <h6 class="crore-h">1 Crore <span style="font-weight: 400; font-size: 13px;">Starting Price</span></h6>
                      </div>
                      <div class="col-4 text-end">
                         <span class="heart-btn"><i class="fa fa-heart" aria-hidden="true"></i></span>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
      
    </div>
 </section>

  @include('layouts.includes.footer')     
       
@endsection