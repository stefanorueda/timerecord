<?php
class Crud_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
    }
    
    public function fetch($table,$where="",$limit="",$offset="",$order=""){
        if (!empty($where)) {
            $this->db->where($where);	
        }
        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);	
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order); 
        }

    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
        return $query->result();
    }else{
        return FALSE;
    }
}

public function fetch_data($table,$where="",$limit="",$offset="",$order="",$group=""){
        if (!empty($where)) {
            $this->db->where($where);	
        }
        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);	
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order); 
        }
        if (!empty($group)) {
            $this->db->group_by($group); 
        }

    $query = $this->db->get($table);
    return $query->result();

}


public function fetch_tag($tag,$table,$where="",$limit="",$offset="",$order=""){
        if (!empty($where)) {
            $this->db->where($where);	
        }
        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);	
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order); 
        }
        $this->db->select($tag);
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return FALSE;
        }
}

public function fetch_tag_array($tag,$table,$where="",$limit="",$offset="",$order=""){
        if (!empty($where)) {
            $this->db->where($where);	
        }
        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);	
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order); 
        }
        $this->db->select($tag);
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return FALSE;
        }
}


public function fetch_tag_row($tag,$table,$where="",$limit="",$offset="",$order=""){
        if (!empty($where)) {
            $this->db->where($where);	
        }
        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);	
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order); 
        }
        $this->db->select($tag);
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return FALSE;
        }
}


public function insert($table,$data){
    $result = $this->db->insert($table,$data);
    if ($result) {
            return TRUE;
        }else{
            return FALSE;
        }
}


public function update($table,$data,$where=""){
    if($where!=""){
            $this->db->where($where);
        }
    $result = $this->db->update($table,$data);
    if ($result) {
            return TRUE;
        }else{
            return FALSE;
        }
}

public function delete($table,$where=""){
    if($where!=""){
            $this->db->where($where);
        }
     $result = $this->db->delete($table); 
         if ($result) {
            return TRUE;
        }else{
            return FALSE;
        }
}
}
?>