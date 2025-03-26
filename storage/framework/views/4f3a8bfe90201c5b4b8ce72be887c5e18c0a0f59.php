<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Messages</h4>
                </div>
                <div class="database-btn">
                    <a href="<?php echo e(url('admin/messages/create')); ?>" data-toggle="" data-target="#search-db-model"  class="BE-btn">New Message</a>
                </div>
            </div>
             <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main22" class="display" style="width:100%">
                        <thead>
                            <tr>
                                
                                <th>Sent Date</th>
                                <th>Update Date</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Send Type</th>
                                <th>Attachment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                    <td><?php echo e($record->created_at); ?></td>
                                    <td><?php echo e($record->updated_at); ?></td>                                    
                                    <td><?php echo e($record->subject); ?></td>                                    
                                    <td><?php echo $record->message; ?></td>                           
                                    <td><?php echo e($record->send_type); ?></td>                           
                                    <td>
                                         <?php if(!empty($record->attachment_url)): ?>
                                            <a href="<?php echo url('public'); ?>/<?php echo e($record->attachment_url); ?>" target="_blank" class="label label-success">
                                                <?php echo e(__("View Attachment")); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('admin/messages/')); ?>/<?php echo e($record->id); ?>/edit/" class="text-success" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let datatable = $('#table_main22').DataTable({
                "order": [],
                "pageLength": 100,
                //"rowReorder": true,
                dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    //'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                //"lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]]
            });

            
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>