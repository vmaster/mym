<script>
$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtBuscarDescripcion',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_descripcion = $(this).val();


	if(search_descripcion==''){
		search_descripcion = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('actividades/find_actividades/'+null+'/'+null+'/'+search_descripcion),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_descripcion = $('#txtBuscarDescripcion').val();
	
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

	if(search_descripcion==''){
		search_descripcion = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('actividades/find_actividades/'+order_by_select+'/'+order_by_or+'/'+search_descripcion),function(){
		});
}
loadData(1);  /* For first time page load default results */
$('#container_page .pagination li.active').live('click',function(){
    var page = $(this).attr('p');
    loadData(page);
    
}); 
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Registro de Actividades</h2>
	</div>
</div>
<hr />
<div id="actividad">
	<div id="add_edit_actividad_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-actividad"><i class="icon-plus"></i> <?php echo __('Nueva Actividad'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<div class="row">
		<div class="col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
		<div class="col-md-3 col-sm-6 col-xs-6">
		<label><?php echo __('Actividad');?> <input type = "text" name ="txtBuscarDescripcion" id="txtBuscarDescripcion" class="form-control"></label>
		</div>
	</div>
	<div class="well">
	    <?php 
		if(empty($list_actividades)){ 
			echo __('No hay datos de actividades');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('Actividade/actividad_row');
	 	  ?>
	      </div>
	    <?php }?>
	</div>
	
	<div class="modal fade" id="myModalDeleteActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" actividad_id=''>
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
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar la actividad?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-actividad-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>