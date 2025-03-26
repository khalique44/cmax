<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rosen | Admin</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="admin_url" content="<?php echo e(url('admin')); ?>">
    <link href="<?php echo url('public/assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo url('public/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo url('public/assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo url('public/assets/css/admin-style.css'); ?>" rel="stylesheet">

    <link href="<?php echo url('public/assets/css/datatables/jquery.dataTables.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo url('public/assets/css/datatables/buttons.dataTables.min.css'); ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo url('public/assets/css/jquery.minicolors.css'); ?>">
    <link href="<?php echo url('public/assets/css/bootstrap-datepicker.css'); ?>" rel="stylesheet">
    <link href="<?php echo url('public/select2/select2.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo url('public/multi-select/css/multi-select.css'); ?>" rel="stylesheet" />
    <link href="<?php echo url('public/assets/css/bootstrap-colorpicker.css'); ?>" rel="stylesheet" />
    <link href="<?php echo url('public/assets/css/jquery.timepicker.min.css'); ?>" rel="stylesheet" />
    <!-- <link href="css/bootstrap-colorpicker/bootstrap-colorpicker.css" rel="stylesheet"> -->

    <script src="<?php echo url('public/assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo url('public/assets/js/jquery.minicolors.js'); ?>"></script>
    
    <link rel="shortcut icon" href="<?php echo url('public/assets/images/favicon.png'); ?>" />
    <style>
        .number_arrow::-webkit-inner-spin-button,
        .number_arrow::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /*#table_main_users_wrapper .dt-buttons a{
            color: #fff;
            font-weight: 700;
            background: #c30505 none repeat scroll 0 0;
            border: 1px solid #666;
            padding: 5px 16px;
        }

        #table_main_users_wrapper .dt-buttons a:focus{
            color: #c30505;
        }

        #table_main_users_wrapper .dt-buttons a:hover{
            color: #c30505;
            background: #fff;
        }*/

        .district-form-content .form-sec-content label{
            width: auto;
        }
        .form-users {
            width: 50%;
            float: left;
            padding: 0 5px;
        }

        .form-sec {
            background: #e9e9e9;
            border-radius: 5px;
            padding: 40px 0 35px 0;
            margin: 35px 0 0 0;
        }

        .form-content {
            width: 100%;
            display: inline-block;
            padding: 7px 5px 0px 5px;
            border: 1px solid #fff;
            background: #fff;
        }

        /*.district-form-content.add-new-district-form .form-group {
            width: 100% !important;
            display: inline-block;
        }*/

        .form-sec-content {
            width: 100%;
            display: inline-block;
        }
    </style>
</head>
<body id="user-backend">
    <div id="loader" class="lds-dual-ring hidden overlay"></div>
