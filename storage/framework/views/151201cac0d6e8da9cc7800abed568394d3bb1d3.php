<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Apartments</h4>
                </div>
                <div class="database-btn">
                    <a href="<?php echo e(url('admin/apartment/create')); ?>" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add</a>
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
                            <th>Apartment ID</th>                           
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($record->id); ?>">

                                <td class="" ><?php echo e(($key+1)); ?></td>
                                <td><?php echo e($record->apartment_id); ?></td> 
                                <td>

                                    <?php if($record->status == 'yes'): ?> 
                                    <span class="label label-success">Yes</span>
                                    <?php else: ?>
                                    <span class="label label-danger">No</span>
                                    <?php endif; ?>


                                </td>
                                <td>

                                    <a href="<?php echo e(url('admin/apartment/')); ?>/<?php echo e($record->id); ?>/edit/" class="text-success" title="Edit Record"><i class="fa fa-pencil"></i></a>


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
                "order": [1,'asc'],
                "pageLength": 100,
                "rowReorder": true,
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
                        url: "<?php echo e(url('admin/apartment/update_position')); ?>",
                        data: { rows }
                    }).done(function () { datatable.draw(); });
                }

            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/apartments/index.blade.php ENDPATH**/ ?>