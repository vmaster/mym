<script type="text/javascript">
$(document).ready(function(){

	$('#table_content_tareas').DataTable({
	 	dom: 'T<"clear">lfrtip',
		tableTools: {
			"sSwfPath": env_webroot_script + "/lib/data.tables-1.10.6/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
	                "copy",
	                "csv",
	                "xls",
	                "pdf"
	                /*{
	                    "sExtends":    "collection",
	                    "aButtons":    [ "csv", "xls", "pdf" ]
	                }*/
	        ]
		}
	});
		
	$body = $('body');
	var order_by_select;
	var order_by_or;

	function loadData(page){
	    //loading_show();  
	    search_nombre = $('#txtBuscarNombre').val();
		
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

		$('#conteiner_all_rows').load(env_webroot_script + escape('tareas/find_tareas/'+page+'/'+order_by_select+'/'+order_by_or),function(){
			});
	}
	//loadData(1);  /* For first time page load default results */
	$('#container_page .pagination li.active').live('click',function(){
	    var page = $(this).attr('p');
	    loadData(page);
	    
	});
	
	$('.tooltip-mym').tooltip();

});
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Listado de Tareas</h2>
	</div>
</div>
<hr />
<div id="tarea">
	<div id="add_edit_tarea_container">
	</div>
	
	<div class="btn-toolbar">
		<?php if($this->Session->read('Auth.User.tipo_user_id') == 2){ ?> 
			<a class="btn btn-primary btn-nuevo-tarea" href="<?= ENV_WEBROOT_FULL_URL; ?>tareas/nueva_tarea"><i class="icon-plus"></i> <?php echo __('Nueva Tarea'); ?></a>
		<?php } ?>
	  <div class="btn-group">
	  </div>
	</div>
	<p>

	<p>
<div class="row">
	<div class="span3 col-md-3 col-sm-6 col-xs-6">	
		<label><?php echo __('Elija un empleado'); ?> </label>
	</div>	
</div>
<div class="row">
	<div class="span3 col-md-3 col-sm-6 col-xs-6" id="div-cbo-trabajadores">
				
				<select class='form-control' id="cboTrabajadores">
					<?php 
					if (isset($list_trabajadores_enosa)){
						foreach ($list_trabajadores_enosa as $list_all_personal):
						echo "<option value = ".$list_all_personal->getAttr('id').">".$list_all_personal->getAttr('apellido_nombre')."</option>";
						endforeach;
					}
					?>
				</select>
	</div>
	<div class="span3 col-md-3 col-sm-6 col-xs-6" id="div-cbo-trabajadores">
		<a class="btn btn-primary btn-consultar-tareas" ><i class="icon-plus"></i> <?php echo __('Consultar'); ?></a>
	</div>
</div>
	<p>&nbsp;</p>


	<br>
	<div class="well">
		<div id = "conteiner_all_rows">
	    <?php 
		if(empty($list_tarea)){ 
			echo __('No hay datos de Tareas');
		}else{ ?>  
	      <?php 
	      	echo $this->element('Tarea/tarea_row');
	 	  ?>
	    <?php }?>
	    </div>
	</div>

	<!-- <div class="pagination">
	    <ul>
	        <li><a href="#">Prev</a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li><a href="#">Next</a></li>
	    </ul>
	</div>
	 -->

	 <div class="modal fade" id="myModalViewTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tarea_id=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Actvidades')); ?></h3>
				</div>
				<div class="modal-body">
					
				</div>
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModalDeleteTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tarea_id=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel">Confirmar Eliminaci&oacute;n/h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar La Tarea?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-tarea-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModalActiveEditTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tarea_id='' estado=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel">Activaci&oacute;n / Desactivaci&oacute;n para editar Registro</h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>
						<?php echo utf8_encode(__('¿Estas seguro de modificar los cambios?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger activar-edit-tarea-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModalActiveDiaLibre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tarea_id='' dia_libre=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel">Activar / Desactivar d&iacute;a libre</h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>
						<?php echo utf8_encode(__('¿Estas seguro de modificar el registro?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger activar-dia-libre-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>