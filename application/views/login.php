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
</style>

<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('Auth'); ?>"><img src="<?php echo base_url(); ?>assets/logo.png" style="width: 60%;"></a>
  </div>



  <div class="login-box-body">
  <!-- Response Messages -->
  <?php 
    if(!empty($error_msg)){
    echo '<p class="statusMsg error">'.$error_msg.'</p>';
    } 
  ?>
    <form action="<?php echo base_url('Auth/Login'); ?>" method="post">
      <div class="form-group has-feedback">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio"  name="AccountType" aria-label="Radio button for following text input" value="RootUser">
            <span style="margin-left: 10px">Root User</span>
          </div>
        </div>
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio" name="AccountType"  aria-label="Radio button for following text input" value="IAMUser" checked="">
            <span style="margin-left: 10px">IAM User</span>
          </div>
        </div>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="username" class="form-control login-control" placeholder="Email"  required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control login-control" placeholder="Password" required="" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <a href="<?php echo base_url('Auth/forgotPassword') ?>" style="text-align: right;float: right;color: #fff;font-size: 15px;font-family: raleway;margin-top: -5px;">Forgot Password ?</a>
      <div class="row">
        <div class="col-xs-12">
          <input type="submit" name="loginSubmit" value="Login" class="login-btn btn-block btn-flat" >
        </div>
      </div>
      <p style="color: #fff;text-align: center;margin-top: 15px;font-weight: 500;font-size: 12px;font-family: raleway;">PASSPATCH LLC ALL RIGHTS RESERVED 2020</p>
    </form>
    <!-- </form> -->
    <!-- <a href="#">I forgot my password</a> -->
  </div>
</div>

