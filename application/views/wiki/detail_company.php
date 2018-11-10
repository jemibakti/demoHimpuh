<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3><i class="fa fa-list"></i> Data Perusahaan <?php echo $perusahaan[0]['company_name']; ?></h3>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">	
		<ol class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		  <li><a href="#">Data Master</a></li>
		  <li><a href="#">Perusahaan</a></li>
		  <li class="active">Detail Perusahaan</li>
		</ol>							
		<div class="col-lg-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Logo Perusahaan</h4>
				</div>
				<div class="panel-body text-center">
					<div class="portfolio-item">
						<a href="#">
							<img class="img-portfolio img-responsive" src="<?php echo base_url('upload/company/').'/'.$perusahaan[0]['company_pic']; ?>">
						</a>
					</div>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_file">
					  <i class="fa fa-file"></i> Update Logo
					</button>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Foto Kantor</h4>
					<?php  
							$filename = "upload/company/".$perusahaan[0]['company_building'];
							if(file_exists($filename)) {
								$gedung =  base_url('upload/company').'/'.$perusahaan[0]['company_building'];
							} else {
								$gedung = base_url('upload/foto/no_image.jpg');
							}
					?>
				</div>
				<div class="panel-body text-center">
					<div class="portfolio-item">
						<a href="#">
							<img class="img-portfolio img-responsive" src="<?php echo $gedung; ?>">
						</a>
					</div>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_file1">
					  <i class="fa fa-file"></i> Update Logo
					</button>
				</div>
			</div>
			<?php if($this->session->userdata('logged_in')['user_level'] == 0){?>
			<div class="panel panel-primary">
				<?php  
						$filename = "upload/company/".$perusahaan[0]['company_stempel'];
						
						if(file_exists($filename)) {
							$link =  base_url('upload/company').'/'.$perusahaan[0]['company_stempel'];
						} else {
							$link = base_url('upload/foto/no_image.jpg');
						}
				?>
				<div class="panel-heading">
					<h4>Gambar Stempel</h4>
				</div>
				<div class="panel-body text-center">
					<div class="portfolio-item">
						<a href="#">
							<img class="img-portfolio img-responsive" src="<?php echo $link; ?>">
						</a>
					</div>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_file3">
					  <i class="fa fa-file"></i> Update Logo
					</button>
				</div>
			</div>
			<div class="panel panel-primary">
				<?php  
						$filename = "upload/company/".$perusahaan[0]['company_ttd'];
						
						if(file_exists($filename)) {
							$link =  base_url('upload/company').'/'.$perusahaan[0]['company_ttd'];
						} else {
							$link = base_url('upload/foto/no_image.jpg');
						}
				?>
				<div class="panel-heading">
					<h4>Gambar Ttd</h4>
				</div>
				<div class="panel-body text-center">
					<div class="portfolio-item">
						<a href="#">
							<img class="img-portfolio img-responsive" src="<?php echo $link; ?>">
						</a>
					</div>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_file2">
					  <i class="fa fa-file"></i> Update Logo
					</button>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class='col-lg-10'>
			<div class="alert alert-success alert-dismissible" role="alert">
			<h3>Detail Perusahaan</h3>
			   <h4>
			   <table class="table table-striped table-hover">
				<tr>
					<td width="20%">Merk Dagang</td><td>: <?php echo $perusahaan[0]['company_brand']; ?></td>
				</tr>
				<tr>
					<td>Nama Pimpinan</td><td>: <?php if($peg){ echo word($peg[0]['pegawai_name']); } ?></td>
				</tr>
				<tr>
					<td>No. Reg</td><td>: <?php echo $perusahaan[0]['company_reg']; ?></td>
				</tr>
				<tr>
					<td>No. Sk Haji</td><td>: <?php echo $perusahaan[0]['company_sk']; ?></td>
				</tr>
				<tr>
					<td>No Sk Umroh</td><td>: <?php echo $perusahaan[0]['sk_umroh']; ?></td>
				</tr>
				<tr>
					<td>Telepon</td><td>: <?php echo $perusahaan[0]['company_contact']; ?></td>
				</tr>
				<tr>
					<td>Email</td><td>: <?php echo $perusahaan[0]['company_email']; ?></td>
				</tr>
				<tr>
					<td>Website</td><td>: <a href="http://<?php echo $perusahaan[0]['company_web']; ?>" target="_blank" ><?php echo $perusahaan[0]['company_web']; ?></a></td>
				</tr>
				<tr>
					<td>Alamat</td><td>: <?php echo $perusahaan[0]['company_addres']." | ".$perusahaan[0]['kota']; ?></td>
				</tr>
				
			   </table>
			   </h4	>
			</div>
			<hr/>		
			<h3>STRUKTUR PERUSAHAAN </h3><h4><?php echo $perusahaan[0]['company_name']; ?></h4>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th colspan ='4'>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								  <i class="fa fa-pencil"></i> Tambah Data
								</button>
							</th>
							<th colspan='2'></th>
						</tr>
						<tr class="warning">
							<th >#</th>
							<th >PIC</th>
							<th >Nama</th>
							<th >Jabatan</th>
							<th >Kontak</th>
							<th >Inv</th>
							<th width='10%'>Action</th>
						</tr>
					</thead>
					<tbody>
				   <?php
					$no = 1;
					
					if($data_grid){
						foreach($data_grid as $row){
						if($row->flag_undangan == 0){
							$warna = 'danger';
							$icon = 'glyphicon glyphicon-remove';
						}else{
							$warna = 'success';
							$icon = 'glyphicon glyphicon-ok';
						}
					?>
							<th><?php echo $no;$no++;?></th>
							<th>							
								<div class="portfolio-item">
									<a href="#">
										<img class="img-portfolio img-responsive" src="<?php echo base_url('upload/foto/').'/'.$row->pegawai_pic; ?>" width="50px">
									</a>
								</div>
							</th>
							<th> <a href="<?php echo site_url('pendaftaran/view_pendaftaran/').'/'.$row->id; ?>"><?php echo $row->pegawai_name; ?><a/></th>
							<th> <?php echo $row->pegawai_jabatan; ?></th>
							<th> <?php echo $row->pegawai_kontak; ?></th>
							<th> 
								<a type="button" class="btn btn-<?php echo $warna; ?> btn-xs" onclick='disen(<?php echo $row->id; ?> )' id ='<?php echo $row->id; ?>' >
									<i class="<?php echo $icon; ?>" id ='icon<?php echo $row->id; ?>' ></i>
								</a> 
							</th>
							<th> 
								<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalManual">
								  <i class="fa fa-pencil"></i>
								</button>
								<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_detail_company_uri_'.$row->id_company; ?>" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->pegawai_name; ?> ?')">
									 <i class="fa fa-bitbucket"></i>
								</a>
							</th>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
		<hr/>		
		<h3>Berkas Perusahaan </h3>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th colspan ='4'>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								  <i class="fa fa-user"></i> Tambah Data Struktur Perusahaan
								</button>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalberkas">
								  <i class="fa fa-file"></i> Tambah Berkas
								</button>
							</th>
						</tr>
						<tr class="warning">
							<th width="6%">#</th>
							<th >Keterangan</th>
							<th >File</th>
							<th width='10%'>Action</th>
						</tr>
					</thead>
					<tbody>
				   <?php
					$no = 1;
					
					if($berkas){
						foreach($berkas as $row){
					?>
							<th><?php echo $no;$no++;?></th>
							<th> <?php echo $row->keterangan; ?></th>
							<th> 
								<a href="<?php echo base_url().'upload/berkas/'.$row->nama_file; ?>" type="button" class="btn btn-success btn-xs" target="_BLANK">
									<i class="fa fa-file"></i>
								</a> 
							</th>
							<th> 
								<a href="<?php echo site_url($delete_berkas).'/'.$row->id.'/dashboard_uri_detail_company_uri_'.$perusahaan[0]['id']; ?>" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->keterangan; ?> ?')">
									 <i class="fa fa-bitbucket"></i>
								</a>
							</th>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
			</div>
			</div>
		</div>		
	</div>
</div>
<?php if($this->session->userdata('logged_in')['user_level'] == 0){?>
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
			<input type='hidden' name="id_company" id="id_company" value='<?php echo $perusahaan[0]['id']; ?>'>
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
            <label for="recipient-name" class="control-label">Email:  
			</label>
			<input class="form-control" name="pegawai_email" placeholder="Kontak">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keterangan:  
			</label>
			<input class="form-control" name="pegawai_keterangan" placeholder="Keterangan">
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

<!-- modal tambah berkas-->
<div class="modal fade" id="myModalberkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Berkas</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url().'report/tambah_berkas/'.$perusahaan[0]['id']; ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          														
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keterangan:  
			</label>
			<input class="form-control" name="keterangan" placeholder="keterangan">
          </div>		
		  <div class="form-group">
            <label for="recipient-name" class="control-label">Upload Berkas:  
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
			<input type='hidden' name="id_company" id="id_company" value='<?php echo $perusahaan[0]['id']; ?>'>
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
            <label for="recipient-name" class="control-label">Email:  
			</label>
			<input class="form-control" name="pegawai_email" id="pegawai_email" placeholder="Kontak">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keterangan:  
			</label>
			<input class="form-control" name="pegawai_keterangan" id="pegawai_keterangan" placeholder="Keterangan">
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

<!-- modal update file-->
<div class="modal fade" id="update_file1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Berkas</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url().'report/update_file_company/company_building'; ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
		  <div class="form-group">
            <label for="recipient-name" class="control-label">Upload Berkas:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
			<input name="id" type="hidden" value="<?php echo $perusahaan[0]['id']; ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal update file end -->
<!-- modal update file-->
<div class="modal fade" id="update_file2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Berkas</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url().'report/update_file_company/company_ttd'; ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
		  <div class="form-group">
            <label for="recipient-name" class="control-label">Upload Berkas:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
			<input name="id" type="hidden" value="<?php echo $perusahaan[0]['id']; ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal update file end -->
<!-- modal update file-->
<div class="modal fade" id="update_file3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Berkas</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url().'report/update_file_company/company_stempel'; ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
		  <div class="form-group">
            <label for="recipient-name" class="control-label">Upload Berkas:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
			<input name="id" type="hidden" value="<?php echo $perusahaan[0]['id']; ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal update file end -->
<!-- modal update file-->
<div class="modal fade" id="update_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Berkas</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url().'report/update_file_company/company_pic'; ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
		  <div class="form-group">
            <label for="recipient-name" class="control-label">Upload Berkas:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
			<input name="id" type="hidden" value="<?php echo $perusahaan[0]['id']; ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload Data</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal update file end -->
<?php } ?>
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
							$('#pegawai_email').val(n['pegawai_email']);
							$('#pegawai_keterangan').val(n['pegawai_keterangan']);
							$('#id_peg').val(id);
						});
					}
				},
				error: function(data){
					alert('Error input data');	
				}
			});
		});
	}
	
function disen(id){
	var id = id;
	$(document).ready(function() {
		$.ajax ({
			type: 'post',
			url: "<?php echo base_url();?>ajax/update_invitation",
			dataType: "json",
			data:"id="+id,
			success:function(data){	
				if(data.flag == 0){
					document.getElementById(id).className = "btn btn-danger btn-xs";
					document.getElementById('icon'+id).className = "glyphicon glyphicon-remove";
				}else{
					document.getElementById(id).className = "btn btn-success btn-xs";
					document.getElementById('icon'+id).className = "glyphicon glyphicon-ok";
				}
				if(data.status=="FAIL"){
					alert('Gagal input data');	
				}			
			},
			error: function(data){
				alert('Error input data');	
			}		
		});
	});
}
</script>
