 <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/timepicker/bootstrap-timepicker.min.css">
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
	<h1>Settings</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('root/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo ""; ?>"><i class="fa fa-cog"></i> Settings</a></li>
		<!-- <li class="active"><?php echo $action; ?></li> -->
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	
	
		<div class="col-md-12" style="margin-bottom: -8px">
			<div class="box box-primary box-modify">

					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="name">Select Client </label>
									<select class="form-control">
										<option>Please select</option>									
										<option>Jon Test</option>
										<option>Bob Demo</option>										
									</select>
								</div>
							</div>							
							<div class="col-md-4">
								<div class="form-group">
									<label for="name">Select Client's Group </label>
									<select class="form-control">
										<option>Please select</option>								
										<option>Event / Sports Organizers</option>
										<option>Schools Management</option>
										<option>Health Care Management</option>									
									</select>
								</div>
							</div>							
							<div class="col-md-4">
								<div class="form-group">
									<label for="name">Select Client's Event </label>
									<select class="form-control">
										<option>Please select</option>
										<option>Newton Hospital </option>
										<option>Saint Mary's Nursing Home</option>
										<option>Event Demo 1</option>										
										<option>Event Demo 2</option>										
									</select>
								</div>
							</div>							
						</div>	
					</div>					
			</div>
		</div>

		<div class="col-md-12" style="margin-bottom: -8px">
			<div class="box box-primary box-modify">
					<div style="margin: 10px 10px 0 10px;">
						
					<strong>Device Update</strong>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Select Range Serial # </label>
										<div class="row">
											<div class="col-md-6">
												<label for="name">From # </label>
												<select class="form-control">
													<option>Please select</option>									
													<option>00:1B:44:11:3A:B0</option>
													<option>00:1B:44:11:3A:B1</option>
													<option>00:1B:44:11:3A:B2</option>
													<option>00:1B:44:11:3A:B3</option>
													<option>00:1B:44:11:3A:B4</option>
													<option>00:1B:44:11:3A:B5</option>
													<option>00:1B:44:11:3A:B6</option>
													<option>00:1B:44:11:3A:B7</option>
													<option>00:1B:44:11:3A:B8</option>
													<option>00:1B:44:11:3A:B9</option>
													<option>00:1B:44:11:3A:C0</option>
													<option>00:1B:44:11:3A:C1</option>
													<option>00:1B:44:11:3A:C2</option>
													<option>00:1B:44:11:3A:C3</option>
													<option>00:1B:44:11:3A:C4</option>
													<option>00:1B:44:11:3A:C5</option>
													<option>00:1B:44:11:3A:C6</option>
													<option>00:1B:44:11:3A:C7</option>
													<option>00:1B:44:11:3A:C8</option>
													<option>00:1B:44:11:3A:C9</option>
													<option>00:1B:44:11:3A:D0</option>
													<option>00:1B:44:11:3A:D1</option>
													<option>00:1B:44:11:3A:D2</option>
													<option>00:1B:44:11:3A:D3</option>
													<option>00:1B:44:11:3A:D4</option>											
												</select>
											</div>
											<div class="col-md-6">
												<label for="name">To # </label>
												<select class="form-control">
													<option>Please select</option>									
													<option>00:1B:44:11:3A:B0</option>
													<option>00:1B:44:11:3A:B1</option>
													<option>00:1B:44:11:3A:B2</option>
													<option>00:1B:44:11:3A:B3</option>
													<option>00:1B:44:11:3A:B4</option>
													<option>00:1B:44:11:3A:B5</option>
													<option>00:1B:44:11:3A:B6</option>
													<option>00:1B:44:11:3A:B7</option>
													<option>00:1B:44:11:3A:B8</option>
													<option>00:1B:44:11:3A:B9</option>
													<option>00:1B:44:11:3A:C0</option>
													<option>00:1B:44:11:3A:C1</option>
													<option>00:1B:44:11:3A:C2</option>
													<option>00:1B:44:11:3A:C3</option>
													<option>00:1B:44:11:3A:C4</option>
													<option>00:1B:44:11:3A:C5</option>
													<option>00:1B:44:11:3A:C6</option>
													<option>00:1B:44:11:3A:C7</option>
													<option>00:1B:44:11:3A:C8</option>
													<option>00:1B:44:11:3A:C9</option>
													<option>00:1B:44:11:3A:D0</option>
													<option>00:1B:44:11:3A:D1</option>
													<option>00:1B:44:11:3A:D2</option>
													<option>00:1B:44:11:3A:D3</option>
													<option>00:1B:44:11:3A:D4</option>
												</select>
											</div>
									</div>
								</div>
							</div>							
							<div class="col-md-6 " >
								<div class="form-group" >
									<label for="name">Device Serial # </label>
									<select class="form-control" style="margin-top: 24px">
										<option>Please select</option>									
										<option>00:1B:44:11:3A:B0</option>
										<option>00:1B:44:11:3A:B1</option>
										<option>00:1B:44:11:3A:B2</option>
										<option>00:1B:44:11:3A:B3</option>
										<option>00:1B:44:11:3A:B4</option>
										<option>00:1B:44:11:3A:B5</option>
										<option>00:1B:44:11:3A:B6</option>
										<option>00:1B:44:11:3A:B7</option>
										<option>00:1B:44:11:3A:B8</option>
										<option>00:1B:44:11:3A:B9</option>
										<option>00:1B:44:11:3A:C0</option>
										<option>00:1B:44:11:3A:C1</option>
										<option>00:1B:44:11:3A:C2</option>
										<option>00:1B:44:11:3A:C3</option>
										<option>00:1B:44:11:3A:C4</option>
										<option>00:1B:44:11:3A:C5</option>
										<option>00:1B:44:11:3A:C6</option>
										<option>00:1B:44:11:3A:C7</option>
										<option>00:1B:44:11:3A:C8</option>
										<option>00:1B:44:11:3A:C9</option>
										<option>00:1B:44:11:3A:D0</option>
										<option>00:1B:44:11:3A:D1</option>
										<option>00:1B:44:11:3A:D2</option>
										<option>00:1B:44:11:3A:D3</option>
										<option>00:1B:44:11:3A:D4</option>
									</select>
								</div>
							</div>							
												
						</div>	
					</div>					
			</div>
		</div>

		<div class="col-md-12" style="margin-bottom: -8px">
			<div class="box box-primary box-modify">

					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								
									<label for="name">Select Date </label>
										<div class="row">
										<div class="col-md-6">
											<label for="name">From  </label>
											<div class="input-group date">
							                  <div class="input-group-addon">
							                    <i class="fa fa-calendar"></i>
							                  </div>
							                  <input type="text" class="form-control pull-right datepicker" value="<?= date('m/d/Y')?>">
							                </div>
										</div>
										<div class="col-md-6">
											<label for="name">To </label>
											<div class="input-group date">
							                  <div class="input-group-addon">
							                    <i class="fa fa-calendar"></i>
							                  </div>
							                  <input type="text" class="form-control pull-right datepicker" value="<?= date('m/d/Y')?>">
							                </div>
										</div>
									</div>
									
							</div>	
							<div class="col-md-8">
								
									<label for="name">Select Time </label>
									<div class="row">
										<div class="col-md-3 bootstrap-timepicker">
											
							                  <label>From</label>

							                  <div class="input-group">
							                    <input type="text" class="form-control timepicker">

							                    <div class="input-group-addon">
							                      <i class="fa fa-clock-o"></i>
							                    </div>
							                  </div>
							                  <!-- /.input group -->

									    </div>
										<div class="col-md-3 bootstrap-timepicker">
											
							                  <label>To</label>

							                  <div class="input-group">
							                    <input type="text" class="form-control timepicker">

							                    <div class="input-group-addon">
							                      <i class="fa fa-clock-o"></i>
							                    </div>
							                  </div>
							                  <!-- /.input group -->
							                
									    </div>
									    
										<div class="col-md-6 form-group">
							                  <label>Select Time Zone</label>
											<div class="form-group">
										    	<select class="form-control">
													<option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">(GMT-12:00) International Date Line West</option>
													<option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
													<option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="-10">(GMT-10:00) Hawaii</option>
													<option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="-9">(GMT-09:00) Alaska</option>
													<option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
													<option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
													<option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="-7">(GMT-07:00) Arizona</option>
													<option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
													<option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
													<option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Central America</option>
													<option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
													<option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
													<option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Saskatchewan</option>
													<option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
													<option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
													<option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Indiana (East)</option>
													<option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
													<option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
													<option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Manaus</option>
													<option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Santiago</option>
													<option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="-3.5">(GMT-03:30) Newfoundland</option>
													<option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Brasilia</option>
													<option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
													<option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Greenland</option>
													<option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Montevideo</option>
													<option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
													<option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
													<option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="-1">(GMT-01:00) Azores</option>
													<option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
													<option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
													<option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
													<option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
													<option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
													<option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
													<option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) West Central Africa</option>
													<option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Amman</option>
													<option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
													<option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Beirut</option>
													<option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Cairo</option>
													<option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="2">(GMT+02:00) Harare, Pretoria</option>
													<option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
													<option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Jerusalem</option>
													<option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Minsk</option>
													<option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Windhoek</option>
													<option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
													<option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
													<option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Nairobi</option>
													<option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Tbilisi</option>
													<option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="3.5">(GMT+03:30) Tehran</option>
													<option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
													<option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Baku</option>
													<option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Yerevan</option>
													<option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="4.5">(GMT+04:30) Kabul</option>
													<option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="5">(GMT+05:00) Yekaterinburg</option>
													<option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
													<option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
													<option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
													<option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="5.75">(GMT+05:45) Kathmandu</option>
													<option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
													<option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="6">(GMT+06:00) Astana, Dhaka</option>
													<option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
													<option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
													<option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="7">(GMT+07:00) Krasnoyarsk</option>
													<option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
													<option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
													<option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
													<option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Perth</option>
													<option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Taipei</option>
													<option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
													<option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Seoul</option>
													<option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="9">(GMT+09:00) Yakutsk</option>
													<option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Adelaide</option>
													<option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Darwin</option>
													<option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Brisbane</option>
													<option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
													<option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Hobart</option>
													<option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
													<option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Vladivostok</option>
													<option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
													<option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="12">(GMT+12:00) Auckland, Wellington</option>
													<option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
													<option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="13">(GMT+13:00) Nuku'alofa</option>
												</select>			
											</div>
									    </div>
									</div>
								
							</div>								
						</div>	
								<input type="submit" name="userSubmit" class="btn btn-primary  btn-modify" value="Save"/>
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
      autoclose: true
    })

   	 //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

</script>