<header>
    <div id="backend-header" class="backend-header">
        <div class="container">
            <div class="logo">
                <div  class="logo-image">
                    <a href="<?php echo route('admin.dashboard'); ?>" style="background:none; height: auto;"><img src="<?php echo url('public/assets/images/logo-white.png'); ?>" class="logo" alt="Logo"></a>
                </div>
                <div class="header-title">
                    <a href="<?php echo route('admin.dashboard'); ?>">ROSEN I VARA</a>
                </div>
            </div>
            <div class="backend-header-content-area">
                <div class="name-title">
                    <h3>Welcome <?php echo e(auth('admin')->user()->name); ?></h3>
                </div>
                <div class="header-login-btn-area">
                    <a  class="btn" href="<?php echo route('admin.logout'); ?>"><?php echo e(__('Logout')); ?></a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="admin-page-whole-content">
    <div class="left-side-bar">
        <div class="side-bar-content" <?php echo $url = str_replace(request()->root(),'',url()->current()); ?>>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <!-- -->
                </div>
                <!-- <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse">
                                <img src="<?php echo e(url('public/assets/images/user-icon.png')); ?>">
                                <strong>Users</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse" class="panel-collapse collapse <?php echo str_contains($url,'/admin/users') ? 'in' : ''; ?><?php echo str_contains($url,'/admin/dashboard') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/')); ?>">All Users</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a  href="<?php echo e(url('admin/dashboard')); ?>">
                                <i class="fa fa-dashboard"></i> 
                                <strong>Dashboard</strong>
                            </a>
                        </h4>
                    </div>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                <img src="<?php echo e(url('public/assets/images/settings.png')); ?>">
                                <strong>Home Page Settings</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse <?php echo str_contains($url,'/admin/home_page') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/home_page/home_settings')); ?>">General Settings</a></li>
                                    <li><a href="<?php echo e(url('admin/home_page/about_section')); ?>">About Rosen I Vara</a></li>
                                    <li><a href="<?php echo e(url('admin/home_page/testimonials')); ?>">Testimonials</a></li>
                                    <li><a href="<?php echo e(url('admin/home_page/team_members')); ?>">Team Members</a></li>
                                    <li><a href="<?php echo e(url('admin/home_page/contact_us')); ?>">Contact Us</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>Om Boende</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse <?php echo str_contains($url,'/admin/about_accommodation') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/about_accommodation/general_settings')); ?>">General Settings</a></li>
                                    <li><a href="<?php echo e(url('admin/about_accommodation/gallery')); ?>">Gallery</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>För Boende</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse <?php echo str_contains($url,'/admin/for_accommodation') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/for_accommodation/general_settings')); ?>">General Settings</a></li>
                                    <li><a href="<?php echo e(url('admin/for_accommodation/content')); ?>">Content</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>Blogg</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse <?php echo str_contains($url,'/admin/blog') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/blog/general_settings')); ?>">General Settings</a></li>
                                    <li><a href="<?php echo e(url('admin/blog/posts')); ?>">Posts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>Kontakta Oss</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse <?php echo str_contains($url,'/admin/contact_us') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/contact_us/general_settings')); ?>">General Settings</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>Login Frontend Page</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse8" class="panel-collapse collapse <?php echo str_contains($url,'/admin/login_page') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/login_page/general_settings')); ?>">General Settings</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>Dashboard Frontend Page</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse9" class="panel-collapse collapse <?php echo str_contains($url,'/admin/dashboard_front') ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/dashboard_front/general_settings')); ?>">General Settings</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                                <img src="<?php echo e(url('public/assets/images/content-icon.png')); ?>">
                                <strong>Laundry Bookings</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse10" class="panel-collapse collapse <?php echo str_contains($url,'/admin/laundry_page_general_settings') ||                    
                        str_contains($url,'/admin/laundry_booking')
                         ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/laundry_booking')); ?>">All Laundry Bookings</a></li>
                                    <li><a href="<?php echo e(url('admin/laundry_page_general_settings')); ?>">General Settings</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                                <img src="<?php echo e(url('public/assets/images/report-icon.png')); ?>">
                                <strong>Reported Issues</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse12" class="panel-collapse collapse <?php echo str_contains($url,'/reported_issues_page_general_settings') ||                     
                        str_contains($url,'/admin/reported_issues')
                         ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/reported_issues')); ?>">All Reported Issues</a></li>
                                    <li><a href="<?php echo e(url('admin/reported_issues_page_general_settings')); ?>">General Settings</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="panel panel-default <?php echo str_contains($url,'/admin/messages') ? 'active' : ''; ?>">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo e(url('admin/messages')); ?>">
                                <i class="fa fa-envelope"></i>
                                <strong>Messages</strong>
                            </a>
                        </h4>
                    </div>
                    
                </div>

                

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                <img src="<?php echo e(url('public/assets/images/settings.png')); ?>">
                                <strong>Settings</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse 
                    <?php echo str_contains($url,'/admin/change-password') ||
                        str_contains($url,'/admin/apartment') ||
                        str_contains($url,'/admin/users') ||
                        str_contains($url,'/admin/global-settings') ||
                        str_contains($url,'/admin/global-styling') ||
                        str_contains($url,'/admin/available_time_slots') ||                      
                        str_contains($url,'/admin/laundries') ||                      
                        str_contains($url,'/admin/issue_reasons')                       
                         
                         ? 'in' : ''; ?>


                    ">
                        <div class="panel-body">
                            <div class="accordions-content-link">
                                <ul>
                                    <li><a href="<?php echo e(url('admin/apartment')); ?>">Apartments</a></li>
                                    <li><a href="<?php echo e(url('admin/users')); ?>">Users</a></li>
                                    <li><a href="<?php echo e(url('admin/available_time_slots')); ?>">Available Time Slots</a></li>
                                    <li><a href="<?php echo e(url('admin/laundries')); ?>">Laundries</a></li>
                                    <li><a href="<?php echo e(url('admin/issue_reasons')); ?>">Issue Reasons</a></li>
                                    
                                    <li><a href="<?php echo e(url('admin/global-settings')); ?>">Global Settings</a></li>
                                    <li><a href="<?php echo e(url('admin/logs')); ?>">Logs</a></li>
                                    <li><a href="<?php echo e(url('admin/global-styling')); ?>">Styling</a></li>
                                    <li><a href="<?php echo e(url('admin/change-password')); ?>">Change Admin Password</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    

