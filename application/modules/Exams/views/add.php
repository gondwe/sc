
<?=examDashboard()?>
<h5 class='btn btn-secondary'>Register New Exam</h5>
<hr>
<?php 

$e =  new Tablo('exams');
$e->combos('year', [date('Y')=>date('Y')]);
$e->combos('term', array(1=>'TERM 1',2=>'TERM 2',3=>'TERM 3',));
$e->combos('counts', ['1'=>'YES','2'=>'NO']);
$e->combos('percentage',range(5,100));
$e->newform();

?>

<div class="clearfix mb-3"></div>

<h5 class='btn btn-secondary'>Exams List</h5>
<hr>
<?php
$f = new Tablo('exams');
$f->sqlstring = "select  ucase(concat(e.name, ' \(',  e.abbr,  '\) - Term ', e.term ) ) as exam, e.* from exams e ";
$f->hide('year,term,abbr,name');
$f->where('year = '.date('Y'));
$f->combos('counts', ['1'=>'YES','2'=>'NO']);
$f->table(0);