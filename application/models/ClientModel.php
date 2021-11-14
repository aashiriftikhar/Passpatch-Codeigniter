<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ClientModel extends CI_Model{
	
	function __construct() {
		$this->tableName = 'tbl_clients';
	}
	
	/* Existing admin user check */
	public function loginCheck($condition){
		$query = $this->db->get_where($this->tableName,$condition);
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}
	}

	public function getDevices($count){
		echo $count;
		$this->db->from("tbl_inventory");
		$this->db->where('assigned','no');
		$this->db->limit($count);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateDeviceStatus($idArr,$status){
		$this->db->from("tbl_inventory");
		$this->db->where_in("id", $idArr);
		$data = array(
			'assigned' => $status);
		$this->db->update('tbl_inventory', $data);
	}

	public function getClientDevices($id){
		$this->db->from("tbl_devices");
		$this->db->where("client_id",$id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Get rows from the admin users table */
	public function getRows($params = array()){
		$this->db->from($this->tableName);
		//fetch data by conditions
        if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}

		//search by keywords
		if(!empty($params['searchKeyword'])){
			$params['searchKeyword'] = addslashes($params['searchKeyword']);
			$this->db->where("(
                profile_name LIKE '%".$params['searchKeyword']."%' OR  
                phone_number LIKE '%".$params['searchKeyword']."%' OR  
                email LIKE '%".$params['searchKeyword']."%' OR  
                address_line1 LIKE '%".$params['searchKeyword']."%' OR  
                address_line2 LIKE '%".$params['searchKeyword']."%' OR  
                contact_name LIKE '%".$params['searchKeyword']."%' OR  
                status LIKE '%".$params['searchKeyword']."%')");
		}
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
			$query = $this->db->get();
			$result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results();
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->row_array():FALSE;
			}else{
				$query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
		//return fetched data
		return $result;
	}

	public function getData($TblName,$where =''){
        $this->db->select("*");
        $this->db->from($TblName);
        $this->db->where($where);  
        $query = $this->db->get();       
        // $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $query->result_array();
    }

    public function getSingleData($TblName,$where =''){
        $this->db->select("*");
        $this->db->from($TblName);
        $this->db->where($where);  
        $query = $this->db->get();       
        // $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $query->row_array();
    }
	
	/* Insert admin user data */
	public function insert($data = array()){
		//add created_at and updated_at date if not included
		if(!array_key_exists("created_at",$data)){
			$data['created_at'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists("updated_at",$data)){
			$data['updated_at'] = date("Y-m-d H:i:s");
		}
		//insert user data to admin users table
		$insert = $this->db->insert($this->tableName,$data);
		//return the status
		if($insert){
			$id = $this->db->insert_id();
			return $id;
		}else{
			return false;	
		}
	}

	public function insertData($tableName,$data = array()){
		//add created_at and updated_at date if not included
		if(!array_key_exists("created_at",$data)){
			$data['created_at'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists("updated_at",$data)){
			$data['updated_at'] = date("Y-m-d H:i:s");
		}
		//insert user data to admin users table
		$insert = $this->db->insert($tableName,$data);
		//return the status
		if($insert){
			$id = $this->db->insert_id();
			return $id;
		}else{
			return false;	
		}
	}


	public function updateDeviceByMac($idArr,$status){
		if(count($idArr)>0){
		$this->db->from("tbl_inventory");
		$this->db->where_in("device_id", $idArr);
		$data = array(
			'assigned' => $status);
		$this->db->update('tbl_inventory', $data);
		}

	}

	public function delete($id){
		$this->db->from("tbl_devices");
		$this->db->where("client_id",$id);
		$results = $this->db->get();
		$idsArray=array();
		$count = 0;
		foreach($results->result() as $rs){
			$idsArray[$count] =  $rs->device_id;
			++$count;
		}
		$this->updateDeviceByMac($idsArray,"no");
		$delete = $this->db->delete($this->tableName,array('id'=>$id));
		return $delete?true:false;
	}

	public function delete_macIDs($client_id){
		$delete = $this->db->delete('tbl_devices',array('client_id'=>$client_id));
		return $delete?true:false;
	}
	
	/* Update admin user data */
	public function update($data = array(), $conditions = array()){
		//add updated_at date if not included
		if(!array_key_exists("updated_at",$data)){
			$data['updated_at'] = date("Y-m-d H:i:s");
		}
		//update user data to admin users table
		$update = $this->db->update($this->tableName,$data,$conditions);
		return $update?true:false;
		
	}
}

