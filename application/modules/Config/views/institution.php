<h5>Institution Configurations</h5>

<?php activeModules($active,$modules) ?>

<hr>
<?php 

$sid = $this->db->where("id", $this->session->user_id)->get('users')->row('sid');

?>


<div class="mx-sm-1">
<?php 

$form = new tablo('settings');
$form->formgrid(12,12,12);
$form->edit($sid);


?>
</div>