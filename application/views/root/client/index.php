<style type="text/css">  
  .action-links {
    width: ;
    padding: 5px !important;
  }
</style>
<section class="content-header">
	<h1>Manage Client List</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>root/Home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Client List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content"  style="margin-top: -8px">
	<div class="row">
			<div class="col-xs-12">
			<a href="<?php echo $addURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-plus"></i> Add Client List</a>
		
        </div>
    </div>    
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
              <th style="width: 5%!important">Email</th>
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
                <td><?= $value['total_devices']; ?></td>
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