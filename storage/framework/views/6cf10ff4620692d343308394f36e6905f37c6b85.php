<?php $__env->startSection('content'); ?>

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Users</h4>
                </div>
                <div class="database-btn">
                    <a href="" data-toggle="modal" data-target="#search-db-model"  class="BE-btn hidden">Search Database</a>
                    <a href="<?php echo e(url('admin/users')); ?>" class="BE-btn hidden"> Clear</a>
                    <a href="<?php echo e(url('admin/users/create')); ?>" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add User</a></br></br>
                </div>
            </div>
       

            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main_users" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Type</th>                            
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->first_name); ?></td>
                                <td><?php echo e($user->last_name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e(ucfirst($user->type)); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="<?php echo e(route('users.show',$user->id)); ?>" class="btn-sm btn-primary" >
                                            View
                                        </a>
                                        <a type="submit" href="<?php echo e(url("admin/users/{$user->id}/edit")); ?>" class="btn-sm btn-success action-button">
                                            Update
                                        </a>
                                        
                                        
                                        
                                        <a type="button" href="#" class="btn-sm btn-danger btn_user_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="<?php echo e($user->id); ?>">
                                            Delete
                                        </a>

                                        <?php if($user->is_active == 1): ?>
                                            <a type="button" href="#" class="btn-sm btn-danger btn_user_inactive" data-toggle="modal" data-target="#UserInactiveConfirmationModal" data-inactive-id="<?php echo e($user->id); ?>">
                                                Disable
                                            </a>
                                        <?php else: ?>
                                            <a type="button" href="#" class="btn-sm btn-success btn_user_active" data-toggle="modal" data-target="#UserActiveConfirmationModal" data-active-id="<?php echo e($user->id); ?>">
                                                Enable
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                

            </div>
        </div>
    </div>

    <div class="Search-bd-alert-model">
        <div class="modal fade" id="search-db-model" tabindex="-1" role="dialog" aria-labelledby="advancePicksAlertLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="title">
                            <h4>SEARCH DATABASE</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-inner-content">
                            <div class="db-credentials">
                                <form action="<?php echo e(url('admin/users')); ?>">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_country" class="btn btn-secondary dropdown-toggle" id="sel_country" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by country"
                                                        onchange="DropDownGetStates(this.value)">
                                                    <div class="dropdown-menu" aria-labelledby="">
                                                        <option value="" selected >Select Country</option>
                                                        <?php
                                                        $country = $countries->where('short_name', 'US')->first();
                                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($sel_country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                                        $country = $countries->where('short_name', 'CA')->first();
                                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($sel_country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';

                                                        foreach($countries as $country){
                                                            //if(!in_array($country->short_name,['US','CA','NZ']))
                                                                echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($sel_country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                                        }
                                                        ?>
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_state" class="btn btn-secondary dropdown-toggle" id="sel_state" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by district"
                                                        onchange="DropDownGetDistricts(this.value)">
                                                    <div class="dropdown-menu" aria-labelledby="">
                                                        <option value="" selected>State/Province</option>
                                                        <?php
                                                        $states = \DB::table('states')->where('country_id',$sel_country)->get();
                                                        foreach($states as $state){
                                                            echo '<option value="'.$state->id.'" data-id="'.$state->id.'"'.($sel_state == $state->id ? "selected class=\"active\"" : "").'>'.$state->name.'</option>';
                                                        }
                                                        ?>
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                   
                                    <div class="form-group">
                                        <label>Category</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_category" class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by district">
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <option value="0" selected >Select Category</option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($c_data->id); ?>" <?php if($sel_category == $c_data->id){ echo "selected"; }?> ><?php echo e($c_data->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Year(s) Of Registration</label>
                                        <input type="number" class="backend-field" placeholder="Search by year" name="sel_year" id="sel_year" value="<?php echo e($sel_year); ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="opt-select">
                                            <label>Select</label>
                                            <div class="database-select-option">
                                                <input id="active" type="radio" name="sel_option" value="active"
                                                <?php if($sel_option == 'active' ){ echo "checked"; }?> >
                                                <div class="opt-title">
                                                    <h5>Active</h5>
                                                </div>
                                            </div>
                                            <div class="database-select-option">
                                                <input id="active" type="radio" name="sel_option" value="inactive"
                                                <?php if($sel_option == 'inactive' ){ echo "checked"; }?> >
                                                <div class="opt-title">
                                                    <h5>Inactive</h5>
                                                </div>
                                            </div>
                                            <div class="database-select-option">
                                                <input id="active" type="radio" name="sel_option" value="both"
                                                <?php if($sel_option == 'both' ){ echo "checked"; }?> >
                                                <div class="opt-title">
                                                    <h5>Both</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="modal-btn-area">
                                            <div class="find-btn">
                                                <button type="submit" href="javascript:void(0);" name="btn_admin_search_database" class="modal-btn find-btn">
                                                    Find
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.btn_user_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "<?php echo e(url('')); ?>/admin/users/"+DataDeleteId);
        });

        $('.btn_user_active').on('click',function () {
            var DataActiveId = $(this).attr('data-active-id');
            $(".data-active-form").attr('action', "<?php echo e(url('')); ?>/admin/usersActiveUpdate/"+DataActiveId);
        });

        $('.btn_user_inactive').on('click',function () {
            var DataInActiveId = $(this).attr('data-inactive-id');
            $(".data-inactive-form").attr('action', "<?php echo e(url('')); ?>/admin/usersInActiveUpdate/"+DataInActiveId);
        });

        $(document).ready(function() {
            $('#table_main_users').DataTable({
                "order": [],
                "pageLength": 25,
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/users/index.blade.php ENDPATH**/ ?>