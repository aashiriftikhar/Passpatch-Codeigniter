<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Administrative Management class created by CodexWorld
 */
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('client_init_elements');
        $this->client_init_elements->init_elements();
        $this->client_init_elements->is_client_loggedin();

        $this->load->model('EventModel');
        $this->load->model('MemberModel');
        $this->load->model('ClientModel');
        $this->load->model('Common_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('upload');

        $this->layout = 'iamuser/layout';
        $this->layoutLogin = 'iamuser/layout-login';

        $this->controller = 'iamuser/Home';

        $this->uploadDir = 'uploads/event_image/';

        //per page data limit
        $this->perPage = 3;
    }

    function consoleLog($msg)
    {
        echo '<script type="text/javascript">' .
            'console.log(' . $msg . ');</script>';
    }

    public function index()
    {
        $data = array();

        $EventData = array();

        $client_id = $this->session->userdata('ClientId');
        // $searchKeyword = '';

        //get messages from the session
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        //if search request is submitted
        if ($this->input->post('submitSearch')) {
            $inputKeywords = $this->input->post('userSearchKeyword');
            $searchKeyword = strip_tags($inputKeywords);
            if (!empty($searchKeyword)) {
                $this->session->set_userdata('userSearchKeyword', $searchKeyword);
            } else {
                $this->session->unset_userdata('userSearchKeyword');
            }
        } elseif ($this->input->post('submitSearchReset')) {
            $this->session->unset_userdata('userSearchKeyword');
        }


        //get total rows count of the users
        $conditions['searchKeyword'] = $this->session->userdata('userSearchKeyword');
        // $conditions['conditions']['is_deleted'] = '0';
        $conditions['returnType'] = 'count';
        $totalRec = $this->EventModel->getRows($conditions);

        //pagination config
        $config['first_link']  = 'First';
        $config['base_url']    = base_url() . $this->controller . '/index/';
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
        $offset = !$page ? 0 : $page;

        //get rows of the users
        $conditions['returnType'] = '';
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $conditions['conditions'] = array('tbl_event.client_id' => $client_id);

        $newDat = $this->EventModel->getEventWithId($client_id);


        // $data['EventDataList'] = $this->EventModel->getRows($conditions);

        // echo "<pre>";
        // print_r($data['EventDataList']);
        // exit;
        $data['EventDataList'] = $this->EventModel->getEventWithId($client_id);


        //if add request is submitted
        if ($this->input->post('userSubmit')) {



            //form field validation rules   
            $evName = $this->input->post('event_name');
            foreach ($evName as $ind => $val) {
                $this->form_validation->set_rules('event_name[' . $ind . ']', 'Event Name', 'required|trim');
                $this->form_validation->set_rules('location[' . $ind . ']', 'Location', 'required|trim');
                $this->form_validation->set_rules('description[' . $ind . ']', 'Description', 'required|trim');
                $this->form_validation->set_rules('group[' . $ind . ']', 'Group', 'required|trim');
                // $this->form_validation->set_rules('from_device_id['.$ind.']', 'Device Id', 'required|trim');          
                // $this->form_validation->set_rules('to_device_id['.$ind.']', 'Device Id', 'required|trim');          

                $this->form_validation->set_rules('start_date[' . $ind . ']', 'Start Date', 'required|trim');
                $this->form_validation->set_rules('end_date[' . $ind . ']', 'End Date', 'required|trim');
                $this->form_validation->set_rules('start_time[' . $ind . ']', 'Start Time', 'required|trim');
                $this->form_validation->set_rules('end_time[' . $ind . ']', 'End Time', 'required|trim');
                $this->form_validation->set_rules('time_zone[' . $ind . ']', 'Time Zone', 'required|trim');
            }



            $post =  $this->security->xss_clean($this->input->post());

            $arrCount = 0;
            $EventData = array();
            $count = 0;
            //     echo "<pre>";
            // print_r($this->input->post('assigning'));
            // exit;

            foreach ($this->input->post("event_name") as $e) {
                foreach ($this->input->post('assigning[' . $arrCount . ']') as $s) {
                    $EventData[$count] = array(
                        'client_id' => $client_id,
                        'event_name' => $post['event_name'][$arrCount],
                        'description' => $post['description'][$arrCount],
                        'location' => $post['location'][$arrCount],
                        'group_id' => $post['group'][$arrCount],
                        'from_device_id' => $s,
                        'to_device_id' => $s,
                        'start_date' => date("Y-m-d", strtotime($post['start_date'][$arrCount])),
                        'end_date' => date("Y-m-d", strtotime($post['end_date'][$arrCount])),
                        'start_time' => date("H:i", strtotime($post['start_time'][$arrCount])),
                        'end_time' => date("H:i", strtotime($post['end_time'][$arrCount])),
                        'time_zone' => $post['time_zone'][$arrCount]
                    );
                    ++$count;
                }
                ++$arrCount;
            }




            // if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){

            //     //upload configuration
            //     $targetDir = $this->uploadDir;
            //     $config['upload_path']   = $targetDir;
            //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //     $this->load->library('upload', $config);

            //     //if picture upload is successful
            //     if($this->upload->do_upload('image')){
            //         //load upload helper
            //         $this->load->helper('upload');

            //         //uploaded file data
            //         $uploadData = $this->upload->data();

            //         //thumbnail creation
            //         $uploadedFile = $uploadData['file_name'];
            //         $sourceImage = $targetDir.$uploadedFile;
            //         $thumbPath = $targetDir."thumb/";
            //         create_thumb($sourceImage, $uploadedFile, $thumbPath, 50, 50);

            //         //uploaded picture name
            //         $EventData['image'] = $uploadedFile;
            //     }else{
            //             $data['error_msg'] = $this->upload->display_errors();
            //     }
            // }   


            // print_r($EventData);
            // exit();
            if ($this->form_validation->run() == true) {
                $insert_ID = $this->db->insert_batch('tbl_event', $EventData);
                if ($insert_ID) {
                    $this->session->set_userdata('success_msg', 'Event has been added successfully.');
                    redirect($this->controller);
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }

        $data['EventData'] = $EventData;
        $data['ClientMACIdData'] = $this->EventModel->getDevicesNotAssigned($client_id);
        $data['GroupsData'] = $this->EventModel->getData('tbl_groups', array('client_id' => $client_id));

        $data['TimeZoneList'] = $this->EventModel->getData('tbl_timezone', array());
        $Condition = array();
        $Condition['select'] = 'tbl_temperature_logs.device_mac_id,tbl_temperature_logs.device_id,tbl_temperature_logs.client_id,tbl_temperature_logs.temperature,tbl_temperature_logs.location,tbl_temperature_logs.lat,tbl_temperature_logs.lon,tbl_temperature_logs.token,tbl_temperature_logs.date_time,tbl_event.event_name,tbl_event.description,tbl_event.from_device_id,tbl_event.to_device_id';
        $Condition['where'] = array("tbl_temperature_logs.client_id" => $client_id);
        $Condition['join_table'] = 'tbl_event';
        $Condition['join_on'] = 'tbl_event.client_id = tbl_temperature_logs.client_id';
        $Condition['join'] = 'inner';
        $Condition['order_by'] = 'DESC';
        $Condition['order_by_index'] = 'tbl_temperature_logs.id';
        $EventAlertData = $this->Common_model->getdataAll('tbl_temperature_logs', $Condition);
        // var_dump($EventAlertData);
        $getEvent = array();

        foreach ($EventAlertData as $key => $value) {
            if (getAssign_MACID_Event($value['from_device_id'], $value['to_device_id'], $value['device_mac_id']) == true) {
                $getEvent[] = $value;
            }
        }






        //         echo "<pre>";
        // print_r($getEvent);
        // exit;
        $data['EventAlertData'] = $getEvent;


        //define some useful variables for view
        $data['listURL'] = base_url() . $this->controller;
        $data['addURL'] = base_url() . $this->controller . '/add';
        $data['editURL'] = base_url() . 'iamuser/manage_event' . '/edit/{ID}/home';
        $data['deleteURL'] = base_url() . 'iamuser/manage_event' . '/delete/{ID}/home';
        $data['searchKeyword'] = $this->session->userdata('userSearchKeyword');

        //load users list view

        $this->data['maincontent'] = $this->load->view('iamuser/dashboard', $data, true);
        $this->load->view($this->layout, $this->data);
    }

    public function settings()
    {

        $data = array();


        $this->data['maincontent'] = $this->load->view('iamuser/settings', $data, true);
        $this->load->view($this->layout, $this->data);
    }

    public function reports()
    {

        $data = array();
        $client_id = $this->session->userdata('ClientId');
        $data['ClientMACIdData'] = $this->EventModel->getAllDevices($client_id);

        $data['addURL'] = 'addReport';



        if ($this->input->post('userSubmit')) {

            $post =  $this->security->xss_clean($this->input->post());

            echo "<pre>";
            print_r($post);
            exit;
        }

        $this->data['maincontent'] = $this->load->view('iamuser/reports', $data, true);
        $this->load->view($this->layout, $this->data);
    }

    public function generateReport()
    {

        $data['addURL'] = 'addReport';

        $this->load->model('EventModel');


        if ($this->input->post('userSubmit')) {

            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('assigning', 'Devices', 'required');

            // if ($this->form_validation->run() == true) {

                $post =  $this->security->xss_clean($this->input->post());
                
                $result = $this->EventModel->generateReport($post["assigning"],$post["start_date"],$post["end_date"]);
               
                //load xlsx library
	$this->load->library('Excel');
	
	//define column headers
	$headers = array('Device Mac ID' => 'string', 'Temperature' => 'string', 'Latitude' => 'string', 'Longitude' => 'string', "Date Time"=>'string');
	
	
	//create writer object
	$writer = new Excel();
	
        //meta data info
	$keywords = array('xlsx','MySQL','Codeigniter');
	$writer->setTitle('Device data');
	$writer->setSubject('Report generated by HashPotato');
	$writer->setAuthor('https://hashpotato.io');
	$writer->setCompany('https://hashpotato.io');
	$writer->setDescription('Device data');
	$writer->setTempDir(sys_get_temp_dir());
	
	//write headers
	$writer->writeSheetHeader('Sheet1', $headers);
	
	//write rows to sheet1
	foreach ($result as $sf):
		$writer->writeSheetRow('Sheet1',array($sf->device_mac_id, $sf->temperature, $sf->lat, $sf->lon, $sf->date_time));
	endforeach;
	
	$fileLocation = 'Device_Temperature_History.xlsx';
	
	//write to xlsx file
	$writer->writeToFile($fileLocation);
	//echo $writer->writeToString();
	
	//force download
	header('Content-Description: File Transfer');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=".basename($fileLocation));
	header("Content-Transfer-Encoding: binary");
	header("Expires: 0");
	header("Pragma: public");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header('Content-Length: ' . filesize($fileLocation)); //Remove

	ob_clean();
	flush();

	readfile($fileLocation);
	unlink($fileLocation);
	exit(0);

            // }
            // else{
            //     echo "<pre>";
            //     print_r("Please input all fields");
            //     exit;
            // }
        }
    }

    public function addReport()
    {

        $data = array();


        if ($this->input->post('userSubmit')) {

            $this->form_validation->set_rules('start_date', 'Start Date', 'callback_file_check');
        }

        $this->data['maincontent'] = $this->load->view('iamuser/addReport', $data, true);
        $this->load->view($this->layout, $this->data);
    }


    public function datasheetUpload()
    {

        $data = array();

        $EventData = array();
        $import_array = array();
        $client_id = $this->session->userdata('ClientId');

        // $searchKeyword = '';

        //get messages from the session
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if ($this->input->post('userSubmit')) {

            $this->form_validation->set_rules('file', 'CSV Datasheet File', 'callback_file_check');

            // Validate submitted form data
            if ($this->form_validation->run() == true) {

                // If file uploaded
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    // Load CSV reader library
                    $this->load->library('CSVReader');

                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    // Insert/update CSV data into database
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {

                            // Prepare data for DB insertion

                            $import_array = array(
                                'member_name' => $row['Member Name'],
                                'room_number' => $row['Room Number'],
                                'floor_number' => $row['Floor Number'],
                                'building_number' => $row['Building Number'],
                                'device_mac_id' => $row['Device MAC ID'],
                                'event_id' => $row['Event ID'],
                                'client_id' => $client_id,
                                'status' => $row['Status']
                            );

                            $this->MemberModel->insert($import_array);
                        }
                        $this->session->set_userdata('success_msg', ' CSV Datasheet file  been uploaded successfully.');
                        redirect('iamuser/Home/datasheetUpload');
                    } else {
                        $data['error_msg'] = 'Some problems occurred, please try again.';
                    }
                }
            }
        }

        $data['sample_csv_file'] = base_url() . 'assets/Sample_CSV_Upload.csv';

        $this->data['maincontent'] = $this->load->view('iamuser/datasheet_upload', $data, true);
        $this->load->view($this->layout, $this->data);
    }


    public function events()
    {

        $data = array();

        $data['addURL'] = 'addEvent';

        $this->data['maincontent'] = $this->load->view('iamuser/events', $data, true);
        $this->load->view($this->layout, $this->data);
    }

    public function addEvent()
    {

        $data = array();

        $data['action'] = 'addEvent';
        $data['listURL'] = 'events';

        $this->data['maincontent'] = $this->load->view('iamuser/addEvent', $data, true);
        $this->load->view($this->layout, $this->data);
    }


    public function changePassword()
    {

        $data = array();

        $PasswordData = array();
        $import_array = array();
        $client_id = $this->session->userdata('ClientId');

        //get messages from the session
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if ($this->input->post('userSubmit')) {

            $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[8]', array("required" => "Please enter password.", "min_length" => "Password length should be 8 digits."));
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]', array('matches' => "Confirm password does not match.", "required" => "Please enter confirm password."));

            $post =  $this->security->xss_clean($this->input->post());

            $PasswordData = array(
                "current_password" => $post['current_password'],
                "password" => $post['password'],
                "confirm_password" => $post['confirm_password']
            );

            // Validate submitted form data
            if ($this->form_validation->run() == true) {

                $CheckOldPass = $this->ClientModel->getSingleData('tbl_clients', array(
                    'id' => $client_id,
                    'password' => md5($post['current_password'])
                ));
                if (!empty($CheckOldPass)) {

                    $updatData = array('password' => md5($post['password']), "updated_at" => date("Y-m-d H:i:s"));
                    $where = array('password' => md5($post['current_password']), "id" => $client_id);

                    $update = $this->ClientModel->update($updatData, $where);

                    if ($update) {
                        $PasswordData = array();
                        $data['success_msg'] = "Password has been changed successfully.";
                    } else {
                        $data['error_msg'] = "Something went wrong , please try again later.";
                    }
                } else {
                    $data['error_msg'] = "Invalid Current Password";
                }
            }
        }

        $data['listURL'] = base_url() . $this->controller;

        $data['action'] = 'Change Password';
        $data['PasswordData'] = $PasswordData;
        $this->data['maincontent'] = $this->load->view('iamuser/change-password', $data, true);
        $this->load->view($this->layout, $this->data);
    }


    /*
     * Admin logout
     */
    public function logout()
    {

        //remove session data
        $this->session->unset_userdata('isClientLoggedIn');
        $this->session->unset_userdata('ClientId');
        $this->session->sess_destroy();
        //redirect to login page
        redirect('Auth/');
    }



    public function file_check($str)
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
}
