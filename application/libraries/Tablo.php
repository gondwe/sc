<?php 

/* 
auth:ace.2015
*/

// $this->load->helper("fieldsets");

class Tablo extends fieldsets{
	protected $table;
	protected $data;
	protected $fields;
	protected $fieldnames;
	protected $rowcount;
	protected $combos;
	protected $view_hidden;
	protected $cases;
	protected $order_by = null;
	protected $where = null;

	private $db;
	
	public $sql;
	public $sqlstring;
	public $values = [];
	public $pictures = [];
	public $aliases = [];
	// public $where;
	public $edit = true;
	public $delete = true;
	public $buttons = [];
	public $lg = "4";
	public $md = "6";
	public $sm = "12";
	public $valuetype;
	public $mask=[];
	public $hidden=[];
	
	
	private $fieldtypes;
	
	private $reserved = ["id","date","created_at","updated_at"];
	// private $reserved = [];
	
	
	function __construct($tbl=null, $cat = null){ $this->db = db(); $this->valuetype = $cat; $this->table = $tbl; $this->hide("sid,scode"); }
	
	
	function init($id=null){
		$this->fsets();
		$i = gettype($this->table);
		switch($i){
			case "string" : 
			$this->sql = str_word_count($i) > 1 ? $this->table : "select * from `$this->table`";
			$this->query($id);
			break;
		}
		$this->fieldtypes = ["int"=>"number","3"=>"number","float"=>"number","timestamp"=>"date","7"=>"date","252"=>"textarea","blob"=>"textarea","varchar"=>"text","253"=>"text",];
		
	}
	
	function query($id=null){ if(is_null($id)){ $this->data = $this->get($this->sql);  }else{ $this->data = $this->get($this->sql." where id = '$id'"); } }
	function formgrid($lg="4",$md="6",$sm="12"){ $this->lg = $lg; $this->md = $md; $this->sm = $sm; }
	
	/* auto fill form combo boxes  */
	public function combos($a,$b){ $data = is_array($b)? $b : $this->arrlist($b); $this->combos[strtolower($a)] = $data; }
	public function button($i,$j){ $this->buttons[$i] = $j; }
	public function ucase($fld){ $this->cases["$fld"] = "ucase"; }
	function aliases($alias){ $al = explode(",",$alias); $this->aliases[current($al)] = end($al); }
	public function values($field,$value){ $this->values[$field] = $value; }
	/* hide some fields only in table view */
	function view_hidden($i){ $this->view_hidden = explode(",",$i); }
	
