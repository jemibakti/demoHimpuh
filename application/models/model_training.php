<?php
if(!defined('BASEPATH'))exit('No Direct Access Script Allowed');
include_once('oracle_connection.php');
class Model_training extends CI_Model{
	protected $oradb;
    public function __construct(){
	    parent::__construct();
		$this->oradb = new Oracle_connection();
		$this->oradb->open_connection();
	}
	
	public function get_today_event(){
	    $this->db->select('announcetv_frametext.*,m_classroom.ROOM_NAME,m_classroom.ROOM_FLOOR,m_room_location.ROOM_LOCATION_NAME');
		$this->db->from('announcetv_frametext');
		$this->db->where("TGLMULAI <= curdate() AND TGLAKHIR >= curdate()");
		$this->db->where("ACTIVE_FLAG",0);
		$this->db->join('m_classroom','announcetv_frametext.ROOM_ID=m_classroom.ROOM_ID','left');
		$this->db->join('m_room_location','m_classroom.ROOM_LOCATION_ID=m_room_location.ROOM_LOCATION_ID','left');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_next_event(){
	    $this->db->select('announcetv_frametext.*,m_classroom.ROOM_NAME,m_classroom.ROOM_FLOOR,m_room_location.ROOM_LOCATION_NAME');
		$this->db->from('announcetv_frametext');
		$this->db->where("TGLMULAI > curdate()");
		$this->db->where("ACTIVE_FLAG",0);
		$this->db->join('m_classroom','announcetv_frametext.ROOM_ID=m_classroom.ROOM_ID','left');
		$this->db->join('m_room_location','m_classroom.ROOM_LOCATION_ID=m_room_location.ROOM_LOCATION_ID','left');
		$this->db->order_by("announcetv_frametext.FRAMETEXT_ID","desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_present_and_upcoming_event(){
	    $this->db->select('announcetv_frametext.*,m_classroom.ROOM_NAME,m_classroom.ROOM_FLOOR,m_room_location.ROOM_LOCATION_NAME');
		$this->db->from('announcetv_frametext');
		//$this->db->where("TGLAKHIR >= curdate()");
		$this->db->where("ACTIVE_FLAG",0);
		$this->db->join('m_classroom','announcetv_frametext.ROOM_ID=m_classroom.ROOM_ID','left');
		$this->db->join('m_room_location','m_classroom.ROOM_LOCATION_ID=m_room_location.ROOM_LOCATION_ID','left');
		$this->db->order_by("announcetv_frametext.FRAMETEXT_ID","desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_internal_instructor(){
	    $this->db->select('m_instructor.*,m_vendor.VENDOR_NAME');
		$this->db->from('m_instructor');
		$this->db->where("m_instructor.DATA_ACTIVEYN","Y");
		$this->db->where("LOWER(m_instructor.INSTRUCTOR_TYPE)","internal");
		$this->db->join('m_vendor','m_instructor.VENDOR_ID=m_vendor.VENDOR_ID','left');
		$this->db->order_by('m_instructor.INSTRUCTOR_ID','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_eksternal_instructor(){
	    $this->db->select('m_instructor.*,m_vendor.VENDOR_NAME');
		$this->db->from('m_instructor');
		$this->db->where("m_instructor.DATA_ACTIVEYN","Y");
		$this->db->where("LOWER(m_instructor.INSTRUCTOR_TYPE)","external");
		$this->db->join('m_vendor','m_instructor.VENDOR_ID=m_vendor.VENDOR_ID');
		$this->db->order_by('m_instructor.INSTRUCTOR_ID','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_detail_instructor($id){
	    $this->db->select('*');
		$this->db->from('m_instructor');
		$this->db->where("INSTRUCTOR_ID",$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_data_presensi_instruktur(){
	    $this->db->distinct();
	    $this->db->select('announcetv_frametext.TRAINING,announcetv_frametext.TGLMULAI,announcetv_frametext.TGLAKHIR,m_instructor.INSTRUCTOR_NAME,m_module.MODULE_NAME,TIMEDIFF( t_absen_instructor.jam_selesai,t_absen_instructor.jam_mulai ) AS jumlah_jam,m_instructor.INSTRUCTOR_TYPE,t_absen_instructor.t_absen_instructor_id');
	    $this->db->from('announcetv_frametext');
		$this->db->join('t_absen_instructor','announcetv_frametext.FRAMETEXT_ID=t_absen_instructor.frametext_id');
		$this->db->join('m_instructor','m_instructor.INSTRUCTOR_ID=t_absen_instructor.m_instructor_id');
		$this->db->join('m_module','m_module.MODULE_ID=t_absen_instructor.m_module_id');
		$this->db->order_by('t_absen_instructor.t_absen_instructor_ID','desc');
		$this->db->where("t_absen_instructor.CREATE_DATE = curdate()");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_data_kelas(){
	    $this->db->select('*');
		$this->db->from('announcetv_frametext');
		$this->db->where('ACTIVE_FLAG = 0 and TGLMULAI <= curdate() AND TGLAKHIR >= curdate() OR JUMLAH_PESERTA = 1 ');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_data_kelas_all(){
	    $this->db->select('*');
		$this->db->from('announcetv_frametext');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_data_materi(){
	    $this->db->select('*');
		$this->db->from('m_module');
		$this->db->where("DATA_ACTIVEYN","Y");
		$this->db->order_by("MODULE_ID","desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_data_presensi($id_instruktur,$id_kelas,$id_materi){
	    $this->db->set('m_instructor_id',$id_instruktur);
		$this->db->set('m_module_id',$id_materi);
		$this->db->set('frametext_id',$id_kelas);
		$this->db->set('create_date','curdate()',false);
		$this->db->insert('t_absen_instructor');
	}
	
	public function get_detail_presensi($id){
	    $this->db->distinct();
	    $this->db->select('announcetv_frametext.TRAINING,m_instructor.INSTRUCTOR_NAME,m_instructor.INSTRUCTOR_NPP,m_instructor.VENDOR_ID,m_module.MODULE_NAME,TIMEDIFF( t_absen_instructor.jam_mulai,t_absen_instructor.jam_selesai ) AS jumlah_jam,m_instructor.INSTRUCTOR_TYPE,t_absen_instructor.*');
	    $this->db->from('announcetv_frametext');
		$this->db->join('t_absen_instructor','announcetv_frametext.FRAMETEXT_ID=t_absen_instructor.frametext_id');
		$this->db->join('m_instructor','m_instructor.INSTRUCTOR_ID=t_absen_instructor.m_instructor_id');
		$this->db->join('m_module','m_module.MODULE_ID=t_absen_instructor.m_module_id');
		$this->db->where("t_absen_instructor.t_absen_instructor_id",$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_data_presensi($id,$instruktur,$kelas,$materi,$start,$end){
	    $data = array('m_instructor_id'=>$instruktur,'frametext_id'=>$kelas,'m_module_id'=>$materi,'jam_mulai'=>$start,'jam_selesai'=>$end);
		$this->db->where('t_absen_instructor_id',$id);
		$this->db->update('t_absen_instructor',$data);
	}
	
	public function add_internal_instructor($npp,$nama,$tmpLahir,$tglLahir,$alamat){
	    $this->db->set('INSTRUCTOR_NPP',$npp);
		$this->db->set('INSTRUCTOR_TYPE','Internal');
		$this->db->set('DATA_ACTIVEYN','Y');
		$this->db->set('INSTRUCTOR_NAME',strtoupper($nama));
		$this->db->set('TEMPAT_LAHIR',strtoupper($tmpLahir));
		$this->db->set('TANGGAL_LAHIR',$tglLahir);
		$this->db->set('INSTRUCTOR_ADDRESS',$alamat);
		$this->db->set('CREATED_DATE','curdate()',false);
		#kedepannya perlu ditambah session bwt kolom CREATE_BY
		$this->db->insert('m_instructor');
	}
	
	public function add_eksternal_instructor($id_vendor,$nama,$tmpLahir,$tglLahir,$alamat){
	    $this->db->set('VENDOR_ID',$id_vendor);
		$this->db->set('INSTRUCTOR_TYPE','External');
		$this->db->set('DATA_ACTIVEYN','Y');
		$this->db->set('INSTRUCTOR_NAME',strtoupper($nama));
		$this->db->set('TEMPAT_LAHIR',strtoupper($tmpLahir));
		$this->db->set('TANGGAL_LAHIR',$tglLahir);
		$this->db->set('INSTRUCTOR_ADDRESS',$alamat);
		$this->db->set('CREATED_DATE','curdate()',false);
		#kedepannya perlu ditambah session bwt kolom CREATE_BY
		$this->db->insert('m_instructor');
	}
	
	public function update_internal_instruktur($id,$npp,$nama,$tmpLahir,$tglLahir,$alamat){
	    $data = array('INSTRUCTOR_NPP'=>$npp,'INSTRUCTOR_NAME'=>$nama,'TEMPAT_LAHIR'=>$tmpLahir,'TANGGAL_LAHIR'=>$tglLahir,'INSTRUCTOR_ADDRESS'=>$alamat);
		$this->db->where('INSTRUCTOR_ID',$id);
		$this->db->update('m_instructor',$data);
	}
	
	public function update_eksternal_instruktur($id,$id_vendor,$nama,$tmpLahir,$tglLahir,$alamat){
	    $data = array('VENDOR_ID'=>$id_vendor,'INSTRUCTOR_NAME'=>$nama,'TEMPAT_LAHIR'=>$tmpLahir,'TANGGAL_LAHIR'=>$tglLahir,'INSTRUCTOR_ADDRESS'=>$alamat);
		$this->db->where('INSTRUCTOR_ID',$id);
		$this->db->update('m_instructor',$data);
	}
	
	public function delete_instruktur($id){
	    $data = array('DATA_ACTIVEYN'=>'N');
		$this->db->where('INSTRUCTOR_ID',$id);
		$this->db->update('m_instructor',$data);
	}
	
	public function get_room(){
		$this->db->select('m_classroom.*,m_room_location.ROOM_LOCATION_NAME');
		$this->db->from('m_classroom');
		$this->db->join('m_room_location','m_classroom.ROOM_LOCATION_ID=m_room_location.ROOM_LOCATION_ID');
		$this->db->where("UPPER(m_classroom.DATA_ACTIVEYN) = 'Y' AND UPPER(m_room_location.DATA_ACTIVEYN) = 'Y'");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_event($tipe,$training,$tglawal,$tglakhir,$jml,$room){
		//insert ke oracle
		$this->add_event_oracle($tipe,$training,$tglawal,$tglakhir,$jml,$room);
		//insert ke mysql
		$this->db->set('TRAINING',$training);
		$this->db->set('TGLMULAI',$tglawal);
		$this->db->set('TGLAKHIR',$tglakhir);
		$this->db->set('IPADDRESS',$_SERVER['REMOTE_ADDR']);
		if(intval($tipe) == 1)
			$this->db->set('ROOM_ID',$room);
		elseif(intval($tipe) == 2)
			$this->db->set('LOKASI',$room);
		$this->db->set('TOTAL_LEARNER',$jml);
		$this->db->set('CREATED_DATE','curdate()',false);
		$this->db->insert('announcetv_frametext');
	}
	
	public function add_event_oracle($tipe,$training,$tglawal,$tglakhir,$jml,$room){
		if(intval($tipe) == 1){
		    $q = $this->oradb->ora->prepare("INSERT INTO LMSUSER.ANNOUNCETV_FRAMETEXT (FRAMETEXT_ID,TRAINING,TGLMULAI,TGLAKHIR,IPADDRESS,ROOM_ID,TOTAL_LEARNER) VALUES (FRAMETEXT_SEQ.NEXTVAL,:training,TO_DATE(:tglawal,:format),TO_DATE(:tglakhir,:format),:ip,:room,:jml)");
		}elseif(intval($tipe) == 2){
			$q = $this->oradb->ora->prepare("INSERT INTO LMSUSER.ANNOUNCETV_FRAMETEXT (FRAMETEXT_ID,TRAINING,TGLMULAI,TGLAKHIR,IPADDRESS,LOKASI,TOTAL_LEARNER) VALUES (FRAMETEXT_SEQ.NEXTVAL,:training,TO_DATE(:tglawal,:format),TO_DATE(:tglakhir,:format),:ip,:room,:jml)");
		}
		$format = 'yyyy-mm-dd';
		$q->bindParam(':training',$training);
		$q->bindParam(':tglawal',$tglawal);
		$q->bindParam(':format',$format);
		$q->bindParam(':tglakhir',$tglakhir);
		$q->bindParam(':ip',$_SERVER['REMOTE_ADDR']);
		$q->bindParam(':room',$room);
		$q->bindParam(':jml',$jml);
		$q->execute();
		//print_r($this->oradb->ora->errorInfo());
		//die();
	}
	
	public function hapus_event($id){
		//Delete oracle
		$q = $this->oradb->ora->prepare("UPDATE LMSUSER.ANNOUNCETV_FRAMETEXT SET DATA_ACTIVEYN = 'N' WHERE FRAMETEXT_ID = ?");
		$q->execute(array($id));
		//Delete mysql
		$data = array('ACTIVE_FLAG'=>'1');
		$this->db->where('FRAMETEXT_ID',$id);
		$this->db->update('announcetv_frametext',$data);
	}
	
	public function edit_event($tipe,$id,$event,$tglmulai,$tglselesai,$room_id,$jml){
		//Update oracle
		$format = 'yyyy-mm-dd';
		if(intval($tipe) == 1){
		    $q = $this->oradb->ora->prepare("UPDATE LMSUSER.ANNOUNCETV_FRAMETEXT SET TRAINING = :training,TGLMULAI = TO_DATE(:tglmulai,:format),TGLAKHIR = TO_DATE(:tglselesai,:format),ROOM_ID = :room,LOKASI = NULL,TOTAL_LEARNER = :jml WHERE FRAMETEXT_ID = :id");
		    //data untuk mysql
		    $data = array('TRAINING'=>$event,'TGLMULAI'=>$tglmulai,'TGLAKHIR'=>$tglselesai,'ROOM_ID'=>$room_id,'TOTAL_LEARNER'=>$jml);
		}elseif(intval($tipe) == 2){
			$q = $this->oradb->ora->prepare("UPDATE LMSUSER.ANNOUNCETV_FRAMETEXT SET TRAINING = :training,TGLMULAI = TO_DATE(:tglmulai,:format),TGLAKHIR = TO_DATE(:tglselesai,:format),LOKASI = :room,ROOM_ID = NULL,TOTAL_LEARNER = :jml WHERE FRAMETEXT_ID = :id");
			//data untuk mysql
		    $data = array('TRAINING'=>$event,'TGLMULAI'=>$tglmulai,'TGLAKHIR'=>$tglselesai,'LOKASI'=>$room_id,'TOTAL_LEARNER'=>$jml);
		}
		$q->bindParam(':training',$event);
		$q->bindParam(':tglmulai',$tglmulai);
		$q->bindParam(':tglselesai',$tglselesai);
		$q->bindParam(':room',$room_id);
		$q->bindParam(':jml',$jml);
		$q->bindParam(':format',$format);
		$q->bindParam(':id',$id);
		$q->execute();
		//Update mysql
		$this->db->where('FRAMETEXT_ID',$id);
		$this->db->update('announcetv_frametext',$data);
	}
	
	public function detail_event($id){
		$this->db->select('announcetv_frametext.*,m_classroom.ROOM_NAME,m_classroom.ROOM_FLOOR,m_room_location.ROOM_LOCATION_NAME');
		$this->db->from('announcetv_frametext');
		$this->db->where("FRAMETEXT_ID",$id);
		$this->db->join('m_classroom','announcetv_frametext.ROOM_ID=m_classroom.ROOM_ID','left');
		$this->db->join('m_room_location','m_classroom.ROOM_LOCATION_ID=m_room_location.ROOM_LOCATION_ID','left');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function vendor(){
		$this->db->select('*');
		$this->db->from('m_vendor');
		$this->db->where('DATA_ACTIVEYN','Y');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_module($name){
		$this->db->set('MODULE_NAME',$name);
		$this->db->set('CREATED_USER',$_SERVER['REMOTE_ADDR']);
		$this->db->set('CREATED_DATE','curdate()',false);
		$this->db->insert('m_module');
	}
	
	public function detail_module($id){
		$this->db->select('*');
		$this->db->from('m_module');
		$this->db->where('MODULE_ID',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function edit_module($id,$name){
		$data = array('MODULE_NAME'=>$name);
		$this->db->where('MODULE_ID',$id);
		$this->db->update('m_module',$data);
	}
	
	public function delete_module($id){
		$data = array('DATA_ACTIVEYN'=>'Y');
		$this->db->where('MODULE_ID',$id);
		$this->db->update('m_module',$data);
	}
	
	public function get_all_absen_instructor(){
		$this->db->select('announcetv_frametext.TRAINING, announcetv_frametext.TGLMULAI, announcetv_frametext.TGLAKHIR, m_instructor.INSTRUCTOR_NAME, m_module.MODULE_NAME,t_absen_instructor.t_absen_instructor_id');
		$this->db->from('t_absen_instructor');
		$this->db->join('announcetv_frametext','announcetv_frametext.FRAMETEXT_ID = t_absen_instructor.frametext_id');
		$this->db->join('m_instructor','m_instructor.INSTRUCTOR_ID = t_absen_instructor.m_instructor_id');
		$this->db->join('m_module','m_module.MODULE_ID = t_absen_instructor.m_module_id');
		$this->db->order_by("t_absen_instructor_id","desc");
		$query = $this->db->get();
		return $query->result_array();
	}
}