<div class="modal" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> This action can not be un-done, Are you sure you want to permanently Remove this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                

                <form style="display: inline-block;" type="hidden" class="data-delete-form" method="POST" action="">
                    <?php echo e(method_field('DELETE' )); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="action-buttons">
                        <button type="submit" class="btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="ResetConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="ResetConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to reset all the colors to default? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
               

                
                    
                        <a   href="<?php echo e(url('admin/global-styling', array('reset_color_to_default'))); ?>" class="btn btn-danger">Reset</a>
                    
                
            </div>
        </div>
    </div>
</div>




    

<div class="modal fade" id="ApproveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="ApproveConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ApproveConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Approve this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                <a id="data-approve-form" class='btn-sm btn-success' href=''>Approve</a>
            </div>
        </div>
    </div>
</div>
    

<div class="modal fade" id="DeclineConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeclineConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeclineConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Decline this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                <a id="data-decline-form" class='btn-sm btn-danger' href=''>Decline</a>
            </div>
        </div>
    </div>
</div>
    

<div class="modal fade" id="CompleteContestConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="CompleteContestConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CompleteContestConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Complete this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                <a id="data-contest-complete-form" class='btn-sm btn-success' href=''>Complete</a>
            </div>
        </div>
    </div>
</div>
    

<div class="modal fade" id="DeclineContestConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeclineContestConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeclineContestConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to Decline this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                    <a id="data-contest-decline-form" class='btn-sm btn-danger' href=''>Decline</a>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="StartContestConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="StartContestConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="StartContestConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to Start this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <a id="data-contest-start-form" class='btn-sm btn-success' href=''>Start</a>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="StartContestConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="StartContestConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="StartContestConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to Start this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <a id="data-contest-start-form" class='btn-sm btn-success' href=''>Start</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UserActiveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="UserActiveConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserActiveConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to Enable this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                    

                    <form style="display: inline-block;" type="hidden" class="data-active-form" method="POST" action="">
                        <?php echo e(csrf_field()); ?>

                        <div class="action-buttons">
                            <button type="submit" class="btn-danger">Enable</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UserInactiveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="UserInactiveConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserInactiveConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to Block this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                    

                    <form style="display: inline-block;" type="hidden" class="data-inactive-form" method="POST" action="">
                        <?php echo e(csrf_field()); ?>

                        <div class="action-buttons">
                            <button type="submit" class="btn-danger">Block</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UserVerifyConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="UserVerifyConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserVerifyConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to Verify this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                    <form style="display: inline-block;" type="hidden" class="data-verify-form" method="POST" action="">
                        <?php echo e(csrf_field()); ?>

                        <div class="action-buttons">
                            <button type="submit" class="btn-danger">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UserVerifyEmailConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="UserVerifyEmailConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserVerifyEmailConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to resend verification email? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                    <form style="display: inline-block;" type="hidden" class="data-verify-form" method="POST" action="">
                        <?php echo e(csrf_field()); ?>

                        <div class="action-buttons">
                            <button type="submit" class="btn-danger">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

