

<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Available Time Slots</h4>
                </div>
                
            </div>

            <!--  ===============================  -->
            <!--  ======= Blogg Section Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                 <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="" method="POST" action="<?php echo e(url('admin/available_time_slots', array('update'))); ?>" enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>

                            
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>*Select Laundry # :</label>
                                        <select   name="laundry_number" id="laundry_number" title="Select Laundry Number!" class="district-input-field form-control" 
                                        required >
                                           
                                           <option value="1" <?php echo old('laundry_number',$laundryNumber) == 1 ? 'selected' : ''; ?> >Smedjegatan</option>
                                           <option value="2"  <?php echo old('laundry_number',$laundryNumber) == 2 ? 'selected' : ''; ?>>Odengatan</option>
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
                                <?php if(!empty($timeFrom)): ?>
                                    <?php $__currentLoopData = $timeFrom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $time_to = $timeTo[$key]; ?>
                                        <div class="remove_me_<?php echo e($key); ?>">
                                            <span class="selected-slots">
                                                <div class="col-xs-5">
                                                    <div class="form-group">
                                                        <label>*Available Time From :</label>
                                                        <input type="text" name="time_from[]" id="time_from" title="enter time from!" class="district-input-field form-control time_from" placeholder="Ex: 09:00"
                                                       value="<?php echo e($val); ?>" required > 
                                                        <?php if($errors->has('time_from')): ?>
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong><?php echo e($errors->first('time_from')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>


                                                    </div>
                                                </div>
                                                <div class="col-xs-5">   
                                                    <div class="form-group">
                                                        <label>*Available Time To:</label>
                                                        <input type="text" name="time_to[]" id="time_to" title="enter time to!" class="district-input-field form-control time_to" placeholder="Ex: 18:30"
                                                       value="<?php echo e($time_to); ?>" required > 
                                                        <?php if($errors->has('time_to')): ?>
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong><?php echo e($errors->first('time_to')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>

                                                        
                                                        
                                                    </div>
                                                </div>
                                            </span>
                                            <div class="col-xs-2">
                                                <?php if($key == 0): ?>
                                                <button type="button" class="btn-sm btn-primary mt-30 add-more-slots" style="margin-top:30px; ">+ <?php echo e(__("Add More")); ?></button>
                                                <?php else: ?>
                                                <button type="button" class="btn-sm btn-danger mt-30 remove-slots" data-id="<?php echo e($key); ?>" style="margin-top:30px; ">- <?php echo e(__("Remove")); ?></button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>

                                <span class="selected-slots">
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label>*Available Time From :</label>
                                            <input type="text" name="time_from[]" id="time_from" title="enter time from!" class="district-input-field form-control time_from" placeholder="Ex: 09:00"
                                           value="" required > 
                                            <?php if($errors->has('time_from')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('time_from')); ?></strong>
                                                </span>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                    <div class="col-xs-5">   
                                        <div class="form-group">
                                            <label>*Available Time To:</label>
                                            <input type="text" name="time_to[]" id="time_to" title="enter time to!" class="district-input-field form-control time_to" placeholder="Ex: 18:30"
                                           value="" required > 
                                            <?php if($errors->has('time_to')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('time_to')); ?></strong>
                                                </span>
                                            <?php endif; ?>

                                            
                                            
                                        </div>
                                    </div>
                                </span>
                                <div class="col-xs-2">
                                    
                                    <button type="button" class="btn-sm btn-primary mt-30 add-more-slots" style="margin-top:30px; ">+ <?php echo e(__("Add More")); ?></button>
                                    
                                    
                                </div>

                                <?php endif; ?>
                                <div class="more-slots-area"></div>
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
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
$('.time_from').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '02',
        maxTime: '23',
        defaultTime: '',
        startTime: '06',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });

    $('.time_to').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '02',
        maxTime: '23',
        defaultTime: '',
        startTime: '06',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/available_time_slots/select_working_hours.blade.php ENDPATH**/ ?>