$(document).ready(function(){
	
	TipoVehiculo = this;
	$body = $('body');
	
	tipovehiculo = {
		openAddEditTipoVehiculo: function(tipo_vehiculo_id){
			if(tipo_vehiculo_id == undefined || !tipo_vehiculo_id) {
				tipo_vehiculo_id ='';
			}
			
			$('div#tipo_vehiculo #add_edit_tipo_vehiculo_container').unbind();
			$('div#tipo_vehiculo #add_edit_tipo_vehiculo_container').load(env_webroot_script + 'tipo_vehiculos/add_edit_tipo_vehiculo/'+tipo_vehiculo_id,function(){
				
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
		
		deleteTipoVehiculo: function(tipo_vehiculo_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tipo_vehiculos/delete_tipo_vehiculo',
				data:{
					'tipo_vehiculo_id': tipo_vehiculo_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.tipo_vehiculo_row_container[tipo_vehiculo_id='+tipo_vehiculo_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveTipoVeMantenimiento: function(){
			$form = $('.btn-crear-tipo-vehiculo-trigger').parents('form').eq(0);
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#add_edit_tipo_vehiculo').hide();
					$('#conteiner_all_rows').load(env_webroot_script + escape('tipo_vehiculos/find_tipo_vehiculos/1/'+null+'/'+null+'/'+''+'/'+''),function(){
					});
					alertify.success(data.msg);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[TipoVehiculo]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[TipoVehiculo]['+key+']"]').change(function() {
							$('[name="data[TipoVehiculo]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#tipo_vehiculo .btn-nuevo-tipo_vehiculo');
	$body.on('click', 'div#tipo_vehiculo .btn-nuevo-tipo-vehiculo' , function(){
		tipo_vehiculo_id = $(this).attr('tipo_vehiculo_id');
		tipovehiculo.openAddEditTipoVehiculo(tipo_vehiculo_id);
	});
	
	/* Ocultar formulario Crear vehículo*/
	$body.on('click','div#div-crear-tipo-vehiculo .btn-cancelar-crear-tipo-vehiculo', function(){
		$('#add_edit_tipo_vehiculo').hide();
	});
	
	$body.off('click','.btn-crear-tipo-vehiculo-trigger');
	$body.on('click','.btn-crear-tipo-vehiculo-trigger',function(){
		tipovehiculo.saveTipoVeMantenimiento();
	});
	
	$body.off('keypress','div#div-crear-tipo-vehiculo #txtTipoVehiculoMant');
	$body.on('keypress','div#div-crear-tipo-vehiculo #txtTipoVehiculoMant',function(e){
		if(e.which === 13) {
			tipovehiculo.saveTipoVeMantenimiento();
			return false;
		}
	});

	$body.off('click','div#tipo_vehiculo .edit-tipo-vehiculo-trigger');
	$body.on('click','div#tipo_vehiculo .edit-tipo-vehiculo-trigger', function(){
		tipo_vehiculo_id = $(this).parents('.tipo_vehiculo_row_container').attr('tipo_vehiculo_id');
		tipovehiculo.openAddEditTipoVehiculo(tipo_vehiculo_id);
	});
	
	$body.off('click','div#tipo_vehiculo .open-model-delete-tipo-vehiculo');
	$body.on('click','div#tipo_vehiculo .open-model-delete-tipo-vehiculo', function(){
		tipo_vehiculo_id = $(this).parents('.tipo_vehiculo_row_container').attr('tipo_vehiculo_id');
		$('div#myModalDeleteTipoVehiculo').attr('tipo_vehiculo_id', tipo_vehiculo_id);
	});
	
	$body.off('click','div#myModalDeleteTipoVehiculo .eliminar-tipo-vehiculo-trigger');
	$body.on('click','div#myModalDeleteTipoVehiculo .eliminar-tipo-vehiculo-trigger', function(){
		tipo_vehiculo_id = $('div#myModalDeleteTipoVehiculo').attr('tipo_vehiculo_id');
		tipovehiculo.deleteTipoVehiculo(tipo_vehiculo_id);
	});
	
});