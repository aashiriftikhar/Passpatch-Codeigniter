<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Model{
    function __construct() {
        $this->siteTbl = 'tbl_site_settings';
    }
    /*
     * Get rows from the site settings table
     */
    function getRow(){
        $this->db->from($this->siteTbl);
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->row_array():FALSE;

        //return fetched data
        return $result;
    }

	function getDeviceCount(){
		$this->db->from("tbl_inventory");
		$this->db->where('assigned','no');
		return $this->db->count_all_results();
	}
	function getTotalCount(){
		$this->db->from("tbl_inventory");
		return $this->db->count_all_results();
	}

	function getAllDevices(){
		$this->db->select("*");
		$this->db->from("tbl_inventory");
		$this->db->where('assigned','no');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function deleteDevices($idArr){
		$this->db->where_in('id', $idArr);
		$delete = $this->db->delete('tbl_inventory');
		return $delete?true:false;
	}

	public function addSingleDevice($dev){
		$data = array(
			'device_id' => $dev
	);
	$this->db->insert('tbl_inventory', $data);

	}
    
	/*
	 * Update settings data
	 */
    public function update($data) {
		
		//check prev row
		$prevRowCount = $this->db->count_all_results($this->siteTbl);
		
		if($prevRowCount > 0){
            //add modified date if not included
			if(!array_key_exists("modified", $data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
            
            //update user data to users table
			$update = $this->db->update($this->siteTbl, $data);
            return $update?true:false;
        }else{
            //add created and modified date if not included
			if(!array_key_exists("created", $data)){
				$data['created'] = date("Y-m-d H:i:s");
			}
			if(!array_key_exists("modified", $data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
			
			//insert cms data to cms pages table
			$insert = $this->db->insert($this->siteTbl, $data);
			
			return $insert?$this->db->insert_id():false;
		}
    }
}
