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
                        <form class="" method="POST" action='<?php echo e(url("admin/reported_issues/update_issue/{$record->id}")); ?>' enctype="multipart/form-data">
                           
                            <?php echo e(csrf_field()); ?>

                                <div class="col-xs-12">
                                    <div class="col-xs-4"><label><?php echo e(__('Apartment #')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->users->username); ?></div>
                                   
                                </div>

                                <div class="col-xs-12">
                                   
                                    <div class="col-xs-4"><label><?php echo e(__('Describe Where')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->room_area); ?></div>                                       
                                    
                                </div>

                                <div class="col-xs-12">
                                   
                                    <div class="col-xs-4"><label><?php echo e(__('Reason')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo !empty($record->reason->title) ? $record->reason->title : ''; ?></div>                                       
                                    
                                </div>

                                <div class="col-xs-12">
                                    <div class="col-xs-4"><label><?php echo e(__('Describe Issue')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->description); ?></div>
                                    
                                </div>

                                <div class="col-xs-12">
                                   
                                    <div class="col-xs-4"><label><?php echo e(__('Attachment')); ?> :</label></div>
                                    <div class="col-xs-8">
                                        <?php if($errors->has('attachment')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('attachment')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        <?php if($record->issuesAttachments->count() > 0): ?>
                                            <?php $__currentLoopData = $record->issuesAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>">
                                                <img src="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>" class="" alt="View File" width="20%">
                                            </a>
                                            
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>

                                <div class="col-xs-12">   
                                    <div class="col-xs-4"><label><?php echo e(__('Member')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->full_name); ?></div>
                                    
                                </div>
                            
                                <div class="col-xs-12">
                                    <div class="col-xs-4"><label><?php echo e(__('Mobile/Contact Number')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->mobile_number); ?></div>
                                    
                                </div>

                                <div class="col-xs-12">
                                    <div class="col-xs-4"><label><?php echo e(__('Phone Number')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->phone); ?></div>
                                    
                                </div>

                                <div class="col-xs-12">
                                    <div class="col-xs-4"><label><?php echo e(__('Email')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->email); ?></div>
                                   
                                </div>

                                
                                
                                

                                <div class="col-xs-12">
                                    <div class="col-xs-4"><label><?php echo e(__('Describe More')); ?> :</label></div>
                                    <div class="col-xs-8"><?php echo e($record->more_description); ?></div>
                                    
                                </div>
                                <div class="col-xs-12">
                                    &nbsp;
                                    
                                </div>

                                <div class="col-xs-12">

                                    <?php if($record->issuesComments->count() > 0): ?>
                                    <div class="col-xs-6">&nbsp;</div>
                                    <div class="col-xs-12">
                                        <table class="display" id="table_main">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Comment')); ?></th>
                                                    <th><?php echo e(__('Comment By')); ?></th>
                                                    <th width="15%"><?php echo e(__('Date')); ?></th>
                                                    <th><?php echo e(__('Action')); ?></th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                            <?php $__currentLoopData = $record->issuesComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ket => $comments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td><?php echo e($comments->comments); ?></td>
                                                    <td><?php echo e(ucfirst($comments->comment_by)); ?></td>
                                                    <td><?php echo e($comments->created_at); ?></td>
                                                    <td><a href="<?php echo url(''); ?>/admin/reported_issues/<?php echo e($record->id); ?>?comment_id=<?php echo e($comments->id); ?>"  title="<?php echo e(__('Edit Comment')); ?>"> <i class="fa fa-pencil"></i> </a></td>
                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                                <div class="col-xs-12">
                                    &nbsp;                                    
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
                                          
                                          
                                           <option value="" <?php echo '' == old('assign_to',$record->assign_to) ? 'selected' : ''; ?>><?php echo e(__('Admin')); ?></option>
                                          

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

                                <div class="col-xs-12">
                                    
                                    <div class="form-group">
                                        <label><?php echo e(__('Comments')); ?> :</label>
                                        
                                       
                                        <textarea class="form-control"  name="comments" placeholder="<?php echo e(__('Comments')); ?>" rows="10" ><?php echo !empty($comment->comments) ? $comment->comments : ''; ?></textarea>
                                        <?php if($errors->has('comments')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('comments')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                        <?php if(!empty($comment->id)): ?>
                                        <input type="hidden" name="comment_id" value="<?php echo e($comment->id); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo e(__('Expense Amount')); ?> :</label>
                                        
                                       
                                        <input type="number" step="0.1" min="0.1" name="expense" class="form-control"  placeholder="<?php echo e(__('Enter Expense Amount')); ?>" value="<?php echo e(old('expense',$record->expense)); ?>">
                                        <?php if($errors->has('expense')): ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('expense')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                                                                                                                     

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Submit
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

        $(document).ready(function() {
            let datatable = $('#table_main').DataTable({
                "order": [0,'asc'],
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    //'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]]
                
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/report_issues/show.blade.php ENDPATH**/ ?>