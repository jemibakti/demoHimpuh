<?php

class Model_report extends CI_Model{
	
    function __construct(){
        parent::__construct();
    }
	
	function get_slider($limit,$offset){
		// memanggil data kelas hari ini untuk tampilan event_tv
		return $this->db->query("
						   
				SELECT 
					* 
				FROM 
					announcetv_frametext a
				left join m_classroom b on a.ROOM_ID = b.ROOM_ID
				left join m_room_location c on c.ROOM_LOCATION_ID = b.ROOM_LOCATION_ID
				WHERE `TGLMULAI` <= '".date('Y-m-d')."' AND `TGLAKHIR` >=  '".date('Y-m-d')."' AND `active_flag` = '0'
				order by tglmulai
				limit $limit, $offset
		")->result();
	}
	
	function test(){
		// memanggil data perbandingan pelatihan yang diselenggarakan onl / wilayah (centarl/desentralisasi)
		return $this->db->query("
		    select
				case 
				when penyelenggara in ('WJB','WSY','WJY','WSM','WJK','WJS','WBJ','WBN','WPD') 
				THEN 'DESENTRALISASI' 
				ELSE 'SENTRALISASI' 
				END AS label,
				sum(enroll) AS data
			from
				realisasi
			where '2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate()
			group by label
		")->result();
	}
	
	function pegawaiVs($value){
		// memanggil data perbandingan pelatihan yang diselenggarakan onl / wilayah (centarl/desentralisasi)
		return $this->db->query("
			
		    select
				$value as label,
				count(distinct(a.person_id)) as data
			from
				t_enrollment a
			join m_comp_realisasi b on a.course = b.subcourse_name
			where '2015-01-01' between start_date and end_date 
			or curdate() between start_date and end_date 
			or start_date BETWEEN '2015-01-01' and curdate() 
			or end_date BETWEEN '2015-01-01' and curdate()
			group by $value


		")->result();
	}
	
	function learnerVs($value){
		// memanggil data learner vs academy / course sesuai parameter
		return $this->db->query("
			select
				$value as label,
				IFNULL(data,0) as data
			from
			(
			select
				distinct
				$value
			from
				m_comp_realisasi
			) as func
			left join 
			(
			select
				$value as label,
				sum(enroll) as data
			from
				realisasi
			where '2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate()

			group by $value
			) data on data.label = func.$value
			order by label

		")->result();
	}
	
	function detail_class($value, $jenis){
		// memanggil data dua dimensi course vs function
		if ($jenis){
			$where = "$value = '$jenis'	and";
		}else{
			$where = '';
		}
		
		return $this->db->query("
			
			select
				*
			from
				realisasi
			where $where ('2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate() )
			order by $value

		")->result();
	}
	
	function pegawai_per($value, $jenis){
		// memanggil data detail pegawai yang telah mengikuti academy / function tertentu
		
		return $this->db->query("
			
			select
				*
			from
				t_enrollment a
			left join m_biodata c on a.person_id = c.PERSON_ID
			join m_comp_realisasi b on a.course = b.subcourse_name
			where $value = '".$jenis."'
			('2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate() )
			order by nama

		")->result();
	}
	
	function detail_learner($value, $jenis){
		// memanggil data dua dimensi course vs function
		if ($jenis){
			$where = "$value = '$jenis'	and";
		}else{
			$where = '';
		}
		
		return $this->db->query("
			
			select
				*
			from
				t_enrollment a
			left join m_biodata c on a.person_id = c.PERSON_ID
			join m_comp_realisasi b on a.course = b.subcourse_name
			where $where
			('2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate() )
			order by a.course, subcourse_name, nama


		")->result();
	}
	
	function courseVsFunction(){
		// memanggil data dua dimensi course vs function
		return $this->db->query("
			
			select
				course,
				sum(case when function = 'CORPORATE CORE FUNCTION' then enroll else 0 end) as CORPORATE_CORE,
				sum(case when function = 'TRANSACTIONAL BANKING' then enroll else 0 end) as TRANSACTIONAL,
				sum(case when function = 'CONSUMER & RETAIL' then enroll else 0 end) as CONSUMER,
				sum(case when function = 'BUSINESS BANKING' then enroll else 0 end) as BUSINESS,
				sum(case when function = 'TREASURY AND GLOBAL BANKING' then enroll else 0 end) as TREASURY,
				sum(enroll) as total
			from
				realisasi
			where '2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate()
			group by 
				course

		")->result();
	}
	
	function vsLearner($value){
		// memanggil data jumlah learner per function
		return $this->db->query("
							
			select
				function as label,
				count(a.person_id) as data
			from
				t_enrollment a
			join m_comp_realisasi b on a.course = b.subcourse_name
			where '2015-01-01' between start_date and end_date 
			or curdate() between start_date and end_date 
			or start_date BETWEEN '2015-01-01' and curdate() 
			or end_date BETWEEN '2015-01-01' and curdate()
			group by function

		")->result();
	}
	
	function vsJenjang($value){
		// manampilkan data jenjang per function
		return $this->db->query("
						
			select
				$value,
				SUM(case when jenjang = 'EVP' THEN 1 ELSE 0 END) AS EVP,
				sum(case when jenjang = 'VP' THEN 1 ELSE 0 END) AS VP, 
				SUM(case when jenjang = 'AVP' THEN 1 ELSE 0 END) AS AVP, 
				SUM(case when jenjang = 'MGR' THEN 1 ELSE 0 END) AS MGR, 
				SUM(case when jenjang = 'AMGR' THEN 1 ELSE 0 END) AS AMGR, 
				SUM(case when jenjang = 'ASST' THEN 1 ELSE 0 END) AS ASST,
				SUM(case when jenjang = 'PGD' THEN 1 ELSE 0 END) AS PGD, 
				SUM(case when jenjang is null and a.person_id > 0  THEN 1 ELSE 0 END) AS nul, 
				SUM(case when a.course is null THEN 0 ELSE 1 END) AS Peg 
			from
				t_enrollment a
			join m_comp_realisasi b on a.course = b.subcourse_name
			left join m_biodata c on a.person_id = c.PERSON_ID
			where '2015-01-01' between start_date and end_date 
			or curdate() between start_date and end_date 
			or start_date BETWEEN '2015-01-01' and curdate() 
			or end_date BETWEEN '2015-01-01' and curdate()
			group by $value

		")->result();
	}
	
	function detailCentraDis(){
		// data tabel detail persebaran pealtihan
		return $this->db->query("
			select
				penyelenggara,
				case 
				when penyelenggara in ('WJB','WSY','WJY','WSM','WJK','WJS','WBJ','WBN','WPD') 
				THEN 'DESENTRALISASI' 
				ELSE 'SENTRALISASI' 
				END AS label,
				sum(enroll) as learner
			from
				realisasi
			where '2015-01-01' between start_date and end_date
			or curdate() between start_date and end_date
			or start_date BETWEEN '2015-01-01' and curdate()
			or end_date BETWEEN '2015-01-01' and curdate()
			group by penyelenggara
			order by label desc

		")->result();
	}
	
	function totalCourseLv1(){
		// menghitung total course lv.1
		return $this->db->query("
			
			select
				count(offering_id) as jml_course
			from
				m_course
			where level_course = 1

		")->result_array();
	}
	
	function totalPegTlatih(){
		// menghitung total course lv.1
		return $this->db->query("
						
			select
				count(distinct(person_id)) as terlatih
			from
				t_enrollment a
			where '2015-01-01' between a.start_date and a.end_date 
			or curdate() between a.start_date and a.end_date 
			or a.start_date BETWEEN '2015-01-01' and curdate() 
			or a.end_date BETWEEN '2015-01-01' and curdate()

		")->result_array();
	}
	
	function totalPeg(){
		// menghitung total course lv.1
		return $this->db->query("
			
			SELECT
				count(*) as peg
			from
				m_biodata
			where substr(npp,1,1)  in ('T','P','K','D','W')

		")->result_array();
	}
	
	
    function getRealisasiPel($start, $end, $value){
	// menghasilkan data report realiasasi pelatihan berdasarkan template dari pgk
		return $this->db->query(
		"
			select
				*
			from
				$value
			where '".$start."' between start_date and end_date
			or '".$end."' between start_date and end_date
			or start_date BETWEEN '".$start."' and '".$end."'
			or end_date BETWEEN '".$start."' and '".$end."'
			order by start_date desc

		"
		)->result();
    }
	
    function getRekapEvent($start, $end){
	// menghasilkan data report realiasasi pelatihan berdasarkan template dari pgk
		return $this->db->query(
		"
			select
				*
			from
				announcetv_frametext a
			left join m_classroom b on a.ROOM_ID = b.ROOM_ID
			left join m_room_location c on b.ROOM_LOCATION_ID = c.ROOM_LOCATION_ID
			where ('".$start."' between tglmulai and tglakhir
			or '".$end."' between tglmulai and tglakhir
			or tglmulai BETWEEN '".$start."' and '".$end."'
			or tglakhir BETWEEN '".$start."' and '".$end."')
			and active_flag = 0
			order by tglmulai
		"
		)->result();
    }
	
	function getJoinEventAbsenIns(){
	// mendapatkan data detail rembes
		$this->db->distinct();
		$this->db->order_by('tglmulai','desc');
		$this->db->select('training,tglmulai,tglakhir,a.frametext_id');
		$this->db->from('t_absensi_evaluasi_instruktur_materi a');
		$this->db->join('announcetv_frametext b', 'a.frametext_id = b.frametext_id');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function insAvg(){
		
		$this->db->order_by('instructor_name','asc');
		$this->db->group_by(array("instructor_name", "instructor_npp","instructor_id","instructor_type")); 
		$this->db->select_avg('ins');
		$this->db->select('instructor_name,instructor_npp,instructor_type,instructor_id');
		$this->db->from('v_eval_ins');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function getPresensiClass($frametext_id){
	// mendapatkan data detail rembes
		$this->db->where('frametext_id',$frametext_id);
		$this->db->order_by('instructor_name','asc');
		$this->db->order_by('nama','asc');
		$this->db->group_by(array("instructor_name", "module_name","npp","nama")); 
		$this->db->select('instructor_name,module_name,npp,nama');
		$this->db->from('v_absen_eval_ins');
		
		$query = $this->db->get();
		return $query->result();
	}
}