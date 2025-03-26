<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Messages</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($record->id); ?>">
                                Delete
                            </button>
                            <a href="<?php echo e(url('admin/messages')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
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
                        <form class="" method="POST" action='<?php echo e(url("admin/messages/{$record->id}")); ?>' enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>

                            
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Subject :</label>
                                    <input type="text" name="subject" id="subject" title="Enter subject!" class="district-input-field form-control" placeholder="Subject" required value="<?php echo e(old('subject',$record->subject)); ?>">
                                    <?php if($errors->has('subject')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('subject')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                   
                                </div>
                            </div>

                            
                            
                            <div class="col-xs-12">
                                <div class="form-group clearfix">
                                    <label>Message :</label>
                                    <div class="clearfix">
                                        <textarea  name="message" id="txtEditor" title="enter message!" class=" form-control" rows="8" cols="20" placeholder="Message"
                                             ><?php echo e(old('message',$record->message)); ?></textarea>     
                                        <?php if($errors->has('message')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('message')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <label>Upload File (jpg,png,gif,pdf):</label>
                                    <input type="file" name="attachment_url" id="attachment_url"  class="district-input-field form-control"  >
                                    <?php if($errors->has('attachment_url')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('attachment_url')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                    <?php if($record->attachment_url): ?>
                                        <p>
                                            <a target="_blank" href="<?php echo url('public'); ?>/<?php echo e($record->attachment_url); ?>" class="label label-success">
                                                <?php echo e(__("View Attachment")); ?>

                                            </a>
                                        </p>
                                        
                                    <?php endif; ?>
                                </div>
                            </div>                           

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Update Message
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

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/messages/"+DataDeleteId);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/messages/edit.blade.php ENDPATH**/ ?>