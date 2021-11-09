<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
 * Company_init_element separate view by elements
 */
class Company_init_element {

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
	 * Check Company login status
	 */
    function is_company_loggedin() {
        if (!$this->CI->session->userdata('isCompanyLoggedIn') && $this->CI->session->userdata('CompanyId') == '') {
            redirect('superadmin/Login');
        }
    }
	
	/*
	 * Head view
	 */
    function init_head() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['head'] = $this->CI->load->view('superadmin/elements/head', $data, true);
    }
    
	/*
	 * Header view
	 */
    function init_header() {
        $data = array();
		$companySessName = $this->CI->session->userdata('companyName');
		$companySessPic = $this->CI->session->userdata('companyPicture');
        $companyPic = !empty($companySessPic)?$this->CI->config->item('upload_url').'profile_picture/thumb/'.$companySessPic:$this->CI->config->item('public_url').'admin/images/admin-profile-pic.png';
        $data['userSessPic'] = $companyPic;
        $data['userSessName'] = $companySessName;
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['header'] = $this->CI->load->view('superadmin/elements/header', $data, true);
    }
    
	/*
	 * Header left navigation bar view
	 */
    function init_navigation() {
        $data = array();
		$this->CI->load->model('settings');
        $data['siteSettings'] = $this->CI->settings->getRow();
        $this->CI->data['navigation_sidebar'] = $this->CI->load->view('superadmin/elements/navigation-sidebar', $data, true);
    }
	
	/*
	 * Footer view
	 */
    function init_footer() {
        $data = array();
        $this->CI->data['footer'] = $this->CI->load->view('superadmin/elements/footer', $data, true);
    }

}
