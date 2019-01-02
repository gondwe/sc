<?php 


        
$data = $this->db->get('rpg')->result();

// pf(current($data));

?>
<div class="pull-right col-md-6">
<h3>Grading Model</h3>
<table class="table-striped table-bordered w-100">
    <thead>
        <tr>
            <th class='px-2'>G</th>
            <th class='px-2 text-center'>Low</th>
            <th class='px-2 text-center'>High</th>
            <th class='px-2 '>Remarks</th>
            <th class='px-2 text-center'>Points</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $grades): ?>
        <tr>
            <td class='px-3'><?=$grades->g?></td>
            <td class='text-center'><?=$grades->lowest?></td>
            <td class='text-center'><?=$grades->highest?></td>
            <td class='pl-3'><?=$grades->r?></td>
            <td class='px-3'><?=$grades->p?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

