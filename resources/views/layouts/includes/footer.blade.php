<?php

$footer_logo = App\Http\Helpers\RosenHelper::getOption('footer_logo');
$footer_text_under_logo = App\Http\Helpers\RosenHelper::getOption('footer_text_under_logo');
$footer_center_column_heading = App\Http\Helpers\RosenHelper::getOption('footer_center_column_heading');
$footer_last_column_heading = App\Http\Helpers\RosenHelper::getOption('footer_last_column_heading');
$copy_right_text = App\Http\Helpers\RosenHelper::getOption('copy_right_text');
$phone_number = App\Http\Helpers\RosenHelper::getOption('phone_number');
$address = App\Http\Helpers\RosenHelper::getOption('address');
$email_address = App\Http\Helpers\RosenHelper::getOption('email_address');
$google_map_link = App\Http\Helpers\RosenHelper::getOption('google_map_link');
$facebook_url = App\Http\Helpers\RosenHelper::getOption('facebook_url');
$posts = App\Post::where('status','yes')->latest()->take(5)->get();
?>


<footer class="pt-5" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col1">
        <img src="@if(!empty($header_logo))  {!! url('public') !!}/{{$header_logo}} @else {!! url('public/assets/images/logo-white.png') !!} @endif" class="mb-4">
        <p class="text-light">{{$footer_text_under_logo}}</p>
        <div class="social">
            <a href="{{$facebook_url}}" class="social1"><i class="fab fa-facebook-f"></i></a>
          </div>
      </div>
      <div class="col-md-4">
        <h3 class="mb-4">{{$footer_center_column_heading}}</h3>
        <ul>
          @if(!empty($posts))
            @foreach($posts as $post)
              <li><a href="{{url('blog')}}/{{$post->id}}">{{$post->title}}</a></li>
            @endforeach
          @endif
        </ul>

      </div>

      <div class="col-md-4">
        <h3 class="mb-4">{{$footer_last_column_heading}}</h3>
        <p><a href="tel:073-83 00 666"><img src="{!! url('public/assets/images/phone-call1.svg') !!}"> {{$phone_number}}</a></p>
        <p><a href="mailto:thomasabardin@hotmail.com"><img src="{!! url('public/assets/images/mail1.svg') !!}"> {{$email_address}}</a></p>
        <p><a href="{{$google_map_link}}" target="_blank"><img src="{!! url('public/assets/images/placeholder.svg') !!}"> {!! nl2br(e($address)) !!}</a></p>

      </div>


    </div>
    
  </div>
  <div class="bottom-bar mt-4 py-3">
      <div class="text-light text-center">
          {{$copy_right_text}}
      </div>
    </div>
</footer>

<a href="#" id="gotop"><i class="fa-solid fa-chevron-up"></i></a>


