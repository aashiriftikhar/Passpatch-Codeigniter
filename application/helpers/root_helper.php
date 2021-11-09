<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
    function getTotalDevices($id=''){
        $CI =& get_instance();
       return $CI->db->where('client_id',$id)->get('tbl_mac_id')->num_rows();
    }
    
    
    