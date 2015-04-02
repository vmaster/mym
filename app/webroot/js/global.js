$(document).ready(function(){
	Persona = this;
	$body = $('body');
	
	persona = {
	openAddEditPersona: function(persona_id){
		if(persona_id == undefined || !persona_id) persona_id ='';
		$('div#persona #add_edit_persona_container').load('personas/add_edit_persona/'+persona_id,function(){
			tipo_persona_id = $('.cboTipoPersonas').find('option:selected').val();
			loadDocumentos(tipo_persona_id);
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

	}}
	
	/* Mostrar formulario: Crear Persona */
	$body.on('click', 'div#persona .btn-nuevo-persona' , function(){
		persona_id = $(this).attr('persona_id');
		persona.openAddEditPersona(persona_id);
	});
	
	/* Ocultar formulario */
	$body.on('click','div#div-crear-persona .btn-cancelar-crear-persona', function(){
		$('#add_edit_persona').hide();
	});
	
	$body.on('click','.btn_crear_persona_trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: "personas/add_edit_persona/",
			data: $('#add_edit_persona').serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#add_edit_persona').hide();
				Global.displaySuccess(data.msg);
				//User.afterSavedEducation(data.education_id);
				//$('#add_edit_education_container').html('');
				//$('#education .alert-info').remove();
				//Global.triggerEventGA('Profile','Education','Save data');
			}else{
				$.each( data.validation, function( key, value ) {
					//Global.displayError(value[0]);
					$('[name="data[Persona]['+key+']"]').parent().addClass('control-group error');
					$('[name="data[Persona]['+key+']"]').change(function() {
						$('[name="data[Persona]['+key+']"]').parent().removeClass('control-group error');
					});
				});
			}
		});
	});

	
	$body.on('click','div#persona .btn-cancelar-crear-persona', function(){
		$('.form-crear-persona').hide();
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
		loadDocumentos(id);
	})
	
	$body.on('change','.cboPaises', function(){
		var id=$(this).val(); 
        var pais = $(this).find('option:selected').html();  
        $.ajax({
          type: "POST",
          url: "personas/ajax_list_regiones",
          data: { pais_id: id , pais_nombre : pais },
          cache: false,
          success: function(html)
           {
             $(".cboRegion").html(html);
             $(".cboRegion").removeAttr('disabled');
             loadCiudad(id);
           }
        })
	});
	
	$body.on('change','.cboRegion', function(){
		var id=$(this).val(); 
		 loadCiudad(id);
	});
	
	/* Cargar documentos según el tipo de persona */
	function loadDocumentos(id){ 
		$.ajax({
			type: "POST",
			url: "personas/ajax_list_tipo_documentos",
			data: {tipo_persona_id: id},
			cache: false,
			success: function(html)
			{
				$(".cboNroDocumento").html(html);
				$(".cboNroDocumento").removeAttr('disabled');
				hideByJuridica();
			}
		})
	}
	
	function loadCiudad(region_id){
		var id=$(".cboRegion").val(); 
        //var region = $(".cboRegion").find('option:selected').html();
        $.ajax({
          type: "POST",
          url: "personas/ajax_list_ciudades",
          data: { region_id: id },
          cache: false,
          success: function(html)
           {
             $(".cboCiudad").html(html);
             $(".cboCiudad").removeAttr('disabled');
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
			$('#divSexo').hide();
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
			$('#divSexo').show();
			$('#lblEstCivil').show();
			$('#cboEstadoCivil').show();
			$('#lblFecNacimiento').show();
			$('#txtFechaNacimiento').show();
			$('.cboRol').find('option[value=2]').show();
		}
	}
	
});