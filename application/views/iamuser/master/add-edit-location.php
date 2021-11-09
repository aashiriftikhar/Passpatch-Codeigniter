<style type="text/css">
	.invalid-feedback{
		color: red;
	}
</style>
<section class="content-header">
	<h1><?php echo $action; ?> Location<small>Location information </small></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $listURL; ?>"><i class="fa fa-crosshairs"></i> Location</a></li>
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
					<h3 class="box-title">Add Location Details</h3>
				</div>
				<!-- form start -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="location_name">Location Name </label>
									<input type="text" class="form-control" name="location_name" placeholder="Enter Location name" value="<?php echo !empty($LocationData['location_name'])?$LocationData['location_name']:''; ?>" >
									<?php echo form_error('location_name','<p class="help-block error">','</p>'); ?>
								</div>
							</div>

							
						</div>

						
						<div class="row">						
							

							<div class="col-md-12">
								<div class="form-group">
									<label for="name">Address </label>
									<textarea class="form-control" name="name" placeholder="Some text " value="" ></textarea>
								</div>
							</div>	

							<div class="col-md-12">
								<div class="form-group">
									<label for="Status" class="">Status</label>
									<div class="radiomodify">
										<label class="radio-inline">
										  <div class="iradio_square-blue"  aria-checked="false" aria-disabled="false">
										  	<input type="radio" id="Status" name="Status" value="1"  checked=""></ins>
										  </div>
										  	Active
										</label>
										<label class="radio-inline">
										  <div class="iradio_square-blue "  aria-disabled="false">
										  	<input type="radio" id="Status" name="Status" value="0" ></ins>
										  </div>
										  	Inactive
										</label>
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

