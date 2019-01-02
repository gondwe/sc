
<?php $classes  = $this->db->select('id,name')->get('classes')->result(); ?>
<?php $streams  = $this->db->select('id,name')->get('streams')->result(); ?>

        
        <span class="d-inline-flex mr-2">
                <div class="form-inline">
                <label for=""><small>CLASS</small> &nbsp</label>
                <select class="form-control-sm" name="classes" id="classname">
                    <option value="0">All</option>
                    <?php 
                        foreach ($classes as $id => $class):
                            echo "<option value='$class->id'>".$class->name."</option>";
                        endforeach;
                    ?>
                </select>
                </div>
        </span>
            
    
        <span class="d-inline-flex mr-2">
                <div class="form-inline">
                <label for=""> <small>STREAM</small> &nbsp</label>
                <select class="form-control-sm" name="classes" id="stream">
                    <option value="0">All</option>
                    <?php 
                        foreach ($streams as $id => $class):
                            echo "<option value='$class->id'>".$class->name."</option>";
                        endforeach;
                        ?>
                </select>
                </div>
        </span>
        
        <span class="d-inline-flex float-right mr-2">
                        <button type="button" class="btn btn-success">PRINT</button>
        </span>
            <hr>

        <script>
        $(document).ready(function(){
            $('#classname').change(function(){
                let stream = $('#stream').val();
                
                $.get("<?=base_url('students/filterClass/')?>" + this.value + '/' + stream)
                .then(function(res){
                    $('#play').html(res)
                });

            })
           
            $('#stream').change(function(){
                let classname = $('#classname').val();
                
                $.get("<?=base_url('students/filterClass/')?>" + classname + '/' + this.value)
                .then(function(res){
                    $('#play').html(res)
                });

            })

        });
        </script>