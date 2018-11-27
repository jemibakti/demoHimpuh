<style>
	
	@media print {
		input.noPrint { display: none; }
	}
	
</style>
<link href="<?php echo base_url('asset/css/printable.css')?>" rel="stylesheet">
<body>
<?php 
	$rek_gaji = 0;
	$rek_umum = 0;
	foreach($data_detail as $row){
		if ($row->rek_pembayaran == 0){
			$rek_gaji = $rek_gaji + $row->biaya_tda;
		}else{
			$rek_umum = $rek_umum + $row->biaya_tda;
		}
	}
	foreach($data_head as $row1){
		$nama = $row->nama;
		$nama_rek_opt = $row->nama_rek_opt;
		$rek_opt = $row->rek_opt;
	}
?>
<center><h4>Perintah Pembukuan</h4></center>
<br/>
<table >
  <tr>
    <td align="left" valign="top">No.</td>
    <td colspan="7" align="left" valign="top">2015/ONL/4.<?php echo substr($pic[0]['tda'],-1)?>/</td>
    <td colspan="2" align="left" valign="top">No Voucer :</td>
  </tr>
  <tr>
    <td colspan="8" align="center" valign="top">&nbsp;</td>
    <td colspan="2" align="left" valign="top">Tgl. Voucer :</td>
  </tr>
  <tr>
    <th rowspan="2" align="center" >No</th>
    <th rowspan="2" align="center" >Nama Rekening</th>
    <th rowspan="2" align="center" >Nomor Rekening</th>
    <th rowspan="2" align="center" >Debet</th>
    <th rowspan="2" align="center" >Kredit</th>
    <th colspan="5" align="center" >Narasi</th>
  </tr>
  <tr>
    <th align="center" valign="top"  > Program</th>
    <th align="center" valign="top"  >Sub Program</th>
    <th align="center" valign="top"  >Batch/Tahun</th>
    <th align="center" valign="top"  >Cost Code</th>
    <th align="center" valign="top"  >Keterangan</th>
  </tr>
  <?php if ($rek_gaji > 0){ ?>
  <tr>
    <td >1</td>
    <td align="left"><?php echo ucwords(strtolower($account[0]['account_name'])); ?></td>
    <td align="left"><?php echo ucwords(strtolower($account[0]['account_rekening'])); ?></td>
    <td ><?php echo number_format($rek_gaji,0,'.',','); ?></td>
    <td >&nbsp;</td>
    <td rowspan="2" align="left" valign="top" ><?php echo ucwords(strtolower($course_name[0]['course_title'])).' - '.$course_name[0]['course_code']; ?></td>
    <td rowspan="2" align="left" valign="top" ><?php echo ucwords(strtolower($nama_kelas)); ?></td>
    <td rowspan="2" valign="top"><?php echo substr($nama_kelas,-8,3).' / '.date('Y'); ?></td>
    <td rowspan="2" valign="top">28-Biaya transportasi</td>
    <td rowspan="2" align="left" valign="top"><?php echo 'Biaya Transport Peserta '.ucwords(strtolower($nama_kelas)).' an. '.ucwords(strtolower($nama)) ?></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td align="left" ><?php echo ucwords(strtolower($nama)); ?></td>
    <td align="left"><?php echo substr('000'.$rek[0]['NO_REK'],-10); ?></td>
    <td >&nbsp;</td>
    <td ><?php echo number_format($rek_gaji,0,'.',','); ?></td>
  </tr>
  <tr>
    <td colspan="5" >&nbsp;</td>
    <td colspan="5" >&nbsp;</td>
  </tr>
  <?php } ?>
  <?php if ($rek_umum > 0){ ?>
  <tr>
    <td >2</td>
    <td align="left"><?php echo ucwords(strtolower($account[0]['account_name'])); ?></td>
    <td align="left"><?php echo ucwords(strtolower($account[0]['account_rekening'])); ?></td>
    <td ><?php echo number_format($rek_umum,0,'.',','); ?></td>
    <td >&nbsp;</td>
    <td rowspan="2" align="left" valign="top" ><?php echo ucwords(strtolower($course_name[0]['course_title'])).' - '.$course_name[0]['course_code']; ?></td>
    <td rowspan="2" align="left" valign="top" ><?php echo ucwords(strtolower($nama_kelas)); ?></td>
    <td rowspan="2" valign="top"><?php echo substr($nama_kelas,-8,3).' / '.date('Y'); ?></td>
    <td rowspan="2" valign="top">28-Biaya transportasi</td>
    <td rowspan="2" align="left" valign="top"><?php echo 'Biaya Transport Peserta '.ucwords(strtolower($nama_kelas)).' an. '.ucwords(strtolower($nama)) ?></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td align="left" ><?php if(empty($nama_rek_opt)){ echo ucwords(strtolower($nama)); } else{ echo ucwords(strtolower($nama_rek_opt));}?></td>
    <td align="left"><?php if(empty($rek_opt)){ echo substr('000'.$rek[0]['NO_REK'],-10); } else { echo $rek_opt; } ?></td>
    <td >&nbsp;</td>
    <td ><?php echo number_format($rek_umum,0,'.',','); ?></td>
  </tr>
  <tr>
    <td colspan="5" >&nbsp;</td>
    <td colspan="5" >&nbsp;</td>
  </tr>
  <tr>
    <th >&nbsp;</th>
    <th colspan='2' align="left" >Jumlah</th>
    <th ><?php echo number_format($rek_umum + $rek_gaji,0,'.',',');?></th>
    <th ><?php echo number_format($rek_umum + $rek_gaji,0,'.',','); ?></th>
    <th colspan='5'>&nbsp;</th>
  </tr>
  <?php } ?>
</table>
<div>
	Dibuku Oleh,
</div>
<div >
	Diperiksa Oleh,
</div>
<div>
	Jakarta,<br/>
	DIVISI ORGANIZATIONAL LEARNING
</div>
<div>
	<input class="noPrint" type="button" value="Print" onclick="window.print()">
</div>
</body>