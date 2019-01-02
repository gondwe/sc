<!DOCTYPE html>
<html lang="en" style=''>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PDL</title>
	
	
	<link rel="stylesheet" href="<?=site_url("assets/css/bootstrap.min.css") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/css/font-awesome.min.css") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/js/jquery-3.3.1.slim.min.js") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/css/custom.css") ?>" >
	
	
</head>
<body>
    
</body>
<div class="container">
    <h1 class="text-danger text-center mt-5 pt-4 mx-md-5 display-4 pb-3" >Apriman</h1>
	<div class="row justify-content-center">
		<div class="col-md-6 col-sm-10 col-lg-5 pb-5">


                    <!--Form with header-->

                    <form action="" method="post">
                        <div class="">
                            <div class=" pb-3"></div>
                                <div id='alerts' class="m-0"><?=$message?></div>
                            <div class="card-body p-3">


<?php echo form_open("auth/login");?>

    <div class="form-group">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
            </div>
              <?php echo form_input($identity,null,["class"=>"form-control", "placeholder"=>" Username"]);?>
            </div>
        </div>
    <div class="form-group">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock text-primary"></i></div>
            </div>
              <?php echo form_input($password,null,["class"=>"form-control", "placeholder"=>" Password"]);?>
            </div>
        </div>

  <?php echo form_submit('submit', lang('login_submit_btn'), ["class"=>"mb-3 pull-right btn alert-success btn-block"]);?>

  <div class="pull-left">
    <?php // echo lang('login_remember_label', 'remember');?>
    <?php // echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
    
  </div>

  <!-- <div class="pull-right text-light"><a href="forgot_password" class="text-secondary"><?php echo lang('login_forgot_password');?></a></div> -->

  
<?php echo form_close();?><div class='fixed-bottom m-3'style="text-align:center" >
     <small style='color:#bbb;' style="" >All Rights Reserved &copy 2018 Tripper Inc.</small>
    </body>
</div>


<style>
  
</style>