<style type="text/css">
	.invalid-feedback{
		color: red;
	}
	.radiomodify{
		margin-left: -18px;
		margin-top: 10px;
	}
</style>
<section class="content-header">
	<h1>Settings</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo ""; ?>"><i class="fa fa-cog"></i> Settings</a></li>
		<!-- <li class="active"><?php echo $action; ?></li> -->
	</ol>
</section>
<!-- Main content -->
<section class="content" style="margin-bottom: -20px"> 
	<div class="row">
		
		<div class="col-md-12" style="margin-top: -10px;margin-bottom: -4px" >
			<div class="box box-primary box-modify">
					<div class="box-header with-border">
						<h3 class="box-title">Set time interval to capture the temperature</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Value </label>
									<select class="form-control">
										<option>Please select</option>
										<option>1 min</option>
										<option>5 min</option>
										<option>10 min</option>
										<option>15 min</option>
										<option>20 min</option>
										<option>30 min</option>
										<option>1 hr</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Group </label>
									<select class="form-control">
										<option>Please select</option>
										<option>Event / Sports Organizers</option>
										<option>Schools Management</option>
										<option>Health Care Management</option>
										
									</select>
								</div>
							</div>
						</div>	
					</div>					
			</div>
		</div>
		<div class="col-md-12" style="margin-top: -10px;margin-bottom: -4px">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
						<h3 class="box-title">Set pre-set temperature level to poor state</h3>
				</div>
					<div class="box-body">
						<div class="row">						

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Value </label>
									<select class="form-control">
										<option>Please select</option>
										<option>10</option>
										<option>20</option>
										<option>30</option>
										<option>40</option>
										<option>50</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Group </label>
									<select class="form-control">
										<option>Please select</option>
										<option>Event / Sports Organizers</option>
										<option>Schools Management</option>
										<option>Health Care Management</option>
										
									</select>
								</div>
							</div>
						</div>	
					</div>
			</div>
		</div>
		<div class="col-md-12" style="margin-top: -10px;margin-bottom: -4px">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
						<h3 class="box-title">Set time using calender to on/off the device</h3>
					</div>
					<div class="box-body">
						<div class="row">						

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Value </label>
									<select class="form-control">
										<option>Please select</option>
										<option>1 min</option>
										<option>5 min</option>
										<option>10 min</option>
										<option>15 min</option>
										<option>20 min</option>
										<option>30 min</option>
										<option>1 hr</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Group </label>
									<select class="form-control">
										<option>Please select</option>
										<option>Event / Sports Organizers</option>
										<option>Schools Management</option>
										<option>Health Care Management</option>
										
									</select>
								</div>
							</div>
						</div>	
						<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="Save"/>	
					</div>

			</div>

		</div>
		
	</div>
</section>
