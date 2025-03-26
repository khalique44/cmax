

  
<?php $__env->startSection('content'); ?>

<?php if(!empty($header_image)): ?>



<?php endif; ?>
    <header class="header-main" <?php echo !empty($header_image) ? 
    "style='background: url(\"".$header_image."\");'" : ""; ?> >
        <div class="container">
            
            <?php echo $__env->make('layouts.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="slid-header pt-md-5 pb-md-4 mx-auto">
              <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12">
                   <h1 class="display-4 mt-2 mt-md-5 mt-lg-5"><?php if(!empty($data->title)): ?> <?php echo html_entity_decode($data->title); ?> <?php endif; ?></h1>
                   <p class="lead-c"><?php if(!empty($data->description)): ?> <?php echo html_entity_decode($data->description); ?> <?php endif; ?></p>
                   <div><a href="http://rosenivara.se/kontakta" class="btn btn-success2">Kontakta Oss</a></div>
                </div>
                
              </div>
             
            </div>

        </div>
    </header>

      
    <div class="content">
        <section class="about pt-md-5">
          <div class="container">
          <h1 class="main-heading text-center mt-3"><?php if(!empty($data->about_us_title)): ?><?php echo html_entity_decode($data->about_us_title); ?> <?php endif; ?></h1>
          <div class="row pt-md-5">
          <div class="col-md-5">
              <div class="slider-for">
                <?php 
                  if(!empty($aboutUsGallery)) { 
                    foreach ($aboutUsGallery as $key => $value) {   ?>
                     
                    <div>     
                    <?php if($value->is_video == 'no'){ ?>             
                      <img src="<?php echo url('public/'); ?>/<?php echo $value->file_url; ?>">
                      
                        
                      <?php }else{ ?>

                        <video width="555" height="415" >
                            <source src="<?php echo url('public'); ?>/<?php echo e($value->file_url); ?>" type="video/mp4">
                          
                            Your browser does not support the video tag.
                        </video>
                        <a href="#" class="playlets"><i class="fa-regular fa-circle-play"></i></a>

                      <?php } ?>
                      
                    </div>

                  <?php }

                  } ?>
                
             </div>
             <div class="slider-nav">
              <?php 
                if(!empty($aboutUsGallery)) { 
                    foreach ($aboutUsGallery as $key => $value) {   
                      if($value->is_video == 'no'){ ?>
                        <div><img src="<?php echo url('public'); ?>/<?php echo e($value->file_url); ?>"></div>
                      
                      <?php 

                      }else{

                        ?>
                        <div><img src="<?php echo url('public/assets/images/slide-nav.jpg'); ?>"></div>
                      
                      <?php
                      } 
                  }
                } ?>
                
             </div>
          </div>
          <div class="col-md-7 pt-4">
            <?php if(!empty($data->about_us_description)): ?> <?php echo nl2br($data->about_us_description); ?> <?php endif; ?>

              <!--<div class="pt-4 pt-lg-5 pt-md-5"><a href="#" class="btn-success2 pl-5 pr-5">Läs mer</a></div>-->
          </div>

          </div>
          </div>
        </section><!---about sec--->

        <section class="testimonials pt-4 pt-lg-5 pt-md-5">
          <div class="container">
            <h1 class="main-heading text-center mt-3 text-light"><?php if(!empty($data->testimonial_title)): ?><?php echo html_entity_decode($data->testimonial_title); ?> <?php endif; ?></h1>
            <div class="row mt-5 pt-5">
              <div class="col-md-12">
                <div class="for-bgtesti">
                 <div class="testi">
                  <?php if(!empty($testimonials)): ?>
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div>
                      <div class="testi1">
                        <div class="test-pic"><img src="<?php echo url('public/'); ?>/<?php echo e($testimonial->file_url); ?>"></div>
                        <p><?php echo html_entity_decode($testimonial->description); ?></p>
                        <h3><?php echo e(($testimonial->client_name)); ?> <span><?php echo e(($testimonial->designation)); ?></span></h3>
                      </div>
                     </div>
                     
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="team pt-md-5 pb-5 mb-5">
            <div class="container pt-3">
              <h1 class="main-heading text-center mt-5 mt-lg-5 mt-md-0"><?php if(!empty($data->team_member_title)): ?><?php echo html_entity_decode($data->team_member_title); ?> <?php endif; ?></h1>
              <p class="text-center pl-2 pr-2 pl-lg-5 pr-lg-5 pl-md-5 pr-md-5"><?php if(!empty($data->team_member_description)): ?><?php echo html_entity_decode($data->team_member_description); ?> <?php endif; ?></p>
              <div class="row pt-3 pt-lg-5 pt-md-5">
                <div class="col-md-12">
                  <div class="teams">

                    <?php if(!empty($teamMembers)): ?>
                      <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teamMember): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div>
                          <div class="team-group">
                            <div class="team-pic"><img src="<?php echo url('public/'); ?>/<?php echo e($teamMember->file_url); ?>"></div>
                            <div class="team-content">
                              <h3><?php echo e(($teamMember->member_name)); ?> <span><?php echo e(($teamMember->designation)); ?></span></h3>
                              <p><?php echo e(($teamMember->description)); ?></p>
                            </div>
                          </div>
                        </div><!--slide-->
                      
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>


                    

                  </div>
                </div>

              </div>
            </div>
        </section>

        <section class="kontakt mt-5 pt-4 pt-lg-5 pt-md-5 pb-0 pb-lg-5 pb-md-5">
            <div class="container pt-3 pb-5">
              <h1 class="main-heading text-center"><?php if(!empty($data->contact_us_title)): ?><?php echo html_entity_decode($data->contact_us_title); ?> <?php endif; ?></h1>
              <p class="text-center"><?php if(!empty($data->contact_us_slogan)): ?><?php echo html_entity_decode($data->contact_us_slogan); ?> <?php endif; ?></p>
              <div class="row pt-3 pt-lg-5 pt-md-5 justify-content-center">
                <?php if(!empty($contactUsData['address'])): ?>
                
                <div class="col-lg-4 col-md-6">
                  <div class="box">
                    <a href="<?php echo e($contactUsData['google_map_link']); ?>" target="_blank">
                      <div class="row">
                        <div class="col-md-2"><img src="<?php echo url('public/assets/images/location.svg'); ?>"></div>
                        <div class="col-md-10">
                          <?php echo nl2br(e($contactUsData['address'])); ?>

                          
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php endif; ?>
                <?php if(!empty($contactUsData['phone_number'])): ?>
                <div class="col-lg-4 col-md-6">
                  <div class="box yel">
                    <a href="tel:<?php echo e($contactUsData['phone_number']); ?>">
                      <div class="row">
                        <div class="col-md-2"><img src="<?php echo url('public/assets/images/phone-call.svg'); ?>"></div>
                        <div class="col-md-10">
                          <h4><?php echo e($contactUsData['phone_number']); ?></h4>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php endif; ?>
                <?php if(!empty($contactUsData['email_address'])): ?>
                <div class="col-lg-4 col-md-7">
                  <div class="box mt-lg-0 mt-md-4">
                    <a href="mailto:<?php echo e($contactUsData['email_address']); ?>">
                      <div class="row">
                        <div class="col-md-2"><img src="<?php echo url('public/assets/images/email.svg'); ?>"></div>
                        <div class="col-md-10">
                          <p class="pt-2"><?php echo e($contactUsData['email_address']); ?></p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
        </section>

    </div>


    <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>     


    

    <script type="text/javascript" >
        jQuery(document).ready(function($){

          $(window).scroll(function(){
              if ($(window).scrollTop() >= 300) {
                  $('#navbar').addClass('sticky');
              }
              else {
                  $('#navbar').removeClass('sticky');
              }
          });


             
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
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                fade: true,
                infinite: false,
                centerMode: true,
                draggable: false,
                asNavFor: '.slider-nav'
            });
            
            $('.slider-nav').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                responsive: [{
                      breakpoint: 800,
                      settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                      }
                    },
                    {
                      breakpoint: 580,
                      settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                      }
                    }
                  ]
            });

            $('.testi').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                prevArrow: '<div class="slick-prev slick-arrow"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
                nextArrow: '<div class="slick-next slick-arrow"><span class="fa fa-angle-right"></span><span class="sr-only">Next</span></div>'

            });

            $('.teams').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                arrows: true,
                dots: false,
                prevArrow: '<div class="class-to-stylo1"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
                nextArrow: '<div class="class-to-stylo2"><span class="fa fa-angle-right"></span><span class="sr-only">Next</span></div>',
                responsive: [{
                      breakpoint: 800,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                      }
                    },
                    {
                      breakpoint: 580,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                      }
                    }
                  ]

            });
        });
    </script> 
       
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/home.blade.php ENDPATH**/ ?>