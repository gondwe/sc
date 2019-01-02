<a name="" id="" class="btn btn-secondary float-right btn-sm border mx-md-3" href="<?=base_url('exams/config')?>" role="button"><i class="fa fa-cogs"></i>    Config</a>
<?=examDashboard()?>

<h5>Exams Registered</h5>

<?php activeModules($active,$modules,"exams") ?>

<hr>

<?php 

$this->load->view('parts/examslist');