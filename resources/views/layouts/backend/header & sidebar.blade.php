<!-- Header -->
<div class="header">

    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    
    <!-- Header Title -->
    <div class="page-title-box">
        <a href="/"><h3>Youtube Earn Admin Panel</h3></a>
    </div>
    <!-- /Header Title -->
    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    
    <!-- Header Menu -->
    <ul class="nav user-menu">

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img src="{{asset('storage/media/'.Auth::user()->avatar)}}" alt="avatar">
                <span class="status online"></span></span>
                <span>{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('profile')}}"><i class="fa fa-user"></i> My Profile</a>
                <a class="dropdown-item" href="#" onclick="logout()"><i class="fa fa-sign-out"></i> Logout</a>
                <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}"><i class="fa fa-user"></i> My Profile</a>
            <a class="dropdown-item" href="#" onclick="logout()"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
    
</div>
<!-- /Header -->

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li> 
                    <a class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li> 
                    <a class="{{ Request::is('admin/headline') ? 'active' : '' }}" href="{{route('admin.headline')}}"><i class="fa fa-newspaper-o"></i> <span>Headline</span></a>
                </li>

                <li> 
                    <a class="{{ Request::is('admin/level*') ? 'active' : '' }}" href="{{route('admin.level.index')}}"><i class="fa fa-level-up"></i> <span>Level</span></a>
                </li>

                <li> 
                    <a class="{{ Request::is('admin/refer-bonus') ? 'active' : '' }}" href="{{route('admin.referBonus')}}"><i class="fa fa-gift"></i> <span>Refer Bonus</span></a>
                </li>
                
                <li> 
                    <a class="{{ Request::is('admin/monthly-commision*') ? 'active' : '' }}" href="{{route('admin.monthlyCommision')}}"><i class="fa fa-money"></i> <span>Monthly Commision</span></a>
                </li>

                <li class="submenu">
                    <a class="{{ Request::is('admin/pincode*') ? 'active' : '' }}" href="#"><i class="fa fa-thumb-tack"></i> <span> Pincode</span><span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.pincode.index')}}">All Code</a></li>
                        <li><a href="{{route('admin.pincode.create')}}">Add New</a></li>r
                    </ul>
                </li>

                <li class="submenu">
                    <a class="{{ Request::is('admin/task*') ? 'active' : '' }}" href="#"><i class="fa fa-tasks"></i> <span> Task</span><span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.task.index')}}">All Task</a></li>
                        <li><a href="{{route('admin.task.create')}}">Add New</a></li>r
                    </ul>
                </li>

                <li> 
                    <a class="{{ Request::is('admin/submission') ? 'active' : '' }}" href="{{route('admin.submission.index')}}"><i class="fa fa-inbox"></i> <span>Submission</span></a>
                </li>

                <li> 
                    <a class="{{ Request::is('admin/withdrawals') ? 'active' : '' }}" href="{{route('admin.withdrawals.index')}}"><i class="fa fa-money"></i> <span>Withdrawals</span></a>
                </li>

                <li class="submenu">
                    <a class="{{ Request::is('admin/notification*') ? 'active' : '' }}" href="#"><i class="fa fa-bell"></i> <span> Notification</span><span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.notification')}}">See All</a></li>
                        <li><a href="{{route('admin.notification.create')}}">Add New</a></li>r
                    </ul>
                </li>

                <li class="submenu">
                    <a class="{{ Request::is('admin/user*') ? 'active' : '' }}" href="#"><i class="fa fa-users"></i> <span> Users</span><span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.users.index')}}">See All</a></li>
                        <li><a href="{{route('admin.users.create')}}">Add New</a></li>r
                    </ul>
                </li>

                <li> 
                    <a href="{{route('profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a>
                </li>

                <li> 
                    <a href="#" onclick="logout()"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
