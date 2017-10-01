$(document).ready(function () {

	//Loads the correct sidebar on window load,
	//collapses the sidebar on window resize.
	// Sets the min-height of #page-wrapper to window size
	$(function() {
		$(window).bind("load resize", function() {
			topOffset = 50;
			width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
			if (width < 768) {
				$('div.navbar-collapse').addClass('collapse');
				topOffset = 100; // 2-row-menu
			} else {
				$('div.navbar-collapse').removeClass('collapse');
			}

			height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
			height = height - topOffset;
			if (height < 1) height = 1;
			if (height > topOffset) {
				$("#page-wrapper").css("min-height", (height) + "px");
			}
		});
	});


    /** anula el backspace tecla atrás navegador */
    $(document).on("keydown", function (e) {
        if (e.which === 8 && !$(e.target).is("input, textarea")) {
            e.preventDefault();
        }
    });
    
    
                
    $('.fecha_filtro').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        startView:1
    }); 
    
    $('.fecha_form').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    }); 
    
    $('#side-menu').metisMenu({
        toggle: false
    });
    
    $('.selectpicker').selectpicker();
    
    
    
    $('#combo_provincia').change(function(){
        
        var prov_id = $('#combo_provincia').val();
        
        $('#combo_localidad').load("process/combo_localidad.php?id="+prov_id);
            
    });
    
    


/** DATATABLES */
    
    // Disable search and ordering by default
    $.extend( $.fn.dataTable.defaults, {
        searching: true,
        ordering:  true,
        paging: true,
    } );
    
    
/** Facturación */
    
    $('#FacturacionResumen').DataTable({
    
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ]
    
    });
    
    $('#FacturacionPivotDepositante').DataTable({
    
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ]
    
    });
    
    $('#facturacion_detalle').DataTable({
        
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],    
        "paging": false,
        "scrollX": true,
        "scrollY": "500px",
        "autoWidth": false
        
    });

/** Listado Facturas */

    $('#facturas-listado').DataTable({
        
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],        
        "scrollX": true,
        "scrollY": "500px",
        "autoWidth": false
        
    });
    

/** Reporte Titulos */    
   
    $('#reporte-titulos-dataTable').DataTable({

        searching: true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        
        "scrollX": true,
        "scrollY": "500px",
        "autoWidth": false
        
    });

/** Reporte Inspecciones */
 
    $('#reporte-inspeccionesResumen-dataTable').DataTable({      
        paging: false,
        searching: false,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ]
    });  
    
    $('#reporte-inspecciones-dataTable').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "paging": true,
        "scrollX": true,
        "autoWidth": false
        
    });

    $('#reporte-secretaria1').DataTable({      

        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "paging": true,
        "scrollX": true,
        "autoWidth": false
    });
    $('#reporte-secretaria2').DataTable({      

        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "scrollX": true,
        "autoWidth": false
    });
    $('#reporte-secretaria3').DataTable({      

        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "scrollX": true,
        "autoWidth": false
    });
    $('#reporte-secretaria4').DataTable({      
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "scrollX": true,
        "autoWidth": false
    });
    $('#reporte-ddjjseguro-dataTable').DataTable({      
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "scrollX": true,
        "autoWidth": false
    });
    

/** Reporte Almacenes */

    $('#reporte-almacenes-dataTable').DataTable({
        
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ]
        
    });
    

/** Actas de Inspección */    
   
    $('#actas-listado-datatables').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'   
        ],
        "scrollX": true,
        "autoWidth": false
        
    });


    $('#plan-edit-btn-benef').click(function(){
        $('#sel-benef').css("display", "inline");
    });
    
    
    $('#combo_raso_exis').change(function(){
        
        $('#input_raso_new').val("")
        $('#input_raso_new').prop("disabled", true);
        $('#combo_raso_cancelar').css("display", "inline");
            
    });
    
     $('#combo_raso_cancelar').click(function(){
        
        $('#input_raso_new').prop("disabled", false);
        $('#combo_raso_exis').val("");
        $('#combo_raso_cancelar').css("display", "none");
            
    });
    
   

/** formulario Emision de titulos */          
    
   $('#emision-precio').focusout(function(){
        
        var cant = $('#emision-cant').val();
        var precio = $('#emision-precio').val();

        $('#emision-total').val(cant * precio).text();
        
    });   
    
    $('#endoso-fecha').val($('emision-fecha').val());

   

