<section id="contact" class="map">
	<div class="container">
            <div class="row text-left">
                <div class="col-lg-12 ">
                    <hr/>
                    <div class="row">
						<div class="col-lg-12">
							<form method="post" action = "<?php echo site_url('dashboard/submit_data'); ?>" enctype="multipart/form-data" accept-charset="utf-8">								
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h4><i class="fa fa-pencil"></i> Input Data Invitation</h4>
								</div>
								<div class="panel-body">
								  <div class="col-lg-6">
									<h3>Data Pegawai 1</h3>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Nama Pegawai</span>
									  <input type="text" class="form-control" name="nama_1" required >
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Jabatan</span>
									  <input type="text" class="form-control" name="jabatan_1" >
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">No Kontak</span>
									  <input type="text" class="form-control" name="kontak_1" >
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Keterangan</span>
									  <input type="text" class="form-control" name="ket_1" >
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Foto</span>
									  <input type="file" class="form-control" name="file_1" required>
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Perusahaan</span>
									  <input type="text" class="form-control" name="company" required>
									  
									  <span class="input-group-btn">
										<button class="btn btn-primary" type="submit">Submit!</button>
									  </span>
									</div><br/>
								  </div>
								  <div class="col-lg-6">
									<h3>Data Pegawai 2</h3>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Nama Pegawai</span>
									  <input type="text" class="form-control" name="nama_2" required>
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Jabatan</span>
									  <input type="text" class="form-control" name="jabatan_2" >
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">No Kontak</span>
									  <input type="text" class="form-control" name="kontak_2" >
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Keterangan</span>
									  <input type="text" class="form-control" name="ket_2">
									</div></br>
									<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">Foto</span>
									  <input type="file" class="form-control" name="file_2"/ required>
									</div></br>
								  </div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div><br/>
            </div>
		</div>
	</div>