<?php
class Login extends CI_Controller{  
    function __construct(){
		parent::__construct();
		$this->load->model('Model_wiki');
		
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
			$this->session->set_flashdata('gagal', '<strong>Password</strong> atau <strong>Username</strong> salah');
			 redirect("login");
		 }
	 }
	 // function untuk menghapus session user / log out
	 function logout(){
		 
		 $session_data = $this->session->userdata('logged_in');
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
	 function tesCamera(){
		$this->load->view('camera/tesKamera');
	 }
}
