<script type="text/javascript">
$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtBuscarNombre',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_nombre = $(this).val();
	search_tipo_persona = $('#cboTipoPersona').val();
	search_nro_documento = $('#txtNroDocumento').val();

	if(search_nombre==''){
		search_nombre = null;
	}
	if(search_nro_documento==''){
		search_nro_documento = null;
	}
	if(typeof(search_tipo_persona) === "undefined"){
		search_tipo_persona = 0;
	}

	$('#conteiner_all_rows').load(escape('personas/find_personas/1/'+null+'/'+null+'/'+search_tipo_persona+'/'+search_nro_documento+'/'+search_nombre),function(){
	});
});

$body.on('change','#cboTipoPersona',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_tipo_persona = $(this).val();
	search_nombre = $('#txtBuscarNombre').val();
	search_nro_documento = $('#txtNroDocumento').val();

	if(search_nombre==''){
		search_nombre = null;
	}
	if(search_nro_documento==''){
		search_nro_documento = null;
	}

	if(typeof(search_tipo_persona) === "undefined"){
		search_tipo_persona = 0;
	}
	
	$('#conteiner_all_rows').load(escape('personas/find_personas/1/'+null+'/'+null+'/'+search_tipo_persona+'/'+search_nro_documento+'/'+search_nombre),function(){
	});
});

$body.on('keyup','#txtNroDocumento',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_nro_documento = $(this).val();
	search_nombre = $('#txtBuscarNombre').val();
	search_tipo_persona = $('#cboTipoPersona').val();

	if(search_nombre==''){
		search_nombre = null;
	}
	if(search_nro_documento==''){
		search_nro_documento = null;
	}
	
	if(typeof(search_tipo_persona) === "undefined"){
		search_tipo_persona = 0;
	} 
	
	$('#conteiner_all_rows').load(escape('personas/find_personas/1/'+null+'/'+null+'/'+search_tipo_persona+'/'+search_nro_documento+'/'+search_nombre),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_nombre = $('#txtBuscarNombre').val();
    search_tipo_persona = $('#cboTipoPersona').val();
	search_nro_documento = $('#txtNroDocumento').val();
	
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

	if(search_nombre==''){
		search_nombre = null;
	}
	if(search_nro_documento==''){
		search_nro_documento = null;
	}
	if(typeof(search_tipo_persona) === "undefined"){
		search_tipo_persona = 0;
	}         

	$('#conteiner_all_rows').load(escape('personas/find_personas/'+page+'/'+order_by_select+'/'+order_by_or+'/'+search_tipo_persona+'/'+search_nro_documento+'/'+search_nombre),function(){
		});
}
loadData(1);  /* For first time page load default results */
$('#container_page .pagination li.active').live('click',function(){
    var page = $(this).attr('p');
    loadData(page);
    
}); 
</script>
<div id="persona">
	<div id="holitas">
	</div>
	<div id="add_edit_persona_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-persona"><i class="icon-plus"></i> <?php echo __('Nuevo Persona'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<div class="row">
		<div class="span3 col-md-2 col-sm-6 col-xs-6" style="margin-left:30px;"><?php echo __('Buscar por');?>:</div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6" style="margin-left:-107px;">
		<label><?php echo __('Nombre/R. Social');?> <input type = "text" name ="txtBuscarNombre" id="txtBuscarNombre" class="form-control"></label>
		</div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6">
		<label><?php echo __('Tipo persona');?> 
			<select name="cboTipoPersona" id="cboTipoPersona" class="form-control"><!-- Valores según la base de datos -->
			<option value=0>TODOS</option>
			<option value=1>VARIOS</option>
			<option value=2>NATURAL</option>
			<option value=3>JURIDICA</option>
			<?php /*foreach($obj_tipo_personas as $k => $v){ ?>
				<option value="<?php echo $v['TipoPersona']['id']; ?>"><?php echo $v['TipoPersona']['descripcion']; ?></option>
			<?php }	*/?>
			
			</select>
		</label>
		</div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6">
		<label><?php echo __('Nro. Documento');?> <input type = "text" name="txtNroDocumento" id="txtNroDocumento" class="form-control"></label>
		</div>
	</div>
	<div class="well">
	    <?php 
		if(empty($list_persona)){ 
			echo __('No hay datos de personas');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <?php 
	      	echo $this->element('Persona/persona_row');
	 	  ?>
	      </div>
	    <?php }?>
	</div>
	<div class="pagination">
	    <ul>
	        <li><a href="#">Prev</a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li><a href="#">Next</a></li>
	    </ul>
	</div>

	<div class="modal fade" id="myModalDeletePersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h3 id="myModalLabel">Delete Confirmation</h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>Are you sure you want
						to delete the user?
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
					<button class="btn btn-danger" data-dismiss="modal">Delete</button>
				</div>
			</div>
		</div>
	</div>
	
</div>