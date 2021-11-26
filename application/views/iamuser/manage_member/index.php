<section class="content-header">
	<h1>Manage Members</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>iamuser/Home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Members</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		
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
					<h3 class="box-title">Medical Patient List</h3>
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
							<th>Room #</th>
							<th>Floor #</th>
							<th>Building/Wing #</th>
							<th>Device MAC ID #</th>
							<th>Event Name</th>
							<th>Status</th>
							<th>Action</th>

						</tr>       
						                
						<?php  
			                if (!empty($MemberDataList)) {
			                foreach ($MemberDataList as $key => $value) {
			            ?>	

			            <tr>							
							<td><?= $value['member_name']?></td>	
							<td><?= $value['room_number']?></td>	
							<td><?= $value['floor_number']?></td>	
							<td><?= $value['building_number']?></td>	
							<td><?= $value['device_mac_id']?></td>	
							<td><?= $value['event_name']?></td>	
							<td><?= $value['status']?></td>	
							<td class="action-links" >
								<a href="<?php echo str_replace('{ID}',base64_encode($value['id']),$editURL); ?>" title="Edit" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>								
                                <a href="<?php echo str_replace('{ID}',base64_encode($value['id']),$deleteURL); ?>" onclick="return confirm('Are you sure to delete?')" title="Delete" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
							</td>	
						</tr>

			            <?php } }else{ ?>
			             <tr><td colspan="7" style="text-align: center;">Members not found....</td></tr>    
			            <?php } ?>

					</table>
				</div>

				<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<?php echo $this->pagination->create_links(); ?>
						</ul>
				</div>			
			</div>
		</div>

		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title">Add Member To Fix Units </h3>
				</div>
				<!-- form start -->
				<form name="addMember" method="post" action="" enctype="multipart/form-data" id="addMember">
					<div class="box-body">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="member_name"> Name  or #</label>
									<input type="text" class="form-control" name="member_name" placeholder="Enter Name or number" value="<?php echo !empty($MemberData['member_name'])?$MemberData['member_name']:''; ?>" >
									<?php echo form_error('member_name','<p class="help-block error">','</p>'); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="room_number">Room # </label>
									<input type="text" class="form-control" name="room_number" placeholder="Enter Room Number" value="<?php echo !empty($MemberData['room_number'])?$MemberData['room_number']:''; ?>" >
									<?php echo form_error('room_number','<p class="help-block error">','</p>'); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="floor_number">Floor # </label>
									<input type="text" class="form-control" name="floor_number" placeholder="Enter Floor Number" value="<?php echo !empty($MemberData['floor_number'])?$MemberData['floor_number']:''; ?>" >
									<?php echo form_error('floor_number','<p class="help-block error">','</p>'); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="building_number">Building / Wing # </label>
									<input type="text" class="form-control" name="building_number" placeholder="Enter Building/Wing Number" value="<?php echo !empty($MemberData['building_number'])?$MemberData['building_number']:''; ?>" >
									<?php echo form_error('building_number','<p class="help-block error">','</p>'); ?>
								</div>
							</div>	
						</div>

						<div class="row">
							

							<div class="col-md-3">
								<div class="form-group">
									<label for="device_mac_id">Device MAC ID # </label>
									<select class="form-control" name="device_mac_id">
			                          <option value="">Select</option>
			                          <?php foreach ($ClientMACIdData as $key => $value) : ?>
			                          <option <?php if(!empty($MemberData['device_mac_id'])){ echo ($MemberData['device_mac_id']==$value['device_id'])? "selected": ""; } ?> value="<?= $value['device_id']?>"><?= $value['device_id']?></option>
			                        
 								<?php endforeach; ?>
			                        </select>
			                        <?php echo form_error('device_mac_id','<p class="help-block error">','</p>'); ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="event">Event Name </label>									
									<select class="form-control" name="event">
			                          <option value="">Select</option>
			                          <?php foreach ($EventData as $key => $value) :?>
			                          <option <?php if(!empty($MemberData['event_id'])){ echo ($MemberData['event_id']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['event_name']?></option>
			                          
 								<?php endforeach; ?>
			                        </select>
									
									<?php echo form_error('event','<p class="help-block error">','</p>'); ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="status" class="">Status</label>
									<select class="form-control" name="status">
					                    <option value="">Please select</option>
					                    <option <?php if(!empty($MemberData['status'])){ echo ($MemberData['status']=="Active")? "selected": ""; } ?> value="Active">Active</option>
					                    <option <?php if(!empty($MemberData['status'])){ echo ($MemberData['status']=="Inactive")? "selected": ""; } ?> value="Inactive">Inactive</option>
					                 </select>
					                 <?php echo form_error('status','<p class="help-block error">','</p>'); ?>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group" style="margin-top: 5px">
									<label></label>
									<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify form-control" value="Submit"/>
								</div>
							</div>
						</div>
					</div>
				</form>						
			</div>
		</div>	

	</div>
</section>