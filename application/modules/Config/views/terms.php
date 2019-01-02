<h5>Academic Terms</h5>

<?php activeModules($active,$modules) ?>

<hr>
<?php 

$form = new tablo('vdata');
$form->formgrid(4,6,12);
$form->hide('c');
$form->ucase('b');
$form->aliases('b,Term Name');
$form->hidden('a','terms');
$form->where("`a` = 'terms'");
$form->newform();

?>

<div class="clearfix"></div>
<hr>
<div class="mx-md-3 col-md-6">
<?php

$form->table(0);

?>
</div>