	/* display a table */
	public function table($display_links = 1){
		$this->init();
		$cm = null;
			
		if( is_string( $this->sqlstring)){
			$this->data = $this->get($this->sqlstring);
		}
		
		if($display_links == 1){
		echo '
		<section class="content">
  	  	 <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="btn-group pull-right m-3">
                    <a class="btn btn-primary btn-sm" href="'.site_url('/#add_new/'.$this->table).'"><i class="fa fa-plus"></i> NEW</a>
					<a class="btn btn-info btn-sm" style="margin-left:12px;" onclick="pdfme()"><i class="fa fa-download"></i> EXPORT</a>
                </div>
            </div>    
		</div>';	
		}

		openDataTables();

		echo'<table id="example" class="display striped" style="width:100%;">';
		echo "<thead class='bg-light'>";
			echo "<tr id='tablohead' class='text-dark border-top'>";
				echo "<th  style='border-right:1px solid #ddd;'>SNO</th>";
			foreach($this->fieldnames as $ff):
				if(!in_array($ff,$this->reserved)){ $fg = strtolower($ff);
					if($fg !== "scode") { $fh = isset($this->aliases[$fg]) ? $this->aliases[$fg] : $ff; echo "<th class='px-2'>".strtoupper(rxx($fh))."</th>"; }
				}
			endforeach;
			if(!empty($this->buttons)){$span = count($this->buttons); $actions = $span>1? "s" : null; echo "<th colspan='$span'>Action$actions</th>";}
			echo $this->edit ? "<th><i data-toggle='tooltip' title='Edit' class='fa fa-edit text-light text-lg'></i></th>" : null;
			echo $this->delete ? "<th><i  data-toggle='tooltip' title='Delete' class='fa fa-minus-square text-light'></i></th>" : null;
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
			$x = 1;
			foreach($this->data as $d=>$dd):
			echo "<tr id='row".$dd['id']."'>";
			echo "<td style='border-right:1px solid #ccc; width:2px; text-align:center'>$x</td>";
				foreach($dd as $db=>$da){
					if(!in_array($db, $this->reserved)){ 
						if(isset($this->combos[$db])){
							$mycase = isset($this->cases[$db]) ? $this->cases[$db] :false;
							$combod = $this->combos[$db][$da] ?? null;
							$cased = $mycase ? $mycase($combod) : $combod;
							echo "<td>".@$cased."</td>";
						}else{
							if(strtolower($db) !== "scode") { 
								$mycase = isset($this->cases[$db]) ? $this->cases[$db] :false;
								$cased = $mycase ? $mycase($da) : $da;
								echo "<td>$cased</td>"; }
						}
							
					}
				}
			if(!empty($this->buttons)){
				foreach($this->buttons as $b=>$t){
					echo "<td><a class='btn btn-outline-info btn-xs btn-sm' href='".base_url($t."/".$dd['id'])."' >$b</a></td>";
				}
			}
			
			// <a data-toggle='tooltip' title='Edit' href='".base_url('crud/edit/'.$this->table."/".$dd['id']."/".$this->valuetype)."'><i class='fa fa-edit text-primary' style='color:#800f7b'></i></a>
			echo $this->edit ? '<td style="width:2px;">
			<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal" data-title="'.ucfirst($this->table).'" data-id="'.$dd['id'].'"><i class="fa fa-edit"></i></button>
			</td>' : null;
			// $urlx = base_url("crud/delete/".$this->table."/".$dd['id']);
			// <a data-toggle='tooltip' title='Delete'  class='' onclick='dltr(\"".$urlx."\",\"".$dd['id']."\");'><i class='fa fa-trash-o text-danger'></i></a>
			echo $this->delete ?  '<td style="width:2px;">
			<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalDel" data-title="'.ucfirst($this->table).'" data-id="'.$dd['id'].'"><i class="fa fa-trash "></i></button>
			</td>' : null;
			echo "</tr>";
			$x++;
			
			
			endforeach;
			
		echo "</tbody>";
		echo "</table>";
		
		echo '
		
		</div>
            </div>
        </div>
    </div>
    </div>
	</div>';

	closeDataTables($display_links);
	dataTableModals();

	}

	public function order_by($a,$b){
		$this->order_by = " order by $a $b";
	}

	public function where($a){
		$this->where = " where $a";
	}
	
	/* create a new input form */
	public function newform(){
		$this->init();
		$_SESSION["action"] = "insert";
		echo "<form action='".base_url('crud/insert/'.$this->table)."' enctype='multipart/form-data' class='mx-md-1' method='post'>";
			/* call form fields */
			$this->form_fields();
			/* add hidden fields */
			foreach($this->hidden as $k=>$h){ echo "<input type='hidden' name='$k' value='".$h."'>"; }
			/* insert table name into form */
			echo "<input type='hidden' name='tbl_name' value='".$this->table."'>";
			/* call submit  */
			$this->submitbtn($this->table);
		echo "</form>";
	}
	
	/* call the submit button */
	function submitbtn($name=null){
		echo '<div class="col-lg-'.$this->lg.' col-md-'.$this->md.' col-sm-'.$this->sm.' col-xs-12 pull-left ">';
		echo "<p><input type='submit' value='SAVE' class='form-control text-light btn bg-primary'></p>";
		echo "</div>";
	}


	protected function form_fields(){
		foreach($this->fields as $id=>$f): $this->fieldset($f); endforeach;
	}

	/* make form elements hidden. These fields are  persistable to db! */
	function hidden($name, $value){ $this->hidden[$name] =$value; $this->hide($name); }

	/* load the edit form  */
	public function edit($a,$cm=null){
		$this->init($a);
		$_SESSION["action"] = "update";
		/* create edit from */
		echo "<form action='".base_url('crud/save/'.$this->table)."' role='form'  enctype='multipart/form-data' class='mx-md-1' method='post'>";
		/* form fields */
		$this->form_fields();
		/* add table name */
		echo "<input type='hidden' name='rowid' class='' value='".$this->data[0]["id"]."'>";
		$this->submitbtn($this->table);
		
		echo "</form>";

		
	}
	


	function fieldset($d){
		$value_set = isset($this->values[$d->name])? $this->values[$d->name] : null;
		$value = $_SESSION["action"] == "update" ? $this->data[0][$d->name] : $value_set;

		$style = isset($this->combos[$d->name]) && !in_array(strtolower($d->name),$this->reserved)? "style='width:85%'" : "null";
		
		if(!in_array(strtolower($d->name),$this->reserved) && !in_array(strtolower($d->name),$this->reserved)){ 
			echo "<div class='input-group col-lg-".$this->lg." col-md-".$this->md." col-sm-".$this->sm." pull-left mb-3' >";
		}else{
			echo "<div>";
		}
			$this->label($d->name);
			$this->reserve_filter($d,$value);
			echo "</div>";
	}
	
