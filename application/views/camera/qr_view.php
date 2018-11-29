
<script type="text/javascript" src="<?php echo base_url('asset/dash/js/plugins/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('asset/dash/js/plugins/qrcode.js')?>"></script>

<section id="contact" class="map">
	<div class="container"><hr/>
            <div class="row text-left">
                <div class="col-lg-4">
                    <div class="row">	
						<div class="col-lg-12">
							<div class="panel panel-warning">
							<?php if($comp){?>
								<div class="panel-heading">
									<h4><img src="<?php echo base_url('asset/img/pegawai.png')?>"> <?php echo $comp['0']['company_name']; ?></h4>
								</div>
								<div class="panel-body text-center">
									<a href="#">
										<img class="img-portfolio img-responsive" src="<?php echo base_url('upload/company').'/'.$comp['0']['company_pic']; ?>">
									</a>
									<h4><?php echo $comp['0']['company_sk']; ?></h4>
									
								<?php } ?>
								</div>
							</div><br />
						</div>	
						<div class="col-lg-12">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h4><img src="<?php echo base_url('asset/img/pegawai.png')?>"> <?php echo $comp['0']['company_name']; ?></h4>
								</div>
								<div class="panel-body text-center">
									<div id="qrcode" style="width:200; height:200; margin:10px;"></div>
									<input id="text" type="hidden" value="<?php echo $comp['0']['qr_id']; ?>" style="width:80%" /> 
									Id : <?php echo $comp['0']['qr_id']; ?>
								</div>
							</div><br />
						</div>
					</div>
				</div>
                <div class="col-lg-8">
                    <div class="row">	
						
                    <div class="row">
						
						<?php 
							if($get_data){
							foreach($get_data as $row){
								
						?>
						<div class="col-lg-6">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h4>
										<?php echo $row->pegawai_name; ?>
									</h4>
								</div>
								<div class="panel-body text-center">
									<div class="portfolio-item">
										<a href="#">
											<img class="img-portfolio img-responsive" src="<?php echo base_url('upload/foto').'/'.$row->pegawai_pic; ?>">
										</a>
										<h4> <?php echo $row->pegawai_jabatan; ?></h4>
										<h4> <?php echo $row->pegawai_kontak; ?></h4>
									</div>
								</div>
							</div><br />
						</div>
						<?php } } ?>
					</div>
					</div>
				</div>
			</div>
	</div><hr/>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 200,
	height : 200
});

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
</script>
</body>