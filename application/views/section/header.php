<?php $_SESSION["user_id"] || beefSecurity(); ?>

<?php $this->load->view('section/meta')?>

<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>"> 
<link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css')?>"> 

	
	<script src='<?=base_url('assets/js/jquery-3.3.1.min.js')?>' ></script>
	<script src="<?=base_url("assets/js/popper.min.js")?>" ></script>
	<script src="<?=base_url("assets/js/bootstrap.min.js")?>" ></script>

<div class="clearfix">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: #9C27B0 !important;">
  <a class="navbar-brand" href="<?=base_url('/')?>">Apriman</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('priceplans')?>">X</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('about')?>">About Us</a>
      </li>
    </ul>
  </div>
		<li class="d-inline-block">
			<a class="nav-link text-light" href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out"></i> Logout</a>
		</li>
</nav>
</div>
</head>

<body class="clearfix">
<div class="m-3">


