<?=examDashboard()?>

<h5>config : Grading</h5>
<?php activeModules($active,$modules,"exams/config") ?>
<hr>

<button type="button" class="rebuild btn btn-secondary">Rebuild Grading Table</button>
<?php 


?>

<script>
    $('.rebuild').click(function(){
        $.post("<?=base_url('exams/rebuildPointsRemarks')?>", function(){
            swal('Success');
        });
    })
</script>