<?PHP
error_reporting(0);
class Notification {

    //put your code here
    // constructor
    function __construct() {
        
    }

    function sendAndroidNotification($registration_ids, $message,$title,$type='') {

       if (!is_array($registration_ids)) {
               $registration_ids =     array($registration_ids);       
       } 

       $res['title'] =$title;
       $res['is_background'] = TRUE;
       $res['body'] = $message;
       $res['content'] = $message;
       $res['type'] = $type;


       //$res['data']['payload'] = $payload;
       $res['timestamp'] = date('Y-m-d G:i:s');
        $message = array('data' => array('body' => $message, 'title' => "title this is"));
       //$message = array('notification' => array('message' => $message, 'title' => "Test"));

       $url = 'https://fcm.googleapis.com/fcm/send';
       $fields = array(
           'registration_ids' => $registration_ids,
           'notification' => $res,
       );
     
       $GOOGLE_API_KEY = "AAAAEYv2BZQ:APA91bEDp4JisPhJtfKgD_rUou2hjYGLzufg9XXJNfFWrCGeP_zwz2RXR-tp4RIU1iGBGblCF2B5PBpJ4jl-bscK_daQulBpaIcY6FZVdLvPvGPLqqBr9J2MtYWN7_qkckqEtkgV-Cv1";
       $headers = array(
           'Authorization:key=' . $GOOGLE_API_KEY,
           'Content-Type: application/json'
       );
      //echo json_encode($fields);
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

       $result = curl_exec($ch);
       if ($result === false)
           die('Curl failed ' . curl_error());

       curl_close($ch);
       $myfile = file_put_contents('notification_test.txt', $result . PHP_EOL, FILE_APPEND | LOCK_EX);

       // print_r($result);

       return $result;
   }


   

    function sendIOSNotification($registration_ids, $message,$type="meetup",$title="Default") {     
        //$registration_ids='ced735813512a292503630429a22eea18b28afab4b97563717304778c502afcb';
        if (!is_array($registration_ids)) {
               $registration_ids =     array($registration_ids);       
       }

        $pass ='123456';
        // Get the parameters from http get or from command line
        //$message = $_GET['message'] or $message = $argv[1] or $message = 'Message sent ' . @date("H:i:s d/M/Y", mktime());
        $badge = 1;
        $sound = 'default';
        // Construct the notification payload
        $body = array();
        $body['aps'] = array('alert' => $message);
        if ($badge)
            $body['aps']['badge'] = $badge;
        if ($sound)
            $body['aps']['sound'] = $sound;
        
        $body['aps']['type'] = $type;
     
        
        //$body['aps']['content-available'] = 1;
        /* End of Configurable Items */
        $ctx = stream_context_create();
        //  stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns_certificates.pem');
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushcert.pem');
        //stream_context_set_option($ctx, 'ssl', 'local_cert', 'doctorDevelopment.pem');
        // assume the private key passphase was removed.
        stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
        // $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
        if (!$fp) {
            
           $status =  "Failed to connect $err $errstr\n";

        } else {
          $status =  "Connection OK".$fp;
        }
        $payload = json_encode($body);
        foreach ($registration_ids as  $registration_ids) {         
        $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ','',$registration_ids)) . pack("n",strlen($payload)) . $payload;
        //return $msg;
        //print "sending message :" . $payload . "\n";
        // print_r($msg);
        fwrite($fp, $msg);
        fclose($fp);

        }
        // print "sending message :" . $payload . "\n";
        // echo "<br>";
    }




}

?>