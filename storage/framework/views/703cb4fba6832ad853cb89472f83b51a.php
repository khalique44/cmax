

<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Logs</h4>
                </div>
                
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
								<th>Subject</th>
								<th>User</th>
								<th>Method</th>
								<th>Ip</th>
								<th width="300px">User Agent</th>
								
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($logs->count()): ?>
								<?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $userUrl =  url('admin/users/').'/'.$log->user_id; ?>
	                                <tr>
	                                    <td><?php echo e(++$key); ?></td>
										<td><?php echo e($log->subject); ?></td>
										<td><?php echo !empty($log->users->full_name) ? '<a href="'.$userUrl.'" target="_blank" class="text-primary">'. $log->users->full_name.'<br> ('.$log->users->username.')</a>' : ''; ?></td>
										<td><label class="label label-info"><?php echo e($log->method); ?></label></td>
										<td class="text-warning"><?php echo e($log->ip); ?></td>
										<td class="text-danger"><?php echo e($log->agent); ?></td>
										
                                       
										<td> <a type="button" href="#" class="btn-sm btn-danger btn_log_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($log->id); ?>">
                                            Delete
                                        </a></td>
	                                </tr>
                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let datatable = $('#table_main').DataTable({
                "order": [0,'asc'],
                "pageLength": 100,
                //"rowReorder": true,
                dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    //'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]]
            });

            datatable.on('row-reorder', function (e, details) {
                if(details.length) {
                    let rows = [];
                    details.forEach(element => {
                        rows.push({
                            id: $(element.node).data('entry-id'),
                            position: element.newData
                        });
                        console.log(element.newData, $(element.node).data('entry-id'))
                    });

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        method: 'POST',
                        url: "<?php echo e(url('admin/messages/update_position')); ?>",
                        data: { rows }
                    }).done(function () { datatable.draw(); });
                }

            });

            $('.btn_log_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/logs/"+DataDeleteId);
        });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\cmax1\resources\views/admin/log_activity/index.blade.php ENDPATH**/ ?>