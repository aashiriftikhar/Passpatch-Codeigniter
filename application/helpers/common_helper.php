<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Content excerpt creation helper function
 */
if (!function_exists('excerpt')) {
    function excerpt($content, $len = 200) {
        $content = strip_tags($content);
        return (strlen($content)>$len)?substr($content,0,$len).'.....':$content;
    }

    function count_GAUnit($group_id) {

    	$CI =& get_instance();

    	$CI->db->select("*");
        $CI->db->from('tbl_groups');
        $CI->db->where('id',$group_id);  
        $query = $CI->db->get();       
        // $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        $row = $query->row_array();

    	return count(range($row['generalUnit_device_id_from'],$row['generalUnit_device_id_to']));
    }

    function count_FIXUnit($group_id) {

    	$CI =& get_instance();

    	$CI->db->select("*");
        $CI->db->from('tbl_groups');
        $CI->db->where('id',$group_id);  
        $query = $CI->db->get();       
        // $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        $row = $query->row_array();

    	return count(range($row['fixUnit_device_id_from'],$row['fixUnit_device_id_to']));
    }

     function getAssign_MACID_Event($from_id,$to_id,$MAC_ID) {

        $CI =& get_instance();

        $CI->db->select('*');
        $CI->db->from('tbl_devices');
        $CI->db->where('id >=',$from_id);
        $CI->db->where('id <=',$to_id);

        $result = $CI->db->get()->result();

        foreach ($result as $key => $value) {
            if ($value->device_id == $MAC_ID) {
                return true;
            }
        }

    }
}