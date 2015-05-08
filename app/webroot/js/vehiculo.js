$(document).ready(function(){
	
	Vehiculo = this;
	$body = $('body');
	
	vehiculo = {
		openAddEditVehiculo: function(vehiculo_id){
			if(vehiculo_id == undefined || !vehiculo_id) {
				vehiculo_id ='';
			}
			
			$('div#vehiculo #add_edit_vehiculo_container').unbind();
			$('div#vehiculo #add_edit_vehiculo_container').load(env_webroot_script + 'vehiculos/add_edit_vehiculo/'+vehiculo_id,function(){
				
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
		
		deleteVehiculo: function(vehiculo_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'vehiculos/delete_vehiculo',
				data:{
					'vehiculo_id': vehiculo_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.vehiculo_row_container[vehiculo_id='+vehiculo_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveVehiculo: function(index_button){
			name_id_select = "#PlacaActa"+ index_button;
			$form = $('form#form_create_vehiculo').eq(0);
			$.ajax({
				url: env_webroot_script + 'vehiculos/add_vehiculo',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddVehiculo').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_nro_placa = $('#txt-nro-placa').val();
					$('#txt-nro-placa').val('');
					new_option = "<option value='" + data.Vehiculo_id + "'>"+txt_nro_placa+"</option>";
					$(name_id_select + ' option:last').after(new_option);
					$(name_id_select).select2("val", [data.Vehiculo_id ,txt_nro_placa]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Vehiculo]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Vehiculo]['+key+']"]').change(function() {
							$('[name="data[Vehiculo]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#vehiculo .btn-nuevo-vehiculo');
	$body.on('click', 'div#vehiculo .btn-nuevo-vehiculo' , function(){
		vehiculo_id = $(this).attr('vehiculo_id');
		vehiculo.openAddEditVehiculo(vehiculo_id);
	});
	
	/* Ocultar formulario Crear vehículo*/
	$body.on('click','div#div-crear-vehiculo .btn-cancelar-crear-vehiculo', function(){
		$('#add_edit_vehiculo').hide();
	});
	
	$body.off('click','.btn-crear-vehiculo-trigger');
	$body.on('click','.btn-crear-vehiculo-trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_vehiculo').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('vehiculos/find_vehiculos/1/'+null+'/'+null+'/'+''+'/'+''),function(){
					$('#table_content_vehiculos').DataTable();
				});
				alertify.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Vehiculo]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Vehiculo]['+key+']"]').change(function() {
						$('[name="data[Vehiculo]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#vehiculo .edit-vehiculo-trigger');
	$body.on('click','div#vehiculo .edit-vehiculo-trigger', function(){
		vehiculo_id = $(this).parents('.vehiculo_row_container').attr('vehiculo_id');
		vehiculo.openAddEditVehiculo(vehiculo_id);
	});
	
	$body.off('click','div#vehiculo .open-model-delete-vehiculo');
	$body.on('click','div#vehiculo .open-model-delete-vehiculo', function(){
		vehiculo_id = $(this).parents('.vehiculo_row_container').attr('vehiculo_id');
		$('div#myModalDeleteVehiculo').attr('vehiculo_id', vehiculo_id);
	});
	
	$body.off('click','div#myModalDeleteVehiculo .eliminar-vehiculo-trigger');
	$body.on('click','div#myModalDeleteVehiculo .eliminar-vehiculo-trigger', function(){
		vehiculo_id = $('div#myModalDeleteVehiculo').attr('vehiculo_id');
		vehiculo.deleteVehiculo(vehiculo_id);
	});
	
	/* CREAR VEHICULO DESDE UN MODAL (EN EL FORMULARIO CREAR INFORME) */
	$('#txt-nro-placa').keypress(function(e) {
		if(e.which === 13) {
			index_button = $('div#myModalAddVehiculo').attr('index-button');
			vehiculo.saveVehiculo(index_button);
			return false;
		}
	});
	
	$body.off('click','.save-vehiculo-modal-trigger');
	$body.on('click','.save-vehiculo-modal-trigger',function(){
		index_button = $('#myModalAddVehiculo').attr('index-button');
		vehiculo.saveVehiculo(index_button);
	});
	
});