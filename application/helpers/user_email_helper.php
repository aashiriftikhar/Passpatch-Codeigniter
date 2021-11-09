<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Reset new password email sender function
 */
if(! function_exists('forgotPassEmailAdmin')){

	function forgotPassEmailAdmin($userEmail){
        $ci =& get_instance();
		$ci->load->model('settings');
		$ci->load->library('email');
		
		$siteSettings = $ci->settings->getRow();

		$linkPart = 'admin/administrative/resetPassword/';
		
		$ci->load->model('admin_user');
        $con['returnType'] = 'single';
        $con['conditions'] = array(
            'email' => $userEmail
        );
        $user = $ci->admin_user->getRows($con);
        $resetPassLink = base_url().$linkPart.$user['forgot_pass_identity'];
        $mailContent = '<p>Dear <strong>'.$user['first_name'].'</strong>,</p>
        <p>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.</p>
        <p>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a></p>
        <p>Regards,<br/><strong>Team '.$siteSettings['name'].'</strong></p>';
		
		if($siteSettings['email_type'] == '2' && !empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_port']) && !empty($siteSettings['smtp_user']) && !empty($siteSettings['smtp_pass'])){
			$ci->email->set_mailtype("html");
			$ci->email->set_newline("\r\n");
			
			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => $siteSettings['smtp_host'],
				'smtp_port' => $siteSettings['smtp_port'],
				'smtp_user' => $siteSettings['smtp_user'],
				'smtp_pass' => $siteSettings['smtp_pass'],
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
			);
		}else{
			$config['mailtype'] = 'html';
		}
        $ci->email->initialize($config);
        $ci->email->to($user['email']);
        $ci->email->from($siteSettings['contact_email'], $siteSettings['name']);
        $ci->email->subject('Password Update Request | '.$siteSettings['name']);
        $ci->email->message($mailContent);
		$ci->email->send();
        return true;
    }
}

/*
 * Reset new password email sender function
 */
if(! function_exists('forgotPassEmail')){

	function forgotPassEmail($userEmail,$newPassword){
        $ci =& get_instance();
		$ci->load->model('settings');
		$ci->load->library('email');
		
		$siteSettings = $ci->settings->getRow();
		//var_dump($siteSettings);die;
		//$linkPart = 'shop/administrative/resetPassword/';
		
		$ci->load->model('customer');
        $con['returnType'] = 'single';
        $con['conditions'] = array(
            'email' => $userEmail
        );
        $user = $ci->customer->getRows($con);
        //var_dump($user);die;
        //$resetPassLink = base_url().$linkPart.$user['forgot_pass_identity'];
        $mailContent = '<p>Dear <strong>'.$user['name'].'</strong>,</p>
        <p>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.</p>
        <p>Your new password is: '.$newPassword.'</a></p>
        <p>Regards,<br/><strong>Team '.$siteSettings['name'].'</strong></p>';
		
		if($siteSettings['email_type'] == '2' && !empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_port']) && !empty($siteSettings['smtp_user']) && !empty($siteSettings['smtp_pass'])){
			$ci->email->set_mailtype("html");
			$ci->email->set_newline("\r\n");
			
			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'smtpout.secureserver.net',
				'smtp_port' => '465',
				'smtp_user' => 'order-update@mobiecart.com',
				'smtp_pass' => 'M0b1eCart',
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'smtp_crypto'=> 'ssl'
			);
		}else{
			$config['mailtype'] = 'html';
		}
        $ci->email->initialize($config);
        $ci->email->to($user['email']);
        $ci->email->from($siteSettings['contact_email'], $siteSettings['name']);
        $ci->email->subject('Forget Password Request | '.$siteSettings['name']);
        $ci->email->message($mailContent);
		$ci->email->send();
		//echo $ci->email->print_debugger();
        return true;
    }
}

/*
 * Add new gym email sender function
 */
if(! function_exists('addGymEmail')){
	
	function addGymEmail($userEmail,$password){
        $ci =& get_instance();
		$ci->load->model('settings');
		$ci->load->library('email');
		
		$siteSettings = $ci->settings->getRow();

		$linkPart = 'admin/administrative/resetPassword/';
		
		$ci->load->model('admin_user');
		$ci->load->model('store');
        $con['returnType'] = 'single';
        $con['conditions'] = array(
            'email_id' => $userEmail
        );
        //$user = $ci->admin_user->getRows($con);
        $gym=$ci->store->getRows($con);
        $resetPassLink = base_url().$linkPart.$user['forgot_pass_identity'];
        $gymLoginLink=base_url().'gym';

        $mailContent = '<p>Dear <strong>'.$gym['owner_name'].'</strong>,</p>
        <p>You have successfully registered on "Mobiecart". Below are handles to access your <b>'.$gym['full_name'].'</b> account.</p>
        <p>URL - '.$gymLoginLink.' <br> Email - '.$gym["email_id"].' <br/> Password - '.$password.' </p>
        
        <p>Thank You,<br/><strong>'.$siteSettings['name'].'</strong></p>';
		
		if($siteSettings['email_type'] == '2' && !empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_port']) && !empty($siteSettings['smtp_user']) && !empty($siteSettings['smtp_pass'])){
			$ci->email->set_mailtype("html");
			$ci->email->set_newline("\r\n");
			
			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => $siteSettings['smtp_host'],
				'smtp_port' => $siteSettings['smtp_port'],
				'smtp_user' => $siteSettings['smtp_user'],
				'smtp_pass' => $siteSettings['smtp_pass'],
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
			);
		}else{
			$config['mailtype'] = 'html';
		}
        $ci->email->initialize($config);
        $ci->email->to($gym['email_id']);
        $ci->email->from($siteSettings['contact_email'], $siteSettings['name']);
        $ci->email->subject('Shop Details | '.$siteSettings['name']);
        $ci->email->message($mailContent);
		$ci->email->send();
        return true;
    }
}

