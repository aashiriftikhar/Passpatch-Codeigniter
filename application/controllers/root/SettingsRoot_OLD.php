<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Administrative Management class created by CodexWorld
 */
class SettingsRoot extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('RootModel');    
        $this->load->model('ClientModel');    
        $this->load->helper('url');
        $this->load->helper('root');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        $this->load->library('root_init_element');
        $this->root_init_element->init_elements();  
        $this->root_init_element->is_root_loggedin();

        

        $this->layout = 'root/layout';
        $this->layoutLogin = 'root/layout-login';

        $this->controller = 'root/setting/';        
        
        //per page data limit
        $this->perPage = 3;

    } 
   
    public function index(){		
        $data['listURL'] = base_url();
        $data['action'] = 'Setting';
        $this->data['maincontent'] = $this->load->view('root/settings', $data, true);
        $this->load->view($this->layout, $this->data);
    }

	

}