<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Laundry Booking</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="<?php echo e(url('admin/laundry_booking')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= laundry booking Section ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        
                        <form class="" method="POST" action="<?php echo e(url('admin/laundry_booking')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                            <div class="col-xs-12">
                                
                                    <div class="form-group">
                                        <label>*Select Laundry # :</label>
                                        <select   name="laundry_number" id="laundry_number_create" title="Select Laundry Number!" class="district-input-field form-control" 
                                        required >
                                           
                                           <option value="1" <?php echo old('laundry_number',$laundryNumber) == 1 ? 'selected' : ''; ?> ><?php echo e($laundry_1); ?></option>
                                           <option value="2"  <?php echo old('laundry_number',$laundryNumber) == 2 ? 'selected' : ''; ?>><?php echo e($laundry_2); ?></option>
                                       </select>
                                        <?php if($errors->has('laundry_number')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('laundry_number')); ?></strong>
                                            </span>
                                        <?php endif; ?>


                                    </div>
                               
                            </div>
                            
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Select Members :</label>
                                    <select name="user_id" class="district-input-field form-control select2">
                                        <option value="">Select Member</option>
                                        <?php if(!empty($apartments)): ?>
                                            <?php $__currentLoopData = $apartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $apartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <optgroup label="<?php echo e($apartment->apartment_id); ?>">

                                                    <?php if(!empty($members)): ?>
                                                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($apartment->id == $member->apartment_id): ?>
                                                            <option value="<?php echo e($member->id); ?>" 
                                                                <?php echo (old('user_id') == $member->id) ? 'selected' : ''; ?>><?php echo e($member->full_name); ?></option>
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
                                   
                                </div>
                            </div>
                                
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>*Select Date :</label>
                                    <div id="datepicker"></div>
                                    <input type="text" class="form-control booking_date hidden" readonly="" name="booking_date" placeholder="Selected Booking Date" value="<?php echo e(old('booking_date')); ?>">
                                    <input type="hidden" name="hidden_booking_date" value="<?php echo e(old('hidden_booking_date')); ?>" class="hidden_booking_date">
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
                                    <select  name="booking_time" class="form-control booking_time" required="">
                                        <option value="">Select Available Time</option>

                                    </select>
                                    <?php if($errors->has('booking_time')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('booking_time')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>

                            <div class="col-xs-12 hidden">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>*Time From :</label>
                                        <input type="text" name="time_from" id="time_from" title="enter time from!" readonly="" class="district-input-field form-control" placeholder="Ex: 09:00"
                                       value="<?php echo e(old('time_from')); ?>"  >
                                        <?php if($errors->has('time_from')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('time_from')); ?></strong>
                                            </span>
                                        <?php endif; ?>


                                    </div>
                                </div>
                                <div class="col-xs-6">   
                                    <div class="form-group">
                                        <label>*Time To:</label>
                                        <input type="text" readonly="" name="time_to" id="time_to" title="enter time to!" class="district-input-field form-control" placeholder="Ex: 09:30"
                                       value="<?php echo e(old('time_to')); ?>"  >
                                        <?php if($errors->has('time_to')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('time_to')); ?></strong>
                                            </span>
                                        <?php endif; ?>

                                       
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Reason :</label>
                                    <div id="datepicker"></div>
                                    <textarea class="district-input-field form-control"  name="reason" placeholder="Reason" rows="10"><?php echo e(old('reason')); ?></textarea>
                                    <?php if($errors->has('reason')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('reason')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>                            
                                                        

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Save
                                </button>
                                
                            </div>
                        </form>
                        <input type="hidden" id="workingHourStart" value="<?php echo !empty($workingHourStart) ? $workingHourStart : '09:00'; ?>">
                        <input type="hidden" id="workingHourEnd" value="<?php echo !empty($workingHourEnd) ? $workingHourEnd : '18:00'; ?>">
                        <input type="hidden" id="slotsInterval" value="<?php echo !empty($slotsInterval) ? $slotsInterval : 4; ?>">
                    </div>
                </div>

            </div>
        </div>
    </div>


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
        autoclose: true
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
        var laundry_number = $("select#laundry_number_create").val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            url: "<?php echo e(url('admin/laundry_booking/get_timeslots')); ?>",
            data: { 'selectedDate':selectedDate,laundry_number:laundry_number },
            beforeSend: function() {
                showAjaxLoader();
            }
        }).done(function (response) { 
            $('select.booking_time').html(response.html); 
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
                
            },1000)
        }
    });

    $('#time_from').timepicker({
        timeFormat: 'HH:mm',
        interval: 240,
        minTime: $("input#workingHourStart").val(),
        maxTime: $("input#workingHourEnd").val(),
        defaultTime: $("input#time_from").val(),
        startTime: '07',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });

    $('#time_to').timepicker({
        timeFormat: 'HH:mm',
        interval: 240,
        minTime: $("input#workingHourStart").val(),
        maxTime: $("input#workingHourEnd").val(),
        defaultTime: $("input#time_to").val(),
        startTime: '11',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/lanudry_bookings/create.blade.php ENDPATH**/ ?>