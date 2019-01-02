<?php 




?>

<div class="pull-left">
<form action="" method="get" class='m-md-4'>
    
    <div class="form-group">
    
      <select class="form-control" name="c" id="cls" required>
    
          <option value=''>SELECT CLASS</option>
          
            <?php foreach ($classes as $id=>$class) {
                echo "<option value='{$class->id}'>".ucase($class->name)."</option>";
            }?>
      </select>

    </div>      
    
    <div class="form-group">
    
      <select class="form-control" name="s" id="cs" required >
    
          <option value=''>SELECT SUBJECT</option>

            <?php foreach ($subjects as $id=>$sub) {
                echo "<option value='{$sub->code}'>{$sub->name}</option>";
            }?>
      </select>

    </div>     

    <button type="submit" class="btn btn-primary">Submit</button> 
    

</form>

<div class="ml-md-3">
<?php 
  if(isset($_GET['c']) && isset($_GET['s'])){   

    $cs = array_column($subjects,'code');
    $sv = array_column($subjects,'abbr');
    $subx = array_combine($cs,$sv);
    
    $subject = "<span class='display-3 pl-3'>{$subx[$_GET['s']]}</span>";

    $cs = array_column($classes,'id');
    $sv = array_column($classes,'name');
    $subx = array_combine($cs,$sv);

    echo "<p class='display-4 pl-3 text-success'>{$subx[$_GET['c']]}</p>".$subject;
    
}

?>
</div>

</div>



