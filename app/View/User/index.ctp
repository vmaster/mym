<script type="text/javascript">
$body = $('body');
var order_by_select;
var order_by_or;

$body.on('keyup','#txtBuscarUsername',function(e){
	e.stopPropagation();
	//$('#check_all').prop('checked', false);
	search_username = $(this).val();

	if(search_username==''){
		search_username = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('users/find_users/1/'+null+'/'+null+'/'+search_username),function(){
	});
});

function loadData(page){
    //loading_show();  
    search_username = $('#txtBuscarUsername').val();
	
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

	if(search_username==''){
		search_username = null;
	}

	$('#conteiner_all_rows').load(env_webroot_script + escape('users/find_users/'+page+'/'+order_by_select+'/'+order_by_or+'/'+search_username),function(){
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
		<h2>Registro de Usuarios</h2>
	</div>
</div>
<hr />
<div id="user">
	<div id="add_edit_user_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-user"><i class="icon-plus"></i> <?php echo __('Nuevo Usuario'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<div class="row">
		<div class="span3 col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
		<div class="span3 col-md-3 col-sm-6 col-xs-6">
			<label><?php echo __('Nombre de usuario');?> <input type = "text" name ="txtBuscarUsername" id="txtBuscarUsername" class="form-control"></label>
		</div>
	</div>
	<div class="well">
		<div id = "conteiner_all_rows">
		    <?php 
			if(empty($list_user)){ 
				echo __('No hay datos de Usuarios');
			}else{ ?>  
		      <?php 
		      	echo $this->element('User/user_row');
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

	<div class="modal fade" id="myModalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" user_id=''>
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
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el Usuario?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-user-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>