
<section class="sidebar">
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<!-- <li class="header">MAIN NAVIGATION</li> -->
		<li class="treeview mt-1 <?php echo ($this->uri->segment(3) == 'dashboard')?'active':''; ?>">
			<a href="<?php echo base_url('admin/administrative/dashboard'); ?>">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(2) == 'manage_group' )?'active':''; ?>">
			<a href="<?php echo base_url('admin/manage_group'); ?>">
				<i class="fa fa-th-large"></i> <span>Groups</span>
			</a>
		</li>


		<!-- <li class="treeview <?php echo ($this->uri->segment(2) == 'manage_workers' )?'active':''; ?>">
			<a href="<?php echo base_url('admin/manage_workers'); ?>">
				<i class="fa fa-user "></i> <span>Members</span>
			</a>
		</li> -->

        
            <li class="<?php echo ($this->uri->segment(3) == 'viewFixUnit' || $this->uri->segment(3) == 'addFixUnit' )?'active':''; ?>"><a href="<?php echo base_url('admin/manage_workers/viewFixUnit'); ?>"><i class="fa fa-user"></i> Members</a></li>
                    
         
      

		<li class="treeview <?php echo ($this->uri->segment(3) == 'reports'  || $this->uri->segment(3) == 'addReport' )?'active':''; ?>">
			<a href="<?php echo base_url('admin/administrative/reports'); ?>">
				<i class="fa fa-file-text  "></i> <span>Reports</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(3) == 'datasheetUpload' )?'active':''; ?>">
			<a href="<?php echo base_url('admin/administrative/datasheetUpload'); ?>">
				<i class="fa fa-upload "></i> <span>Datasheet Upload</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(3) == 'events' || $this->uri->segment(3) == 'addEvent')?'active':''; ?>">
			<a href="<?php echo base_url('admin/administrative/events'); ?>">
				<i class="fa fa-calendar "></i> <span>Events</span>
			</a>
		</li>

		<!-- <li class="treeview <?php echo ($this->uri->segment(3) == 'viewLocation' || $this->uri->segment(3) == 'addLocation') || $this->uri->segment(3) == 'editLocation'?'active':''; ?>">
			<a href="<?php echo base_url('admin/master/viewLocation'); ?>">
				<i class="fa fa-crosshairs"></i> <span>Locations</span>
			</a>
		</li> -->

		<!-- <li class="treeview <?php echo ($this->uri->segment(3) == 'settings'  )?'active':''; ?>">
			<a href="<?php echo base_url('admin/administrative/settings'); ?>">
				<i class="fa fa-cog "></i> <span>Settings</span>
			</a>
		</li> -->


	</ul>
</section>