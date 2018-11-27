<?php
class Ajax extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')){
			$this->load->model('Model_dop');
		}else{
			redirect("login");
		}
		
    }
	function update_anggaran(){
		$id = $this->input->post('id');
		$data = $this->Model_dop->get_table_where_array('m_company','id',$id);
		$status = $data[0]['company_anggaran'];
		if($status == 0){
			$flag = 1;
		}else{
			$flag = 0;
		}
		$update=array(
			'company_anggaran'=> $flag
		);
		$this->Model_dop->update_table('m_company',$update,'id',$id);
		$data=array(
			'flag'=>$flag
		);
		echo json_encode($data);
	}
	function update_invitation(){
		$id = $this->input->post('id');
		$data = $this->Model_dop->get_table_where_array('m_pegawai','id',$id);
		$status = $data[0]['flag_undangan'];
		if($status == 0){
			$flag = 1;
		}else{
			$flag = 0;
		}
		$update=array(
			'flag_undangan'=> $flag
		);
		$this->Model_dop->update_table('m_pegawai',$update,'id',$id);
		$data=array(
			'flag'=>$flag
		);
		echo json_encode($data);
	}
	function get_ajax($table){
		$id = $this->input->post('id');
		$data = $this->Model_dop->get_table_where($table,'id',$id);
		header('Content-Type: application/json');
		if($data){
			echo json_encode($data);
		}else{
			$data = 'kosong';
			echo json_encode($data);
		}
	}
	function get_company(){
		$id = $this->input->post('id');
		$data = $this->Model_dop->get_table_where('m_company','id',$id);
		header('Content-Type: application/json');
		if($data){
			echo json_encode($data);
		}else{
			$data = 'kosong';
			echo json_encode($data);
		}
	}
		
	function last_surat_reg(){
		$jenis = $this->input->post('jenis');
		$where =array(
			array('kolom'=>'active_flag','value'=>'0'),
			array('kolom'=>'surat_jenis','value'=>$jenis)
		);
		$data= $this->Model_dop->global_model('m_surat','max(surat_reg)+1 as reg',$where,false,false,false,false,false,false);
		header('Content-Type: application/json');
		if($data){
			echo json_encode($data);
		}else{
			$data = 'kosong';
			echo json_encode($data);
		}
	}
	
	function get_pegawai(){
		$id = $this->input->post('id');
		
		$where =array(
			array('kolom'=>'a.active_flag','value'=>'0'),
			array('kolom'=>'a.id','value'=>$id)
		);
		
		$join =array(
			array('table'=>'m_company b','on'=>'a.id_company=b.id','type'=>'inner')
		);
		
		$data= $this->Model_dop->global_model('m_pegawai a',false,$where,$join,false,false,false,false,false);
		header('Content-Type: application/json');
		if($data){
			echo json_encode($data);
		}else{
			$data = 'kosong';
			echo json_encode($data);
		}
	}
	
	function update_flag_in(){
	
		date_default_timezone_set('Asia/Jakarta');
		
		$id = $this->input->post('id');
		$where =array(
			array('kolom'=>'id_pegawai','value'=>$id),
			array('kolom'=>'date(absen_masuk)','value'=>date('Y-m-d')),
			array('kolom'=>'id_acara','value'=>$this->session->userdata('event')['id_event'])
		);
		$cek= $this->Model_dop->global_model_array('t_absen',false,$where,false,false,false,false,false,false);
		if($cek){
			$data['flag'] = 1;
		}else{
			$insert=array(
						'absen_masuk'=>date('Y-m-d H:i:s'),
						'id_pegawai'=>$id,
						'id_acara'=>$this->session->userdata('event')['id_event'],
						'create_by'=>$this->session->userdata('logged_in')['username']
					);
				$this->Model_dop->insert_table('t_absen',$insert);
				$data=array(
					'flag'=>0
				);
			$update=array(
				'flag_in'=> '1',
				'update_by'=> $this->session->userdata('logged_in')['username'],
				'update_date'=>date('Y-m-d')
			);
			$this->Model_dop->update_table('m_pegawai',$update,'id',$id);
		}
		$update=array(
			'flag_in'=> '1'
		);
		$this->Model_dop->update_table('m_pegawai',$update,'id',$id);
		echo json_encode($data);
	}
	function update_flag_in_musy1($ms_id){
	
		date_default_timezone_set('Asia/Jakarta');
		
		$id = $this->input->post('id');
		$where =array(
			array('kolom'=>'id_pegawai','value'=>$id),
			array('kolom'=>'date(absen_masuk)','value'=>date('Y-m-d')),
			array('kolom'=>'id_acara','value'=>$this->session->userdata('event')['id_event'])
		);
		$cek= $this->Model_dop->global_model_array('t_absen',false,$where,false,false,false,false,false,false);
		
		if($cek){
			if($cek[0]['flag_musy'.$ms_id] == '1'){
				$data['flag'] = 2;
			}else{
				$update=array(
					'flag_musy'.$ms_id=> '1',
					'musy_'.$ms_id=>date('Y-m-d H:i:s'),
					'update_by'=> $this->session->userdata('logged_in')['username'],
					'update_date'=>date('Y-m-d')
				);
				$this->Model_dop->update_table('t_absen',$update,'id',$cek[0]['id']);
				$data['flag'] = 0;
			}
		}else{
			$data['flag'] = 1;
		}
		
		echo json_encode($data);
	}
	function cekout(){
	
		date_default_timezone_set('Asia/Jakarta');
		
		$id = $this->input->post('id');
		$where =array(
			array('kolom'=>'id_pegawai','value'=>$id),
			array('kolom'=>'date(absen_masuk)','value'=>date('Y-m-d')),
			array('kolom'=>'id_acara','value'=>$this->session->userdata('event')['id_event'])
		);
		$cek= $this->Model_dop->global_model_array('t_absen',false,$where,false,false,false,false,false,false);
		
		if($cek){
			if($cek[0]['flag_absen'] == '1'){
				$data['flag'] = 2;
			}else{
				$update=array(
					'flag_absen'=> '1',
					'absen_keluar'=>date('Y-m-d H:i:s'),
					'update_by'=> $this->session->userdata('logged_in')['username'],
					'update_date'=>date('Y-m-d')
				);
				$this->Model_dop->update_table('t_absen',$update,'id',$cek[0]['id']);
				$data['flag'] = 0;
			}
		}else{
			$data['flag'] = 1;
		}
		
		echo json_encode($data);
	}
	
}
