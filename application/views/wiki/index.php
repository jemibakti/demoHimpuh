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
    <link href="<?php echo base_url('asset/dash/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('asset/dash/css/sb-admin-2.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/dash/css/stylish-portfolio.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('asset/dash/font-awesome-4.1.0/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    [if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]

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
		  <a class="navbar-brand" href="<?php echo site_url('dashboard/other_login'); ?>"><i class="fa fa-key"> </i> HIMPUH App'</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		  <form class="navbar-form navbar-right" method="post" action="<?php echo site_url('dashboard/cek_login')?>">
			<div class='input-group'>
			  <span class="input-group-addon" id="sizing-addon1">Input Username & Password</span>
			  <input type="text" class="form-control" placeholder="Username..." name="username" type="username" autofocus >
			</div>
			<div class="input-group">
			  <input type="password" class="form-control" placeholder="Password..." name="password"  >
			  <span class="input-group-btn">
				<button class="btn btn-default" type="submit">Login</button>
			  </span>
			</div>
		  </form>
		</div>
		<?php if($allert == 1){ ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong >Please Login First!</strong> User name or password Wrong 
			</div>
		<?php } ?>
	  </div>
	<aside class="call-to-head bg-primary orange">
		<div class="container">
		</div>
	</aside>
	<aside class="call-to-head bg-primary green">
		<div class="container">
			
		</div>
	</aside>
	</nav>
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
	<aside class="call-to-head bg-primary green">
		<div class="container">
			
		</div>
	</aside>
	<aside class="call-to-head bg-primary orange">
		<div class="container">
			
		</div>
	</aside>
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  </div>
		<div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav navbar-right">
		  </ul>
		</div>
	  </div>
	</nav>
    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center" style="color:#fff; text-outline: 1px">
			
        </div>
    </header>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/dash/js/jquery.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('asset/dash/js/bootstrap.min.js')?>"></script>

</body>

</html>
