$(document).ready(function(){
	
	Persona = this;
	$body = $('body');
	
	persona = {
		openAddEditPersona: function(persona_id){
			if(persona_id == undefined || !persona_id) {
				persona_id ='';
			}else{
				addMaxLengthNroDoc();
				setTimeout(function(){
					$(".cboProvincia").removeAttr('disabled');
					$(".cboDistrito").removeAttr('disabled');
				},1000)
			}
			
			$('div#persona #add_edit_persona_container').unbind();
			$('div#persona #add_edit_persona_container').load('personas/add_edit_persona/'+persona_id,function(){
				tipo_persona_id = $('.cboTipoPersonas').find('option:selected').val();
				loadDocumentos(tipo_persona_id, persona_id);
				hideByJuridica();			
				
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
	
		openAddEditRolPersona: function(persona_id, persona_nombre){
			//alert(persona_nombre);
			$('div#rol_persona #add_edit_rol_persona_container').load(escape('RolPersonas/add_edit_rol_persona/'+persona_id+'/'+persona_nombre),function(){
				
			});
		}
	}
	
	/* Mostrar formulario: Crear Persona */
	$body.off('click','div#persona .btn-nuevo-persona');
	$body.on('click', 'div#persona .btn-nuevo-persona' , function(){
		persona_id = $(this).attr('persona_id');
		persona.openAddEditPersona(persona_id);
	});
	
	/* Ocultar formulario Crear Persona*/
	$body.on('click','div#div-crear-persona .btn-cancelar-crear-persona', function(){
		$('#add_edit_persona').hide();
	});
	
	/* Mostrar formulario: Crear RolPersona */
	$body.off('click','div#rol_persona .btn-nuevo-rol-persona');
	$body.on('click', 'div#rol_persona .btn-nuevo-rol-persona' , function(){
		persona_id = $('div#rol_persona').attr('persona_id');
		persona_nombre = $('div#rol_persona').attr('persona_nombre');
		persona.openAddEditRolPersona(persona_id, persona_nombre);
	});
	
	/* Ocultar formulario Crear RolPersona*/
	$body.on('click','div#div-crear-rol-persona .btn-cancelar-crear-persona', function(){
		$('#add_edit_persona').hide();
	});
	
	$body.off('click','.btn_crear_persona_trigger');
	$body.on('click','.btn_crear_persona_trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		//alert($form);return false;
		$.ajax({
			//url: "personas/add_edit_persona/",
			url: $form.attr('action'),
			//data: $('#add_edit_persona').serialize(),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_persona').hide();
				alertify.success(data.msg);
			}else{
				$.each( data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Persona]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Persona]['+key+']"]').change(function() {
						$('[name="data[Persona]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#persona .edit-persona-trigger');
	$body.on('click','div#persona .edit-persona-trigger', function(){
		persona_id = $(this).parents('.persona_row_container').attr('persona_id');
		persona.openAddEditPersona(persona_id);
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
	
	$body.on('change','.cboTipoPersonas', function(){
		var id = $(this).val();
		var persona_id = '';
		loadDocumentos(id, persona_id);
	})
	
	$body.on('change','.cboDepartamentos', function(){
		var id=$(this).val(); 
        var departamento = $(this).find('option:selected').html();  
        $.ajax({
          type: "POST",
          url: "personas/ajax_list_provincias",
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
	
	/* Cargar documentos según el tipo de persona */
	function loadDocumentos(id, persona_id){
		//if(persona_id == undefined || !persona_id) persona_id ='';
		$.ajax({
			type: "POST",
			url: "personas/ajax_list_tipo_documentos",
			data: { tipo_persona_id: id, persona_id_doc: persona_id },
			cache: false,
			success: function(html)
			{
				$(".cboNroDocumento").html(html);
				$(".cboNroDocumento").removeAttr('disabled');
				hideByJuridica();
				addMaxLengthNroDoc();
			}
		})
	}
	
	function loadDistrito(provincia_id){
		var id=$(".cboProvincia").val(); 
        //var region = $(".cboRegion").find('option:selected').html();
        $.ajax({
          type: "POST",
          url: "personas/ajax_list_distritos",
          data: { provincia_id: provincia_id },
          cache: false,
          success: function(html)
           {
             $(".cboDistrito").html(html);
             $(".cboDistrito").removeAttr('disabled');
           }
        })
	}
	
	/* Ocultar componentes según el tipo persona JURIDICA */
	function hideByJuridica(){
		if($('.cboTipoPersonas').val() == 3){
			$('#lblNombre').hide();
			$('#txtApellido').hide();
			$('#lblApellido').hide();
			$('#lblRznSocial').show();
			$('#lblSexo').hide();
			$('#cboSexo').hide();
			$('#lblEstCivil').hide();
			$('#cboEstadoCivil').hide();
			$('#lblFecNacimiento').hide();
			$('#txtFechaNacimiento').hide();
			$('.cboRol').find('option[value=2]').hide(); //Ocultar Rol de tipo Personal
		}else{
			$('#lblNombre').show();
			$('#txtApellido').show();
			$('#lblApellido').show();
			$('#lblRznSocial').hide();
			$('#lblSexo').show();
			$('#cboSexo').show();
			$('#lblEstCivil').show();
			$('#cboEstadoCivil').show();
			$('#lblFecNacimiento').show();
			$('#txtFechaNacimiento').show();
			$('.cboRol').find('option[value=2]').show();
		}
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
	
	
	/* Query Events of Roles */
	$body.off('click','div#persona .link_roles');
	$body.on('click','div#persona .link_roles', function(){
		persona_id = $(this).parents('.persona_row_container').attr('persona_id');
		persona_nombre = $(this).parents('.persona_row_container').attr('persona_nombre');
		$('div#persona').load(escape('RolPersonas/list_roles_personas/'+persona_id+'/'+persona_nombre),function(){
		});
	});
	
	
	
});