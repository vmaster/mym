$(document).ready(function(){
	
	UnidadesNegocio = this;
	$body = $('body');
	
	unidades_negocio = {
		openAddEditUnidadesNegocio: function(unidades_negocio_id){
			if(unidades_negocio_id == undefined || !unidades_negocio_id) {
				unidades_negocio_id ='';
			}
			$('div#unidades_negocio #add_edit_unidades_negocio_container').unbind();
			$('div#unidades_negocio #add_edit_unidades_negocio_container').load(env_webroot_script + 'unidades_negocios/add_edit_uunn/'+unidades_negocio_id,function(){
			});
		},
		
		deleteUnidadesNegocio: function(unidades_negocio_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'unidades_negocios/delete_unidades_negocio',
				data:{
					'unidades_negocio_id': unidades_negocio_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.unidades_negocio_row_container[unidades_negocio_id='+unidades_negocio_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear UUNN */
	$body.off('click','div#unidades_negocio .btn-nuevo-unidades-negocio');
	$body.on('click', 'div#unidades_negocio .btn-nuevo-unidades-negocio' , function(){
		unidades_negocio_id = $(this).attr('unidades_negocio_id');
		unidades_negocio.openAddEditUnidadesNegocio(unidades_negocio_id);
	});
	
	/* Ocultar formulario Crear UUNN*/
	$body.on('click','div#div-crear-unidades-negocio .btn-cancelar-crear-unidades-negocio', function(){
		$('#add_edit_unidades_negocio').hide();
	});
	
	$body.off('click','.btn-crear-unidades-negocio-trigger');
	$body.on('click','.btn-crear-unidades-negocio-trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_unidades_negocio').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('unidades_negocios/find_uunns/1/'+null+'/'+null+'/'+''+'/'+''),function(){
				});
				alertify.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[UnidadesNegocio]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[UnidadesNegocio]['+key+']"]').change(function() {
						$('[name="data[UnidadesNegocio]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#unidades_negocio .edit-unidades-negocio-trigger');
	$body.on('click','div#unidades_negocio .edit-unidades-negocio-trigger', function(){
		unidades_negocio_id = $(this).parents('.unidades_negocio_row_container').attr('unidades_negocio_id');
		unidades_negocio.openAddEditUnidadesNegocio(unidades_negocio_id);
	});
	
	$body.off('click','div#unidades_negocio .open-model-delete-unidades-negocio');
	$body.on('click','div#unidades_negocio .open-model-delete-unidades-negocio', function(){
		unidades_negocio_id = $(this).parents('.unidades_negocio_row_container').attr('unidades_negocio_id');
		$('div#myModalDeleteUnidadesNegocio').attr('unidades_negocio_id', unidades_negocio_id);
	});
	
	$body.off('click','div#myModalDeleteUnidadesNegocio .eliminar-unidades-negocio-trigger');
	$body.on('click','div#myModalDeleteUnidadesNegocio .eliminar-unidades-negocio-trigger', function(){
		unidades_negocio_id = $('div#myModalDeleteUnidadesNegocio').attr('unidades_negocio_id');
		unidades_negocio.deleteUnidadesNegocio(unidades_negocio_id);
	});
	
});