<script>
/*   https://www.devbridge.com/sourcery/components/jquery-autocomplete/    
 *  https://github.com/devbridge/jQuery-Autocomplete/issues/75

	***	Formato de Json recivido para Autocomplete
    var countries = [
		                 { value: 'Andorra', data: 'AD' },
		                 // ...
		                 { value: 'Zimbabwe', data: 'ZZ' }
		              ];
*/
$(document).ready(function(){

	/*$('#txtFecha').datepicker(
		{
			changeYear: true, 
			dateFormat: 'dd-mm-yy',
			minDate: new Date(1924, 1 - 1, 1),
			maxDate: new Date()
		});*/


	/* Autcomplete Empresa */
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
	$.each($('.txt-trabajador'), function(index) {
		index_input = (index + 1);
		cadena_name_id = "#Trabajador"+ index_input;
		name_class_ni = ".txt-ni"+ index_input;
			  $(cadena_name_id).autocomplete({
				    //lookup: countries,
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
					//alert(cadena_hidden_trab_id);
				    if($(cadena_hidden_trab_id).val() == ''){
				    	$(this).val('');
				    }
				 })

			/* AUTOCOMPLETAR DE NORMAS INCUMPLIDAS DENTRO DEL EACH DE TRABAJADORES*/
			
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

	/* AUTOCOMPLETE ACTIVIDADES */

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

	/* AUTOCOMPLETE NRO PLACA */

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


	/* AUTOCOMPLETE NORMAS INCUM ACTOS SUBESTANDARES */

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

	/* AUTOCOMPLETE NORMAS INCUM CONDICIONES SUBESTANDARES */

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
	//$( ".add-more-row-implement").click(function() {
		$("#div-ipp .add-more-row-implement").bind("click", function(e){
		long_table = $('#table-ipp tbody tr').length;
		
		var new_row = "<tr class='blog-test'>"+
					  "<td>"+(long_table+1)+"</td>" +
					  "<td style='width:28%;'><input name='data[TrabajadorActa"+(long_table+1)+"][nombre_trabajador]' id='Trabajador"+(long_table+1)+"' class='form-control txt-trabajador' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' autocomplete='off'/>" +
					  "<input name='data[TrabajadorActa][trabajador_id"+(long_table+1)+"]' type='hidden' value='' id='txtTrabajadorid"+(long_table+1)+"'></td>"+
					  "<td style='width:15%;'><input name='data[ActividadPersona"+(long_table+1)+"][actividad]' id='Actividad"+(long_table+1)+"' class='form-control txt-actividad' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[TrabajadorActividad][actividad_id"+(long_table+1)+"]' type='hidden' value='' id='HiddenActividadid"+(long_table+1)+"'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-1]' id='ni-"+(long_table+1)+"-1' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-1]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-1'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-2]' id='ni-"+(long_table+1)+"-2' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-2]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-2'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-3]' id='ni-"+(long_table+1)+"-3' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-3]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-3'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-4]' id='ni-"+(long_table+1)+"-4' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-4]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-4'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-5]' id='ni-"+(long_table+1)+"-5' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-5]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-5'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-6]' id='ni-"+(long_table+1)+"-6' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-6]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-6'></td>" +

					  "<td style='width:7%;'><input name='data[NiActa][ni-"+(long_table+1)+"-7]' id='ni-"+(long_table+1)+"-7' class='form-control txt-ni"+(long_table+1)+"' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>" +
					  "<input name='data[NiActa][ni-id"+(long_table+1)+"-7]' type='hidden' value='' id='hiddenNid"+(long_table+1)+"-7'></td>" +
					  "</tr>";

		//$('#table-ipp tr:last').clone().appendTo('#myList');
		$('#table-ipp tr:last').after(new_row);
	});
	
})
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Registrar Nueva Acta</h2>
	</div>
</div>
<hr />
<div class="div-crear-acta form" id="div-crear-acta">
	<?php echo $this->Form->create('Acta',array('method'=>'post', 'id'=>'add_edit_acta','type'=>'file'));?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<tr>
								<td rowspan=3 style="vertical-align: middle; width: 15%">
									<div class="form-group input-group">
										<span class="input-group-addon"><?php echo utf8_encode('N°') ?>
										</span>
										<?php echo $this->Form->input('numero', array('div' => false, 'label' => false, 'class'=> 'txtNumero form-control','id' =>'txtNumero','maxlength' =>'7')); ?>
									</div>
								</td>
								<td style="vertical-align: middle; text-align: center;"><strong>FORMATO</strong>
								</td>
								<td><?php echo utf8_encode('Código:');?></td>
								<td><?php echo $this->Form->input('codigo', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo', 'value'=>'F23-08')); ?>
								</td>
							</tr>
							<tr>
								<td rowspan=2
									style="vertical-align: middle; text-align: center;"><strong><?php echo utf8_encode('ACTA DE SUPERVISIÓN SEGURIDAD Y SALUD EN EL TRABAJO'); ?>
								</strong></td>
								<td><?php echo utf8_encode('Versión:'); ?></td>
								<td><?php echo $this->Form->input('version', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo', 'value'=>'01/13-05-14')); ?>
								</td>
							</tr>
							<tr>
								<td><?php echo utf8_encode('Página')?></td>
								<td>1 de 1</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<tr>
								<td style="vertical-align: middle">Actividad: <?php echo $this->Form->input('actividad', array('div' => false, 'label' => false, 'class'=> 'txtActividad form-control','id' =>'txtActividadActa','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
								<td style="vertical-align: middle"><?php echo utf8_encode('Sector/Área'); ?>: <?php echo $this->Form->input('sector', array('div' => false, 'label' => false, 'class'=> 'txtSector form-control','id' =>'txtSectorInforme','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
							</tr>
							<tr>
								<td>Empresa:<input name="data[EmpresaActa][empresa]"
									class="txtEmpresa2 form-control" id="txtEmpresa2" type="text"
									style="text-transform: uppercase;"
									onkeyup="javascript:this.value=this.value.toUpperCase();">
									<input name='data[EmpresaActa][empresa_id]' type='hidden'
									value='' id='txtEmpresaid'>
								</td>
								<td>Nro de Trabjadores: <?php echo $this->Form->input('nro_trabajadores', array('div' => false, 'label' => false, 'class'=> 'txtNroTrabajadores form-control','id' =>'txtNroTrabajadores')); ?>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle">Lugar: <?php echo $this->Form->input('lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
								<td style="vertical-align: middle">UU.NN: <?php echo $this->Form->input('uunn', array('div' => false, 'label' => false, 'class'=> 'txtUunn form-control','id' =>'txtUunn','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
							</tr>
							<tr>
								<td colspan=2 style="vertical-align: middle">Obra: <?php echo $this->Form->input('obra', array('div' => false, 'label' => false, 'class'=> 'txtObra form-control','id' =>'txtObraActa','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle">Planeada: <input
									name="data[Acta][tipo]" type="radio" value="P" id="rbTipo1">
									Inopinada: <input name="data[Acta][tipo]" type="radio"
									value="I" id="rbTipo2">
								</td>
								<td>Fecha: <input name="data[Acta][fecha]"
									class="txtFecha form-control hasDatepicker" id="txtFecha"
									placeholder="dd-mm-aaaa" type="text">
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- IMPLEMENTOS DE PROTECCIÓN PERSONAL -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('IMPLEMENTOS DE PROTECCIÓN PERSONAL') ?>
									</th>
								</tr>
								<tr>
									<th><?php echo utf8_encode('N°'); ?></th>
									<th>Nombre del trabajador</th>
									<th>Actividad</th>
									<th colspan=7
										style="vertical-align: middle; text-align: center;">Norma
										Incumplica (Ver parte porterior de la hoja)</th>
								</tr>
							</thead>
							<tbody>
							<?php //debug($obj_acta->ImpProtPersonale);
							if(count($obj_acta->ImpProtPersonale)>0){
								$key = 0; 
							}else{
								$key= -1;
							}
							foreach ($obj_acta->ImpProtPersonale as $key => $obj_imp_prot_personal){
								//echo "<tr><td>".debug($obj_imp_prot_personal)."</td></tr>";
								echo "<tr>";
								echo "<td>".($key+1)."</td>";
								echo "<td style='width:28%;'><input name='data[TrabajadorActa".($key+1)."][nombre_trabajador]' id='Trabajador".($key+1)."' class='form-control txt-trabajador' value='". $obj_imp_prot_personal->Trabajadore->getAttr('apellido_nombre')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								echo "<input name='data[TrabajadorActa][trabajador_id".($key+1)."]' type='hidden' value='".$obj_imp_prot_personal->Trabajadore->getID()."' id='txtTrabajadorid".($key+1)."'>";
								echo "<input name='data[TrabajadorActa][ipp_id".($key+1)."]' type='hidden' value='".$obj_imp_prot_personal->getID()."' id='hiddenIppid".($key+1)."'></td>";
								echo "<td style='width:15%;'><input name='data[ActividadPersona".($key+1)."][actividad]' id='Actividad".($key+1)."' class='form-control' value='".$obj_imp_prot_personal->Actividade->getAttr('descripcion')."' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								echo "<input name='data[TrabajadorActividad][actividad_id".($key+1)."]' type='hidden' value='".$obj_imp_prot_personal->getAttr('actividad_id')."' id='HiddenActividadid".($key+1)."'></td>";
								
								$count_obj_ipp_ni = count($obj_imp_prot_personal->IppNormasIncumplida);
								if($count_obj_ipp_ni > 0){
									foreach($obj_imp_prot_personal->IppNormasIncumplida as $k =>$v){
										echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-".($k+1)."]' id='ni-".($key+1)."-".($k+1)."' class='form-control txt-ni".($key+1)."' value='".$v->Codigo->getAttr('codigo')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[NiActa][ni-id".($key+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('codigo_id')."' id='hiddenNid".($key+1)."-".($k+1)."'>";
										echo "<input name='data[IppNi][ippni-id".($key+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('id')."' id='hiddenIppNid".($key+1)."-".($k+1)."'></td>";
									}
									
									for($j= ($k+2); $j <=7; $j++){
										echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-".$j."]' id='ni-".($key+1)."-".$j."' class='form-control txt-ni".($key+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[NiActa][ni-id".($key+1)."-".$j."]' type='hidden' value='' id='hiddenNid".($key+1)."-".$j."'>";
										echo "<input name='data[IppNi][ippni-id".($key+1)."-".$j."]' type='hidden' value='' id='hiddenIppNid".($key+1)."-".$j."'></td>";
									}
									
								}else{
									/*for($c=1; $c <= $count_obj_ipp_ni ;$c++){
										echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-".$c."]' id='ni-".($key+1)."-".$c."' class='form-control txt-ni".($key+1)."' value='' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[NiActa][ni-id".($key+1)."-".$c."]' type='hidden' value='' id='hiddenNid".($key+1)."-".$c."'></td>";
									}*/
									
									for($x= 1; $x <=7; $x++){
										echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-".$x."]' id='ni-".($key+1)."-".$x."' class='form-control txt-ni".($key+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[NiActa][ni-id".($key+1)."-".$x."]' type='hidden' value='' id='hiddenNid".($key+1)."-".$x."'>";
										echo "<input name='data[IppNi][ippni-id".($key+1)."-".$x."]' type='hidden' value='' id='hiddenIppNid".($key+1)."-".$x."'></td>";
									}
								}
								
							}
							echo "</tr>";
							
							for ($i = ($key+2); $i <= 10; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:28%;'><input name='data[TrabajadorActa".$i."][nombre_trabajador]' id='Trabajador".$i."' class='form-control txt-trabajador' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								    echo "<input name='data[TrabajadorActa][trabajador_id".$i."]' type='hidden' value='' id='txtTrabajadorid".$i."'>";
								    echo "<input name='data[TrabajadorActa][ipp_id".$i."]' type='hidden' value='' id='hiddenIppid".$i."'></td>";
								    echo "<td style='width:15%;'><input name='data[ActividadPersona".$i."][actividad]' id='Actividad".$i."' class='form-control txt-actividad' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								    echo "<input name='data[TrabajadorActividad][actividad_id".$i."]' type='hidden' value='' id='HiddenActividadid".$i."'></td>";
								    
								    for($j= 1; $j <=7; $j++){
								    	echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-".$j."]' id='ni-".$i."-".$j."' class='form-control txt-ni".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								   		echo "<input name='data[NiActa][ni-id".$i."-".$j."]' type='hidden' value='' id='hiddenNid".$i."-".$j."'></td>";
								    }
								    echo "</tr>";
								}
								?>
							</tbody>
						</table>
						<a class="btn btn-primary add-more-row-implement">Agregar</a>
					</div>
					<?php echo utf8_encode('Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('EQUIPO DE PROTECCIÓN PERSONAL (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_epp', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'3', 'class'=> 'txtInfDes1 form-control','id' =>'txtInfDes1')); ?></td>
								</tr>
								<tr>
									<td>
									<?php echo $this->Form->input('foto',array('type' => 'file')); ?>
									<!-- <input name="data[IppFoto][foto]" type="file" id="fileIpp" /> -->
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('SEÑALIZACIÓN Y DELIMITACIÓN (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_se_de', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'2', 'class'=> 'txtInfDes2 form-control','id' =>'txtInfDes2')); ?></td>
								</tr>
								<tr>
									<td>
									<?php echo $this->Form->input('foto',array('type' => 'file')); ?>
									<!-- <input name="data[IppFoto][foto]" type="file" id="fileIpp" /> -->
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- UNIDADES MÓVILES -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<thead>
								<tr>
									<th colspan=12
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('UNIDADES MÓVILES') ?>
									</th>
								</tr>
								<tr>
									<th style="width: 6%;"
										style="vertical-align:middle; text-align: center;"><?php echo utf8_encode('N° T'); ?>
									</th>
									<th><?php echo utf8_encode('N° de Placa'); ?></th>
									<th><?php echo utf8_encode('Tipo Vehículo'); ?></th>
									<th colspan=9
										style="vertical-align: middle; text-align: center;">Norma
										Incumplica (Ver parte porterior de la hoja)</th>
								</tr>
							</thead>
							<?php //debug($obj_acta->ImpProtPersonale);
							if(count($obj_acta->UnidadesMovile)>0){
								$key2 = 0; 
							}else{
								$key2 = -1;
							}
							foreach ($obj_acta->UnidadesMovile as $key2 => $obj_uni_movil){
								//echo "<tr><td>".debug($obj_imp_prot_personal)."</td></tr>";
								echo "<tr>";
								echo "<td>".($key2 +1)."</td>";
								echo "<td style='width:14%;'><input name='data[UnidadMovil".($key2 +1)."][nro_placa]' id='PlacaActa".($key2 +1)."' value='".$obj_uni_movil->Vehiculo->getAttr('nro_placa')."' class='form-control txt-nro-placa' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								echo "<input name='data[UnidadMovil][nro_placa_id".($key2 +1)."]' type='hidden' value='".$obj_uni_movil->Vehiculo->getID()."' id='hiddenPlacaId".($key2 +1)."'>";
								echo "<input name='data[UnidadMovil][um_id".($key2 +1)."]' type='hidden' value='".$obj_uni_movil->getID()."' id='hiddenUmId".($key2 +1)."'></td>";
								echo "<td style='width:15%;'><input name='data[TipoUnidadMovil".($key2 +1)."][vehiculo]' id='TipoVehiculoActa".($key2 +1)."' value='".$obj_uni_movil->Vehiculo->TipoVehiculo->getAttr('descripcion')."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<input name='data[TipoUnidadMovil][vehiculo_id".($key2 +1)."]' type='hidden' value='' id='hiddenVehiculoid".($key2 +1)."'></td>";
								
								$count_obj_um_ni = count($obj_uni_movil->UmNormasIncumplida);
								if($count_obj_um_ni > 0){
									foreach($obj_uni_movil->UmNormasIncumplida as $k =>$v){
										echo "<td style='width:7%;'><input name='data[UnidadNorma][ni-".($key2+1)."-".($k+1)."]' id='ni-".($key2+1)."-".($k+1)."' class='form-control txt-ni".($key2+1)."' value='".$v->Codigo->getAttr('codigo')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[UnidadNorma][ni-id".($key2+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('codigo_id')."' id='hiddenPlacaNid".($key2+1)."-".($k+1)."'>";
										echo "<input name='data[UmNi][umni-id".($key2+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('id')."' id='hiddenUmNid".($key2+1)."-".($k+1)."'></td>";
									}
									
									for($j= ($k+2); $j <=9; $j++){
										echo "<td><input name='data[UnidadNorma][ni-".($key2+1)."-".$j."]' id='ni-placa-".($key2+1)."-".$j."' class='form-control txt-ni-placa".($key2+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[UnidadNorma][ni-id".($key2+1)."-".$j."]' type='hidden' value='' id='hiddenPlacaNid".($key2+1)."-".$j."'>";
										echo "<input name='data[UmNi][umni-id".($key2+1)."-".$j."]' type='hidden' value='' id='hiddenUmNid".($key2+1)."-".$j."'></td>";
									}
									
								}else{
									/*for($c=1; $c <= $count_obj_ipp_ni ;$c++){
										echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-".$c."]' id='ni-".($key+1)."-".$c."' class='form-control txt-ni".($key+1)."' value='' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[NiActa][ni-id".($key+1)."-".$c."]' type='hidden' value='' id='hiddenNid".($key+1)."-".$c."'></td>";
									}*/
									
									for($x= 1; $x <=7; $x++){
										echo "<td><input name='data[UnidadNorma][ni-".($key2+1)."-".$x."]' id='ni-placa-".($key2+1)."-".$x."' class='form-control txt-ni-placa".($key2+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										echo "<input name='data[UnidadNorma][ni-id".($key2+1)."-".$x."]' type='hidden' value='' id='hiddenPlacaNid".($key2+1)."-".$x."'>";
										echo "<input name='data[UmNi][umni-id".($key2+1)."-".$x."]' type='hidden' value='' id='hiddenUmNid".($key2+1)."-".$x."'></td>";
									}
								}
								
							}
							echo "</tr>";
							
							for ($i = ($key2+2); $i <= 4; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:14%;'><input name='data[UnidadMovil".$i."][nro_placa]' id='PlacaActa".$i."' class='form-control txt-nro-placa' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								    echo "<input name='data[UnidadMovil][nro_placa_id".$i."]' type='hidden' value='' id='hiddenPlacaId".$i."'>";
								    echo "<input name='data[UnidadMovil][um_id".$i."]' type='hidden' value='' id='hiddenUmId".$i."'></td>";
								    echo "<td style='width:15%;'><input name='data[TipoUnidadMovil".$i."][vehiculo]' id='TipoVehiculoActa".$i."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<input name='data[TipoUnidadMovil][vehiculo_id".$i."]' type='hidden' value='' id='hiddenVehiculoid".$i."'></td>";
										
										for($j= 1; $j <=9; $j++){
											echo "<td><input name='data[UnidadNorma][ni-".$i."-".$j."]' id='ni-placa-".$i."-".$j."' class='form-control txt-ni-placa".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
											echo "<input name='data[UnidadNorma][ni-id".$i."-".$j."]' type='hidden' value='' id='hiddenPlacaNid".$i."-".$j."'>";
											echo "<input name='data[UmNi][umni-id".$i."-".$j."]' type='hidden' value='' id='hiddenUmNid".$i."-".$j."'></td>";
										}
										echo "</tr>";
								}
								?>
						</table>
					</div>
					<?php echo utf8_encode('Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('UNIDADES MÓVILES (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_um', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'2', 'class'=> 'txtInfDes3 form-control','id' =>'txtInfDes3')); ?></td>
								</tr>
								<tr>
									<td>
									<?php echo $this->Form->input('foto',array('type' => 'file')); ?>
									<!-- <input name="data[IppFoto][foto]" type="file" id="fileIpp" /> -->
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	<!-- Actos subestandares -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<thead>
								<tr>
									<th style="width: 4%;"><?php echo utf8_encode('N°'); ?></th>
									<th style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Actos Subestándares (No incluye el no uso de implementos de protección personal)'); ?>
									</th>
									<th style="text-align: center;"><?php echo utf8_encode('NI'); ?>
									</th>
								</tr>
							</thead>
							<?php
							if(count($obj_acta->ActosSubestandare)>0){
								$key3 = 0;
							}else{
								$key3 = -1;
							}
							foreach ($obj_acta->ActosSubestandare as $key3 => $obj_act_sub){
								echo "<tr>";
								echo "<td>".($key3+1)."</td>";
								echo "<td style='width:89%;'><input name='data[ActoSubestandar".($key3+1)."][descripcion]' id='txtActoSubDes".($key3+1)."' value='".$obj_act_sub->getAttr('descripcion')."' class='form-control'/>";
								echo "<input name='data[ActoSubestandar".($key3+1)."][as-id]' id='hiddenActoSubId".($key3+1)."' type='hidden' class='form-control' value='".$obj_act_sub->getID()."'></td>";
								echo "<td><input name='data[ActoSubestandar".($key3+1)."][ni]' id='txtActoSubNi".($key3+1)."' class='form-control txt-acto-sub-ni' value='".$obj_act_sub->Codigo->getAttr('codigo')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								echo "<input name='data[ActoSubestandar".($key3+1)."][ni-id]' id='hiddenActoSubNid".($key3+1)."' type='hidden' class='form-control' value='".$obj_act_sub->getAttr('codigo_id')."'></td>";
								echo "</tr>";
							}
							
							
							for ($i = ($key3+2); $i <= 5; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:89%;'><input name='data[ActoSubestandar".$i."][descripcion]' id='txtActoSubDes".$i."' class='form-control'/>";
								    echo "<input name='data[ActoSubestandar".$i."][as-id]' id='hiddenActoSubId".$i."' type='hidden' class='form-control' value=''></td>";
								    echo "<td><input name='data[ActoSubestandar".$i."][ni]' id='txtActoSubNi".$i."' class='form-control txt-acto-sub-ni' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    echo "<input name='data[ActoSubestandar".$i."][ni-id]' id='hiddenActoSubNid".$i."' type='hidden' class='form-control' value=''></td>";
								    echo "</tr>";
								}
							?>
						</table>
					</div>
					<?php echo utf8_encode('Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Condiciones subestandares -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<thead>
								<tr>
									<th style="width: 35px;"><?php echo utf8_encode('N°'); ?></th>
									<th style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Condiciones Subestándares (No incluye implementos de Protección Personal y Unidades Móviles)'); ?>
									</th>
									<th style="text-align: center;"><?php echo utf8_encode('NI'); ?>
									</th>
								</tr>
							</thead>
							<?php
							if(count($obj_acta->CondicionesSubestandare)>0){
								$key4 = 0;
							}else{
								$key4 = -1;
							}
							
							foreach ($obj_acta->CondicionesSubestandare as $key4 => $obj_cond_sub){
								echo "<tr>";
								echo "<td style='width:4%;'>".($key4+1)."</td>";
								echo "<td style='width:89%;'><input name='data[CondiSubestandar".($key4+1)."][descripcion]' id='txtCondiSubDes".($key4+1)."' value='".$obj_cond_sub->getAttr('descripcion')."' class='form-control'/>";
								echo "<input name='data[CondiSubestandar".($key4+1)."][cs-id]' id='hiddenCondiSubId".($key4+1)."' type='hidden' class='form-control' value='".$obj_cond_sub->getID()."'></td>";
								echo "<td><input name='data[CondiSubestandar".($key4+1)."][ni]' id='txtCondiSubNi".($key4+1)."' class='form-control txt-cond-sub-ni' value='".$obj_cond_sub->Codigo->getAttr('codigo')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								echo "<input name='data[CondiSubestandar".($key4+1)."][ni-id]' id='hiddenCondiSubNid".($key4+1)."' type='hidden' class='form-control' value='".$obj_cond_sub->getAttr('codigo_id')."'></td>";
								echo "</tr>";
							}
							
							for ($i = ($key4+2); $i <= 5; $i++) {
								    echo "<tr>";
								    echo "<td style='width:4%;'>".$i."</td>";
								    echo "<td style='width:89%;'><input name='data[CondiSubestandar".$i."][descripcion]' id='txtCondiSubDes".$i."' class='form-control'/>";
								    echo "<input name='data[CondiSubestandar".$i."][cs-id]' id='hiddenCondiSubId".$i."' type='hidden' class='form-control' value=''></td>";
								    echo "<td><input name='data[CondiSubestandar".$i."][ni]' id='txtCondiSubNi".$i."' class='form-control txt-cond-sub-ni' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    echo "<input name='data[CondiSubestandar".$i."][ni-id]' id='hiddenCondiSubNid".$i."' type='hidden' class='form-control' value=''></td>";
								    echo "</tr>";
								}
								?>
						</table>
					</div>
					<?php echo utf8_encode('(Ver parte posterior de la hoja) Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('ACTOS Y CONDICIONES SUBESTÁNDARES (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_act_cond', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'4', 'class'=> 'txtInfDes4 form-control','id' =>'txtInfDes4')); ?></td>
								</tr>
								<tr>
									<td>
									<?php echo $this->Form->input('foto',array('type' => 'file')); ?>
									<!-- <input name="data[IppFoto][foto]" type="file" id="fileIpp" /> -->
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<!-- Responsables Previos Corrección -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<tr>
								<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la actividad'); ?>
								</td>
								<td rowspan="3" style="vertical-align: bottom;"><hr> Firma</td>
								<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la Supervisión de SST'); ?>
								</td>
								<td rowspan="3" style="vertical-align: bottom;"><hr> Firma</td>
							</tr>
							<tr>
								<td style='width:35%;'>Nombre: <input name='data[ResponsableAct1][nom_res_act]'
									id='txtResAct1' value='<?php //echo $obj_acta->Trabajadore1->getAttr('apellido_nombre'); ?>' class='form-control'
									style='text-transform: uppercase;'
									onkeyup='javascript:this.value=this.value.toUpperCase();' />
								</td>
								<input name='data[Acta][reponsable_act_id]' type='hidden'
									value='<?php //echo $obj_acta->Trabajadore1->getAttr('id'); ?>' id='hiddenResActId1'>
								<td style='width:35%;'>Nombre:<input name='data[ResponsableSup1][nom_res_sup]'
									id='txtResSup1' class='form-control'
									style='text-transform: uppercase;' value='<?php //echo $obj_acta->Trabajadore2->getAttr('apellido_nombre'); ?>'
									onkeyup='javascript:this.value=this.value.toUpperCase();' />
								</td>
								<input name='data[Acta][reponsable_sup_id]' type='hidden'
									value='<?php //echo $obj_acta->Trabajadore2->getAttr('id'); ?>' id='hiddenResSupId1'>
							</tr>
							<tr>
								<td>DNI:<input name='data[ResponsableAct1][dni_res_act]'
									id='txtDniResAct1' class='form-control' maxlength=8 value="<?php //echo $obj_acta->Trabajadore1->getAttr('nro_documento'); ?>"/>
								</td>
								<td>DNI:<input name='data[ResponsableSup1][dni_res_sup]'
									id='txtDniRespSup1' class='form-control' maxlength=8 value="<?php //echo $obj_acta->Trabajadore2->getAttr('nro_documento'); ?>" />
								</td>
							</tr>
						</table>
					</div>
					<?php echo utf8_encode('(Ver parte posterior de la hoja) Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
				</div>
			</div>
		</div>
	</div>


	<!-- CIERRE DEL ACTA && Responsables - Posterior Corrección -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover"
						id="dataTables-example">
						<thead>
							<tr>
								<th colspan=2
									style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('CIERRE DEL ACTA DE SUPERVISIÓN') ?>
								</th>
							</tr>
							<tr>
								<th style="width: 4%;"
									style="vertical-align:middle; text-align: center;"><?php echo utf8_encode('N°'); ?>
								</th>
								<th style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Medidas de Control Adoptadas'); ?>
								</th>
							</tr>
						</thead>
						<?php
						if(count($obj_acta->CierreActa)>0){
							$key5 = 0;
						}else{
							$key5 = -1;
						}
							
						foreach ($obj_acta->CierreActa as $key5 => $obj_cierre_acta){
							echo "<tr>";
							echo "<td>".($key5+1)."</td>";
							echo "<td><input name='data[MedidasAdoptadas".($key5+1)."][descripcion]' id='txtMedidasAdopDes".($key5+1)."' value='".$obj_cierre_acta->getAttr('descripcion')."' class='form-control'/>";
							echo "<input name='data[MedidasAdoptadas".($key5+1)."][ca_id]' type='hidden' id='hiddenCierreActa".($key5+1)."' value='".$obj_cierre_acta->getID()."' class='form-control'/></td>";
							echo "</tr>";
						}
						 
						for ($i = ($key5+2); $i <= 7; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td><input name='data[MedidasAdoptadas".$i."][descripcion]' id='txtMedidasAdopDes".$i."' value='' class='form-control'/>";
								    echo "<input name='data[MedidasAdoptadas".$i."][ca_id]' type='hidden' id='hiddenCierreActa".$i."' value='' class='form-control'/></td>";
								    echo "</tr>";
								}
								?>
					</table>

					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
							<tr>
								<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la Acción Correctiva'); ?>
								</td>
								<td rowspan="3" style="vertical-align: bottom;"><hr> Firma</td>
								<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la Supervisión de SST'); ?>
								</td>
								<td rowspan="3" style="vertical-align: bottom;"><hr> Firma</td>
							</tr>
							<tr>
								<td style='width:35%;'>Nombre: <input name='data[ResponsableAct2][nom_res_act]'
									id='txtResAct2' class='form-control'
									style='text-transform: uppercase;'
									onkeyup='javascript:this.value=this.value.toUpperCase();' value="<?php //echo $obj_acta->Trabajadore3->getAttr('apellido_nombre'); ?>"/>
								</td>
								<input name='data[Acta][reponsable_corr_id]' type='hidden'
									value='<?php //echo $obj_acta->Trabajadore3->getAttr('id'); ?>' id='hiddenResActId2'>
								<td style='width:35%;'>Nombre:<input name='data[ResponsableSup2][nom_res_sup]'
									id='txtResSup2' class='form-control'
									style='text-transform: uppercase;'
									onkeyup='javascript:this.value=this.value.toUpperCase();' value="<?php //echo $obj_acta->Trabajadore4->getAttr('apellido_nombre'); ?>"/>
								</td>
								<input name='data[Acta][reponsable_sup_corr_id]' type='hidden'
									value='<?php //echo $obj_acta->Trabajadore4->getAttr('id'); ?>' id='hiddenResSupId2'>
							</tr>
							<tr>
								<td>DNI:<input name='data[ResponsableAct2][dni_res_act]'
									id='txtDniResAct2' class='form-control' maxlength=8 value="<?php //echo $obj_acta->Trabajadore3->getAttr('nro_documento'); ?>"/>
								</td>
								<td>DNI:<input name='data[ResponsableSup2][dni_res_sup]'
									id='txtDniRespSup2' class='form-control' maxlength=8 value="<?php //echo $obj_acta->Trabajadore4->getAttr('nro_documento'); ?>"/>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th 
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('CONCLUSIONES (PARA EL INFORME)') ?>
									</th>
									<th
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('RECOMENDACIONES (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_conclusion', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txtInfDes5 form-control','id' =>'txtInfDes5')); ?></td>
									<td><?php echo $this->Form->input('info_des_rec', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txtInfDes6 form-control','id' =>'txtInfDes6')); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
	<div class="row" style="text-align: center;">
		<div class="col-md-12">
			<button type="button"
				class="btn btn-large btn-success btn_crear_acta_trigger"
				style="margin-right: 17px;">
				<?php echo __('Guardar'); ?>
			</button>
			<button type="button" class="btn btn-large btn-cancelar-crear-acta">
				<?php echo __('Cancelar');?>
			</button>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
<hr>
</div>