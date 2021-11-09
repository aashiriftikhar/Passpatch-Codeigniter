<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
 * Client_init_elements separate view by elements
 */
class Client_init_elements {

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
	 * Check Client login status
	 */
    function is_client_loggedin() {
        if (!$this->CI->session->userdata('isClientLoggedIn') && $this->CI->session->userdata('ClientId') == '') {
            redirect('Auth');
        }
    }
	
	/*
	 * Head view
	 */
    function init_head() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['head'] = $this->CI->load->view('iamuser/elements/head', $data, true);
    }
    
	/*
	 * Header view
	 */
    function init_header() {
        $data = array();
		$ClientProfileName = $this->CI->session->userdata('ClientProfileName');
		$ClientSessPic = $this->CI->session->userdata('ClientPicture');
        $ClientPic = !empty($ClientSessPic)?$this->CI->config->item('upload_url').'profile_picture/thumb/'.$ClientSessPic:$this->CI->config->item('public_url').'iamuser/images/Client-profile-pic.png';
        $data['userSessPic'] = $ClientPic;
        $data['ClientProfileName'] = $ClientProfileName;
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['header'] = $this->CI->load->view('iamuser/elements/header', $data, true);
    }
    
	/*
	 * Header left navigation bar view
	 */
    function init_navigation() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['navigation_sidebar'] = $this->CI->load->view('iamuser/elements/navigation-sidebar', $data, true);
    }
	
	/*
	 * Footer view
	 */
    function init_footer() {
        $data = array();
        $this->CI->data['footer'] = $this->CI->load->view('iamuser/elements/footer', $data, true);
    }

}
