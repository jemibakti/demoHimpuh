
<!-- Map -->
<section id="contact" class="map">
	<div class="container">
            <div class="row text-left">
                <div class="col-lg-12 ">
                    <hr/>
                    <div class="row">
						<div class="col-lg-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3><i class="fa fa-list"></i> Data Peserta</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr class="warning">
                                            <th width="7%" >No.</th>
											<th width="45%">Nama</th>
                                            <th >Perusahaan</th>
                                            <th >Qr Id</th>
                                            <th >Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								   <?php
								   $no = 1;
									if(!empty($data)){
										foreach($data as $row){
											if($row->flag_in == 0){
												$status = 'Belum Masuk';
											}else{
												$status = 'Sudah Masuk';
											}
									?>
										<tr>
											<th> <?php echo $no;$no++;?></th>
											<th> <a href='<?php echo site_url('dashboard/input_data/').'/'.$row->qr_id; ?>'><?php echo $row->nama; ?></a></th>
											<th> <?php echo $row->company; ?></th>
											<th> <?php echo $row->qr_id; ?></th>
											<th> <?php echo $status; ?></th>
										</tr>
									<?php
										}
									}else{
									?>
										<tr>
											<th>tidak ditemukan</th>
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
					</div><br/>
                </div>
            </div>
        </div>