<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Available Time Slots</h4>
                </div>
                <div class="database-btn">
                    <a href="<?php echo e(url('admin/available_time_slots/create')); ?>" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add</a>
                </div>
            </div>
            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="database-table-section">
                
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Day</th>
                            <th>Time</th>                           
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($record->id); ?>">

                                <td class="cursor-pointer" ><?php echo e(($key+1)); ?></td>
                                <td><?php echo e($record->year); ?></td>
                                  
                                <td>

                                    <?php echo e($record->month); ?>



                                </td>  
                                <td>

                                    <?php echo e($record->day); ?>



                                </td>                          
                                <td>

                                     <?php echo e(App\Http\Helpers\RosenHelper::timeSlotFormat($record->time_from)); ?> : <?php echo e(App\Http\Helpers\RosenHelper::timeSlotFormat($record->time_to)); ?>



                                </td>
                                <td>

                                    <a href="<?php echo e(url('admin/available_time_slots/')); ?>/<?php echo e($record->id); ?>/edit/" class="text-success" title="Edit Record"><i class="fa fa-pencil"></i></a>


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
                "order": [0,'asc'],
                "pageLength": 100,
                "rowReorder": true
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
                        url: "<?php echo e(url('admin/available_time_slots/update_position')); ?>",
                        data: { rows }
                    }).done(function () { datatable.draw(); });
                }

            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/available_time_slots/index.blade.php ENDPATH**/ ?>