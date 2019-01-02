<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends MX_Controller {


	public function __construct()
	{
	
		 $this->load->model('Exam');
	
	}

	public function index()
	{
		
		$this->student();

	}


	public function exams($action='dashboard')
	{

		redirect('exams/'.$action);
		
		$data = $this->Exam->dashboard($action);
		
		$data["modules"] = $this->modules();

		serve('exams/'.$action, $data);
		
	}

	public function student()
	{
		
		$data["actions"] = $this->actions();
		$data["modules"] = $this->modules();
		$data["active"] = "student";
		
		serve('home/dashboard', $data);
		
	}

	private function modules()
	{
		return [
			"staff",
			"student",
			"exams",
			"finance",
			"library",
		];
	}

	function actions()
	{
		return [
			"password",
			"backup",
			"config",
		];
	}

}
