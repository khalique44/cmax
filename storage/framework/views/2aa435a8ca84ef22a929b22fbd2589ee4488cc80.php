<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Apartment</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            
                            <a href="<?php echo e(url('admin/apartment')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
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
                        <form class="" method="POST" action='<?php echo e(url("admin/apartment/{$record->id}")); ?>' enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>

                            
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>*Apartment ID :</label>
                                        <input type="text" name="apartment_id" id="apartment_id" title="enter Apartment ID!" class="district-input-field form-control" placeholder="Apartment ID"  value="<?php echo e(old('apartment_id', $record->apartment_id)); ?>" required >
                                        
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>*Password :</label>
                                        <input type="password" name="password" id="password" title="enter password !" class="<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?> district-input-field form-control" placeholder="password" >
                                        <div id="msg_6">&nbsp;</div>
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>*Confirm Password :</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" title="enter password !" class="<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?> district-input-field form-control" placeholder="password" >
                                        <?php if($errors->has('password_confirmation')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        <div id="msg_6">&nbsp;</div>
                                    </div>
                                </div>

                               <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Active :</label>
                                    <div class="district-active-radio-field">
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="yes"class="" id="radio_active_yes" required <?php echo e(old($record->apartment_id) == "yes" || old($record->apartment_id) == ""  ? "checked" : ""); ?> >Yes</input>
                                        </label>
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="no" id="radio_active_no" required <?php echo e(old('apartment_id', $record->apartment_id) == "no" ? "checked" : ""); ?> >No</input>
                                        </label>
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
    <script>
        $('.btn_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            //$(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/partment/"+DataDeleteId);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/apartments/edit.blade.php ENDPATH**/ ?>