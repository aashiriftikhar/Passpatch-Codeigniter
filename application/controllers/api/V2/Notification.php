<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
require_once APPPATH . '/third_party/smtp/Send_Mail.php';

class Notification extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', 'CM');
        $this->load->model('Authentication_model', 'AM');
        $this->load->helper('authentication');

        //default upload dir
        $this->uploadDir = 'uploads/files/';
    }

    public function saveTemperature_post()
    {
        if (keyAuth() == TRUE) {
            $data = $this->post();
            $this->form_validation->set_data($data);
            // Validations   

            $this->form_validation->set_rules('device_id', 'device_id', 'trim|required');
            $this->form_validation->set_rules('device_mac_id', 'device_mac_id', 'trim|required');
            $this->form_validation->set_rules('token', 'token', 'trim|required');
            $this->form_validation->set_rules('lat', 'lat', 'trim|required');
            $this->form_validation->set_rules('lon', 'lon', 'trim|required');
            $this->form_validation->set_rules('temperature', 'temperature', 'trim|required');
            $this->form_validation->set_rules('date_time', 'date_time', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $responcearray = array('status' => 400, "success" => false, "message" => $this->displayValidation(validation_errors()), "result" => new stdClass());
                $this->response($responcearray, REST_Controller::HTTP_OK);
            } else {
                $Condition = array();
                $Condition['select'] = 'id,client_id,member_name';
                $Condition['group_by'] = array();
                $Condition['join'] = array();
                $Condition['where'] = array('device_mac_id' => $data['device_mac_id']);
                $response = $this->_getdata('tbl_members', $Condition);

                if ($response) {
                    $postData = array(

                        "client_id" => $response['client_id'],
                        "member_id" => $response['id'],
                        "device_id" => $data['device_id'],
                        "device_mac_id" => $data['device_mac_id'],
                        "token" => $data['token'],
                        "lat" => $data['lat'],
                        "lon" => $data['lon'],
                        "temperature" => $data['temperature'],
                        "date_time" => $data['date_time']
                    );

                    $insertData = $this->_insertdata('tbl_temperature_logs', $postData);

                    if ($insertData) {


                        $Condition = array();
                        $Condition['select'] = 'email,profile_name';
                        $Condition['group_by'] = array();

                        $Condition['where'] = array('id' => $response['client_id']);
                        $ClientData = $this->_getdata('tbl_clients', $Condition);

                        $to = $ClientData['email'];
                        $subject = 'Device';
                        $from_email = 'temp@passpatchllc.com';

                        $parms = array(
                            "profile_name" => $ClientData['profile_name'],
                            "member_name" => $response['member_name'],
                            "device_mac_id" => $data['device_mac_id'],
                            "device_id" => $data['device_id'],
                            "lat" => $data['lat'],
                            "lon" => $data['lon'],
                            "temperature" => $data['temperature']
                        );

                    $str = explode("°",$data["temperature"]);

                    if(($str[0]>100 && $str[1]=="F") || ($str[0]>37 && $str[1]=="C")){

                        $body = $this->load->view('emailTemplate/temperature_alert', $parms, True);

                        $mail = Send_Mail($to, $from_email, $body, $subject);
                    }

                        $responcearray = array('status' => 200, "success" => true, "message" => MY_Controller::DATA_STORED, "result" => new stdClass());
                    } else {
                        $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::WENTWRONG, "result" => new stdClass());
                    }
                } else {
                    $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_MAC_ID, "result" => new stdClass());
                }
            }
        } else {
            $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_API_KEY, "result" => new stdClass());
        }

        $this->response($responcearray, REST_Controller::HTTP_OK);
    }

    public function NotificationList_post()
    {
        if (keyAuth() == TRUE) {
            $data = $this->post();
            $this->form_validation->set_data($data);
            // Validations   
            $this->form_validation->set_rules('device_mac_id', 'device_mac_id', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $responcearray = array('status' => 400, "success" => false, "message" => $this->displayValidation(validation_errors()), "result" => new stdClass());
                $this->response($responcearray, REST_Controller::HTTP_OK);
            } else {
                $Condition = array();
                $Condition['select'] = 'member_name,room_number,floor_number,building_number,tbl_temperature_logs.device_mac_id,device_id,temperature,location,date_time';
                $Condition['group_by'] = array();

                $Condition['join_table'] = 'tbl_members';
                $Condition['join_on'] = 'tbl_temperature_logs.member_id = tbl_members.id';
                $Condition['join'] = 'inner';

                $Condition['order_by_index'] = "tbl_temperature_logs.date_time";
                $Condition['order_by'] = "DESC";

                $Condition['where'] = array('tbl_temperature_logs.device_mac_id' => $data['device_mac_id']);
                $response = $this->CM->getdataAll('tbl_temperature_logs', $Condition);
                $result = array();
                foreach ($response as $key => $value) {
                    $str = explode("°",$value["temperature"]);
                    if($str[1]=="F"){
                        if($str[0]>100){
                        $value['message'] = "Your body temperature is very high please check your temperature.";
                        }
                        else{
                            $value['message'] = "Your body temperature is normal.";
                        }
                    }
                    else{
                        if($str[0]>37){
                            $value['message'] = "Your body temperature is very high please check your temperature.";
                            }
                            else{
                                $value['message'] = "Your body temperature is normal.";
                            }
                    }
                    $value['date_time'] = date('d-m-Y , h:i A', strtotime($value['date_time']));
                    $result[] = $value;
                }

                if ($response) {
                    $responcearray = array('status' => 200, "success" => true, "message" => MY_Controller::NOTIF_LIST_GOT, "result" => $result);
                } else {
                    $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_MAC_ID, "result" => new stdClass());
                }
            }
        } else {
            $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_API_KEY, "result" => new stdClass());
        }

        $this->response($responcearray, REST_Controller::HTTP_OK);
    }

    public function connectDevice_post()
    {
        if (keyAuth() == TRUE) {
            $data = $this->post();
            $this->form_validation->set_data($data);


            $Condition = array();
            $Condition['select'] = 'status';
            $Condition['group_by'] = array();
            $Condition['join'] = array();
            $Condition['where'] = array('device_mac_id' => $data['device_mac_id'], 'device_id' => $data['device_id']);
            $checkStatus = $this->_getdata('tbl_device_register', $Condition);

            if ($checkStatus['status'] == 1) {
                $this->form_validation->set_rules('device_mac_id', 'device_mac_id', 'trim|required|is_unique[tbl_device_register.device_mac_id]');
            } else {
                $this->form_validation->set_rules('device_mac_id', 'device_mac_id', 'trim|required');
            }

            // Validations   

            $this->form_validation->set_rules('device_id', 'device_id', 'trim|required');

            $this->form_validation->set_message('is_unique', 'This MAC ID is already connected');

            if ($this->form_validation->run() == FALSE) {
                $responcearray = array('status' => 400, "success" => false, "message" => $this->displayValidation(validation_errors()), "result" => new stdClass());
                $this->response($responcearray, REST_Controller::HTTP_OK);
            } else {

                $Condition = array();
                $Condition['select'] = 'id,client_id,member_name,';
                $Condition['group_by'] = array();
                $Condition['join'] = array();
                $Condition['where'] = array('device_mac_id' => $data['device_mac_id']);
                $response = $this->_getdata('tbl_members', $Condition);

                if ($response) {
                    if (isset($checkStatus['status']) && $checkStatus['status'] == 0) {
                        $postData = array(
                            "status" => '1',
                            "last_update" => Date('Y-m-d h:i:s')
                        );

                        $where = array("device_mac_id" => $data['device_mac_id'], "device_id" => $data['device_id']);
                        $action = $this->_updatedata('tbl_device_register', $postData, $where);
                    } else {
                        $postData = array(
                            "client_id" => $response['client_id'],
                            "member_id" => $response['id'],
                            "device_id" => $data['device_id'],
                            "device_mac_id" => $data['device_mac_id'],
                            "status" => '1',
                            "created_date" => Date('Y-m-d h:i:s')
                        );

                        $action = $this->_insertdata('tbl_device_register', $postData);
                    }


                    if ($action) {
                        $Condition = array();
                        $Condition['select'] = 'email,profile_name';
                        $Condition['group_by'] = array();

                        $Condition['where'] = array('id' => $response['client_id']);
                        $ClientData = $this->_getdata('tbl_clients', $Condition);

                        $to = $ClientData['email'];
                        $subject = 'New Device Registered';
                        $from_email = 'temp@passpatchllc.com';


                        $parms = array(
                            "profile_name" => $ClientData['profile_name'],
                            "member_name" => $response['member_name'],
                            "device_mac_id" => $data['device_mac_id'],
                            "device_id" => $data['device_id']
                        );

                        $body = $this->load->view('emailTemplate/new-device', $parms, True);


                        $mail = Send_Mail($to, $from_email, $body, $subject);


                        $responcearray = array('status' => 200, "success" => true, "message" => MY_Controller::DEVICE_CONNECTED, "result" => new stdClass());
                    } else {
                        $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::WENTWRONG, "result" => new stdClass());
                    }
                } else {

                    $Condition = array();
                    $Condition['select'] = 'id,client_id';
                    $Condition['group_by'] = array();
                    $Condition['join'] = array();
                    $Condition['where'] = array('device_id' => $data['device_mac_id']);
                    $response = $this->_getdata('tbl_devices', $Condition);

                    $Condition1 = array();
                    $Condition1['select'] = 'id,client_id';
                    $Condition1['group_by'] = array();
                    $Condition1['join'] = array();
                    $Condition1['where'] = array('from_device_id' => $response['id']);
                    $response =  $this->_getdata('tbl_event',$Condition1);
                    if($response){
                    $postData = array(
                        "client_id" => $response['client_id'],
                        "event_id" => $response['id'],
                        "device_mac_id" => $data['device_mac_id'],
                        "member_name" => 'NotAssigned',
                        "room_number" => '0',
                        "floor_number" => '0',
                        "building_number" => '0',
                        "status" => 'Active',
                        "created_at" => Date('Y-m-d h:i:s'),
                        "updated_at" => Date('Y-m-d h:i:s')
                    );


                    $this->db->insert('tbl_members', $postData);
                    $insert_id = $this->db->insert_id();

                    $postData = array(
                        "client_id" => $response['client_id'],
                        "member_id" => $insert_id,
                        "device_id" => $data['device_id'],
                        "device_mac_id" => $data['device_mac_id'],
                        "status" => '1',
                        "created_date" => Date('Y-m-d h:i:s')
                    );

                    $action = $this->_insertdata('tbl_device_register', $postData);

                    if ($action) {
                        $Condition = array();
                        $Condition['select'] = 'email,profile_name';
                        $Condition['group_by'] = array();

                        $Condition['where'] = array('id' => $response['client_id']);
                        $ClientData = $this->_getdata('tbl_clients', $Condition);

                        $to = $ClientData['email'];
                        $subject = 'New Device Registered';
                        $from_email = 'temp@passpatchllc.com';


                        $parms = array(
                            "profile_name" => $ClientData['profile_name'],
                            "device_mac_id" => $data['device_mac_id'],
                            "device_id" => $data['device_id']
                        );

                        $body = $this->load->view('emailTemplate/new-device-nomember', $parms, True);


                        $mail = Send_Mail($to, $from_email, $body, $subject);


                        $responcearray = array('status' => 200, "success" => true, "message" => MY_Controller::DEVICE_CONNECTED, "result" => new stdClass());
                    } else {
                        $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::WENTWRONG, "result" => new stdClass());
                    }
                }
                else{
                    $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::WENTWRONG, "result" => new stdClass());

                }

                    // $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_MAC_ID, "result" => new stdClass()); 
                }
            }
        } else {
            $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_API_KEY, "result" => new stdClass());
        }

        $this->response($responcearray, REST_Controller::HTTP_OK);
    }

    public function logout_post()
    {
        if (keyAuth() == TRUE) {
            $data = $this->post();
            $this->form_validation->set_data($data);
            // Validations   

            $this->form_validation->set_rules('device_id', 'device_id', 'trim|required');
            $this->form_validation->set_rules('device_mac_id', 'device_mac_id', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $responcearray = array('status' => 400, "success" => false, "message" => $this->displayValidation(validation_errors()), "result" => new stdClass());
                $this->response($responcearray, REST_Controller::HTTP_OK);
            } else {
                $postData = array(
                    "status" => '0',
                    "last_update" => Date('Y-m-d h:i:s')
                );
                $where = array("device_mac_id" => $data['device_mac_id'], "device_id" => $data['device_id']);
                $updatedData = $this->_updatedata('tbl_device_register', $postData, $where);

                if ($updatedData == TRUE) {

                    $responcearray = array('status' => 200, "success" => true, "message" => MY_Controller::LOGOUT, "result" => new stdClass());
                } else {
                    $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::WENTWRONG, "result" => new stdClass());
                }
            }
        } else {
            $responcearray = array('status' => 400, "success" => false, "message" => MY_Controller::INVALID_API_KEY, "result" => new stdClass());
        }

        $this->response($responcearray, REST_Controller::HTTP_OK);
    }


    // Private function

    private function displayValidation($error)
    {
        $error = str_replace("</p>", "", $error);
        $error = str_replace("<p>", "", $error);
        $error = str_replace("\n", "", $error);
        return $error;
    }

    private function _insertdata($table, $data, $where = '')
    {
        $insert = $this->CM->insertdata($table, $data, $where);
        if ($insert) {
            return $insert;
        } else {
            return False;
        }
    }

    private function _getdata($table, $where = '')
    {

        $data = $this->CM->getdata($table, $where);
        if ($data) {
            return $data;
        } else {
            return FALSE;
        }
    }

    private function _updatedata($table, $data, $where)
    {
        $response = $this->CM->updatedata($table, $data, $where);
        if ($response > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function _deletedata($table, $where)
    {
        $response = $this->CM->deletedata($table, $where);
        if ($response > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function _sendemail($UserData)
    {

        $to = $UserData['email'];


        $subject = 'Forget Password';
        $otp = $this->generateNumericOTP(6);


        $temp = base_url('Welcome/autoredirect/') . $otp . "/" . $UserData['userId'];

        $body = $this->load->view('emailTemplate/forgetPassword',  array('temp' => $temp), True);


        $mail = Send_Mail_New($to, $body, $subject);

        if ($mail) {
            $param = array(
                "otp" => $otp,
                "last_update" => Date('Y-m-d H:i:s')
            );
            $this->_updatedata('tbl_user', $param, array("userId" => $UserData['userId']));

            return $mail;
        } else {
            return FALSE;
        }
    }

    private function generateNumericOTP($n)
    {

        $generator = "1357902468";

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        return $result;
    }
}
