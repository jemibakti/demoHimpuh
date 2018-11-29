<link href="<?php echo base_url('asset/dash/css/stylish-portfolio.css')?>" rel="stylesheet">

<body>
<center><h4>Perintah Pembukuan</h4></center>
<br/>
<table >
  <tr>
    <td align="left" valign="top">No.</td>
    <td colspan="7" align="left" valign="top">2015/ONL/4.<?php echo substr($data_pic[0]['tda'],-1)?>/</td>
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
    <th align="center" valign="top"  >Program</th>
    <th align="center" valign="top"  >Sub Program</th>
    <th align="center" valign="top"  >Batch/Tahun</th>
    <th align="center" valign="top"  >Cost Code</th>
    <th align="center" valign="top"  >Keterangan</th>
  </tr>
  <?php
	$no = 1;
	foreach($data_peserta as $row){
  ?>
  <tr>
    <td ><?php echo $no; $no++; ?></td>
    <td align="left"><?php echo ucwords(strtolower($account[0]['account_name'])); ?></td>
    <td align="left"><?php echo ucwords(strtolower($account[0]['account_rekening'])); ?></td>
    <td ><?php echo number_format($row->biaya,0,'.',','); ?></td>
    <td >&nbsp;</td>
    <td rowspan="2" align="left" valign="top" ><?php echo ucwords(strtolower($course_name[0]['course_title'])).' - '.$course_name[0]['course_code']; ?></td>
    <td rowspan="2" align="left" valign="top" ><?php echo ucwords(strtolower($data_kelas[0]['class_name'])); ?></td>
    <td rowspan="2" valign="top"><?php echo substr($data_kelas[0]['class_name'],-8,3).' / '.date('Y'); ?></td>
    <td rowspan="2" valign="top">28-Biaya transportasi</td>
    <td rowspan="2" align="left" valign="top"><?php echo 'Biaya Transport Peserta '.ucwords(strtolower($data_kelas[0]['class_name'])).' an. '.ucwords(strtolower($row->nama)) ?></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td align="left" ><?php echo ucwords(strtolower($row->nama)); ?></td>
    <td align="left"><?php echo substr('000'.$row->no_rek,-10); ?></td>
    <td >&nbsp;</td>
    <td ><?php echo number_format($row->biaya,0,'.',','); ?></td>
  </tr>
  <?php
	}
  ?>
  <tr>
    <td colspan="5" >&nbsp;</td>
    <td colspan="5" >&nbsp;</td>
  </tr>
  <tr>
    <th >&nbsp;</th>
    <th colspan='2' align="left" >Jumlah</th>
    <th ><?php echo number_format($total,0,'.',',');?></th>
    <th ><?php echo number_format($total,0,'.',','); ?></th>
    <th colspan='5'>&nbsp;</th>
  </tr>
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