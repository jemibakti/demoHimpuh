
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3><i class="fa fa-list"></i> <?php echo $title; ?></h3>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">	
				<ol class="breadcrumb">
				  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
				  <li><a href="#">Data Master</a></li>
				  <li class="active"><?php echo $title; ?></li>
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
						<th >Nama Group</th>
						<th >Kode Group</th>
						<th >Keterangan</th>
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
						<th> <a href="<?php echo site_url('dashboard/detail_company/').'/'.$row->id; ?>"><?php echo $row->group_name; ?><a/></th>
						<th> <?php echo $row->group_code; ?></th>
						<th> <?php echo $row->group_ket; ?></th>
						<th> 
							<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalManual">
							  <i class="fa fa-pencil"></i>
							</button>
							<a href="<?php echo site_url('dashboard/qr_view').'/'.$row->id; ?>" type="button" class="btn btn-success btn-sm">
								 <i class="fa fa-qrcode"></i>
							</a>
							<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_m_surat_group'; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->group_name; ?> ?')">
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
        <h4 class="modal-title" id="myModalLabel">Tambah Data Group Surat</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url('dashboard/global_input/m_surat_group'); ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Group Surat:  
			</label>
			<input class="form-control" name="group_name" placeholder="Nama Group Surat">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode Group :  
			</label>
			<input class="form-control" name="group_code" placeholder="Kode Group">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keterangan: 
			</label>
			<input class="form-control" name="group_ket" placeholder="Keterangan">
          </div>	
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
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
			<form method="post" action = "<?php echo site_url('dashboard/global_update/m_surat_group'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="form-group">
            <label for="recipient-name" class="control-label">Nama Group Surat:  
			</label>
			<input class="form-control" name="group_name" id="group_name" placeholder="Nama Group Surat">
			<input type='hidden' name="id" id="id" >
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kode Group :  
			</label>
			<input class="form-control" name="group_code" id="group_code" placeholder="Kode Group">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keterangan: 
			</label>
			<input class="form-control" name="group_ket" id="group_ket" placeholder="Keterangan">
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
				url: "<?php echo base_url();?>ajax/get_ajax/m_surat_group",
				dataType: "json",
				data:"id="+id,
				success:function(data){
					if(data == 'kosong'){
						$('#nama_penerima').val('Npp Tidak Terdaftar');
						$('#rekening_penerima').val('Npp Tidak Terdaftar');
					}else{
						$.each(data,function(i,n){
							$('#id').val(n['id']);
							$('#group_name').val(n['group_name']);
							$('#group_code').val(n['group_code']);
							$('#group_ket').val(n['group_ket']);
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
