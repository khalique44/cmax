<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Login Page Settings</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Kontakta Oss General Settings ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="<?php echo e(url('admin/login_page/general_settings', array('update'))); ?>" enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" name="login_title" id="login_title" title="enter title!" class="district-input-field form-control" placeholder="Title"
                                       value="<?php echo e(old('login_title',$login_title)); ?>" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Description :</label>
                                <textarea  name="login_description" id="login_description" title="enter description!" class="district-input-field form-control" rows="8" placeholder="Description"
                                         ><?php echo e(old('login_description',$login_description)); ?></textarea>
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Header Image (1920 &times; 915) :</label>
                                <input type="file" name="login_header_image" id="login_header_image"  class="district-input-field form-control"  >
                                <?php if(!empty($login_header_image)): ?>
                                <a href="<?php echo url('public'); ?>/<?php echo e($login_header_image); ?>" target="_blank"><img src="<?php echo url('public'); ?>/<?php echo e($login_header_image); ?>" class="logo" alt="Logo" width="50%"></a>
                                <?php endif; ?>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/login_page/general_settings/edit.blade.php ENDPATH**/ ?>