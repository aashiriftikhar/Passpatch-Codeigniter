<style type="text/css">
  .input-group-text {
  border: 1px solid #121d34;
  background: #121d34;
  margin-bottom: 15px;
  padding: 10px;
  /*border-radius: 25px;*/
  font-size: 15px;
  font-family: raleway;
  color: white;
  }
  .icheckbox_square-blue, .iradio_square-blue {
  filter:    invert(20%) sepia(12%) saturate(433%) hue-rotate(193deg) brightness(103.4%) contrast(109.2%);
  }

    .statusMsg {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: bold;
    color: #58e158e6;
    
}
</style>

<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('Auth/'); ?>"><img src="<?php echo base_url(); ?>assets/logo.png" style="width: 60%;"></a>
  </div>



  <div  style="color:#fff; text-align: center;font-size: 25px">
    Reset Password
  </div>
  <div class="login-box-body">
  <!-- Response Messages -->
  <div style="text-align: center;">
    <?php 
    if(!empty($error_msg)){
    echo '<p class="statusMsg error">'.$error_msg.'</p>';
    }elseif (!empty($success_msg)) {
      echo '<p class="statusMsg">'.$success_msg.'</p>';
    } 
  ?>
  </div>
  <div id="Sucesss_msg">
    <form action="<?php echo base_url('Auth/resetPassword/').$password_token; ?>" method="post" id
      ="resetPassword">
      
     <div style="text-align: :center;font-weight: bold;">
        <?php echo form_error('password','<p class="help-block error">','</p>'); ?>
        <?php echo form_error('confirm_password','<p class="help-block error">','</p>'); ?>       
     </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control login-control" placeholder="Password" required="" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="confirm_password" class="form-control login-control" placeholder="Confirm Password" required="" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <input type="submit" name="resetSubmit" value="Submit" class="login-btn btn-block btn-flat" >
        </div>
      </div>
      <p style="color: #fff;text-align: center;margin-top: 15px;font-weight: 500;font-size: 12px;font-family: raleway;">PASSPATCH LLC ALL RIGHTS RESERVED 2020</p>
    </form>
    <!-- </form> -->
  </div>  
    <!-- <a href="#">I forgot my password</a> -->
  </div>
</div>

    <?php 
      
        if ($success_msg)
        { ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#Sucesss_msg').html("");
        
      });
    </script>
    <?php }
      ?>
    <?php 
      
        if ($error_msg) 
        { ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#Sucesss_msg').html("");
        
      });
    </script>
    <?php }
      ?>
    