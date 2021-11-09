<style type="text/css">
	.invalid-feedback{
	color: red;
	}

	/* Global style */

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
	}
	.input-file + .js-labelFile .icon:before {
	content: "\f093";
	}
	.input-file + .js-labelFile.has-file .icon:before {
	content: "\f00c";
	color: #5aac7b;
	}
</style>
<section class="content-header">
	<h1><?php echo $action; ?> Customer Type</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('superadmin/master/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $listURL; ?>"><i class="fa fa-users"></i> Customer Type</a></li>
		<li class="active"><?php echo $action; ?></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<a href="<?php echo $listURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
		<div class="col-xs-12">
		</div>
		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title">Customer Type Details</h3>
				</div>
				<!-- form start -->
				<form name="addClient" method="post" action="" enctype="multipart/form-data" id="addClient">
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="name">Name </label>
									<input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo !empty($CustomerTypeData['name'])?$CustomerTypeData['name']:''; ?>" >
									<?php echo form_error('name','<p class="help-block error">','</p>'); ?>
								</div>
							</div>
						</div>
					</div>					
				
					<div class="box-footer ">
						<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="<?= $action_btn ?>"/>
					</div>
				</form>	
			</div>
		</div>				
	
	</div>
</section>

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