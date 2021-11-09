<section class="content-header">
	<h1>Manage Company</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>iamuser/Home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage company</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<a href="<?php echo $addURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-plus"></i> Add Company</a>
		
        </div>
		<?php if(!empty($success_msg)){ ?>
		<div class="col-xs-12">
			<div class="alert alert-success"><?php echo $success_msg; ?></div>
		</div>
		<?php }elseif(!empty($error_msg)){ ?>
		<div class="col-xs-12">
			<div class="alert alert-danger"><?php echo $error_msg; ?></div>
		</div>
		<?php } ?>
		<div class="col-xs-12">

			<div class="box box-modify">
				<div class="box-header">
					<h3 class="box-title">Company Lists</h3>
					<div class="box-tools">
						
						<div class="input-group input-group-sm" style="width: 350px;">
							<input type="text" name="userSearchKeyword" placeholder="Enter keywords..." value="" class="form-control pull-right">
							<div class="input-group-btn">
								<input type="submit" name="submitSearch" class="btn btn-default" value="SEARCH">
								<input type="submit" name="submitSearchReset" class="btn btn-default" value="RESET">
								<!--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>-->
							</div>
						</div>
						
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>Company Name</th>														
							<th>Email</th>
							<th>Phone Number</th>
							<th>Address</th>

						</tr>        
						                
						<tr>			
							<td>Test</td>											
							<td>test@gmail.com</td>											
							<td>123456789</td>											
							<td>LOS ANGELES</td>											
							<td></td>	
						</tr>

						<tr>			
							<td>Demo</td>											
							<td>demo@gmail.com</td>											
							<td>32125100</td>											
							<td>NYC</td>											
							<td></td>	
						</tr>	

					</table>
				</div>

				<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
						</ul>
				</div>			
			</div>
			
		</div>
	</div>
</section>