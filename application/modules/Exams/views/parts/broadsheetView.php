<?php 



$sublist = subjectList($subjects);

$codelist = array_keys($sublist);

$codes = implode('`,b.`',$codelist);

// pf($exam);

$data = $this->db
->select('b.id, b.adm_no, s.name,b.`'.$codes.'`')
->where('b.exam_code',$exam->id)
->from('broadsheet b')
->join('students s', 's.adm_no = b.adm_no')
->get()
->result_array();


// pf($data);

$titles = array_keys(current($data));

array_shift($titles);   // removes the name offset

?>

<table class="w-auto table-striped">
    <thead class="thead-inverse">
        <tr>
            <?php 
                
                array_map(function($th){

                    echo "<th class='text-center border-right'>".strtoupper($th)."</th>";

                },$titles);
                echo "<th>&nbsp</th>";
            ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $tbody): ?>
            <tr>
            <?php 
            $id = array_shift($tbody);
            
            $admNo = array_shift($tbody);

            $names = array_shift($tbody);
            
            echo "<td class='text-center border-right'>$admNo</td>";
            
            echo "<td class='px-md-3' >".strtoupper($names)."</td>";
            

                foreach($tbody as $tr=>$td): /* pf($tbody) */ ?>
                    
                    <td style='width:3px'>
                        
                        <input type="text" data-admno="<?=$admNo?>" class='text-center marks' style="width:30px" data-subject='<?=$codelist[$tr]?>' value="<?=$td?>" data-id="<?=$id?>">

                    </td>

                <?php 
                    endforeach;
                    echo "<td></td>";
                 ?>
            </tr>

        <?php endforeach; ?>

        </tbody>
</table>

<?php 


$this->load->view('entry_script',['exam'=>$exam]);