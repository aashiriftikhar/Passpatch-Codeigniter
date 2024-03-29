<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Administrative Management class created by CodexWorld
 */
class SettingsRoot extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('RootModel');
        $this->load->model('ClientModel');
        $this->load->model("Settings");
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



    public function index()
    {
        $data['listURL'] = base_url();
        $data['action'] = 'Setting';
        $data['countOfDevice'] = $this->Settings->getDeviceCount();
        $data['allDevices'] = $this->Settings->getAllDevices();
        $data['totalDevices'] = $this->Settings->getTotalCount();
        
        $this->data['maincontent'] = $this->load->view('root/settings', $data, true);
        $this->load->view($this->layout, $this->data);
    }
    function consoleLog($msg) {
		echo '<script type="text/javascript">' .
          'console.log(' . $msg . ');</script>';
	}


    public function addSingleDevice(){
        if ( isset($_POST['userSearchMAC'])) {
            $error = $this->Settings->addSingleDevice($_POST['userSearchMAC']);
            if(is_null($error['message'])){
            $this->session->set_flashdata('added', 'Successfully Added.');
            redirect('root/SettingsRoot/index', 'refresh');
            }
            else{
                $this->session->set_flashdata('notAdded', $error['message']);
                redirect('root/SettingsRoot/index', 'refresh');

            }
        }
    }

    public function deleteBulk(){
        $this->form_validation->set_rules('mycheck[0]', 'Delete ID', 'required|trim');
        
        if ($this->form_validation->run() == true) {
            $idArr = array();
            $arrCount=0;
            $IDs = $this->input->post('mycheck');
            foreach ($IDs as $s) {
                $idArr[$arrCount] = $s;
                $arrCount = $arrCount + 1;
            }
            $letsDelete = $this->Settings->deleteDevices($idArr);
            if($letsDelete){
                $this->session->set_flashdata('deleted', 'Successfully Deleted.');
                redirect('root/SettingsRoot/index', 'refresh');
            }
        }
        else{
            $this->session->set_flashdata('deletedFail', 'No ID is selected.');
            redirect('root/SettingsRoot/index', 'refresh');

        }
    }

    //upload mac to inventory
    public function addDeviceToInventory()
    {

 

        if ( isset($_POST['addDevice'])) {

            $config = array(
                'upload_path' => 'uploads/',
                'allowed_types' => 'xls'
            );
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('mac_id_file')) {
                $data = $this->upload->data();
                @chmod($data['full_path'], 0777);

                $this->load->library('Spreadsheet_Excel_Reader');
                $this->spreadsheet_excel_reader->setOutputEncoding('CP125');
                $this->spreadsheet_excel_reader->read($data['full_path']);
                $sheets = $this->spreadsheet_excel_reader->sheets[0];
                // error_reporting(0);
                $data_excel = array();

    
                for ($i = 2; $i <= $sheets['numRows']; $i++) {
                    if ($sheets['cells'][$i][1] == '') break;
                    echo '<pre>';print_r($sheets['cells'][$i][1]);
                    $data_excel[$i - 1]['device_id'] = $sheets['cells'][$i][1];
                }
                $insert = $this->db->insert_batch('tbl_inventory', $data_excel);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Successfully Added.');
                    redirect('root/SettingsRoot/index', 'refresh');

                } else {
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }

            } elseif (!empty($_FILES['file']['name']) && $this->upload->display_errors()) {
                $data['mac_id_file_error'] = $this->upload->display_errors();
            }
        }
        else{
            $this->session->set_flashdata('success', 'Successfully Added.');
            redirect('root/SettingsRoot/index', 'refresh');

        }


    }
}