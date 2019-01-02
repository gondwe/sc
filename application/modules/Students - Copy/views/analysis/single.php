<?=examDashboard();?>
<h5>Single Analysis</h5>

<?php 
activeModules($active,$modules,"exams");

?>
<?php 

if(empty($exam)){

    /* choose exam to analyze again */
    
    $this->load->view('parts/select_exam');

}else{
    
    /* proceed with loaded id */
    pf($exam);

}

