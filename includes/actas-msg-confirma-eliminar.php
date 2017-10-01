<div class="modal fade in" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false" style="display: block;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick = "$('.modal').hide()">x</button>
            <h4 class="modal-title text-info small" id="myModalLabel">AG WARRANTS</h4>
            </div>
            <div class="modal-body">
                <h4>Atención:</h4>
                <h5>¿Desea eliminar el registro seleccionado?</h5>
            </div>
            <div class="modal-footer">

                <form role="form" action="actas.php" style="float: left;">
                    <input type="submit" class="btn btn-primary" value="Cancelar" />
                </form>

                <form role="form" method="POST" action="actas.php" style="float: rigt;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" name="submit-eliminar" class="btn btn-primary" value="Eliminar" />
                </form>
                
            </div>
        </div>
    </div>
</div>

