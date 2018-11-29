<?php

class Model_control_index extends CI_Model{
	
    function __construct(){
        parent::__construct();
    }

    function getKemungkinanPelatihan($npp,$start_date,$end_date,$id){
	
        return $this->db->query("
			select
				*
			from
				t_pendaftaran_pelatihan a
			join t_pendaftaran_peserta b on a.t_pendaftaran_id = b.pendaftaran_pelatihan_id
			where t_pendaftaran_id not like '$id' and ((
			start_date between 
			DATE_ADD('".$start_date."', INTERVAL -3 WEEK) and 
			DATE_ADD('".$start_date."', INTERVAL +3 WEEK)
			) or (
			end_date between 
			DATE_ADD('".$start_date."', INTERVAL -3 WEEK) and 
			DATE_ADD('".$start_date."', INTERVAL +3 WEEK)
			)or (
			'".$start_date."' between start_date and end_date
			)or (
			'".$end_date."' between start_date and end_date
			))
			and  npp = '".$npp."'  
		"
		)->result();
    }
	
}