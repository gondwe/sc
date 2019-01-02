<?php 
function serve($view, $data=[]){$ci = &get_instance();$ci->load->view("section/header", $data);$ci->load->view($view,$data);$ci->load->view("section/footer");}function beefSecurity(){ redirect("auth/logout"); }function pf($i){ echo "<pre>"; print_r($i); echo "</pre>"; }function notify($message){}

function this(){ return $CI = & get_instance(); }

function rxx($i){ return ucwords(strtolower(str_replace("_","",$i))); }

function process($sql){ $db = this()->db; $db->query($sql); }  

function ajaxload($url,$mod)
{
    echo "
    <script>
    $(document).ready(function(){
        $.get('".base_url($url)."', function(response){
            // $('head').append('<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">');
            $('#".$mod."').html(response)
        })
    });
    </script>
    ";
}

function subjectList($subs)
{
  foreach($subs as $s){ $t[$s->code] = $s->name; }
  
  return $t;
}


function openDataTables(){
    echo '<link rel="stylesheet" href="'.base_url('assets/css/jquery-ui.css').'">';
    echo '<link rel="stylesheet" href="'.base_url('assets/css/dataTables.jqueryui.min.css').'">';
}

function closeDataTables($disp){
    ?>
        <script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
        <script>
        var disp = "<?=$disp?>"
        $(document).ready(function() { $("#example").DataTable({ 
            pageLength:25,
            searching:disp == 0 ? false:true,
            paging:disp == 0 ? false:true,
            ordering:disp == 0 ? false:true,
        }); } ); 
        function dltr(url,id){ swaldel(url,id); }
        </script>
    <?php
}

function dataTableModals()
{
    ?>
   <!-- editing modal  -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>


   <!-- deleting modal  -->
<div class="modal fade" id="exampleModalDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-row">
        <button  id="yes" class="btn btn-primary col-md-5" data-dismiss="modal">Ok</button>
        <button  class="btn btn-success col-md-5 pull-right" data-dismiss="modal">Cancel</button>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>




<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var title = button.data('title') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('.modal-title').text('Edit ' + title)
    $.get("<?=base_url('crud/ajaxEdit/')?>" + title.toLowerCase() + '/' + id, function(dat){
        modal.find('.modal-body').html(dat)
    })
})

$('#exampleModalDel').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var table = button.data('title') // Extract info from data-* attributes
  var modal = $(this)
    modal.find('#yes').click(function(){
        $("#row" + id ).hide();
        $.post("<?=base_url('crud/ajaxDel/')?>" + table.toLowerCase() + '/' + id);
    });
  });
</script>

    <?php
}

function examDashboard(){
  echo '<a class="pull-right btn-sm btn btn-secondary" href="'.base_url('exams').'" role="button"><i class="fa fa-home"></i> EXAMS DASHBOARD</a>';
}

function ucase($i){ return strtoupper($i); }

function activeModules($active, $modules, $base='config')
{
  ?>
    <div class="row">
    <?php foreach($modules as $mod){ ?>
        <a style="text-decoration:none" class="pb-2 px-2  <?=$mod == $active ? 'border-bottom text-primary' : 'text-info' ?>"  href="<?=base_url($base.'/'.strtolower($mod)) ?>"><?=ucwords($mod)?></a>
    <?php } ?>
    </div>
  <?php 
}









function savefiles($t, $r){
    if(!empty($_FILES)){
        foreach($_FILES as $i=>$j){
            $p = save_pic($t,$i);
            if($p !== ""){
                $sql = "update $t set `$i` = '$p' where id = $r";
                process($sql); 
            }
        }
    }
}



function save_pic($table, $fldname, $type=1){

    $uploads = 'assets/img';
    $trailer = "";
    $files=$_FILES;

    $time = microtime(1)*10000;
    $name =$files[$fldname]['name'];
    if($name !== ''){
    
    $esx = explode(".",$name);
    $esx = end($esx);
    $extension = strtolower($esx);		
    $allowed = $type == 1 ? ['jpg','jpeg','png',] : ['jpg','jpeg','png','txt','doc','docx','ppt','pptx','xls','xlsx','accdb','mdb','pdf'];
    if(in_array($extension,$allowed)){		
    $location =$uploads."/".$table."/";
    if (!mkdir($location, 0777)) {$dh = opendir($location);closedir($dh);}		
    if(move_uploaded_file($files[$fldname]['tmp_name'],$location.$name))
    {   $trailer = $time.".".$extension;rename($location.$name, $location.$trailer);	}
    else{echo("Upload Fail! : ".$location.$name);}
    }else{ echo("Incorrect file format :.".$extension); }}
    return $trailer;
    
}


function image($url,$tbl=null){
    $tbl = is_null($tbl)? null : $tbl."/";
    echo base_url("assets/img/$tbl".$url);
}










function linkTo($disp,$url){
  echo '<a class="btn btn-success btn-sm" href="'.base_url($url).'" role="button">'.$disp.'</a>';
}