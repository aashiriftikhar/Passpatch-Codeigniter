
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

<!-- Main content -->
<section class="content">
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
  </div>  
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $action; ?></h3>
          <a href="<?php echo $listURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-arrow-left"></i> Back</a>
				</div>
				<!-- form start -->					
				<form name="addEvent" method="post" action="" enctype="multipart/form-data" id="addEvent">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="current_password">Current Password </label>
                  <input type="text" class="form-control" name="current_password" placeholder="Enter Current Password" value="<?php echo !empty($PasswordData['current_password'])?$PasswordData['current_password']:''; ?>" >
                  <?php echo form_error('current_password','<p class="help-block error">','</p>'); ?>
                   
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="password">New Password </label>
                  <input type="text" class="form-control" name="password" placeholder="Enter New Password" value="<?php echo !empty($PasswordData['password'])?$PasswordData['password']:''; ?>" >
                  <?php echo form_error('password','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="confirm_password">Confirm Password </label>
                  <input type="text" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" value="<?php echo !empty($PasswordData['confirm_password'])?$PasswordData['confirm_password']:''; ?>" >
                  <?php echo form_error('confirm_password','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
            </div>
            <div class="row">              
              <div class="col-xs-12">
                <input type="submit" name="userSubmit" value="Submit" class="btn btn-success btn-modify " >
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