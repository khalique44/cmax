

  
<?php $__env->startSection('content'); ?>

<?php if(!empty($header_image)): ?>



<?php endif; ?>

  <header class="header-main header-inner" <?php echo !empty($header_image) ? 'style="background: url('.$header_image.'); min-height: 63vh"' : ""; ?> >
      <div class="container">
      
          <?php echo $__env->make('layouts.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="slid-header pb-md-4 mx-auto">

            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                 <h1 class="display-4 mt-2 mt-md-5 mt-lg-5"><?php if(!empty($data['title'])): ?> <?php echo html_entity_decode($data['title']); ?> <?php endif; ?></h1>

              </div>

            </div>

           

          </div>          

      </div>
  </header>

  <div class="content">

    <section class="logarea pt-md-5 pb-md-5">

      <div class="container">
        <div class="row pb-md-5"><a href="<?php echo e(url('dashboard')); ?>" class="btn btn-dark pl-md-5 pr-md-5 pt-md-2 pb-md-2"><?php echo e(__('language.Back')); ?></a></div>
        <div class="row pb-md-4">

          <div class="col-md-9"><h3><?php echo e(__('language.Book Laundry')); ?></h3></div>

          <div class="col-md-3 text-right">
            <a href="#" class="btn btn-success2 <?php echo $totalCounts == Config::get('constants.limit_laundry_booking') ? 'remove_booking_msg' : 'load-datepicker'; ?> " data-toggle="modal" data-target="#<?php echo $totalCounts == Config::get('constants.limit_laundry_booking') ? 'remove_booking_msg' : 'bookilight'; ?>"><?php echo e(__('language.Book New Time')); ?> +</a>
          </div>

        </div>
        <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="row pb-md-5">

        <div class="col-md-12">

          <div class="loundry-bookingtab table-responsive">

                <table class="table table-striped" id="laundry-booking-table" >

                  <thead>

                    <tr>

                      <th><?php echo e(__("language.Booking Date")); ?></th>

                      <th width=""><?php echo e(__("language.Booking Time")); ?></th>
                      
                      <th  ><?php echo e(__("language.Laundry Number")); ?></th>
                      
                      <th></th>

                    </tr>

                  </thead>

                  <tbody>
                      <!--<tr>
                          <?php echo e(print_r($bookings, true)); ?>

                      </tr>-->
                    <?php if(!empty($bookings)): ?>
                      <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>

                        <td><?php echo e($booking->booking_date_format); ?></td>

                        <td><?php echo e($booking->booking_time); ?></td>
                        <td><?php echo e($booking->laundry_number); ?> [<?php echo e($booking->email); ?> (<?php echo e($booking->apartment_id); ?>)]</td>
                        <td>
                          <button  type="button" class="btn btn-success2 btn-sm remove_booking" data-id="<?php echo e($booking->id); ?>" data-target="#DeleteConfirmationModal" data-toggle="modal"><?php echo e(__("language.REMOVE")); ?></button> 
                        </td>
                        
                        <!-- <?php if(Carbon\Carbon::createFromFormat('d/m/Y H:i', $booking->booking_date.' '.$booking->time_from)->isPast()): ?>
                        <td>
                          <span  type="button" class="badge badge-danger"><?php echo e(__("Date Passed")); ?></span> 
                        </td>
                        <?php else: ?>
                        <td>
                          <button  type="button" class="btn btn-success2 btn-sm remove_booking" data-id="<?php echo e($booking->id); ?>" data-target="#DeleteConfirmationModal" data-toggle="modal"><?php echo e(__("Remove")); ?></button> 
                        </td>
                        <?php endif; ?> -->
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    
                  </tbody>

                </table>

              </div>

             

              <?php if($totalCounts == Config::get('constants.limit_laundry_booking')): ?>
              <div class="alert alert-danger" role="alert"> Maximalt <?php echo e($totalCounts); ?> tvättider kan bokas.</div>
              <?php endif; ?>





        </div>



      </div>

      </div>

    </section><!---about sec--->

  </div><!---content--->


  <!-- Modal -->

  <div class="modal fade book-modal" id="bookilight" tabindex="-1" role="dialog" aria-labelledby="bookilight" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

        <button type="button" class="btn btn-link close cl close_booking_form" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <div class="modal-body pb-md-4">

          <h4 class="modal-title" id="exampleModalLongTitle"><strong><?php echo e(__("language.Select DATE & TIME")); ?></strong></h4>
          <div class="ajax-msg"></div>
          <div class="row mt-md-5">

            <div class="col-md-6">

              <div id="datepicker2" ></div>                        

            </div>

            <div class="col-md-6">

              <form>

                <div class="form-group">

                  <select class="form-control laundry_number" required="" name="laundry_number">

                    <option value=""><?php echo e(__("language.Select Laundry Number")); ?></option>                      
                    <option value="1"><?php echo e($laundry_1); ?></option>                      
                    <option value="2"><?php echo e($laundry_2); ?></option>                      

                  </select>
                  
                </div>

                <div class="form-group">

                  <select class="form-control booking_time">

                    <option><?php echo e(__("language.Select Available Time")); ?></option>                      

                  </select>
                  <input type="hidden" name="booking_date" class="booking_date">
                </div>

                <div class="form-group">

                  <button class="btn btn-success2 btn-block book_new_time"><?php echo e(__("language.Book New Time")); ?></button>

                </div>

              </form>

            </div>              

          </div>

        </div>

        

      </div>

    </div>

  </div>



  <div class="modal fade om-modal" id="omimagelight2" tabindex="-1" role="dialog" aria-labelledby="omimagelighting2" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <div class="singleimage">

          <img src="<?php echo url('public/assets/images/under-model.jpg'); ?>" class="w-100">

        </div>

        <div class="modal-body">

          <h4 class="modal-title" id="exampleModalLongTitle"><strong>STORA BALKONGER</strong></h4>

          <p>Balkong och en fin gård hamnar högst när boende får välja viktiga egenskaper på ett gott boende. Vi har lyssnat och erbjuder detta.</p>

          <p>Är balkong, grönska och en välkomnande utepplats viktigt för dig – ja då har du hamnat rätt!</p>

        </div>

        

      </div>

    </div>

  </div>



  <div class="modal fade om-modal" id="omimagelight3" tabindex="-1" role="dialog" aria-labelledby="omimagelighting2" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

          <ol class="carousel-indicators">

            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

          </ol>

          <div class="carousel-inner">

            <div class="carousel-item">

              <img class="d-block w-100" src="https://www.rosenivara.se/public/assets/about_accommodation_images/under-model-1656799054.jpg" alt="First slide">

            </div>

            <div class="carousel-item">

              <img class="d-block w-100" src="https://www.rosenivara.se/public/assets/about_accommodation_images/under-model-1656799054.jpg" alt="Second slide">

            </div>

            <div class="carousel-item">

              <img class="d-block w-100" src="https://www.rosenivara.se/public/assets/about_accommodation_images/under-model-1656799054.jpg" alt="Third slide">

            </div>

          </div>

          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">

            <span class="carousel-control-prev-icon" aria-hidden="true"></span>

            <span class="sr-only">Previous</span>

          </a>

          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">

            <span class="carousel-control-next-icon" aria-hidden="true"></span>

            <span class="sr-only">Next</span>

          </a>

        </div>

        <div class="modal-body">

          <h4 class="modal-title" id="exampleModalLongTitle"><strong>STORA BALKONGER</strong></h4>

          <p>Balkong och en fin gård hamnar högst när boende får välja viktiga egenskaper på ett gott boende. Vi har lyssnat och erbjuder detta.</p>

          <p>Är balkong, grönska och en välkomnande utepplats viktigt för dig – ja då har du hamnat rätt!</p>

        </div>

      </div>

    </div>

  </div>

  <div class="modal fade om-modal" id="remove_booking_msg" tabindex="-1" role="dialog" aria-labelledby="remove_booking_msg" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        

        <div class="modal-body">

          <h4 class="modal-title" id="exampleModalLongTitle"><strong><?php echo e(__('language.Remove any old booking to place new booking')); ?></strong></h4>

          <p><?php echo e(__('language.That is not possible to book laundry time as you already have booked '. Config::get('constants.limit_laundry_booking').' times' )); ?></p>

          

        </div>

      </div>

    </div>

  </div>

  <div class="modal fade" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteConfirmationModalLabel"><?php echo e(__("language.Confirmation")); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> <?php echo e(__('language.This action can not be un-done, Are you sure you want to permanently Remove this?')); ?> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal"><?php echo e(__('language.Close')); ?></button>
                

                <form style="display: inline-block;" type="hidden" class="data-delete-form" method="POST" action="">
                    <?php echo e(method_field('DELETE' )); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="action-buttons pt-3">
                        <button type="submit" class="btn-danger"><?php echo e(__("language.Delete")); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="<?php echo url('public/assets/js/bootstrap-datepicker.min.js'); ?>"></script>
  <script src="<?php echo url('public/assets/js/bootstrap-datepicker.sw.min.js'); ?>"></script>
  
<script>

$(document).on('click', '.load-datepicker',function(){
 
  //setTimeout(function(){
    var available_dates = JSON.parse(JSON.stringify(<?php echo  json_encode($availableDates); ?>));
   // available_dates = available_dates.split(',');
  loadDatePicker(available_dates);
//},2000);
});



  

</script>
   <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
  
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/laundry_booking.blade.php ENDPATH**/ ?>