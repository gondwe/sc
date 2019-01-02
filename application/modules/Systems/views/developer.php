
<h3>Testing Ground</h3>

<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3 style="opacity: .0;">44</h3>
            <a href="<?=base_url('booking/list')?>" style="color: white">  <p> Appointments</p></a>
        </div>
        <div class="icon">
            <i class="fa fa-user"></i>
        </div>
        <a href="<?=base_url('booking/list')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
    
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3 style="opacity:.20;" >44</h3>
            <a href="<?=base_url('booking/list')?>" style="color: white">  <p> Appointments</p></a>
        </div>
        <div class="icon">
            <i class="fa fa-user"></i>
        </div>
        <a href="<?=base_url('booking/list')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>
    
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3 style="opacity: .0;">44</h3>
            <a href="<?=base_url('booking/list')?>" style="color: white">  <p> Appointments</p></a>
        </div>
        <div class="icon">
            <i class="fa fa-user"></i>
        </div>
        <a href="<?=base_url('booking/list')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div id="form">
<form action="<?=base_url('systems/posts')?>" method="post">
<?=printButton('','dPrinter/10/11','div')?>
<!-- <hr> -->
<div class="form-group">
    <label >Patient RefNo</label>
    <select class="form-control select2" style="width: 100%;" id="email" data-select="User" name="users">
    </select>
</div>


<div class='form-group'>
    <label>Sweet Sugar</label>
        <select class='form-control select2' style='width:100%;' id='description' data-select='Group' name='groups'>
    </select>
</div>
</div>



</form>

<?php 

$t = new tablo('users');
// $t->sqlstring = "select id, username, email, phone from users";
$t->print();
$t->table(2);


?>

<script>

</script>