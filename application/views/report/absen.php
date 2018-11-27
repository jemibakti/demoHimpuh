<script>
	$(function() {
    $( "#tabs" ).tabs();
  });
</script>
<?php if($display){?>
<meta http-equiv="refresh" content="8">
<?php } ?>
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3><i class="fa fa-list"></i> Kehadiran <?php if($event){ echo $event[0]['event_name']; }?></h3>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">	
		<ol class="breadcrumb">
		  <li><i class="fa fa-home"></i><a href="#"> Home</a></li>
		  <li><a href="#">Report</a></li>
		  <li class="active">Kehadiran</li>
		</ol>	
		<div class="col-lg-2 col-md-9">	
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo count($data_grid); ?></div>
							<div><b>Peserta Hadir</b></div>
						</div>
					</div>
				</div>
								<a href="<?php echo site_url('dashboard/data_perusahaan/3'); ?>">
									<div class="panel-footer">
										<span class="pull-left"><i class="fa fa-arrow-circle-right"></i></span>
										<span class="pull-right"><?php echo count($perusahaan_datang) ?> Dari 224 perusahaan</span>
										<div class="clearfix"></div>
									</div>
								</a>
			</div>
			<a class="btn btn-lg btn-warning btn-block" href="<?php echo site_url().'dashboard/report_kehadiran/'.$id.'/null/kehadiran'; ?>"><i class="fa fa-file"></i> Export Excell</a>
		</div>
		<div class="col-lg-10 col-md-3">
		<div id="tabs">
	  <ul>
		<li><a href="#tabs-1"><i class="fa fa-clock-o"></i> Registrasi</a></li>
		
		<li><a href="#tabs-8"><i class="fa fa-clock-o"></i> Musyawarah 1</a></li>
		
		<li><a href="#tabs-2"><i class="fa fa-clock-o"></i> Musyawarah 2</a></li>
	
	  </ul>
		
		  <div id="tabs-8">
			<div class="panel panel-primary">
				<div class="panel-body text-center">
					 <div class="service-item">
						<table class="table table-striped " id="dataTables-example1" >
							<thead>
								<tr class="success">
									<th >#</th>
									<th >Nama</th>
									<th >Jabatan</th>
									<th >Nama Perusahaan</th>
									<th >Masuk</th>
								</tr>
							</thead>
							<tbody>
							   <?php
									$no =1;
									foreach($data_grid as $row){
										if($row->musy_1){
											if($row->update_date == '0000-00-00 00:00:00'){
												$keluar = '-';
											}else{
												$keluar = $row->update_date;
											}
											$jam1 = new DateTime($event[0]['event_start']);
											$jam2 = new DateTime(substr($row->absen_masuk,-8));
											$beda = $jam1->diff($jam2);
											// debug($beda);
											if($beda->format('%R') == '+'){
												$color = 'danger';
											}else{
												$color = 'success';
											}
								?>
								<tr class='<?php echo $color; ?>'>
									<th><?php echo $no; $no++;?></th>
									<th> <?php echo $row->pegawai_name; ?> </th>
									<th> <?php echo $row->pegawai_jabatan; ?> </th>
									<th><?php echo $row->company_name; ?></th>
									<th><?php echo $row->musy_1; ?></th>
								</tr>
									<?php } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		  </div>
		  <div id="tabs-1">
			<div class="panel panel-primary">
				<div class="panel-body text-center">
					 <div class="service-item">
						<table class="table table-striped " id="dataTables-example2" >
							<thead>
								<tr class="warning">
									<th >#</th>
									<th >Nama</th>
									<th >Jabatan</th>
									<th >Nama Perusahaan</th>
									<th >Masuk</th>
									<th >Keluar</th>
									<th >Telat</th>
								</tr>
							</thead>
							<tbody>
							   <?php
									$no =1;
									foreach($data_grid as $row){
										if($row->update_date == '0000-00-00 00:00:00'){
											$keluar = '-';
										}else{
											$keluar = $row->update_date;
										}
										$jam1 = new DateTime($event[0]['event_start']);
										$jam2 = new DateTime(substr($row->absen_masuk,-8));
										$beda = $jam1->diff($jam2);
										// debug($beda);
										if($beda->format('%R') == '+'){
											$color = 'danger';
										}else{
											$color = 'success';
										}
								?>
								<tr class='<?php echo $color;?>'>
									<th><?php echo $no; $no++;?></th>
									<th> <a href='<?php echo site_url().'dashboard/detail_company/'.$row->id; ?>' ><?php echo $row->pegawai_name; ?></a> </th>
									<th> <?php echo $row->pegawai_jabatan; ?> </th>
									<th><?php echo $row->company_name; ?></th>
									<th><?php echo $row->absen_masuk; ?></th>
									<th><?php echo $keluar; ?></th>
									<th> <?php echo  $beda->format('%R %H Jam %i menit'); ?></th>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		  </div>
		  <div id="tabs-2">
			<div class="panel panel-primary">
				<div class="panel-body text-center">
					 <div class="service-item">
						<table class="table table-striped " id="dataTables-example3" >
							<thead>
								<tr class="warning">
									<th >#</th>
									<th >Nama</th>
									<th >Jabatan</th>
									<th >Nama Perusahaan</th>
									<th >Masuk</th>
								</tr>
							</thead>
							<tbody>
							   <?php
									$no =1;
									foreach($data_grid as $row){
										if($row->musy_2){
											if($row->update_date == '0000-00-00 00:00:00'){
												$keluar = '-';
											}else{
												$keluar = $row->update_date;
											}
											$jam1 = new DateTime($event[0]['event_start']);
											$jam2 = new DateTime(substr($row->absen_masuk,-8));
											$beda = $jam1->diff($jam2);
											// debug($beda);
											if($beda->format('%R') == '+'){
												$color = 'danger';
											}else{
												$color = 'success';
											}
								?>
								<tr class='<?php echo $color;?>'>
									<th><?php echo $no; $no++;?></th>
									<th> <a href='<?php echo site_url().'dashboard/detail_company/'.$row->id; ?>' ><?php echo $row->pegawai_name; ?></a> </th>
									<th> <?php echo $row->pegawai_jabatan; ?> </th>
									<th><?php echo $row->company_name; ?></th>
									<th><?php echo $row->musy_2; ?></th>
								</tr>
										<?php } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		  </div>
	</div>
		</div>
	</div>
</div>