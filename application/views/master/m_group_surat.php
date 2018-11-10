
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3><i class="fa fa-list"></i> Data Perusahaan <?php echo $title; ?></h3>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">	
				<ol class="breadcrumb">
				  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
				  <li><a href="#">Data Master</a></li>
				  <li class="active">Perusahaan <?php echo $title; ?></li>
				</ol>	
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
						<th >Nama Perusahaan</th>
						<th >SK Haji</th>
						<th >Tgl. SK Haji</th>
						<th >Kontak</th>
						<th >PIHK</th>
						<th >PPIU</th>
						<th >Iuran</th>
						<th >Keterangan</th>
						<th width='10%'>Action</th>
					</tr>
				</thead>
				<tbody>
			   <?php
				$no = 1;
				if($data_grid){
					foreach($data_grid as $row){
						if($row->company_anggaran == 0){
							$warna = 'danger';
							$icon = 'glyphicon glyphicon-remove';
						}else{
							$warna = 'success';
							$icon = 'glyphicon glyphicon-ok';
						}
				?>
						<th><?php echo $no;$no++;?></th>
						<th> <a href="<?php echo site_url('dashboard/detail_company/').'/'.$row->id; ?>"><?php echo $row->company_name; ?><a/></th>
						<th> <?php echo $row->company_sk; ?></th>
						<th> <?php echo $row->tgl_sk; ?></th>
						<th> <?php echo $row->company_contact; ?></th>
						<th> <?php if($row->pihk_group == '0'){ ?>
							<button type="button" class="btn btn-success btn-sm" >
							  <i class="glyphicon glyphicon-ok"></i>
							</button>
						<?php } ?></th>
						<th> <?php if($row->pihk_group == '1'){ ?>
							<button type="button" class="btn btn-success btn-sm" >
							  <i class="glyphicon glyphicon-ok"></i>
							</button>
						<?php } ?></th>
						<th> 
							<a type="button" class="btn btn-<?php echo $warna; ?> btn-sm" onclick='disen(<?php echo $row->id; ?> )' id ='<?php echo $row->id; ?>' >
								<i class="<?php echo $icon; ?>" id ='icon<?php echo $row->id; ?>' ></i>
							</a> 
						</th>
						<th> <?php echo $row->keterangan; ?></th>
						<th> 
							<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalManual">
							  <i class="fa fa-pencil"></i>
							</button>
							<a href="<?php echo site_url('dashboard/qr_view').'/'.$row->id; ?>" type="button" class="btn btn-success btn-sm">
								 <i class="fa fa-qrcode"></i>
							</a>
							<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_data_perusahaan'; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->company_name; ?> ?')">
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
        <h4 class="modal-title" id="myModalLabel">Tambah Data Perusahaan</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url('dashboard/input_company'); ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Perusahaan:  
			</label>
			<input class="form-control" name="company_name" placeholder="Nama Perusahaan">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kontak Perusahaan:  
			</label>
			<input class="form-control" name="company_contact" placeholder="Kontak Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">SK Perusahaan:  
			</label>
			<input class="form-control" name="company_sk" placeholder="SK Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Perusahaan:  
			</label>
			<input class="form-control" name="tgl_sk" id='tgl_1' placeholder="Tgl SK Perusahaan">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Alamat Perusahaan:  
			</label>
			<input class="form-control" name="company_addres" placeholder="Alamat">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Logo Perusahaan:  
			</label>
			<input class="form-control" type="file" name="file_1" / >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Logo Perusahaan:  
			</label>
			<input class="form-control" type="file" name="file_2" / >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Logo Perusahaan:  
			</label>
			<input class="form-control" type="file" name="file_3" / >
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
			<h4 class="modal-title" id="myModalLabel">Send Manual Email</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action = "<?php echo site_url('dashboard/update_company'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
			  																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Perusahaan:  
			</label>
			<input class="form-control" name="company_name" id="company_name" placeholder="Nama Perusahaan">
			<input type='hidden' name="id_com" id="id_com" >
			<input type='hidden' name="jenis" value=<?php echo $jenis; ?> >
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kontak Perusahaan:  
			</label>
			<input class="form-control" name="company_contact" id="company_contact" placeholder="Kontak Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">SK Haji:  
			</label>
			<input class="form-control" name="company_sk" id="company_sk" placeholder="SK Perusahaan">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Haji:  
			</label>
			<input class="form-control" name="tgl_sk" id='tgl_2' placeholder="Tgl SK Perusahaan">
          </div>													
          <div class="form-group">
            <label for="recipient-name" class="control-label">No SK Umroh:  
			</label>
			<input class="form-control" name="company_sk" id="sk_umroh" placeholder="No SK Umroh">
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl SK Umroh:  
			</label>
			<input class="form-control" name="tgl_sk_umroh" id='tgl_3' placeholder="Tgl SK Umrah">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Alamat Perusahaan:  
			</label>
			<input class="form-control" name="company_addres" id='company_addres' placeholder="Alamat">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keterangan:  
			</label>
			<input class="form-control" name="keterangan" id='keterangan' placeholder="keterangan">
          </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Update Data</button>
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
				url: "<?php echo base_url();?>ajax/get_company",
				dataType: "json",
				data:"id="+id,
				success:function(data){
					if(data == 'kosong'){
						$('#nama_penerima').val('Npp Tidak Terdaftar');
						$('#rekening_penerima').val('Npp Tidak Terdaftar');
					}else{
						$.each(data,function(i,n){
							$('#company_name').val(n['company_name']);
							$('#company_anggaran').val(n['company_anggaran']);
							$('#company_contact').val(n['company_contact']);
							$('#company_addres').val(n['company_addres']);
							$('#id_com').val(n['id']);
							$('#keterangan').val(n['keterangan']);
							$('#company_sk').val(n['company_sk']);
							$('#tgl_2').val(n['tgl_sk']);
							$('#tgl_3').val(n['tgl_sk_umroh']);
							$('#sk_umroh').val(n['sk_umroh']);
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
			url: "<?php echo base_url();?>ajax/update_anggaran",
			dataType: "json",
			data:"id="+id,
			success:function(data){	
				if(data.flag == 0){
					document.getElementById(id).className = "btn btn-danger btn-sm";
					document.getElementById('icon'+id).className = "glyphicon glyphicon-remove";
				}else{
					document.getElementById(id).className = "btn btn-success btn-sm";
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
