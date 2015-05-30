$(document).ready(function(){
	
	Trabajador = this;
	$body = $('body');
	
	trabajador = {
		openAddEditTrabajador: function(trabajador_id){
			if(trabajador_id == undefined || !trabajador_id) {
				trabajador_id ='';
			}else{
				setTimeout(function(){
					$(".cboProvincia").removeAttr('disabled');
					$(".cboDistrito").removeAttr('disabled');
				},1000)
			}
			
			/*$('div#trabajador #add_edit_trabajador_container').unbind();
			$('div#trabajador #add_edit_trabajador_container').load(env_webroot_script + 'trabajadores/add_edit_trabajador/'+trabajador_id,function(){

			});*/
			window.open(env_webroot_script + 'trabajadores/add_edit_trabajador/'+trabajador_id,'_self');
		},
		
		deleteTrabajador: function(trabajador_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'trabajadores/delete_trabajador',
				data:{
					'trabajador_id': trabajador_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.trabajador_row_container[trabajador_id='+trabajador_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		},
		
		saveTrabajador: function(index_button){
			name_id_select = "#Trabajador"+ index_button;
			$form = $('form#form_create_trabajador').eq(0);
			$.ajax({
				url: env_webroot_script + 'trabajadores/add_trabajador',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddTrabajador').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_trabajador = $('#txt-apellido-nombre').val();
					$('#txt-apellido-nombre').val('');
					new_option = "<option value='" + data.Trabajador_id + "'>"+txt_trabajador+"</option>";
					$(name_id_select + ' option:last').after(new_option);
					$(name_id_select).select2("val", [data.Trabajador_id ,txt_trabajador]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Trabajadore]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Trabjadore]['+key+']"]').change(function() {
							$('[name="data[Empresa]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		},
		
		saveResponsable: function(index_button){
			name_id_select = "#ResId"+ index_button;
			$form = $('form#form_create_trabajador').eq(0);
			$.ajax({
				url: env_webroot_script + 'trabajadores/add_trabajador',
				data: $form.serialize(),
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					alertify.success(data.msg);
					$('#myModalAddTrabajador').modal('hide');
					$('.modal-backdrop').fadeOut(function(){$(this).hide()});
					txt_trabajador = $('#txt-apellido-nombre').val();
					$('#txt-apellido-nombre').val('');
					new_option = "<option value='" + data.Trabajador_id + "'>"+txt_trabajador+"</option>";
					$(name_id_select + ' option:last').after(new_option);
					$(name_id_select).select2("val", [data.Trabajador_id ,txt_trabajador]);
				}else{
					$.each(data.validation, function( key, value ) {
						alertify.error(value[0]);
						$('[name="data[Trabajadore]['+key+']"]').parent().addClass('control-group has-error');
						$('[name="data[Trabjadore]['+key+']"]').change(function() {
							$('[name="data[Empresa]['+key+']"]').parent().removeClass('control-group has-error');
						});
					});
				}
			});
		}
	}
	
	/* Mostrar formulario: Crear trabajador */
	$body.off('click','div#trabajador .btn-nuevo-trabajador');
	$body.on('click', 'div#trabajador .btn-nuevo-trabajador' , function(){
		trabajador_id = $(this).attr('trabajador_id');
		trabajador.openAddEditTrabajador(trabajador_id);
	});
	
	/* Ocultar formulario Crear trabajador*/
	$body.on('click','div#div-crear-trabajador .btn-cancelar-crear-trabajador', function(){
		window.open(env_webroot_script + 'trabajadores/','_self');
		//$('#add_edit_trabajador').hide();
	});
	
	/*$body.off('click','.btn_crear_trabajador_trigger');
	$body.on('click','.btn_crear_trabajador_trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		//alert($form);return false;
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				//$('#add_edit_trabajador').hide();
				//$('#conteiner_all_rows').load(env_webroot_script + escape('trabajadores/find_trabajadores/1/'+null+'/'+null+'/'+''+'/'+''),function(){
				//});
				setTimeout(function(){
					alertify.success(data.msg);
				},2000)
				window.open(env_webroot_script + 'trabajadores','_self');
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Trabajadore]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Trabajadore]['+key+']"]').change(function() {
						$('[name="data[Trabajadore]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});*/

	$body.off('click','div#trabajador .edit-trabajador-trigger');
	$body.on('click','div#trabajador .edit-trabajador-trigger', function(){
		trabajador_id = $(this).parents('.trabajador_row_container').attr('trabajador_id');
		trabajador.openAddEditTrabajador(trabajador_id);
	});
	
	$body.off('click','div#trabajador .open-model-delete-trabajador');
	$body.on('click','div#trabajador .open-model-delete-trabajador', function(){
		trabajador_id = $(this).parents('.trabajador_row_container').attr('trabajador_id');
		$('div#myModalDeleteTrabajador').attr('trabajador_id', trabajador_id);
	});
	
	$body.off('click','div#myModalDeleteTrabajador .eliminar-trabajador-trigger');
	$body.on('click','div#myModalDeleteTrabajador .eliminar-trabajador-trigger', function(){
		trabajador_id = $('div#myModalDeleteTrabajador').attr('trabajador_id');
		trabajador.deleteTrabajador(trabajador_id);
	});

	
	$body.on('change','.cboDepartamentos', function(){
		var id=$(this).val(); 
        var departamento = $(this).find('option:selected').html();  
        $.ajax({
          type: "POST",
          url: env_webroot_script + "trabajadores/ajax_list_provincias",
          data: { departamento_id: id , departamento_nombre : departamento },
          cache: false,
          success: function(html)
           {
             $(".cboProvincia").html(html);
             $(".cboProvincia").removeAttr('disabled');
             loadDistrito($(".cboProvincia").val());
           }
        })
	});
	
	$body.on('change','.cboProvincia', function(){
		var id=$(this).val(); 
		 loadDistrito(id);
	});
	
	$body.on('change','#cboNroDocumento', function(){
		addMaxLengthNroDoc();
	})
	
	function loadDistrito(provincia_id){
		var id=$(".cboProvincia").val(); 
        //var region = $(".cboRegion").find('option:selected').html();
        $.ajax({
          type: "POST",
          url: env_webroot_script + "trabajadores/ajax_list_distritos",
          data: { provincia_id: provincia_id },
          cache: false,
          success: function(html)
           {
             $(".cboDistrito").html(html);
             $(".cboDistrito").removeAttr('disabled');
           }
        })
	}
	
	
	function addMaxLengthNroDoc(){
		/* Agregando Maxlength según el Tipo de Doc*/
		if($('#cboNroDocumento').val() == 1){
			$('#PersonaNroDocumento').attr('maxlength','8'); //DNI
		}

		if($('#cboNroDocumento').val() == 2){
			$('#PersonaNroDocumento').attr('maxlength','12'); //CARN EXT
		}

		if($('#cboNroDocumento').val() == 3){
			$('#PersonaNroDocumento').attr('maxlength','11'); //RUC
		}
	}
	
	/* CREAR TRABAJADOR DESDE UN MODAL (EN EL FORMULARIO CREAR INFORME) */
	$('#txt-apellido-nombre').keypress(function(e) {
		if(e.which === 13) {
			index_button = $('div#myModalAddTrabajador').attr('index-button');
			if($('#myModalAddTrabajador').attr('data-type') == 't'){
				trabajador.saveTrabajador(index_button);
			}else{
				trabajador.saveResponsable(index_button);
			}
			return false;
		}
	});
	
	$body.off('click','.save-trabajador-modal-trigger');
	$body.on('click','.save-trabajador-modal-trigger',function(){
		index_button = $('#myModalAddTrabajador').attr('index-button');
		if($('#myModalAddTrabajador').attr('data-type') == 't'){
			trabajador.saveTrabajador(index_button);
		}else{
			trabajador.saveResponsable(index_button);
		}
	});
	

});