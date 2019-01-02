<?=examDashboard()?>
<a name="" id="" class="btn btn-secondary float-right btn-sm border mx-md-3" href="<?=base_url('exams/config')?>" role="button"><i class="fa fa-cogs"></i>    Config</a>
<h5>Exams Registered</h5>
<?php activeModules($active,$modules,"exams") ?>
<hr>

<?php 
$enrol_url = base_url('school/exams/enrol');
$f = new Tablo('exams');

$f->sqlstring = "select  e.id,ucase(concat(e.name, ' \(',  e.abbr,  '\)' ) ) as exam, e.outof,
                    if(e.counts,'YES <span class=\'fa fa-check-circle text-success\'>','NO <span class=\'fa fa-check text-danger\'>') as counts,
                    concat(e.percentage,'%') as percentage
                    from exams e ";

$f->hide('name, abbr');
$f->button('Enrol Students','exams/actions/enrol');
$f->table(0);