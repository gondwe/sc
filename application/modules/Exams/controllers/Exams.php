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
        
        $data['classes'] = $this->Exam->classes();
        
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

        $action = in_array($code, $codes) ? "deregisterSubject" : "registerSubject";

        $this->Exam->$action($code);
    
    }

    public function rebuildPointsRemarks()
    {
        $com = $this->Exam->rebuildPointsRemarks();
        
        $this->db->insert_batch('subject_grades',$com);
        
    }


    public function analysis($param=null)
    {
        $data['modules'] = $this->Exam->Modules();

        $data['active'] = 'analysis';
    
        serve('analysis/dashboard',$data);
    
    }
 
    public function ajaxTerms($i) { $this->Exam->ajaxTerms($i); }

    public function ajaxTermExam($i,$j) { $this->Exam->ajaxTermExam($i,$j); }

    public function analyze($param)
    {
    
        $data['modules'] = $this->Exam->Modules();

        $data['active'] = 'analysis';

        $data['exam'] = $this->Exam->details($param);

        serve('analysis/single',$data);
    
    }


    public function saveMarkEntry($id, $subj, $mark, $admNo) { $this->Exam->saveMarkEntry($id, $subj, $mark, $admNo); }


    public function saveGradeEdit($id,$field, $mark){ $this->Exam->saveGradeEdit($id,$field, $mark); }
}