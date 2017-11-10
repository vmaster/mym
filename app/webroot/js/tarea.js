$(document).ready(function(){
	
	Tarea = this;
	$body = $('body');
	
	tarea = {
		openAddEditTarea: function(tarea_id){
			if(tarea_id == undefined || !tarea_id) {
				tarea_id ='';
			}
			
			$('div#tarea #add_edit_tarea_container').unbind();
			$('div#tarea #add_edit_tarea_container').load(env_webroot_script + 'tareas/add_edit_tarea/'+tarea_id,function(){

			});
		},
		
		deleteTarea: function(tarea_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tareas/delete_tarea',
				data:{
					'tarea_id': tarea_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.tarea_row_container[tarea_id='+tarea_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveTareaMantenimiento: function(){
			$form = $('.btn_crear_tarea_trigger').parents('form').eq(0);
			tinyMCE.triggerSave();
			
			$.ajax({
				url: $form.attr('action'),
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#add_edit_tarea').hide();
					$('.btn-nuevo-tarea').hide();
					$('#conteiner_all_rows').load(env_webroot_script + escape('tareas/find_tareas/1/'+null+'/'+null+'/'+null),function(){
						$('#table_content_tareas').DataTable();
					});
					$('.tooltip-mym').tooltip();
					alertify.success(data.msg);
					window.open(env_webroot_script + 'tareas/','_self');
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Tarea]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Tarea]['+key+']"]').change(function() {
							$('[name="data[Tarea]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		},
		
		saveTareaModal: function(){
			$form = $('form#form_create_tarea').eq(0);
			$.ajax({
				url: env_webroot_script + 'tareas/add_tarea',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddTarea').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_tarea = $('#txt-nombre-tarea').val();
					$('#txt-nombre-tarea').val('');
					new_option = "<option value='" + data.Tarea_id + "'>"+txt_tarea+"</option>";
					$('.cbo-tareas-select2 option:last').after(new_option);
					$(".cbo-tareas-select2").select2("val", [data.Tarea_id ,txt_tarea]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Tarea]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Tarea]['+key+']"]').change(function() {
							$('[name="data[Tarea]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear Tarea */
	$body.off('click','div#tarea .btn-nuevo-tarea');
	$body.on('click', 'div#tarea .btn-nuevo-tarea' , function(){
		tarea_id = $(this).attr('tarea_id');
		tarea.openAddEditTarea(tarea_id);
	});
	
	/* Ocultar formulario Crear Tarea*/
	$body.on('click','div#div-crear-tarea .btn-cancelar-crear-tarea', function(){
		window.open(env_webroot_script + 'tareas/','_self');
	});
	
	$body.off('click','.btn_crear_tarea_trigger');
	$body.on('click','.btn_crear_tarea_trigger',function(){
		tarea.saveTareaMantenimiento();
	});
	
	$body.off('keypress','div#div-crear-tarea #txtTareaMant');
	$body.on('keypress','div#div-crear-tarea #txtTareaMant',function(e){
		if(e.which === 13) {
			tarea.saveTareaMantenimiento();
			return false;
		}
	});

	$body.off('click','div#tarea .edit-tarea-trigger');
	$body.on('click','div#tarea .edit-tarea-trigger', function(){
		tarea_id = $(this).parents('.tarea_row_container').attr('tarea_id');
		tarea.openAddEditTarea(tarea_id);
	});
	
	$body.off('click','div#tarea .open-model-delete-tarea');
	$body.on('click','div#tarea .open-model-delete-tarea', function(){
		tarea_id = $(this).parents('.tarea_row_container').attr('tarea_id');
		$('div#myModalDeleteTarea').attr('tarea_id', tarea_id);
	});
	
	$body.off('click','div#myModalDeleteTarea .eliminar-tarea-trigger');
	$body.on('click','div#myModalDeleteTarea .eliminar-tarea-trigger', function(){
		tarea_id = $('div#myModalDeleteTarea').attr('tarea_id');
		tarea.deleteTarea(tarea_id);
	});
 
	$body.off('click','tr.tarea_row_container .view-tarea-trigger');
	$body.on('click','tr.tarea_row_container .view-tarea-trigger', function(){
		
		tarea_id = $(this).parents('.tarea_row_container').attr('tarea_id');

		$.ajax({
				url: env_webroot_script + 'tareas/obtener_actividades',
				data:{
					tarea_id: tarea_id
				},
				dataType: 'json',
				type: 'post'
			}).done(function(data){
					if(data.success==true){
						if(data.movilidad == 0){
							movilidad = 'Viaticos';	
							placa = "";
						}else{
							movilidad = 'Placa';
							placa = " ("+data.placa+")";
						}

						if(data.dia_libre == 1){
							actividad = "<b>D&iacute;a Libre</b>";	
						}else{
							actividad = data.actividades;
						}

						$html= 
						"<b>"+data.personal+"</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
						"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
						"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
						data.fecha+"<br>"+
						"<strong>Info. Ref: </strong>M&M - "+pad(data.inf_ref,5)+"<br>"+
						"<strong>Medio de Transporte: </strong>"+movilidad+''+placa+"<br>"+
						actividad;
						$('#myModalViewTarea .modal-body').empty();
						$('#myModalViewTarea .modal-body').append($html);
					}
			});
		//tarea.deleteTarea(tarea_id);
	});
	
	function pad(n, width, z) {
	  z = z || '0';
	  n = n + '';
	  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}
	
	/* CREAR EMPRESA DESDE UN MODAL (EN EL FORMULARIO CREAR INFORME) */
	$('#txt-nombre-tarea').keypress(function(e) {
		if(e.which == 13) {
			tarea.saveTareaModal();
			return false;
		}
	});
	
	$body.off('click','#btn-open-create-tarea');
	$body.on('click','#btn-open-create-tarea',function(){
		$('#txt-nombre-tarea').val('');
	});
	
	
	$body.off('click','.save-tarea-modal-trigger');
	$body.on('click','.save-tarea-modal-trigger',function(){
		tarea.saveTareaModal();
	});



	$body.off('click','.activar-edit-tarea-trigger');
	$body.on('click','.activar-edit-tarea-trigger', function(){

 
		tarea_id = $('#myModalActiveEditTarea').attr('tarea_id');
		estado = $('#myModalActiveEditTarea').attr('estado');

		$.ajax({
			url: env_webroot_script + 'tareas/active_desactive_edit',
			data: {
				'tarea_id' : tarea_id,
				'estado' : estado
			},
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success == true){
				alertify.success(data.msg);
				$('#myModalActiveEditTarea').modal('hide');
				$('.modal-backdrop').fadeOut(function(){$(this).hide()});
				location.reload();
			}else{
				$('#myModalActiveEditTarea .modal-body').show();
			}
		});	
	});


	$body.off('click','.open-modal-edit-tarea');
	$body.on('click','.open-modal-edit-tarea', function(){
		tarea_id = $(this).parents('.tarea_row_container').attr('tarea_id');
		estado = $(this).parents('.tarea_row_container').attr('estado');
        
		$('div#myModalActiveEditTarea').attr('tarea_id', tarea_id);
		$('div#myModalActiveEditTarea').attr('estado', estado);

	});



	$body.off('click','.activar-dia-libre-trigger');
	$body.on('click','.activar-dia-libre-trigger', function(){

 
		tarea_id = $('#myModalActiveDiaLibre').attr('tarea_id');
		dia_libre = $('#myModalActiveDiaLibre').attr('dia_libre');


		$.ajax({
			url: env_webroot_script + 'tareas/active_desactive_dialibre',
			data: {
				'tarea_id' : tarea_id,
				'dia_libre' : dia_libre
			},
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success == true){
				alertify.success(data.msg);
				$('#myModalActiveDiaLibre').modal('hide');
				$('.modal-backdrop').fadeOut(function(){$(this).hide()});
				location.reload();
			}else{
				$('#myModalActiveEditTarea .modal-body').show();
			}
		});	
	});


	$body.off('click','.open-modal-dia-libre');
	$body.on('click','.open-modal-dia-libre', function(){
		tarea_id = $(this).parents('.tarea_row_container').attr('tarea_id');
		dia_libre = $(this).parents('.tarea_row_container').attr('dia_libre');
        
		$('div#myModalActiveDiaLibre').attr('tarea_id', tarea_id);
		$('div#myModalActiveDiaLibre').attr('dia_libre', dia_libre);

	});
	
	$body.off('click','#rbViaticos');
	$body.on('click','#rbViaticos', function(){
		  $('#txtPlaca').attr('value','');
		  $('#txtPlaca').css('display','none');
	});
	
	$body.off('click','#rbAuto');
	$body.on('click','#rbAuto', function(){
		  $('#txtPlaca').attr('value','');
		  $('#txtPlaca').css('display','');
	});

	$body.off('click','.btn-consultar-tareas');
	$body.on('click','.btn-consultar-tareas', function(){
		  trabajador_id = $('#cboTrabajadores').val();
		  $('#conteiner_all_rows').load(env_webroot_script + escape('tareas/find_tareas/1/'+null+'/'+null+'/'+trabajador_id+'/'+null),function(){
			$('#table_content_tareas').DataTable();
		  });
	});

	$body.off('click','.btn-listar-todos');
	$body.on('click','.btn-listar-todos', function(){
		  trabajador_id = $('#cboTrabajadores').val();
		  $('#conteiner_all_rows').load(env_webroot_script + escape('tareas/listar_todas_tareas/1/'+null+'/'+null),function(){
			$('#table_content_tareas').DataTable();
		  });
	});

});