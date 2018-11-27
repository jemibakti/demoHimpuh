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

}