/*
 * Add new trainer email sender function
 */
if(! function_exists('addTrainerEmail')){
	
	function addTrainerEmail($userEmail,$password){
        $ci =& get_instance();
		$ci->load->model('settings');
		$ci->load->library('email');
		
		$siteSettings = $ci->settings->getRow();

		$linkPart = 'gym/administrative/resetPassword/';
		
		$ci->load->model('admin_user');
		$ci->load->model('gym');
		$ci->load->model('trainer');

        $con['returnType'] = 'single';
        $con['conditions'] = array(
            'email_id' => $userEmail
        );
        
        $gym = $ci->gym->getRows($con);
        $trainer=$ci->trainer->getRows($con);
        //$resetPassLink = base_url().$linkPart.$user['forgot_pass_identity'];
        $trainerLoginLink=base_url().'gym';

        $mailContent = '<p>Dear <strong>'.$trainer['first_name'].' '.$trainer['last_name'].'</strong>,</p>
        <p>You have successfully registered on <b>'.$gym['full_name'].'</b> as part of team. Below are handles to access your account.</p>
        <p>URL - '.$trainerLoginLink.' <br> Email - '.$trainer["email_id"].' <br/> Password - '.$password.' </p>
        
        <p>Thank You,<br/><strong>'.$gym['full_name'].'</strong></p>';
		
		if($siteSettings['email_type'] == '2' && !empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_port']) && !empty($siteSettings['smtp_user']) && !empty($siteSettings['smtp_pass'])){
			$ci->email->set_mailtype("html");
			$ci->email->set_newline("\r\n");
			
			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => $siteSettings['smtp_host'],
				'smtp_port' => $siteSettings['smtp_port'],
				'smtp_user' => $siteSettings['smtp_user'],
				'smtp_pass' => $siteSettings['smtp_pass'],
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
			);
		}else{
			$config['mailtype'] = 'html';
		}
        $ci->email->initialize($config);
        $ci->email->to($gym['email_id']);
        $ci->email->from($siteSettings['contact_email'], $siteSettings['name']);
        $ci->email->subject('Gym Details | '.$siteSettings['name']);
        $ci->email->message($mailContent);
		$ci->email->send();
        return true;
    }
}


if(! function_exists('sendInvoice')){
	
	function sendInvoice($userEmail,$userName,$orderId){
        $ci =& get_instance();
		$ci->load->model('settings');
		$ci->load->library('email');
		
		$siteSettings = $ci->settings->getRow();

		$linkPart = base_url().'welcome/Invoice/'.base64_encode($orderId);
		
		$ci->load->model('admin_user');
		


        $mailContent = '<p>Dear <strong>'.$userName.'</strong>,</p>
        <p>Thank you for shopping with us. We will send a confirmation when your items ship. Please download your invoice from below:-</p>
        <p> <a style="display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;color: #fff;background-color: #f39c12;border-color: #e08e0b;border-radius: 3px;border: 1px solid transparent;" href="'.$linkPart.'">Download Invoice</a></p>
                
         <p>Thank You,<br/><strong>'.$siteSettings['name'].'</strong></p>';
		
		if($siteSettings['email_type'] == '2' && !empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_port']) && !empty($siteSettings['smtp_user']) && !empty($siteSettings['smtp_pass'])){
			$ci->email->set_mailtype("html");
			$ci->email->set_newline("\r\n");
			
			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'smtpout.secureserver.net',
				'smtp_port' => '465',
				'smtp_user' => 'order-update@mobiecart.com',
				'smtp_pass' => 'M0b1eCart',
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'smtp_crypto'=> 'ssl'
			);
		}else{
			$config['mailtype'] = 'html';
		}
        $ci->email->initialize($config);
        $ci->email->to($userEmail);
        $ci->email->from('order-update@mobiecart.com', $siteSettings['name']);
        $ci->email->subject('Invoice | '.$siteSettings['name']);
        $ci->email->message($mailContent);
		$ci->email->send();
	    return true;
    }
}