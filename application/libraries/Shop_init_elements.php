<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
 * Admin_init_elements separate view by elements
 */
class Shop_init_elements {

    var $CI;
    var $data;

    function __construct() {
        $this->CI = & get_instance();
    }
	
	/*
	 * Initialize elements
	 */
    function init_elements($args = array()) {
        $this->init_head();
        $this->init_header();
        $this->init_navigation();
        $this->init_footer();
    }
	
	/*
	 * Check admin login status
	 */
    function is_admin_loggedin() {
        if (!$this->CI->session->userdata('isAdminLoggedIn') && $this->CI->session->userdata('adminId') == '') {
            redirect('shop/login');
        }
    }
	
	/*
	 * Head view
	 */
    function init_head() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['head'] = $this->CI->load->view('shop/elements/head', $data, true);
    }
    
	/*
	 * Header view
	 */
    function init_header() {
        $data = array();
		$adminSessName = $this->CI->session->userdata('adminFirstName').' '.$this->CI->session->userdata('adminLastName');
		$adminSessPic = $this->CI->session->userdata('trainerPicture');
        $trainerId=$this->CI->session->userdata('trainerId');
        $gymName=$this->CI->session->userdata('gymName');
        $trainerPicture=$this->CI->session->userdata('trainerPicture');
        $adminFirstName=$this->CI->session->userdata('adminFirstName');
        $adminPic = !empty($adminSessPic)?$this->CI->config->item('upload_url').'trainer_profile_picture/thumb/'.$adminSessPic:$this->CI->config->item('public_url').'admin/images/admin-profile-pic.png';
        $data['userSessPic'] = $adminPic;
        $data['adminFirstName']=$adminFirstName;
        $data['userSessName'] = $adminSessName;        
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        if(!empty($trainerId)){
            $data['gymName']=$gymName;
        }else{
            $data['gymName']='';
        }
        $this->CI->data['header'] = $this->CI->load->view('shop/elements/header', $data, true);
    }
    
	/*
	 * Header left navigation bar view
	 */
    function init_navigation() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['navigation_sidebar'] = $this->CI->load->view('shop/elements/navigation-sidebar', $data, true);
    }
	
	/*
	 * Footer view
	 */
    function init_footer() {
        $data = array();
        $this->CI->data['footer'] = $this->CI->load->view('shop/elements/footer', $data, true);
    }

}
