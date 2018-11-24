<?php

class Model_wiki extends CI_Model{
	
	protected $tableName = "kata";
	
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function login($username, $password){
        return $this->db->query("
			SELECT
				*
			FROM
				m_user
			where username = '".$username."' and password = '".$password."' and suspen_flag = 0 " 
		)->result_array();
    }
    function dataAbsen($idCompany, $idAcara){
        return $this->db->query("
		SELECT 
			a.*,
			b.id as absenId,
			b.absen_masuk 
		FROM
			m_pegawai a
		LEFT JOIN t_absen b ON a.id = b.id_pegawai AND b.id_acara = ".$idAcara."
		WHERE active_flag = '0' 
			AND flag_undangan = '1' 
			AND id_company = '".$idCompany."' 
		ORDER BY a.pegawai_name ASC  
		")->result();
    }


}