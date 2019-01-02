<?=examDashboard()?>
<h5>Exams Overview</h5>
<?php activeModules($active,$modules,"school") ?>
<hr>

<?php 
$enrol_url = base_url('school/exams/enrol');
$f = new Tablo('exams');

$f->sqlstring = "select  ucase(concat(e.name, ' \(',  e.abbr,  '\)' ) ) as exam, e.*,
                    concat('<a href=\"$enrol_url/', e.id, '\" class=\"btn btn-secondary btn-sm pull-right\">ENROL STUDENTS</a>') as _
                    from exams e ";

// $f->hide('year,term,abbr,name');
// $f->where('year = '.date('Y'));
$f->combos('counts', ['1'=>'YES','2'=>'NO']);
$f->table(0);