/** plantas - checkbox activar/desactivar  - AJAX  *************************************** ACA *********** */        

    $('.plan-check-state').click(function(){
 
        var plan = $(this).attr('name');
        
        $('#basicModal').show();
        
        $('#ajax-planta-state-confirm').click(function(){
        
            $.ajax({
                url:"process/plantas-ajax-cambiar-estado.php",
                type:"POST", 
                data:"planta="+plan,
               
                success:function(html){
                    if(html == "true"){
                        window.location.reload(true);
                    }
                }
            });    
            
        });                
        
    });


/** polizas - checkbox activar/desactivar  - AJAX  *************************************** ACA *********** */        

    $('.poli-check-state').click(function(){
 
        var poli = $(this).attr('name');
        
        $('#basicModal').show();
        
        $('#ajax-polizas-state-confirm').click(function(){
        
            $.ajax({
                url:"process/polizas-ajax-cambiar-estado.php",
                type:"POST", 
                data:"poli="+poli,
               
                success:function(html){
                    if(html == "true"){
                        window.location.reload(true);
                    }
                }
            });    
            
        });                
        
    });


    $('.btn-fact-detalles').click(function(){

        // alert($(this).attr("name"));
       var depo_id = $(this).attr("name");
       var depo_raso = $(this).attr("data-value");
       var desde = $('#desde').val();
       var hasta = $('#hasta').val();

       $('#f-depo_id').val(depo_id);
       $('#f-depo_raso').val(depo_raso);
       $('#f-desde').val(desde);
       $('#f-hasta').val(hasta);
       
       
       $('#fact-form-hidden-button').click();
       
 
    });
    
    
    /**APLICAR TARIFA MINIMA checkbox */
    $('#chk-tari-min').change(function(){

        if(this.checked){
            
            var em = parseFloat($('#total_emision').val());
            var seg = parseFloat($('#total_seguro').val());
            var dto_em = parseFloat($('#dto_emision').val());
            var dto_seg = parseFloat($('#dto_seguro').val());
            var new_em = (em+dto_em).toFixed(2);
            var new_seg = (seg+dto_seg).toFixed(2);
            var new_dto_em = 0;
            var new_dto_seg = 0;
            
            $('#total_emision').val($('#total_emision_bk').val());
            $('#total_seguro').val($('#total_seguro_bk').val());
            
            $('#dto_emision_bk').val($('#dto_emision').val());
            $('#dto_emision').val(0);
            
            $('#dto_seguro_bk').val($('#dto_seguro').val());
            $('#dto_seguro').val(0);
            
            $('#dto_porcent_bk').val($('#dto_porcent').val());
            $('#dto_porcent').val(0);
            

        }else{
            
            var em = parseFloat($('#total_emision').val());
            var seg = parseFloat($('#total_seguro').val());
            var dto_em = parseFloat($('#dto_emision_bk').val()); //Valor guardado en input hidden
            var dto_seg = parseFloat($('#dto_seguro_bk').val()); //Valor guardado en input hidden
            
            var new_em = (em-dto_em).toFixed(2);
            var new_seg = (seg-dto_seg).toFixed(2);
            var new_dto_em = dto_em;
            var new_dto_seg = dto_seg;
            
            $('#total_emision').val(new_em);
            $('#total_seguro').val(new_seg);
            $('#dto_emision').val(new_dto_em);
            $('#dto_seguro').val(new_dto_seg);
            
            $('#dto_porcent').val($('#dto_porcent_bk').val());
            $('#dto_porcent_bk').val(0);
            
        }  
        
    });
    
    
    $('#btn-dto-porcent').click(function(){
        
        var dto = $('#dto_porcent').val();
        
        if(dto == ""){
            alert("Ingrese un descuento válido");
        }else{
            
            var dto = parseFloat($('#dto_porcent').val());
            
            if(dto == 0){
                $('#total_emision').val($('#total_emision_bk').val());
                $('#total_seguro').val($('#total_seguro_bk').val());
                $('#dto_emision').val(0);
                $('#dto_seguro').val(0);
                
            }else{
                
                
                var em = parseFloat($('#total_emision_bk').val());
                var seg = parseFloat($('#total_seguro_bk').val());
                var subtotal = (em+seg).toFixed(2);
                
                var dto_total = (subtotal*dto/100).toFixed(2);
                
                var dto_em = (dto_total*(em/subtotal)).toFixed(2); //
                var dto_seg = (dto_total*(seg/subtotal)).toFixed(2); //
                
                var new_em = (em-dto_em).toFixed(2);
                var new_seg = (seg-dto_seg).toFixed(2);
                
                $('#total_emision').val(new_em);
                $('#total_seguro').val(new_seg);
                
                $('#dto_emision').val(dto_em);
                $('#dto_seguro').val(dto_seg);
                
            }
            
            
            
        }
        
        
        
    });
    
    


});