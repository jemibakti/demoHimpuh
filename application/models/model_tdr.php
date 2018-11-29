<?php
if(!defined('BASEPATH'))exit('No Direct Access Script Allowed');
class Model_tdr extends CI_Model{
	protected $data;
    public function __construct(){
	    parent::__construct();
	}
	
	public function get_all_vendor(){
		return array();
	}
}