
<script>
    const limit = <?=$exam->outof?>;

    const saveMarkEntry = "<?=base_url('Exams/saveMarkEntry/')?>"
    
    $('.marks').on("change", function(){
        
        let mark = $(this).val();
            
            // check mark limit
            if(mark > limit ){
                $(this).val("")
                alert('This exam is out of ' + limit, "Limit Exceeded");
                $(this).focus()
                
            }else{
                //save the value to db
                mark = mark === "" ? '-' : mark;
                
                let sub = $(this).data('subject');
                let id = $(this).data('id');
                let admNo = $(this).data('admno');
                let excode = <?= json_encode($exam) ?>;
                
                $.post(saveMarkEntry + id + '/' + sub + '/' + mark + '/' + admNo, excode);
                    
            }

    });
    
</script>