<?php  defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/third_party/smtp/Send_Mail.php';

class Auth  extends CI_Controller {

	function __construct() {
        parent::__construct(); 		

        date_default_timezone_set('UTC');

        $this->load->library('auth_init_elements');
        $this->auth_init_elements->init_elements();	

        $this->load->model('RootModel');
        $this->load->model('ClientModel');

        $isRootLoggedIn = $this->session->userdata('isRootLoggedIn');
       
        $isClientLoggedIn = $this->session->userdata('isClientLoggedIn');

		if($isRootLoggedIn){
            $this->RootId = $this->session->userdata('RootId');
        }else{
            $this->RootId = '';
        }

        if($isClientLoggedIn){
            $this->ClientId = $this->session->userdata('ClientId');
        }else{
            $this->ClientId = '';
        }
        

        $this->layout = 'layout';
        $this->layoutLogin = 'layout-login';
    }
   
    public function index(){

	    if($this->RootId){
	        redirect('/root/home');
	    }elseif ($this->ClientId) {
            redirect('iamuser/Home/','refresh');
        }	        

        $this->data['maincontent'] = $this->load->view('home', array(), true);
        $this->load->view($this->layoutLogin, $this->data);
    }

    public function login(){	

    	if($this->RootId){
            redirect('/root/home');
        }elseif ($this->ClientId) {
            redirect('iamuser/Home/','refresh');
        }
		
		$data = array();      
        
		//get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if ($this->input->post('loginSubmit')) {

            if ($this->input->post('AccountType')=="RootUser") {

            	//form field validation rules
	            $this->form_validation->set_rules('username', 'username', 'required');
	            $this->form_validation->set_rules('password', 'password', 'required');
				
				//validate submitted form data
	            if ($this->form_validation->run() == true) {
					//check whether user exists in the database
					$username = $this->input->post('username');
					$password = $this->input->post('password');
	                $condition = array(
	                    'email' => $username,
	                    'status' => 'Active',
	                    'is_deleted' => '0'
	                   
	                );
	                $checkLogin = $this->RootModel->loginCheck($condition);
	                if($checkLogin && md5($password) == $checkLogin['password']){

						//set variables in session
	                    $sessData = array(
							'isRootLoggedIn' => TRUE,
							'RootId' => $checkLogin['id'],
							'RootFirstName' => $checkLogin['first_name'],
							'RootLastName' => $checkLogin['last_name'],
							'RootEmail' => $checkLogin['email'],
							'RootPicture' => $checkLogin['picture']
						);
	                    $this->session->set_userdata($sessData);
						//redirect to dashboard
	                    redirect('/root/Home');
	                }else{
	                    $data['error_msg'] = 'Wrong username or password, please try again.';
	                }
	            }
            }
            elseif($this->input->post('AccountType')=="IAMUser"){

                //form field validation rules
                $this->form_validation->set_rules('username', 'username', 'required');
                $this->form_validation->set_rules('password', 'password', 'required');
                
                //validate submitted form data
                if ($this->form_validation->run() == true) {
                    //check whether user exists in the database
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $condition = array(
                        'email' => $username                                          
                    );
                    $checkLogin = $this->ClientModel->loginCheck($condition);
                    if($checkLogin && md5($password) == $checkLogin['password']){

                        /* For Account Status*/
                        // if ($checkLogin['status']!="Active") {
                        // $data['error_msg'] = 'Your Account Status is Inactive';
                        // }else{
                            //set variables in session
                            $sessData = array(
                                'isClientLoggedIn' => TRUE,
                                'ClientId' => $checkLogin['id'],
                                'ClientProfileName' => $checkLogin['profile_name'],
                                'ClientContactName' => $checkLogin['contact_name'],
                                'ClientEmail' => $checkLogin['email'],
                                'ClientPicture' => $checkLogin['picture']
                            );
                            $this->session->set_userdata($sessData);
                            
                            //redirect to dashboard
                            redirect('iamuser/Home','refresh');
                        // }


                    }else{
                        $data['error_msg'] = 'Wrong username or password, please try again.';
                    }
                }    
                
            }
        }
        $this->data['maincontent'] = $this->load->view('login', $data, true);
        $this->load->view($this->layoutLogin, $this->data);
    }

    public function forgotPassword(){

        if($this->RootId){
            redirect('/root/home');
        }elseif ($this->ClientId) {
            redirect('iamuser/Home/','refresh');
        }
        
        $data = array();      
        
        //get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if ($this->input->post('forgotSubmit')) {
            //form field validation rules
            $this->form_validation->set_rules('username', 'username', 'required');            
            
            //validate submitted form data
            if ($this->form_validation->run() == true) {
                //check whether user exists in the database
                $email = $this->input->post('username');
                
                $condition = array(
                    'email' => $email
                );


                $checkLogin = $this->ClientModel->loginCheck($condition);


                if($checkLogin){
                    $password_token = md5(time().json_encode($data));
                    $to = $email;
                    $subject = 'Account Password';
                    //$from_email = 'noreply@temp.canopusinfosystemsportal.com';
                    $from_email = 'temp@passpatchllc.com';

                    $body = $this->load->view('emailTemplate/forgot-password-link', array('password_token'=>$password_token) , True);  

                    $mail = Send_Mail($to,$from_email,$body,$subject);
                    
                    
                    if($mail)
                    {
                        $this->ClientModel->update(array('password_token' => $password_token, 'is_password_link_valid' => date('Y-m-d H:i:s', strtotime(Vailid_time))), array('email'=>$email));

                                  
                        $data['success_msg'] = 'We have sent reset password link in your registered email address.';
                    }
                    else
                    {
                                  
                        $data['error_msg'] = 'Something went Wrong, please try again.';
                    } 
                }else{
                    $data['error_msg'] = 'Email not registered';
                }
            }    
        }


        $this->data['maincontent'] = $this->load->view('forgot-password', $data, true);
        $this->load->view($this->layoutLogin, $this->data);
    }

    public function resetPassword($password_token=''){

        $this->session->unset_userdata('isRootLoggedIn');
        $this->session->unset_userdata('RootId');
        $this->session->sess_destroy();
        
        $data = array();    
        $data['error_msg'] = "";
        $data['success_msg']="";  
        
        //get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

            if(!empty($password_token))
            {
                $checkLink = $this->ClientModel->getSingleData('tbl_clients',array("password_token"=>$password_token));        


                $response = "";
                if($checkLink['is_password_link_valid'] < date('Y-m-d H:i:s'))
                {
                    $param = array(                                     
                            "is_password_link_valid"   =>0  
                    );
                    $updatePassword = $this->ClientModel->update($param,array('password_token'=>$password_token,'is_password_link_valid'=>$checkLink['is_password_link_valid']));
                    $data['error_msg'] = "Session Expired";
                    $response = ($data['error_msg'])?$data['error_msg']:$data['success_msg'];       
                }
                if (!empty($checkLink) && $password_token !=='')
                {
                    if ($response)
                    {
                        $data['password_token'] = "";
                        $data['error_msg'] = "Session Expired";
                        $data['success_msg']="";
                        
                        
                    }
                    else
                    {
                        $post = $this->input->post();
                        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]',array("required"=>"Please enter password.","min_length"=>"Password length should be 8 digits."));
                        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]',array('matches'=>"Confirm password does not match.","required"=>"Please enter confirm password."));
                        if ($this->form_validation->run() == FALSE)
                        {   
                            $data['password_token'] = $password_token;
                                   
                        }
                        else
                        {
                            $param = array(
                                "password"   =>md5($post['password']),
                                "password_token" =>"",                     
                                "is_password_link_valid"   =>0                            
                            );
                            $updatePassword = $this->ClientModel->update($param,array('password_token'=>$password_token));
                            if ($updatePassword)
                            {
                                $data['password_token'] = "";
                                $data['success_msg']="Password has been reset successfully.";
                                $data['error_msg']="";
                                
                            }
                            else
                            {
                                $data['password_token'] = "";
                                $data['error_msg']="Something went wrong.";
                                $data['success_msg']="";
                                
                            }
                            
                        }
                    }
                }
                else
                {
                    $data['password_token']="";
                    $data['error_msg']="Link Expired";
                    $data['success_msg']="";
                    
                }
            }
            else
            {
                $data['password_token']="";
                $data['error_msg']="Invalid Link";
                $data['success_msg']="";
                
            }
        
        $this->data['maincontent'] = $this->load->view('reset-password', $data, true);
        $this->load->view($this->layoutLogin, $this->data);
    }


    public function logout(){		

		//remove session data
        $this->session->unset_userdata('isRootLoggedIn');
        $this->session->unset_userdata('RootId');
        $this->session->sess_destroy();
		//redirect to login page
        redirect('Auth/');
    }
}