<div class="modal fade" id="removeRecord" tabindex="-1" role="dialog" aria-labelledby="RemoveConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RemoveConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to remove this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="data-remove-record" class='btn-sm btn-success'  onclick="removeRecord()">Confirm</button>
            </div>
        </div>
    </div>
</div>
    <?php echo $__env->yieldContent('content'); ?>

<script src="<?php echo url('public/assets/js/jquery.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/parallax.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/moment.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/jQuery.formError.js'); ?>"></script>

<script src="<?php echo url('public/assets/js/dataTables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/dataTables/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/dataTables/pdfmake.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/dataTables/vfs_fonts.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/dataTables/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/dataTables/rowReorder.min.js'); ?>"></script>

<script src="<?php echo url('public/assets/js/app.js'); ?>"></script>
<script src="<?php echo url('public/select2/select2.js'); ?>"></script>


<script src="<?php echo url('public/assets/js/bootstrap-colorpicker.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/jquery.timepicker.min.js'); ?>"></script>
<script src="<?php echo url('public/assets/js/main-admin.js'); ?>"></script>




<script type="text/javascript">


/*Just For Pdf Downloads*/
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#district_membership_table_main_div')[0];

    specialElementHandlers = {
        '#bypassme': function(element, renderer) {
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    pdf.fromHTML(
        source, // HTML string or DOM elem ref.
        margins.left, // x coord
        margins.top, {// y coord
            'width': margins.width, // max width of content on PDF
            'elementHandlers': specialElementHandlers
        },
        function(dispose) {
            pdf.save('Test.pdf');
        }
        , margins);
}

/* DataTable Use For Data display in the table and search filters,pagination and entity limits there */
/* Common alert box for confirm to delete in modules*/

$(document).ready(function() {
    if($("textarea#txtEditor").length > 0){
        CKEDITOR.replace( 'txtEditor' );
    }

     $('.colors').colorpicker({
        popover: false,
        inline: true,
        container: '.color'
      });

    $('.dt-buttons').css({'margin-top':'60px'});
    $('.dt-buttons').css('float', 'right');

    $('.dataTables_length').css('margin-top', '60px');
    $('.dataTables_length').css('margin-left', '-385px');
    /*$('#table_main').DataTable({
        "order": [],
        "pageLength": 2
    });*/
    // $('#table_main').DataTable( {
    //     "processing": false,
    //     "serverSide": false,
    //     "dom": 'Blfrtip',
    //     'pageLength':25,
    //     "buttons": [
    //             'copy', 'csv', 'excel', 'pdf', 'print'
    //             ]
    // });

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

});

/* Just For .csv File Downloads */
$("#tableHTMLExportToCsv").click(function(){
    //$("#table_main").tableToCSV();
    $("#table_main_download").tableToCSV();
});

/* Get States By Clicking On (Country DropDown Selector) */

function DropDownGetStates(countryID)
{
    if(countryID)
    {
        $.ajax({
            type:"GET",
            url:"<?php echo e(url('getstatelist')); ?>?countryid="+countryID,
            success:function(res)
            {
                //alert(res);
                if(res)
                {
                    $("#sel_state").empty();
                    $("#sel_state").append('<option value="" selected>State/Province</option>');
                    $.each(res,function(key,value){
                        $("#sel_state").append('<option value="'+key+'">'+value+'</option> selected');
                    });

                     $.ajax({
                        type:"GET",
                        url:"<?php echo e(url('getyearslist')); ?>?countryid="+countryID,
                        success:function(res1)
                        {

                            if(res1)
                            {
                                if($("#registration_year").length>0){
                                    $("#registration_year").empty();
                                    $("#registration_year").append('<option value="" selected>Select Year</option>');
                                    $.each(res1,function(key,value){
                                        $("#registration_year").append('<option value="'+key+'">'+value+'</option> selected');
                                    });

                                }
                            }
                        }
                    });
                }
                else
                {
                    $("#sel_state").empty();
                }
            }
        });
    }
    else
    {
        $("#state").empty();
        $("#sel_state").empty();
        $("#sel_state").append('<option value="" selected>State/Province</option>');
        $("#sel_district").empty();
        $("#sel_district").append('<option value="" selected>Select District</option>');
    }
}

/* Get Districts By Clicking On (State DropDown Selector) */

function DropDownGetDistricts(stateID)
{
    if(stateID)
    {
        $.ajax({
            type:"GET",
            url:"<?php echo e(url('getdistrictlist')); ?>?stateid="+stateID,

            success:function(res)
            {
                //alert(res);
                if(res)
                {
                    $("#sel_district").empty();
                    $("#sel_district").append('<option value="" selected>Select District</option>');
                    $.each(res,function(key,value){
                        $("#sel_district").append('<option value="'+key+'">'+value+'</option> selected');
                    });
                }
                else
                {
                    $("#sel_district").empty();
                }
            }
        });
    }
    else
    {
        $("#state").empty();
        $("#sel_district").empty();
        $("#sel_district").append('<option value="" selected>Select District</option>');
    }
}
    /* District Update Link at Admin Pannel*/

$(document).on('click','.districts-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/districts/"+id+"/edit";
});

    /* Categories Update Link at Admin Pannel*/

