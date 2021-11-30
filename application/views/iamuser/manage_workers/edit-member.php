<section class="content-header">
	<h1><?php echo $action; ?> Member</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>iamuser/Home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?php echo $action; ?> Member</li>
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
	
		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $action; ?> Member To Fix Units </h3>
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
			                          <?php foreach ($ClientMACIdData as $key => $value) :?>
			                          <option <?php if(!empty($MemberData['device_mac_id'])){ echo ($MemberData['device_mac_id']==$value['device_id'])? "selected": ""; } ?> value="<?= $value['device_id']?>"><?= $value['device_id']?></option>
			                          
<?php	endforeach ?>
			                        </select>
			                        <?php echo form_error('device_mac_id','<p class="help-block error">','</p>'); ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="event">Event Name </label>									
									<select class="form-control" name="event">
			                          <option value="">Select</option>
			                          <?php foreach ($EventData as $key => $value) : ?>
			                          <option <?php if(!empty($MemberData['event_id'])){ echo ($MemberData['event_id']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['event_name']?></option>
			                         
<?php	endforeach ?>
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
									<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify form-control" value="<?php echo $action_btn; ?>"/>
								</div>
							</div>
						</div>
					</div>
				</form>						
			</div>
		</div>	

	</div>
</section>