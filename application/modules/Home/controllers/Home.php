<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function index()
	{
		
		$data["modules"] = [
			"staff",
			"student",
			"exams",
			"finance",
			"library",
		];
		
		$data["actions"] = [
			"password",
			"backup",
			"config",
		];

		$data["active"] = "student";

		serve('dashboard', $data);

	}


	public function about()
	{
		
		serve("about");
	}

}
