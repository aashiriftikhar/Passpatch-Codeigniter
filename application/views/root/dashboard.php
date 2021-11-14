<style type="text/css">
  .small-box .icon {
  font-size: 80px !important;
  }
  .small-box:hover .icon {
  font-size: 85px !important;
  }
  @media only screen and (max-width: 400px) {
  .box-tools {
  display: contents!important;
  }
  .input-group.input-group-sm {
  margin-top: 10px!important;
  width: 100% !important;
  }
  }
  /*Add Client  Form*/
  .btn-tertiary {
  color: #555;
  display: inline-block;
  /*padding: 6px 12px;*/
  font-size: 20px;
  font-weight: 400;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  }
  /* input file style */
  .input-file {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  /*position: absolute;*/
  z-index: -1;
  }


  .input-file + .js-labelFile {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 0 10px;
    cursor: pointer;
    font-size: 16px;
    margin-left: -10px;
}

  .input-file + .js-labelFile .icon:before {
  content: "\f093";
  }
  .input-file + .js-labelFile.has-file .icon:before {
  content: "\f00c";
  color: #5aac7b;
  }
  .action-links {
    padding: 5px !important;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Dashboard<small>Control panel</small></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>root/Home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content"  style="margin-top: -8px">
  <div class="row">
    <div class="col-xs-12">
      <?php 
        if(!empty($success_msg)){
        	echo '<div class="alert alert-success">'.$success_msg.'</div>';
        }elseif(!empty($error_msg)){
        	echo '<div class="alert alert-danger">'.$error_msg.'</div>';
        }
        ?>
    </div>
    <div class="col-xs-12">
      <div class="box box-modify">
        <div class="box-header">
          <h3 class="box-title">Client Lists</h3>
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
              <th style="width: 10%!important">Name</th>
              <th style="width: 10%!important">Client</th>              
              <th style="width: 8%!important">Email</th>
              <th style="width: 15%!important">Phone Number</th>             
              <th style="width: 14%!important">Address</th>
              <th style="width: 10%!important">Total Devices</th>              
              <th style="width: 7%!important">Alert</th>
              <th style="width: 5%!important">Status</th>
              <th style="width: 8%!important">Action</th>
            </tr>
            <?php  
              if (!empty($ClientDataList)) {
                foreach ($ClientDataList as $key => $value) {
            ?>
              <tr>
                <td><?= $value['profile_name']; ?></td>
                <td><?= $value['contact_name']; ?></td>
                <td><?= $value['email']; ?></td>
                <td><?= $value['phone_number']; ?></td>
                <td><?= $value['address_line1']; ?><br>
                    <?= $value['address_line2']; ?>
                </td>
                <td> <?= $value['total_devices']; ?></td>
                <td>
                  <a href="#" onclick="return confirm('Are you sure?')" title="Send Alert" data-skin="skin-red" class="btn btn-danger btn-xs">Send</a>
                </td>
                <td><?= $value['status']; ?></td>
                <td class="action-links">
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
            <?php echo $this->pagination->create_links(); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content" style="margin-top: -58px">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary box-modify">
        <div class="box-header with-border">
          <!--<h3 class="box-title">Create IAM User Profile</h3>-->
          <h3 class="box-title">Add New Client</h3>
          <!-- <a href="<?php echo $sampleFileDownload; ?>" class="label label-primary pull-right" >Download MAC ID Sample File</a> -->
        </div>
        <!-- form start -->
        <form name="addClient" method="post" action="" enctype="multipart/form-data" id="addClient">
		          <div class="box-body">
		            <div class="row">
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="profile_name">Client Profile Name </label>
		                  <input type="text" class="form-control" name="profile_name" placeholder="Enter client profile name" value="<?php echo !empty($ClientData['profile_name'])?$ClientData['profile_name']:''; ?>" >
		                  <?php echo form_error('profile_name','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="name">Customer Type </label>
		                  <select class="form-control" name="customer_type">
		                    <option value="">Select</option>
		                    <?php foreach ($CustomerTypeData as $key => $value)  ?>
		                      
		                    <option <?php if(!empty($ClientData['customer_type'])){ echo ($ClientData['customer_type']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['name']?></option>

		                    <?  ?>
		                    
		                  </select>
		                  <?php echo form_error('customer_type','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <!-- <div class="col-md-4">
		                <div class="form-group">
		                  <label></label>
		                  <input type="file" name="mac_id_file" id="file" class="input-file" accept=".xls">
		                  <label for="file" class="btn btn-tertiary js-labelFile">
		                  <i class="icon fa fa-check"></i>
		                  <span class="js-fileName"></span>
		                  </label> -->
		                  <!-- <label style="margin-top: 5px">Upload ASCII file serial number  or MAC ID</label>
		                  <?php  if(!empty($mac_id_file_error)){
		                  echo '<div class="help-block error">'.$mac_id_file_error.'</div>'; }?>
		                  <?php echo form_error('mac_id_file','<p class="help-block error">','</p>'); ?> -->
						  
		                </div>
		              </div>
		            </div>
		            <div class="row">
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="name">Email </label>
		                  <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo !empty($ClientData['email'])?$ClientData['email']:''; ?>" >
		                  <?php echo form_error('email','<p class="help-block error mt-2">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="name">Phone Number </label>
		                  <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" value="<?php echo !empty($ClientData['phone_number'])?$ClientData['phone_number']:''; ?>" >
		                  <?php echo form_error('phone_number','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="country">Select Country </label>
		                  <select class="form-control" name="country"  id="country">
	                        <option value="">Select </option>
	                         <?php
	                            foreach($country as $row) { ?>
	                             <option <?php if(!empty($ClientData["country"])){ echo ($ClientData["country"]==$row->country_id)? "selected": ""; } ?>  value=<?= $row->country_id ?>><?= $row->country_name ?></option>
	                            <?php } ?>
	                      </select>
		                  <?php echo form_error('country','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		            </div>
		            <div class="row">
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="state">Select State </label>
		                  <select class="form-control" name="state" id="state">		                  
		                  	<option value="">Select State</option>
		                  </select>
		                  <?php echo form_error('state','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="city">City </label>
		                   <select class="form-control" name="city" id="city">		                  
			                  	<option value="">Select City</option>
			                </select>
		                  <?php echo form_error('city','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                    <label for="postal_code">Postal Code </label>			               
			                 <input type="number" class="form-control" name="postal_code" placeholder="Enter postal code" value="<?php echo !empty($ClientData['postal_code'])?$ClientData['postal_code']:''; ?>" >
		                  <?php echo form_error('postal_code','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		            </div>
		            <div class="row">
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="address_line1">Address Line 1  </label>
		                  <textarea class="form-control" name="address_line1" placeholder="Enter Address"  ><?php echo !empty($ClientData['address_line1'])?$ClientData['address_line1']:''; ?></textarea>
		                  <?php echo form_error('address_line1','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>	
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="address_line2">Address Line 2 </label>
		                  <textarea class="form-control" name="address_line2" placeholder="Enter Address" value="" ><?php echo !empty($ClientData['address_line2'])?$ClientData['address_line2']:''; ?></textarea>
		                  <?php echo form_error('address_line2','<p class="help-block error">','</p>'); ?>

		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="notes">Notes</label>
		                  <textarea class="form-control" name="notes" placeholder="Enter some notes" value="" ><?php echo !empty($ClientData['notes'])?$ClientData['notes']:''; ?></textarea>
		                  <?php echo form_error('notes','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		            </div>
		            <div class="row">
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="contact_name">Contact Name </label>
		                  <input type="text" class="form-control" name="contact_name" placeholder="Enter Contact name" value="<?php echo !empty($ClientData['contact_name'])?$ClientData['contact_name']:''; ?>" >
		                  <?php echo form_error('contact_name','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="contact_title">Contact Title </label>
		                  <input type="text" class="form-control" name="contact_title" placeholder="Enter Contact title" value="<?php echo !empty($ClientData['contact_title'])?$ClientData['contact_title']:''; ?>" >
		                  <?php echo form_error('contact_title','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		              <div class="col-md-4">
		                <div class="form-group">
		                  <label for="status" class="">Status</label>
		                  <select class="form-control" name="status">
		                    <option value="">Please select</option>
		                    <option <?php if(!empty($ClientData['status'])){ echo ($ClientData['status']=="Active")? "selected": ""; } ?> value="Active">Active</option>
		                    <option <?php if(!empty($ClientData['status'])){ echo ($ClientData['status']=="Inactive")? "selected": ""; } ?> value="Inactive">Inactive</option>
		                  </select>
		                  <?php echo form_error('status','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
		            </div>
		            <div class="row">
					<div class="col-md-4">
		                <div class="form-group">
		                  <label for="contact_title">Available devices MacIDs</label>
						  
						  <div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
 								<?php if (isset($allDevices))
										foreach ($allDevices as $service) : ?>
 									<?php echo $service->id."-".$service->device_id; ?>
										</br>
 								<?php endforeach; ?>
										 </div>
		                </div>
		              </div>
					  <div class="col-md-4">
		                <div class="form-group">
		                  <label for="contact_title">Enter number of devices</label>
		                  <input min="1" max="<?php echo $deviceCount; ?>" type="number" class="form-control" name="device_count" placeholder="Device Count to Assign" value="<?php echo !empty($ClientData['device_count'])?$ClientData['device_count']:''; ?>" >
		                  <?php echo form_error('contact_title','<p class="help-block error">','</p>'); ?>
		                </div>
		              </div>
					</div>
		            <div class="row">
		              <div class="col-md-12">
		                <hr style="border-top: 2px dotted #1c1a1a47;">
		                <!-- <p style="margin-left: 10px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		                  consequat , Duis aute irure dolor in reprehenderit in voluptate velit esse.
		                </p> -->
		              </div>
		            </div>
		          </div>
		          <div class="box-footer ">
		            <input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="<?php echo $action_btn; ?> Profile"/>
		          </div>
		        </form>  	
			</div>
		</div>			
	
	</div>
</section>
<!-- /.content -->

<script type="text/javascript">
  (function() {
  
  'use strict';

  $('.input-file').each(function() {
    var $input = $(this),
        $label = $input.next('.js-labelFile'),
        labelVal = $label.html();
    
   $input.on('change', function(element) {
      var fileName = '';
      if (element.target.value) fileName = element.target.value.split('\\').pop();
      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
   });
  });

})();
</script>
<script>
$(document).ready(function(){
 $('#country').change(function(){
  var country_id = $('#country').val();
  if(country_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>root/Client/fetch_state",
    method:"POST",
    data:{country_id:country_id},
    success:function(data)
    {
     $('#state').html(data);
     $('#city').html('<option value="">Select City</option>');
    }
   });
  }
  else
  {
   $('#state').html('<option value="">Select State</option>');
   $('#city').html('<option value="">Select City</option>');
  }
 });

 $('#state').change(function(){
  var state_id = $('#state').val();
  if(state_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>root/Client/fetch_city",
    method:"POST",
    data:{state_id:state_id},
    success:function(data)
    {
     $('#city').html(data);
    }
   });
  }
  else
  {
   $('#city').html('<option value="">Select City</option>');
  }
 });
 
});
</script>