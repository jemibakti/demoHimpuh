<?php

class Model_order extends CI_Model{
	
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function getDataGrid(){
	// menghasilkan data grid kelas yang sudah ada instrukturnya
		return $this->db->query(
		"
			select
				distinct
				a.training,
				a.tglmulai,
				a.tglakhir,
				e.nama,
				a.frametext_id
			from
				announcetv_frametext a
			join t_absen_instructor b on a.frametext_id = b.FRAMETEXT_ID
			join t_event_frame c on a.frametext_id = c.frametext_id
			join t_event d on c.event_id = d.event_id
			join m_biodata e on e.person_id = d.owner_id
			order by tglmulai
		"
		)->result();
    }
	
    function insert_order_head($table,$data){
	// menginsert data pegawai dengan kelas yang dipilih untuk perjalanan
		$query = $this->db->insert($table,$data);
		return $this->db->query("
			SELECT
				order_id
			FROM
				t_order
			where judul = '".$data['judul']."'
		"
		)->result_array();
    }
	
    function last_insert($table,$data,$key){
	// menginsert data pegawai dengan kelas yang dipilih untuk perjalanan
		$query = $this->db->insert($table,$data);
		return $this->db->query("
			SELECT
				*
			FROM
				$table
			where $key = '".$data[$key]."'
		"
		)->result_array();
    }
	function getJoinRembesDetail($rembes_id){
	// mendapatkan data detail rembes
		$this->db->select('*');
		$this->db->from('t_rembes a');
		$this->db->join('t_rembes_detail b', 'a.t_rembes_id = b.rembes_id');
		$this->db->where('a.t_rembes_id',$rembes_id);
		
		$query = $this->db->get();
		return $query->result();
	}
}