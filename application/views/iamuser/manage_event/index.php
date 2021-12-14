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
	<h1>Manage Events</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('iamuser/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo ""; ?>"><i class="fa fa-calendar"></i> Events	</a></li>
		<!-- <li class="active"><?php echo $action; ?></li> -->
	</ol>
</section>
<!-- Main content -->


<section class="content">
	<div class="row">
		
		<div class="col-xs-12">
			<a href="<?php echo $addURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-plus"></i> Add Event</a>
		</div>
		<?php if(!empty($success_msg)){ ?>
<div class="col-xs-12">
  <div class="alert alert-success"><?php echo $success_msg; ?></div>
</div>
<?php }elseif(!empty($error_msg)){ ?>
<div class="col-xs-12">
  <div class="alert alert-danger"><?php echo $error_msg; ?></div>
</div>
<?php } ?>
		<div class="col-md-12 ">
			<div class="box box-primary box-modify">
				<div class="box-header">
					<h3 class="box-title">Event Lists</h3>
					<div class="box-tools ">
						
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
				<!-- form start -->
				<div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr >
              <th >Name</th>
              <th >Description</th>
              <th >Location</th>
              <th >Start Date </th>
              <th >End Date </th>
              <th >Start Time</th>
              <th >End Time</th>
              <!-- <th >G.A Units</th>
              <th >Fix Units</th> -->
              <th >Device ID</th>
              <th >Action</th>
            </tr>
            <?php  
              if (!empty($EventDataList)) {
              foreach ($EventDataList as $key => $value) {
              ?>	
            <tr>
              <td><?= $value['event_name']?></td>
              <td><?= $value['description']?></td>
              <td><?= $value['location']?></td>
              <td><?= date('m-d-Y', strtotime($value['start_date']))?></td>
              <td><?= date('m-d-Y', strtotime($value['end_date']))?></td>
              <td><?= date('h:i A', strtotime($value['start_time']))?></td>
              <td><?= date('h:i A', strtotime($value['end_time']))?></td>
              <!-- <td><?php echo  count_GAUnit($value['group_id']); ?></td>
              <td><?php echo  count_FIXUnit($value['group_id']); ?></td> -->
              <td>
              <?= $value['device_id']?>
                <!-- <a href="#" title="Assign" data-skin="skin-purple" class="text-success"><i class="fa fa-2x fa-check" aria-hidden="true"></i></a>								 -->
              </td>
              <td class="action-links" >
                <a href="<?php echo str_replace('{ID}',base64_encode($value['id']),$editURL); ?>" title="Edit" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>								
                <a href="<?php echo str_replace('{ID}',base64_encode($value['id']),$deleteURL); ?>" onclick="return confirm('Are you sure to delete?')" title="Delete" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
            <?php } }else{ ?>
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
</section>
