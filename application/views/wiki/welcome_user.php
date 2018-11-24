<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
		<div class="col-lg-12 ">
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Welcome User's</li>
			</ol>
				<div class="row">						
					<div class="col-lg-2">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="glyphicon glyphicon-briefcase fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo count($perusahaan); ?></div>
										<div><b>Member</b></div>
									</div>
								</div>
							</div>
							<a href="<?php echo site_url('dashboard/data_perusahaan/4'); ?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h5>Welcome,</h5>
								<h4><img src="<?php echo base_url('asset/img/pegawai.png')?>"> <?php echo $user; ?></h4>
							</div>
							<div class="panel-body text-center">
								<div class="portfolio-item">
									<a href="#">
										<img class="img-portfolio img-responsive" src="<?php echo base_url('asset/img/no_img.png')?>">
									</a>
									<h5><?php echo $nama; ?></h5>
								</div>
							</div>
						</div>
					</div>
			<div class="col-lg-10">

				<?php if(!empty($perusahaan)){?>
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="glyphicon glyphicon-briefcase fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo count($perusahaan); ?></div>
										<div><b>PIHK Group</b></div>
									</div>
								</div>
							</div>
							<a href="<?php echo site_url('dashboard/data_perusahaan/4'); ?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-user fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo count($ppiu); ?></div>
										<div><b>PPIU Group</b></div>
									</div>
								</div>
							</div>
							<a href="<?php echo site_url('dashboard/data_perusahaan/3'); ?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo count($visa); ?></div>
										<div><b>Provider Visa</b></div>
									</div>
								</div>
							</div>
							<a href="<?php echo site_url('dashboard/data_perusahaan/2'); ?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-money fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo count($iuran); ?></div>
										<div><b>Anggaran!</b></div>
									</div>
								</div>
							</div>
							<a href="<?php echo site_url('dashboard/data_perusahaan/1'); ?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<?php } ?>
				<div id="tabs">
					<ul>
						<?php if ($expired_sk){ ?>
							<li><a href="#tabs-1"><i class="fa fa-file"></i> SK Haji Expired (<?php echo count($expired_sk)?>)</a></li>
						<?php } ?>
						<?php if ($expired_umrah){ ?>
							<li><a href="#tabs-8"><i class="fa fa-file"></i> SK Umrah Expired (<?php echo count($expired_umrah)?>)</a></li>
						<?php } ?>
						<?php if ($iuran){ ?>
							<li><a href="#tabs-2"><i class="fa fa-money"></i> Iuran Bermasalah (<?php echo count($iuran)?>)</a></li>
						<?php } ?>
					</ul>
						<?php if ($iuran){ ?>
						<div id="tabs-2">
						<div class="panel panel-primary">
							<div class="panel-body text-center">
									<div class="service-item">
									<table class="table table-striped" id="dataTables-example" style='color:red'>
										<thead>
											<tr class="warning">
												<th >#</th>
												<th >Nama Perusahaan</th>
												<th >Email</th>
												<th >Kontak</th>
												<th >Email</th>
												<th >Keterangan</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$n0o =1;
												foreach($iuran as $row){
											?>
											<tr>
												<th><?php echo $n0o; $n0o++;?></th>
												<th> <a href='<?php echo site_url().'dashboard/detail_company/'.$row->id; ?>' ><?php echo $row->company_name; ?></a> </th>
												<th> <?php echo $row->company_email; ?></th>
												<th><?php echo $row->company_contact; ?></th>
												<th><?php echo $row->company_email; ?></th>
												<th><?php echo $row->keterangan; ?></th>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						</div>
					<?php } ?>
					<?php if ($expired_umrah){ ?>
						<div id="tabs-8">
						
						<div class="panel panel-primary">
							<div class="panel-body text-center">
									<div class="service-item">
									<table class="table table-striped " id="dataTables-example1" style='color:red'>
										<thead>
											<tr class="warning">
												<th >#</th>
												<th >Nama Perusahaan</th>
												<th >SK Umrah</th>
												<th >Tgl SK Umrah</th>
												<th >Kontak</th>
												<th >Email</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$no =1;
												foreach($expired_umrah as $row){
											?>
											<tr>
												<th><?php echo $no; $no++;?></th>
												<th> <a href='<?php echo site_url().'dashboard/detail_company/'.$row->id; ?>' ><?php echo $row->company_name; ?></a> </th>
												<th> <?php echo $row->sk_umroh; ?> </th>
												<th><?php echo $row->tgl_sk_umroh; ?></th>
												<th><?php echo $row->company_contact; ?></th>
												<th><?php echo $row->company_email; ?></th>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						</div>
					<?php } ?>
					<?php if ($expired_sk){ ?>
						<div id="tabs-1">
						
						<div class="panel panel-primary">
							<div class="panel-body text-center">
									<div class="service-item">
									<table class="table table-striped " id="dataTables-example2" style='color:red'>
										<thead>
											<tr class="warning">
												<th >#</th>
												<th >Nama Perusahaan</th>
												<th >SK Haji</th>
												<th >Tgl SK Haji</th>
												<th >Kontak</th>
												<th >Email</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$no0 =1;
												foreach($expired_sk as $row){
											?>
											<tr>
												<th><?php echo $no0; $no0++;?></th>
												<th> <a href='<?php echo site_url().'dashboard/detail_company/'.$row->id; ?>' ><?php echo $row->company_name; ?></a> </th>
												<th> <?php echo $row->company_sk; ?> </th>
												<th><?php echo $row->tgl_sk; ?></th>
												<th><?php echo $row->company_contact; ?></th>
												<th><?php echo $row->company_email; ?></th>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						</div>
					<?php } ?>
				</div>
			</div>	
		</div><br/>
	</div>
</div>