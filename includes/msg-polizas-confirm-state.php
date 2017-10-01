<div class="modal fade in" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick = "$('.modal').hide()">x</button>
            <h4 class="modal-title text-info small" id="myModalLabel">AG WARRANTS</h4>
            </div>
            <div class="modal-body">
                <h4>¿Desea <?php echo $poli_state ?> la póliza?</h4>
                <?php echo $msg ?>
            </div>
            <div class="modal-footer">
                
                    <button id="ajax-polizas-state-confirm" class="btn btn-primary">SI</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick = "window.location.reload(true);">NO</button>
                
            </div>
    </div>
  </div>
</div>

