<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Laundry Booking</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($record->id); ?>">
                                Delete
                            </button>
                            <a href="<?php echo e(url('admin/laundry_booking')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--  ===============================  -->
            <!--  ======= Blogg Section Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                 <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="" method="POST" action='<?php echo e(url("admin/laundry_booking/{$record->id}")); ?>' enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>


                                <div class="col-xs-12">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>*Select Laundry # :</label>
                                            <select   name="laundry_number" id="laundry_number_edit" title="Select Laundry Number!" class="district-input-field form-control" 
                                            required >
                                               
                                               <option value="1" <?php echo old('laundry_number',$record->laundry_number) == 1 ? 'selected' : ''; ?> >1</option>
                                               <option value="2"  <?php echo old('laundry_number',$record->laundry_number) == 2 ? 'selected' : ''; ?>>2</option>
                                           </select>
                                            <?php if($errors->has('laundry_number')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('laundry_number')); ?></strong>
                                                </span>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Select Members :</label>
                                        <select name="user_id" class="form-control select2">
                                            <option value="">Select Member</option>
                                            <?php if(!empty($apartments)): ?>
                                                <?php $__currentLoopData = $apartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $apartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <optgroup label="<?php echo e($apartment->apartment_id); ?>">

                                                        <?php if(!empty($members)): ?>
                                                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($apartment->id == $member->apartment_id): ?>
                                                                <option value="<?php echo e($member->id); ?>" 
                                                                    <?php echo (old('user_id',$record->user_id) == $member->id) ? 'selected' : ''; ?>><?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>

                                                    </optgroup>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </select>
                                        <?php if($errors->has('user_id')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('user_id')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                        <input type="hidden" name="record_id" class="record_id" value="<?php echo e($record->id); ?>">
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>*Select Date :</label>
                                        <div id="datepicker"></div>
                                        <input type="text" class="form-control booking_date" readonly="" name="booking_date" placeholder="Selected Booking Date" value="<?php echo e(old('booking_date',$record->booking_date)); ?>">
                                        <input type="hidden" name="hidden_booking_date" value="<?php echo e(old('hidden_booking_date',$booking_date)); ?>" class="hidden_booking_date">
                                        <?php if($errors->has('booking_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('booking_date')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>*Select Available Time :</label>
                                        <select name="booking_time" class="form-control booking_time" required="">
                                            <option value="">Select Available Time</option>

                                        </select>
                                        <?php if($errors->has('booking_time')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('booking_time')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        <input type="hidden" name="hidden_booking_time" value="<?php echo e(old('hidden_booking_time',$record->booking_time)); ?>" class="hidden_booking_time">
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Reason :</label>
                                        <div id="datepicker"></div>
                                        <textarea class="form-control"  name="reason" placeholder="Reason"><?php echo e(old('reason',$record->reason)); ?></textarea>
                                        <?php if($errors->has('reason')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('reason')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                                                                                                                     

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Update
                                </button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $('.btn_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/laundry_booking/"+DataDeleteId);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="<?php echo url('public/assets/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript">
    

    var available_Dates = JSON.parse(JSON.stringify(<?php echo  json_encode($availableDates); ?>));            

    $('#datepicker').datepicker({
        todayHighlight:true,
        startDate:'now',
        format: "dd/mm/yyyy",
        default: 'dd/mm/yyyy',
        autoclose: true,
        /*beforeShowDay: function(date){                            
            var formattedDate = formatDate(date);                            
            if ($.inArray(formattedDate.toString(), available_Dates) == -1){
                return {
                    enabled : false
                };
            }
            return;
        }*/
    });
    function formatDate(date,format)
    {
        format = (typeof format !== 'undefined') ? format : 'dd/mm/yyyy';
        //date = new Date(d)
        var dd = date.getDate(); 
        var mm = date.getMonth()+1;
        var yyyy = date.getFullYear(); 
        if(dd<10){dd='0'+dd} 
        if(mm<10){mm='0'+mm};
        if(format == 'dd/mm/yyyy'){
            return d = dd+'/'+mm+'/'+yyyy;
        } else if(format == 'yyyy/mm/dd'){
            return d = yyyy+'/'+mm+'/'+dd;
        }
    }

    $('#datepicker').datepicker().on('changeDate', function(e) {
        var selectedDate = e.format(0,"dd/mm/yyyy");
        $("input.booking_date").val(selectedDate);
        var selectedDateHidden = e.format(0,"yyyy/mm/dd");
        $("input.hidden_booking_date").val(selectedDateHidden);
        var record_id = $("input.record_id").val();
        var laundry_number = $("select#laundry_number_edit").val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            url: "<?php echo e(url('admin/laundry_booking/get_timeslots')); ?>",
            data: { 'selectedDate':selectedDate,record_id:record_id,laundry_number:laundry_number },
            beforeSend: function() {
                showAjaxLoader();
            }
        }).done(function (response) { 
            $('select.booking_time').html(response.html); 
            /*setTimeout(function(){
                $("select.booking_time").val($("input.hidden_booking_time").val()).trigger('change');
            },500)*/
        }).always(function(){
     
          hideAjaxLoader();
        });
    });

   
    $(function(){
        var hidden_booking_date = $("input.hidden_booking_date").val();
        if(hidden_booking_date !== ''){
            var selectDate = new Date(hidden_booking_date);
            $("#datepicker").datepicker("update",selectDate);
            setTimeout(function(){
                $("#datepicker .active.day").trigger('click');
                setTimeout(function(){
                    $("select.booking_time").val($("input.hidden_booking_time").val()).trigger('change');
                },400)
                
            },500)
        }
    });
    $(document).on("change","select.booking_time", function(e){

        var booking_time = $(this).val();
        $("input.hidden_booking_time").val(booking_time);

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/lanudry_bookings/edit.blade.php ENDPATH**/ ?>