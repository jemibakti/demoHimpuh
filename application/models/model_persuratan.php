<?php

class Model_persuratan extends CI_Model{
	
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function tes(){
	// mendapatkan detail pengajar, modul, serta total biaya pembayaran instruktur dalam satu kelas
		$this->db->distinct();
		$this->db->select('no_reg');
		$this->db->from('M_COURSE A');
		$this->db->join('M_ACCOUNT B', 'A.ACCOUNT_ID = B.ACCOUNT_ID');
		$this->db->join('M_ACADEMY C', 'A.ACADEMY_ID = C.ACADEMY_ID');
		$this->db->join('M_CORE_CAP D', 'A.CORE_CAPABILITY_ID = D.CORE_CAPABILITY_ID');
		$this->db->order_by('a.course_title asc');
		$query = $this->db->get();
		return $query->result();
		
    }
	
    function getNoUrutSurat($jenis,$table){
	// mendapatkan nomer surat baru
		$urut = $this->db->query(
		"
			select
				max(no_reg)+1 as number
			from
				$table
			WHERE substr(tanggal_terima,1,4 ) = substr(curdate(),1,4 ) and jenis_surat like '%$jenis%'

		"
		)->result();
		foreach($urut as $row){
			if($row->number){
				$no = $row->number;
			}else{
				$no = 1;
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
	
}