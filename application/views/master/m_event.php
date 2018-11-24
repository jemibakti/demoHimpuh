
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
						<th >Nama Kegiatan</th>
						<th >Tgl. Kegiatan</th>
						<th >Tgl. Akhir</th>
						<th >Mulai</th>
						<th >Akhir</th>
						<th >Keterangan</th>
						<?php if($jenis == 1){?>
						<th >Display</th>
						<th >Hadir</th>
						<th >Telat</th>
						<th >Abstaint</th>
						<?php } ?>
						<th width='13%'>Action</th>
					</tr>
				</thead>
				<tbody>
			   <?php
				$no = 1;
				if($data_grid){
					foreach($data_grid as $row){
						
				?>
						<th><?php echo $no;$no++;?></th>
						<th> <a href="<?php echo site_url('dashboard/create_sess_event/').'/'.$row->id.'/'.$jenis; ?>"><?php echo $row->event_name; ?><a/></th>
						<th> <?php echo $row->event_date; ?></th>
						<th> <?php echo $row->event_date_end; ?></th>
						<th> <?php echo $row->event_start; ?></th>
						<th> <?php echo $row->event_end; ?></th>
						<th> <?php echo $row->keterangan; ?></th>
						<?php if($jenis == 1){?>
						<th>
							<a href="<?php echo site_url().'dashboard/report_kehadiran/'.$row->id.'/ok'; ?>" type="button" class="btn btn-warning btn-sm">
								 <i class="fa fa-list"></i>
							</a>
						</th>
						<th>
							<a href="<?php echo site_url().'dashboard/report_kehadiran/'.$row->id; ?>" type="button" class="btn btn-success btn-sm" >
								 <i class="fa fa-clock-o"></i>
							</a>
						</th>
						<th>
							<a href="<?php echo site_url().'dashboard/data_telat/'.$row->id; ?>" type="button" class="btn btn-warning btn-sm">
								 <i class="fa fa-clock-o"></i>
							</a>
						</th>
						<th>
							<a href="<?php echo site_url().'dashboard/report_kehadiran/null/'.$row->id.'/ok'; ?>" type="button" class="btn btn-danger btn-sm">
								 <i class="fa fa-clock-o"></i>
							</a>
						</th>
						<?php } ?>
						<th> 
							<a href="<?php echo site_url('dashboard/create_sess_event').'/'.$row->id.'/'.$jenis; ?>" type="button" class="btn btn-success btn-sm">
								 <i class="fa fa-qrcode"></i>
							</a>
							<?php if($jenis == 1){?>
							<button type="button" id ='<?php echo $row->id; ?>'  onClick="get_id(this.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalfile">
							  <i class="fa fa-file"></i>
							</button>
							<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalManual">
							  <i class="fa fa-pencil"></i>
							</button>
							<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_event_uri_'.$jenis; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->event_name; ?> ?')">
								 <i class="fa fa-bitbucket"></i>
							</a>
							<?php } ?>
						</th>
					</tr>
				<?php
					}}
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
        <h4 class="modal-title" id="myModalLabel">Tambah Data Kegiatan</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "<?php echo site_url().'dashboard/input_event/'.$jenis; ?>" enctype="multipart/form-data" accept-charset="utf-8">																		
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nama Kegiatan:  
			</label>
			<input class="form-control" name="event_name" placeholder="Nama Kegiatan">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl Kegiatan:  
			</label>
			<input class="form-control" name="event_date" id='tgl_2' placeholder="Tgl Kegiatan">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl Berakhir:  
			</label>
			<input class="form-control" name="event_date_end" id='tgl_3' placeholder="Tgl Kegiatan">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jam Mulai:  
			</label>
			<input class="form-control" name="event_start" placeholder="Waktu Mulai">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jam Selesai:  
			</label>
			<input class="form-control" name="event_end" placeholder="Waktu Selesai">
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
			<h4 class="modal-title" id="myModalLabel">Update Kegiatan</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action = "<?php echo site_url().'dashboard/update_event/'.$jenis; ?>" enctype="multipart/form-data" accept-charset="utf-8">
			<div class="form-group">
            <label for="recipient-name" class="control-label">Nama Kegiatan:  
			</label>
			<input class="form-control" name="event_name" id="event_name" placeholder="Nama Kegiatan">
			<input type='hidden' name="id" id="id">
          </div>															
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl Kegiatan:  
			</label>
			<input class="form-control" name="event_date" id="tgl_1" placeholder="Tgl Kegiatan">
          </div>														
          <div class="form-group">
            <label for="recipient-name" class="control-label">Tgl Berakhir:  
			</label>
			<input class="form-control" name="event_date_end" id='tgl_4' placeholder="Tgl Kegiatan">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jam Mulai:  
			</label>
			<input class="form-control" name="event_start" id="event_start" placeholder="Waktu Mulai">
          </div>	
          <div class="form-group">
            <label for="recipient-name" class="control-label">Jam Selesai:  
			</label>
			<input class="form-control" name="event_end" id="event_end" placeholder="Waktu Selesai">
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
<div class="modal fade" id="myModalfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Upload File</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action = "<?php echo site_url('dashboard/upload_file/event_file'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
			
          <div class="form-group">
            <label for="recipient-name" class="control-label">File Kegiatan
			<input class="form-control" type="file" name="file_1" / >
			<input type='hidden' name="id_file" id="id_file">
			<input type='hidden' name="direct" id="direct">
          </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Upload File</button>
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
				url: "<?php echo base_url();?>ajax/get_ajax/m_event",
				dataType: "json",
				data:"id="+id,
				success:function(data){
					if(data == 'kosong'){
						$('#nama_penerima').val('Npp Tidak Terdaftar');
						$('#rekening_penerima').val('Npp Tidak Terdaftar');
					}else{
						$.each(data,function(i,n){
							$('#id').val(n['id']);
							$('#event_name').val(n['event_name']);
							$('#tgl_1').val(n['event_date']);
							$('#tgl_4').val(n['event_date_end']);
							$('#event_start').val(n['event_start']);
							$('#event_end').val(n['event_end']);
							$('#keterangan').val(n['keterangan']);
						});
					}
				},
				error: function(data){
					alert('Error input data');	
				}
			});
		});
	}
	
	function get_id(clicked_id){
		var id = clicked_id;
		$('#id_file').val(id);
		$('#direct').val('event/1');
	}
	
function disen(id){
	var id = id;
	$(document).ready(function() {
		$.ajax ({
			type: 'post',
			url: "<?php echo base_url();?>get_ajax/m_event",
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