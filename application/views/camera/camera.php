<!DOCTYPE html>
<div class="col-lg-4">
<video autoplay class="col-lg-12 col-xs-12"></video>
<form method="post" action = "<?php echo site_url('dashboard/scan'); ?>" enctype="multipart/form-data" accept-charset="utf-8">								
  <input type="text" name="qr_id" required  autofocus><button type="submit" class="btn btn-primary"><i class="fa fa-sign-out"></i> </button>
</form>
<div class="panel panel-warning">
    <?php if($comp){?>
      <div class="panel-heading">
        
      </div>
      <div class="panel-body text-center">
      <?php 
        
        $filename = "upload/company/".$comp['0']['company_pic'];
        
        if($comp['0']['company_pic']==''){$filename = false;}
        if(file_exists($filename)) {
          $link =  base_url('upload/company').'/'.$comp['0']['company_pic'];
        } else {
          $link = base_url('upload/foto/no_image.jpg');
        }
      ?>
        <a href="#">
          <img class="img-portfolio img-responsive" src="<?php echo $link; ?>">
        </a>
        <div class="alert alert-warning">
        <h4><?php echo $comp['0']['company_sk']; ?></h4>
        <h4>TGL SK : <?php echo $comp['0']['tgl_sk']; ?></h4>
        </div>
        <h4>
        <?php 
          if($comp['0']['company_anggaran'] == '0'){
            $ket= 'Iuran Belum Lunas';
          }else{
            $ket= 'Iuran Sudah Lunas';
          }; 
        ?>
            
        <div class="alert alert-success">
          <?php echo $ket; ?>
        </div>
        </h4>
      <?php } ?>
      </div>
    </div>
</div>
<div class="col-lg-8">
  <center><h2 class="btn-dark"><?php echo $comp['0']['company_name']; ?></h2></center>
</div>
  <?php 
    if($get_data){
      // debug($get_data);exit;
    foreach($get_data as $row){
      // debug($row);
      if(!$row->absen_masuk){
        $warna = 'danger';
        $icon = 'fa fa-upload';
      }else{
        $warna = 'success';
        $icon = 'fa fa-download';
      }
      $where =array(
        array('kolom'=>'id_pegawai','value'=>$row->id),
        array('kolom'=>'date(absen_masuk)','value'=>date('Y-m-d')),
        array('kolom'=>'id_acara','value'=>$this->session->userdata('event')['id_event'])
      );
      $cek= $this->Model_dop->global_model_array('t_absen',false,$where,false,false,false,false,false,false);
      // debug($cek);
      if(empty($cek)){
        $warna1 = 'danger';
        $icon1 = 'fa fa-upload';
        $warna2 = 'danger';
        $icon2 = 'fa fa-upload';
      }else{
        if($cek[0]['flag_musy1'] == 1){
          $warna1 = 'success';
          $icon1 = 'fa fa-download';	
        }else{
          $warna1 = 'danger';
          $icon1 = 'fa fa-upload';
        }
        if($cek[0]['flag_musy2'] == 1){
          $warna2 = 'success';
          $icon2 = 'fa fa-download';	
        }else{
          $warna2 = 'danger';
          $icon2 = 'fa fa-upload';
        }							
      }
  ?>
  <div class="col-lg-4">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h4>
          
          <?php echo $row->pegawai_name; ?><br/><br/>
          <a href="#" type="button" class="btn btn-<?php echo $warna; ?> btn-sm" onclick='disen(<?php echo $row->id; ?> )' id ='<?php echo $row->id; ?>' >
            <i class="<?php echo $icon; ?>" id ='icon<?php echo $row->id; ?>' ></i> Reg
          </a> 
          <a href="#" type="button" class="btn btn-<?php echo $warna1; ?> btn-sm" onclick='musy1(<?php echo $row->id; ?> )' id ='1<?php echo $row->id; ?>' >
            <i class="<?php echo $icon1; ?>" id ='icon1<?php echo $row->id; ?>' ></i> Musy 1
          </a> 
          <a href="#" type="button" class="btn btn-<?php echo $warna2; ?> btn-sm" onclick='musy2(<?php echo $row->id; ?> )' id ='2<?php echo $row->id; ?>' >
            <i class="<?php echo $icon2; ?>" id ='icon2<?php echo $row->id; ?>' ></i> Musy 2
          </a> 
          <a href="#" type="button" class="btn btn-danger btn-sm" onclick='out(<?php echo $row->id; ?> )' id ='ch<?php echo $row->id; ?>' >
            <i class="fa fa-sign-out" id ='icon3<?php echo $row->id; ?>' ></i> Check out
          </a> 
        </h4>
      </div>
      <div class="panel-body text-center">
      <?php 
        
        $filename = "upload/foto/".$row->pegawai_pic;
        if($row->pegawai_pic ==''){$filename = false;}
        if(file_exists($filename)) {
          $link =  base_url('upload/foto').'/'.$row->pegawai_pic;
        } else {
          $link = base_url('upload/foto/no_image.jpg');
        }
      ?>
        <div class="portfolio-item">
          <a href="#">
            <img class="img-portfolio img-responsive" style="max-height: 250px; max-width: 250px" src="<?php echo $link; ?>">
          </a>
          <h4> <?php echo $row->pegawai_jabatan; ?></h4>
          <h4> <?php echo $row->pegawai_kontak; ?></h4>
        </div>
      </div>
    </div><br />
  </div>
  <?php 
    } 
  }else{
    echo "<center><h2>Silahkan Arahkan Qr-Code Pada Kamera. </h2></center>";
  } 
  ?>
</div>
  <script src="<?php echo base_url('asset/dash/js/build/qcode-decoder.min.js')?>"></script>
  <script type="text/javascript">

  (function () {
    'use strict';

    var qr = new QCodeDecoder();
    var video = document.querySelector('video');

    if (!(qr.isCanvasSupported() && qr.hasGetUserMedia())) {
      alert('Your browser doesn\'t match the required specs.');
      throw new Error('Canvas and getUserMedia are required');
    }

    function resultHandler (err, result) {
      if (err)
        return console.log(err.message);
	    window.location = "<?php echo site_url('dashboard/scan/'); ?>"+'/'+result;
	  
    }

    qr.decodeFromCamera(video, resultHandler);
  })();
  </script>
	<?php $this->load->view('js/absen')?>
</body>
</html>