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
	<h1>Reports</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo ""; ?>"><i class="fa fa-file-text"></i> Reports	</a></li>
		<!-- <li class="active"><?php echo $action; ?></li> -->
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<!-- <a href="<?php echo $addURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-plus"></i> Add Report</a> -->
        </div>
		<div class="col-xs-12">
		</div>
		<div class="col-md-12 ">
			<div class="box box-primary box-modify">
				<div class="box-header">
					<h3 class="box-title">Report Lists</h3>
					<div class="box-tools ">
						
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
				<!-- form start -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>Sr.No.</th>	
								<th>Company Name</th>
								<th>Name</th>
								<th>Temperature</th>
								<th>Location</th>
								<th>Date</th>								
							
							</tr>        
							                
							<tr>			
								<td>1</td>
								<td>Test</td>											
								<td>Jon test</td>																	
								<td>20</td>											
								<td>Calafornia</td>									
								<td>07/25/2020</td>
																	
								
							</tr>

							<tr>			
								<td>2</td>
								<td>Demo</td>											
								<td>bob test</td>											
								<td>10</td>											
								<td>NYC</td>
								<td>06/10/2020</td>
																										
								
							</tr>
						</table>
					</div>
					<div class="box-footer">
						<ul class="pagination pagination-sm no-margin pull-right">
						</ul>
					</div>
			</div>
		</div>				
	
	</div>
</section>
