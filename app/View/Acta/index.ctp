<script type="text/javascript">
$(document).ready(function(){

$('#table_content_actas').DataTable({
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
//loadData(1);  /* For first time page load default results */
$('#container_page .pagination li.active').live('click',function(){
    var page = $(this).attr('p');
    loadData(page);
    
}); 

});
</script>
<style>
div#spinner-send-report
{
   	display: none;
    width:168px;
    height: 300px;
    position: fixed;
    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -70px;
    margin-top: -17px;
    z-index:2;
    overflow: auto;
}    
</style>
<div class="row">
	<div class="col-md-12">
		<h2>Listado de Informes</h2>
	</div>
</div>
<hr />
<div id="acta">
	<div id="add_edit_acta_container">
	</div>
	
	<div class="btn-toolbar">
	    <a class="btn btn-primary btn-nuevo-acta" href="<?= ENV_WEBROOT_FULL_URL; ?>actas/nuevo_informe"><i class="icon-plus"></i> <?php echo __('Nuevo Informe'); ?></a>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<!-- 
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
	 -->
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
	
	<div class="modal fade" id="myModalSendReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" acta_id= ''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Enviar Informe por Email')); ?></h3>
				</div>
				<div id="spinner-send-report">
				    	<img src="<?= ENV_WEBROOT_FULL_URL; ?>img/ajax-loader.gif" alt="Loading..."/>
				    	<br>
				    	<label>Espere un momento...</label>
					</div>
				<div class="modal-body">
					<?php echo $this->Form->create('SendEmail',array('method'=>'post', 'id'=>'form_send_email','action'=> false));?>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Correo de destino:')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('email_destino', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'email-destino')); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Enviar copia:')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('email_copia', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'email-copia')); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Asunto:')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('asunto', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'txt-asunto')); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Mensaje:')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('mensaje', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txtInfDes5 form-control','id' =>'txt-mensaje')); ?>
								</div>
							</div>
					 <?php echo $this->Form->end(); ?>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger send-report-email-trigger"><?php echo __('Enviar'); ?></button>
				</div>
				
			</div>
		</div>
	</div>
</div>