
<?php 
	header("Content-type: application/octet-stream"); 
	header('Content-Disposition: attachment; filename="'.$filename.'.xls"');//ganti nama sesuai keperluan 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
?>
