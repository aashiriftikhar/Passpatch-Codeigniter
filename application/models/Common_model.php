<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 
{
	public function insertdata($table, $data, $where='')
	{
		$q = $this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function insertMultipleData($table, $data)
	{
		return $q = $this->db->insert_batch($table, $data);
	}

	public function datacount($table, $where = '')
	{
		$q = $this->db->where($where)
				  ->get($table);
		return  $q->num_rows();
	}

	public function getdata($table, $condition='')
	{
		
			$this->db->select($condition['select']);
			
			if(!empty($condition['join']))
			{
				$this->db->join(strval($condition['join_table']), strval($condition['join_on']), strval($condition['join']));
			}

			if(!empty($condition['group_by']))
			{
				$this->db->group_by($condition['group_by']);
			}

			if(!empty($condition['where']))
			{
				$this->db->where($condition['where']);
			}

			if(!empty($condition['where1']))
			{
				$this->db->or_where($condition['where1']);
			}

			if(!empty($condition['order_by']))
			{
				$this->db->order_by($condition['order_by_index'], $condition['order_by']);
			}

			$q = $this->db->get($table);
			         
			return $q->row_array();
	}

	public function getdataAll($table, $condition = '')
	{
			$this->db->select($condition['select']);

			if(!empty($condition['join']))
			{
				$this->db->join(strval($condition['join_table']), strval($condition['join_on']), strval($condition['join']));
			}

			if(!empty($condition['join2']))
			{
				$this->db->join(strval($condition['join_table2']), strval($condition['join_on2']), strval($condition['join2']));
			}

			if(!empty($condition['join3']))
			{
				$this->db->join(strval($condition['join_table3']), strval($condition['join_on3']), strval($condition['join3']));
			}

			if(!empty($condition['group_by']))
			{
				$this->db->group_by($condition['group_by']);
			}

			if(!empty($condition['where']))
			{
				$this->db->where($condition['where']);
			}

			if(!empty($condition['order_by']))
			{
				$this->db->order_by($condition['order_by_index'], $condition['order_by']);
			}
			
			$q = $this->db->get($table);
			return $q->result_array();
	}

	public function updatedata($table, $data, $where)
	{
		$this->db->where($where)->update($table, $data);
		return $this->db->affected_rows();
	}

	public function updateWithOutAffdata($table, $data, $where)
	{
		return $this->db->where($where)->update($table, $data);
	}

	public function deletedata($table, $where)
	{
		return $q = $this->db->where($where)
					         ->delete($table);
	}


	public function getuniquedata($table,$where)
    {        
        $q = $this->db->select('*');
        $q = $this->db->where($where);
        $q = $this->db->get($table);
		return $q->row_array();
    }  
}
