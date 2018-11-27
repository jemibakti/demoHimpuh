<?php
class Oracle_connection{
	public $ora;
	protected function oracle_connect(){
	    try{
		    $dbh = new PDO ('oci:dbname=10.212.101.7:1521/orcl','LMSUSER','lmsuser',array(PDO::ATTR_PERSISTENT => TRUE));
		    return $dbh;
		}catch(PDOException $e){
		    echo $e->getMessage();
			foreach(PDO::getAvailableDrivers() as $driver){
				echo "Driver yang tersedia :".$driver;
			}
		}
	}
	
	public function open_connection(){
		$this->ora = $this->oracle_connect();
	}
	
}