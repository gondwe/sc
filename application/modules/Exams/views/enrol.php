<?php 

examDashboard(); 
$id = $this->uri->segment(4);
$examName = ucase($this->db->where('id',$id)->get('exams')->row('name'));

?>
<h5>Enrol Students for <div class="badge badge-info"><?=$examName?></div></h5>
<hr>

<div class="mt-4 col-md-8">
<?php 


$d = new Tablo('exam_enrolments');
$d->aliases('class_id,class');
$d->combos('term',"select id, b from vdata where a = 'terms'");
$d->combos('class_id',"select id, name from classes");
$d->hidden('exam_id',$id);
$d->hidden('year',date('Y'));
$d->newform();

?>
</div>
<div class="clearfix"></div>
<hr>
<h5>Classes Enrolled</h5>
<hr>



<?php
$e = new Tablo('exam_enrolments');
$e->aliases('class_id,class');
$e->edit = false;
$e->sqlstring = "select e.id,e.class_id,e.term,e.year from exam_enrolments e";
$e->combos('exam_id', 'select id, ucase(name) from exams');

$e->button('Marksheet','exams/actions/marksheet');
$e->combos('class_id', 'select id, ucase(name) from classes');
$e->combos('term', "select id, ucase(b) from vdata where a = 'terms'");
$e->where("year = year(current_timestamp) and exam_id = ".$id);
$e->hide("exam_id");
$e->table(0);
?>
</div>
