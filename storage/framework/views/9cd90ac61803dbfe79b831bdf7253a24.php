<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4><?php echo e(__('Change Password')); ?></h4>
                </div>
                
            </div>
       

            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="user-backend-form-section left-side">

                    <!-- <div class="title">
                        <h4><?php echo e(__('Update Password')); ?></h4>
                    </div> -->
                    <form class="change-password-form" action="<?php echo url('admin/change-password'); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="password" class="backend-field form-control" placeholder="Old Password" name="old_password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="backend-field form-control" placeholder="New Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="backend-field form-control" placeholder="Confirm Password" name="password_confirmation" required>
                        </div>
                        <div class="submit-request-btn pull-right">
                            <a href="<?php echo route('admin.dashboard'); ?>" class="btn-sm btn-danger" style="line-height: 0.9;"><?php echo e(__('BACK')); ?></a>
                            <button type="submit" class="btn-sm btn-success"><?php echo e(__('CHANGE PASSWORD')); ?></button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    

   
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\cmax1\resources\views/admin/auth/reset-password.blade.php ENDPATH**/ ?>