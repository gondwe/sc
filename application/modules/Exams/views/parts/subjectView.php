<?php 

            echo '<div class="row">';
            $this->load->view($optionalView); 
        ?>
            </form>
            <div class="col-md-9" id='ajaxMarks'>
            <?php 

            $where = [
                "b.exam_code"=>$exam->id,
                "s.classname"=>$exam->class_id,
            ];

            if(!is_null($sub) && $sub !== '0'){
                $sub = $_GET['subject'];
                $data = $this->db->select("b.id,b.adm_no,s.name,b.`$sub` marks")
                ->where($where)
                ->from('broadsheet b')
                ->join('students s','s.adm_no = b.adm_no', 'left')
                ->get()
                ->result();

                $this->load->view('exams/parts/markentry', ["data"=>$data,"exam"=>$exam,"sub"=>$sub]);
            
            } else {
                echo "<h5 class='mt-3 alert alert-secondary border rounded text-center'><i class='fa fa-arrow-left'></i> Select A Subject to Edit Marks.</h5>";
            }
            
        ?>

    <script>
        $('#subjectList').change(function(){
            $('form').submit();
        })
    </script>