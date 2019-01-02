
<!DOCTYPE html>
<html lang="en" style=''>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Santa</title>
	
	
	<link rel="stylesheet" href="http://localhost/santa/assets/css/bootstrap.min.css" >
	<link rel="stylesheet" href="http://localhost/santa/assets/css/font-awesome.min.css" >
	<link rel="stylesheet" href="http://localhost/santa/assets/css/custom.css" >
	
	<script src='http://localhost/santa/assets/js/jquery-3.3.1.min.js' ></script>
	<script src="http://localhost/santa/assets/js/popper.min.js" ></script>
	<script src="http://localhost/santa/assets/js/bootstrap.min.js" ></script>
	
	<script>
		
	</script>
</head>
<body class="m-5">
    


<div id="infoMessage"></div>

<form action="http://localhost/tripper/auth/register/<?=$reflink?>" method="post" accept-charset="utf-8">
<div class="col-lg-4 col-md-6 pull-left">
      <p>
            <label for="first_name">First Name:</label> 
            <input type="text" name="first_name" value="" id="first_name"  />
      </p>

      <p>
            <label for="last_name">Last Name:</label> 
            <input type="text" name="last_name" value="" id="last_name"  />
      </p>
      
      
     
      <p>
            <label for="company">Company Name:</label> 
            <input type="text" name="company" value="" id="company"  />
      </p>

      <p>
            <label for="email">Email:</label> 
            <input type="text" name="email" value="" id="email"  />
      </p>
 </div>
      <div class="col-lg-4 col-md-6 pull-left">
      <p>
            <label for="phone">Phone:</label> 
            <input type="text" name="phone" value="" id="phone"  />
      </p>

      <p>
            <label for="password">Password:</label> 
            <input type="password" name="password" value="" id="password"  />
      </p>

      <p>
            <label for="password_confirm">Confirm Password:</label> 
            <input type="password" name="password_confirm" value="" id="password_confirm"  />
      </p>


      <p><input type="submit" name="submit" value="Register"  />
</p>
      </div>

</form>


<script>

$(document).ready(function(){
      $("input:text").addClass("form-control");
      $("input:password").addClass("form-control");
      $("form>p").addClass("text-secondary");
      $("input:submit").addClass("btn btn-primary btn-block mt-4  pull-right");
      $("#first_name").attr("autofocus",true);
});

</script>


<style>
</style>