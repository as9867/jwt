<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {
  
	public function addRecord($data){  
		$this->db->insert('student',$data); 
		return $this->db->insert_id(); 
	}
	public function getRecord($limit,$start)
	{    
		$this->db->select('*');
		$this->db->from('student');
		$this->db->limit($limit, $start);
		$query = $this->db->get()->result();   
		return $query;
	}
	
	public function getUserInfoById($id)
	{    
		$this->db->select('*');
		$this->db->from('student');
		$this->db->where('id', $id);
		$query = $this->db->get()->row();    
		return $query;
	}
	public function updateRecord($data,$id)
	{ 
		$this->db->where('id', $id);
		$this->db->update('student',$data);
		return true;
	}
	public function deleteRecord($id)
	{ 
		$this->db->where('id', $id);
		$this->db->delete('student');
		return true;
	}

		 function getData($tableName, $where_data=array(), $where_in = array(),$order_by=array(),$like = array()){
        try{
            if (isset($tableName) && isset($where_data)) {

                $this->db->trans_start();
                if(!empty($where_data)){
                    $this->db->where($where_data);
                }
                if(!empty($where_in)){
                    $this->db->where_in($where_in['field'],$where_in['in_array']);
                }
                if(!empty($order_by)){
                    $this->db->order_by($order_by['field'], $order_by['order']);
                }
                if(!empty($like)){
                    foreach ($like as $key => $value) {
                        $this->db->like($value['field'], $value['keyword']);
                    }
                }
                $query = $this->db->get($tableName);

                $this->db->trans_complete();
                if ($query->num_rows() > 0){
                    $rows = $query->result_array();
                    return $rows;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        } catch (Exception $e){
            return false;
        }
    }
	public function getTotalRow()
	{ 
		return $this->db->count_all("student");
	}
	 
 
 
}
