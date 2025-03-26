<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Global Styling</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Global Styling ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="<?php echo e(url('admin/global-styling', array('update'))); ?>" enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>


                            

                            <div class="form-group">
                                <label>Primary Color :</label>
                                <div class="colors">
                                      
                                    <input type="text" value="<?php echo e(old('primary_color',$primary_color)); ?>" name="primary_color" class="color form-control" />
                                </div>
                                
                            </div>


                            
                            <div class="form-group">
                                <label>Secondary Color :</label>
                                <div class="colors">
                                      
                                    <input type="text" value="<?php echo e(old('secondary_color',$secondary_color)); ?>" name="secondary_color" class="color form-control" />
                                </div>
                                
                            </div>
                            

                            <div class="form-group">
                                <label>Home Page KONTAKTA OSS BG :</label>
                                <div class="colors">
                                      
                                    <input type="text" value="<?php echo e(old('home_contact_us_bg',$home_contact_us_bg)); ?>" name="home_contact_us_bg" class="color form-control" />
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label>Footer BG :</label>
                                <div class="colors">
                                      
                                    <input type="text" value="<?php echo e(old('footer_background',$footer_background)); ?>" name="footer_background" class="color form-control" />
                                </div>
                                
                            </div>
                           

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Save
                                </button>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ResetConfirmationModal" >
                                Reset to Default
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\cmax1\resources\views/admin/global_styling/edit.blade.php ENDPATH**/ ?>