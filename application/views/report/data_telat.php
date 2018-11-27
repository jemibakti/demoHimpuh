
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
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo count($data_grid); ?></div>
							<div><b>Peserta Telat</b></div>
						</div>
					</div>
				</div>
								<a href="<?php echo site_url('dashboard/data_perusahaan/3'); ?>">
									<div class="panel-footer">
										<span class="pull-left"><i class="fa fa-arrow-circle-right"></i></span>
										<span class="pull-right"><?php echo count($perusahaan_datang) ?> Dari 299 perusahaan</span>
										<div class="clearfix"></div>
									</div>
								</a>
			</div>
			<a class="btn btn-lg btn-warning btn-block" href="<?php echo site_url().'dashboard/data_telat/'.$id.'/telat'; ?>"><i class="fa fa-file"></i> Export Excell</a>
		</div>
		<div class="col-lg-10 col-md-3">
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example">
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
					$no = 1;
					
					if($data_grid){
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
						<tr class='<?php echo $color; ?>'>
							<th><?php echo $no;$no++;?></th>
							<th><?php echo $row->pegawai_name; ?></th>
							<th> <?php echo $row->pegawai_jabatan; ?></th>
							<th> <?php echo $row->company_name; ?></th>
							<th> <?php echo $row->absen_masuk; ?></th>
							<th> <?php echo $keluar; ?></th>
							<th> <?php echo  $beda->format('%R %H Jam %i menit'); ?></th>
						</tr>
					<?php
						}
					}else{
					?>
						<tr>
							<th colspan='6'>tidak ditemukan</th>
						</tr>
					<?php
					}
				   ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- modal tambah data start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Pegawai</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url('dashboard/input_pegawai'); ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Pegawai:  
			</label>
			<input class="form-control" name="pegawai_name" placeholder="Nama Pegawai">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Perusahaan:  
			</label>
			<select name="id_company" class="form-control" required>
				<option value=''>- Select -</option>
				<?php foreach($company as $com){?>
				<option value='<?php echo $com->id; ?>'><?php echo $com->company_name; ?></option>
				<?php } ?>
			</select>
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jabatan:  
			</label>
			<input class="form-control" name="pegawai_jabatan" placeholder="Jabatan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kontak:  
			</label>
			<input class="form-control" name="pegawai_kontak" placeholder="Kontak">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Foto Pegawai:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal tambah data end -->

<!-- modal update data start -->

<div class="modal fade" id="myModalManual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Update Data Pegawai</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action = "<?php echo site_url('dashboard/update_pegawai'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
			  																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Pegawai:  
			</label>
			<input class="form-control" name="pegawai_name" id="pegawai_name" placeholder="Nama Pegawai">
			<input type='hidden' name="id_peg" id="id_peg">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Perusahaan:  
			</label>
			<select name="id_company" id="id_company" class="form-control" required>
				<option value=''>- Select -</option>
				<?php foreach($company as $com){?>
				<option value='<?php echo $com->id; ?>'><?php echo $com->company_name; ?></option>
				<?php } ?>
			</select>
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jabatan:  
			</label>
			<input class="form-control" name="pegawai_jabatan" id="pegawai_jabatan" placeholder="Jabatan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kontak:  
			</label>
			<input class="form-control" name="pegawai_kontak" id="pegawai_kontak" placeholder="Kontak">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Foto Pegawai:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
          </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> &nbsp;Update Data</button>
		  </div>
			</form>
		</div>
	  </div>
	</div>
</div>
<!-- modal update data end -->
<script type="text/javascript">
	function reply_click(clicked_id){
		var id = clicked_id;
		$(document).ready(function() {
			$.ajax ({
				type: 'post',
				url: "<?php echo base_url();?>ajax/get_pegawai",
				dataType: "json",
				data:"id="+id,
				success:function(data){
					if(data == 'kosong'){
						$('#nama_penerima').val('Npp Tidak Terdaftar');
						$('#rekening_penerima').val('Npp Tidak Terdaftar');
					}else{
						$.each(data,function(i,n){
							$('#pegawai_name').val(n['pegawai_name']);
							$('#pegawai_jabatan').val(n['pegawai_jabatan']);
							$('#pegawai_kontak').val(n['pegawai_kontak']);
							$('#id_peg').val(n['id']);
						});
					}
				},
				error: function(data){
					alert('Error input data');	
				}
			});
		});
	}
</script>
