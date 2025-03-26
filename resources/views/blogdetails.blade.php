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
                 
              </div>
              
            </div>
           
          </div>

        </div>
    </header>

      
    <div class="content">
        <section class="about pt-5">
          <div class="container">
          
          <div class="row pt-md-5">
          <div class="col-md-12">
              <img src="{!! url('public') !!}/{{$data->file_url}}" class="w-100">
              <!--<p class="muted">Postad: {{$data->created_at->format('Y-M-d')}}</p>-->
          </div>
          <div class="col-md-12 pt-md-4">
            <p>
              {!! ($data->description) !!}</p>



          </div>

          </div>
          </div>
        </section><!---about sec--->

        

        <section class="team pt-md-5 pb-5 mb-5">
            <div class="container pt-3">
              <h1 class="main-heading text-left mt-5"><span>RELATED </span>BLOGG</h1>
              <div class="row pt-5">
                <div class="col-md-12">
                  <div class="teams1 row">

                    @if(!empty($related_records))
                        @foreach($related_records as $key => $record)
                    
                            <div class="col-md-4">
                              <div class="team-group m-0">
                                <div class="team-pic"><img src="{!! url('public') !!}/{{$record->file_url}}"></div>
                                <div class="team-content text-left pl-4">
                                  <h3>{!! $record->title !!}</h3>
                                  <p>{!! nl2br($record->short_description) !!}</p>
                                  <a href="{{url('blog')}}/{{$record->id}}" class="btn btn-success2 mt-1 mb-4">Läs mer</a>
                                </div>
                              </div>
                            </div><!--slide-->

                        @endforeach
                    @endif


                  </div>
                </div>

              </div>
            </div>
        </section>


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