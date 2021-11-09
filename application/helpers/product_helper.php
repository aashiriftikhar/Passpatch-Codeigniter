<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
    function getOneProductInventry($where){
        $CI =& get_instance();
       return $CI->db->where($where)->order_by('product_inventry_id','desc')->get('product_inventry')->row_array();
    }
    
    function getCurrentDateVenderData($where){
        $CI =& get_instance();
       $result =  $CI->db->select('sum(vender_purchase) as total_vender_purchase ')->where($where)->group_by('product_id')->get('product_inventry')->row_array();
       if ($result) {
           return $result['total_vender_purchase'];
       } else {
        return "0";
       }
    }
    
    function getAllSellDetails($where){
        $CI =& get_instance();
       $result =  $CI->db->select('sum(qty * quantity) as total')->where($where)->join('products','products.id = orders_item.product_id','inner')->group_by('product_id')->get('orders_item')->row_array();
       if ($result) {
           return $result['total'] ;
       } else {
        return "0";
       }
    }
    