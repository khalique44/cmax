<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Reported Issues</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($record->id); ?>">
                                Delete
                            </button>
                            <a href="<?php echo e(url('admin/reported_issues')); ?>" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
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
                        <form class="" method="POST" action='<?php echo e(url("admin/reported_issues/{$record->id}")); ?>' enctype="multipart/form-data">
                            <?php echo e(method_field('PUT')); ?>

                            <?php echo e(csrf_field()); ?>


                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Describe Where :</label>
                                        <input type="text" name="room_area" placeholder="<?php echo e(__('Describe Where')); ?> *" class="form-control" required value="<?php echo e(old('room_area', $record->room_area )); ?>">
                                        <?php if($errors->has('room_area')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('room_area')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Describe Issue :</label>
                                        <input type="text" name="description" placeholder="<?php echo e(__('Describe Issue')); ?> *" class="form-control" required value="<?php echo e(old('description', $record->description )); ?>">
                                        <?php if($errors->has('description')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('description')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Attachment :</label>
                                        <input type="file" name="attachment" placeholder="" class="form-control" >
                                        <?php if($errors->has('attachment')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('attachment')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        <?php if($record->issuesAttachments->count() > 0): ?>
                                            <?php $__currentLoopData = $record->issuesAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>">
                                                <img src="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>" class="logo" alt="View File" width="50%">
                                            </a>
                                            <div>
                                                <button type="button"  class="label label-danger btn_delete_attachment" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($attachment->id); ?>"><?php echo e(__('Remove')); ?></button>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>

                                <div class="col-xs-6">   
                                    <div class="form-group">
                                        
                                        
                                        <?php if($apartmentUsers->count() > 1): ?>
                                            <label><?php echo e(__('Select Member')); ?></label>
                                            <select name="full_name" class="form-control">
                                              <option value=""><?php echo e(__('Select Member')); ?></option>
                                              <?php $__currentLoopData = $apartmentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $apartmentUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        

                                                  <option value="<?php echo e($apartmentUser->first_name); ?> <?php echo e($apartmentUser->last_name); ?>"
                                                    <?php echo $apartmentUser->first_name.' '.$apartmentUser->last_name == old('full_name',$record->full_name) ? 'selected' : ''; ?>

                                                   data-email="<?php echo e($apartmentUser->email); ?>" data-phone="<?php echo e($apartmentUser->phone); ?>"><?php echo e($apartmentUser->first_name); ?> <?php echo e($apartmentUser->last_name); ?></option>                        

                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        <?php else: ?> 
                                            <label><?php echo e(__('Member')); ?></label>
                                            <input type="text" name="full_name" placeholder="<?php echo e(__('Name')); ?>" class="form-control" value="<?php echo e(old('full_name',$record->full_name)); ?>" >

                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Contact Number')); ?> :</label>
                                        <input type="text" name="phone" placeholder="<?php echo e(__('Contact Number')); ?>" class="form-control" required value="<?php echo e(old('phone', $record->phone )); ?>">
                                        <?php if($errors->has('phone')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('phone')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Email')); ?> :</label>
                                        <input type="text" name="email" placeholder="<?php echo e(__('Email')); ?>" class="form-control" required value="<?php echo e(old('email', $record->email )); ?>">
                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo e(__('Describe More')); ?> :</label>
                                        
                                       
                                        <textarea class="form-control"  name="more_description" placeholder="<?php echo e(__('Describe More')); ?>"><?php echo e(old('more_description',$record->more_description)); ?></textarea>
                                        <?php if($errors->has('more_description')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('more_description')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-xs-6">   
                                    <div class="form-group">

                                        <label><?php echo e(__('Status')); ?></label>
                                        <select name="issue_status" class="form-control">
                                          <option value=""><?php echo e(__('Select Status')); ?></option>
                                            <?php $__currentLoopData = Config::get('constants.issue_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        

                                                <option value="<?php echo e($status); ?>"
                                                <?php echo $status == old('status',$record->issue_status) ? 'selected' : ''; ?>

                                                ><?php echo e($status); ?></option>                       
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        
                                    </div>
                                </div>


                                <div class="col-xs-6">   
                                    <div class="form-group">

                                        <label><?php echo e(__('Assign To')); ?></label>
                                        <select name="assign_to" class="form-control">
                                          
                                          <?php if(old('assign_to',$record->assign_to) == ''): ?>
                                           <option value=""><?php echo e(__('Admin')); ?></option>
                                          <?php endif; ?>

                                          <?php if($vendors->count() > 0): ?>
                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        

                                              <option value="<?php echo e($vendor->id); ?>"
                                                <?php echo $vendor->id == old('assign_to',$record->assign_to) ? 'selected' : ''; ?>

                                              ><?php echo e($vendor->first_name); ?> <?php echo e($vendor->last_name); ?></option>                       
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php endif; ?>
                                        </select>
                                        
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

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/reported_issues/"+DataDeleteId);
        });
        $('.btn_delete_attachment').on('click',function (e) {
            e.preventDefault();
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/reported_issues/remove_attachment/"+DataDeleteId);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/report_issues/edit.blade.php ENDPATH**/ ?>