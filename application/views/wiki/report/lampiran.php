
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<div class="alert alert-warning">
						<h3>Lampiran Reimbursement</h3>
						<table>
							<tr><th>Nama</th> <th> &nbsp;&nbsp;:  <b><?php echo $file_header[0]['nama']; ?></b></th></tr>
							<tr><th>NPP</th> <th> &nbsp;&nbsp;:  <b><?php echo $file_header[0]['npp']; ?></b></th></tr>
							<tr><th>Unit</th> <th> &nbsp;&nbsp;:  <b><?php echo $file_header[0]['unit']; ?></b></th></tr>
							<tr><th>Jenjang</th> <th> &nbsp;&nbsp;:  <b><?php echo $file_header[0]['jenjang']; ?></b></th></tr>
							<tr><th>Jabatan</th> <th> &nbsp;&nbsp;:  <b><?php echo $file_header[0]['jabatan']; ?></b></th></tr>
							<tr><th>Pelatihan</th> <th> &nbsp;&nbsp;:  <b><?php echo $event[0]['class_name']; ?></b></th></tr>
							<tr><th>Tgl Pelatihan</th> <th> &nbsp;&nbsp;:  <b><?php echo $event[0]['start_date'].' s/d '.$event[0]['end_date']; ?></b></th></tr>
						</table>
					</div>
                    <hr class="small">
                    <div class="row">
					<?php if ($file_header[0]['surat_tugas']){?>
					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h4> <i class="fa fa-list"></i> Surat Tugas No. <?php echo $file_header[0]['surat_tugas']; ?></h4>
							</div>
							<div class="panel-body text-center">
								<div class="portfolio-item">
									<a href="#">
										<img class="img-portfolio img-responsive" src="<?php echo base_url('upload/file_reimburse/'.$file_header[0]['file_surat_tugas'])?>">
									</a>
								</div>
							</div>
						</div>
                    </div>
					<?php 
						}
						foreach ($file as $row){
							if($row->file){
					?>
					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h4> <i class="fa fa-list"></i> Lampiran Perjalanan dari <?php echo $row->asal.' ke '.$row->tujuan; ?></h4>
							</div>
							<div class="panel-body text-center">
								<div class="portfolio-item">
									<a href="#">
										<img class="img-portfolio img-responsive" src="<?php echo base_url('upload/file_reimburse/'.$row->file)?>">
									</a>
								</div>
							</div>
						</div>
                    </div>
					<?php } }?>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>