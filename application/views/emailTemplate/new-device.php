<!DOCTYPE html>
<html>
   <head>
      <style type="text/css" title="x-apple-mail-formatting"></style>
      <meta name="viewport" content="width = 375, initial-scale = -1">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="UTF-8">
      <title>PassPatch</title>
      <style>
         /* -------------------------------------
         RESPONSIVENESS
         !importants in here are necessary :/
         ------------------------------------- */
         @media only screen and (max-device-width: 700px) {
         .table-wrapper {
         margin-top: 0px !important;
         border-radius: 0px !important;
         }
         .header {
         border-radius: 0px !important;
         }
         }
      </style>
   </head>
   <body style="-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-size:100%;line-height:1.6">
      <table style=" background: #F5F6F7;" width="100%" cellpadding="0" cellspacing="0">
         <tbody>
            <tr>
               <td>
                  <!-- body -->
                  <table cellpadding="0" cellspacing="0" class="table-wrapper" style="margin:auto;margin-top:50px;border-radius:7px;-webkit-border-radius:7px;-moz-border-radius:7px;max-width:700px !important;box-shadow:0 8px 20px #e3e7ea !important;-webkit-box-shadow:0 8px 20px #e3e7ea !important;-moz-box-shadow:0 8px 20px #e3e7ea !important;box-shadow: 0 8px 20px #e3e7ea !important; -webkit-box-shadow: 0 8px 20px #e3e7ea !important; -moz-box-shadow: 0 8px 20px #e3e7ea !important;">
                     <tbody>
                        <tr>
                           <!-- Brand Header -->
                           <td class="container"style="display:block !important;margin:0 auto !important;clear:both !important;text-align: center;background-image: linear-gradient(#172645, #364057, #172645bd);">
                              <!--  <img src="" style="max-width:100%"> -->
                              <img style="color: #fff; margin-left:auto;margin-right: auto; width:22%; margin-top:10px;margin-bottom:10px"  src="<?= base_url('/assets/')?>watch.png"><br>
                              <img style="color: #fff; margin-left:auto;margin-right: auto; width:22%; margin-top:10px;margin-bottom:10px"  src="<?= base_url('/assets/')?>logo.png">
                           </td>
                        </tr>
                        <tr>
                           <td class="container content" bgcolor="#FFFFFF" style="padding:35px 40px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;display:block !important;margin:0 auto !important;clear:both !important">
                              <!-- content -->
                              <div class="content-box" style="max-width:600px;margin:0 auto;display:block">                                
                                 <h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:22px;font-weight:bold;margin-bottom:30px">Hi <?php echo (!empty($profile_name))?$profile_name:""; ?>,</h1>
                                 <h1 style="font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px">New Device Registered</h1>
                               <center>  <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:18px;color:#47505E text-align:center;  "></p>

                                 <table>
                                    <tr>
                                       <td>Name :</td>
                                       <td><?= !empty($member_name)?$member_name:"" ?></td>
                                    </tr>
                                    <tr>
                                       <td>MAC ID :</td>
                                       <td><?= !empty($device_mac_id)?$device_mac_id:"" ?></td>
                                    </tr>
                                    <tr>
                                       <td>Device ID:</td>
                                       <td><?= !empty($device_id)?$device_id:"" ?></td>
                                    </tr>
                                 </table>
                                 
                               </center>
                                 
                                 <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">Cheers,<br>
                                    The PassPatch Team
                                 </p>
                                 <!-- Auto-generated JSON-ld compliant JSON for showing action buttons in emails -->
                              </div>
                              <!-- /content -->
                           </td>
                           <td>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!-- /body -->
                  <div class="footer" style="padding-top:30px;padding-bottom:55px;width:100%;text-align:center;clear:both !important">
                     <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:12px;color:#666;margin-top:0px">© <?php echo date('Y'); ?> PassPatch</p>
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>