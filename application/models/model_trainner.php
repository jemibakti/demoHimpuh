<?php

class Model_trainner extends CI_Model{
	
	protected $tableName = "kata";
	
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
				a.frametext_id
			from
				announcetv_frametext a
			join t_absen_instructor b on a.frametext_id = b.FRAMETEXT_ID
			order by tglmulai desc
		"
		)->result();
    }
    function getDataClass($frame_id){
	// mendapatkan detail pengajar, modul, serta total biaya pembayaran instruktur dalam satu kelas
		return $this->db->query("
			select
				a.*,
				b.training,
				b.TGLMULAI,
				b.TGLAKHIR,
				e.nama,
				e.npp,
				e.jenjang,
				d.MODULE_NAME,
				a.jam_selesai,
				a.jam_mulai,
				a.create_date,
				timediff(a.jam_selesai,a.jam_mulai) as waktu,
				f.nilai
			from
				t_absen_instructor a
			join announcetv_frametext b on a.frametext_id = b.FRAMETEXT_ID
			join m_instructor c on c.INSTRUCTOR_ID = a.m_instructor_id
			join m_module d on d.module_id = a.m_module_id
			left join m_biodata e on substr(e.NPP,-5) = substr(c.INSTRUCTOR_NPP,-5)
			join M_TARIF_DOP F ON F.JENJANG = E.JENJANG AND F.JENIS = 'MENGAJAR'
			where a.frametext_id = '".$frame_id."'
		"
		)->result();
    }
	function getJoinPembayaranIns($frame_id){
	// mendapatkan data pembayaran yang telah diinput
		return $this->db->query("
			SELECT
				a.frametext_id,
				a.module_id,
				a.instructor_id,
				d.training,
				d.TGLMULAI,
				d.TGLAKHIR,
				e.nama,
				e.npp,
				e.JENJANG,
				c.MODULE_NAME,
				e.EMAIL,
				g.account_rekening,
				g.account_name,
				e.no_rek,
				sum(a.waktu) as waktu,
				sum(a.fee) as fee,
				count(*) as jmlh_mengajar
			FROM
				t_pembayaran_ins a
			join m_instructor b on a.instructor_id = b.INSTRUCTOR_ID
			join m_module c on c.MODULE_ID = a.module_id
			join announcetv_frametext d on a.frametext_id = d.FRAMETEXT_ID
			left join t_event f on f.class_name = d.training
			left join m_course h on h.course_title = f.course_name
			left join m_account g on g.account_id = h.account_id
			join m_biodata e on substr(e.NPP,-5) = substr(b.INSTRUCTOR_NPP,-5)
			where a.frametext_id = '".$frame_id."'
			group by
				a.frametext_id,
				a.module_id,
				a.instructor_id,
				d.training,
				d.TGLMULAI,
				d.TGLAKHIR,
				e.nama,
				e.npp,
				e.JENJANG,
				c.MODULE_NAME,
				e.EMAIL,
				g.account_rekening,
				g.account_name,
				e.no_rek
		"
		)->result();
	}
}