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
	        $("#txtEmpresaid").remove();
	        $("#txtEmpresa2").after("<input name='data[EmpresaActa][empresa_id]' type='hidden' value='"+ suggestions.id +"' id='txtEmpresaid'>");
	    },
	    onInvalidateSelection: function () {
	  	  $("#txtEmpresaid").remove();
	  	  $("#txtEmpresa2").after("<input name='data[EmpresaActa][empresa_id]' type='hidden' value='' id='txtEmpresaid'>");	
	    }
	});
	
	/* Autcomplete Resposable de la actividad 1 y 2 */
	$('#txtResAct1').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResActId1").remove();
	        $("#txtResAct1").after("<input name='data[ResponsableAct1][res_act_id1]' type='hidden' value='"+ suggestions.id +"' id='hiddenResActId1'>");

	        //Poblando el DNI
	        trabajador_id = $('#hiddenResActId1').val();
	        attr_id_dni = '#txtDniResAct1';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResActId1").remove();
	  	  $("#txtResAct1").after("<input name='data[ResponsableAct1][res_act_id1]' type='hidden' value='' id='hiddenResActId1'>");
	  	  $('#txtDniResAct1').removeAttr('disabled');
	  	  $('#txtDniResAct1').val('');
	    }
	});

	$('#txtResAct2').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResActId2").remove();
	        $("#txtResAct2").after("<input name='data[ResponsableAct2][res_act_id]' type='hidden' value='"+ suggestions.id +"' id='hiddenResActId2'>");

	        //Poblando el DNI
	        trabajador_id = $('#hiddenResActId2').val();
	        attr_id_dni = '#txtDniResAct2';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResActId2").remove();
	  	  $("#txtResAct2").after("<input name='data[ResponsableAct2][res_act_id]' type='hidden' value='' id='hiddenResActId2'>");
	  	  $('#txtDniResAct2').removeAttr('disabled');
	  	  $('#txtDniResAct2').val('');
	    }
	});

	/* Autcompletes Resposables de la Supervisión 1 y 2 */
	$('#txtResSup1').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResSupId1").remove();
	        $("#txtResSup1").after("<input name='data[ResponsableSup1][res_sup_id]' type='hidden' value='"+ suggestions.id +"' id='hiddenResSupId1'>");

	      //Poblando el DNI
	        trabajador_id = $('#hiddenResSupId1').val();
	        attr_id_dni = '#txtDniRespSup1';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResSupId1").remove();
	  	  $("#txtResSup1").after("<input name='data[ResponsableSup1][res_sup_id]' type='hidden' value='' id='hiddenResSupId1'>");

	  	  $('#txtDniRespSup1').removeAttr('disabled');
	  	  $('#txtDniRespSup1').val('');	
	    }
	});

	$('#txtResSup2').autocomplete({
	    //lookup: countries,
	    serviceUrl: env_webroot_script + 'actas/ajax_list_trabajador',
	    onSelect: function (suggestions) {
	        $("#hiddenResSupId2").remove();
	        $("#txtResSup2").after("<input name='data[ResponsableSup2][res_sup_id]' type='hidden' value='"+ suggestions.id +"' id='hiddenResSupId2'>");

	      //Poblando el DNI
	        trabajador_id = $('#hiddenResSupId2').val();
	        attr_id_dni = '#txtDniRespSup2';
	        loadDniByTrabajador(trabajador_id, attr_id_dni);
	    },
	    onInvalidateSelection: function () {
	  	  $("#hiddenResSupId2").remove();
	  	  $("#txtResSup2").after("<input name='data[ResponsableSup2][res_sup_id]' type='hidden' value='' id='hiddenResSupId2'>");

	  	  $('#txtDniRespSup2').removeAttr('disabled');
	  	  $('#txtDniRespSup2').val('');	
	    }
	});

	for (i = 1; i <= 11; i++) { 
			  cadena_name_id = "#Trabajador"+ i;
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
					    
				        $(cadena_hidden_id).remove();
				        $(this).after("<input name='data[TrabajadorActa][trabajador_id"+index_current+"]' type='hidden' value='"+ suggestions.id +"' id='txtTrabajadorid"+index_current+"'>");

				        loadActividadByTrabajador(suggestions.id, index_current); 
				    },
				    onInvalidateSelection: function () {
				  	    $(cadena_hidden_id).remove();
				  	    $(this).after("<input name='data[TrabajadorActa][trabajador_id"+index_current+"]' type='hidden' value='' id='txtTrabajadorid"+index_current+"'>");
				    }
				});
	}

	for (i = 1; i <= 11; i++) { 
		  cadena_name_id = "#Actividad"+ i;
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
				    
			        $(cadena_hidden_id).remove();
			        $(this).after("<input name='data[TrabajadorActividad][actividad_id"+index_current+"]' type='hidden' value='"+ suggestions.id +"' id='HiddenActividadid"+index_current+"'>");
			    },
			    onInvalidateSelection: function () {
			  	    $(cadena_hidden_id).remove();
			  	    $(this).after("<input name='data[TrabajadorActividad][actividad_id"+index_current+"]' type='hidden' value='' id='HiddenActividadid"+index_current+"'>");
			    }
			});
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

	function loadActividadByTrabajador(trabajador_id, index){
		element_actividad = '#Actividad'+index;
		element_actividad_hidden = '#HiddenActividadid'+index;
		var actividad = $("element_actividad").val(); 
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

	/*$.each($('.txt-trabajador'), function(index) {
		  index_input = (index + 1);
		  cadena_name_id = "#Trabajador"+ index_input;
		  cadena_hidden_id = "#txtTrabajadorid"+ index_input;
		  $(cadena_name_id).autocomplete({
			    //lookup: countries,
			    serviceUrl: 'ajax_list_trabajador',
			    onSelect: function (suggestions) {
			        $(cadena_hidden_id).remove();
			        $(cadena_name_id).after("<input name='data[TrabajadorActa][trabajador_id]' type='hidden' value='"+ suggestions.id +"' id='txtTrabajadorid"+index_input+"'>");
			    },
			    onInvalidateSelection: function () {
			  	  $(cadena_hidden_id).remove();
			  	  $(cadena_name_id).after("<input name='data[TrabajadorActa][trabajador_id]' type='hidden' value='' id='txtTrabajadorid"+index_input+"'>");	
			    }
			});
	});*/
})
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Editar Informe</h2>
	</div>
