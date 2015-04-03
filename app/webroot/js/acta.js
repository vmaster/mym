$(document).ready(function(){
	
	Acta = this;
	$body = $('body');
	
	acta = {

		deleteActa: function(acta_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'actas/delete_acta',
				data:{
					'acta_id': acta_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.acta_row_container[acta_id='+acta_id+']').fadeOut(function(){$(this).remove()});
					alertify.success(data.msg);
				}else{
					alertify.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear vehículo */
	$body.off('click','div#acta .btn-nuevo-acta');
	$body.on('click', 'div#acta .btn-nuevo-acta' , function(){
		acta_id = $(this).attr('acta_id');
		acta.openAddActa(acta_id);
	});
	
	/* Ocultar formulario Crear Acta*/
	$body.on('click','div#div-crear-acta .btn-cancelar-crear-acta', function(){
		//$('#add_edit_acta').hide();
		window.open(env_webroot_script + 'actas/','_self');
	});
	
	$body.off('click','.btn_crear_acta_trigger');
	$body.on('click','.btn_crear_acta_trigger',function(){
		cambio=false;
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				//$('#add_edit_acta').hide();
				//$('#conteiner_all_rows').load(env_webroot_script + escape('actas/find_actas/1/'+null+'/'+null+'/'+''+'/'+''),function(){
				//});
				alertify.success(data.msg);
				setTimeout(function(){
					window.open(env_webroot_script + 'actas/','_self');
				},1000)
				
			}else{
				$.each(data.validation, function( key, value ) {
					alertify.error(value[0]);
					$('[name="data[Acta]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Acta]['+key+']"]').change(function() {
						$('[name="data[Acta]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#acta .edit-acta-trigger');
	$body.on('click','div#acta .edit-acta-trigger', function(){
		acta_id = $(this).parents('.acta_row_container').attr('acta_id');
		acta.openEditActa(acta_id);
	});
	
	$body.off('click','div#acta .open-model-delete-acta');
	$body.on('click','div#acta .open-model-delete-acta', function(){
		acta_id = $(this).parents('.acta_row_container').attr('acta_id');
		$('div#myModalDeleteActa').attr('acta_id', acta_id);
	});
	
	$body.off('click','div#myModalDeleteActa .eliminar-acta-trigger');
	$body.on('click','div#myModalDeleteActa .eliminar-acta-trigger', function(){
		acta_id = $('div#myModalDeleteActa').attr('acta_id');
		acta.deleteActa(acta_id);
	});
	
	
	
/*SCRIPTS PARA EL CREAR Y EDITAR INFORME  */
	
/****	Formato de Json recivido para Autocomplete
    var countries = [
		                 { value: 'Andorra', data: 'AD' },
		                 // ...
		                 { value: 'Zimbabwe', data: 'ZZ' }
		              ];
*/	
	$('#txtEmpresa2').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_empresa',
	    onSelect: function (suggestions) {
	        $("#txtEmpresaid").val('');
	        $("#txtEmpresaid").val(suggestions.id);
	    },
	    onInvalidateSelection: function () {
	  	  $("#txtEmpresaid").val('');
	  	  $(this).val('');				///Obliga a seleccionar del autocomplete
	    }
	});

	$('#txtEmpresa2').focusout(function() {
		   if($('#txtEmpresaid').val() == ''){
		   		$(this).val('');
		   }
	})		

	
	/* Autcomplete Resposable de la actividad 1 y 2 */
	$('#txtResAct1').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResActId1").val('');
	        $("#hiddenResActId1").val(suggestions.id);

	        //Poblando el DNI
	        trabajador_id = $('#hiddenResActId1').val();
	        attr_id_dni = '#txtDniResAct1';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	      $("#hiddenResActId1").val('');

	      $(this).val('');				///Obliga a seleccionar del autocomplete
	      
	  	  $('#txtDniResAct1').removeAttr('disabled');
	  	  $('#txtDniResAct1').val('');
	    }
	});

	$('#txtResAct1').focusout(function() {
	    if($('#hiddenResActId1').val() == ''){
	    	$(this).val('');

	    	$('#txtDniResAct1').removeAttr('disabled');
		  	$('#txtDniResAct1').val('');
	    }
	 })

	$('#txtResAct2').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResActId2").val('');
	        $("#hiddenResActId2").val(suggestions.id);

	        //Poblando el DNI
	        trabajador_id = $('#hiddenResActId2').val();
	        attr_id_dni = '#txtDniResAct2';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResActId2").val('');

	  	  $(this).val('');		///Obliga a seleccionar del autocomplete
	      $('#hiddenResActId2').val('');		
	  	  
	  	  $('#txtDniResAct2').removeAttr('disabled');
	  	  $('#txtDniResAct2').val('');
	    }
	});

	$('#txtResAct2').focusout(function() {
	    if($('#hiddenResActId2').val() == ''){
	    	$(this).val('');

	    	$('#txtDniResAct2').removeAttr('disabled');
		  	$('#txtDniResAct2').val('');
	    }
	 })

	/* Autcompletes Resposables de la Supervisión 1 y 2 */
	$('#txtResSup1').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResSupId1").val('');
	        $("#hiddenResSupId1").val(suggestions.id);

	      //Poblando el DNI
	        trabajador_id = $('#hiddenResSupId1').val();
	        attr_id_dni = '#txtDniRespSup1';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResSupId1").val('');

	  	  $(this).val('');		///Obliga a seleccionar del autocomplete
	      $('#hiddenResSupId1').val('');

	  	  $('#txtDniRespSup1').removeAttr('disabled');
	  	  $('#txtDniRespSup1').val('');	
	    }
	});

	$('#txtResSup1').focusout(function() {
	    if($('#hiddenResSupId1').val() == ''){
	    	$(this).val('');

	    	$('#txtDniRespSup1').removeAttr('disabled');
		  	$('#txtDniRespSup1').val('');
	    }
	 })

	$('#txtResSup2').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResSupId2").val('');
	        $("#hiddenResSupId2").val(suggestions.id);

	      //Poblando el DNI
	        trabajador_id = $('#hiddenResSupId2').val();
	        attr_id_dni = '#txtDniRespSup2';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResSupId2").val('');

	  	  $(this).val('');		///Obliga a seleccionar del autocomplete
	      $('#hiddenResSupId2').val('');

	  	  $('#txtDniRespSup2').removeAttr('disabled');
	  	  $('#txtDniRespSup2').val('');	
	    }
	});

	$('#txtResSup2').focusout(function() {
	    if($('#hiddenResSupId2').val() == ''){
	    	$(this).val('');

	    	$('#txtDniRespSup2').removeAttr('disabled');
		  	$('#txtDniRespSup2').val('');
	    }
	 })


	/* AUTOCOMPLETE TRABAJADORES */
	function loadATrabajador(){
		$.each($('.txt-trabajador'), function(index) {
			index_input = (index + 1);
			cadena_name_id = "#Trabajador"+ index_input;
			name_class_ni = ".txt-ni"+ index_input;
				  $(cadena_name_id).autocomplete({
					    // lookup: countries,
					    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
					    onSelect: function (suggestions) {
						    nombre_id_input_trabajador = $(this).attr('id');
						    longitud = nombre_id_input_trabajador.length;
						    if(longitud == 11){
					    		index_current = nombre_id_input_trabajador.substring(longitud-1);
						    }else{
						    	index_current = nombre_id_input_trabajador.substring(longitud-2);
						    }
						    cadena_hidden_id = "#txtTrabajadorid" + index_current;
						    cadena_act_hidden_id = "#HiddenActividadid" + index_current;
						    cadena_name_id_act = "#Actividad"+ index_current;
						    
					        $(cadena_hidden_id).remove();
					        $(this).after("<input name='data[TrabajadorActa][trabajador_id"+index_current+"]' type='hidden' value='"+ suggestions.id +"' id='txtTrabajadorid"+index_current+"'>");
	
					        loadActividadByTrabajador(suggestions.id, index_current); 
					    },
					    onInvalidateSelection: function () {
					    	$(this).val('');
					    	$(cadena_hidden_id).val('');
	
					    	$(cadena_name_id_act).val('');
					    	$(cadena_act_hidden_id).val('');
					    }
					});
	
					$(cadena_name_id).focusout(function() {
						nombre_id_input_trabajador = $(this).attr('id');
					    longitud = nombre_id_input_trabajador.length;
					    if(longitud == 11){
				    		index_current = nombre_id_input_trabajador.substring(longitud-1);
					    }else{
					    	index_current = nombre_id_input_trabajador.substring(longitud-2);
					    }
					    
						cadena_hidden_trab_id = "#txtTrabajadorid" + index_current;
						// alert(cadena_hidden_trab_id);
					    if($(cadena_hidden_trab_id).val() == ''){
					    	$(this).val('');
					    }
					 })
	
				/*
				 * AUTOCOMPLETAR DE NORMAS INCUMPLIDAS DENTRO DEL EACH DE
				 * TRABAJADORES
				 */
				
					 $.each($(name_class_ni), function(indice) {
						  new_index = (indice + 1);
	
						  cadena_name_ni_id = "#ni-"+ index_input +"-"+new_index;
						  $(cadena_name_ni_id).autocomplete({
							    serviceUrl: env_webroot_script + 'actas/ajax_list_codigo',
							    onSelect: function (suggestions) {
								    nombre_id_input_ni = $(this).attr('id');
								    longitud = nombre_id_input_ni.length;
								    if(longitud == 6){
							    		index_current = nombre_id_input_ni.substring(longitud-3);
							    		
								    }else{
								    	index_current = nombre_id_input_ni.substring(longitud-4);
								    }
								    cadena_hidden_id = "#hiddenNid" + index_current;
	
							        $(cadena_hidden_id).val('');
							        $(cadena_hidden_id).val(suggestions.id);
							    },
							    onInvalidateSelection: function () {
							    	$(this).val('');
							    	$(cadena_hidden_id).val('');
							    }
						 });
	
						  $(cadena_name_ni_id).focusout(function() {
								nombre_id_input_ni = $(this).attr('id');
							    longitud = nombre_id_input_ni.length;
							    if(longitud == 6){
						    		index_current = nombre_id_input_ni.substring(longitud-3);
							    }else{
							    	index_current = nombre_id_input_ni.substring(longitud-4);
							    }
							    
								cadena_hidden_ni_id = "#hiddenNid" + index_current;
							    if($(cadena_hidden_ni_id).val() == ''){
							    	$(this).val('');
							    }
							 })
					});
		});
	}
	loadATrabajador();
	/* AUTOCOMPLETE ACTIVIDADES */
	
	function loadAActividad(){
		$.each($('.txt-actividad'), function(index) {
			  index_input = (index + 1);
			  cadena_name_id = "#Actividad"+ index_input;
			  $(cadena_name_id).autocomplete({
				    //lookup: countries,
				    serviceUrl: env_webroot_script + 'actas/ajax_list_actividad',
				    onSelect: function (suggestions) {
					    nombre_id_input_actividad = $(this).attr('id');
					    longitud = nombre_id_input_actividad.length;
					    if(longitud == 10){
				    		index_current = nombre_id_input_actividad.substring(longitud-1);
					    }else{
					    	index_current = nombre_id_input_actividad.substring(longitud-2);
					    }
					    cadena_hidden_id = "#HiddenActividadid" + index_current;
	
				        $(cadena_hidden_id).val('');
				        $(cadena_hidden_id).val(suggestions.id);
				        //$(this).after("<input name='data[TrabajadorActividad][actividad_id"+index_current+"]' type='hidden' value='"+ suggestions.id +"' id='HiddenActividadid"+index_current+"'>");
				    },
				    onInvalidateSelection: function () {
				    	$(this).val('');
				    	$(cadena_hidden_id).val('');
				  	    //$(cadena_hidden_id).remove();
				  	    //$(this).after("<input name='data[TrabajadorActividad][actividad_id"+index_current+"]' type='hidden' value='' id='HiddenActividadid"+index_current+"'>");
				    }
				});
		});
	}
	loadAActividad();
	
	/* AUTOCOMPLETE NRO PLACA */
	function loadAPlaca(){
		$.each($('.txt-nro-placa'), function(index) {
			index_input = (index + 1);
			cadena_name_id = "#PlacaActa"+ index_input;
			name_class_ni = ".txt-ni-placa"+ index_input;
				  $(cadena_name_id).autocomplete({
					    //lookup: countries,
					    serviceUrl: env_webroot_script + 'actas/ajax_list_placa',
					    onSelect: function (suggestions) {
						    nombre_id_input_placa = $(this).attr('id');
						    longitud = nombre_id_input_placa.length;
						    if(longitud == 10){
					    		index_current = nombre_id_input_placa.substring(longitud-1);
						    }else{
						    	index_current = nombre_id_input_placa.substring(longitud-2);
						    }
	
						    name_id_hidden_placa = "#hiddenPlacaId" + index_current;
	
					        $(name_id_hidden_placa).val('');
					        $(name_id_hidden_placa).val(suggestions.id);
	
				        	loadVehiculoByPlaca(suggestions.id, index_current); 
	
				        	name_id_text_veh = "#TipoVehiculoActa"+ index_current;
						    name_id_hidden_veh = "#hiddenVehiculoid" + index_current;
					    },
					    onInvalidateSelection: function () {
					    	$(this).val('');
					    	$(name_id_hidden_placa).val('');
	
					    	$(name_id_text_veh).val('');
					    	$(name_id_hidden_veh).val('');
					    }
					});
	
					$(cadena_name_id).focusout(function() {
						nombre_id_input_placa = $(this).attr('id');
					    longitud = nombre_id_input_placa.length;
					    if(longitud == 10){
				    		index_current = nombre_id_input_placa.substring(longitud-1);
					    }else{
					    	index_current = nombre_id_input_placa.substring(longitud-2);
					    }
					    
						nombre_id_hidden_placa = "#hiddenPlacaId" + index_current;
					    if($(nombre_id_hidden_placa).val() == ''){
					    	$(this).val('');
					    }
					 })
	
				/* AUTOCOMPLETAR DE NORMAS INCUMPLIDAS DENTRO DEL EACH DE UNIDADES MÓVILES*/
				
					 $.each($(name_class_ni), function(indice) {
						  new_index = (indice + 1);
	
						  cadena_name_ni_id = "#ni-placa-"+ index_input +"-"+new_index;
						  $(cadena_name_ni_id).autocomplete({
							    serviceUrl: env_webroot_script + 'actas/ajax_list_codigo',
							    onSelect: function (suggestions) {
								    nombre_id_input_ni = $(this).attr('id');
								    longitud = nombre_id_input_ni.length;
								    if(longitud == 12){
							    		index_current = nombre_id_input_ni.substring(longitud-3);
							    		
								    }else{
								    	index_current = nombre_id_input_ni.substring(longitud-4);
								    }
								    cadena_hidden_id = "#hiddenPlacaNid" + index_current;
	
							        $(cadena_hidden_id).val('');
							        $(cadena_hidden_id).val(suggestions.id);
							    },
							    onInvalidateSelection: function () {
							    	$(this).val('');
							    	$(cadena_hidden_id).val('');
							    }
						 });
	
						  $(cadena_name_ni_id).focusout(function() {
								nombre_id_input_ni = $(this).attr('id');
							    longitud = nombre_id_input_ni.length;
							    if(longitud == 12){
						    		index_current = nombre_id_input_ni.substring(longitud-3);
							    }else{
							    	index_current = nombre_id_input_ni.substring(longitud-4);
							    }
							    
								cadena_hidden_ni_id = "#hiddenPlacaNid" + index_current;
							    if($(cadena_hidden_ni_id).val() == ''){
							    	$(this).val('');
							    }
							 })
					});
		});
	}
	loadAPlaca();

	/* AUTOCOMPLETE NORMAS INCUM ACTOS SUBESTANDARES */
	function loadANiActos (){
		$.each($('.txt-acto-sub-ni'), function(index) { 
			  index_input = (index + 1);
			  cadena_id_input_ni = "#txtActoSubNi"+ index_input;
			  $(cadena_id_input_ni).autocomplete({
				    //lookup: countries,
				    serviceUrl: env_webroot_script + 'actas/ajax_list_codigo',
				    onSelect: function (suggestions) {
					    nombre_id_input_ni = $(this).attr('id');
					    longitud = nombre_id_input_ni.length;
					    if(longitud == 13){
				    		index_current = nombre_id_input_ni.substring(longitud-1);
					    }else{
					    	index_current = nombre_id_input_ni.substring(longitud-2);
					    }
					    cadena_hidden_id = "#hiddenActoSubNid" + index_current;
	
				        $(cadena_hidden_id).val('');
				        $(cadena_hidden_id).val(suggestions.id);
				    },
				    onInvalidateSelection: function () {
				    	$(this).val('');
				    	$(cadena_hidden_id).val('');
				    }
				});
				
			  $(cadena_id_input_ni).focusout(function() {
					nombre_id_input_ni = $(this).attr('id');
				    longitud = nombre_id_input_ni.length;
				    if(longitud == 13){
			    		index_current = nombre_id_input_ni.substring(longitud-1);
				    }else{
				    	index_current = nombre_id_input_ni.substring(longitud-2);
				    }
				    
					cadena_hidden_ni_id = "#hiddenActoSubNid" + index_current;
				    if($(cadena_hidden_ni_id).val() == ''){
				    	$(this).val('');
				    }
			 })
		});
	}
	loadANiActos();
	
	/* AUTOCOMPLETE NORMAS INCUM CONDICIONES SUBESTANDARES */
	function loadANiCondi(){
		$.each($('.txt-cond-sub-ni'), function(index) { 
			  index_input = (index + 1);
			  cadena_id_input_ni = "#txtCondiSubNi"+ index_input;
			  $(cadena_id_input_ni).autocomplete({
				    //lookup: countries,
				    serviceUrl: env_webroot_script + 'actas/ajax_list_codigo',
				    onSelect: function (suggestions) {
					    nombre_id_input_ni = $(this).attr('id');
					    longitud = nombre_id_input_ni.length;
					    if(longitud == 14){
				    		index_current = nombre_id_input_ni.substring(longitud-1);
					    }else{
					    	index_current = nombre_id_input_ni.substring(longitud-2);
					    }
					    cadena_hidden_id = "#hiddenCondiSubNid" + index_current;
	
				        $(cadena_hidden_id).val('');
				        $(cadena_hidden_id).val(suggestions.id);
				    },
				    onInvalidateSelection: function () {
				    	$(this).val('');
				    	$(cadena_hidden_id).val('');
				    }
				});
				
			  $(cadena_id_input_ni).focusout(function() {
					nombre_id_input_ni = $(this).attr('id');
				    longitud = nombre_id_input_ni.length;
				    if(longitud == 14){
			    		index_current = nombre_id_input_ni.substring(longitud-1);
				    }else{
				    	index_current = nombre_id_input_ni.substring(longitud-2);
				    }
				    
					cadena_hidden_ni_id = "#hiddenCondiSubNid" + index_current;
				    if($(cadena_hidden_ni_id).val() == ''){
				    	$(this).val('');
				    }
			 })
		});
	}
	loadANiCondi();

	function loadActividadByTrabajador(trabajador_id, index){
		element_actividad = '#Actividad'+index;
		element_actividad_hidden = '#HiddenActividadid'+index; //aqui obtengo el nombre
        $.ajax({
          type: "POST",
          url: env_webroot_script + "actas/ajax_actividad_trabajador",
          data: { trabajador_id: trabajador_id },
          dataType: "json",
          cache: false,
          success: function(html)
           {
              $(element_actividad).val(html.nombre_actividad);
              $(element_actividad_hidden).val(html.id);

           }
        })
	}

	function loadVehiculoByPlaca(placa_id, index){
		element_vehiculo = '#TipoVehiculoActa'+index;
		element_vehiculo_hidden = '#hiddenVehiculoid'+index;
        $.ajax({
          type: "POST",
          url: env_webroot_script + "actas/ajax_vehiculo_placa",
          data: { placa_id: placa_id },
          dataType: "json",
          cache: false,
          success: function(html)
           {
              $(element_vehiculo).val(html.nombre_vehiculo);
              $(element_vehiculo_hidden).val(html.id);

           }
        })
	}

	function loadDniByTrabajador(trabajador_id, attr_id_dni){
        $.ajax({
          type: "POST",
          url: env_webroot_script + "actas/ajax_trabajador_dni",
          data: { trabajador_id: trabajador_id },
          cache: false,
          success: function(html)
           {
             $(attr_id_dni).val(html);
             $(attr_id_dni).prop("disabled","disabled");
             if(html.length > 50){
            	 $(attr_id_dni).val('');
   			 }
           }
        })
	}

	/* AGREGAR FILAS A LA TABLA DE IMPLEMENTOS DE PROT PERSO. */	
		$("#div-btn-add-ipp .add-more-row-ipp").bind("click", function(e){
		long_table = $('#table-ipp-inf tbody tr').length;
		
		var new_row = "<tr>"+
					  "<td>"+(long_table+1)+"</td>" +
					  "<td style='width:28%;'><input name='data[TrabajadorActa"+(long_table+1)+"][nombre_trabajador]' id='Trabajador"+(long_table+1)+"' class='form-control txt-trabajador' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' autocomplete='off'/>" +
					  "<input name='data[TrabajadorActa][trabajador_id"+(long_table+1)+"]' type='hidden' value='' id='txtTrabajadorid"+(long_table+1)+"'>"+
					  "<input name='data[TrabajadorActa][ipp_id"+(long_table+1)+"]' type='hidden' value='' id='hiddenIppid"+(long_table+1)+"'></td>" +
					  
					  "<td style='width:15%;'><input name='data[ActividadPersona"+(long_table+1)+"][actividad]' id='Actividad"+(long_table+1)+"' class='form-control txt-actividad' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[TrabajadorActividad][actividad_id"+(long_table+1)+"]' type='hidden' value='' id='HiddenActividadid"+(long_table+1)+"'></td>";
						  for(i= 1; i<=7; i++){
							  new_row += "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-"+ i +"]' id='ni-"+(long_table+1)+"-"+ i +"' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
							  			"<input name='data[NiActa][ni-id"+(long_table+1)+"-"+ i +"]' type='hidden' value='' id='hiddenNid"+(long_table+1)+ "-" + i + "'>"+
							  			"<input name='data[IppNi][ippni-id"+(long_table+1)+"-"+ i +"]' type='hidden' value='' id='hiddenIppNid"+(long_table+1)+"-"+ i +"'></td>";
						  }
					  new_row += "</tr>";

		$('#table-ipp-inf tr:last').after(new_row);
		loadATrabajador();
		loadAActividad();
	});
		
	/* AGREGAR FILAS A LA TABLA DE UNIDADES MOVILES */	
	$("#div-btn-add-um .add-more-row-um").bind("click", function(e){
	long_table = $('#table-um-inf tbody tr').length;
		
	var new_row = 	"<tr>"+
					"<td>"+(long_table+1)+"</td>"+
					"<td style='width:14%;'><input name='data[UnidadMovil"+(long_table+1)+"][nro_placa]' id='PlacaActa"+(long_table+1)+"' class='form-control txt-nro-placa' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>"+
					"<input name='data[UnidadMovil][nro_placa_id"+(long_table+1)+"]' type='hidden' value='' id='hiddenPlacaId"+(long_table+1)+"'>"+
					"<input name='data[UnidadMovil][um_id"+(long_table+1)+"]' type='hidden' value='' id='hiddenUmId"+(long_table+1)+"'></td>"+
					"<td style='width:15%;'><input name='data[TipoUnidadMovil"+(long_table+1)+"][vehiculo]' id='TipoVehiculoActa"+(long_table+1)+"' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>"+
					"<input name='data[TipoUnidadMovil][vehiculo_id"+(long_table+1)+"]' type='hidden' value='' id='hiddenVehiculoid"+(long_table+1)+"'></td>";
						for($j= 1; $j <=9; $j++){
							new_row += "<td><input name='data[UnidadNorma][ni-"+(long_table+1)+"-"+$j+"]' id='ni-placa-"+(long_table+1)+"-"+$j+"' class='form-control txt-ni-placa"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>"+
									   "<input name='data[UnidadNorma][ni-id"+(long_table+1)+"-"+$j+"]' type='hidden' value='' id='hiddenPlacaNid"+(long_table+1)+"-"+$j+"'>"+
									   "<input name='data[UmNi][umni-id"+(long_table+1)+"-"+$j+"]' type='hidden' value='' id='hiddenUmNid"+(long_table+1)+"-"+$j+"'></td>";
						}
					new_row += "</tr>";

		$('#table-um-inf tr:last').after(new_row);
		loadAPlaca();
	});
	
	/* AGREGAR FILAS A LA TABLA ACTOS SUBESTÁNDARES */	
	$("#div-btn-add-as .add-more-row-as").bind("click", function(e){
	long_table = $('#table-as-inf tbody tr').length;
		
	var new_row = 	"<tr>"+
					"<td>"+(long_table+1)+"</td>"+
				    "<td style='width:89%;'><input name='data[ActoSubestandar"+(long_table+1)+"][descripcion]' id='txtActoSubDes"+(long_table+1)+"' class='form-control'/>" +
				    "<input name='data[ActoSubestandar"+(long_table+1)+"][as-id]' id='hiddenActoSubId"+(long_table+1)+"' type='hidden' class='form-control' value=''></td>" +
				    "<td><input name='data[ActoSubestandar"+(long_table+1)+"][ni]' id='txtActoSubNi"+(long_table+1)+"' class='form-control txt-acto-sub-ni' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>" +
				    "<input name='data[ActoSubestandar"+(long_table+1)+"][ni-id]' id='hiddenActoSubNid"+(long_table+1)+"' type='hidden' class='form-control' value=''></td>"+
					"</tr>";

		$('#table-as-inf tr:last').after(new_row);
		loadANiActos();
	});
	
	/* AGREGAR FILAS A LA TABLA CONDICIONES SUBESTÁNDARES */	
	$("#div-btn-add-cs .add-more-row-cs").bind("click", function(e){
	long_table = $('#table-cs-inf tbody tr').length;
		
	var new_row = 	"<tr>"+
					"<td>"+(long_table+1)+"</td>"+
					"<td style='width:89%;'><input name='data[CondiSubestandar"+(long_table+1)+"][descripcion]' id='txtCondiSubDes"+(long_table+1)+"' class='form-control'/>"+
				    "<input name='data[CondiSubestandar"+(long_table+1)+"][cs-id]' id='hiddenCondiSubId"+(long_table+1)+"' type='hidden' class='form-control' value=''></td>"+
				    "<td><input name='data[CondiSubestandar"+(long_table+1)+"][ni]' id='txtCondiSubNi"+(long_table+1)+"' class='form-control txt-cond-sub-ni' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>"+
				    "<input name='data[CondiSubestandar"+(long_table+1)+"][ni-id]' id='hiddenCondiSubNid"+(long_table+1)+"' type='hidden' class='form-control' value=''></td>"+
					"</tr>";

		$('#table-cs-inf tr:last').after(new_row);
		loadANiCondi()
	});
	
	/* AGREGAR FILAS A LA TABLA CIERRE DE ACTA (Medidas de control adoptadas) */	
	$("#div-btn-add-mc .add-more-row-mc").bind("click", function(e){
	long_table = $('#table-mc-inf tbody tr').length;
		
	var new_row = 	"<tr>"+
					"<td>"+(long_table+1)+"</td>"+
					"<td><input name='data[MedidasAdoptadas"+(long_table+1)+"][descripcion]' id='txtMedidasAdopDes"+(long_table+1)+"' value='' class='form-control'/>"+
				    "<input name='data[MedidasAdoptadas"+(long_table+1)+"][ca_id]' type='hidden' id='hiddenCierreActa"+(long_table+1)+"' value='' class='form-control'/></td>"+
					"</tr>";

		$('#table-mc-inf tr:last').after(new_row);
	});
	
});