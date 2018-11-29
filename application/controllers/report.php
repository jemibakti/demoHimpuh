<?php
class Report extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')){
			$this->load->model('Model_wiki');
			$this->load->library('form_validation');   
		}else{
			redirect("login");
		}
    }
	// function untuk Export Data Company
	function export_company(){
		
		$com = $this->Model_dop->get_table_where_order('m_company','active_flag','0','company_name','asc');
		// debug($data);
		
		$data['filename'] = 'Data Perusahaan Asosiasi HIMPUH('.date('d-m-Y').')';
		$this->load->view('element/head_excell',$data);		
		$no = 1;
		$table = '<table>
					<tr>
						<td colspan=5>Data Perusahan Dalam Asosiasi Himpuh ('.date('d-m-Y').')</td>
					</tr>
					<tr>
						<th>No</th>
						<th>Nama Perusahaan</th>
						<th>No. Registrasi</th>
						<th>Alamat Perusahaan</th>
						<th>Tlp Perusahaan</th>
						<th>Fax</th>
						<th>Email Perusahaan</th>
						<th>Nama Pimpinan</th>
						<th>Perwakilan Tetap</th>
						<th>Sk Umroh</th>
						<th>Tgl Sk Umroh</th>
						<th>Sk Haji</th>
						<th>Tgl Sk Haji</th>
						<th>Pin Siskohat</th>
						<th>Pin Muasasah</th>
					</tr>';
		
		foreach($com as $row){
			$dir = $this->Model_dop->get_table_where_array('m_pegawai','pegawai_jabatan','Direktur Utama');
			$peg = $this->Model_dop->get_table_where_array('m_pegawai','pegawai_jabatan','Perwakilan Tetap');
			
			$where =array(
				array('kolom'=>'pegawai_jabatan','value'=>'Direktur Utama'),
				array('kolom'=>'id_company','value'=>$row->id),
				array('kolom'=>'active_flag','value'=>'0')
			);
			
			$dir = $this->Model_dop->global_model_array('m_pegawai',false,$where,false,false,false,false,false,false);
			
			$where =array(
				array('kolom'=>'pegawai_jabatan','value'=>'Perwakilan Tetap'),
				array('kolom'=>'id_company','value'=>$row->id),
				array('kolom'=>'active_flag','value'=>'0')
			);
			$peg = $this->Model_dop->global_model_array('m_pegawai',false,$where,false,false,false,false,false,false);
			
			if($dir){
				$dir_name = $dir[0]['pegawai_name'];
			}else{
				$dir_name = '-';
			}
			if($peg){
				$peg_name = $peg[0]['pegawai_name'];
			}else{
				$peg_name = '-';
			}
			$table .='<tr><td>';
			$table .=$no.'</td><td>'.
						$row->company_name.'</td><td>'.
						$row->company_reg.'</td><td>'.
						$row->company_addres.'</td><td>'.
						$row->company_contact.'</td><td>'.
						$row->fax.'</td><td>'.
						$row->company_email.'</td><td>'.
						$dir_name.'</td><td>'.
						$peg_name.'</td><td>'.
						$row->sk_umroh.'</td><td>'.
						$row->tgl_sk_umroh.'</td><td>'.
						$row->company_sk.'</td><td>'.
						$row->tgl_sk.'</td><td>'.
						$row->pin_siskohat.'</td><td>'.
						$row->pin_muassasah.'</td><td>'
						;
			$table .= '</tr>';
			$no++;
		}
		$table .= '</table>';
		echo $table;
	}
	function tambah_berkas($id){
		
		$berkas = upload("file_1",'./upload/berkas',false);
		if($berkas){
			$data=array(
				'keterangan'=> $this->input->post('keterangan'),
				'id_company'=> $id,
				'create_by'=> $this->session->userdata('logged_in')['username'],
				'nama_file'=> $berkas
			);
			$this->Model_dop->insert_table('t_berkas',$data);
			$info = '<strong>data</strong> Berhasil disimpan';
		}else{
			$info = '<strong>File</strong> gagal Di upload';
		}
		$this->session->set_flashdata('info', $info);
		redirect('dashboard/detail_company/'.$id);
	}
	
	function update_file_company($kolom){
		
		$berkas = upload("file_1",'./upload/company',false);
		
		$data=array(
			$kolom=> $berkas
		);
		// debug($data);
		$this->Model_dop->update_table('m_company',$data,'id',$this->input->post('id'));
		redirect('dashboard/detail_company/'.$this->input->post('id'));
	}
}
