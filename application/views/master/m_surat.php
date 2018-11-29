
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3><i class="fa fa-list"></i> Data Surat <?php echo $jenis_;?></h3>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">	
				<ol class="breadcrumb">
				  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
				  <li><a href="#">Surat</a></li>
				  <li class="active">Surat <?php echo $jenis_;?></li>
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
						<th >Nomer Reg.</th>
						<th >Nomor Surat</th>
						<th >Pengirim</th>
						<th >Tujuan</th>
						<th >Perihal</th>
						<th width='10%'>Action</th>
					</tr>
				</thead>
				<tbody>
			   <?php
				$no = 1;
				
				if($data_grid){
					foreach($data_grid as $row){
					$reg = substr('000'.$row->surat_reg,-4);
					$no_reg = 'HMP/'.$row->surat_group.'/'.$row->surat_reg.'/'.$reg;
				?>
						<th><?php echo $no;$no++;?></th>
						<th> <a href="<?php echo site_url('pendaftaran/view_pendaftaran/').'/'.$row->id; ?>"><?php echo $no_reg; ?><a/></th>
						<th> <?php echo $row->surat_number; ?></th>
						<th> <?php echo $row->surat_from; ?></th>
						<th> <?php echo $row->surat_to; ?></th>
						<th> <?php echo $row->surat_perihal; ?></th>
						<th> 
							<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalManual">
							  <i class="fa fa-pencil"></i>
							</button>
							<a href="<?php echo site_url().'upload/persuratan/'.$row->surat_file; ?>" type="button" class="btn btn-success btn-sm" target='_blank' >
								 <i class="fa fa-file"></i>
							</a>
							<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_surat_uri_'.$jenis; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus Surat No <?php echo $no_reg; ?> ?')">
								 <i class="fa fa-bitbucket"></i>
							</a>
						</th>
					</tr>
				<?php
					}
				}else{
				?>
					<tr>
						<th colspan='7'>tidak ditemukan</th>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Tambah Data Surat</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url('dashboard/input_surat'); ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nomer Surat:  
			</label>
			<input class="form-control" name="surat_number" placeholder="Nomer Surat">
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jenis Surat:  
			</label>
			<select name="surat_jenis" id="surat_jenis" class="form-control" required onChange='getReg()'>
				<option value=''>- Select -</option>
				<option value='m'>Masuk</option>
				<option value='k'>Keluar</option>
			</select>
          </div>																	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Grouping Surat:  
			</label>
			<select name="surat_group" id="surat_group" class="form-control" required onChange='getReg()'>
				<option value=''>- Select -</option>
				<?php foreach($group as $sel){ ?>
				<option value='<?php echo $sel->group_code; ?>'>- <?php echo $sel->group_name; ?> -</option>
				<?php }?>
			</select>
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nomer Reg:  
			</label>
			<input class="form-control" name="no_surat_reg" id="no_surat_reg" placeholder="Nomer Reg" readonly>
			<input type='hidden' name="surat_reg" id="surat_reg" >
          </div>																
          <div class="form-group">
            <label for="recipient-name" class="control-label">Pengirim:  
			</label>
			<input class="form-control" name="surat_from" placeholder="Pengirim">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tujuan:  
			</label>
			<input class="form-control" name="surat_to" placeholder="Tujuan">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl Surat:  
			</label>
			<input class="form-control" id="tgl_1" name ='tgl_surat' placeholder="yyyy-mm-dd">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl Act:  
			</label>
			<input class="form-control" id="tgl_2" name ='tgl_act' placeholder="yyy-mm-dd">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Perihal:  
			</label>
			<input class="form-control" name="surat_perihal" placeholder="Perihal">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Keyword:  
			</label>
			<input class="form-control" name="surat_kontent" placeholder="Keyword">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Lampiran Surat:  
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
			<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Update Data Surat</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action = "<?php echo site_url('dashboard/update_surat'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
																					
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Nomer Surat:  
				</label>
				<input class="form-control" name="surat_number" id="surat_number" placeholder="Nomer Surat">
			  </div>																
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Jenis Surat:  
				</label>
				<select name="surat_jenis" id="surat_jenis_" class="form-control" required readonly>
					<option value=''>- Select -</option>
					<option value='m'>Masuk</option>
					<option value='k'>Keluar</option>
				</select>
			  </div>																
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Grouping Surat:  
				</label>
				<select name="surat_group" id="surat_group_1" class="form-control" required readonly>
					<option value=''>- Select -</option>
					<?php foreach($group as $sel){ ?>
					<option value='<?php echo $sel->group_code; ?>'>- <?php echo $sel->group_name; ?> -</option>
					<?php }?>
				</select>
			  </div>																
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Pengirim:  
				</label>
				<input class="form-control" name="surat_from" id="surat_from" placeholder="Pengirim">
			  </div>	
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Tujuan:  
				</label>
				<input class="form-control" name="surat_to" id="surat_to" placeholder="Tujuan">
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Tgl Surat:  
				</label>
				<input class="form-control" id="tgl_3" name ='tgl_surat' placeholder="yyyy-mm-dd">
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Tgl Act:  
				</label>
				<input class="form-control" id="tgl_4" name ='tgl_act' placeholder="yyy-mm-dd">
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Perihal:  
				</label>
				<input class="form-control" name="surat_perihal" id="surat_perihal" placeholder="Perihal">
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Keyword:  
				</label>
				<input class="form-control" name="surat_kontent" id="surat_kontent" placeholder="Keyword">
			  </div>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Lampiran Surat:  
				</label>
				<input class="form-control" type="file" name="file_1" / >
			  </div>
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
				url: "<?php echo base_url();?>ajax/get_ajax/m_surat",
				dataType: "json",
				data:"id="+id,
				success:function(data){
					if(data == 'kosong'){
						$('#nama_penerima').val('Npp Tidak Terdaftar');
						$('#rekening_penerima').val('Npp Tidak Terdaftar');
					}else{
						$.each(data,function(i,n){
							$('#surat_number').val(n['surat_number']);
							$('#surat_group_1').val(n['surat_group']);
							$('#no_surat_reg_1').val(n['no_surat_reg']);
							$('#surat_jenis_').val(n['surat_jenis']);
							$('#surat_from').val(n['surat_from']);
							$('#surat_to').val(n['surat_to']);
							$('#tgl_3').val(n['tgl_surat']);
							$('#tgl_4').val(n['tgl_act']);
							$('#surat_perihal').val(n['surat_perihal']);
							$('#surat_kontent').val(n['surat_kontent']);
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
	
	function getReg(){
		var jenis = document.getElementById("surat_jenis").value;
		var group = document.getElementById("surat_group").value;
		
		$(document).ready(function() {
			$.ajax ({
				type: 'post',
				url: "<?php echo base_url();?>ajax/last_surat_reg",
				dataType: "json",
				data:"jenis="+jenis,
				success:function(data){
					if(data == 'kosong'){
						$('#nama_penerima').val('Npp Tidak Terdaftar');
						$('#rekening_penerima').val('Npp Tidak Terdaftar');
					}else{
						$.each(data,function(i,n){
							rgg = n['reg'];
							regs = 'HMP/'+group+'/'+jenis.toUpperCase()+'/'+rgg;
							$('#surat_reg').val(rgg);
							$('#no_surat_reg').val(regs);
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
