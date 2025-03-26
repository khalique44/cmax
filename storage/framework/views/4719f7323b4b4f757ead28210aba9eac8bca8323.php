<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Available Time Slots</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="<?php echo e(url('admin/available_time_slots')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Available Time Slots Section ===========  -->
            <!--  ===============================  -->

            <div class="row">
                 <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        
                        <form class="" method="POST" action="<?php echo e(url('admin/available_time_slots')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            
                                
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>*Select Month :</label>
                                        <select name="month" required="" class="district-input-field form-control time-slot-month">
                                            <option value="">Select Month</option>
                                            <?php if(!empty($months)): ?>
                                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <option value="<?php echo e($key); ?>" <?php echo old('month') == $key ? 'selected' : ''; ?>><?php echo e($month); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        
                                        <?php if($errors->has('month')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('month')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>*Select Day :</label>
                                        <select name="day" required="" class="district-input-field form-control time-slot-days-dropdown">
                                            <option value=""><?php echo e(__('Select Day')); ?></option>
                                            <?php if(!empty($days)): ?>
                                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <option value="<?php echo e($day); ?>" <?php echo old('day') == $day ? 'selected' : ''; ?>><?php echo e($day); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if($errors->has('day')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('day')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            
                            
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>*Time From :</label>
                                        <select name="time_from" required="" class="district-input-field form-control">
                                            <option value="">Select Time From</option>
                                            <?php if(!empty($timeSlots)): ?>
                                                <?php $__currentLoopData = $timeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timeSlot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <option value="<?php echo e($key); ?>" <?php echo old('time_from') == $key ? 'selected' : ''; ?>><?php echo e($timeSlot); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
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
                                        <select name="time_to" required="" class="district-input-field form-control">
                                            <option value="">Select Time To</option>
                                            <?php if(!empty($timeSlots)): ?>
                                                <?php $__currentLoopData = $timeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timeSlot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <option value="<?php echo e($key); ?>" <?php echo old('time_to') == $key ? 'selected' : ''; ?>><?php echo e($timeSlot); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>

                                        <?php if($errors->has('time_to')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('time_to')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                            
                              
                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Save
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/available_time_slots/create.blade.php ENDPATH**/ ?>