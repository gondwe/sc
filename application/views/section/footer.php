
</body>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script>
/* prepare the system for printing a thing */
$(".printer").click(function(){
    
    let div = this.dataset.div;
    
    let url = this.dataset.url == "" ? null : this.dataset.url + "/";
    
    let view = this.dataset.view;
    
    if(div == ""){
        
        window.location = "<?=base_url('systems/customPrinter/')?>" + url + view;

    }else{
        
        let table = $("#" + div )[0].outerHTML;

        $.post("<?=base_url('systems/')?>" + url , { "data":table}).then(function(){

            window.location = "<?=base_url('systems/out/')?>" + view;

        });
    }
});

/* display modals for datatable */
$('#addModal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget) // Button that triggered the modal
  
  var table = button.data('table') // Extract info from data-* attributes
  
  var modal = $(this)
  
    $.get("<?=base_url('crud/ajaxNew/')?>" + table.toLowerCase(), function(dat){
  
        modal.find('.modal-body').html(dat);
  
    });
    
});
</script>

<script src="<?=base_url("assets/js/popper.min.js")?>" ></script>
<script src="<?=base_url("assets/js/bootstrap.min.js")?>" ></script>
<script src='<?=base_url('assets/js/sweetalert.min.js')?>'></script>

</html>

<?php 

?>
