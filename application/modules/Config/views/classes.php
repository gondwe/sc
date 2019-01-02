<h5>Classes</h5>

<?php activeModules($active,$modules) ?>

<hr>
<?php 

$form = new tablo('classes');
$form->formgrid(4,6,12);
$form->newform();

?>

<div class="clearfix"></div>
<hr>
<div class="mx-md-3 col-md-6">
<?php

$form->table(0);

?>
</div>