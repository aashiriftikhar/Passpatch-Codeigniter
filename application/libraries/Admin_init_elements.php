<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
 * Admin_init_elements separate view by elements
 */
class Admin_init_elements {

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
	 * Check Admin login status
	 */
    function is_Admin_loggedin() {
        if (!$this->CI->session->userdata('isAdminLoggedIn') && $this->CI->session->userdata('AdminId') == '') {
            redirect('Admin/login');
        }
    }
	
	/*
	 * Head view
	 */
    function init_head() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['head'] = $this->CI->load->view('Admin/elements/head', $data, true);
    }
    
	/*
	 * Header view
	 */
    function init_header() {
        $data = array();
		$AdminSessName = $this->CI->session->userdata('AdminFirstName').' '.$this->CI->session->userdata('AdminLastName');
		$AdminSessPic = $this->CI->session->userdata('AdminPicture');
        $AdminPic = !empty($AdminSessPic)?$this->CI->config->item('upload_url').'profile_picture/thumb/'.$AdminSessPic:$this->CI->config->item('public_url').'Admin/images/Admin-profile-pic.png';
        $data['userSessPic'] = $AdminPic;
        $data['userSessName'] = $AdminSessName;
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['header'] = $this->CI->load->view('Admin/elements/header', $data, true);
    }
    
	/*
	 * Header left navigation bar view
	 */
    function init_navigation() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['navigation_sidebar'] = $this->CI->load->view('Admin/elements/navigation-sidebar', $data, true);
    }
	
	/*
	 * Footer view
	 */
    function init_footer() {
        $data = array();
        $this->CI->data['footer'] = $this->CI->load->view('Admin/elements/footer', $data, true);
    }

}
