<?php


/* 
    *   crud master
    *   @author:gondwe
    *   url:developer@nardtec.net
    *   2015
 */

class Crud extends MX_Controller {
    function __construct()
    {
        // $this->load->helper("fieldsets");
        // $this->load->library("tablo");
        // $this->load->model("stack_exchange");
    }


    public function ajaxNew($table)
    {
        $d = new tablo($table);
        $d->formgrid(6,12,12);
        $d->newform();
    }


    public function ajaxEdit($table,$id)
    {
        $d = new tablo($table);
        $d->edit($id);
    }

    public function ajaxDel($table,$id)
    {
        this()->db->delete($table, ['id'=>$id]);
    }


    public function edit($table=null,$id=null, $valuetype=null){
        if(is_null($table) || is_null($id)) redirect("/", "refresh");
        
        $data["id"] = $id;
        $data["table"] = $table;
        $data["vt"] = $valuetype;
        serve("crud/edit",$data);
    }

    public function insert($t,$ref=null){
        $table = array_pop($_POST);
        pf($table);
        $ref = $ref ?? $_SERVER["HTTP_REFERER"];
        
        if($id = $this->insertrecord($table)){
            // datalog("New Record Created - $t");
            // success("Data Entry Successful");
        }

        // misc functions 
        // $this->stack_exchange->shuffle($table);
        redirect($ref);

        // pf($ref);
        // pf($_SERVER["HTTP_REFERER"]);
        
    }


    function insertrecord($table){
        if($this->db->insert($table, $_POST))
        return $this->db->insert_id();
    }

    function new($table){
        $data["table"] = $table;
        serve("crud/new",$data);
    }

    public function save($t,$ref = null){
        // pf($this->uri);
        $ref = is_null($ref) ? $_SERVER["HTTP_REFERER"] : $ref;
        pf($ref);
        $table = $t;
        // exit();
        if(!empty($_POST)){
            $id = array_pop($_POST); 
            foreach($_POST as $k=>$v){ $fields[] = "`$k`='$v'"; }
            $fields = implode(", ",$fields);
            $sql = "update $table set $fields where id = '$id'";
            savefiles($table, $id);
            if(process($sql)){ datalog("Update of Record $id on $t"); success("Save Successful"); }
            redirect($ref);
        }
    }


    public function view_data(){
        $i = current ( $_SESSION["params"] ) ;
        
        $d = new tablo($i);
        switch($i) {
            case "settings" : $d->hide("school_code,logo,sign,email,category"); break;
            case "patient_master" : $d->sqlstring = "Select * from `$i` limit 100"; break;
        }


        $d->table();
    }


    function delete($table,$id){
        $sql = "delete from `$table` where id = '$id'";
        if(process($sql)) datalog("Deletion of Record $id on $t");;
    }


    public function search($mod, $meth, $arg=''){
        if(isset($_POST["s"])){
            $req = ($_POST['s']);
            $echo = '';
            
            if($req !== ""){
                $data = [];
                $mdname = $mod."/".$mod."_model";
                $md2 = $mod."_model";
                
                $model = $this->load->model($mdname);
                $data = $this->$md2->$meth($req);

                foreach($data as $k=>$v){
                    $echo .= '<li id="reslist" class="form-control" data-rate="'.$v->unit_cost.'" data-id="'.$v->id.'" onclick=lod(this)>'.$v->item.'</div>';
                }
            }

            echo $echo;
        }
    }
}