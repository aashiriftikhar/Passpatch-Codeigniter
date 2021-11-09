<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
 * Root_init_element separate view by elements
 */
class Root_init_element {

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
	 * Check Root login status
	 */
    function is_Root_loggedin() {
        if (!$this->CI->session->userdata('isRootLoggedIn') && $this->CI->session->userdata('RootId') == '') {
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
        $this->CI->data['head'] = $this->CI->load->view('root/elements/head', $data, true);
    }
    
	/*
	 * Header view
	 */
    function init_header() {
        $data = array();
		$RootSessName = $this->CI->session->userdata('RootName');
		$RootSessPic = $this->CI->session->userdata('RootPicture');
        $RootPic = !empty($RootSessPic)?$this->CI->config->item('upload_url').'profile_picture/thumb/'.$RootSessPic:$this->CI->config->item('public_url').'admin/images/admin-profile-pic.png';
        $data['userSessPic'] = $RootPic;
        $data['userSessName'] = $RootSessName;
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['header'] = $this->CI->load->view('root/elements/header', $data, true);
    }
    
	/*
	 * Header left navigation bar view
	 */
    function init_navigation() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['navigation_sidebar'] = $this->CI->load->view('root/elements/navigation-sidebar', $data, true);
    }
	
	/*
	 * Footer view
	 */
    function init_footer() {
        $data = array();
        $this->CI->data['footer'] = $this->CI->load->view('root/elements/footer', $data, true);
    }

}