$(document).on('click','.categories-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/categories/"+id+"/edit";

});


/* IP Restriction Update Link at Admin Pannel by KHL */
$(document).on('click','.ip_restrictions-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/ip_restrictions/"+id+"/edit";

});
    /* Countries Update Link at Admin Pannel*/

$(document).on('click','.countries-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/countries/"+id+"/edit";

});

    /* Gym Update Link at Admin Pannel*/

$(document).on('click','.gym-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/gym/"+id+"/edit";
});

    /* MemberShip-Year-Color Update Link at Admin Pannel*/

$(document).on('click','.membership_year_color-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/membership_year_color/"+id+"/edit";
});

    /* Registration Fees Update Link at Admin Pannel*/

$(document).on('click','.registration_fee-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/registration_fee/"+id+"/edit";
});

$(document).on('click','.registration_types-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/registration_types/"+id+"/edit";
});

$(document).on('click','.registration_years-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/modules/registration_years/"+id+"/edit";
});

/* Contests Update Link at Admin Pannel*/

$(document).on('click','.contest-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/contests/"+id+"/edit";
});

/* about sectuion Update Link at Admin Pannel by KHL */
$(document).on('click','.about_section-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/home_page/about_section/"+id+"/edit";

});

/* testimonial Update Link at Admin Pannel by KHL */
$(document).on('click','.testimonial-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/home_page/testimonials/"+id+"/edit";

});


/* team_members Update Link at Admin Pannel by KHL */
$(document).on('click','.team_members-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/home_page/team_members/"+id+"/edit";

});

/* about_accom_gallery Update Link at Admin Pannel by KHL */
$(document).on('click','.about_accom_gallery-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/about_accommodation/gallery/"+id+"/edit";

});

/* for_accom_content Update Link at Admin Pannel by KHL */
$(document).on('click','.for_accom_content-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/for_accommodation/content/"+id+"/edit";

});


/* blogg Update Link at Admin Pannel by KHL */
$(document).on('click','.blog_post-row',function(){
    var id = $(this).data('id');
    window.location.href = "<?php echo e(url('')); ?>/admin/blog/posts/"+id+"/edit";

});




