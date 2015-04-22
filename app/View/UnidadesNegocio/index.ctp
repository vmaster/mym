<script type="text/javascript">
$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtBuscarUuNn',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_uunn = $(this).val();

	if(search_uunn==''){
		search_uunn = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('unidades_negocios/find_uunns/1/'+null+'/'+null+'/'+search_uunn),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_nroplaca = $('#txtBuscarUuNn').val();
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

	$('#conteiner_all_rows').load(env_webroot_script + escape('unidades_negocios/find_uunns/'+page+'/'+order_by_select+'/'+order_by_or+'/'+search_nroplaca+'/'+search_nrosoat),function(){
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
		<h2>Listado de Unidades Negocios</h2>
	</div>
</div>
<hr />
<div id="unidades_negocio">
	<div id="add_edit_unidades_negocio_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-unidades-negocio"><i class="icon-plus"></i> <?php echo __('Nueva UUNN'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<div class="row">
		<div class="span3 col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6">
			<label><?php echo __('Unidad de Negocio');?> <input type = "text" name ="txtBuscarUuNn" id="txtBuscarUuNn" class="form-control"></label>
		</div>
	</div>
	<div class="well">
	    <?php 
		if(empty($list_unidades_negocio)){ 
			echo __('No hay datos de Unidades de Negocios');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('UnidadesNegocio/uunn_row');
	 	  ?>
	      </div>
	    <?php }?>
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

	<div class="modal fade" id="myModalDeleteUnidadesNegocio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" unidades_negocio_id=''>
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
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar La Unidad de Negocio?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-unidades-negocio-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>