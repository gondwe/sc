
<?=examDashboard()?>

<h5 class='rounded'>Register New Exam</h5>

<?=activeModules($active,$modules,'exams');?>

<hr>

<?php 

$e =  new Tablo('exams');

$e->combos('counts', ['1'=>'YES','2'=>'NO']);

$e->combos('percentage',range(5,100));

$e->newform();

?>

<div class="clearfix"></div><hr class="my-4">

<?php 

$this->load->view('parts/examslist');

?>