	/* filter out reserved fields */
	function reserve_filter($d,$v){
		global $user;
		$name = strtolower($d->name);
		if(!in_array($name,$this->reserved)){
			if(isset( $this->combos[$name])){
				$this->combo_filter($d, $v);
			}else{
				$disabled = isset($this->values[$d->name])? "readonly=TRUE" : null;
				if($d->type == "252" || $d->type == "textarea" || $d->type == "blob"){
					echo "<textarea $disabled type='text' name='$d->name' class='form-control' rows=5>$v</textarea>";
				}elseif($d->type == "7" || $d->type == "timestamp" || $d->type == "date"){
					$v = explode(" ",$v)[0];
					echo "<input  $disabled  class='form-control' required type='".$this->fieldtypes[$d->type]."' name='$d->name' value='$v' />";
				}else{
						
					if($d->name == "scode" || $d->name == "sid" ) {
						echo "<input  $disabled type='hidden' name='$d->name' value='".$user->scode."' />";
					}elseif(in_array($d->name, $this->pictures)){
						
						if($_SESSION["action"] == "update"){
							
							$img = is_file("assets/img/".$this->table."/".$v)? "assets/img/".$this->table."/".$v : "assets/img/noimage.png";
							echo "<img src='".base_url($img)."' width='100px'>";
							
						} 
						echo "<input  $disabled class='form-control' type='file' name='$d->name' value='$v' />";
					}else{
						echo "<input  $disabled class='form-control' required type='".$this->fieldtypes[$d->type]."' name='$d->name' value='$v' />";
					}
				}
			}
		}
		
		
	}
	
	
	
	/* fill in selectbox bound fields */
	function combo_filter($d,$v){
		if(isset($this->combos[$d->name]) && !in_array(strtolower($d->name),$this->reserved)){
			$disabled = isset($this->values[$d->name])? "disabled=TRUE" : null;
			echo "<select  $disabled name='$d->name' class='form-control' >";
				foreach($this->combos[$d->name] as $i=>$j){
					$selected = $i == $v ? "selected" : null;
					echo "<option value='$i' $selected >".strtoupper($j)."</option>";
				}
			echo "</select>";
		}
	}
	
	function label($n){ 
		$n = strtolower($n);
		if(!in_array($n,$this->reserved)){
			if( $n !== "scode" && $n !== "sid" ){
				$label = isset($this->aliases[$n]) ? $this->aliases[$n] : $n;
				echo "
				<div class='input-group-prepend'>
					<div class='input-group-text'>".strtoupper(rxx($label))."</div>
				</div>
				";
			} 
		}
	}
	
	function hide($a){
		$a = preg_replace("/(, )( ,)/",",",$a);
		$a = preg_replace("/^[,\s]+|[\s,]+$/",null,$a)	;
		$a = explode(",",$a);
		foreach($a as $b){
			$this->reserved[] = trim($b);
		}
	}
		
	
	
	protected function get($i){ 
		$l =[];
		$db = this()->db;
		$a = $db->query($i.$this->where.$this->order_by) or spill($db->error());
		$j = $a->result_array(); 
		$this->fields = $a->field_data();
		$this->fieldnames = $a->list_fields();
		return $j;
	}
		

	
	function arrlist($si){ 
		$l = [];
		$i = this()->db->query($si)->result_array();
		foreach($i as $j=>$k){ $l[current($k)] = end($k); }
		// pf($l);
		return $l;
	}
	
	
}


/* actions via ajax */




?>


<?php 

// unrelated tables

function tablefoot3(){
	$arg = func_get_args()[0];
	echo "
        <script src='".base_url('assets/js/jquery-3.3.1.min.js')."'></script>
		<script>
		$(document).ready(function() {
			$('#example').DataTable({
				'ordering': ".$arg["ordering"].",
				'info': ".$arg["info"].",
				'paging': ".$arg["paging"].",
				'searching': ".$arg["searching"].",
				'pageLength': ".$arg["pageLength"].",
			});
		} );
		
		</script>
		
		";

    }

function hr(){
	echo "<p style='width:110%; border-top:1px solid #aaa; opacity:0.4; height:1px; background:#ccc; margin-left:-100px; margin-bottom:10px'></p>";
}

