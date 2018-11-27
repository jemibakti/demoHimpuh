
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3><i class="fa fa-list"></i> Data Member of Invitation</h3>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">	
				<ol class="breadcrumb">
				  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
				  <li><a href="#">Data Master</a></li>
				  <li class="active">Member of Invitation</li>
				</ol>	
		<div class="table-responsive">
			<table class="table table-striped table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th colspan ='2'>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
							  <i class="fa fa-pencil"></i> Tambah Data
							</button>
						</th>
						<td colspan = '5'><a class="btn btn-lg btn-warning btn-block" href="<?php echo site_url('dashboard/data_pegawai/exp'); ?>"><i class="fa fa-file"></i> Export Excell</a></td>
					</tr>
					<tr class="warning">
						<th >#</th>
						<th >Pegawai</th>
						<th >Perusahaan</th>
						<th >Jabatan</th>
						<th >Kontak</th>
						<th >Email</th>
						<th width='10%'>Action</th>
					</tr>
				</thead>
				<tbody>
			   <?php
				$no = 1;
				
				if($data_grid){
					foreach($data_grid as $row){
				?>
						<th><?php echo $no;$no++;?></th>
						<th> <a href="<?php echo site_url('pendaftaran/view_pendaftaran/').'/'.$row->id; ?>"><?php echo $row->pegawai_name; ?><a/></th>
						<th> <?php echo $row->company_name; ?></th>
						<th> <?php echo $row->pegawai_jabatan; ?></th>
						<th> <?php echo $row->pegawai_kontak; ?></th>
						<th> <?php echo $row->company_email; ?></th>
						<th> 
							<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalManual">
							  <i class="fa fa-pencil"></i>
							</button>
							<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_data_pegawai'; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->company_name; ?> ?')">
								 <i class="fa fa-bitbucket"></i>
							</a>
						</th>
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
							$('#id_company').val(n['id_company']);
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
