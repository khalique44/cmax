

<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Launderies</h4>
                </div>
                
            </div>

            <!--  ===============================  -->
            <!--  ======= Blogg Section Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                 <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="" method="POST" action="<?php echo e(url('admin/update_laundries')); ?>" enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>

                                                        
                            <div class="col-xs-12">                                

                                
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>*Title for Laundry# 1 :</label>
                                            <input type="text" name="laundry_1" id="laundry_1" title="enter laundry name!" class="district-input-field form-control time_from" placeholder=""
                                           value="<?php echo e(old('laundry_1',$laundry_1)); ?>" required > 
                                            <?php if($errors->has('laundry_1')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('laundry_1')); ?></strong>
                                                </span>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>*Title for Laundry# 2 :</label>
                                            <input type="text" name="laundry_2" id="laundry_2" title="enter laundry name!" class="district-input-field form-control time_from" placeholder=""
                                           value="<?php echo e(old('laundry_2',$laundry_2)); ?>" required > 
                                            <?php if($errors->has('laundry_2')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('laundry_2')); ?></strong>
                                                </span>
                                            <?php endif; ?>


                                        </div>
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
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/lanudry_bookings/laundries.blade.php ENDPATH**/ ?>