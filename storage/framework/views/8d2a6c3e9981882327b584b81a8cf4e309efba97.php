<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Reported Issue Reasons</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($record->id); ?>">
                                Delete
                            </button>
                            <a href="<?php echo e(url('admin/issue_reasons')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
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
                        <form class="" method="POST" action='<?php echo e(url("admin/issue_reasons/{$record->id}")); ?>' enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>


                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Reason Title :</label>
                                   
                                    <input type="text"  class="form-control"  name="title" placeholder="Reason Title" value="<?php echo e(old('title',$record->title)); ?>">
                                    <?php if($errors->has('title')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Active :</label>
                                    <div class="district-active-radio-field">
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="1"class="" id="radio_active_yes"  <?php echo old('title',$record->status) == 1 ? 'checked' : ''; ?>> Yes
                                        </label>
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="0" id="radio_active_no"  <?php echo old('title',$record->status) == 0 ? 'checked' : ''; ?>> No
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

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/issue_reasons/"+DataDeleteId);
        });
        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/report_issue_reasons/edit.blade.php ENDPATH**/ ?>