<?php

class Model_dop extends CI_Model{
	
	
    function __construct(){
        parent::__construct();
    }
	
	// global function --------------------------------------------------------------------
	
	function delete_rec($table,$key,$value){
	// delete record dalam tabel by key
        $this->db->where($key,$value);
        $delete = $this->db->delete($table);
        return $delete;
    }
	
	function delete_update_rec($table,$key,$value){
	// delete record dalam tabel by key
		$data = array(
			'ACTIVE_FLAG'=>1,
			'UPDATE_BY'=>$this->session->userdata('logged_in')['username'],
			'UPDATE_DATE'=>date('Y-m-d')
		);
        $delete = $this->update_table($table,$data,$key,$value);
        return $delete;
    }
	
	// global insert model
	 function insert_table($table,$data){
        $query = $this->db->insert($table,$data);
        return $query;
    }
	
	// global update model
    function update_table($table,$update,$where,$value){
        $this->db->where($where,$value);
        $update = $this->db->update($table,$update);
        return $update;
    }
	
	// global update wheres model
	function update_table_wheres($table,$update,$wheres){
		foreach($wheres as $row=>$q ){
			 $this->db->where($row,$q);
		}
        $update = $this->db->update($table,$update);
        return $update;
	}
	
	function get_table($nama_table){
   // mendapatkan data dari suatu table
        $query = $this->db->get($nama_table);
        return $query->result();
   }
   
	function get_table_order($nama_table,$order,$short){
   // mendapatkan data dari suatu table
		$this->db->order_by($order,$short);
        $query = $this->db->get($nama_table);
        return $query->result();
   }
   
   function get_table_where($nama_table,$where,$nilai){
   // mendapatkan data tabel dengan suatu kondisi
		$this->db->where($where,$nilai);
        $query = $this->db->get($nama_table);
        return $query->result();
   }
   function get_table_wheres($nama_table,$where){
   // mendapatkan data tabel dengan suatu kondisi
		foreach($where as $row=>$q ){
			 $this->db->where($row,$q);
		}
        $query = $this->db->get($nama_table);
        return $query->result();
   }
   
   function get_table_where_order($nama_table,$where,$nilai,$order,$short){
   // mendapatkan data tabel dengan suatu kondisi
		$this->db->where($where,$nilai);
		$this->db->order_by($order,$short);
		
        $query = $this->db->get($nama_table);
        return $query->result();
   }
   
   function get_table_where_array($nama_table,$where,$nilai){
   // mendapatkan data tabel dengan suatu kondisi
		$this->db->where($where,$nilai);
        $query = $this->db->get($nama_table);
        return $query->result_array();
   }
   
   function get_table_wheres_order($nama_table,$where,$order,$short){
   // mendapatkan data tabel dengan suatu kondisi
		foreach($where as $row=>$q ){
			 $this->db->where($row,$q);
		}
		$this->db->order_by($order,$short);
        $query = $this->db->get($nama_table);
        return $query->result();
   }
   
   function get_table_wheres_array($nama_table,$where){
   // mendapatkan data tabel dengan suatu kondisi
		foreach($where as $row=>$q ){
			 $this->db->where($row,$q);
		}
        $query = $this->db->get($nama_table);
        return $query->result_array();
   }
   function global_model($table,$select,$where,$join,$where_special,$order,$limit,$offset,$distinct){
		
		if($select){
			$this->db->select($select);
		}
		$this->db->from($table);
		
		if($join){
			foreach($join as $kol){
				$this->db->join($kol['table'], $kol['on'], $kol['type']);
			}
		}
		
		if($where){
			foreach($where as $wer){
				$this->db->where($wer['kolom'],$wer['value']);
			}
		}
		
		if($where_special!=""){
			$this->db->where($where_special);
		}
		
		if($order){
			foreach($order as $wer){
				$this->db->order_by($wer['kolom'],$wer['value']);
			}
		}
		
		if($limit){
			$this->db->limit($limit, $offset);
		}
		
		if($distinct){
			$this->db->distinct();
		}
		
		// $this->db->order_by('a.start_date desc');
		$query = $this->db->get();
		return $query->result();
   }
   
   function global_model_array($table,$select,$where,$join,$where_special,$order,$limit,$offset,$distinct){
		
		if($select){
			$this->db->select($select);
		}
		$this->db->from($table);
		
		if($join){
			foreach($join as $kol){
				$this->db->join($kol['table'], $kol['on'], $kol['type']);
			}
		}
		
		if($where){
			foreach($where as $wer){
				$this->db->where($wer['kolom'],$wer['value']);
			}
		}
		
		if($where_special!=""){
			$this->db->where($where_special);
		}
		
		if($order){
			foreach($order as $wer){
				$this->db->order_by($wer['kolom'],$wer['value']);
			}
		}
		
		if($limit){
			$this->db->limit($limit, $offset);
		}
		
		if($distinct){
			$this->db->distinct();
		}
		
		// $this->db->order_by('a.start_date desc');
		$query = $this->db->get();
		return $query->result_array();
   }
   
	// global function for server side scripting --------------------------------------------------------------------
	
	
}