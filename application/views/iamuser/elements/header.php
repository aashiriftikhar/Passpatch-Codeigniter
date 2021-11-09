<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>iamuser/Home" class="logo">      
      <span class="logo-mini"><b>P</b>P</span>      
      <span class="logo-lg"><b>PASSPATCH</b> </span>
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<!-- <span class="logo-mini"><b>DP</b></span> -->
		<!-- logo for regular state and mobile devices -->
		<!-- <span class="logo-lg"><b><?php echo $siteSettings['name']; ?></b></span> -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo $userSessPic; ?>" class="user-image" alt="User Image">
						<!-- <span class="hidden-xs"><?php echo $userSessName; ?></span> -->
						<span class="hidden-xs"><?php echo $ClientProfileName; ?> </span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?php echo $userSessPic; ?>" class="img-circle" alt="User Image">
							<p>
								<?php echo $ClientProfileName; ?> 
								<small>IAM User</small>
							</p>
						</li>
						<!-- Menu Body -->
						<!--<li class="user-body">
							<div class="row">
								<div class="col-xs-4 text-center">
									<a href="#">Settings</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Friends</a>
								</div>
							</div>
						</li>-->
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left ">
								<a href="<?php echo base_url(); ?>iamuser/Home/changePassword" class="btn btn-default btn-flat btn-modify">Change Password</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo base_url(); ?>iamuser/Home/logout" class="btn btn-default btn-flat btn-modify">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
