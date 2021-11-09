<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section class="sidebar">
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<!-- <li class="header">MAIN NAVIGATION</li> -->
		<li class="treeview mt-1 <?php echo ($this->uri->segment(2) == 'Home')?'active':''; ?>">
			<a href="<?php echo base_url('root/Home'); ?>">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(2) == 'client' )?'active':''; ?>">
			<a href="<?php echo base_url('root/client'); ?>">
				<i class="fa fa-user"></i> <span>Client List</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(2) == 'CustomerType' || $this->uri->segment(3) == 'addCustomerType' )?'active':''; ?>">
			<a href="<?php echo base_url('root/CustomerType'); ?>">
				<i class="fa fa-user-o"></i> <span>Customer Type</span>
			</a>
		</li>

		<li class="treeview <?php echo ($this->uri->segment(2) == 'SettingsRoot'  )?'active':''; ?>">
			<a href="<?php echo base_url('root/SettingsRoot'); ?>">
				<i class="fa fa-cog "></i> <span>Settings</span>
			</a>
		</li>
	</ul>
</section>