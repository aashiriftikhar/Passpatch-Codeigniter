

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
  <h1><?php echo $action; ?> Group</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo $listURL; ?>"><i class="fa fa-th-large"></i> Group</a></li>
    <li class="active"><?php echo $action; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content" >
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary box-modify">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $action; ?> Group Details</h3>
          <a href="<?php echo $listURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <!-- form start -->
        <form name="addGroup" method="post" action="" enctype="multipart/form-data" id="addGroup">
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Group or Departmarnt Name </label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Group or Departmarnt name" value="<?php echo !empty($GroupData['name'])?$GroupData['name']:''; ?>" >
                  <?php echo form_error('name','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Location </label>
                  <input type="text" name="location" class="form-control" value="<?php echo !empty($GroupData['location'])?$GroupData['location']:''; ?>">
                  <?php echo form_error('name','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="description">Description </label>
                  <textarea class="form-control" rows="1" name="description" placeholder="Enter Description" value="" ><?php echo !empty($GroupData['description'])?$GroupData['description']:''; ?></textarea>
                  <?php echo form_error('description','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <!-- <div class="form-group">
                  <label for="name">Assign List of Serial Numbers Admission General Unit </label>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" >
                        <label for="generalUnit_device_id_from">From # </label>
                        <select class="form-control" name="generalUnit_device_id_from">
                          <option value="">Select</option>
                          <?php foreach ($ClientMACIdData as $key => $value):  ?>
                          <option <?php if(!empty($GroupData['generalUnit_device_id_from'])){ echo ($GroupData['generalUnit_device_id_from']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['device_id']?></option>
                          
 								<?php endforeach; ?>
                        </select>
                        <?php echo form_error('generalUnit_device_id_from','<p class="help-block error">','</p>'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" >
                        <label for="name">To # </label>
                        <select class="form-control" name="generalUnit_device_id_to">
                          <option value="">Select</option>
                          <?php foreach ($ClientMACIdData as $key => $value) : ?>
                          <option <?php if(!empty($GroupData['generalUnit_device_id_to'])){ echo ($GroupData['generalUnit_device_id_to']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['device_id']?></option>
                         
 								<?php endforeach; ?>
                        </select>
                        <?php echo form_error('generalUnit_device_id_to','<p class="help-block error">','</p>'); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-md-6"> -->
                <!-- <div class="form-group">
                  <label for="name">Assign Fix Unit # </label>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" >
                        <label for="fixUnit_device_id_from">From # </label>
                        <select class="form-control" name="fixUnit_device_id_from">
                          <option value="">Select</option>
                          <?php foreach ($ClientMACIdData as $key => $value):  ?>
                          <option <?php if(!empty($GroupData['fixUnit_device_id_from'])){ echo ($GroupData['fixUnit_device_id_from']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['device_id']?></option>
                          
 								<?php endforeach; ?>
                        </select>
                        <?php echo form_error('fixUnit_device_id_from','<p class="help-block error">','</p>'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" >
                        <label for="fixUnit_device_id_to">To # </label>
                        <select class="form-control" name="fixUnit_device_id_to">
                          <option value="">Select</option>
                          <?php foreach ($ClientMACIdData as $key => $value) : ?>
                          <option <?php if(!empty($GroupData['fixUnit_device_id_to'])){ echo ($GroupData['fixUnit_device_id_to']==$value['id'])? "selected": ""; } ?> value="<?= $value['id']?>"><?= $value['device_id']?></option>
                         
 								<?php endforeach; ?>
                        </select>
                        <?php echo form_error('fixUnit_device_id_to','<p class="help-block error">','</p>'); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            <!-- </div> -->
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="Status" class="">Status</label>
                  <select class="form-control" name="status">
                    <option value="">Please select</option>
                    <option <?php if(!empty($GroupData['status'])){ echo ($GroupData['status']=="Active")? "selected": ""; } ?> value="Active">Active</option>
                    <option <?php if(!empty($GroupData['status'])){ echo ($GroupData['status']=="Inactive")? "selected": ""; } ?> value="Inactive">Inactive</option>
                  </select>
                  <?php echo form_error('status','<p class="help-block error">','</p>'); ?>
                </div>
              </div>
              <div class="col-md-2" style="margin-bottom: -20px!important;">
                <div class="form-group" style="margin-top: 24px">
                  <label>  </label>
                  <input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="Submit"/>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

