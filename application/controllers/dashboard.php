<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->model('Model_wiki');
        $this->load->model('model_rembes');
		$this->load->library('form_validation');   
    }
	// function untuk mengubah flag aktif pada suatu record
	function global_delete($table,$key,$value,$direct){
        $this->Model_dop->delete_update_rec($table,$key,$value);
		$direct_ = str_replace("_uri_","/",$direct);
        redirect($direct_);
	}
	// function untuk menampilkan halaman login
	function index(){
		$allert = $this->uri->segment(3);
        $data=array(
            'title'=>'Login',
			'allert'=>$allert
        );
        $this->load->view('wiki/login',$data);
    }
	// function untuk mengecek data login
	function cek_login(){
	   $username = $this->input->post('username');
	   $password = MD5($this->input->post('password'));
	   $result = $this->Model_wiki->login($username,$password);
		if($result){
			$sess_array = array();
			$sess_array = array(
				'username' => $result[0]['username'],
				'nama' => $result[0]['nama'],
				'id' => $result[0]['id'],
				'user_level' => $result[0]['user_level']
			);
			$this->session->set_userdata('logged_in', $sess_array);

			$update=array(
				'active_flag'=> '1',
				'update_date'=>date('Y-m-d')
			);

			$this->Model_dop->update_table('m_user',$update,'id',$result[0]['id']);
			redirect("dashboard/welcome_user");
		}else{
			redirect("dashboard/index/1");
		}
	}
	// function untuk menghapus session user / log out
	function logout(){
		
		$session_data = $this->session->userdata('logged_in');
		
		// debug($session_data);
		$update=array(
		'active_flag'=> '0',
		'update_date'=>date('Y-m-d')
		);
		$this->Model_dop->update_table('m_user',$update,'id',$session_data['id']);
		
		$sess_array = array(
			 'user_name' => '',
			 'nama' => '',
			 'user_level' => ''
		);
		$this->session->set_userdata('logged_in', $sess_array);
		
		redirect('dashboard');
	}
	// function untuk menampilkan halaman welcome user(halaman setela login)
	function welcome_user($allert=null,$note=null){
		$session_data = $this->session->userdata('logged_in');
		$username = $session_data['username'];
		$nama = $session_data['nama'];
		$user_level = $session_data['user_level'];
		if($username){
		
			$data['user'] = $username;
			$data['nama'] = $nama;
			$data['perusahaan'] = $this->Model_dop->get_table_where_order('m_company','active_flag','0','company_name','asc');
			$th = date('Y') - 3;
			$tgl_exp = date('m-d');
			
			$where =array(
				array('kolom'=>'pihk_group','value'=>'1'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
			$data['ppiu'] = $this->Model_dop->global_model('m_company',false,$where,false,false,$order,false,false,false);
			
			$where =array(
				array('kolom'=>'tgl_sk <=','value'=>$th.$tgl_exp),
				array('kolom'=>'tgl_sk !=','value'=>'000-00-00'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$order =array(
				array('kolom'=>'tgl_sk','value'=>'asc')
			);
			$data['expired_sk'] = $this->Model_dop->global_model('m_company',false,$where,false,false,$order,false,false,false);
			
			$where =array(
				array('kolom'=>'tgl_sk_umroh <=','value'=>$th.$tgl_exp),
				array('kolom'=>'tgl_sk_umroh !=','value'=>'000-00-00'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$order =array(
				array('kolom'=>'tgl_sk_umroh','value'=>'asc')
			);
			$data['expired_umrah'] = $this->Model_dop->global_model('m_company',false,$where,false,false,$order,false,false,false);
			$where =array(
				array('kolom'=>'company_anggaran','value'=>'0'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
			//data provider visa
			$data['iuran'] = $this->Model_dop->global_model('m_company',false,$where,false,false,$order,false,false,false);$where =array(
				array('kolom'=>'provider_visa','value'=>'1'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$data['visa'] = $this->Model_dop->global_model('m_company',false,$where,false,false,False,false,false,false);
			// -- 
			// debug($data);
			$this->load->view('element/v_header_style',$data);
			$this->load->view('wiki/welcome_user');
			$this->load->view('element/v_footer_style');
		}else{
			redirect("dashboard/index");
		}
	}
	// function untuk menampilkan data perusahaan berdasarkan jenis data yang dipilik
	// 1 = belum bayar iuran
	// 2 = expired_sk
	// 3 = ppiu
	function data_perusahaan($jenis,$exp=null){
		if($jenis == 1){
			$data['title'] = '(Monitoring Iuran)';
			$where =array(
				array('kolom'=>'company_anggaran','value'=>'0'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
		}else if($jenis == 2){
		
			$data['title'] = '(Monitoring SK Expired)';
			$th = date('Y') - 3;
			$tgl_exp = date('m-d');
			$where =array(
				array('kolom'=>'tgl_sk <=','value'=>$th.$tgl_exp),
				array('kolom'=>'tgl_sk !=','value'=>'000-00-00'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$order =array(
				array('kolom'=>'tgl_sk','value'=>'asc')
			);
		}else if($jenis == 0){
		
			$data['title'] = '(Monitoring Provider Visa)';
			$where =array(
				array('kolom'=>'provider_visa','value'=>'1'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
		}else if($jenis == 3){
		
			$data['title'] = '(PPIU)';
			$where =array(
				array('kolom'=>'pihk_group','value'=>'1'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
		}else if($jenis == 5){
		
			$data['title'] = '(PIHK)';
			$where =array(
				array('kolom'=>'pihk_group','value'=>'0'),
				array('kolom'=>'active_flag','value'=>'0')
			);
			
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
			
		}else{
			
			$data['title'] = '';
			$where =array(
				array('kolom'=>'active_flag','value'=>'0')
			);
			
			$order =array(
				array('kolom'=>'company_name','value'=>'asc')
			);
		}
		$data['jenis'] = $jenis;
		$data['data_grid'] = $this->Model_dop->global_model('m_company',false,$where,false,false,$order,false,false,false);	
		$data['delete'] = 'dashboard/global_delete/m_company/id';
		
		$this->load->view('element/v_header_style',$data);
		$this->load->view('master/m_company');
		$this->load->view('element/v_footer_style');	
	}
	// function untuk menampilkan data grid pegawai aktif
	function data_pegawai($exp=null){
	
		$where =array(
			array('kolom'=>'a.active_flag','value'=>'0'),
			array('kolom'=>'a.flag_undangan','value'=>'1'),
			array('kolom'=>'b.active_flag','value'=>'0')
		);
		
		$join =array(
			array('table'=>'m_company b','on'=>'a.id_company=b.id','type'=>'inner')
		);
		$order =array(
			array('kolom'=>'b.company_name','value'=>'asc'),
			array('kolom'=>'a.pegawai_name','value'=>'asc')
		);
		
		$data['data_grid'] = $this->Model_dop->global_model('m_pegawai a','a.*,company_name,company_email',$where,$join,false,$order,false,false,false);
		$data['company'] = $this->Model_dop->get_table_where_order('m_company','active_flag','0','company_name','asc');
		$data['delete'] = 'dashboard/global_delete/m_pegawai/id';
		if($exp){
			$data['filename'] = 'Data Peserta Mubes';
			$this->load->view('element/head_excell',$data);		
			$this->load->view('master/m_pegawai');
		}else{
			$this->load->view('element/v_header_style',$data);
			$this->load->view('master/m_pegawai');
			$this->load->view('element/v_footer_style');		
		}
	}
	// function untuk menginsert data pegawai yang diinput
	function upload_file($folder){
	
		$config['upload_path'] = './upload/'.$folder;
		$config['overwrite'] = false;
		$config['allowed_types'] = 'jpg|png|gif|pdf|ppt|pptx|doc|docx';
		$this->load->library('upload', $config);
		$file = '';
		
		if ( ! $this->upload->do_upload("file_1")) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$uploaded_file = $this->upload->data();
			$file = str_replace(' ','',$uploaded_file['file_name']);
		}
		$direct = $this->input->post('direct');
		$data=array(
			'file'=> $file,
			'update_date'=>date('Y-m-d'),
			'update_by'=> $this->session->userdata('logged_in')['username']
		);
		// debug($data);
		$this->Model_dop->update_table('m_event',$data,'id',$this->input->post('id_file'));
		redirect("dashboard/".$direct);
	}
	function input_pegawai(){
	
		$config['upload_path'] = './upload/foto';
		$config['overwrite'] = false;
		$config['allowed_types'] = 'jpg|png|gif|pdf';
		$this->load->library('upload', $config);
		$foto = '';
		
		if ( ! $this->upload->do_upload("file_1")) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$uploaded_file = $this->upload->data();
			$foto = str_replace(' ','',$uploaded_file['file_name']);
		}
		
		$data=array(
			'pegawai_name'=> trim($this->input->post('pegawai_name')),
			'id_company'=>$this->input->post('id_company'),
			'pegawai_jabatan'=>trim($this->input->post('pegawai_jabatan')),
			'pegawai_email'=>trim($this->input->post('pegawai_email')),
			'pegawai_kontak'=>$this->input->post('pegawai_kontak'),
			'pegawai_keterangan'=>$this->input->post('pegawai_keterangan'),
			'create_date'=>date('Y-m-d'),
			'create_by'=> $this->session->userdata('logged_in')['username'],
			'pegawai_pic'=>$foto
		);
		
		$this->Model_dop->insert_table('m_pegawai',$data);
		redirect("dashboard/detail_company/".$this->input->post('id_company'));
	}
	// function untuk mengupdate record data pegawai
	function update_pegawai(){
	
		$config['upload_path'] = './upload/foto';
		$config['overwrite'] = false;
		$config['allowed_types'] = 'jpg|png|gif|pdf';
		$this->load->library('upload', $config);
		$foto = '';
		// debug($this->input->post());
		if ( ! $this->upload->do_upload("file_1")) {
			$error = array('error' => $this->upload->display_errors());
			debug($error);
		} else {
			$uploaded_file = $this->upload->data();
			$foto = str_replace(' ','',$uploaded_file['file_name']);
		}
		if($foto){
			// echo 'ok';exit;
			$data=array(
				'pegawai_pic'=>$foto
			);
			$this->Model_dop->update_table('m_pegawai',$data,'id',$this->input->post('id_peg'));
			
		}
		// debug($this->input->post());
		$data=array(
			'pegawai_name'=> trim($this->input->post('pegawai_name')),
			'id_company'=>$this->input->post('id_company'),
			'pegawai_jabatan'=>trim($this->input->post('pegawai_jabatan')),
			'pegawai_kontak'=>$this->input->post('pegawai_kontak'),
			'pegawai_keterangan'=>$this->input->post('pegawai_keterangan'),
			'pegawai_email'=>trim($this->input->post('pegawai_email')),
			'update_date'=>date('Y-m-d'),
			'update_by'=>$this->session->userdata('logged_in')['username']
		);
		// debug($data);
		$this->Model_dop->update_table('m_pegawai',$data,'id',$this->input->post('id_peg'));
		redirect("dashboard/detail_company/".$this->input->post('id_company'));
	}
	// function untuk menginput record data perusahan
	function input_company(){
		// debug($this->input->post());
		$gedung = upload("file_2",'./upload/company',false);
		$company = upload("file_1",'./upload/company',false);
		$stempel = upload("file_3",'./upload/company',false);
		$ttd = upload("file_4",'./upload/company',false);
		
		$qr_id1 = rand().str_replace(' ','_',$this->input->post('company_reg'));
		$qr_id = str_replace('/','-',$qr_id1);
		$data=array(
			'company_name'=> trim($this->input->post('company_name')),
			'company_brand'=> trim($this->input->post('company_brand')),
			'company_reg'=> trim($this->input->post('company_reg')),
			'company_web'=> trim($this->input->post('company_web')),
			'kota'=> trim($this->input->post('kota')),
			'pin_siskohat'=> trim($this->input->post('pin_siskohat')),
			'pin_muassasah'=> trim($this->input->post('pin_muassasah')),
			'company_email'=> trim($this->input->post('company_email')),
			'provider_visa'=> trim($this->input->post('provider_visa')),
			'nama_provider'=> trim($this->input->post('nama_provider')),
			'kode_pos'=> trim($this->input->post('kode_pos')),
			'fax'=> trim($this->input->post('fax')),
			'tgl_sk_umroh'=> trim($this->input->post('tgl_sk_umroh')),
			'sk_umroh'=> trim($this->input->post('sk_umroh')),
			'company_addres'=>$this->input->post('company_addres'),
			'company_sk'=>trim($this->input->post('company_sk')),
			'tgl_sk'=>$this->input->post('tgl_sk'),
			'pihk_group'=>$this->input->post('pihk_group'),
			'company_anggaran'=>trim($this->input->post('company_anggaran')),
			'company_contact'=>$this->input->post('company_contact'),
			'company_building'=>$gedung,
			'company_pic'=>$company,
			'company_ttd'=>$ttd,
			'company_stempel'=>$stempel,
			'create_by'=> $this->session->userdata('logged_in')['username'],
			'qr_id'=>$qr_id
		);
		$this->Model_dop->insert_table('M_COMPANY',$data);
		
		redirect("dashboard/data_perusahaan/4");
	}
	// function untuk mengupdate record data perusahaan
	function update_company(){
	
		$config['upload_path'] = './upload/company';
		$config['overwrite'] = false;
		$config['allowed_types'] = 'jpg|png|gif|pdf';
		$this->load->library('upload', $config);
		$foto = '';
		
		if ( ! $this->upload->do_upload("file_1")) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$uploaded_file = $this->upload->data();
			$foto = str_replace(' ','',$uploaded_file['file_name']);
		}
		$data=array(
			
			'company_name'=> trim($this->input->post('company_name')),
			'company_brand'=> trim($this->input->post('company_brand')),
			'company_reg'=> trim($this->input->post('company_reg')),
			'company_web'=> trim($this->input->post('company_web')),
			'kota'=> trim($this->input->post('kota')),
			'pin_siskohat'=> trim($this->input->post('pin_siskohat')),
			'pin_muassasah'=> trim($this->input->post('pin_muassasah')),
			'company_email'=> trim($this->input->post('company_email')),
			'provider_visa'=> trim($this->input->post('provider_visa')),
			'nama_provider'=> trim($this->input->post('nama_provider')),
			'kode_pos'=> trim($this->input->post('kode_pos')),
			'fax'=> trim($this->input->post('fax')),
			'tgl_sk_umroh'=> trim($this->input->post('tgl_sk_umroh')),
			'sk_umroh'=> trim($this->input->post('sk_umroh')),
			'company_addres'=>$this->input->post('company_addres'),
			'company_sk'=>trim($this->input->post('company_sk')),
			'tgl_sk'=>$this->input->post('tgl_sk'),
			'pihk_group'=>$this->input->post('pihk_group'),
			'company_anggaran'=>trim($this->input->post('company_anggaran')),
			'company_contact'=>$this->input->post('company_contact')
		);
		$this->Model_dop->update_table('M_COMPANY',$data,'id',$this->input->post('id_com'));
		// debug($data);
		redirect("dashboard/data_perusahaan/".$this->input->post('jenis').'/4');
	}
	// funtion untuk menampilkan data hasil scan barcode
	function input_data($get=null){
		$id = $get ? $get : $this->input->post('qr_id');
		if($id){
			$company = $this->Model_dop->get_table_where_array('m_company','qr_id',$id);
			if($company){
				
				$where =array(
					array('kolom'=>'active_flag','value'=>'0'),
					array('kolom'=>'flag_undangan','value'=>'1'),
					array('kolom'=>'id_company','value'=>$company['0']['id'])
				);
				
				$order =array(
					array('kolom'=>'a.pegawai_name','value'=>'asc')
				);
				$pegawai = $this->Model_dop->global_model('m_pegawai a',false,$where,false,false,$order,false,false,false);
				
				$data=array(
					'id'=>$id,
					'comp'=>$company,
					'get_data'=>$pegawai
				);
			$this->load->view('element/v_header_style',$data);		
			$this->load->view('camera/input');
				// debug($data);
			}else{
				echo "Tidak Terdaftar";
			}
		}else{
			
			$data=array(
				'id'=>'',
				'comp'=>'',
				'get_data'=>''
			);
			$this->load->view('element/v_header_style',$data);		
			$this->load->view('camera/input');
		}
		
	}
	// function untuk menampilkan / generate qr-code
	function qr_view($id){
		$company = $this->Model_dop->get_table_where_array('m_company','id',$id);
		$where =array(
			array('kolom'=>'active_flag','value'=>'0'),
			array('kolom'=>'id_company','value'=>$company['0']['id'])
		);
		
		$order =array(
			array('kolom'=>'a.pegawai_name','value'=>'asc')
		);
		$pegawai = $this->Model_dop->global_model('m_pegawai a',false,$where,false,false,$order,false,false,false);
		
		$data=array(
			'id'=>$id,
			'comp'=>$company,
			'get_data'=>$pegawai
		);
		$this->load->view('element/v_header_style',$data);		
		$this->load->view('camera/qr_view');
		// debug($data);
	}
	// function untuk menampilkan data report peserta yang hadir dalam suatu event
	function report_kehadiran($id=null,$display=null,$export=null){
		
		$array =array(
			array('kolom'=>'b.active_flag','value'=>'0'),
			array('kolom'=>'c.active_flag','value'=>'0')
		);
		if($id){
			$data['event'] = $this->Model_dop->get_table_where_array('m_event','id',$id);
			$tambahan =array(
				array('kolom'=>'a.id_acara','value'=>$id)
			);
			$hadir =array(
				array('kolom'=>'date(absen_masuk)','value'=>date('Y-m-d'))
			);
			$where = array_merge($array,$tambahan);
			//if($display){ $where = array_merge($array,$tambahan,$hadir); }
			$data['id'] = $id;
		}else{
			$data['event'] = '';
			$data['id'] = 'null';
			$where = $array;
		}
		$join =array(
			array('table'=>'m_pegawai b','on'=>'a.id_pegawai=b.id','type'=>'inner'),
			array('table'=>'m_company c','on'=>'b.id_company=c.id','type'=>'inner')
		);
		$order =array(
			array('kolom'=>'a.absen_masuk','value'=>'desc'),
		);
		$data['data_grid'] = $this->Model_dop->global_model('t_absen a',"a.*,b.pegawai_jabatan,b.pegawai_name,c.company_name",$where,$join,false,$order,false,false,false);
		$data['perusahaan_datang'] = $this->Model_dop->global_model('t_absen a',"c.company_name",$where,$join,false,$order,false,false,true);
		$data['display'] = $display;
		// debug($data);
		if($export){
			$data['filename'] = 'report_kehadiran';
			$this->load->view('element/head_excell',$data);		
			$this->load->view('report/absen_xls');

		}else{
			$this->load->view('element/v_header_style',$data);		
			$this->load->view('report/absen');
			$this->load->view('element/v_footer_style');
		}
	}
	function data_telat($id,$export=null){
		$data['event'] = $this->Model_dop->get_table_where_array('m_event','id',$id);
		$where =array(
			array('kolom'=>'b.active_flag','value'=>'0'),
			array('kolom'=>'time(absen_masuk) >','value'=>$data['event'][0]['event_start']),
			array('kolom'=>'c.active_flag','value'=>'0'),
			array('kolom'=>'a.id_acara','value'=>$id)
		);
		
		$join =array(
			array('table'=>'m_pegawai b','on'=>'a.id_pegawai=b.id','type'=>'inner'),
			array('table'=>'m_company c','on'=>'b.id_company=c.id','type'=>'inner')
		);
		$order =array(
			array('kolom'=>'a.absen_masuk','value'=>'desc'),
		);
		$data['data_grid'] = $this->Model_dop->global_model('t_absen a',"a.*,b.pegawai_jabatan,b.pegawai_name,c.company_name",$where,$join,false,$order,false,false,false);
		$data['perusahaan_datang'] = $this->Model_dop->global_model('t_absen a',"c.company_name",$where,$join,false,$order,false,false,true);
		$data['id'] = $id;
		$data['display'] = '';
		// debug($data);
		if($export){
			$data['filename'] = 'report_kehadiran';
			$this->load->view('element/head_excell',$data);		
			$this->load->view('report/absen_xls');

		}else{
			$this->load->view('element/v_header_style',$data);		
			$this->load->view('report/data_telat');
			$this->load->view('element/v_footer_style');
		}
	}
	// function untuk memanggil halaman scan barcode by camera
	function scan($id = null){
		$data=array(
			'id'=>null,
			'comp'=>null,
			'get_data'=>null
		);
		if($id){
			$company = $this->Model_dop->get_table_where_array('m_company','qr_id',$id);
			// debug($company);exit;
			if($company){
				$pegawai = $this->Model_wiki->dataAbsen($company[0]['id'],$this->session->userdata('event')['id_event']);
				// debug($pegawai);exit;
				$data=array(
					'id'=>$id,
					'comp'=>$company,
					'get_data'=>$pegawai
				);
			}else{
				echo "Tidak Terdaftar";
			}
		}
	
        $this->load->view('element/v_header_style',$data);		
		$this->load->view('camera/camera');
	}
	
	// function untuk memanggil halaman scan barcode by camera
	function scan_phone(){
		$this->cekScanData();
		$this->load->view('element/v_header_style',$data);		
		$this->load->view('camera/input');
	}
	function cekScanData(){
		$id = $this->input->post('qr_id');
		if($id){
			$company = $this->Model_dop->get_table_where_array('m_company','qr_id',$id);
			if($company){
				
				$where =array(
					array('kolom'=>'active_flag','value'=>'0'),
					array('kolom'=>'id_company','value'=>$company['0']['id'])
				);
				
				$order =array(
					array('kolom'=>'a.pegawai_name','value'=>'asc')
				);
				$pegawai = $this->Model_dop->global_model('m_pegawai a',false,$where,false,false,$order,false,false,false);
				
				$data=array(
					'id'=>$id,
					'comp'=>$company,
					'get_data'=>$pegawai
				);
				// debug($data);
			}else{
				$data=array(
					'id'=>$id,
					'comp'=>'Tidak Terdaftar',
					'get_data'=>''
				);
			}
		}else{
			$data['comp']='Tidak Terdaftar';
		}
		
	}
	// function untuk menampilkan data detail perusahaan
	function detail_company($id=null){
		
		$where =array(
			array('kolom'=>'a.active_flag','value'=>'0'),
			array('kolom'=>'a.id_company','value'=>$id)
		);
		$order =array(
			array('kolom'=>'a.pegawai_name','value'=>'asc')
		);
		$data['data_grid'] = $this->Model_dop->global_model('m_pegawai a',false,$where,false,false,$order,false,false,false);
		
		$where =array(
			array('kolom'=>'active_flag','value'=>'0'),
			array('kolom'=>'id_company','value'=>$id)
		);
		$order =array(
			array('kolom'=>'keterangan','value'=>'asc')
		);
		$data['berkas'] = $this->Model_dop->global_model('t_berkas',false,$where,false,false,$order,false,false,false);
		
		$where =array(
			array('kolom'=>'a.active_flag','value'=>'0'),
			array('kolom'=>'a.pegawai_jabatan','value'=>'Direktur Utama'),
			array('kolom'=>'a.id_company','value'=>$id)
		);
		$order =array(
			array('kolom'=>'a.pegawai_name','value'=>'asc')
		);
		$data['peg'] = $this->Model_dop->global_model_array('m_pegawai a',false,$where,false,false,$order,false,false,false);
		// debug($data);
		$data['perusahaan'] = $this->Model_dop->get_table_where_array('m_company','id',$id);
		$data['delete'] = 'dashboard/global_delete/m_pegawai/id';
		$data['delete_berkas'] = 'dashboard/global_delete/t_berkas/id';
		
		
		$this->load->view('element/v_header_style',$data);
		$this->load->view('wiki/detail_company');
		$this->load->view('element/v_footer_style');
	}
	// FUNCTION UNTUK MENAMPILKAN DATA SURAT BERDASARKAN JENIS SURAT
	// M = MASUK
	// K = KELUAR
	function surat($jenis){
		if($jenis == 'm'){
			$data['jenis_']= 'Masuk';
		}else{
			$data['jenis_']= 'Keluar';
		}
		$where =array(
			array('kolom'=>'active_flag','value'=>'0'),
			array('kolom'=>'surat_jenis','value'=>$jenis)
		);
		$order =array(
			array('kolom'=>'surat_reg','value'=>'desc')
		);
		$data['data_grid'] = $this->Model_dop->global_model('m_surat',false,$where,false,false,$order,false,false,false);
		$where =array(
			array('kolom'=>'active_flag','value'=>'0'),
		);
		$order =array(
			array('kolom'=>'group_name','value'=>'asc')
		);
		$data['jenis'] = $jenis;
		$data['group'] = $this->Model_dop->global_model('m_surat_group',false,$where,false,false,$order,false,false,false);
		$data['delete'] = 'dashboard/global_delete/m_surat/id';
		// debug($data);
		$this->load->view('element/v_header_style',$data);
		$this->load->view('master/m_surat');
		$this->load->view('element/v_footer_style');
	}
	// function yang menampilkan data event yang akan dilakukan
	function event($jenis){
		$array =array(
			array('kolom'=>'active_flag','value'=>'0'),
		);
		$where = $array;
		if($jenis==2 || $jenis==3){
			$today =array(
				array('kolom'=>'event_date <=','value'=>date('Y-m-d')),
				array('kolom'=>'event_date_end >=','value'=>date('Y-m-d'))
			);
			$where= array_merge($array,$today);
		}
		$order =array(
			array('kolom'=>'event_date','value'=>'desc')
		);
		$data['data_grid'] = $this->Model_dop->global_model('m_event',false,$where,false,false,$order,false,false,false);
		
		$data['jenis'] = $jenis;
		$data['title'] = 'Data Kegiatan';
		$data['delete'] = 'dashboard/global_delete/m_event/id';
		// debug($data);
		$this->load->view('element/v_header_style',$data);
		$this->load->view('master/m_event');
		$this->load->view('element/v_footer_style');
	}
	function create_sess_event($id,$jenis){
		$where =array(
			array('kolom'=>'id','value'=>$id),
		);
		$result = $this->Model_dop->global_model_array('m_event',false,$where,false,false,false,false,false,false);
		$sess_array = array();
			$sess_array = array(
				'id_event' => $result[0]['id'],
				'event_name' => $result[0]['event_name']
			);
		$this->session->set_userdata('event', $sess_array);
		// debug($this->session->userdata('event'));
		$direct = $jenis == 2 ? 'dashboard/input_data' : 'dashboard/scan';
		redirect($direct);
	}
	function input_event($jenis){		
		// $key = array_keys($array);
		// $value = array_values($array);
		
		$array = $this->input->post();
		$log=array(
			'create_date'=>date('Y-m-d'),
			'create_by'=> $this->session->userdata('logged_in')['username']
		);
		$data = array_merge($array,$log);
		
		$this->Model_dop->insert_table('m_event',$data);
		redirect('dashboard/event/'.$jenis);
	}
	
	function update_event($jenis){	
		$array = $this->input->post();
		$log=array(
					'update_date'=>date('Y-m-d'),
					'update_by'=> $this->session->userdata('logged_in')['username']
				);
		$update = array_merge($array,$log);
		// debug($update);
		$this->Model_dop->update_table('m_event',$update,'id',$this->input->post('id'));
		redirect('dashboard/event/'.$jenis);
	}
	
	function m_surat_group(){
		$where =array(
			array('kolom'=>'active_flag','value'=>'0'),
		);
		$order =array(
			array('kolom'=>'group_name','value'=>'asc')
		);
		$data['title'] = 'Data Group Surat';
		$data['data_grid'] = $this->Model_dop->global_model('m_surat_group',false,$where,false,false,$order,false,false,false);
		$data['delete'] = 'dashboard/global_delete/m_surat_group/id';
		// debug($data);
		$this->load->view('element/v_header_style',$data);
		$this->load->view('master/m_surat_group');
		$this->load->view('element/v_footer_style');
	}
	function global_input($table){		
		// $key = array_keys($array);
		// $value = array_values($array);
		
		$array = $this->input->post();
		$log=array(
					'create_date'=>date('Y-m-d'),
					'create_by'=> $this->session->userdata('logged_in')['username']
				);
		$data = array_merge($array,$log);
		// debug($data);
		$this->Model_dop->insert_table($table,$data);
		redirect('dashboard/'.$table);
	}
	
	function global_update($table){
		$array = $this->input->post();
		$log=array(
					'update_date'=>date('Y-m-d'),
					'update_by'=> $this->session->userdata('logged_in')['username']
				);
		$update = array_merge($array,$log);
		// debug($update);
		$this->Model_dop->update_table($table,$update,'id',$this->input->post('id'));
		redirect('dashboard/'.$table);
	}
	
	function input_surat(){
		
		$config['upload_path'] = './upload/persuratan';
		$config['overwrite'] = false;
		$config['allowed_types'] = 'jpg|png|gif|pdf';
		$this->load->library('upload', $config);
		$lampiran = '';
		
		if ( ! $this->upload->do_upload("file_1")) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$uploaded_file = $this->upload->data();
			$lampiran = str_replace(' ','',$uploaded_file['file_name']);
		}
		
		$data=array(
			'surat_number'=> trim($this->input->post('surat_number')),
			'surat_jenis'=>$this->input->post('surat_jenis'),
			'surat_group'=>trim($this->input->post('surat_group')),
			'surat_reg'=>$this->input->post('surat_reg'),
			'surat_from'=>trim($this->input->post('surat_from')),
			'surat_to'=>$this->input->post('surat_to'),
			'surat_perihal'=>$this->input->post('surat_perihal'),
			'surat_kontent'=>$this->input->post('surat_kontent'),
			'tgl_surat'=>$this->input->post('tgl_surat'),
			'tgl_act'=>$this->input->post('tgl_act'),
			'surat_file'=>$lampiran
		);
		// debug($data);
		$this->Model_dop->insert_table('m_surat',$data);
		redirect('dashboard/surat/'.$this->input->post('surat_jenis'));
	}
	//----------------------------------------------------------------
	function cange_password($allert=null,$note=null){
		$notif=null;
		$peg_rembes = null;
		
		$session_data = $this->session->userdata('logged_in');
		$user_name = $session_data['user_npp'];
		$user_level = $session_data['user_level'];
		$person_id = $session_data['user_person_id'];
		$pass = $this->Model_dop->get_table_where_array('t_users','username', $person_id);
		
		$data=array(
            'old_pass'=>$pass[0]['USER_PASSWORD'],
			'allert'=>$allert
        );
		
		$this->load->view('element/v_header_style',$data);
		$this->load->view('pages/update_password');
		$this->load->view('element/v_footer_style');
	}
	
	function update_password(){
		
		$session_data = $this->session->userdata('logged_in');
		$username = $session_data['username'];
		$level_user = $session_data['level_user'];
		$old_pass = md5($this->input->post('old_pass')).'<br/>';
		$new_pass = $this->input->post('new_pass').'<br/>';
		$old_pass1 = $this->input->post('old_pass1').'<br/>';
		$confirm_pass = $this->input->post('confirm_pass').'<br/>';
		
		if($old_pass != $old_pass1){
			redirect('dashboard/cange_password/1');
		}
		if($new_pass != $confirm_pass){
			redirect('dashboard/cange_password/2');
		}
		
		$update=array(
            'user_password'=>md5($this->input->post('new_pass'))
        );
        $this->Model_dop->update_table('t_users',$update,'username',$person_id);
		redirect('dashboard/welcome_user');
	}
}