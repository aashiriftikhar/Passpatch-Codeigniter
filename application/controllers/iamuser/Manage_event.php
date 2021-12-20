<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manage_event extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('client_init_elements');
		$this->client_init_elements->init_elements();	
        $this->client_init_elements->is_client_loggedin();

        $this->load->model('EventModel');  
        $this->load->helper('url');        
        $this->load->library('form_validation');
        $this->load->library('pagination');

        //default layout
        $this->layout = 'iamuser/layout';
		
		//default controller
		$this->controller = 'iamuser/manage_event';
		
		$this->uploadDir = 'uploads/event_image/';
 
		
		//per page data limit
		$this->perPage = 10;
	}


    public function index(){
        $data = array();

        $EventData = array();
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
        $totalRec = $this->EventModel->getRows($conditions);
        
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
        $conditions['conditions'] = array('tbl_event.client_id'=>$client_id);
        $data['EventDataList'] = $this->EventModel->getEventWithId($client_id);
        // echo "<pre>";
        // print_r($data['EventDataList']);
        // exit;


        
        $data['EventData'] = $EventData;   
        $data['ClientMACIdData'] = $this->EventModel->getData('tbl_devices',array('client_id'=>$client_id));
        $data['TimeZoneList'] = $this->EventModel->getData('tbl_timezone',array());
        $data['GroupsData'] = $this->EventModel->getData('tbl_groups',array());
        //define some useful variables for view
        $data['listURL'] = base_url().$this->controller;
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}/event';        
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}/event';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        
        //load users list view

        $this->data['maincontent'] = $this->load->view('iamuser/manage_event/index', $data, true);
        $this->load->view($this->layout, $this->data);
    }


	public function add(){

        $data = array();

        $EventData = array();
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


         //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');          
            $this->form_validation->set_rules('location', 'Location', 'required|trim');          
            $this->form_validation->set_rules('description', 'Description', 'required|trim');          
            $this->form_validation->set_rules('group', 'Group', 'required|trim');                 
            
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');          
            $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');          
            $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');          
            $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');          
            $this->form_validation->set_rules('time_zone', 'Time Zone', 'required|trim');       
            $this->form_validation->set_rules('assigning[0]', 'Assign device', 'required');          
            

            
            $post =  $this->security->xss_clean($this->input->post());  
            // $EventData = array(
            // 	'client_id' => $client_id,
            //     'event_name' => $post['event_name'],                
            //     'description' => $post['description'],                
            //     'location' => $post['location'],                
            //     'group_id' => $post['group'],                
            //     'from_device_id' => $post['from_device_id'],                
            //     'to_device_id' => $post['to_device_id'],                                             
            //     'start_date' => date("Y-m-d", strtotime($post['start_date'])),
            //     'end_date' => date("Y-m-d", strtotime($post['end_date'])),                
            //     'start_time' => date("H:i", strtotime($post['start_time'])),                
            //     'end_time' => date("H:i", strtotime($post['end_time'])),                
            //     'time_zone' => $post['time_zone']
            // );
            


            // print_r($EventData);
            // exit();
            if($this->form_validation->run() == true){   
                $EventData = array();
            $count = 0;

            foreach($this->input->post('assigning') as $s){
                $EventData[$count] = array(
                    'client_id' => $client_id,                
                    'event_name' => $post['event_name'],                
                    'description' => $post['description'],                
                    'location' => $post['location'],                
                    'group_id' => $post['group'],                
                    'from_device_id' => $s,                
                    'to_device_id' => $s,                                             
                    'start_date' => date("Y-m-d", strtotime($post['start_date'])),
                    'end_date' => date("Y-m-d", strtotime($post['end_date'])),                
                    'start_time' => date("H:i", strtotime($post['start_time'])),                
                    'end_time' => date("H:i", strtotime($post['end_time'])),                
                    'time_zone' => $post['time_zone']
                ); 
                ++$count;
            }
                $insert_ID = $this->db->insert_batch('tbl_event', $EventData); 
                if($insert_ID){
                    $this->session->set_userdata('success_msg', 'Event has been added successfully.');
                    redirect($this->controller);

                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }



        $data['EventData'] = $EventData;   
        $data['ClientMACIdData'] = $this->EventModel->getDevicesNotAssigned($client_id);
        
        $data['TimeZoneList'] = $this->EventModel->getData('tbl_timezone',array());
        $data['GroupsData'] = $this->EventModel->getData('tbl_groups',array('client_id'=>$client_id));
        //define some useful variables for view
        $data['listURL'] = base_url().$this->controller;
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';
        $data['detailsURL'] = base_url().$this->controller.'/details/{ID}';
        $data['blockURL'] = base_url().$this->controller.'/block/{ID}';
        $data['unblockURL'] = base_url().$this->controller.'/unblock/{ID}';
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        $data['action'] = 'Add';
        $data['action_btn'] = 'Submit';
        
       

        //load the view
        $this->data['maincontent'] = $this->load->view('iamuser/manage_event/add-edit-event', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }


    public function edit($id,$redirect=''){

        $data = array();
        //get user data by id
        $id=base64_decode($id);  

        $EventData = $this->EventModel->getRows(array('id'=>$id));


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


         //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules            
            $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');          
            $this->form_validation->set_rules('location', 'Location', 'required|trim');          
            $this->form_validation->set_rules('description', 'Description', 'required|trim');          
            $this->form_validation->set_rules('group', 'Group', 'required|trim');          
            $this->form_validation->set_rules('from_device_id', 'Device Id', 'required|trim');          
            $this->form_validation->set_rules('to_device_id', 'Device Id', 'required|trim');          
            
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');          
            $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');          
            $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');          
            $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');          
            $this->form_validation->set_rules('time_zone', 'Time Zone', 'required|trim');          
            

            
            $post =  $this->security->xss_clean($this->input->post());  
            $EventData = array(
                'event_name' => $post['event_name'],                
                'description' => $post['description'],                
                'location' => $post['location'],                
                'group_id' => $post['group'],                
                'from_device_id' => $EventData['from_device_id'],                
                'to_device_id' => $EventData['to_device_id'],                                             
                'start_date' => date("Y-m-d", strtotime($post['start_date'])),
                'end_date' => date("Y-m-d", strtotime($post['end_date'])),                
                'start_time' => date("H:i", strtotime($post['start_time'])),                
                'end_time' => date("H:i", strtotime($post['end_time'])),                
                'time_zone' => $post['time_zone']
            );      



  


            if($this->form_validation->run() == true){     
                $update = $this->EventModel->update($EventData, array('id'=>$id));
                if($update){


                    if ($redirect=='event') 
                    {
                        $this->session->set_userdata('success_msg', 'Event has been updated successfully.');
                        redirect($this->controller);
                        
                    }elseif ($redirect=='home') {
                        $this->session->set_userdata('success_msg', 'Event has been updated successfully.');
                        redirect('iamuser/Home');
                    }else{
                        $this->session->set_userdata('success_msg', 'Event has been updated successfully.');
                        redirect('iamuser/Home');
                    }                    

                }else{

                    if ($redirect=='home') {
                    $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
                        redirect('iamuser/Home');
                    }                    
                    else
                    {                        
                        $data['error_msg'] = 'Some problems occurred, please try again.';
                        
                    }
                }
            }       
        }



        $client_id = $this->session->userdata('ClientId');
        $data['EventData'] = $EventData;   
        $data['ClientMACIdData'] = $this->EventModel->getDevicesNotAssigned($client_id);
        $data['GroupsData'] = $this->EventModel->getData('tbl_groups',array('client_id'=>$client_id));
        //define some useful variables for view

        if ($redirect=='event') 
        {           
            $data['listURL'] = base_url().$this->controller;
            
        }elseif ($redirect=='home') {
            $data['listURL'] = base_url().'iamuser/Home';
        }else{
            $data['listURL'] = base_url().'iamuser/Home';
        }  
        
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';
        $data['detailsURL'] = base_url().$this->controller.'/details/{ID}';
        $data['blockURL'] = base_url().$this->controller.'/block/{ID}';
        $data['unblockURL'] = base_url().$this->controller.'/unblock/{ID}';
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        $data['action'] = 'Edit';
        $data['action_btn'] = 'Update';
        
       
        $data['TimeZoneList'] = $this->EventModel->getData('tbl_timezone',array());

        //load the view
        $this->data['maincontent'] = $this->load->view('iamuser/manage_event/add-edit-event', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

 

    public function delete($id,$redirect=''){
        
        if($id){
            $id=base64_decode($id);
            $userData = $this->EventModel->getRows(array('id'=>$id));
            $delete = $this->EventModel->delete($id);

            if($delete){
                if ($redirect=='event') 
                {
                    $this->session->set_userdata('success_msg', 'Event has been removed successfully.');
                    redirect($this->controller);
                    
                }elseif ($redirect=='home') {
                    $this->session->set_userdata('success_msg', 'Event has been removed successfully.');
                    redirect('iamuser/Home');
                }else{
                    $this->session->set_userdata('success_msg', 'Event has been removed successfully.');
                    redirect('iamuser/Home');
                }
                
            }else{

                if ($redirect=='event') 
                {
                    $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
                    redirect($this->controller);
                    
                }elseif ($redirect=='home') {
                    $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
                    redirect('iamuser/Home');
                }else{
                    $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
                    redirect('iamuser/Home');
                }
                
            }
        }
        
    }
}
