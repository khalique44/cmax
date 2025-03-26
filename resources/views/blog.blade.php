@extends('layouts.app')

  
@section('content')

@if(!empty($header_image))



@endif
    <header class="header-main header-inner" <?php echo !empty($header_image) ? 'style="background: url('.$header_image.'); min-height: 54vh"' : ""; ?> >
        <div class="container">
            
          @include('layouts.includes.nav')

          <div class="slid-header pt-md-5 pb-md-4 mx-auto">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                 <h1 class="display-4 mt-2 mt-md-5 mt-lg-5">@if(!empty($data->title)) {!!html_entity_decode($data->title)!!} @endif</h1>
                 <p class="lead-c text-center w-100">@if(!empty($data->description)) {!!html_entity_decode($data->description)!!} @endif</p>
              </div>
              
            </div>
           
          </div>

        </div>
    </header>

      
    <div class="content">
        <section class="about pt-5 pb-5">
          <div class="container">
            <div class="row pt-md-5">
              @if(!empty($records))
                @foreach($records as $key => $record)
                  <div class="col-md-4">
                      <div class="om-box">
                          
                             <div class="om-box">
                              <img src="{!! url('public') !!}/{{$record->file_url}}">
                             </div>
                            <div class="om-text">
                              <h3><strong>{!! $record->title !!}</strong></h3>
                              <p>{!! nl2br($record->short_description) !!}</p>
                              <a href="{{url('blog')}}/{{$record->id}}" class="btn btn-success2 mt-4">Läs mer</a>
                            </div>
                         
                     </div>
                    
                  </div>
                @endforeach
              @endif
              

            </div>
          </div>
        </section><!---about sec--->
      </div><!---content--->
    @include('layouts.includes.footer')   





<a href="#" id="gotop"><i class="fa-solid fa-chevron-up"></i></a>





    <script>
    $(window).scroll(function(){
        if ($(window).scrollTop() >= 300) {
            $('#navbar').addClass('sticky');
        }
        else {
            $('#navbar').removeClass('sticky');
        }
    });
    </script>

    <script>
    $(document).ready(function(){
 
 //Check to see if the window is top if not then display button
 $(window).scroll(function(){
  // Show button after 100px
  var showAfter = 100;
  if ($(this).scrollTop() > showAfter ) { 
   $('#gotop').fadeIn();
  } else { 
   $('#gotop').fadeOut();
  }
 });
 
 //Click event to scroll to top
 $('#gotop').click(function(){
  $('html, body').animate({scrollTop : 0},100);
  return false;
 });
 
});


    </script>
       
 @endsection