<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Master extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('client_init_elements');
		// $this->client_init_elements->is_admin_loggedin();
        $this->client_init_elements->init_elements();	
        $this->client_init_elements->is_client_loggedin();

        $this->load->library('form_validation');
		$this->load->library('pagination');
		// $this->load->model('MasterModel');
		
		//default layout
        $this->layout = 'iamuser/layout';
		
		//default controller
		$this->controller = 'iamuser/master';
		
		//default upload dir
		$this->uploadDir = 'uploads/category_img/';
		
		//per page data limit
		$this->perPage = 10;
    }


	/* Location  */

	public function viewLocation(){
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
		// $totalRec = $this->MasterModel->getRowsLocations($conditions);
		
		//pagination config
		$config['first_link']  = 'First';
		$config['base_url']    = base_url().$this->controller.'/viewLocation/';
		$config['uri_segment'] = 4;
		// $config['total_rows']  = $totalRec;
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
		// $data['users'] = $this->MasterModel->getRowsLocations($conditions);
		// echo "<pre>";
		// print_r($data['users']);
		// exit;


		//define some useful variables for view
		$data['listURL'] = base_url().$this->controller.'/viewLocation';
		$data['addURL'] = base_url().$this->controller.'/addLocation';
		$data['editURL'] = base_url().$this->controller.'/editLocation/{ID}';
		$data['detailsURL'] = base_url().$this->controller.'/details/{ID}';
		$data['blockURL'] = base_url().$this->controller.'/block/{ID}';
		$data['unblockURL'] = base_url().$this->controller.'/unblock/{ID}';
		$data['deleteURL'] = base_url().$this->controller.'/deleteLocation/{ID}';
		$data['searchKeyword'] = $this->session->userdata('userSearchKeyword');
		
		//load users list view
        $this->data['maincontent'] = $this->load->view('iamuser/master/locations', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    
    public function addLocation(){
		
        $data = array();
        // $LocationData = array();		
		
        // if($this->input->post('userSubmit')){
			
        //     $this->form_validation->set_rules('location_name', 'Location Name', 'required|trim');
            
        //     $LocationData = array(            	            	
        //         'location_name' => strip_tags($this->input->post('location_name'))				
        //     );
			
        //     if($this->form_validation->run() == true){       
            
        //     	$insert = $this->MasterModel->insert($LocationData,'tbl_location');
				
        //         if($insert){
                	
        //             $this->session->set_userdata('success_msg', 'Location has been added successfully.');
        //             redirect($this->controller.'/viewLocation/');
        //         }else{
        //             $data['error_msg'] = 'Some problems occurred, please try again.';
        //         }
        //     }          
        // }
		//define some useful variables for view
        // $data['LocationData'] = $LocationData;
		$data['listURL'] = base_url().$this->controller.'/viewLocation/';
		$data['action'] = 'Add';
        //load the view
        $this->data['maincontent'] = $this->load->view('iamuser/master/add-edit-location', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    

 //    public function editLocation($id){
        
 //        $data = array();		
	// 	$id=base64_decode($id);
	// 	$LocationData = $this->MasterModel->getRowsLocations(array('id'=>$id));
 //        if($this->input->post('userSubmit')){
			
	// 		$this->form_validation->set_rules('location_name', 'Location Name', 'required|trim');            
 //            $LocationData = array(            	            	
 //                'location_name' => strip_tags($this->input->post('location_name'))				
 //            );
			
 //            if($this->form_validation->run() == true){               
				
 //                $update = $this->MasterModel->update($LocationData, array('id'=>$id),'tbl_location');
 //                if($update){
 //                	$this->session->set_userdata('success_msg', 'Location details has been updated successfully.');
 //                    redirect($this->controller.'/viewLocation/');                    
 //                }else{
 //                    $data['error_msg'] = 'Some problems occurred, please try again.';
 //                }
 //            }
 //        }

 //        $data['LocationData'] = $LocationData;
	// 	$data['listURL'] = base_url().$this->controller.'/viewLocation/';
	// 	$data['action'] = 'Edit';		
 //        $this->data['maincontent'] = $this->load->view('iamuser/master/add-edit-location', $data, true);
 //        $this->load->view($this->layout, $this->data);
 //    }


 //    public function deleteLocation($id){
		
	// 	if($id){
	// 		$id=base64_decode($id);
			
	// 		$userData = $this->MasterModel->getRowsLocations(array('id'=>$id));
	// 		$prevFile = $userData['drive_license_photo'];
	// 		$delete = $this->MasterModel->delete($id,'tbl_location');

	// 		if($delete){				
	// 			$this->session->set_userdata('success_msg', 'Location has been removed successfully.');
	// 		}else{
	// 			$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
	// 		}
	// 	}		
	// 	redirect($this->controller.'/viewLocation/');
	// }


	
}
