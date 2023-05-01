  <!-- start sidebar menu -->
  <div class="sidebar-container">
  	<div class="sidemenu-container navbar-collapse collapse fixed-menu">
  		<div id="remove-scroll">
  			<ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
  				<li class="sidebar-toggler-wrapper hide">
  					<div class="sidebar-toggler">
  						<span></span>
  					</div>
  				</li>
  				<!-- <li class="sidebar-user-panel">
  					<div class="user-panel">
  						<div class="pull-left image">
  							<?php
								$profile = DB::table('users')->where('id', auth()->user()->id)->value('profile_pic');
								$user_name = DB::table('users')->where('id', auth()->user()->id)->value('name');
								?>
  							<?php
								if ($profile != "") { ?>
  								<img src="{{url('images/'.$profile)}}" class="img-circle user-img-circle" alt="User Image" />
  							<?php } else { ?>
  								<img src="{{ asset('assets/img/dp.jpg')}}" class="img-circle user-img-circle" alt="User Image" />
  							<?php }
								?>

  						</div>
  						<div class="pull-left info">
  							<p> {{$user_name}}</p>
  							<a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
  						</div>
  					</div>
  				</li> -->
  				<?php if (auth()->user()->auth_level == 9) { ?>

  					<li class="nav-item">
  						<a href="{{route('dashboard')}}" class="nav-link nav-toggle {{request()->is('dashboard')?'active' :''}}">
							
<span class="title"><i class="fa fa-tasks fa-1x" aria-hidden="true"></i>Dashboard</span>
  						</a>
  					</li>
  					<li class="nav-item">
  						<a href="{{route('newPost') }}" class="nav-link nav-toggle {{request()->is('newPost')?'active' :''}}">
								<span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
  							<span class="title">Add New Post</span>
  						</a>
  					</li>
  					<li class="nav-item">
  						<a href="{{route('postOnApproval')}}" class="nav-link nav-toggle {{request()->is('postOnApproval','editApprovalPost*')?'active' :''}}"><i class="fa fa-check-circle fa-fw" aria-hidden="true"></i>
  							<span class="title">Post on Approval</span>
  						</a>
  					</li>
  					<li class="nav-item">
  						<a href="{{route('postOnSchedule')}}" class="nav-link nav-toggle {{request()->is('postOnSchedule','editSchedulePost*')?'active' :''}}"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
  							<span class="title">Post on Schedule</span>
  						</a>
  					</li>
  					<li class="nav-item">
  						<a href="{{route('postOnSite')}}" class="nav-link nav-toggle {{request()->is('postOnSite','editSitePost*')?'active' :''}}"><i class="fa fa-share" aria-hidden="true"></i>
  							<span class="title">Post on Site</span>
  						</a>
  					</li>
  					<li class="nav-item">
  						<a href="{{route('postOnExpired')}}" class="nav-link nav-toggle {{request()->is('postOnExpired','editExpiredPost*')?'active' :''}}"><i class="fa fa-clock-o" aria-hidden="true"></i>
  							<span class="title">Post on Expired</span>
  						</a>
  					</li>
  					<li class="nav-item">
  						<a href="#" class="nav-link nav-toggle {{request()->is('showroom','category','tag')?'open' :''}}"> <i class="material-icons">school</i>
  							<span class="title">Master</span> <span class="arrow"></span>
  						</a>
  						<ul class="sub-menu" style="{{request()->is('tagMaster*','categoryMaster*','showroomMaster*')?'display:block;' :''}}">
  							<li class="nav-item ">
  								<a href="{{url('tagMaster')}}" class="nav-link {{request()->is('tagMaster*')?'active' :''}}">
  									<i class="material-icons">label</i>
  									<span class="title">Tag</span>
  								</a>
  							</li>
  							<li class="nav-item">
  								<a href="{{url('categoryMaster')}}" class="nav-link {{request()->is('categoryMaster*')?'active' :''}}">
  									<i class="material-icons">label</i>
  									<span class="title">Category</span>
  								</a>
  							</li>
							  <li class="nav-item">
  								<a href="{{url('showroomMaster')}}" class="nav-link {{request()->is('showroomMaster*')?'active' :''}}">
  									<i class="material-icons">label</i>
  									<span class="title">Showroom</span>
  								</a>
  							</li>

  						</ul>
  					</li>

  					<li class="nav-item" style="display: none">
  						<a href="{{route('Permissions')}}" class="nav-link nav-toggle {{request()->is('Permissions','addPermission','editPermission*')?'active' :''}}"> <i class="material-icons">settings</i>
  							<span class="title">Permissions</span>
  						</a>
  					</li>

  					<li class="nav-item">
  						<a href="{{route('Roles')}}" class="nav-link nav-toggle {{request()->is('Roles','addRoles','editRoles*')?'active' :''}}"> <i class="material-icons">menu_open</i>
  							<span class="title">Roles</span>
  						</a>
  					</li>

  					<li class="nav-item">
  						<a href="{{route('users')}}" class="nav-link nav-toggle {{request()->is('users','addUser','editUser*')?'active' :''}}"> <i class="material-icons">face</i>
  							<span class="title">Users</span>
  						</a>
  					</li>
  				<?php } ?>

  				<?php if (auth()->user()->auth_level == 8) { ?>
  					<?php $roles = DB::table('roles')->where('role_id', auth()->user()->role)->get();
							foreach ($roles as $r) {
								$permission_id = $r->permission_id;
								$permission_status = $r->permission_status;
								$permission_name = DB::table('permissions')->where('id', $permission_id)->value('name'); ?>

  						<?php if ($permission_name == 'Add New Post' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('newPost')}}" class="nav-link nav-toggle {{request()->is('newPost')?'active' :''}}"> <i class="material-icons">event</i>
  									<span class="title">Add New Post</span>
  								</a>
  							</li>
  						<?php } ?>

  						<?php if ($permission_name == 'Post on Approval' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('postOnApproval')}}" class="nav-link nav-toggle {{request()->is('postOnApproval','editApprovalPost*')?'active' :''}}"> <i class="material-icons">check_box</i>
  									<span class="title">Post on Approval</span>
  								</a>
  							</li>
  						<?php } ?>

  						<?php if ($permission_name == 'Post on Schedule' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('postOnSchedule')}}" class="nav-link nav-toggle {{request()->is('postOnSchedule','editSchedulePost*')?'active' :''}}"> <i class="material-icons">check_box</i>
  									<span class="title">Post on Schedule</span>
  								</a>
  							</li>
  						<?php } ?>

  						<?php if ($permission_name == 'Post on Site' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('postOnSite')}}" class="nav-link nav-toggle {{request()->is('postOnSite','editSitePost*')?'active' :''}}"> <i class="material-icons">check_box</i>
  									<span class="title">Post on Site</span>
  								</a>
  							</li>
  						<?php } ?>

  						<?php if ($permission_name == 'Post on Expired' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('postOnExpired')}}" class="nav-link nav-toggle {{request()->is('postOnExpired','editExpiredPost*')?'active' :''}}"> <i class="material-icons">check_box</i>
  									<span class="title">Post on Expired</span>
  								</a>
  							</li>
  						<?php } ?>
  						<?php if ($permission_name == 'Master' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="#" class="nav-link nav-toggle {{request()->is('tag','category','showroom')?'open' :''}}"> <i class="material-icons">school</i>
  									<span class="title">Master</span> <span class="arrow"></span>
  								</a>
  								<ul class="sub-menu" style="{{request()->is('tagMaster*','categoryMaster*','showroomMaster*')?'display:block;' :''}}">

  									<li class="nav-item ">
  										<a href="{{url('tagMaster')}}" class="nav-link {{request()->is('tagMaster*')?'active' :''}}">
  											<i class="material-icons">label</i>
  											<span class="title">Tag</span>
  										</a>
  									</li>


  									<li class="nav-item">
  										<a href="{{url('categoryMaster')}}" class="nav-link {{request()->is('categoryMaster*')?'active' :''}}">
  											<i class="material-icons">label</i>
  											<span class="title">Category</span>
  										</a>
  									</li>

  								</ul>
  							</li>
  						<?php  } ?>
  						<?php if ($permission_name == 'Permissions' && $permission_status == 1) { ?>
  							<li class="nav-item" style="display: none">
  								<a href="{{route('Permissions')}}" class="nav-link nav-toggle {{request()->is('Permissions')?'active' :''}}"> <i class="material-icons">settings</i>
  									<span class="title">Permissions</span>
  								</a>
  							</li>
  						<?php } ?>

  						<?php if ($permission_name == 'Roles' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('Roles')}}" class="nav-link nav-toggle {{request()->is('Roles')?'active' :''}}"> <i class="material-icons">menu_open</i>
  									<span class="title">Roles</span>
  								</a>
  							</li>
  						<?php } ?>

  						<?php if ($permission_name == 'Users' && $permission_status == 1) { ?>
  							<li class="nav-item">
  								<a href="{{route('users')}}" class="nav-link nav-toggle {{request()->is('users')?'active' :''}}"> <i class="material-icons">face</i>
  									<span class="title">Users</span>
  								</a>
  							</li>
  						<?php } ?>

  					<?php } ?>

  				<?php } ?>

  			</ul>
  		</div>
  	</div>
  </div>
  <!-- start color quick setting -->
  <div class="quick-setting-main">
  	<button class="control-sidebar-btn btn" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></button>
  	<div class="quick-setting display-none">
  		<ul id="themecolors">

  			<li>
  				<p class="selector-title">Sidebar Color</p>
  			</li>
  			<li class="complete">
  				<div class="theme-color sidebar-theme">
  					<a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
  				</div>
  			</li>
  			<li>
  				<p class="selector-title">Header Brand color</p>
  			</li>
  			<li class="theme-option">
  				<div class="theme-color logo-theme">
  					<a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
  				</div>
  			</li>
  			<li>
  				<p class="selector-title">Header color</p>
  			</li>
  			<li class="theme-option">
  				<div class="theme-color header-theme">
  					<a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
  					<a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
  				</div>
  			</li>
  		</ul>
  	</div>
  </div>
  <!-- end color quick setting -->