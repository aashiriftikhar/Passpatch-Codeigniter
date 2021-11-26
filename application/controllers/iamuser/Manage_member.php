<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manage_member extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('client_init_elements');
		$this->client_init_elements->init_elements();	
        $this->client_init_elements->is_client_loggedin();

        $this->load->model('MemberModel');	
        $this->load->helper('url');        
        $this->load->library('form_validation');
        $this->load->library('pagination');

        //default layout
        $this->layout = 'iamuser/layout';
		
		//default controller
		$this->controller = 'iamuser/manage_member';
		
		//default upload dir
		// $this->uploadDir = 'uploads/customer_files/';
		
		//per page data limit
		$this->perPage = 3;
	}

	public function index(){
        $data = array();
        $MemberData = array();
         $client_id = $this->session->userdata('ClientId');
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
        $conditions['conditions'] = array('tbl_members.client_id'=>$client_id);
        $totalRec = $this->MemberModel->getRows($conditions);
        
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
        $conditions['conditions'] = array('tbl_members.client_id'=>$client_id);
        $data['MemberDataList'] = $this->MemberModel->getRows($conditions);
        // echo "<pre>";
        // print_r($data['MemberDataList']);
        // exit;



        //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('member_name', 'Name', 'required|trim');          
            $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim');          
            //$this->form_validation->set_rules('floor_number', 'Floor Number', 'required|trim');
			$this->form_validation->set_rules('floor_number', 'Floor Number');			
            //$this->form_validation->set_rules('building_number', 'Building Number', 'required|trim');
            $this->form_validation->set_rules('building_number', 'Building Number');
			$this->form_validation->set_rules('device_mac_id', 'Device MAC Id', 'required|trim');          
            $this->form_validation->set_rules('event', 'Event', 'required|trim');          
            $this->form_validation->set_rules('status', 'Status', 'required|trim');    

            
            $post =  $this->security->xss_clean($this->input->post());  
            $MemberData = array(
                'client_id' => $client_id,
                'member_name' => $post['member_name'],
                'room_number' => $post['room_number'],
                'floor_number' => $post['floor_number'],
                'building_number' => $post['building_number'],
                'device_mac_id' => $post['device_mac_id'],
                'event_id' => $post['event'],                
                'status' => $post['status']
            );       

            if($this->form_validation->run() == true){     
                $insert_ID = $this->MemberModel->insert($MemberData);
                if($insert_ID){
                    $this->session->set_userdata('success_msg', 'Member has been added successfully.');
                    redirect($this->controller);

                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }



        $client_id = $this->session->userdata('ClientId');
        $data['ClientMACIdData'] = $this->MemberModel->getData('tbl_devices',array('client_id'=>$client_id));
        $data['EventData'] = $this->MemberModel->getData('tbl_event',array('client_id'=>$client_id));
        //define some useful variables for view
        $data['MemberData'] = $MemberData;  
        $data['listURL'] = base_url().$this->controller;
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';
        $data['detailsURL'] = base_url().$this->controller.'/details/{ID}';
        $data['blockURL'] = base_url().$this->controller.'/block/{ID}';
        $data['unblockURL'] = base_url().$this->controller.'/unblock/{ID}';
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        
        //load users list view

        $this->data['maincontent'] = $this->load->view('iamuser/manage_member/index', $data, true);
        $this->load->view($this->layout, $this->data);
    }

	public function add(){

		$client_id = $this->session->userdata('ClientId');

        $data = array();
        $MemberData = array();        
        
        
        //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('member_name', 'Name', 'required|trim');          
            $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim');          
            $this->form_validation->set_rules('floor_number', 'Floor Number', 'required|trim');          
            $this->form_validation->set_rules('building_number', 'Building Number', 'required|trim');
            $this->form_validation->set_rules('device_mac_id', 'Device MAC Id', 'required|trim');          
            $this->form_validation->set_rules('event', 'Event', 'required|trim');          
            $this->form_validation->set_rules('status', 'Status', 'required|trim');    

            
            $post =  $this->security->xss_clean($this->input->post());  
            $MemberData = array(
                'client_id' => $client_id,
                'member_name' => $post['member_name'],
                'room_number' => $post['room_number'],
                'floor_number' => $post['floor_number'],
                'building_number' => $post['building_number'],
                'device_mac_id' => $post['device_mac_id'],
                'event_id' => $post['event'],                
                'status' => $post['status']
            );       

            if($this->form_validation->run() == true){     
                $insert_ID = $this->MemberModel->insert($MemberData);
                if($insert_ID){
                    $this->session->set_userdata('success_msg', 'Member has been added successfully.');
                    redirect($this->controller);

                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }else{
            	redirect($this->controller,'refresh');
            }
        }

        $data['listURL'] = base_url().$this->controller.'/index/';
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';        
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        
        //define some useful variables for view
        $data['MemberData'] = $MemberData;        
        $data['ClientMACIdData'] = $this->MemberModel->getData('tbl_devices',array('client_id'=>$client_id));
        $data['EventData'] = $this->MemberModel->getData('tbl_event',array());
        $data['listURL'] = base_url().$this->controller;
        $data['action'] = 'Add';
        $data['action_btn'] = 'Add';
        //load the view
        $this->data['maincontent'] = $this->load->view('iamuser/manage_member/index', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

    public function edit($id){
        $data = array();
        //get user data by id
        $id=base64_decode($id);

        $MemberData = $this->MemberModel->getRows(array('id'=>$id));

        $client_id = $this->session->userdata('ClientId');

        
        
        
        //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('member_name', 'Name', 'required|trim');          
            $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim');          
            $this->form_validation->set_rules('floor_number', 'Floor Number', 'required|trim');          
            $this->form_validation->set_rules('building_number', 'Building Number', 'required|trim');
            $this->form_validation->set_rules('device_mac_id', 'Device MAC Id', 'trim');          
            $this->form_validation->set_rules('event', 'Event', 'trim');          
            $this->form_validation->set_rules('status', 'Status', 'required|trim');    

            
            $post =  $this->security->xss_clean($this->input->post());  

            $MemberData = array(
                'client_id' => $client_id,
                'member_name' => $post['member_name'],
                'room_number' => $post['room_number'],
                'floor_number' => $post['floor_number'],
                'building_number' => $post['building_number'],
                'status' => $post['status']
            );      

            if ($this->input->post('device_mac_id')) {                
                $MemberData['device_mac_id'] =  $post['device_mac_id'];
            }

            if ($this->input->post('event')) {                
                $MemberData['event_id'] =  $post['event'];
            }

                    
            if($this->form_validation->run() == true){     
                $update = $this->MemberModel->update($MemberData, array('id'=>$id));
                if($update){
                    $this->session->set_userdata('success_msg', 'Member has been updated successfully.');
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
        $data['MemberData'] = $MemberData;   
        $data['ClientMACIdData'] = $this->MemberModel->getData('tbl_devices',array('client_id'=>$client_id));
        $data['EventData'] = $this->MemberModel->getData('tbl_event',array());
        $data['listURL'] = base_url().$this->controller;
        $data['action'] = 'Edit';
        $data['action_btn'] = 'Update';
        //load the view
        $this->data['maincontent'] = $this->load->view('iamuser/manage_member/edit-member', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

    public function delete($id){
        
        if($id){
            $id=base64_decode($id);
            $userData = $this->MemberModel->getRows(array('id'=>$id));
            $delete = $this->MemberModel->delete($id);

            if($delete){
                $this->session->set_userdata('success_msg', 'Member has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect($this->controller);
    }	

}

?>