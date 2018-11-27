<?php

class Model_course extends CI_Model{
	
	protected $tableName = "kata";
	
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function getDataGrid(){
	// mendapatkan detail pengajar, modul, serta total biaya pembayaran instruktur dalam satu kelas
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('M_COURSE A');
		$this->db->join('M_ACCOUNT B', 'A.ACCOUNT_ID = B.ACCOUNT_ID');
		$this->db->join('M_ACADEMY C', 'A.ACADEMY_ID = C.ACADEMY_ID');
		$this->db->join('M_CORE_CAP D', 'A.CORE_CAPABILITY_ID = D.CORE_CAPABILITY_ID');
		$this->db->order_by('a.course_title asc');
		$query = $this->db->get();
		return $query->result();
		
    }
	
    function getUrutLv3($parent_id){
	// menghasilkan data report realiasasi pelatihan berdasarkan template dari pgk
		$urut = $this->db->query(
		"
			select
				max(convert(substr(course_code,-3), UNSIGNED INTEGER))+1 as number
			from
				m_course
			where parent_id = '".$parent_id."'

		"
		)->result();
		foreach($urut as $row){
			if($row->number){
				$no = $row->number;
			}else{
				$no = 8;
			}
		}
		return $no;
    }
	
    function getUrutLv2($search){
	// menghasilkan data report realiasasi pelatihan berdasarkan template dari pgk
		$urut = $this->db->query(
		"
						
			select
				max((convert(substr(course_code,5,4), UNSIGNED INTEGER)))+1 as number
			from
				m_course
			where course_code like '%".$search."%'

		"
		)->result();
		foreach($urut as $row){
			$no = $row->number;
		}
		return $no;
    }
	
	function cek_realisasi(){
	//mendapatkan increment no pp
        return $this->db->query("
			select
				distinct
				a.course_name,
				count(event_id) as kelas
			from
				t_event a
			left join m_comp_realisasi b on a.course_name = b.subcourse_name
			where b.subcourse_name is null
			group by a.course_name
				"
		)->result();
    }
}