<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
 * Auth_init_elements separate view by elements
 */
class Auth_init_elements {

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
	 * Head view
	 */
    function init_head() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['head'] = $this->CI->load->view('elements/head', $data, true);
    }
    
	/*
	 * Header view
	 */
    function init_header() {
        $data = array();
		$AuthSessName = $this->CI->session->userdata('AuthFirstName').' '.$this->CI->session->userdata('AuthLastName');
		$AuthSessPic = $this->CI->session->userdata('AuthPicture');
        $AuthPic = !empty($AuthSessPic)?$this->CI->config->item('upload_url').'profile_picture/thumb/'.$AuthSessPic:$this->CI->config->item('public_url').'images/Auth-profile-pic.png';
        $data['userSessPic'] = $AuthPic;
        $data['userSessName'] = $AuthSessName;
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['header'] = $this->CI->load->view('elements/header', $data, true);
    }
    
	/*
	 * Header left navigation bar view
	 */
    function init_navigation() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['navigation_sidebar'] = $this->CI->load->view('elements/navigation-sidebar', $data, true);
    }
	
	/*
	 * Footer view
	 */
    function init_footer() {
        $data = array();
        $this->CI->data['footer'] = $this->CI->load->view('elements/footer', $data, true);
    }

}
