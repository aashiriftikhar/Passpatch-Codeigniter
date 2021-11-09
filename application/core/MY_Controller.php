<?php 

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    const INVALID_VERIFICATION_CODE = "Invalid verification code";
    const INVALID_CREDENTIALS       = "Invalid email address or password";
    const REGISTRATION_COMPLETED    = "Registration Completed.";
    const USER_CREATE_SUCCESS       = "We have sent a verification code to your email address please verify.";    
    const FORGET_PASSWORD_SENT      = "We have sent reset password link in your registered email address.";    

    const AUTHFAIL                  = "Your session has expired. Please log in again.";

    const DATA_UPDATE_SUCCESS       = "Data updated successfully.";
    
    //API
	const INVALID_API_KEY           = "Invalid API Key";    
    const WENTWRONG                 = "Something went wrong";
    const INVALID_MAC_ID            = "Invalid MAC ID OR MAC ID Not Assigned ";
    const DATA_STORED               = "Data Store Successfully";
    const NOTIF_LIST_GOT            = "Notification List Get Successfully";
    const DEVICE_CONNECTED          = "Device Connected Successfully";
    const LOGOUT                    = "Logout Successfully";

}

class Admin_Controller extends MY_Controller 
{
	var $permission = array();

	public function __construct() 
	{
		parent::__construct();

		$group_data = array();
		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}
		else {
			$user_id = $this->session->userdata('id');
			$this->load->model('model_groups');
			$group_data = $this->model_groups->getUserGroupByUserId($user_id);
			
			$this->data['user_permission'] = unserialize($group_data['permission']);
			$this->permission = unserialize($group_data['permission']);
		}
	}

	public function logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == TRUE) {
			redirect('dashboard', 'refresh');
		}
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/header_menu',$data);
		$this->load->view('templates/side_menubar',$data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer',$data);
	}
	
}