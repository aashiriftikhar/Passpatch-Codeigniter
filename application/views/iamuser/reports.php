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
	<h1>Device Temperature History</h1>
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
						
						
					</div>
				</div>
				<!-- form start -->
					<div class="box-body table-responsive no-padding">
					
					<form name="addEvent" method="post" action="generateReport" enctype="multipart/form-data" id="generateReport">
          <div class="box-body">
            <div class="row">
              <div class="col-md-2">
                <label>Start Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="" value="<?php echo date('Y-m-d'); ?>" name="start_date">
                  <?php echo form_error('start_date', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
              <div class="col-md-2">
                <label>End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="" value="<?php echo date('Y-m-d'); ?>" name="end_date">
                  <?php echo form_error('end_date', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
        
                  <label for="name">Select Devices</label>

                  <div class="row">
                    <div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                      <?php if (isset($ClientMACIdData))
                        foreach ($ClientMACIdData as $key => $value) : ?>

                        <input type="checkbox" name="assigning[]" value="'<?php echo $value['device_id']?>'">
                        <?php echo $value['device_id']; ?>
                        </br>
                      <?php endforeach; ?>
                    </div>
                      <?php echo form_error('devices_id', '<p class="help-block error">', '</p>'); ?>
                  </div>
                </div>
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
					<div class="box-footer">
						<ul class="pagination pagination-sm no-margin pull-right">
						</ul>
					</div>
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
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
</script>