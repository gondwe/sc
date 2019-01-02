<?php 

$classes = $this->db->select('id, ucase(name) name')->get('classes')->result();

?>
<div class="m-3">
<form class="form">
    <div class="form-group">
        <select class="form-control" name="" id="class">
        <option value="0">SELECT CLASS</option>
        <?php 
            foreach ($classes as $id => $class):
                echo "<option value='$class->id' >$class->name</option>";
            endforeach;
        ?>
        </select>
    </div>
    <div id="termdiv"></div>
</form>


<script>

    $('#class').change(function(){
        $.get("<?=base_url('exams/ajaxTerms/')?>" + this.value, function(data){
            $('#termdiv').html(data);
        })
    })


</script>
