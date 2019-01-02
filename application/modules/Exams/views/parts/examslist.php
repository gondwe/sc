<?php 

$f = new Tablo('exams');

$records = $this->db->count_all('exams');

$f->sqlstring = "select  e.id, concat(ucase(e.name), ' \(',  ucase(e.abbr),  '\)',  if(e.counts,'   <span class=\'fa fa-check-circle text-success\'>','   <span class=\'fa fa-times text-danger\'>') )  as exam, e.outof,
                    e.counts,
                    concat(e.percentage,'%') as percentage
                    from exams e ";

$f->hide('name, abbr');
$f->button('Enrol Students','exams/actions/enrol');
$f->print();
$f->newButton = true;
$f->table();

