<h5>Dashboard</h5>
<div class="row">
<?php foreach($modules as $mod){ ?>

    <a class="btn mx-2 <?=$mod == $active ? 'btn-primary' : 'btn-info' ?>"  href="<?=strtolower($mod)?>"><?=ucwords($mod)?></a>
  
<?php } ?>
</div>
<hr>

<?php 

$this->load->view($active);