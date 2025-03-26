<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4><?php echo e(__('REPORTED ISSUES')); ?></h4>
                </div>
                <div class="database-btn hidden">
                    <a href="<?php echo e(url('admin/reported_issues/create')); ?>" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add</a>
                </div>
            </div>
            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="database-table-section">

                <div class="db-table-content table-responsive">
                    <div class="category-filter row">

                      <select id="categoryFilter" class="form-control">
                        <option value="">Filter by Status</option>
                        <option value="">Show All</option>
                        <option value="New">Open</option>
                        <option value="Closed">Closed</option>
                        
                      </select>


                    </div>
                    <!-- Main Table Start-->

                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Apartment</th>
                            <th>Assigned To</th>                            
                            <th>Where</th>
                            <th>Reason</th>
                            <th width="28%">Description</th>
                            <th>Contact</th>                      
                            <th>Attachment</th>
                            <th><div> <strong ><a href="<?php echo e(url('admin/reported_issues/hide_issues')); ?>/" class="">Hide Closed</a></strong></div>Status </th>
                            <th>Update</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr data-entry-id="<?php echo e($record->id); ?>">

                                <td>
                                    <?php echo e($record->created_at); ?>


                                </td>
                                <td>
                                    <?php echo !empty($record->users->username) ?    $record->users->username  : ''; ?>


                                </td>
                                <td><?php echo $record->assign_to ? 'Vendor' : 'Admin'; ?></td>                               
                                  
                                

                                <td>
                                    <?php echo e($record->room_area); ?>


                                </td>

                                <td>
                                    <?php echo !empty($record->reason->title) ? $record->reason->title : ''; ?>


                                </td>

                                <td>
                                    <?php echo e($record->description); ?>


                                </td>
                                <td>
                                    <strong>Name: </strong> <?php echo e($record->full_name); ?><br>
                                    <strong>Phone: </strong><?php echo e($record->phone); ?><br>
                                    <strong>Email: </strong><?php echo e($record->email); ?>


                                </td>
                                
                                        
                                <td>
                                    <?php if($record->issuesAttachments->count() > 0): ?>
                                        <?php $__currentLoopData = $record->issuesAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo url('public'); ?>/<?php echo e($attachment->attachment_url); ?>" target="_blank" class="badge badge-info"><i class="fa fa-eye"></i> <?php echo e(__('View File')); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <?php echo e(__('N/A')); ?>


                                    <?php endif; ?>
                                  </td>                                            
                                <td >
                                    <?php if(Config::get('constants.issue_status.close') == $record->issue_status): ?>
                                    <span class="label label-success"><?php echo e($record->issue_status); ?></span>
                                    <?php elseif(Config::get('constants.issue_status.inprogress') == $record->issue_status): ?>
                                    <span class="label label-primary"><?php echo e($record->issue_status); ?></span>
                                    <?php elseif(Config::get('constants.issue_status.new') == $record->issue_status): ?>
                                    <span class="label label-danger"><?php echo e($record->issue_status); ?></span>
                                    <?php elseif(Config::get('constants.issue_status.verification') == $record->issue_status): ?>
                                    <span class="label label-warning"><?php echo e($record->issue_status); ?></span>
                                    <?php endif; ?>
                                   
                                </td>
                                <td>
                                    <a href="<?php echo e(url('admin/reported_issues/')); ?>/<?php echo e($record->id); ?>/" class="text-success" title="View Record"><i class="fa fa-eye"></i></a>
                                    <?php if($record->issues_comments_count > 0): ?>
                                        | <a href="<?php echo e(url('admin/reported_issues/')); ?>/<?php echo e($record->id); ?>/" class="" title="<?php echo e(__('New Comments')); ?>"><?php echo e($record->issues_comments_count); ?>  <i class="fa fa-comment"></i> </a>
                                   <?php endif; ?>
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
                "order": [],
                "pageLength": 100,
                "rowReorder": true,
                dom: 'Bfrtip',
                buttons: [

                    
                    //'copyHtml5',
                    //'excelHtml5',
                    //'csvHtml5',
                    //'pdfHtml5'

                    {
                        charset: 'utf-8',
                        bom: true,
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4,5,6,7,8 ],
                            format: {
                                body: function ( data, column, row ) {
                                   
                                    if (column === 6) {
                                        data = data.replace(/<br\s*\/?>/ig, "\n");
                                    }
                                    
                                    data = data.replace(/<.*?>/ig, "");
                                    data = data.replace(/^\s+|\s+$/gm,'');
                                    //if (column === 7) {
                                        //alert("data:" + data)
                                        //data = (data == 'View File') ? 'Yes' : 'No';
                                        data = data.replace('View File','Yes');
                                        data = data.replace('N/A','No');
                                    //}
                                    return   data;
                                }
                            }
                        }
                    },
                    {
                        charset: 'utf-8',
                        bom: true,
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4,5,6,7,8 ],
                            format: {
                                body: function ( data, column, row ) {
                                   
                                    if (column === 6) {
                                        data = data.replace(/<br\s*\/?>/ig, "\n");
                                    }
                                    
                                    data = data.replace(/<.*?>/ig, "");
                                    data = data.replace(/^\s+|\s+$/gm,'');
                                    //if (column === 7) {
                                        //alert("data:" + data)
                                        //data = (data == 'View File') ? 'Yes' : 'No';
                                        data = data.replace('View File','Yes');
                                        data = data.replace('N/A','No');
                                    //}
                                    return   data;
                                }
                            }
                        }
                    },
                    
                    'colvis'
                ],
                "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]],
                "columnDefs": [
                                { "width": "8%", "targets": 0 },
                                { "width": "8%", "targets": 1 },
                                { "width": "8%", "targets": 2 },
                                { "width": "8%", "targets": 3 },
                                { "width": "8%", "targets": 4 },
                                { "width": "28%", "targets": 5 },
                                { "width": "8%", "targets": 6 },
                                { "width": "8%", "targets": 7 },
                                { "width": "8%", "targets": 8 },
                                { "width": "8%", "targets": 9 }
                            ],

            });

            $("#table_main_filter.dataTables_filter").append($("#categoryFilter"));
      
              //Get the column index for the Category column to be used in the method below ($.fn.dataTable.ext.search.push)
              //This tells datatables what column to filter on when a user selects a value from the dropdown.
              //It's important that the text used here (Category) is the same for used in the header of the column to filter
              var categoryIndex = 0;
              $("#filterTable th").each(function (i) {
                if ($($(this)).html() == "Status") {
                  categoryIndex = i; return false;
                }
              });

              //Use the built in datatables API to filter the existing rows by the Category column
              $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                  var selectedItem = $('#categoryFilter').val()
                  var category = data[8];
                  category = category.replace(/<.*?>/ig, "");
                  
                  if (selectedItem === "" || category.includes(selectedItem)) {
                    return true;
                  }
                  return false;
                }
              );

              //Set the change event for the Category Filter dropdown to redraw the datatable each time
              //a user selects a new filter.
              $("#categoryFilter").change(function (e) {
                datatable.draw();
              });

              datatable.draw();
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/report_issues/index.blade.php ENDPATH**/ ?>