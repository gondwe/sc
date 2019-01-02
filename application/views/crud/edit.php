<?=titles(topic("Edit ".$vt ?? $table))?>
<hr>
<?php


/* 
    *   crud editor
    *   @author:gondwe
    *   url:developer@nardtec.net
    *   2018
 */


    $d = new tablo($table, $vt);

    
    // field injection use cases

    switch ($table){
        case "patient_master" : 
        // $d->hide("dob");
        break;
        
    }


    $d->edit($id);