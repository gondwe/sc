<?php 


class Fieldsets {

	private $thisb;
	public $orient;
	
	function __construct(){
		$this->db = db();
	}

	
	function fsets(){
		global $user;
		// $sid = $user->scode;
		$sid = 1;
		switch($this->table){
			case "users" : 
				$this->hide("password,salt,activation_code,forgotten_password_code,
							created_on,last_login,ip_address,forgotten_password_time,remember_code");
				$this->combo("user_type","select id, b from dataconf where a = 'usertype'");
			break;
			
			case "settings":
				$this->aliases("pobox, address");
				$this->aliases["pnumber"] = "phone";
				$this->aliases["location"] = "town";
				$this->pictures[] = "sign";
				$this->pictures[] = "logo";
			break;
			
			case "dataconf" : 
				if($this->valuetype == 'religion') {
					$this->aliases("b,RELIGION");
					$this->hide("a,c,d");
					$this->hide("a");
				}
			break;

			case "students" : 
				$this->combos("classname", "select id, name from classes");
				$this->combos("stream", "select id, name from streams");
				$this->combos("house", "select id, name from dorms");
				$this->order_by("created_at", "desc");
			break;
		}
		
	}

}