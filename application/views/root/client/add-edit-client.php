<style type="text/css">
	.invalid-feedback {
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


	.input-file+.js-labelFile {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		padding: 0 10px;
		cursor: pointer;
		font-size: 16px;
		margin-left: -10px;
	}

	.input-file+.js-labelFile .icon:before {
		content: "\f093";
	}

	.input-file+.js-labelFile.has-file .icon:before {
		content: "\f00c";
		color: #5aac7b;
	}
</style>
<section class="content-header">
	<h1><?php echo $action; ?> Client </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('root/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo $listURL; ?>"><i class="fa fa-users"></i> Client </a></li>
		<li class="active"><?php echo $action; ?></li>
	</ol>
</section>
<!-- Main content -->
<?php
if (!empty($error_msg)) {
	echo '<div class="alert alert-danger">' . $error_msg . '</div>';
}
?>
<section class="content">
	<div class="row">


		<div class="col-md-12">
			<div class="box box-primary box-modify">
				<div class="box-header with-border">
					<h3 class="box-title">Client Details</h3>
					<a href="<?php echo $listURL; ?>" class="btn btn-success btn-modify pull-right"><i class="fa fa-arrow-left"></i> Back</a>

				</div>
				<!-- <a href="<?php echo $sampleFileDownload; ?>" class="label label-primary pull-right" >Download MAC ID Sample File</a> -->
				<!-- form start -->
				<form name="addClient" method="post" action="" enctype="multipart/form-data" id="addClient">
					<fieldset>

						<div class="box-body">
							<div class="row">
								<?php if (!empty($ClientData['email'])) : ?>
									<div class="col-md-4">
										<div class="form-group">

											<label for="profile_name">Select devices you want to delete</label>

											<div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">


												<?php if (isset($clientDevices))
													foreach ($clientDevices as $service) : ?>


													<input type="checkbox" value="<?php echo $service->device_id; ?>" name="removing[]">
													<?php echo "-" . $service->device_id; ?>

													<!-- <?php echo form_checkbox('device[]', $service->id, set_checkbox('device', $service->id)); ?> <?php echo $service->id . "-" . $service->device_id; ?> <br /> -->

													</br>
												<?php endforeach; ?>

											</div>
										</div>
									</div>
								<?php endif; ?>

								<div class="col-md-4">



									<div class="form-group">

										<label for="profile_name">Select devices you want to Add</label>

										<div style="height:120px;width:320px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">


											<?php if (isset($allDevices))
												foreach ($allDevices as $service) : ?>


												<input type="checkbox" value="<?php echo $service->device_id; ?>" name="assigning[]">
												<?php echo $service->device_id; ?>

												<!-- <?php echo form_checkbox('device[]', $service->id, set_checkbox('device', $service->id)); ?> <?php echo $service->id . "-" . $service->device_id; ?> <br /> -->

												</br>
											<?php endforeach; ?>

										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="profile_name">Client Profile Name </label>
										<input type="text" class="form-control" name="profile_name" placeholder="Enter client profile name" value="<?php echo !empty($ClientData['profile_name']) ? $ClientData['profile_name'] : ''; ?>">
										<?php echo form_error('profile_name', '<p class="help-block error">', '</p>'); ?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="name">Customer Type </label>
										<select class="form-control" name="customer_type">
											<option value="">Select</option>
											<!-- <?php foreach ($CustomerTypeData as $key => $value)  ?> -->
											<?php foreach ($CustomerTypeData as $key => $value) : ?>

												<option <?php if (!empty($ClientData['customer_type'])) {
															echo ($ClientData['customer_type'] == $value['id']) ? "selected" : "";
														} ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>

												<?
												?>

											<?php endforeach; ?>

										</select>
										<?php echo form_error('customer_type', '<p class="help-block error">', '</p>'); ?>
									</div>

									<?php foreach ($CustomerTypeData as $key => $value)  ?>
								</div>
								<!-- <div class="col-md-4">
		                <div class="form-group">
		                  <label></label>
		                  <input type="file" name="mac_id_file" id="file" class="input-file" accept=".xls">
		                  <label for="file" class="btn btn-tertiary js-labelFile">
		                  <i class="icon fa fa-check"></i>
		                  <span class="js-fileName"></span>
		                  </label> -->
								<!-- <label style="margin-top: 5px">Upload ASCII file serial number  or MAC ID</label>
		                  <?php if (!empty($mac_id_file_error)) {
								echo '<div class="help-block error">' . $mac_id_file_error . '</div>';
							} ?>
		                  <?php echo form_error('mac_id_file', '<p class="help-block error">', '</p>'); ?> -->

							</div>
						</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Email </label>
						<input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo !empty($ClientData['email']) ? $ClientData['email'] : ''; ?>">
						<?php echo form_error('email', '<p class="help-block error mt-2">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Phone Number </label>
						<input type="number" class="form-control" name="phone_number" placeholder="Enter phone number" value="<?php echo !empty($ClientData['phone_number']) ? $ClientData['phone_number'] : ''; ?>">
						<?php echo form_error('phone_number', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="country">Select Country </label>
						<select class="form-control" name="country" id="country">
							<option value="">Select </option>
							<?php
							foreach ($country as $row) { ?>
								<option <?php if (!empty($ClientData["country"])) {
											echo ($ClientData["country"] == $row->country_id) ? "selected" : "";
										} ?> value=<?= $row->country_id ?>><?= $row->country_name ?></option>
							<?php } ?>
						</select>
						<?php echo form_error('country', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="state">Select State </label>
						<select class="form-control" name="state" id="state">
							<option value="">Select State</option>
						</select>
						<?php echo form_error('state', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="city">City </label>
						<select class="form-control" name="city" id="city">
							<option value="">Select City</option>
						</select>
						<?php echo form_error('city', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="postal_code">Postal Code </label>
						<input type="number" class="form-control" name="postal_code" placeholder="Enter postal code" value="<?php echo !empty($ClientData['postal_code']) ? $ClientData['postal_code'] : ''; ?>">
						<?php echo form_error('postal_code', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="address_line1">Address Line 1 </label>
						<textarea class="form-control" name="address_line1" placeholder="Enter Address"><?php echo !empty($ClientData['address_line1']) ? $ClientData['address_line1'] : ''; ?></textarea>
						<?php echo form_error('address_line1', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="address_line2">Address Line 2 </label>
						<textarea class="form-control" name="address_line2" placeholder="Enter Address" value=""><?php echo !empty($ClientData['address_line2']) ? $ClientData['address_line2'] : ''; ?></textarea>
						<?php echo form_error('address_line2', '<p class="help-block error">', '</p>'); ?>

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="notes">Notes</label>
						<textarea class="form-control" name="notes" placeholder="Enter some notes" value=""><?php echo !empty($ClientData['notes']) ? $ClientData['notes'] : ''; ?></textarea>
						<?php echo form_error('notes', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="contact_name">Contact Name </label>
						<input type="text" class="form-control" name="contact_name" placeholder="Enter Contact name" value="<?php echo !empty($ClientData['contact_name']) ? $ClientData['contact_name'] : ''; ?>">
						<?php echo form_error('contact_name', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="contact_title">Contact Title </label>
						<input type="text" class="form-control" name="contact_title" placeholder="Enter Contact title" value="<?php echo !empty($ClientData['contact_title']) ? $ClientData['contact_title'] : ''; ?>">
						<?php echo form_error('contact_title', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="status" class="">Status</label>
						<select class="form-control" name="status">
							<option value="">Please select</option>
							<option <?php if (!empty($ClientData['status'])) {
										echo ($ClientData['status'] == "Active") ? "selected" : "";
									} ?> value="Active">Active</option>
							<option <?php if (!empty($ClientData['status'])) {
										echo ($ClientData['status'] == "Inactive") ? "selected" : "";
									} ?> value="Inactive">Inactive</option>
						</select>
						<?php echo form_error('status', '<p class="help-block error">', '</p>'); ?>
					</div>
				</div>
			</div>

			<!-- <div class="row">
				<?php if (empty($ClientData['email'])) : ?>
					<div class="col-md-4">
						<div class="form-group">
							<label for="device_count">Enter number of devices</label>
							<input min="1" max="<?php echo $deviceCount; ?>" type="number" class="form-control" name="device_count" placeholder="Device Count to Assign" value="<?php echo !empty($ClientData['device_count']) ? $ClientData['device_count'] : ''; ?>">
							<?php echo form_error('device_count', '<p class="help-block error">', '</p>'); ?>
						</div>
					</div>
				<?php endif; ?>


			</div> -->
			<div class="row">
				<div class="col-md-12">

					<hr style="border-top: 2px dotted #1c1a1a47;">
					<p style="margin-left: 10px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat , Duis aute irure dolor in reprehenderit in voluptate velit esse.
					</p>
				</div>
			</div>
		</div>
		<div class="box-footer ">
			<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="<?php echo $action_btn; ?> Profile" />
		</div>
		</fieldset>
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

<script>
	$(document).ready(function() {
		fun_country();


		$('#country').change(function() {
			fun_country();
		});
		$('#service').change(function() {
			checkBox();
		});

		$('#state').change(function() {
			fun_state('');


		});

		function checkBox() {
			console.log("Asds")
			var checkboxes = document.forms["list"]["checkID"];
			if (checkboxes.length == undefined) {
				if (checkboxes.checked) {
					return true;
				}
			} else {
				for (var i = 0; i < checkboxes.length; i++) {
					if (checkboxes[i].checked) {
						return true;
					}
				}
			}
			alert("Please select a user to edit / delete.");
			return false;
		}


		function fun_country() {
			var country_id = $('#country').val();
			var state_id = <?= (isset($ClientData['state'])  && $ClientData['state']) ? $ClientData['state'] : 0 ?>;
			if (country_id != '') {
				$.ajax({
					url: "<?php echo base_url(); ?>root/Client/fetch_state",
					method: "POST",
					data: {
						country_id: country_id,
						state_id: state_id
					},
					success: function(data) {
						fun_state(state_id);
						$('#state').html(data);

						$('#city').html('<option value="">Select City</option>');
					}
				});
			} else {
				$('#state').html('<option value="">Select State</option>');
				$('#city').html('<option value="">Select City</option>');
			}
		}

		function fun_state(state_id) {
			if (state_id) {
				var state_id = state_id;

			} else {

				var state_id = $('#state').val();
			}
			var city_id = <?= (isset($ClientData['city'])  && $ClientData['city']) ? $ClientData['city'] : 0 ?>;
			if (state_id != '') {

				$.ajax({
					url: "<?php echo base_url(); ?>root/Client/fetch_city",
					method: "POST",
					data: {
						state_id: state_id,
						city_id: city_id
					},
					success: function(data) {
						$('#city').html(data);
					}
				});
			} else {
				$('#city').html('<option value="">Select City</option>');
			}
		}

	});
</script>