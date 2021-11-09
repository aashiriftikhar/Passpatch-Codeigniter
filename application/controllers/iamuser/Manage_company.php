<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manage_company extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('client_init_elements');
		$this->client_init_elements->init_elements();	
        $this->client_init_elements->is_client_loggedin();

         $this->load->library('form_validation');
		$this->load->library('pagination');

        //default layout
        $this->layout = 'iamuser/layout';
		
		//default controller
		$this->controller = 'iamuser/manage_company';
		
		//default upload dir
		// $this->uploadDir = 'uploads/customer_files/';
		
		//per page data limit
		$this->perPage = 10;
	}

	public function index(){

		$data = array();
		// $searchKeyword = '';
		
		//get messages from the session
		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}
		
		//if search request is submitted
		if($this->input->post('submitSearch')){
			$inputKeywords = $this->input->post('userSearchKeyword');
			$searchKeyword = strip_tags($inputKeywords);
			if(!empty($searchKeyword)){
				$this->session->set_userdata('userSearchKeyword',$searchKeyword);
			}else{
				$this->session->unset_userdata('userSearchKeyword');
			}
		}elseif($this->input->post('submitSearchReset')){
			$this->session->unset_userdata('userSearchKeyword');
		}


        //get total rows count of the users
		$conditions['searchKeyword'] = $this->session->userdata('userSearchKeyword');
		// $conditions['conditions']['is_deleted'] = '0';
		$conditions['returnType'] = 'count';
		$totalRec = "";
		
		//pagination config
		$config['first_link']  = 'First';
		$config['base_url']    = base_url().$this->controller.'/index/';
		$config['uri_segment'] = 4;
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		
		//styling
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="javascript:void(0);" class="active">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li class="pg-next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pg-prev">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = $this->uri->segment(4);
		$offset = !$page?0:$page;
		
		//get rows of the users
		$conditions['returnType'] = '';
		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;
		$data['users'] = "";
		// echo "<pre>";
		// print_r($data['users']);
		// exit;


		//define some useful variables for view
		$data['listURL'] = base_url().$this->controller;
		$data['addURL'] = base_url().$this->controller.'/add';
		$data['editURL'] = base_url().$this->controller.'/edit/{ID}';
		$data['detailsURL'] = base_url().$this->controller.'/details/{ID}';
		$data['blockURL'] = base_url().$this->controller.'/block/{ID}';
		$data['unblockURL'] = base_url().$this->controller.'/unblock/{ID}';
		$data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
		$data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
		
		//load users list view


        $this->data['maincontent'] = $this->load->view('iamuser/manage_company/index', $data, true);
        $this->load->view($this->layout, $this->data);
	}

	public function add(){
		$data['listURL'] = base_url().$this->controller;
		$data['action'] = 'Add';
        //load the view
        $this->data['maincontent'] = $this->load->view('iamuser/manage_company/add-edit-company', $data, true);
        $this->load->view($this->layout, $this->data);
	}
}

?>