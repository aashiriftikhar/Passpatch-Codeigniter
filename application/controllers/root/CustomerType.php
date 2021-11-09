<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class CustomerType extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('root_init_element');
        $this->root_init_element->init_elements();
        $this->root_init_element->is_root_loggedin();

        $this->load->model('CustomerTypeModel');	
        $this->load->helper('url');        
        $this->load->library('form_validation');
        $this->load->library('pagination');
		  
        

        $this->layout = 'root/layout';
        $this->layoutLogin = 'root/layout-login';

        //default controller
        $this->controller = 'root/CustomerType';
        
        
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
        $totalRec = $this->CustomerTypeModel->getRows($conditions);
        
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
        $data['CustomerTypeList'] = $this->CustomerTypeModel->getRows($conditions);
        // echo "<pre>";
        // print_r($data['CustomerTypeList']);
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

        $this->data['maincontent'] = $this->load->view('root/CustomerType/index', $data, true);
        $this->load->view($this->layout, $this->data);
    }

	public function add(){

        $data = array();
        $CustomerTypeData = array();        
        
        //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('name', 'Name', 'required|trim');          
            
            $post =  $this->security->xss_clean($this->input->post());  
            $CustomerTypeData = array(
                'name' => $post['name']
            );            
            if($this->form_validation->run() == true){     
                $insert_ID = $this->CustomerTypeModel->insert($CustomerTypeData);
                if($insert_ID){
                    $this->session->set_userdata('success_msg', 'Customer Type has been added successfully.');
                    redirect($this->controller);

                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }          
        }

        $data['listURL'] = base_url().$this->controller.'/index/';
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';        
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        
        //define some useful variables for view
        $data['CustomerTypeData'] = $CustomerTypeData;        
        $data['listURL'] = base_url().$this->controller;
        $data['action'] = 'Add';
        $data['action_btn'] = 'Add';
        //load the view
        $this->data['maincontent'] = $this->load->view('root/CustomerType/add-edit-customerType', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

    public function edit($id){
        $data = array();
        //get user data by id
        $id=base64_decode($id);

        $CustomerTypeData = $this->CustomerTypeModel->getRows(array('id'=>$id));
        
        //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('name', 'Name', 'required|trim');          
            
            $post =  $this->security->xss_clean($this->input->post());  
            $CustomerTypeData = array(
                'name' => $post['name']
            );            
            if($this->form_validation->run() == true){     
                $update = $this->CustomerTypeModel->update($CustomerTypeData, array('id'=>$id));
                if($update){
                    $this->session->set_userdata('success_msg', 'Customer Type has been updated successfully.');
                    redirect($this->controller);

                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }          
        }

        $data['listURL'] = base_url().$this->controller.'/index/';
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';        
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');

        
        //define some useful variables for view
        $data['CustomerTypeData'] = $CustomerTypeData;   
        $data['listURL'] = base_url().$this->controller;
        $data['action'] = 'Edit';
        $data['action_btn'] = 'Update';
        //load the view
        $this->data['maincontent'] = $this->load->view('root/CustomerType/add-edit-customerType', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

    public function delete($id){
        
        if($id){
            $id=base64_decode($id);
            $userData = $this->CustomerTypeModel->getRows(array('id'=>$id));
            $delete = $this->CustomerTypeModel->delete($id);

            if($delete){
                $this->session->set_userdata('success_msg', 'Customer Type has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect($this->controller);
    }
}

?>