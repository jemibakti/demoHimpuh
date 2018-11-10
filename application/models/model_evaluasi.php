<?php

class Model_evaluasi extends CI_Model{
	
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function getDataClassToday(){
	// menghasilkan data grid kelas yang sudah ada instrukturnya
		return $this->db->query(
		"
			SELECT
				*
			FROM
				announcetv_frametext
			where (CURDATE() BETWEEN TGLMULAI AND TGLAKHIR and
			room_id < 28) or active_eval = 1
			ORDER BY TRAINING
		"
		)->result();
    }
	
    function getDataInsClass($frametext_id){
	// menghasilkan data grid kelas yang sudah ada instrukturnya
		$this->db->distinct();
		$this->db->select('a.m_instructor_id,a.m_module_id,a.frametext_id,b.INSTRUCTOR_NAME,c.MODULE_NAME');
		$this->db->from('t_absen_instructor a');
		$this->db->join('m_instructor b', 'a.m_instructor_id = b.INSTRUCTOR_ID');
		$this->db->join('m_module c', 'a.m_module_id = c.module_id');
		$this->db->where('frametext_id',$frametext_id);
		$query = $this->db->get();
		return $query->result();
    }
    function getDataEval($quest_group){
	// menghasilkan data grid kelas yang sudah ada instrukturnya
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('t_question_detail a');
		$this->db->join('m_question b', 'a.m_question_id = b.M_QUESTION_ID');
		$this->db->where('question_group_id',$quest_group);
		$query = $this->db->get();
		return $query->result();
    }
}