</div>
<hr />
<div class="div-crear-acta form" id="div-crear-acta">
	<?php echo $this->Form->create('Acta',array('method'=>'post', 'id'=>'add_edit_acta'));?>
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
								<td colspan=2 style="vertical-align: middle">Actividad: <?php echo $this->Form->input('actividad', array('div' => false, 'label' => false, 'class'=> 'txtActividad form-control','id' =>'txtActividadActa','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
							</tr>
							<tr>
								<td>Empresa:<input name="data[EmpresaActa][empresa]"
									class="txtEmpresa2 form-control" id="txtEmpresa2" type="text"
									style="text-transform: uppercase;"
									onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $obj_acta->Empresa->getAttr('nombre'); ?>">
								</td>
								<input name='data[EmpresaActa][empresa_id]' type='hidden'
									value='<?php echo $obj_acta->Empresa->getID(); ?>' id='txtEmpresaid'>
								<td>Nro de Trabjadores: <?php echo $this->Form->input('nro_trabajadores', array('div' => false, 'label' => false, 'class'=> 'txtNroTrabajadores form-control','id' =>'txtNroTrabajadores')); ?>
								</td>
							</tr>
							<tr>
								<td colspan=2 style="vertical-align: middle">Lugar: <?php echo $this->Form->input('lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
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
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="dataTables-example">
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
							<?php 
							foreach ($obj_acta->ImpProtPersonale as $key => $obj_imp_prot_personal){
								echo "<tr>";
								echo "<td>".($key+1)."</td>";
								echo "<td style='width:28%;'><input name='data[TrabajadorActa".($key+1)."][nombre_trabajador]' id='Trabajador".($key+1)."' class='form-control txt-trabajador' value='". $obj_imp_prot_personal->Trabajadore->getAttr('apellido_nombre')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<input name='data[TrabajadorActa][trabajador_id".($key+1)."]' type='hidden' value='".$obj_imp_prot_personal->Trabajadore->getID()."' id='txtTrabajadorid".($key+1)."'>";
								echo "<td style='width:15%;'><input name='data[ActividadPersona".($key+1)."][actividad]' id='Actividad".($key+1)."' class='form-control' value='".$obj_imp_prot_personal->Actividade->getAttr('descripcion')."' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-1]' id='ni-".($key+1)."a' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-2]' id='ni-".($key+1)."b' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-3]' id='ni-".($key+1)."c' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-4]' id='ni-".($key+1)."d' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-5]' id='ni-".($key+1)."e' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-6]' id='ni-".($key+1)."f' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-7]' id='ni-".($key+1)."g' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								echo "</tr>";
							}
							for ($i = ($key+1); $i <= 10; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:28%;'><input name='data[TrabajadorActa".$i."][nombre_trabajador]' id='Trabajador".$i."' class='form-control txt-trabajador' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<input name='data[TrabajadorActa][trabajador_id".$i."]' type='hidden' value='' id='txtTrabajadorid".$i."'>";
								    echo "<td style='width:15%;'><input name='data[ActividadPersona".$i."][actividad]' id='Actividad".$i."' class='form-control' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<input name='data[TrabajadorActividad][actividad_id".$i."]' type='hidden' value='' id='HiddenActividadid".$i."'>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-1]' id='ni-".$i."a' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-2]' id='ni-".$i."b' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-3]' id='ni-".$i."c' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-4]' id='ni-".$i."d' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-5]' id='ni-".$i."e' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-6]' id='ni-".$i."f' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-7]' id='ni-".$i."g' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
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
							<?php 
							for ($i = 1; $i <= 4; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:14%;'><input name='data[UnidadMovil".$i."][nro_placa]' id='PlacaActa".$i."' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<td style='width:15%;'><select name='data[TipoUnidadMovil".$i."][vehiculo_id]' id='TipoVehiculoActa".$i."' class='form-control'>";
								    if (isset($list_all_tipo_vehiculos)){
											foreach ($list_all_tipo_vehiculos as $list_all_tipo_vehiculo => $des):
											echo "<option value = ".$list_all_tipo_vehiculo.">".$des."</option>";
											endforeach;
										}
										echo "</select></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-1]' id='ni-".$i."a' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-2]' id='ni-".$i."b' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-3]' id='ni-".$i."c' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-4]' id='ni-".$i."d' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-5]' id='ni-".$i."e' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-6]' id='ni-".$i."f' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-7]' id='ni-".$i."g' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-8]' id='ni-".$i."h' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
										echo "<td><input name='data[UnidadNorma][ni-".$i."-9]' id='ni-".$i."i' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
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
							for ($i = 1; $i <= 5; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:89%;'><input name='data[ActoSubestandar".$i."][descripcion]' id='txtActoSubDes".$i."' class='form-control'/></td>";
								    echo "<td><input name='data[ActoSubestandar".$i."][ni]' id='txtActoSubNi".$i."' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'></td>";
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
							for ($i = 1; $i <= 5; $i++) {
								    echo "<tr>";
								    echo "<td style='width:4%;'>".$i."</td>";
								    echo "<td style='width:89%;'><input name='data[CondiSubestandar".$i."][descripcion]' id='txtCondiSubDes".$i."' class='form-control'/></td>";
								    echo "<td><input name='data[CondiSubestandar".$i."][ni]' id='txtCondiSubNi".$i."' class='form-control' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'></td>";
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
									id='txtResAct1' class='form-control'
									style='text-transform: uppercase;'
									onkeyup='javascript:this.value=this.value.toUpperCase();' />
								</td>
								<input name='data[ResponsableAct1][res_act_id1]' type='hidden'
									value='' id='hiddenResActId1'>
								<td style='width:35%;'>Nombre:<input name='data[ResponsableSup1][nom_res_sup]'
									id='txtResSup1' class='form-control'
									style='text-transform: uppercase;'
									onkeyup='javascript:this.value=this.value.toUpperCase();' />
								</td>
								<input name='data[ResponsableSup1][res_sup_id]' type='hidden'
									value='' id='hiddenResSupId1'>
							</tr>
							<tr>
								<td>DNI:<input name='data[ResponsableAct1][dni_res_act]'
									id='txtDniResAct1' class='form-control' maxlength=8 />
								</td>
								<td>DNI:<input name='data[ResponsableSup1][dni_res_sup]'
									id='txtDniRespSup1' class='form-control' maxlength=8 />
								</td>
							</tr>
						</table>
					</div>
					<?php echo utf8_encode('(Ver parte posterior de la hoja) Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
				</div>
			</div>
		</div>
	</div>


	<!-- Responsables - Posterior Corrección -->
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
						for ($i = 1; $i <= 7; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td><input name='data[MedidasAdoptadas".$i."][descripcion]' id='txtMedidasAdopDes".$i."' class='form-control'/></td>";
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
									onkeyup='javascript:this.value=this.value.toUpperCase();' />
								</td>
								<input name='data[ResponsableAct2][res_act_id]' type='hidden'
									value='' id='hiddenResActId2'>
								<td style='width:35%;'>Nombre:<input name='data[ResponsableSup2][nom_res_sup]'
									id='txtResSup2' class='form-control'
									style='text-transform: uppercase;'
									onkeyup='javascript:this.value=this.value.toUpperCase();' />
								</td>
								<input name='data[ResponsableSup2][res_sup_id]' type='hidden'
									value='' id='hiddenResSupId2'>
							</tr>
							<tr>
								<td>DNI:<input name='data[ResponsableAct2][dni_res_act]'
									id='txtDniResAct2' class='form-control' maxlength=8 />
								</td>
								<td>DNI:<input name='data[ResponsableSup2][dni_res_sup]'
									id='txtDniRespSup2' class='form-control' maxlength=8 />
								</td>
							</tr>
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