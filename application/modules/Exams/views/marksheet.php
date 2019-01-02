

<a name="" id="" class="btn btn-primary btn-sm pull-right mx-2" href="<?=base_url("exams/analyze/$id")?>" role="button">ANALYZE THIS EXAM</a>
<?php 
examDashboard();

?>
<h5>Edit Marks for 
    <div class="badge badge-info"><?=strtoupper($exam->exam)?></div>
    <div class="badge badge-danger"><?=strtoupper($exam->class)?></div>
    <span class="badge badge-warning"><?=$exam->percentage?>%</span>
    <div class="badge badge-default">Out of <?=$exam->outof?></div>
</h5>
<hr>
<?php 


$sub = $_GET['subject'] ?? null;
$option = $_GET['option'] ?? null;

?>

<div class="clearfix mb-3"></div>

<form class='' action="" method="get">
    <button type='submit' name='option' value='perSubject' class='btn btn-secondary'>Subject View</button>
    <button type='submit' value='broadsheet' name='option' class='btn btn-secondary float-right'>Broadsheet View</button>
    <hr>

    

    <?php 
        $optionalView = is_null($option) ? 'subjectSelectionDropdown' : ($option == 'broadsheet' ? 'broadsheetView' : 'subjectSelectionDropdown');  
        $data = [
            "optionalView"=>$optionalView,
            "sub"=>$sub,
            "option"=>$option,
            "exam"=>$exam,
        ];
        
        if($option !== 'broadsheet')
        { 
            $this->load->view('parts/subjectView',$data);

        }else{
            echo '</form>';
            $this->load->view("parts/".$optionalView, $data); 
        }
?>


</div>
</div>
