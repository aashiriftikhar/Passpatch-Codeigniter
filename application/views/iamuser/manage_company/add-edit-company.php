<style type="text/css">
	.invalid-feedback{
		color: red;
	}
</style>
<section class="content-header">
	<h1><?php echo $action; ?> Company</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $listURL; ?>"><i class="fa fa-users"></i> Company</a></li>
		<li class="active"><?php echo $action; ?></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<a href="<?php echo $listURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
		<div class="col-xs-12">
		</div>
		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title">Add Company Details</h3>
				</div>
				<!-- form start -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Company Name </label>
									<input type="text" class="form-control" name="name" placeholder="Enter Company name" value="" >
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Email </label>
									<input type="text" class="form-control" name="name" placeholder="Enter email" value="" >
								</div>
							</div>							
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="password"> Password</label>
									<input type="password" class="form-control" name="password" placeholder="Enter password" value="" >
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="confirm_password">Confirm Password</label>
									<input type="password" class="form-control" name="confirm_password" placeholder="Enter confirm password" value="" >
								</div>
							</div>
							
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Phone Number </label>
									<input type="text" class="form-control" name="name" placeholder="Enter phone number" value="" >
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Address </label>
									<textarea class="form-control" name="name" placeholder="Enter Address" value="" ></textarea>
								</div>
							</div>							
						</div>
					</div>
					<div class="box-footer">
						<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="Submit"/>
					</div>
			</div>
		</div>				
	
	</div>
</section>
