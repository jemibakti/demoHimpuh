<?php
if(!defined('BASEPATH'))exit('No Direct Access Script Allowed');
class Model_perpus extends CI_Model{
    public function __construct(){
	    parent::__construct();
	}
	
	public function get_list_koran(){
	    $query = $this->db->get_where('m_koran',array("TIPE"=>1,"ACTIVE_FLAG"=>1));
		return $query->result_array();
	}
	
	public function get_list_tabloid(){
	    $query = $this->db->get_where('m_koran',array("TIPE"=>2,"ACTIVE_FLAG"=>1));
		return $query->result_array();
	}
	
	public function get_distribusi_koran($id,$thn,$bln){
	    $this->db->select('*');
		$this->db->from('t_koran_transaction');
		$this->db->where('M_KORAN_ID',$id);
		$this->db->where('YEAR(TGL_TERIMA)',$thn);
		$this->db->where('MONTH(TGL_TERIMA)',$bln);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function reset_jumlah_distribusi($id,$thn,$bln){
	    $data = array("JUMLAH"=>0);
		$this->db->where('M_KORAN_ID',$id);
		$this->db->where('YEAR(TGL_TERIMA)',$thn);
		$this->db->where('MONTH(TGL_TERIMA)',$bln);
		$this->db->update('t_koran_transaction',$data);
	}
	
	public function update_distribusi($id,$tgl,$jumlah){
	    $data = array("JUMLAH"=>$jumlah);
		$this->db->where('M_KORAN_ID',$id);
		$this->db->where('TGL_TERIMA',$tgl);
		$this->db->update('t_koran_transaction',$data);
	}
	
	public function check_distribusi_existing($id,$tgl){
	    $this->db->where('M_KORAN_ID',$id);
		$this->db->where('TGL_TERIMA',$tgl);
		$this->db->from('t_koran_transaction');
		return $this->db->count_all_results();
	}
	
	public function insert_distribusi($id,$tgl,$jumlah){
	    $data = array("M_KORAN_ID"=>$id,"TGL_TERIMA"=>$tgl,"JUMLAH"=>$jumlah);
		$this->db->insert('t_koran_transaction',$data);
	}
	
	public function get_laporan_bulanan($bln,$thn){
	    $this->db->select('*');
		$this->db->from('t_koran_transaction');
		$this->db->where('YEAR(TGL_TERIMA)',$thn);
		$this->db->where('MONTH(TGL_TERIMA)',$bln);
		$this->db->join('m_koran','m_koran.M_KORAN_ID=t_koran_transaction.M_KORAN_ID');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_laporan_tahunan($thn){
	    $this->db->select_sum('t_koran_transaction.JUMLAH');
		$this->db->select('m_koran.*,t_koran_transaction.TGL_TERIMA');
		$this->db->from('t_koran_transaction');
		$this->db->where('YEAR(TGL_TERIMA)',$thn);
		$this->db->group_by('t_koran_transaction.M_KORAN_ID');
		$this->db->join('m_koran','m_koran.M_KORAN_ID=t_koran_transaction.M_KORAN_ID');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert_master_koran($nama,$harga,$tipe){
	    $data = array("NAMA_KORAN"=>$nama,"HARGA"=>$harga,"TIPE"=>$tipe);
		$this->db->insert('m_koran',$data);
	}
	
	public function get_detail_koran($id){
	    $this->db->select('*');
		$this->db->from('m_koran');
		$this->db->where('M_KORAN_ID',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_detail_master_koran($id,$nama,$harga,$tipe){
	    $data = array("NAMA_KORAN"=>$nama,"HARGA"=>$harga,"TIPE"=>$tipe);
		$this->db->where('M_KORAN_ID',$id);
		$this->db->update('m_koran',$data);
	}
	
	public function delete_detail_master_koran($id){
	    $data = array("ACTIVE_FLAG"=>0);
		$this->db->where('M_KORAN_ID',$id);
		$this->db->update('m_koran',$data);
	}
	
	public function get_lapkeu_bulanan($bln,$thn){
	    $this->db->select_sum('t_koran_transaction.JUMLAH');
		$this->db->select('m_koran.*,t_koran_transaction.TGL_TERIMA');
		$this->db->from('t_koran_transaction');
		$this->db->where('MONTH(TGL_TERIMA)',$bln);
		$this->db->where('YEAR(TGL_TERIMA)',$thn);
		$this->db->group_by('t_koran_transaction.M_KORAN_ID');
		$this->db->join('m_koran','m_koran.M_KORAN_ID=t_koran_transaction.M_KORAN_ID');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_lapkeu_tahunan($thn){
	    $this->db->select_sum('t_koran_transaction.JUMLAH');
		$this->db->select('m_koran.*,t_koran_transaction.TGL_TERIMA');
		$this->db->from('t_koran_transaction');
		$this->db->where('YEAR(TGL_TERIMA)',$thn);
		$this->db->group_by('t_koran_transaction.M_KORAN_ID');
		$this->db->join('m_koran','m_koran.M_KORAN_ID=t_koran_transaction.M_KORAN_ID');
		$query = $this->db->get();
		return $query->result_array();
	}
	
}