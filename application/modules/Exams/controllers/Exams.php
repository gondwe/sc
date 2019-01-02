<?php 


class Exams extends MX_Controller {


    public function __construct()
    {
        $this->load->model('Exam');
    }

    public function index()
    {
        $this->dashboard();
    }


    public function dashboard($action="dashboard")
    {

        $data = $this->Exam->dashboard($action);
        $data['modules'] = $this->Exam->modules();
        $data["active"] = "dashboard";
        serve('dashboard', $data);
    }


    public function config($active = 'subjects')
    {   

        
        $data['allSubjects'] = $this->Exam->allSubjects();
        $data['subjects'] = $this->Exam->subjects();
        $data["modules"] = ['subjects','grading'];
        $data['active'] = $active;
         serve("config/$active", $data) ;
    
    }


    
	public function actions($action='dashboard')
	{

		$data = $this->Exam->dashboard($action);
		
		$data["modules"] = $this->Exam->modules();

        $data['active'] = $action;

		serve($action, $data);
		
	}



    public function configSubject($code)
    {
    
         /* check if subject in broadsheet */
        $codes = array_column($this->Exam->subjects(),'code');

        if(in_array($code, $odes)){
             $this->Exam->deregisterSubject($code);
        }else{
            $this->Exam->registerSubject($code);
        }
    
    }

    public function rebuildPointsRemarks()
    {

    }


    public function analysis($param=null)
    {
        $data['modules'] = $this->Exam->Modules();

        $data['active'] = 'analysis';
    
        serve('analysis/dashboard',$data);
    
    }

    public function ajaxTerms($i)
    {
        $this->Exam->ajaxTerms($i);
    }

    public function analyze($param)
    {
    
        $data['modules'] = $this->Exam->Modules();

        $data['active'] = 'analysis';

        $data['exam'] = $this->Exam->details($param);

        serve('analysis/single',$data);
    
    }


    public function saveMarkEntry($id, $subj, $mark, $admNo)
    {

        $exam = (Object) $_POST;
        // pf($exam);

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
}