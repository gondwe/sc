<?php 


class Exam extends CI_Model {



    protected $registeredCodes;

    protected $allSubjects;
    

    public function examsList()
    {

        return $this->db->get('exams')->result();
        
    }


    public function subjects()
    {
        
        $this->registeredCodes();

        $this->allSubjects();

        $this->subjects = array_filter($this->allSubjects, function($d){

            if(in_array($d->code, $this->registeredCodes)) return $d;

        });
        
        return $this->subjects;
    }


    public function allSubjects()
    {
        $this->allSubjects = $this->db->select('code,name,abbr')->get('subjects')->result();

        return $this->allSubjects;
    }

	public function classes()
	{
	
		return $classes = $this->db->get('classes')->result();
	
	}

    protected function registeredCodes()
    {
        $this->registeredCodes = array_filter(array_map(function($data){ 
        
            return $data->Field;  
        
        },$this->db->query('describe broadsheet')->result()), "is_numeric");

        return $this->registeredCodes;
    }


    public function details($id)
    {
        return current(
            $this->db
            ->select('ee.id, e.name exam, cl.name class, e.counts, e.outof, e.percentage, ee.class_id')
            ->where('ee.id',$id)
            ->from('exams e')
            ->join('exam_enrolments ee','ee.exam_id = e.id', 'left')
            ->join('classes cl','cl.id = ee.class_id', 'inner')
            ->get()->result());
    }

    public function dashboard($action)
    {
        $data['subjects'] = $this->subjects();
        
		$data["id"] = $this->examId($action);
        
        $data['exam'] = $this->examDetails($action);
		
		$data["active"] = "exams";
        
        return $data;
	}
	

	public function modules()
	{
		return [
			'correction_sheets',
			'dashboard',
			'analysis',
			'merits',
		];
	}

    
	protected function examDetails($page)
	{

		switch($page){
			
			case "marksheet" : 
				$exam = $this->Exam->details($this->examId($page));
			break;

			default : $exam = [];

		}

		return $exam;
	}

	protected function examId($page)
	{

		
		switch($page){

			case "marksheet" : $id = $this->uri->segment(4); break;

			default : $id = "";
		}

		return $id;
	}


	/* deregister subject via config */
	public function deregisterSubject($code)
	{
	
		 $broadsheet = "alter table broadsheet drop `$code`";
	
		 $analysisSheet = "alter table analysis_sheet drop `$code`, drop `".$code."p`, drop `".$code."g`, drop `".$code."r`";
	
		 $this->db->query($broadsheet);
	
		 $this->db->query($analysisSheet); 
	
	}

	/* register a subject via config */
	public function registerSubject($code)
	{
	
		$broadsheet = "alter table broadsheet add `$code` varchar(3) default ''";
		
		$analysisSheet = "alter table analysis_sheet add (`$code` varchar(3) default '',`".$code."p` varchar(3) default '',`".$code."g` varchar(3) default '',`".$code."r` varchar(3) default '') ";
		
		$this->db->query($broadsheet);
		
		$this->db->query($analysisSheet);

	
	}



    /* AJAX STUFF */
    /* ======================================================================================================= */
    /* ======================================================================================================= */
    /* ======================================================================================================= */
    /* ======================================================================================================= */
    /* ======================================================================================================= */

    
    public function ajaxTermExam($class,$term)
    {
        $where = [
			"e.class_id"=>$class,
			"e.year"=>date('Y'),
			"e.term"=>$term,
		];

		$found = $this->db
					->select("e.id,ex.name")
					->where($where)
					->from('exam_enrolments e')
					->join('exams ex', 'ex.id = e.exam_id')
					->get()
					->result();
		if($found){
			
		/* get list of exams */
		echo '
			<div class="form-group">
				
					';
					foreach ($found as $id => $e):
						echo "<p><a class='ml-md-3 btn btn-success' href='".base_url('exams/analyze/'.$e->id)."'>Analyze $e->name</a></p>";
					endforeach;
					echo '
				
			</div>';
			
		}else{
			echo '
			<div class="text-primary">No Exams Enroled in this Term</div>
			';
		}
    }


    public function ajaxTerms($class)
    {
        /* check if any exams are enrolled */
		$where = [
			"class_id"=>$class,
			"year"=>date('Y'),
		];

        $examsFound = $this->db->where($where)->get('exam_enrolments')->result();
        
		if(is_null($examsFound) || empty($examsFound)){ 
			echo "<p>No Exams Enroled / Found</p>";
			linkTo('Create New Exam','exams/new/'); 
			linkTo('Enrol This Class','exams/new/'.$class); 
		}else{
		
		/* get list of terms */
		$terms = $this->db->where('a','terms')->select('id,ucase(b) term')->get('vdata')->result();
			echo '
			<div class="form-group">
			  <select class="form-control" name="" id="terms">
				<option>SELECT TERM</option>
					';
					foreach ($terms as $id => $term):
						echo "<option value='$term->id'>$term->term</option>";
					endforeach;
					echo '
			  </select>
			</div>
			<div id="examdiv"></div>
			
			<script>
				$("#terms").change(function(){
					$.get("'.base_url('exams/ajaxTermExam/'.$class).'/" + this.value, function(data){
						$("#examdiv").html(data);
					})
				})
			</script>
			
			';
		}
	}
	

	public function rebuildPointsRemarks()
	{
	
		$rpg = $this->db->get('rpg')->result();

		$classes = array_column($this->classes(),'id');

		$codes = $this->registeredCodes();
        
        foreach($classes as $class){

            foreach($codes as $code){

                foreach($rpg as $r){

                    $com[] =  [ 
                        'code'=>$code, 
                        'grade'=>$r->g,
                        'points'=>$r->p,
                        'lowest'=>$r->lowest,
                        'highest'=>$r->highest,
                        'remarks'=>$r->r,
                        'class'=>$class,
                    ];
                }
            }
		} 
		
		return $com;
	
	}


	public function saveMarkEntry($id, $subj, $mark, $admNo)
	{

		$exam = (Object) $_POST;
	
        if($mark == "-" ){
        
            $this->db->query("update broadsheet set `$subj` = '' where id = '$id'");
        
            $this->db->query("update analysis_sheet set `$subj` = '' where adm_no = '$admNo' and exam_code = '$exam->id'");
        
        }else{
        
            /* save to the broadshheet */
            $this->db->query("update broadsheet set `$subj` = '$mark' where id = '$id'");
        
            /* save to the analysis sheet */
            $this->db->query("update analysis_sheet set `$subj` = '".round(($mark/$exam->outof)*100)."' where adm_no = '$admNo' and exam_code = '$exam->id'");
        
        } 
	
	}


	public function saveGradeEdit($id,$field, $mark)
	{
	
		$sql = "";

        if($mark > 0 && $mark < 101 && $field <> 'remarks') {
            
            $sql = "update subject_grades set `$field` = '$mark' where id = '$id'";
            
        }
        if($field == 'remarks'){
            
            $sql = "update subject_grades set `$field` = '$mark' where id = '$id'";
            
        }
        
        if($sql !== "") $this->db->query($sql); 
	
	}

}
