<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MX_Controller {

	public function index()
	{
		
		$data["actions"] = [
			"reset",
			"keyfile",
		];

		$this->institution();
		
	}

	
	public function streams(){ $this->serve("streams"); }
	public function classes(){ $this->serve("classes"); }
	public function institution(){ $this->serve("institution"); }
	public function dorms(){ $this->serve("dorms"); }
	public function terms(){ $this->serve("terms"); }
	
	protected function serve($service)
	{
		$data['modules'] = $this->modules();
		$data["active"] = $service;
		serve($service, $data);
	}

	protected function modules()
	{
		return [
			"institution",
			"classes",
			"streams",
			"dorms",
			"terms",
		];
	}
	
	
}
