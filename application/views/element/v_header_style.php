<?php 
	$session_data = $this->session->userdata('logged_in');
	$nama = $session_data['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Himpuh App's</title>
    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?php echo base_url('asset/dash/css/bootstrap.min.css')?>"/>

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('asset/dash/css/plugins/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('asset/dash/css/stylish-portfolio.css')?>" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url('asset/dash/js/plugins/jqueryui/jquery-ui.css')?>" />
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('asset/dash/css/sb-admin-2.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/dash/font-awesome-4.1.0/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/dash/js/jquery.js')?>"></script>
	<script src="<?php echo base_url('asset/dash/js/plugins/jqueryui/jquery-ui.js')?>"></script>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="<?php echo site_url('dashboard/welcome_user'); ?>"><i class="fa fa-home"> </i> HIMPUH APP's</a>
		  <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
		</div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('dashboard/change_password'); ?>">Welcome, <i class="fa fa-user"></i> <?php echo $nama; ?></a></li>
            <li><a href="#">He</a></li>
          </ul>
        </div>
	  </div>
	</nav>
    <nav id="sidebar-wrapper">
		<ul class="nav" id="side-menu">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a><br/><br/><br/>
			<li>
				<a href="<?php echo site_url('dashboard/welcome_user'); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
			</li>
			<li>
				<a href="#>"><i class="fa fa-list"></i> Master Data <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?php echo site_url('dashboard/data_perusahaan/4'); ?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> Perusahaan</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/m_surat_group'); ?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> Group Surat</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/event/1'); ?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> Kegiatan</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-envelope"></i> Surat<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?php echo site_url('dashboard/surat/m')?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> Masuk</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/surat/k')?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> Keluar</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-search"></i> Scan Qr<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?php echo site_url('dashboard/event/3')?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> By Camera</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/event/2')?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> By Scanner</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-list"></i> Report<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?php echo site_url('dashboard/event/1')?>">&nbsp;&nbsp;<i class="fa fa-clock-o"></i> Report Kehadiran</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/data_perusahaan/1')?>">&nbsp;&nbsp;<i class="fa fa-money fa-fw"></i> Monitoring Iuran</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/data_perusahaan/2')?>">&nbsp;&nbsp;<i class="fa fa-file fa-fw"></i> Monitoring SK</a>
					</li>
					<li>
						<a href="<?php echo site_url('dashboard/data_pegawai'); ?>">&nbsp;&nbsp;<i class="fa fa-th fa-fw"></i> Member Inv</a>
					</li>
				</ul>
			</li>
            <li>
                <a href="<?php echo site_url('dashboard/logout')?>"><i class="fa fa-sign-out"></i> Log Out</a>
            </li>
		</ul>
    </nav>
    <br/><br/><br/>
	
	<aside class="call-to-head bg-primary orange">
		<div class="container">
			
		</div>
	</aside>
	<aside class="call-to-head bg-primary black">
		<div class="container">
			
		</div>
	</aside>
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container-fluid">
      </div>
    </nav>

	
	<script>
		$(function () { $("[data-toggle='tooltip']").tooltip(); });
	</script>