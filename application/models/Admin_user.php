<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_User extends CI_Model{
	
	function __construct() {
		$this->tableName = 'tbl_root';
	}
	
	/*
     * Get rows from the admin users table
     */
	public function getRows($params = array()){
		$this->db->from($this->tableName);
		//fetch data by conditions
        if(array_key_exists("conditions",$params)){
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$val);
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
	
	/*
	 * Insert admin user data
	 */
	public function insert($data = array()){
		//add created and modified date if not included
		if(!array_key_exists("created",$data)){
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists("modified",$data)){
			$data['modified'] = date("Y-m-d H:i:s");
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
	
	/*
	 * Update admin user data
	 */
	public function update($data = array(), $conditions = array()){
		//add modified date if not included
		if(!array_key_exists("modified",$data)){
			$data['modified'] = date("Y-m-d H:i:s");
		}
		//update user data to admin users table
		$update = $this->db->update($this->tableName,$data,$conditions);
		return $update?true:false;
		
	}
	
	/*
	 * Update admin user status
	 */
	public function status_update($id,$status){
		$data['status'] = $status;
		$update = $this->db->update($this->tableName,$data,array('id'=>$id));
		
		return $update?true:false;
	}
	
	/*
	 * Delete admin user data
	 */
	public function delete($id){
		$data['is_deleted'] = 1;
		$delete = $this->db->update($this->tableName,$data,array('id'=>$id));
		return $delete?true:false;
	}
	
	/*
	 * Check admin user data by fields and values
	 */
	public function fieldValueCheck($field_value_array){
		$where = $field_value_array;
		$query = $this->db->get_where($this->tableName,$where); 
		
		if($query->num_rows() > 0){
			$result = $query->row_array();
			return $result['id'];
		}else{
			return FALSE;
		}
	}
	
	/*
	 * Existing admin user check
	 */
	public function loginCheck($condition){
		$query = $this->db->get_where($this->tableName,$condition);
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}
	}
}
