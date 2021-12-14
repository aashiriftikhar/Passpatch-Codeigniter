<link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">



<style type="text/css">
  .small-box .icon {
    font-size: 80px !important;
  }

  .small-box:hover .icon {
    font-size: 85px !important;
  }

  img {
    max-width: 100px;
    max-height: 100px !important;
  }

  .tableFixHead {
    overflow-y: auto;
    height: 150px;
  }

  .tableFixHead thead th {
    position: sticky;
    top: 0;
    background-color: white !important;

  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Dashboard<small>Control panel</small></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>iamuser/Home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<br>
<?php if (!empty($success_msg)) { ?>
  <div class="col-xs-12">
    <div class="alert alert-success"><?php echo $success_msg; ?></div>
  </div>
<?php } elseif (!empty($error_msg)) { ?>
  <div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
  </div>
<?php } ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12 ">
      <div class="box box-primary box-modify">
        <div class="box-header">
          <h3 class="box-title">Event Lists</h3>
          <div class="box-tools ">
            <form name="search_form" action="<?php echo $listURL; ?>" method="post" />
            <div class="input-group input-group-sm" style="width: 350px;">
              <input type="text" name="userSearchKeyword" placeholder="Enter keywords..." value="<?php echo !empty($searchKeyword) ? $searchKeyword : ''; ?>" class="form-control pull-right">
              <div class="input-group-btn">
                <input type="submit" name="submitSearch" class="btn btn-default" value="SEARCH">
                <input type="submit" name="submitSearchReset" class="btn btn-default" value="RESET">
                <!--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>-->
              </div>
            </div>
            </form>
          </div>
        </div>
        <!-- form start -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Location</th>
              <th>Start Date </th>
              <th>End Date </th>
              <th>Start Time</th>
              <th>End Time</th>
              <!-- <th>G.A Units</th>
              <th>Fix Units</th> -->
              <th>DeviceID</th>
              <th>Action</th>
            </tr>
            <?php
            if (!empty($EventDataList)) {
              foreach ($EventDataList as $key => $value) {
            ?>
                <tr>
                  <td><?= $value['event_name'] ?></td>
                  <td><?= $value['description'] ?></td>
                  <td><?= $value['location'] ?></td>
                  <td><?= date('m-d-Y', strtotime($value['start_date'])) ?></td>
                  <td><?= date('m-d-Y', strtotime($value['end_date'])) ?></td>
                  <td><?= date('h:i A', strtotime($value['start_time'])) ?></td>
                  <td><?= date('h:i A', strtotime($value['end_time'])) ?></td>
                  <!-- <td><?php echo  count_GAUnit($value['group_id']); ?></td>
                  <td><?php echo  count_FIXUnit($value['group_id']); ?></td> -->
                  
                  
                    <!-- <a href="#" title="Assign" data-skin="skin-purple" class="text-success"><i class="fa fa-2x fa-check" aria-hidden="true"></i></a> -->

                  <td><?= $value['device_id'] ?></td>
                  
                  <td class="action-links">
                    <a href="<?php echo str_replace('{ID}', base64_encode($value['id']), $editURL); ?>" title="Edit" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href="<?php echo str_replace('{ID}', base64_encode($value['id']), $deleteURL); ?>" onclick="return confirm('Are you sure to delete?')" title="Delete" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                </tr>
              <?php }
            } else { ?>
              <tr>
                <td colspan="10" style="text-align: center;">Events not found....</td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="box-footer">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->pagination->create_links(); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 ">
      <div class="box box-primary" style="border-top-color: #f03f3f!important;">
        <div class="box-header" style="border-bottom: 1px solid #f0e5e5!important;">
          <h3 class="box-title">High Temperature Alerts</h3>

        </div>
        <!-- form start -->
        <div class="box-body  tableFixHead no-padding">
          <table class="table " id="tableData">
            <thead>
              <tr>
                <th>Event Name</th>

                <th>MAC ID</th>
                <th>Temperature</th>
                <th>Date</th>
                <th>Time</th>
                <th>Alert</th>
                <th>GPS</th>
              </tr>
            </thead>
            <?php
            //print_r($EventAlertData);

            if (!empty($EventAlertData)) {
              foreach ($EventAlertData as $key => $value) {
            ?>
                <tr>
                  <td><?= $value['event_name'] ?></td>

                  <td><?= $value['device_mac_id'] ?></td>
                  <td style="color: #f03f3f; font-weight: bold"><?= $value['temperature'] ?></td>
                  <td><?= date('m-d-Y', strtotime($value['date_time'])) ?></td>
                  <td><?= date('h:i A', strtotime($value['date_time'])) ?></td>
                  <td>
                    <a data-skin="skin-purple" style="color: #f03f3f">
                      <i class="fa fa-2x fa-exclamation-circle" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= $value['lat'] ?>,<?= $value['lon'] ?>" title="GPS Coordinates" data-skin="skin-purple" class="text-success" target="__blank">
                      <i class="fa fa-2x fa-map-marker" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              <?php }
            } else { ?>
              <tr>
                <td colspan="7" style="text-align: center;">No Data Available....</td>
              </tr>
            <?php } ?>
          </table>
        </div>

      </div>
    </div>
  </div>
</section>

<section class="content" style="margin-top: -44px;margin-bottom: -20px">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary box-modify">
        <div class="box-header with-border">
          <h3 class="box-title">Add Event Details</h3>
        </div>
        <!-- form start -->
        <form name="addEvent" method="post" action="" enctype="multipart/form-data" id="addEvent">
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="event_name">Event Name </label>
                  <input type="text" class="form-control" name="event_name[]" placeholder="Enter Event name" value="<?php echo !empty($EventData['event_name']) ? $EventData['event_name'] : ''; ?>">
                  <?php echo form_error('event_name', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="location">Location </label>
                  <input type="text" class="form-control" name="location[]" placeholder="Enter Location" value="<?php echo !empty($EventData['location']) ? $EventData['location'] : ''; ?>">
                  <?php echo form_error('location', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name">Select Group </label>
                  <select class="form-control" name="group[]">
                    <option value="">Select</option>
                    <?php foreach ($GroupsData as $key => $value) :  ?>
                      <option <?php if (!empty($EventData['group_id'])) {
                                echo ($EventData['group_id'] == $value['id']) ? "selected" : "";
                              } ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('group', '<p class="help-block error">', '</p>'); ?>
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
                  <input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['start_date']) ? $EventData['start_date'] : date('m/d/Y'); ?>" name="start_date[]">
                  <?php echo form_error('start_date', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
              <div class="col-md-2">
                <label>End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['end_date']) ? $EventData['end_date'] : date('m/d/Y'); ?>" name="end_date[]">
                  <?php echo form_error('end_date', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
              <div class="col-md-2 bootstrap-timepicker">
                <label>Start Time</label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="start_time[]" value="<?php echo !empty($EventData['start_time']) ? $EventData['start_time'] : date('m/d/Y'); ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <?php echo form_error('start_time', '<p class="help-block error">', '</p>'); ?>
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-md-2 bootstrap-timepicker">
                <label>End Time </label>
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="end_time[]" value="<?php echo !empty($EventData['end_time']) ? $EventData['end_time'] : date('m/d/Y'); ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <?php echo form_error('end_time', '<p class="help-block error">', '</p>'); ?>
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-md-4">
                <label>Select Time Zone</label>
                <div class="form-group">
                  <select class="form-control" name="time_zone[]">
                    <option value="">Select</option>
                    <?php foreach ($TimeZoneList as $key => $value) :  ?>
                      <option <?php if (!empty($EventData['time_zone'])) {
                                echo ($EventData['time_zone'] == $value['value']) ? "selected" : "";
                              } ?> value="<?= $value['value'] ?>"><?= $value['text'] ?></option>

                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('time_zone', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description">Description </label>
                  <textarea class="form-control" rows="1" name="description[]" placeholder="Enter description" value=""><?php echo !empty($EventData['description']) ? $EventData['description'] : ''; ?></textarea>
                  <?php echo form_error('description', '<p class="help-block error">', '</p>'); ?>
                </div>
              </div>
              <div class="col-md-6 form-group">

                <!-- <label for="name">Select Device ID Range</label>
                <div class="row">
                  <div class="col-md-5">
                    <select class="form-control" name="from_device_id[]">
                      <option value="">Select</option>
                      <?php foreach ($ClientMACIdData as $key => $value) :  ?>
                        <option <?php if (!empty($GroupData['from_device_id'])) {
                                  echo ($GroupData['from_device_id'] == $value['id']) ? "selected" : "";
                                } ?> value="<?= $value['id'] ?>"><?= $value['device_id'] ?></option>

                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('from_device_id', '<p class="help-block error">', '</p>'); ?>
                  </div>
                  <div class="col-xs-1">
                    <label>To</label>
                  </div>
                  <div class="col-md-5">
                    <select class="form-control" name="to_device_id[]">
                      <option value="">Select</option>
                      <?php foreach ($ClientMACIdData as $key => $value) :  ?>
                        <option <?php if (!empty($GroupData['to_device_id'])) {
                                  echo ($GroupData['to_device_id'] == $value['id']) ? "selected" : "";
                                } ?> value="<?= $value['id'] ?>"><?= $value['device_id'] ?></option>

                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('to_device_id', '<p class="help-block error">', '</p>'); ?>
                  </div>
                </div>
              </div> -->

 										<label for="name">Select Devices </label>

<div class="row">
<div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
<?php if (isset($ClientMACIdData))
foreach ($ClientMACIdData as $key => $value) : ?>

<input type="checkbox" name="assigning[0][]" value="<?php echo $value['id']; ?>">
<?php echo $value['device_id']; ?>
</br>
<?php endforeach; ?>
</div>
  </div>
</div>
            </div>
            <div class="col-md-2">
              <div class="form-group" style="margin-top: 20px">
                <button type="button" name="add" id="add" class="btn btn-success">Add Sub Event</button>
                <input type="submit" name="userSubmit" class="btn btn-primary" value="Submit" />
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                  <input type="file" id="file-input" name="image" accept="image/png,image/gif,image/jpeg" style="width:190px">
                </div> -->
            <!-- leftbox -->
            <!-- </div>
              <div class="col-md-1">
                <div class="imgbox-2">
                  <div class="result">
                    <?php if (!empty($EventData['image'])) { ?>   
                    <img src="<?php echo base_url('uploads/event_img/') . $EventData['image'] ?>" id='image' >
                    <?php } ?>   
                  </div>
                </div> -->
            <!--rightbox-->
            <div class="imgbox-2 img-result hide">
              <!-- result of crop -->
              <img class="cropped" src="" alt="">
            </div>
            <!-- input file -->
            <div class="imgbox">
              <div class="options hide">
              </div>
              <!-- save btn -->
              <button class="btn savebtn hide">Done</button>
              <!-- download btn -->
              <!-- <a href="" class="btn download hide">Download</a> -->
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
  $(document).ready(function() {

    var i = 1;
    var cell = $('<div id="row' + i + '"><div class="box-body"><div class="row"><div class="col-md-4"><div class="form-group"><label for="event_name">Event Name </label><input type="text" class="form-control" name="event_name[]" placeholder="Enter Event name" value="<?php echo !empty($EventData['event_name']) ? $EventData['event_name'] : ''; ?>"><?php echo form_error('event_name', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><div class="form-group"><label for="location">Location </label><input type="text" class="form-control" name="location[]" placeholder="Enter Location" value="<?php echo !empty($EventData['location']) ? $EventData['location'] : ''; ?>"><?php echo form_error('location', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><div class="form-group"><label for="name">Select Group </label><select class="form-control" name="group[]"><option value="">Select</option><?php foreach ($GroupsData as $key => $value) :  ?><option <?php if (!empty($EventData['group_id'])) {echo ($EventData['group_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option><?php endforeach; ?></select><?php echo form_error('group', '<p class="help-block error">', '</p>'); ?></div></div></div><div class="row"><div class="col-md-2"><label>Start Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['start_date']) ? $EventData['start_date'] : date('m/d/Y'); ?>" name="start_date[]"><?php echo form_error('start_date', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2"><label>End Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['end_date']) ? $EventData['end_date'] : date('m/d/Y'); ?>" name="end_date[]"><?php echo form_error('end_date', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2 bootstrap-timepicker"><label>Start Time</label><div class="input-group"><input type="text" class="form-control timepicker" name="start_time[]" value="<?php echo !empty($EventData['start_time']) ? $EventData['start_time'] : date('m/d/Y'); ?>"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div><?php echo form_error('start_time', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2 bootstrap-timepicker"><label>End Time </label><div class="input-group"><input type="text" class="form-control timepicker" name="end_time[]" value="<?php echo !empty($EventData['end_time']) ? $EventData['end_time'] : date('m/d/Y'); ?>"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div><?php echo form_error('end_time', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><label>Select Time Zone</label><div class="form-group"><select class="form-control" name="time_zone[]"><option value="">Select</option><?php foreach ($TimeZoneList as $key => $value) :  ?><option <?php if (!empty($EventData['time_zone'])) {echo ($EventData['time_zone'] == $value['value']) ? "selected" : "";} ?> value="<?= $value['value'] ?>"><?= $value['text'] ?></option><?php endforeach; ?></select><?php echo form_error('time_zone', '<p class="help-block error">', '</p>'); ?></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="description">Description </label><textarea class="form-control" rows="1" name="description[]" placeholder="Enter description" value=""><?php echo !empty($EventData['description']) ? $EventData['description'] : ''; ?></textarea><?php echo form_error('description', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-6 form-group"><label for="name">Select Device ID Range</label><div class="row"><div class="col-md-5"><select class="form-control" name="from_device_id[]"><option value="">Select</option><?php foreach ($ClientMACIdData as $key => $value) :  ?><option <?php if (!empty($GroupData['from_device_id'])) {echo ($GroupData['from_device_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['device_id'] ?></option><?php endforeach; ?></select><?php echo form_error('from_device_id', '<p class="help-block error">', '</p>'); ?></div><div class="col-xs-1"><label>To</label></div><div class="col-md-5"><select class="form-control" name="to_device_id[]"><option value="">Select</option><?php foreach ($ClientMACIdData as $key => $value) :  ?><option <?php if (!empty($GroupData['to_device_id'])) {echo ($GroupData['to_device_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['device_id'] ?></option><?php endforeach; ?></select><?php echo form_error('to_device_id', '<p class="help-block error">', '</p>'); ?></div></div></div></div></div>');
    

    $('#add').click(function() {
      // $('#addEvent').append('<div id="row' + i + '"><div class="box-body"><div class="row"><div class="col-md-4"><div class="form-group"><label for="event_name">Event Name </label><input type="text" class="form-control" name="event_name[]" placeholder="Enter Event name" value="<?php echo !empty($EventData['event_name']) ? $EventData['event_name'] : ''; ?>"><?php echo form_error('event_name', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><div class="form-group"><label for="location">Location </label><input type="text" class="form-control" name="location[]" placeholder="Enter Location" value="<?php echo !empty($EventData['location']) ? $EventData['location'] : ''; ?>"><?php echo form_error('location', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><div class="form-group"><label for="name">Select Group </label><select class="form-control" name="group[]"><option value="">Select</option><?php foreach ($GroupsData as $key => $value) :  ?><option <?php if (!empty($EventData['group_id'])) {echo ($EventData['group_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option><?php endforeach; ?></select><?php echo form_error('group', '<p class="help-block error">', '</p>'); ?></div></div></div><div class="row"><div class="col-md-2"><label>Start Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['start_date']) ? $EventData['start_date'] : date('m/d/Y'); ?>" name="start_date[]"><?php echo form_error('start_date', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2"><label>End Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['end_date']) ? $EventData['end_date'] : date('m/d/Y'); ?>" name="end_date[]"><?php echo form_error('end_date', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2 bootstrap-timepicker"><label>Start Time</label><div class="input-group"><input type="text" class="form-control timepicker" name="start_time[]" value="<?php echo !empty($EventData['start_time']) ? $EventData['start_time'] : date('m/d/Y'); ?>"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div><?php echo form_error('start_time', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2 bootstrap-timepicker"><label>End Time </label><div class="input-group"><input type="text" class="form-control timepicker" name="end_time[]" value="<?php echo !empty($EventData['end_time']) ? $EventData['end_time'] : date('m/d/Y'); ?>"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div><?php echo form_error('end_time', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><label>Select Time Zone</label><div class="form-group"><select class="form-control" name="time_zone[]"><option value="">Select</option><?php foreach ($TimeZoneList as $key => $value) :  ?><option <?php if (!empty($EventData['time_zone'])) {echo ($EventData['time_zone'] == $value['value']) ? "selected" : "";} ?> value="<?= $value['value'] ?>"><?= $value['text'] ?></option><?php endforeach; ?></select><?php echo form_error('time_zone', '<p class="help-block error">', '</p>'); ?></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="description">Description </label><textarea class="form-control" rows="1" name="description[]" placeholder="Enter description" value=""><?php echo !empty($EventData['description']) ? $EventData['description'] : ''; ?></textarea><?php echo form_error('description', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-6 form-group"><label for="name">Select Device ID Range</label><div class="row"><div class="col-md-5"><select class="form-control" name="from_device_id[]"><option value="">Select</option><?php foreach ($ClientMACIdData as $key => $value) :  ?><option <?php if (!empty($GroupData['from_device_id'])) {echo ($GroupData['from_device_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['device_id'] ?></option><?php endforeach; ?></select><?php echo form_error('from_device_id', '<p class="help-block error">', '</p>'); ?></div><div class="col-xs-1"><label>To</label></div><div class="col-md-5"><select class="form-control" name="to_device_id[]"><option value="">Select</option><?php foreach ($ClientMACIdData as $key => $value) :  ?><option <?php if (!empty($GroupData['to_device_id'])) {echo ($GroupData['to_device_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['device_id'] ?></option><?php endforeach; ?></select><?php echo form_error('to_device_id', '<p class="help-block error">', '</p>'); ?></div><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div></div></div></div>');
      $('#addEvent').append('<div id="row' + i + '"><div class="box-body"><div class="row"><div class="col-md-4"><div class="form-group"><label for="event_name">Event Name </label><input type="text" class="form-control" name="event_name[]" placeholder="Enter Event name" value="<?php echo !empty($EventData['event_name']) ? $EventData['event_name'] : ''; ?>"><?php echo form_error('event_name', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><div class="form-group"><label for="location">Location </label><input type="text" class="form-control" name="location[]" placeholder="Enter Location" value="<?php echo !empty($EventData['location']) ? $EventData['location'] : ''; ?>"><?php echo form_error('location', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><div class="form-group"><label for="name">Select Group </label><select class="form-control" name="group[]"><option value="">Select</option><?php foreach ($GroupsData as $key => $value) :  ?><option <?php if (!empty($EventData['group_id'])) {echo ($EventData['group_id'] == $value['id']) ? "selected" : "";} ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option><?php endforeach; ?></select><?php echo form_error('group', '<p class="help-block error">', '</p>'); ?></div></div></div><div class="row"><div class="col-md-2"><label>Start Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['start_date']) ? $EventData['start_date'] : date('m/d/Y'); ?>" name="start_date[]"><?php echo form_error('start_date', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2"><label>End Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker" id="" value="<?php echo !empty($EventData['end_date']) ? $EventData['end_date'] : date('m/d/Y'); ?>" name="end_date[]"><?php echo form_error('end_date', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2 bootstrap-timepicker"><label>Start Time</label><div class="input-group"><input type="text" class="form-control timepicker" name="start_time[]" value="<?php echo !empty($EventData['start_time']) ? $EventData['start_time'] : date('m/d/Y'); ?>"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div><?php echo form_error('start_time', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-2 bootstrap-timepicker"><label>End Time </label><div class="input-group"><input type="text" class="form-control timepicker" name="end_time[]" value="<?php echo !empty($EventData['end_time']) ? $EventData['end_time'] : date('m/d/Y'); ?>"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div><?php echo form_error('end_time', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-4"><label>Select Time Zone</label><div class="form-group"><select class="form-control" name="time_zone[]"><option value="">Select</option><?php foreach ($TimeZoneList as $key => $value) :  ?><option <?php if (!empty($EventData['time_zone'])) {echo ($EventData['time_zone'] == $value['value']) ? "selected" : "";} ?> value="<?= $value['value'] ?>"><?= $value['text'] ?></option><?php endforeach; ?></select><?php echo form_error('time_zone', '<p class="help-block error">', '</p>'); ?></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="description">Description </label><textarea class="form-control" rows="1" name="description[]" placeholder="Enter description" value=""><?php echo !empty($EventData['description']) ? $EventData['description'] : ''; ?></textarea><?php echo form_error('description', '<p class="help-block error">', '</p>'); ?></div></div><div class="col-md-6 form-group"><label for="name">Select Devices </label><div class="row"><div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;"><?php if (isset($ClientMACIdData)) foreach ($ClientMACIdData as $key => $value) : ?><input type="checkbox" name="assigning[' + i + '][]"  value="<?php echo $value['id']; ?>"><?php echo $value['id']."-".$value['device_id']; ?></br><?php endforeach; ?></div></div></div><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div></div></div>');
      
        i++;
        $('.datepicker').datepicker({
    autoclose: true
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      var res = confirm('Are You Sure You Want To Delete This?');
      if (res == true) {
        $('#row' + button_id + '').remove();
        $('#' + button_id + '').remove();
      }
    });

  });
</script>
<!-- /.content -->