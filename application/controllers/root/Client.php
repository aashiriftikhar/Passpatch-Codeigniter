<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Root Management class created by CodexWorld
 */

require_once APPPATH . '/third_party/smtp/Send_Mail.php';

class Client extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        
        date_default_timezone_set('UTC');

        $this->load->library('root_init_element');
        $this->root_init_element->init_elements();
        $this->root_init_element->is_root_loggedin();

        $this->load->model('ClientModel');	
        $this->load->model('Dynamic_dependent_model','DDM');  
        $this->load->helper('url');
        $this->load->helper('root');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        $this->load->model("Settings");

        
		
        $this->layout = 'root/layout';
        $this->layoutLogin = 'root/layout-login';

        //default controller
        $this->controller = 'root/client';
        
        //default upload dir
        $this->uploadDir = 'uploads/client_files/';
        
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
        $totalRec = $this->ClientModel->getRows($conditions);
        
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
        $data['ClientDataList'] = $this->ClientModel->getRows($conditions);

        // echo "<pre>";
        // print_r($data['ClientDataList']);
        // exit;


        //define some useful variables for view
        $data['listURL'] = base_url().$this->controller;
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}/client';
        $data['detailsURL'] = base_url().$this->controller.'/details/{ID}';
        $data['blockURL'] = base_url().$this->controller.'/block/{ID}';
        $data['unblockURL'] = base_url().$this->controller.'/unblock/{ID}';
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');

        
        //load users list view

        $this->data['maincontent'] = $this->load->view('root/client/index', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    /*
     * Add user information
     */
    public function add(){

        $data = array();
        $ClientData = array();
        
        
        //if add request is submitted
        if($this->input->post('userSubmit')){

            //form field validation rules            
            $this->form_validation->set_rules('profile_name', 'Profile Name', 'required|trim');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');            
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check');
            $this->form_validation->set_rules('customer_type', 'Customer Type', 'required|trim');
            $this->form_validation->set_rules('country', 'Country', 'required|trim');            
            $this->form_validation->set_rules('state', 'State', 'required|trim');            
            $this->form_validation->set_rules('city', 'City', 'required|trim');            
            $this->form_validation->set_rules('postal_code', 'Postal Code', 'required|trim');            
            $this->form_validation->set_rules('address_line1', 'Address Line 1', 'required|trim');
            $this->form_validation->set_rules('address_line2', 'Address Line 2', 'trim');            
            $this->form_validation->set_rules('contact_name', 'Contact Name', 'required|trim');            
            $this->form_validation->set_rules('contact_title', 'Contact Title', 'required|trim');            
            $this->form_validation->set_rules('notes', 'Notes', 'trim');            
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            $this->form_validation->set_rules('device_count', 'Device Count to Assign', 'required|trim');  
            
            $post =  $this->security->xss_clean($this->input->post());  

                $tempstring ='1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.time();
                $password = substr(str_shuffle($tempstring), 0,8);

                $ClientData = array(                                      
                  
                    'password' => md5($password) ,

                    'profile_name' => $post['profile_name'],
                    'phone_number' => $post['phone_number'],
                    'email' => $post['email'],
                    'customer_type' => $post['customer_type'],
                    'country' => $post['country'],
                    'state' => $post['state'],
                    'city' => $post['city'],
                    'postal_code' => $post['postal_code'],
                    'address_line1' => $post['address_line1'],
                    'address_line2' => $post['address_line2'],
                    'contact_name' => $post['contact_name'],
                    'contact_title' => $post['contact_title'],
                    'notes' => $post['notes'],
                    'status' => $post['status']
                );

            
            if($this->form_validation->run() == true){       
                
    
                $insert_ID = $this->ClientModel->insertData('tbl_clients',$ClientData);
                
                if($insert_ID){     
                    
                    $config = array(
                        'upload_path'   => 'uploads/',
                        'allowed_types' => 'xls'
                    );
                    $this->load->library('upload', $config);

                    $getDevice = $this->ClientModel->getDevices($post['device_count']);
                    $data_toInsert = array();
                    $arrCount = 0;
                    $idArr=array();
                    foreach($getDevice as $device){
                                $data_toInsert[$arrCount]['device_id']    = $device->device_id;              
                                $data_toInsert[$arrCount]['client_id']    = $insert_ID;
                                $data_toInsert[$arrCount]['created_at']    = date("Y-m-d H:i:s");
                                $idArr[$arrCount] = $device->id;
                                $arrCount=$arrCount+1;
                    }

                    $insert = $this->db->insert_batch('tbl_devices', $data_toInsert);
                    $this->ClientModel->updateDeviceStatus($idArr);
                        
                        if ($insert){
                            $total_devices = array('total_devices' =>count($data_toInsert) );
                            $this->ClientModel->update($total_devices, array('id'=>$insert_ID));
                            @unlink($data['full_path']);
                        }else{
                            $data['error_msg'] = 'Some problems occured, please try again.';
                        }

                    // if ($this->upload->do_upload('mac_id_file')) {
                    //     $data = $this->upload->data();
                    //     @chmod($data['full_path'], 0777);

                    //     $this->load->library('Spreadsheet_Excel_Reader');
                    //     $this->spreadsheet_excel_reader->setOutputEncoding('CP125');

                    //     $this->spreadsheet_excel_reader->read($data['full_path']);
                    //     $sheets = $this->spreadsheet_excel_reader->sheets[0];
                    //     // error_reporting(0);

                    //     $data_excel = array();
                    //     for ($i = 1; $i <= $sheets['numRows']; $i++) {
                    //         if ($sheets['cells'][$i][1] == '') break;

                    //         $data_excel[$i - 1]['device_id']    = $sheets['cells'][$i][1];              
                    //         $data_excel[$i - 1]['client_id']    = $insert_ID;

                    //         $data_excel[$i - 1]['created_at']    = date("Y-m-d H:i:s");                                          
                    //     }

                    //     $insert = $this->db->insert_batch('tbl_devices', $data_excel);
                        
                    //     if ($insert){
                    //         $total_devices = array('total_devices' =>count($data_excel) );
                    //         $this->ClientModel->update($total_devices, array('id'=>$insert_ID));
                    //         @unlink($data['full_path']);
                    //     }else{
                    //         $data['error_msg'] = 'Some problems occured, please try again.';
                    //     }

                    // }elseif (!empty($_FILES['file']['name']) && $this->upload->display_errors()) {
                    //         $data['mac_id_file_error'] = $this->upload->display_errors();
                    // }

                    $to = $ClientData['email'];
                    $subject = 'Account Password';
                    
                    $from_email = 'temp@passpatchllc.com';
                    $password_token = md5(time().json_encode($data));
                    $mailData = array(
                        'profile_name'=>$ClientData['profile_name'],
                        'password_token'=>$password_token,
                        "password"=>$password
                    );

                        $body = $this->load->view('emailTemplate/send-password', $mailData, True);  

                    $mail = Send_Mail($to,$from_email,$body,$subject);
                    
                    
                    if ($mail != TRUE) {
                        $data['error_msg'] = "Password Sending Failed?";
                    }else{

                    $this->ClientModel->update(array('password_token' => $password_token, 'is_password_link_valid' => date('Y-m-d H:i:s', strtotime(Vailid_time1))), array('id'=>$insert_ID));

                     $this->session->set_userdata('success_msg', 'Client has been added successfully.');
                    redirect($this->controller);
                    }

                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }          
        }

        $data['listURL'] = base_url().$this->controller.'/index/';
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';        
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        $data['sampleFileDownload'] = base_url().'/assets/SampleFileMACAdressList.xls';
        
        //define some useful variables for view
        $data['ClientData'] = $ClientData;   
        $data['ClientDataList'] = $this->ClientModel->getRows();     
        $data['CustomerTypeData'] = $this->ClientModel->getData('tbl_customer_type',array());   
        $data['country'] = $this->DDM->fetch_country();     
        $data['listURL'] = base_url().$this->controller;
        $data['action'] = 'Add';
        $data['action_btn'] = 'Create';
        $data['allDevices'] = $this->Settings->getAllDevices();
        //load the view
        $this->data['maincontent'] = $this->load->view('root/client/add-edit-client', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

    public function edit($id,$redirect=''){
        $data = array();
        //get user data by id
        $id=base64_decode($id);

        $ClientData = $this->ClientModel->getRows(array('id'=>$id));
        
        
        //if add request is submitted
        if($this->input->post('userSubmit')){

            //form field validation rules            
            $this->form_validation->set_rules('profile_name', 'Profile Name', 'required|trim');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim'); 
            $this->form_validation->set_rules('device_count', 'Device Count to Assign', 'required|trim');            
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check[' . $id . ']');
            $this->form_validation->set_rules('customer_type', 'Customer Type', 'required|trim');
            $this->form_validation->set_rules('country', 'Country', 'required|trim');            
            $this->form_validation->set_rules('state', 'State', 'required|trim');            
            $this->form_validation->set_rules('city', 'City', 'required|trim');            
            $this->form_validation->set_rules('postal_code', 'Postal Code', 'required|trim');            
            $this->form_validation->set_rules('address_line1', 'Address Line 1', 'required|trim');
            $this->form_validation->set_rules('address_line2', 'Address Line 2', 'trim');            
            $this->form_validation->set_rules('contact_name', 'Contact Name', 'required|trim');            
            $this->form_validation->set_rules('contact_title', 'Contact Title', 'required|trim');            
            $this->form_validation->set_rules('notes', 'Notes', 'trim');            
            $this->form_validation->set_rules('status', 'Status', 'required|trim');            
           

            
            $post =  $this->security->xss_clean($this->input->post());  

                $tempstring ='1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.time();
                $password = substr(str_shuffle($tempstring), 0,8);

                $ClientData = array(                                      
                  
                    'profile_name' => $post['profile_name'],
                    'phone_number' => $post['phone_number'],
                    'email' => $post['email'],
                    'customer_type' => $post['customer_type'],
                    'country' => $post['country'],
                    'state' => $post['state'],
                    'city' => $post['city'],
                    'postal_code' => $post['postal_code'],
                    'address_line1' => $post['address_line1'],
                    'address_line2' => $post['address_line2'],
                    'contact_name' => $post['contact_name'],
                    'contact_title' => $post['contact_title'],
                    'notes' => $post['notes'],
                    'status' => $post['status']
                );

            
            if($this->form_validation->run() == true){
                $update = $this->ClientModel->update($ClientData, array('id'=>$id));
                if($update){     
                        
                    $config = array(
                        'upload_path'   => 'uploads/',
                        'allowed_types' => 'xls'
                    );
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('mac_id_file')) {
                        $this->ClientModel->delete_macIDs($id);

                        $data = $this->upload->data();
                       // @chmod($data['full_path'], 0777);

                        $this->load->library('Spreadsheet_Excel_Reader');
                        $this->spreadsheet_excel_reader->setOutputEncoding('CP125');

                        $this->spreadsheet_excel_reader->read($data['full_path']);
                        $sheets = $this->spreadsheet_excel_reader->sheets[0];
                        // error_reporting(0);

                        $data_excel = array();
                        for ($i = 1; $i <= $sheets['numRows']; $i++) {
                            if ($sheets['cells'][$i][1] == '') break;

                            $data_excel[$i - 1]['device_id']    = $sheets['cells'][$i][1];              
                            $data_excel[$i - 1]['client_id']    = $id;

                            $data_excel[$i - 1]['created_at']    = date("Y-m-d H:i:s");                                          
                        }

                        $insert = $this->db->insert_batch('tbl_devices', $data_excel);
                        
                        if ($insert){   

                             $total_devices = array('total_devices' =>count($data_excel) );
                            $this->ClientModel->update($total_devices, array('id'=>$id));

                            @unlink($data['full_path']);
                            

                        }else{
                            $data['error_msg'] = 'Some problems occured, please try again.';
                        }

                    }elseif ($this->upload->display_errors()) {
                            $data['mac_id_file_error'] = "File type not allowed";
                    }

                    if ($redirect=='client') 
                    {
                        $this->session->set_userdata('success_msg', 'Client details has been updated successfully.');
                        redirect($this->controller);
                        
                    }elseif ($redirect=='home') {
                        $this->session->set_userdata('success_msg', 'Client details has been updated successfully.');
                        redirect('root/Home');
                    }else{
                        $this->session->set_userdata('success_msg', 'Client details has been updated successfully.');
                        redirect('root/Home');
                    }

                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }          
        }

        if ($redirect=='client') 
        {           
            $data['listURL'] = base_url().$this->controller.'/index/';           
            
        }elseif ($redirect=='home') {            
            $data['listURL'] = base_url().'root/Home'.'/index/';            
        }else{            
            $data['listURL'] = base_url().$this->controller.'/index/';          
        }

        // $data['listURL'] = base_url().$this->controller.'/index/';
        $data['addURL'] = base_url().$this->controller.'/add';
        $data['editURL'] = base_url().$this->controller.'/edit/{ID}';        
        $data['deleteURL'] = base_url().$this->controller.'/delete/{ID}';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        $data['sampleFileDownload'] = base_url().'/assets/SampleFileMACAdressList.xls';
        
        //define some useful variables for view
        $data['ClientData'] = $ClientData;   
        $data['ClientDataList'] = $this->ClientModel->getRows();     
        $data['CustomerTypeData'] = $this->ClientModel->getData('tbl_customer_type',array());     
        $data['country'] = $this->DDM->fetch_country();   
        // $data['listURL'] = base_url().$this->controller;
        $data['action'] = 'Edit';
        $data['action_btn'] = 'Update';

        $data['allDevices'] = $this->ClientModel->getClientDevices($id);
        //load the view
        $this->data['maincontent'] = $this->load->view('root/client/add-edit-client', $data, true);   
        $this->load->view($this->layout, $this->data);     
    }

    public function delete($id){
        
        if($id){
            $id=base64_decode($id);
            $userData = $this->ClientModel->getRows(array('id'=>$id));
            $delete = $this->ClientModel->delete($id);

            if($delete){
                $this->session->set_userdata('success_msg', 'Client has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occured, please try again.');
            }
        }
        redirect($this->controller);
    }
    

    //  Methods

    public function email_check($str, $id = ''){
        $con['returnType'] = 'count';
        if ($id != '') {
            $con['conditions'] = array('email'=>$str, 'id != ' => $id);
        } else {
            $con['conditions'] = array('email'=>$str);
        }
        $checkEmail = $this->ClientModel->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function fetch_state()
    {
        if($this->input->post('country_id'))
        {
            echo $this->DDM->fetch_state($this->input->post('country_id'),$this->input->post('state_id'));
        }
    }

    public function fetch_city()
    {
        if($this->input->post('state_id'))
        {
           echo $this->DDM->fetch_city($this->input->post('state_id'),$this->input->post('city_id'));
        }
    }

}