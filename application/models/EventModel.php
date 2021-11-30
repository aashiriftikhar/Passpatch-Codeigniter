<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class EventModel extends CI_Model{
	
	function __construct() {
		$this->tableName = 'tbl_event';
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
                
                event_name LIKE '%".$params['searchKeyword']."%' OR
                description LIKE '%".$params['searchKeyword']."%' OR
                location LIKE '%".$params['searchKeyword']."%' OR
                group_id LIKE '%".$params['searchKeyword']."%' OR
                from_device_id LIKE '%".$params['searchKeyword']."%' OR
                to_device_id LIKE '%".$params['searchKeyword']."%' OR
                image LIKE '%".$params['searchKeyword']."%' OR
                start_date LIKE '%".$params['searchKeyword']."%' OR
                end_date LIKE '%".$params['searchKeyword']."%' OR
                start_time LIKE '%".$params['searchKeyword']."%' OR
                end_time LIKE '%".$params['searchKeyword']."%' OR                
                time_zone LIKE '%".$params['searchKeyword']."%')");
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
		$this->db->order_by('id', 'DESC');
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


	public function delete($id){
		$delete = $this->db->delete($this->tableName,array('id'=>$id));
		return $delete?true:false;
	}

	public function getEventWithId($id){
		$sql = "SELECT t1.*,`t2`.`device_id` FROM `tbl_event` as `t1` JOIN `tbl_devices` as `t2` ON `t2`.`id`=`t1`.`from_device_id` WHERE `t1`.`client_id` = ?";
		// $this->db->select('*');
		// $this->db->from("tbl_event as t1");
		// $this->db->where("t1.client_id",$id);
		// $this->db->join("tbl_devices as t2","t2.id=t1.from_device_id");

        $query = $this->db->query($sql,$id);       
        return $query->result_array();
	}


	public function getDevicesNotAssigned($id){
		$sql = "SELECT `t1`.`device_id`,`t1`.`id`,`t1`.`client_id` FROM `tbl_devices` as `t1` LEFT JOIN `tbl_event` as `t2` on `t2`.`from_device_id`=`t1`.`id`  WHERE `t2`.`from_device_id` IS NULL AND `t1`.`client_id`=?";
        $query = $this->db->query($sql,$id);       
        return $query->result_array();

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

