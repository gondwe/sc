<?php $_SESSION["user_id"] || beefSecurity(); ?>

<?php $this->load->view('section/parts/meta')?>


<div class="clearfix">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="">
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


