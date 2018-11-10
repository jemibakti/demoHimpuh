<?php

class Model_rembes extends CI_Model{
	
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
    function getDataReimburse(){
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
    function insert_rembes_head($table,$data){
	// menginsert data pegawai dengan kelas yang dipilih untuk perjalanan
		$query = $this->db->insert($table,$data);
		return $this->db->query("
			SELECT
				t_rembes_id
			FROM
				t_rembes
			where event_id = '".$data['event_id']."'
			and npp = '".$data['npp']."'
		"
		)->result_array();
    }
	
	
    function getDataPpKelas($event_id){
	// mendapatkan data detail dop per kelas
        return $this->db->query("
			select
				a.npp,
				a.nama,
				c.no_rek,
				sum(biaya_tda) as biaya
			from
				t_rembes a
			join t_rembes_detail b on a.t_rembes_id = rembes_id
			join m_biodata c on a.npp = c.npp
			where event_id = $event_id
			group by a.npp,a.nama,c.no_rek
				"
		)->result();
    }
	function getJoinRembesDetail($rembes_id,$flag_app){
	// mendapatkan data detail rembes
		$this->db->select('*');
		$this->db->from('t_rembes a');
		$this->db->join('t_rembes_detail b', 'a.t_rembes_id = b.rembes_id');
		$this->db->where('a.t_rembes_id',$rembes_id);
		if($flag_app){
			$this->db->where('b.flag_aprov','S');
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	function getDataRembes($today,$owner){
	// mendapatkan data detail rembes
		$this->db->select('*');
		$this->db->from('t_rembes a');
		$this->db->join('t_event b', 'a.event_id = b.event_id');
		if($today=='true'){
			$this->db->where('tgl_aprove',date('Y-m-d'));
		}else{
			'';
		}
		if($owner != 0){
			$this->db->where('b.owner_id',$owner);
		}
		$this->db->order_by('a.t_rembes_id');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function getJoinEvent($npp,$app,$flag){
	// mendapatkan data detail rembes
		$this->db->select('*');
		$this->db->from('t_rembes a');
		$this->db->join('t_event b', 'a.event_id = b.event_id');
		$this->db->where($app,$npp);
		
		if($flag == 'U'){
			$this->db->where('flag_aprov','U');
		}elseif($flag == 'S' and $app == 'npp_atasan'){
			$names = array('S', 'Y');
			$this->db->where_in('flag_aprov', $names);
		}elseif($flag == 'S'){
			$this->db->where('flag_aprov','S');
		}elseif($flag == 'Y'){
			$this->db->where('flag_aprov','Y');
		}elseif($flag == ''){
			
		}else{
			$this->db->where('flag_aprov !=','B');
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function cekRembes($event_id,$npp){
	// mendapatkan data detail rembes
		$this->db->select('*');
		$this->db->from('t_rembes');
		$this->db->where('event_id',$event_id);
		$this->db->where('npp',$npp);
		
		$query = $this->db->get();
		return $query->result();
	}
}