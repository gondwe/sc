<table class="w-auto table-striped">
    <thead>
        <tr>
            <th  class="text-center">Reg No</th>
            <th>Names</th>
            <th class='text-center mx-md-4'>Mark</th>
        </tr>
    </thead>
    <tbody>
    
    <?php foreach ($data as $key => $values): ?>
        <tr>
            <td class="text-center"><?=$values->adm_no?></td>
            <td><?=$values->name?></td>
            <td>
                <input style='width:30px' data-id="<?=$values->id?>" data-admno="<?=$values->adm_no?>"  class='text-center marks mx-md-4'  type="text" data-subject="<?=$_GET['subject']?>" value="<?=$values->marks?>">
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>


<?php 

$this->load->view('entry_script',['exam'=>$exam]);