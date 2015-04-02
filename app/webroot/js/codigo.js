$(document).ready(function(){
	
	Codigo = this;
	$body = $('body');
	
	codigo = {
		openAddEditCodigo: function(codigo_id){
			if(codigo_id == undefined || !codigo_id) {
				codigo_id ='';
			}
			
			$('div#codigo #add_edit_codigo_container').unbind();
			$('div#codigo #add_edit_codigo_container').load(env_webroot_script + 'codigos/add_edit_codigo/'+codigo_id,function(){
				
				/*Global.setPlaces('EducationPlace','education');
				$(".icon-search-education-place").click(function (e) {
					$('#EducationPlaceEdit').val('');
					$('#EducationPlaceId').val('');				
					$('.row-education-place').toggle();
					$('#EducationPlaceEdit').focus();
				});
				
				var targetOffset =$('#add_edit_persona_container').offset().top-130; 
				$('html,body').animate({scrollTop: targetOffset}, 700);*/
			});
		},
		
		deleteCodigo: function(codigo_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'codigos/delete_codigo',
				data:{
					'codigo_id': codigo_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.codigo_row_container[codigo_id='+codigo_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#codigo .btn-nuevo-codigo');
	$body.on('click', 'div#codigo .btn-nuevo-codigo' , function(){
		codigo_id = $(this).attr('codigo_id');
		codigo.openAddEditCodigo(codigo_id);
	});
	
	/* Ocultar formulario Crear vehículo*/
	$body.on('click','div#div-crear-codigo .btn-cancelar-crear-codigo', function(){
		$('#add_edit_codigo').hide();
	});
	
	$body.off('click','.btn-crear-codigo-trigger');
	$body.on('click','.btn-crear-codigo-trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_codigo').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('codigos/find_codigos/1/'+null+'/'+null+'/'+''+'/'+''),function(){
				});
				alertify.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Codigo]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Codigo]['+key+']"]').change(function() {
						$('[name="data[Codigo]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#codigo .edit-codigo-trigger');
	$body.on('click','div#codigo .edit-codigo-trigger', function(){
		codigo_id = $(this).parents('.codigo_row_container').attr('codigo_id');
		codigo.openAddEditCodigo(codigo_id);
	});
	
	$body.off('click','div#codigo .open-model-delete-codigo');
	$body.on('click','div#codigo .open-model-delete-codigo', function(){
		codigo_id = $(this).parents('.codigo_row_container').attr('codigo_id');
		$('div#myModalDeleteCodigo').attr('codigo_id', codigo_id);
	});
	
	$body.off('click','div#myModalDeleteCodigo .eliminar-codigo-trigger');
	$body.on('click','div#myModalDeleteCodigo .eliminar-codigo-trigger', function(){
		codigo_id = $('div#myModalDeleteCodigo').attr('codigo_id');
		codigo.deleteCodigo(codigo_id);
	});
	
});