<?=examDashboard()?>

<h5>config : Subjects</h5>
<?php activeModules($active,$modules,"exams/config") ?>
<hr>

<?php 

$done = array_column($subjects,'code');


foreach ($allSubjects as $code => $subject):
   
    $class = in_array($subject->code,$done)? 'danger' : 'secondary';
   
    echo '<button type="button" data-code="'.$subject->code.'" class="sbcode m-1 btn-sm btn btn-'.$class.'">'.$subject->name.'</button>';

endforeach;

?>
<hr>




<script>
    $('.sbcode').click(function(){
        let code  = $(this).data('code');
        let classes  = ['btn-danger', 'btn-secondary'];
        $(this).toggleClass(classes);

        //register & derigister in background
        $.post("<?=base_url('exams/configSubject/')?>" + code, function(res){
            //handle response later
        })
    })
</script>


