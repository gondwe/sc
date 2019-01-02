<?=examDashboard()?>

<h5>config : Grading</h5>
<?php activeModules($active,$modules,"exams/config") ?>
<hr>
<?php 

$rec = $this->db->count_all('subject_grades');

if( $rec){

    $this->load->view('grading/form');

    if(isset($_GET['c']) && isset($_GET['s'])){   
        
        $this->load->view('grading/edit');
        
    }else{
        
        $this->load->view('grading/model');
    }
    
    
} else{ echo '<button type="button" id="reb" class="rebuild btn btn-secondary">Rebuild Grading Table</button>'; } 


?>

<script>
    $('.rebuild').click(function(){
        $.post("<?=base_url('exams/rebuildPointsRemarks')?>", function(){
            swal('Success','Points Remarks Table has been Generated','success');
            $('#reb').hide();
        }).catch(function(e){
            swal("warning",e.statusText,'warning');
        });
    })
</script>