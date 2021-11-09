<section class="content-header">
	<h1>Manage Customer Type</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>root/Home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Customer Type</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<a href="<?php echo $addURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-plus"></i> Add Customer Type</a>
		
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
					<h3 class="box-title">Customer Type Lists</h3>
					<div class="box-tools">
						
						<form name="search_form" action="<?php echo $listURL; ?>" method="post"/>
				            <div class="input-group input-group-sm" style="width: 350px;">
				              <input type="text" name="userSearchKeyword" placeholder="Enter keywords..." value="<?php echo !empty($searchKeyword)?$searchKeyword:''; ?>" class="form-control pull-right">
				              <div class="input-group-btn">
				                <input type="submit" name="submitSearch" class="btn btn-default" value="SEARCH">
				                <input type="submit" name="submitSearchReset" class="btn btn-default" value="RESET">
				                <!--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>-->
				              </div>
				            </div>
				        </form>
						
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>Name</th>															
							<th style="width: 10%">Action</th>
						</tr>    
						<?php  
			                if (!empty($CustomerTypeList)) {
			                foreach ($CustomerTypeList as $key => $value) {
			            ?>	

			            <tr>							
							<td><?= $value['name']?></td>	
							<td class="action-links" >
								<a href="<?php echo str_replace('{ID}',base64_encode($value['id']),$editURL); ?>" title="Edit" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>								
                                <a href="<?php echo str_replace('{ID}',base64_encode($value['id']),$deleteURL); ?>" onclick="return confirm('Are you sure to delete?')" title="Delete" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
							</td>	
						</tr>

			            <?php } }else{ ?>
			             <tr><td colspan="9" style="text-align: center;">Clients not found....</td></tr>    
			            <?php } ?>
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