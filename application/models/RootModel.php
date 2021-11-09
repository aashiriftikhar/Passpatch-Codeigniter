<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RootModel extends CI_Model{
	
	function __construct() {
		$this->tableName = 'tbl_root';
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


	// public function insertMACIDData($data = array()){		
	// 	$insert = $this->db->insert('tbl_mac_id',$data);
	// 	//return the status
	// 	if($insert){
	// 		$id = $this->db->insert_id();
	// 		return $id;
	// 	}else{
	// 		return false;	
	// 	}
	// }
	
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

