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
	<h1>Datasheet Upload</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo ""; ?>"><i class="fa fa-upload"></i> Datasheet Upload</a></li>
		
	</ol>
</section>
<br>
<!-- Main content -->
<?php if(!empty($success_msg)){ ?>
<div class="col-xs-12">
  <div class="alert alert-success"><?php echo $success_msg; ?></div>
</div>
<?php }elseif(!empty($error_msg)){ ?>
<div class="col-xs-12">
  <div class="alert alert-danger"><?php echo $error_msg; ?></div>
</div>
<?php } ?>
<section class="content">
	<div class="row">		
		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<!-- <h3 class="box-title">Add Member Details</h3> -->
				</div>
				<!-- form start -->
				<form name="CSV_datasheet_file_form" method="post" action="<?php echo base_url('iamuser/Home/datasheetUpload'); ?>" enctype="multipart/form-data" id="CSV_datasheet_file_form">
					<div class="box-body">
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label for="CSV_datasheet_file">CSV Datasheet file </label>		
									<input type="file"  name="file" accept=".csv">
									<?php echo form_error('file','<p class="help-block error">','</p>'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify mr-3" value="Upload CSV file"/>						
						<a href="<?php echo $sample_csv_file?>" class="btn btn-success" style="margin-top:10px; margin-bottom: 10px;">Download Sample File Here</a>
					</div>
				</form>	
			</div>
		</div>				
	
	</div>
</section>
