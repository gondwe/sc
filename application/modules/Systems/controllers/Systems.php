<?php 

defined("BASEPATH") || exit('No Way Through');

class Systems extends MX_Controller {


    public function combo($table, $field)
    {

          $ret = $this->db->select("id, `$field`")->get($table)->result_array();
    
          echo json_encode($ret);
    }

    public function posts() { pf($_POST); }


    public function tests() { serve('developer'); }


    public function tabloPrinter()
    {
    
         $contents = current($_POST);
    
         $dom = new DOMDocument;
         $dom->loadHTML($contents);

         $items = $dom->getElementsByTagName('tr');

            foreach ($items as $node) {
                
                foreach($node->childNodes as $th){ 

                    $ths[] = $th->nodeValue;

                }
                $tr[] = $ths; $ths= [];
            }


        $titles = array_filter(array_shift($tr));

        $body = array_map(function($data) use ($titles) {
            return  current(array_chunk($data,count($titles)));
        },$tr);

        $body = array_merge([$titles],$body); 
       
        $_SESSION['tablePrint'] = $body;

    
    }

    public function customPrinter()
    {

        $args = func_get_args();

        $view = array_pop($args);
        
        $data = array();
        
        if(!empty($args)){
            
            $method = current($args);
            
            if(method_exists(self::class, $method)){
                
                $method = array_shift($args);
                
                $data = $this->$method(empty($args) ? null : implode(',',$args));
                
            }
            
        }
        
        $data['data'] = empty($data)? $args : $data;

        $this->load->view('print/header');
        
        $this->load->view("custom_print/".$view, $data);
        
        $this->load->view('print/footer');
    }


    private static function args(){ return explode(',',implode(',',func_get_args())); }


    public function divPrinter() { $_SESSION["divPrint"] = current($_POST); }


    public function out($param=null)
    {
    
        if(!is_null($param)){

            $this->load->view('print/header');

            $this->load->view('print/'.$param) ;

            $this->load->view('print/footer');

        }
    
    }

}