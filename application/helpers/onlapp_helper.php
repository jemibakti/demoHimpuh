<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('onlapp')){
	
	function debug($array){
		echo '<pre>',print_r($array,1),'</pre>';
	}
	function word($word){
		$new_word = ucwords(strtolower($word));
		return $new_word;
	}
	function delete($link,$confirm){
		$html = "<a href='".$link."'> ";
		$html .= "<button type='button' class='btn btn-danger btn-sm' title='Delete Data' ";
		$html .= "onclick ='return confirm(".$confirm.")'>";
		$html .= "<i class='fa fa-fw fa-trash-o'></i>";
		$html .= "</button></div></a>";
		return $html;
	}
	function harga($nominal){
		$format = number_format($nominal,0,',','.');
		return $format;
	}
	function tgl_ind($tgl){
		$format = date("d M Y", strtotime($tgl));
		return $format;
	}
	function upload($file,$path,$allow){
		$ci = &get_instance();
		$config['encrypt_name'] = TRUE;
		if($path){
			$config['upload_path'] = $path;
		} else {
			$config['upload_path'] = './upload';
		}
		
		$config['remove_spaces'] = false; 
		$config['overwrite'] = true;
		$config['encrypt_name'] = true;
		
		if($allow){
			$config['allowed_types'] = $allow;
		} else {
			$config['allowed_types'] = 'csv|xls|xlsx|ppt|pptx|doc|docx|pdf|png|jpg';
		}
		
		$ci->load->library('upload', $config);
		if (!$ci->upload->do_upload($file)) {
			$error = array('error' => $ci->upload->display_errors());
			debug($error);
		} else {
			$uploaded_file = $ci->upload->data();
			return $uploaded_file['file_name'];
		}
	}
	
	function insert($fields,$table,$create_by,$ip){
	
		$ci = &get_instance();
		$npp = $ci->session->userdata('logged_in')['user_npp'];
		if($npp){
			$field = explode(',',$fields);
			foreach($field as $row){
				$data[$row]=$ci->input->post($row);
			}
			if($create_by){
				$data['create_by']=$npp;
			}
			if($ip){
				$data['ip_add'] = $_SERVER['REMOTE_ADDR'];
			}
			// debug($data);
			$ci->model_dop->insert_table($table,$data);	
			return $ci->db->insert_id();
		}else{
			redirect('dashboard');
		}
	}
}
?>