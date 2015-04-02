<script type="text/javascript">
$(document).ready(function(){
$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtNro',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_nro = $(this).val();
	search_actividad = $('#txtActividad').val();
	search_empresa = $('#txtEmpresa').val();
	search_obra = $('#txtObra').val();

	if(search_nro==''){
		search_nro = null;
	}
	if(search_actividad==''){
		search_actividad = null;
	}
	if(search_empresa==''){
		search_empresa = null;
	}
	if(search_obra==''){
		search_obra = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('actas/find_actas/1/'+null+'/'+null+'/'+search_nro+'/'+search_actividad+'/'+search_empresa+'/'+search_obra),function(){
	});
});

$body.on('keyup','#txtActividad',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_actividad = $(this).val();
	search_nro = $('#txtNro').val();
	search_empresa = $('#txtEmpresa').val();
	search_obra = $('#txtObra').val();

	if(search_nro==''){
		search_nro = null;
	}
	if(search_actividad==''){
		search_actividad = null;
	}
	if(search_empresa==''){
		search_empresa = null;
	}
	if(search_obra==''){
		search_obra = null;
	}
	
	$('#conteiner_all_rows').load(env_webroot_script + escape('actas/find_actas/1/'+null+'/'+null+'/'+search_nro+'/'+search_actividad+'/'+search_empresa+'/'+search_obra),function(){
	});
});

$body.on('keyup','#txtEmpresa',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_empresa = $(this).val();
	search_nro = $('#txtNro').val();
	search_actividad = $('#txtActividad').val();
	search_obra = $('#txtObra').val();

	if(search_nro==''){
		search_nro = null;
	}
	if(search_actividad==''){
		search_actividad = null;
	}
	if(search_empresa==''){
		search_empresa = null;
	}
	if(search_obra==''){
		search_obra = null;
	}
	
	$('#conteiner_all_rows').load(env_webroot_script + escape('actas/find_actas/1/'+null+'/'+null+'/'+search_nro+'/'+search_actividad+'/'+search_empresa+'/'+search_obra),function(){
	});
});

$body.on('keyup','#txtObra',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_obra= $(this).val();
	search_nro = $('#txtNro').val();
	search_actividad = $('#txtActividad').val();
	search_empresa = $('#txtEmpresa').val();

	if(search_nro==''){
		search_nro = null;
	}
	if(search_actividad==''){
		search_actividad = null;
	}
	if(search_empresa==''){
		search_empresa = null;
	}
	if(search_obra==''){
		search_obra = null;
	}
	
	$('#conteiner_all_rows').load(env_webroot_script + escape('actas/find_actas/1/'+null+'/'+null+'/'+search_nro+'/'+search_actividad+'/'+search_empresa+'/'+search_obra),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_nro = $('#txtNro').val();
	search_actividad = $('#txtActividad').val();
	search_empresa = $('#txtEmpresa').val();
	search_obra = $('#txtObra').val();
	
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

	if(search_nro==''){
		search_nro = null;
	}
	if(search_actividad==''){
		search_actividad = null;
	}
	if(search_empresa==''){
		search_empresa = null;
	}
	if(search_obra==''){
		search_obra = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('actas/find_actas/'+page+'/'+order_by_select+'/'+order_by_or+'/'+search_nro+'/'+search_actividad+'/'+search_empresa+'/'+search_obra),function(){
		});
}
loadData(1);  /* For first time page load default results */
$('#container_page .pagination li.active').live('click',function(){
    var page = $(this).attr('p');
    loadData(page);
    
}); 

});
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Listado de Actas</h2>
	</div>
</div>
<hr />
<div id="acta">
	<div id="add_edit_acta_container">
	</div>
	
	<div class="btn-toolbar">
	    <a class="btn btn-primary btn-nuevo-acta" href="<?= ENV_WEBROOT_FULL_URL; ?>actas/nuevo_informe"><i class="icon-plus"></i> <?php echo __('Nueva Acta'); ?></a>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	
	<div class="row">
		<div class="span3 col-md-2 col-sm-6 col-xs-6">
			<label><?php echo __('Buscar por');?>:</label>
		</div>
		<div class="span3 col-md-2 col-sm-6 col-xs-6">
			<label><?php echo __('Nro de Acta');?> <input type="text"
				name="txtNro" id="txtNro" class="form-control">
			</label>
		</div>
		<div class="span3 col-md-2 col-sm-6 col-xs-6">
			<label><?php echo __('Actividad');?> <input type="text"
				name="txtActividad" id="txtActividad" class="form-control">
			</label>
		</div>
		<div class="span3 col-md-2 col-sm-6 col-xs-6">
			<label><?php echo __('Empresa');?> <input type="text"
				name="txtEmpresa" id="txtEmpresa" class="form-control">
			</label>
		</div>
		<div class="span3 col-md-2 col-sm-6 col-xs-6">
			<label><?php echo __('Obra');?> <input type="text" name="txtObra"
				id="txtObra" class="form-control">
			</label>
		</div>
	</div>
	<div class="well">
	    <?php 
		if(empty($list_acta)){ 
			echo __('No hay datos de Actas');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('Acta/acta_row');
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

	<div class="modal fade" id="myModalDeleteActa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" acta_id=''>
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
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el acta?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-acta-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>