<h5>Hostels / Dormitories</h5>
<div class="d-flex">

<?php activeModules($active,$modules) ?>

<button class="btn-sm btn-success ml-auto" data-toggle="modal" data-target="#addModal" data-table="dorms"><i class="fa fa-plus"></i> Add New</button>

</div>
<hr>
<?php 

$form = new tablo('dorms');

?>

<div class="clearfix"></div>

<div class="mx-md-3 col-md-6">
<?php

$form->table(0);



?>
</div>