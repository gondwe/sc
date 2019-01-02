<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends MX_Controller {

	public function index()
	{
		
		
	}


	public function filterClass($c,$s)
	{
		
		$c = $c == 0 ? " > 1 " : ' = '.$c;
		$s = $s == 0 ? " > 1 " : ' = '.$s;

		$t = new  tablo('students');
		$t->where("classname ".$c." and stream ".$s);
		
		$t->table(2);
		
	}

}
