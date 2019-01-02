<div class="m-3">

<h3>UAC</h3>
<small class='text-danger'>Kindly Check Access & Permissions</small>
<hr>
<?php 


$found = isset($_SERVER["HTTP_REFERER"]);
$link = $found ? $_SERVER["HTTP_REFERER"] : base_url();
$caption = $found ? "BACK" : "HOME";


?>

<p><a href="<?=$link?>" class="btn btn-primary alert-primary btn-sm"><i class="fa fa-chevron-left"></i> <?=$caption?></a></p>
<div class="m-3">
<?=$info ?? null ?>
</div>
</div>