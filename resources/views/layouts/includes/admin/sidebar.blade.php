<div class="left-side-bar">
    <div class="side-bar-content" {!! $url = str_replace(request()->root(),'',url()->current()); !!}>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <!-- -->
            </div>
            <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse">
                            <img src="{{url('public/assets/images/user-icon.png')}}">
                            <strong>Users</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse" class="panel-collapse collapse {!! str_contains($url,'/admin/users') ? 'in' : '' !!}{!! str_contains($url,'/admin/dashboard') ? 'in' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/')}}">All Users</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a  href="{{url('admin/dashboard')}}">
                            <i class="fa fa-dashboard"></i> 
                            <strong>Dashboard</strong>
                        </a>
                    </h4>
                </div>
                <!-- <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <img src="{{url('public/assets/images/settings.png')}}">
                            <strong>Home Page Settings</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse {!! str_contains($url,'/admin/home_page') ? 'in' : '' !!}">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                <li><a href="{{url('admin/home_page/home_settings')}}">General Settings</a></li>
                                <li><a href="{{ url('admin/home_page/about_section') }}">About Rosen I Vara</a></li>
                                <li><a href="{{ url('admin/home_page/testimonials') }}">Testimonials</a></li>
                                <li><a href="{{ url('admin/home_page/team_members') }}">Team Members</a></li>
                                <li><a href="{{ url('admin/home_page/contact_us') }}">Contact Us</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>              

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            <img src="{{url('public/assets/images/settings.png')}}">
                            <strong>Settings</strong>
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse 
                {!! 
                    str_contains($url,'/admin/change-password') ||                        
                    str_contains($url,'/admin/users') ||
                    str_contains($url,'/admin/global-settings') ||
                    str_contains($url,'/admin/global-styling') ||                              
                    str_contains($url,'/admin/logs')                         
                     
                     ? 'in' : '' 
                !!}

                ">
                    <div class="panel-body">
                        <div class="accordions-content-link">
                            <ul>
                                
                                <li><a href="{{url('admin/users')}}">Users</a></li>
                                <li><a href="{{url('admin/global-settings')}}">Global Settings</a></li>
                                <li><a href="{{url('admin/logs')}}">Logs</a></li>
                                <li><a href="{{url('admin/global-styling')}}">Styling</a></li>
                                <li><a href="{{url('admin/change-password')}}">Change Admin Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>