</script>
<script type="text/javascript">
    jQuery(document).on('click','input[name=is_video]', function(){

        if(jQuery(this).val() == 'yes'){
            //jQuery(".image_area").addClass('hide');
            jQuery(".video_area").removeClass('hide');
            jQuery(".add_more_images").addClass('hide');
            
        }else{

            //jQuery(".image_area").removeClass('hide');
            jQuery(".video_area").addClass('hide');
            jQuery(".add_more_images").removeClass('hide');
        }
    });


    var counter = 0;
jQuery(document).on('click','.add_more_images', function(){
counter++;
    var cloned = jQuery(".clone_me").clone().html();
    var newCloned = '<div class="row remove_me_'+counter+'"><legend><span title="Remove" class="text-danger cursor-pointer" data-toggle="modal" data-target="#removeRecord" onclick="removeRow('+counter+')"><i class="fa fa-remove"></i></span></legend>'+cloned+'</div>';
    jQuery(".cloned_area").append(newCloned);
    setTimeout(function(){
            jQuery('.remove_me_'+counter).find(".is_video_radio_button_area").remove();
            jQuery('.remove_me_'+counter).find(".video_area").remove();
            jQuery('.remove_me_'+counter).find(".available-image-area").remove();
            jQuery('.remove_me_'+counter).find("input[name='title[]']").val('title');
            jQuery('.remove_me_'+counter).find(".col-xs-12:eq(0)").hide();
            jQuery('.remove_me_'+counter).find("input[name='title2[]']").val('title2');
            jQuery('.remove_me_'+counter).find(".col-xs-12:eq(1)").hide();
            jQuery('.remove_me_'+counter).find("textarea[name='description[]']").val('description');
            jQuery('.remove_me_'+counter).find(".col-xs-12:eq(2)").hide();
            jQuery(".is_video_radio_button_area").find("#is_video_no").trigger("click");
                        
        },500);
})

function removeRow(count){

    //if(confirm("Are you sure want to remove this row?")){ 
                

        jQuery("#data-remove-record").attr("onclick","removeRecord("+count+")");
            
    //}

}


function  removeRecord(count){
    
    jQuery(".remove_me_"+count).remove();
    jQuery("button.close").trigger('click');
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

<?php if(!empty($counts) && !empty($dayNames)): ?>
<script type="text/javascript">
  var dataCount = <?php echo json_encode($counts); ?>;
  var xValuesRDGR = <?php echo json_encode($dayNames); ?>;
  loadLaundryBookingChart(dataCount,xValuesRDGR);




</script>
<?php endif; ?>

<?php if(!empty($reporetedIssues['counts'])): ?>
    <?php
    $counts = $reporetedIssues['counts'];
    $colorCodes = [];
    ?>
    <?php if($counts): ?>
    <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
    $colorCodes[] = '#'.substr(md5(rand()), 0, 6);
    ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <script type="text/javascript">
      var dataCount = <?php echo json_encode($reporetedIssues['counts']); ?>;
      var xValuesRDGR = <?php echo json_encode($reporetedIssues['title']); ?>;
       var colorCodes = <?php echo json_encode($colorCodes); ?>;
      loadReportedIssues(dataCount,xValuesRDGR,'pie',colorCodes);
    </script>
<?php endif; ?>

<?php if(!empty($yearlyExpCount['expense'])): ?>
    <?php
        $expense = $yearlyExpCount['expense'];
        $colorCodes2 = [];
    ?>
    <?php if($expense): ?>
        <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $colorCodes2[] = '#059862';

            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php endif; ?>
<?php  //dd($colorCodes2); ?>
<?php if(!empty($yearlyExpCount)): ?>
<script type="text/javascript">
  var dataCount = <?php echo json_encode($yearlyExpCount['expense']); ?>;
  var xValuesRDGR = <?php echo json_encode($yearlyExpCount['month_name']); ?>;
  var colorCodes = <?php echo json_encode($colorCodes2); ?>;
  loadReportedIssues(dataCount,xValuesRDGR,'bar',colorCodes);

</script>
<?php endif; ?>
    <?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH D:\wamp64\www\rosen\resources\views/layouts/admin.blade.php ENDPATH**/ ?>