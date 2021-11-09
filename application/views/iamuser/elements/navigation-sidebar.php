
<section class="sidebar">
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<!-- <li class="header">MAIN NAVIGATION</li> -->
		<li class="treeview mt-1 <?php echo ($this->uri->segment(2) == 'Home')?'active':''; ?>">
			<a href="<?php echo base_url('iamuser/Home'); ?>">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(2) == 'manage_group' )?'active':''; ?>">
			<a href="<?php echo base_url('iamuser/manage_group'); ?>">
				<i class="fa fa-th-large"></i> <span>Groups</span>
			</a>
		</li>
        
        <li class="<?php echo ($this->uri->segment(2) == 'manage_member')?'active':''; ?>">
        	<a href="<?php echo base_url('iamuser/manage_member'); ?>">
        		<i class="fa fa-user"></i> <span>Members</span>
        	</a>
    	</li>

		<li class="treeview <?php echo ($this->uri->segment(3) == 'reports'  || $this->uri->segment(3) == 'addReport' )?'active':''; ?>">
			<a href="<?php echo base_url('iamuser/home/reports'); ?>">
				<i class="fa fa-file-text  "></i> <span>Reports</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(3) == 'datasheetUpload' )?'active':''; ?>">
			<a href="<?php echo base_url('iamuser/home/datasheetUpload'); ?>">
				<i class="fa fa-upload "></i> <span>Datasheet Upload</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(2) == 'manage_event')?'active':''; ?>">
			<a href="<?php echo base_url('iamuser/manage_event'); ?>">
				<i class="fa fa-calendar "></i> <span>Events</span>
			</a>
		</li>

	</ul>
</section>