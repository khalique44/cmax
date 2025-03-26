<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4><?php echo e(__("LAUNDRY BOOKINGS")); ?></h4>
                </div>
                <div class="database-btn">
                    <a href="<?php echo e(url('admin/laundry_booking/create')); ?>" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add</a>
                </div>
            </div>
            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="database-table-section">

                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            
                            <th>Booking By</th>
                            <th>Booking Date</th>
                            <th>Booking Time</th>                            
                            <th>Laundry</th>
                            <th>Created Date</th>
                            <th  class="hidden">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            

                            <tr data-entry-id="<?php echo e($record->id); ?>">
                                
                               
                                <td><?php echo $record->is_admin ? 'Admin' : $record->users->username; ?></td>
                                  
                                <td>
                                    <?php if(Carbon\Carbon::createFromFormat('d/m/Y H:i', $record->booking_date.' '.$record->time_from)->isPast()): ?>
                                        <span class="label label-danger" title="<?php echo e(__('Date Passed')); ?>"> <?php echo e($record->booking_date_format); ?></span>
                                    <?php else: ?>
                                        <span class="label label-success" title=""><?php echo e($record->booking_date_format); ?></span>
                                    <?php endif; ?>
                                   

                                </td>
                                
                                <td>
                                    <?php if(Carbon\Carbon::createFromFormat('d/m/Y H:i', $record->booking_date.' '.$record->time_from)->isPast()): ?>
                                        <span class="label label-danger" title="<?php echo e(__('Time Passed')); ?>"><?php echo e($record->booking_time); ?></span>
                                    <?php else: ?>
                                        <span class="label label-success" title=""><?php echo e($record->booking_time); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($record->laundry_number); ?>


                                </td>   


                                <td>
                                    <?php echo e($record->created_at); ?>


                                </td>                         
                                <td class="hidden">
                                    <?php if($record->is_removed == 1): ?> 
                                        <span class="label label-success">Removed</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Available</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('admin/laundry_booking/')); ?>/<?php echo e($record->id); ?>/edit/" class="text-success" title="Edit Record"><i class="fa fa-pencil"></i></a>
                                     
                                        
                                   
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
            let datatable = $('#table_main').DataTable({
                "order":  [],
                "pageLength": 100,
                //"rowReorder": true,
                dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    //'excelHtml5',
                    //'csvHtml5',
                    //'pdfHtml5'
                     {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    
                    'colvis'



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
                        url: "<?php echo e(url('admin/laundry_booking/update_position')); ?>",
                        data: { rows }
                    }).done(function () { datatable.draw(); });
                }

            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/lanudry_bookings/index.blade.php ENDPATH**/ ?>