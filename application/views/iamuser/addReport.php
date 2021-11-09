 <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
	<h1>Add Report</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $listURL; ?>"><i class="fa fa-user"></i> Report</a></li>
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
					<h3 class="box-title">Add Report Details</h3>
				</div>
				<!-- form start -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="compnay_name">Company Name </label>
									<input type="text" class="form-control" name="compnay_name" placeholder="Enter Company Name" value="" >
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Name </label>
									<input type="text" class="form-control" name="name" placeholder="Enter Name" value="" >
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="temperature">Temperature </label>
									<input type="number" name="temperature" class="form-control" placeholder="Enter Temperature">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="location">Location </label>
									<select name="location" class="form-control">
										<option>Please select</option>
										<option>California</option>
										<option>NYC</option>
										<option>London</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">  
							<div class="col-md-6">
								<div class="form-group">
									
								<label for="date">Date </label>
								<div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input type="text" class="form-control pull-right" id="datepicker" placeholder="<?= date('d-m-yy')?>">
				                </div>
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
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
	//Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

</script>