<?php 

$class = $_GET['c'];

$sub = $_GET['s'];

$where = [ 'class'=>$class, 'code'=>$sub, ];
        
$data = $this->db->where($where)->get('subject_grades')->result();

// pf(current($data));

?>

<table class="table-striped pull-right mr-5 col-md-6">
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
            <td class='px-3'><?=$grades->grade?></td>
            <td><input  data-id="<?=$grades->id?>" data-field="lowest" style='width:35px' class='marks text-center' type="text" value="<?=$grades->lowest?>" ></td>
            <td><input  data-id="<?=$grades->id?>" data-field="highest" style='width:35px' class='marks text-center' type="text" value="<?=$grades->highest?>" ></td>
            <td><input data-id="<?=$grades->id?>" data-field="remarks" class='marks pl-3' type="text" value="<?=$grades->remarks?>" ></td>
            <td class='px-3'><?=$grades->points?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    $('.marks').on('change', function(){
        let id = this.dataset.id;
        let field = this.dataset.field;
        $.post("<?=base_url('exams/saveGradeEdit/')?>" + id + '/' + field + '/' + this.value);
    });

</script>