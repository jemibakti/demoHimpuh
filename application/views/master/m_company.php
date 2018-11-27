
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
							<a href="<?php echo site_url('report/export_company'); ?>" type="button" class="btn btn-success">
								 <i class="fa fa-file"></i> Export Data
							</a>
						</th>
						<th colspan='2'></th>
					</tr>
					<tr class="warning">
						<th >#</th>
						<th width="20%">Nama Perusahaan</th>
						<th >No Anggota</th>
						<th >Nama Pimpinan</th>
						<th >Kontak Pimpinan</th>
						<th >Kontak Perusahaan</th>
						<th >Email Perusahaan</th>
						<th >PIHK</th>
						<th >PPIU</th>
						<th >Iuran</th>
						<?php if($this->session->userdata('logged_in')['user_level'] == 0){?><th width='10%'>Action</th><?php } ?>
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
						
						$where =array(
							array('kolom'=>'a.active_flag','value'=>'0'),
							array('kolom'=>'a.pegawai_jabatan','value'=>'Direktur Utama'),
							array('kolom'=>'a.id_company','value'=>$row->id)
						);
						$order =array(
							array('kolom'=>'a.pegawai_name','value'=>'asc')
						);
						$pimpinan = $this->Model_dop->global_model_array('m_pegawai a',false,$where,false,false,$order,false,false,false);
				?>
						<th><?php echo $no;$no++;?></th>
						<th> <a href="<?php echo site_url('dashboard/detail_company/').'/'.$row->id; ?>"><?php echo $row->company_name; ?><a/></th>
						<th> <?php echo $row->company_reg; ?></th>
						<th> <?php if($pimpinan){ echo $pimpinan[0]['pegawai_name']; }else{ echo '-'; } ?></th>
						<th> <?php if($pimpinan){ echo $pimpinan[0]['pegawai_kontak']; }else{ echo '-'; } ?></th>
						<th> <?php echo $row->company_contact; ?></th>
						<th> <?php echo $row->company_email; ?></th>
						<th> <?php if($row->pihk_group == '0'){ ?>
							<button type="button" class="btn btn-success btn-xs" >
							  <i class="glyphicon glyphicon-ok"></i>
							</button>
						<?php } ?></th>
						<th> <?php if($row->pihk_group == '1'){ ?>
							<button type="button" class="btn btn-success btn-xs" >
							  <i class="glyphicon glyphicon-ok"></i>
							</button>
						<?php } ?></th>
						<th> 
							<a type="button" class="btn btn-<?php echo $warna; ?> btn-xs" onclick='disen(<?php echo $row->id; ?> )' id ='<?php echo $row->id; ?>' >
								<i class="<?php echo $icon; ?>" id ='icon<?php echo $row->id; ?>' ></i>
							</a> 
						</th>
						<?php if($this->session->userdata('logged_in')['user_level'] == 0){?>
						<th> 
							<button type="button" id ='<?php echo $row->id; ?>' onClick="reply_click(this.id)" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalManual">
							  <i class="fa fa-pencil"></i>
							</button>
							<a href="<?php echo site_url('dashboard/qr_view').'/'.$row->id; ?>" type="button" class="btn btn-success btn-xs">
								 <i class="fa fa-qrcode"></i>
							</a>
							<a href="<?php echo site_url($delete).'/'.$row->id.'/dashboard_uri_data_perusahaan_uri_4'; ?>" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $row->company_name; ?> ?')">
								 <i class="fa fa-bitbucket"></i>
							</a>
						</th><?php } ?>
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

<!-- modal update data start -->
<?php $this->load->view('modal/inputCompany');	?>
<?php $this->load->view('modal/updateCompany');	?>

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
							$('#company_reg').val(n['company_reg']);
							$('#kota').val(n['kota']);
							$('#company_brand').val(n['company_brand']);
							$('#company_web').val(n['company_web']);
							$('#kode_pos').val(n['kode_pos']);
							$('#fax').val(n['fax']);
							$('#provider_visa').val(n['provider_visa']);
							$('#nama_provider').val(n['nama_provider']);
							$('#sk_umroh').val(n['sk_umroh']);
							$('#company_email').val(n['company_email']);
							$('#pin_siskohat').val(n['pin_siskohat']);
							$('#pin_muassasah').val(n['pin_muassasah']);
							$('#company_contact').val(n['company_contact']);
							$('#company_contact').val(n['company_contact']);
							$('#company_addres').val(n['company_addres']);
							$('#pihk_group').val(n['pihk_group']);
							$('#id_com').val(n['id']);
							$('#keterangan').val(n['keterangan']);
							$('#company_sk').val(n['company_sk']);
							$('#tgl_3').val(n['tgl_sk']);
							$('#tgl_2').val(n['tgl_sk_umroh']);
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
