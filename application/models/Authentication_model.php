<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_model extends CI_Model 
{
	public function authentication($table, $where = '')
	{
		$q = $this->db->where($where)
					  ->get($table);
			return $q->row_array();
	}
}