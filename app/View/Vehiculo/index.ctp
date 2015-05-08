<script type="text/javascript">
$(document).ready(function(){

$('#table_content_vehiculos').DataTable();

$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtBuscarNroPlaca',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_nroplaca = $(this).val();
	search_nrosoat = $('#txtBuscarNroSoat').val();

	if(search_nroplaca==''){
		search_nroplaca = null;
	}

	if(search_nrosoat==''){
		search_nrosoat = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('vehiculos/find_vehiculos/1/'+null+'/'+null+'/'+search_nroplaca+'/'+search_nrosoat),function(){
	});
});

$body.on('keyup','#txtBuscarNroSoat',function(e){
	e.stopPropagation();
	search_nrosoat = $(this).val();
	search_nroplaca = $('#txtBuscarNroPlaca').val();

	if(search_nroplaca==''){
		search_nroplaca = null;
	}

	if(search_nrosoat==''){
		search_nrosoat = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('vehiculos/find_vehiculos/1/'+null+'/'+null+'/'+search_nroplaca+'/'+search_nrosoat),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_nroplaca = $('#txtBuscarNroPlaca').val();
    search_nrosoat = $('#txtBuscarNroSoat').val();
	
	if (typeof(order_by_select) === "undefined"){
		order_by_select = null;
	}else{
		order_by_select = order_by_select;
	}
	if (typeof(order_by_or) === "undefined"){
		order_by_or = null;
	}else{
		order_by_or = order_by_or;
	}

	if(search_nroplaca==''){
		search_nroplaca = null;
	}

	if(search_nrosoat==''){
		search_nrosoat = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('vehiculos/find_vehiculos/'+page+'/'+order_by_select+'/'+order_by_or+'/'+search_nroplaca+'/'+search_nrosoat),function(){
		});
}
//loadData(1);  /* For first time page load default results */
$('#container_page .pagination li.active').live('click',function(){
    var page = $(this).attr('p');
    loadData(page);
    
});

});
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Listado de Vehiculos</h2>
	</div>
</div>
<hr />
<div id="vehiculo">
	<div id="add_edit_vehiculo_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-vehiculo"><i class="icon-plus"></i> <?php echo __('Nuevo Veh&iacute;culo'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<!-- 
	<div class="row">
		<div class="span3 col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6">
			<label><?php echo __('Nro Placa');?> <input type = "text" name ="txtBuscarNroPlaca" id="txtBuscarNroPlaca" class="form-control"></label>
		</div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6">
			<label><?php echo __('Nro SOAT');?> <input type = "text" name ="txtBuscarNroSoat" id="txtBuscarNroSoat" class="form-control"></label>
		</div>
	</div>
	 -->
	<div class="well">
	    <?php 
		if(empty($list_vehiculo)){ 
			echo __('No hay datos de veh&iacute;culos');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('Vehiculo/vehiculo_row');
	 	  ?>
	      </div>
	    <?php }?>
	</div>

	<div class="modal fade" id="myModalDeleteVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" vehiculo_id=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Confirmar Eliminación')); ?></h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el Tipo de Vehículo?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-vehiculo-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>