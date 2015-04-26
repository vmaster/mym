$(document).ready(function(){
	Actividade = this;
	$body = $('body');
	actividad = {
		openAddEditActividad: function(actividad_id){
			if(actividad_id == undefined || !actividad_id) {
				actividad_id ='';
			}
			
			$('div#actividad #add_edit_actividad_container').unbind();
			$('div#actividad #add_edit_actividad_container').load(env_webroot_script+'actividades/add_edit_actividad/'+actividad_id,function(){
				
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
		
		deleteActividad: function(actividad_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script+'actividades/delete_actividad',
				data:{
					'actividad_id': actividad_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.actividad_row_container[actividad_id='+actividad_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveActividad: function(){
			$form = $('.btn_crear_actividad_trigger').parents('form').eq(0);
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#add_edit_actividad').hide();
					$('#conteiner_all_rows').load(env_webroot_script+ escape('actividades/find_actividades/'+null+'/'+null+'/'+''),function(){
					});
					alertify.success(data.msg);
				}else{
					$.each( data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Actividade]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Actividade]['+key+']"]').change(function() {
							$('[name="data[Actividade]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear Actividad */
	$body.off('click','div#actividad .btn-nuevo-actividad');
	$body.on('click', 'div#actividad .btn-nuevo-actividad' , function(){;
		actividad_id = $(this).attr('actividad_id');
		actividad.openAddEditActividad(actividad_id);
	});
	
	/* Ocultar formulario Crear Actividad*/
	$body.on('click','div#div-crear-actividad .btn-cancelar-crear-actividad', function(){
		$('#add_edit_actividad').hide();
	});
	
	$body.off('click','.btn_crear_actividad_trigger');
	$body.on('click','.btn_crear_actividad_trigger',function(){
		actividad.saveActividad();
	});
	
	$body.off('keypress','div#div-crear-actividad #txtDesActividad');
	$body.on('keypress','div#div-crear-actividad #txtDesActividad',function(e){
		if(e.which === 13) {
			actividad.saveActividad();
			return false;
		}
	});

	$body.off('click','div#actividad .edit-actividad-trigger');
	$body.on('click','div#actividad .edit-actividad-trigger', function(){
		actividad_id = $(this).parents('.actividad_row_container').attr('actividad_id');
		actividad.openAddEditActividad(actividad_id);
	});
	
	
	$body.off('click','div#actividad .open-model-delete-actividad');
	$body.on('click','div#actividad .open-model-delete-actividad', function(){
		actividad_id = $(this).parents('.actividad_row_container').attr('actividad_id');
		$('div#myModalDeleteActividad').attr('actividad_id', actividad_id);
	});
	
	$body.off('click','div#myModalDeleteActividad .eliminar-actividad-trigger');
	$body.on('click','div#myModalDeleteActividad .eliminar-actividad-trigger', function(){
		actividad_id = $('div#myModalDeleteActividad').attr('actividad_id');
		actividad.deleteActividad(actividad_id);
	});
	
	/* Agregar una fila a la grilla de lista de personas */
	function afterCrearPersona(persona_id){
		$.get('get_persona_row/'+persona_id,function(data){
			persona_row_element = $('.persona_row_container[persona_id='+persona_id+']');
			if(persona_row_element.length > 0){//Update the row
				persona_row_element.replaceWith(data);
			}else{//add new row
				$('#table_personas .conteiner_all_rows').append(data);
			}
		});
	}

	
});