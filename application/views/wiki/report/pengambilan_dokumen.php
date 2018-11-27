<style>
	
	@media print {
		input.noPrint { display: none; }
	}
	
</style>
	<link rel="stylesheet" href="<?php echo base_url('asset/dash/css/bootstrap.min.css')?>"/>

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('asset/dash/css/plugins/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('asset/dash/css/stylish-portfolio.css')?>" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url('asset/dash/js/plugins/jqueryui/jquery-ui.css')?>" />
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('asset/dash/font-awesome-4.1.0/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
	<style type="text/css">	
	
	@media print {
		input.noPrint { display: none; }
	}
	body {
			padding-top: 10px;
			font-family:Arial, Helvetica, sans-serif;
			color:#666;
			font-size:16px;
			border: 2px solid #000;

	}
	</style>
<body>
	<div class='container'>
		<div class="col-lg-12">
			<img class="img-responsive"  src="<?php echo base_url('asset/img/bni.jpg');?>"><hr/>
		</div>
		<div><br/><br/>&nbsp;
			<pre><center><h4><b>TANDA TERIMA DOKUMEN</b></h4><center></pre>
		</div>
		<div><br/><br/>
			Saya yang bertanda-tangan di bawah ini :<br/><br/>
			<table>
				<tr>
					<td> Nama &nbsp;&nbsp;&nbsp;&nbsp;</td><td> : &nbsp;&nbsp;&nbsp;&nbsp;</td><td><?php echo ucwords(strtolower($dapeg[0]['NAMA'])); ?>.</td>
				</tr>
				<tr>
					<td> NPP </td><td> : </td><td><?php echo $dapeg[0]['NPP']; ?></td>
				</tr>
			</table>
		</div><br/>
		Telah Menerima asli 1 dokumen dengan rincian sbb:<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;- Ijazah <?php echo $data_doc[0]['UNIV_ASAL']; ?> No. <?php echo $data_doc[0]['NO_IJAZAH']; ?> tgl.  <?php echo $data_doc[0]['TAHUN_IJAZAH']; ?> an. <?php echo $dapeg[0]['NAMA']; ?><br/><br/>
		
		Dengan alasan pengambilan masa ikatan dinas telah selesai / <s>mengundurkan diri dimana kewajiaban pembayaran ganti rugi telah dilunaskan.<br/>
		(bukti Pelunasan terlampir *)</s><br/>
		Demikianlah surat ini dibuat untuk dipergunakan seperlunya.<br/><br/>
		Jakarta, <?php echo date('d-m-Y'); ?>.<br/><br/>
		<table>
			<tr>
				<td width='54%' valign='top'>Yang menerima,</td>
				<td style="text-align:center ">
					Mengetahui<br/>
					PT. Bank Negara Indonesia (Persero) Tbk.<br/>
					Divisi Manajemen Pembelajaran Organisasi
				</td>
			<tr>
		</table>
	<div>
		<input class="noPrint" type="button" value="Print" onclick="window.print()">
	</div>
	</div>
</body>
