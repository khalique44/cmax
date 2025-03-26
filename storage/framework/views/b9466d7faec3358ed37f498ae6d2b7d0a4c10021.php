<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Global Settings</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Global Settings ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="<?php echo e(url('admin/global-settings', array('update'))); ?>" enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label>Header Logo (316 &times; 85) :</label>
                                <input type="file" name="header_logo" id="header_logo"  class="district-input-field form-control"  >
                                <?php if(!empty($header_logo)): ?>
                                <a href="<?php echo url('public'); ?>/<?php echo e($header_logo); ?>" target="_blank"><img src="<?php echo url('public'); ?>/<?php echo e($header_logo); ?>" class="logo" alt="Logo" width="50%"></a>
                                <?php endif; ?>
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Footer Logo (316 &times; 85) :</label>
                                <input type="file" name="footer_logo" id="footer_logo"  class="district-input-field form-control"  >
                                <?php if(!empty($footer_logo)): ?>
                                <a href="<?php echo url('public'); ?>/<?php echo e($footer_logo); ?>" target="_blank"><img src="<?php echo url('public'); ?>/<?php echo e($footer_logo); ?>" class="logo" alt="Logo" width="50%"></a>
                                <?php endif; ?>
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Footer Text Under Logo :</label>
                                <input type="text" name="footer_text_under_logo" id="footer_text_under_logo" title="enter Footer Text Under Logo!" class="district-input-field form-control" placeholder="Footer Text Under Logo"
                                       value="<?php echo e(old('footer_text_under_logo',$footer_text_under_logo)); ?>" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>


                            <div class="form-group">
                                <label>Facebook Url :</label>
                                <input type="text" name="facebook_url" id="facebook_url" title="enter Facebook Url!" class="district-input-field form-control" placeholder="Facebook Url"
                                       value="<?php echo e(old('facebook_url',$facebook_url)); ?>" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Footer Center Column Heading :</label>
                                <input type="text" name="footer_center_column_heading" id="footer_center_column_heading" title="enter Footer Center Column Heading!" class="district-input-field form-control" placeholder="Footer Center Column Heading"
                                       value="<?php echo e(old('footer_center_column_heading',$footer_center_column_heading)); ?>" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>


                            <div class="form-group">
                                <label>Footer Last Column Heading :</label>
                                <input type="text" name="footer_last_column_heading" id="footer_last_column_heading" title="enter Footer Last Column Heading!" class="district-input-field form-control" placeholder="Footer Last Column Heading"
                                       value="<?php echo e(old('footer_last_column_heading',$footer_last_column_heading)); ?>" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            
                            

                            <div class="form-group">
                                <label>Copy Right Text :</label>
                                <input type="text" name="copy_right_text" id="copy_right_text" title="enter Copy Right Text!" class="district-input-field form-control" placeholder="Copy Right Text"
                                       value="<?php echo e(old('copy_right_text',$copy_right_text)); ?>" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Date Format :</label>
                                <select  name="global_date_format" id="global_date_format" class="district-input-field form-control" placeholder="Ex: "
                                        required >
                                           <option value="d-M-Y" <?php echo old('global_date_format',$global_date_format) == 'd-M-Y' ? 'selected' : ''; ?>>d-M-Y (13-Dec-2023)</option>
                                           <option value="d M Y" <?php echo old('global_date_format',$global_date_format) == 'd M Y' ? 'selected' : ''; ?>>d M Y (13 Dec 2023)</option>
                                           <option value="M-d-Y" <?php echo old('global_date_format',$global_date_format) == 'M-d-Y' ? 'selected' : ''; ?>>M-d-Y (Dec-13-2023)</option>
                                           <option value="Y-M-d" <?php echo old('global_date_format',$global_date_format) == 'Y-M-d' ? 'selected' : ''; ?>>Y-M-d (2023-Dec-13)</option>
                                           <option value="D, M d, Y" <?php echo old('global_date_format',$global_date_format) == 'D, M d, Y' ? 'selected' : ''; ?>>D, M d, Y (Wed, Dec 13, 2023)</option>
                                       </select>
                                <div id="msg_1">&nbsp;</div>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/global_settings/edit.blade.php ENDPATH**/ ?>