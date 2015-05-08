$(document).ready(function(){
	
	Empresa = this;
	$body = $('body');
	
	empresa = {
		openAddEditEmpresa: function(empresa_id){
			if(empresa_id == undefined || !empresa_id) {
				empresa_id ='';
			}
			
			$('div#empresa #add_edit_empresa_container').unbind();
			$('div#empresa #add_edit_empresa_container').load(env_webroot_script + 'empresas/add_edit_empresa/'+empresa_id,function(){

			});
		},
		
		deleteEmpresa: function(empresa_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'empresas/delete_empresa',
				data:{
					'empresa_id': empresa_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.empresa_row_container[empresa_id='+empresa_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveEmpresaMantenimiento: function(){
			$form = $('.btn_crear_empresa_trigger').parents('form').eq(0);
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#add_edit_empresa').hide();
					$('#conteiner_all_rows').load(env_webroot_script + escape('empresas/find_empresas/1/'+null+'/'+null+'/'+''+'/'+''),function(){
						$('#table_content_empresas').DataTable();
					});
					alertify.success(data.msg);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Empresa]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Empresa]['+key+']"]').change(function() {
							$('[name="data[Empresa]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		},
		
		saveEmpresaModal: function(){
			$form = $('form#form_create_empresa').eq(0);
			$.ajax({
				url: env_webroot_script + 'empresas/add_empresa',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddEmpresa').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_empresa = $('#txt-nombre-empresa').val();
					$('#txt-nombre-empresa').val('');
					new_option = "<option value='" + data.Empresa_id + "'>"+txt_empresa+"</option>";
					$('.cbo-empresas-select2 option:last').after(new_option);
					$(".cbo-empresas-select2").select2("val", [data.Empresa_id ,txt_empresa]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Empresa]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Empresa]['+key+']"]').change(function() {
							$('[name="data[Empresa]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear Empresa */
	$body.off('click','div#empresa .btn-nuevo-empresa');
	$body.on('click', 'div#empresa .btn-nuevo-empresa' , function(){
		empresa_id = $(this).attr('empresa_id');
		empresa.openAddEditEmpresa(empresa_id);
	});
	
	/* Ocultar formulario Crear Empresa*/
	$body.on('click','div#div-crear-empresa .btn-cancelar-crear-empresa', function(){
		$('#add_edit_empresa').hide();
	});
	
	$body.off('click','.btn_crear_empresa_trigger');
	$body.on('click','.btn_crear_empresa_trigger',function(){
		empresa.saveEmpresaMantenimiento();
	});
	
	$body.off('keypress','div#div-crear-empresa #txtEmpresaMant');
	$body.on('keypress','div#div-crear-empresa #txtEmpresaMant',function(e){
		if(e.which === 13) {
			empresa.saveEmpresaMantenimiento();
			return false;
		}
	});

	$body.off('click','div#empresa .edit-empresa-trigger');
	$body.on('click','div#empresa .edit-empresa-trigger', function(){
		empresa_id = $(this).parents('.empresa_row_container').attr('empresa_id');
		empresa.openAddEditEmpresa(empresa_id);
	});
	
	$body.off('click','div#empresa .open-model-delete-empresa');
	$body.on('click','div#empresa .open-model-delete-empresa', function(){
		empresa_id = $(this).parents('.empresa_row_container').attr('empresa_id');
		$('div#myModalDeleteEmpresa').attr('empresa_id', empresa_id);
	});
	
	$body.off('click','div#myModalDeleteEmpresa .eliminar-empresa-trigger');
	$body.on('click','div#myModalDeleteEmpresa .eliminar-empresa-trigger', function(){
		empresa_id = $('div#myModalDeleteEmpresa').attr('empresa_id');
		empresa.deleteEmpresa(empresa_id);
	});
	
	/* CREAR EMPRESA DESDE UN MODAL (EN EL FORMULARIO CREAR INFORME) */
	$('#txt-nombre-empresa').keypress(function(e) {
		if(e.which == 13) {
			empresa.saveEmpresaModal();
			return false;
		}
	});
	
	$body.off('click','#btn-open-create-empresa');
	$body.on('click','#btn-open-create-empresa',function(){
		$('#txt-nombre-empresa').val('');
	});
	
	
	$body.off('click','.save-empresa-modal-trigger');
	$body.on('click','.save-empresa-modal-trigger',function(){
		empresa.saveEmpresaModal();
	});
	
	

});