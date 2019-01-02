
<div class="card text-left">
  <img class="card-img-top" src="" alt="">
  <div class="card-body">
    <h4 class="card-title">
        
        
        <?php $this->load->view('student/filters'); ?>

    </h4>
    

<div id="play">
<?php 

$t = new  tablo('students');
// $t->where("classname = 1");
$t->table(2);

?>
</div>

</div>
</div>
<?php 

