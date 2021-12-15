
 <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
<style type="text/css">
	.invalid-feedback{
		color: red;
	}
	.radiomodify{
		margin-left: -18px;
		margin-top: 10px;
	}
	img {
    max-width: 100px;
    max-height: 100px !important;
  }
</style>
<section class="content-header">
	<h1><?php echo $action; ?> Event</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $listURL; ?>"><i class="fa fa-user"></i> Event</a></li>
		<li class="active"><?php echo $action; ?></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		
		
		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $action; ?> Event Details</h3>
          <a href="<?php echo $listURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-arrow-left"></i> Back</a>
				</div>
				<!-- form start -->					
				<form name="addEvent" method="post" action="" enctype="multipart/form-data" id="addEvent">
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="event_name">Event Name </label>
                  <input type="text" class="form-control" name="event_name" placeholder="Enter Event name" value="<?php echo !empty($EventData['event_name'])?$EventData['event_name']:''; ?>" >
                  <?php echo form_error('event_name','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="location">Location </label>
                  <input type="text" class="form-control" name="location" placeholder="Enter Location" value="<?php echo !empty($EventData['location'])?$EventData['location']:''; ?>" >	
                  <?php echo form_error('location','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name">Select Group </label>
                  <select class="form-control" name="group">
                    <option value="">Select</option>
                    <?php foreach ($GroupsData as $key => $value) : ?>
                    <option <?php if(!empty($EventData['group_id'])){ echo ($EventData['group_id']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['name']?></option>
                    
 								<?php endforeach; ?>
                  </select>
                  <?php echo form_error('group','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label>Start Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['start_date'])?date("m/d/Y", strtotime($EventData['start_date'])):date('m/d/Y'); ?>" name="start_date" >
                  <?php echo form_error('start_date','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-2">
                <label>End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['end_date'])?date("m/d/Y", strtotime($EventData['end_date'])):date('m/d/Y'); ?>" name="end_date">
                  <?php echo form_error('end_date','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-2 bootstrap-timepicker">
                <label>Start Time</label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker"  name="start_time"value="<?php echo !empty($EventData['start_time'])?date("h:i A", strtotime($EventData['start_time'])):date('h:i A'); ?>" >
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <?php echo form_error('start_time','<p class="help-block error">','</p>'); ?>
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-md-2 bootstrap-timepicker">
                <label>End Time </label>    
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="end_time" value="<?php echo !empty($EventData['end_time'])?date("h:i A", strtotime($EventData['end_time'])):date('h:i A'); ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <?php echo form_error('end_time','<p class="help-block error">','</p>'); ?>
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-md-4">
                <label>Select Time Zone</label>
                <div class="form-group">
                  <select class="form-control" name="time_zone">
                    <option value="">Select</option>
                    <?php foreach ($TimeZoneList as $key => $value) : ?>
                    <option <?php if(!empty($EventData['time_zone'])){ echo ($EventData['time_zone']==$value['value'])? "selected": ""; } ?> value="<?= $value['value']?>"><?= $value['text']?></option>
                    
 								<?php endforeach; ?>
                  </select>
                  <?php echo form_error('time_zone','<p class="help-block error">','</p>'); ?>	
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description">Description </label>
                  <textarea  class="form-control" rows="1" name="description" placeholder="Enter description" value=""><?php echo !empty($EventData['description'])?$EventData['description']:''; ?></textarea >
                  <?php echo form_error('description','<p class="help-block error">','</p>'); ?>	
                </div>
              </div>
              <?php if(!empty($EventData['time_zone'])) : ?>
              <div class="col-md-6 form-group">
                <label for="name">Select Device ID Range</label>
                
<div class="row">
<div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
<?php if (isset($ClientMACIdData))
foreach ($ClientMACIdData as $key => $value) : ?>

<input type="checkbox" name="assigning[]" value="<?php echo $value['id']; ?>">
<?php echo $value['device_id']; ?>
</br>
<?php endforeach; ?>
</div>
  </div>
</div>
            </div>
            
<?php endif; ?>
            <div class="row">
            <div class="col-md-2">
              <div class="form-group" style="margin-top: 20px">
                <input type="submit" name="userSubmit" class="btn btn-primary" value="Submit" />
              </div>
            </div>
            </div>
          </div>
        </form>
			</div>
		</div>			
	
	</div>
</section>
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
	 //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    })

      //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
<script type="text/javascript">
  // vars
  let result = document.querySelector(".result"),
  img_result = document.querySelector(".img-result"),
  // img_w = document.querySelector(".img-w"),
  // img_h = document.querySelector(".img-h"),
  options = document.querySelector(".options"),
  save = document.querySelector(".savebtn1"),
  cropped = document.querySelector(".cropped"),
  dwn = document.querySelector(".download"),
  upload = document.querySelector("#file-input"),
  cropper = "";
  
  // on change show image with crop options
  upload.addEventListener("change", (e) => {
  if (e.target.files.length) {
  // start file reader
  const reader = new FileReader();
  reader.onload = (e) => {
    if (e.target.result) {
      // create new image
      let img = document.createElement("img");
      img.id = "image";
      img.src = e.target.result;
      // clean result before
      result.innerHTML = "";
      // append new image
      result.appendChild(img);
      // show save btn and options
      save.classList.remove("hide");
      options.classList.remove("hide");
      // init cropper
      cropper = new Cropper(img);
    }
  };
  reader.readAsDataURL(e.target.files[0]);
  }
  });
  
  // save on click
  save.addEventListener("click", (e) => {
  e.preventDefault();
  // get result to data uri
  let imgSrc = cropper
  .getCroppedCanvas({
   // width: img_w.value // input value
  })
  .toDataURL();
  // remove hide class of img
  cropped.classList.remove("hide");
  img_result.classList.remove("hide");
  // show image cropped
  cropped.src = imgSrc;
  dwn.classList.remove("hide");
  dwn.download = "imagename.png";
  dwn.setAttribute("href", imgSrc);
  });
  
</script>