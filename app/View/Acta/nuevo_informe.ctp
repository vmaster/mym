<script>
$(document).ready(function(){
	  $('#ni').tooltip();
	  $('#na').tooltip();

	  bkLib.onDomLoaded(function() {
			 new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('txtConclusiones'); 
			 new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('txtRecomendaciones');
			 new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('txtMedControl');
	  });
		
})
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Crear un Nuevo Informe</h2>
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
								<td rowspan=3 style="vertical-align: middle; width: 22%">
									<div class="form-group input-group" style="margin-bottom: -13px;">
										<span class="input-group-addon"><label id="ni" data-toggle="tooltip" title="N&uacute;mero de informe"><?php echo utf8_encode('N° I') ?></label>
										</span>
										<?php echo $this->Form->input('num_informe', array('div' => false, 'label' => false, 'class'=> 'txtNumero form-control','id' =>'txtNumero','value'=>(isset($codigo_completo))? $codigo_completo: '')); ?>
									</div>
									<br>									
									<div class="form-group input-group">
										<span class="input-group-addon"><label id="na" data-toggle="tooltip" title="N&uacute;mero de Acta"><?php echo utf8_encode('N° A') ?></label>
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
								<td><?php echo utf8_encode('Informe Referencia')?></td>
								<td><select name="data[Acta][acta_referencia]"
									class="cbo-acta-refer-select2 form-control">
										<?php 
										if (isset($list_all_actas)){
											echo "<option></option>";
											foreach ($list_all_actas as $id => $acta):
											echo "<option value = ".$acta['Acta']['id'].">".$acta['Acta']['num_informe']."</option>";
										endforeach;
										}
										?>
								</select></td>
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
								<td style="vertical-align: middle; width: 55%;">Actividad: <?php echo $this->Form->input('actividad', array('div' => false, 'label' => false, 'class'=> 'txtActividad form-control','id' =>'txtActividadActa','maxlength'=>'200')); ?>
								</td>
								<td style="vertical-align: middle" colspan=3><?php echo utf8_encode('Sector'); ?>: <?php echo $this->Form->input('sector', array('div' => false, 'label' => false, 'class'=> 'txtSector form-control','id' =>'txtSectorInforme','maxlength'=>'200')); ?>
								</td>
							</tr>
							<tr>
								<td>Empresa:<br>
								<span style="display: inline-flex;">
								<select name="data[Acta][empresa_id]"
									class="cbo-empresas-select2 form-control">
										<?php 
										if (isset($list_all_empresas)){
										echo "<option></option>";
										foreach ($list_all_empresas as $id => $des):
										echo "<option value = ".$id.">".$des."</option>";
										endforeach;
										}
										?>
								</select>
								&nbsp;
								<a href="#myModalAddEmpresa" class="btn btn-primary" style="height: 28px;" role="button" data-toggle="modal" id="btn-open-create-empresa">...</a>
								</span>
								</td>
								<td colspan=3>Nro de Trabjadores: <?php echo $this->Form->input('nro_trabajadores', array('div' => false, 'label' => false, 'class'=> 'txtNroTrabajadores form-control','id' =>'txtNroTrabajadores')); ?>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle">Lugar: <?php echo $this->Form->input('lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','maxlength'=>'200')); ?>
								</td>
								<td style="vertical-align: middle" colspan=3>UU.NN:<br>
								<?php //echo $this->Form->input('uunn', array('div' => false, 'label' => false, 'class'=> 'txtUunn form-control','id' =>'txtUunn','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								<select name="data[Acta][uunn_id]"
									class="cbo-uunn-select2 form-control">
										<?php 
										if (isset($list_all_unidades_negocios)){
											echo "<option></option>";
											foreach ($list_all_unidades_negocios as $id => $des):
												echo "<option value = ".$id.">".$des."</option>";
											endforeach;
										}
										?>
								</select>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle">Obra: <?php echo $this->Form->input('obra', array('div' => false, 'label' => false, 'class'=> 'txtObra form-control','id' =>'txtObraActa','maxlength'=>'200')); ?>
								</td>
								<td style="vertical-align: middle" colspan=2>
								Empresa supervisada al servicio de:
								<div class="radio">
										<label> MyM <input name="rbtLugar" type="radio" value="M" id="rbMym" checked>
										</label>
								</div>
								<div class="radio" style="display: -webkit-inline-box">
									<label>Otro <input name="rbtLugar" type="radio" value="O" id="rbOtro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?php echo $this->Form->input('empresa_supervisora', array('div' => false, 'label' => false, 'class'=> 'txtEmpSup form-control','id' =>'txtEmpSup', 'type' =>'text', 'style' => 'display:none', 'value'=>'MyM')); ?>
									</label>
								</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle" width="10%">Planeada: <input
									name="data[Acta][tipo]" type="radio" value="P" id="rbTipo1">
									Inopinada: <input name="data[Acta][tipo]" type="radio"
									value="I" id="rbTipo2">
								</td>
								<td style="vertical-align: middle" width="40%">&Aacute;rea:
									<select name="data[Acta][tipo_lugar_id]"
									class="form-control">
										<?php 
										if (isset($list_all_tipo_lugares)){
											foreach ($list_all_tipo_lugares as $id => $des):
												echo "<option value = ".$id.">".utf8_encode($des)."</option>";
											endforeach;
										}
										?>
									</select>
								</td>
								<td width="50%">Fecha: <input type="text" name="data[Acta][fecha]" id="txtFechaActa" class="form-control" placeholder="dd-mm-aaaa" value="<?php echo date('d-m-Y'); ?>">
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
							id="table-ipp-inf">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('IMPLEMENTOS DE PROTECCIÓN PERSONAL') ?>
									</th>
								</tr>
								<tr>
									<th><?php echo utf8_encode('N°'); ?></th>
									<th>Nombre del trabajador</th>
									<th>Cargo</th>
									<th colspan=7
										style="vertical-align: middle; text-align: center;">Normas
										Incumplidas (Ver parte posterior de la hoja)</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							for ($i = 1; $i <= 10; $i++) {
								    echo "<tr>";
								    echo "<td style='width:5%;'>".$i."</td>";
								    echo "<td style='width:25%;'>";
								    echo "<span style='display: inline-flex; width: 100%;'>";
								    echo "<select name='data[TrabajadorActa][".$i."][trabajador_id]' class='cbo-trabajadores-select2 form-control' id='Trabajador".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
							 	    if (isset($list_all_trabajadores)){
										echo "<option></option>";
								    	foreach ($list_all_trabajadores as $id => $nom):
								    	echo "<option value = ".$id.">".$nom."</option>";
								    	endforeach;
								    }
									echo "</select>";
									echo "&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-trabajador' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-trabajador".$i."'>...</a></span>";
									echo "</td>";
									echo "<td style='width:30%;'><select name='data[TrabajadorActa][".$i."][actividad_id]' class='cbo-actividades-select2 form-control' id='Actividad".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
									if (isset($list_all_actividades)){
										echo "<option>--Cargo--</option>";
										foreach ($list_all_actividades as $id => $des):
										echo "<option value = ".$id.">".$des."</option>";
										endforeach;
									}
									echo "</select></td>";
								   		echo "<td><select name='data[NiActa][".$i."][]' class='cbo-nincumplidas-select2 form-control' multiple='multiple'>";
								   		echo "<option></option>";
								   		if (isset($list_all_codigos)){
								   			foreach ($list_all_codigos as $id => $cod):
								   			echo "<option value = ".$id.">".$cod."</option>";
								   			endforeach;
								   		}
								   		echo "</select></td>";
								    echo "</tr>";
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="row" id ="div-btn-add-ipp">
						<div class="span3 col-md-12 col-sm-6 col-xs-6" style="text-align: right;">
							<a class="btn btn-primary add-more-row-ipp">+</a>
						</div>
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
							id="table-epp-rep">
							<thead>
								<tr>
									<th
										style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('EQUIPO DE PROTECCIÓN PERSONAL') ?>
									</th>
									<th>
										Cumplimiento
									</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i<=2; $i++){?>
								<tr>
									<td><textarea name="data[Acta][cumplimiento_epp][<?php echo $i; ?>][info_des_epp]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"></textarea></td>
									<td>
										<select name= "data[Acta][cumplimiento_epp][<?php echo $i; ?>][alternativa]">
											<option value="2">--</option>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="row" id="div-btn-add-epp-rep">
							<div class="span3 col-md-12 col-sm-6 col-xs-6"
								style="text-align: right;">
								<a class="btn btn-primary add-more-row-epp-rep">+</a>
							</div>
						</div>
						<br>
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<tbody>
								<tr>
									<td>
									<?php //echo $this->Form->input('foto',array('type' => 'file')); ?>
									<div class="fileupload" data-type="FotoIpp">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
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
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="table-sd-rep">
							<thead>
								<tr>
									<th
										style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('SEÑALIZACIÓN Y DELIMITACIÓN') ?>
									</th>
									<th>
										Cumplimiento
									</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i<=2; $i++){?>
								<tr>
									<td><textarea name="data[Acta][cumplimiento_sd][<?php echo $i; ?>][info_des_se_de]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"></textarea></td>
									<td>
										<select name= "data[Acta][cumplimiento_sd][<?php echo $i; ?>][alternativa]">
											<option value="2">--</option>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="row" id="div-btn-add-sd-rep">
							<div class="span3 col-md-12 col-sm-6 col-xs-6"
								style="text-align: right;">
								<a class="btn btn-primary add-more-row-sd-rep">+</a>
							</div>
						</div>
						<br>
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<tbody>
								<tr>
									<td>
									<div class="fileupload" data-type="FotoSd">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
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
							id="table-um-inf">
							<thead>
								<tr>
									<th colspan=12
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('UNIDADES MÓVILES') ?>
									</th>
								</tr>
								<tr>
									<th style="vertical-align:middle; text-align: center;"><?php echo utf8_encode('N° T'); ?>
									</th>
									<th><?php echo utf8_encode('N° de Placa'); ?></th>
									<th><?php echo utf8_encode('Tipo Vehículo'); ?></th>
									<th style="vertical-align: middle; text-align: center;">Norma
										Incumplica (Ver parte porterior de la hoja)</th>
								</tr>
							</thead>
							<?php 
							for ($i = 1; $i <= 4; $i++) {
								    echo "<tr>";
								    echo "<td style='width:5%;'>".$i."</td>";
								    echo "<td style='width:25%;'>";
								    echo "<span style='display: inline-flex; width: 100%; margin-right: -20px;'>";
									echo "<select name='data[UnidadMovil][".$i."][nro_placa_id]' class='cbo-placas-select2 form-control' id='PlacaActa".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    if (isset($list_all_vehiculos)){
								    	echo "<option></option>";
								    	foreach ($list_all_vehiculos as $id => $pla):
								    	echo "<option value = ".$id.">".$pla."</option>";
								    	endforeach;
								    }
								    echo "</select>";
								    echo "<a href='#myModalAddVehiculo' class='btn btn-primary btn-open-modal-vehiculo' style='height: 28px; padding-right: 3px; padding-left: 3px;' role='button' data-toggle='modal' id='btn-open-create-vehiculo".$i."'>...</a></span>";
								    echo "</td>";
								    echo "<td style='width:25%;'><input name='data[UnidadMovil][".$i."][vehiculo]' id='TipoVehiculoActa".$i."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<input name='data[UnidadMovil][".$i."][vehiculo_id]' type='hidden' value='' id='hiddenVehiculoid".$i."'></td>";
										
										//for($j= 1; $j <=9; $j++){
											echo "<td><select name='data[UnidadNorma][".$i."][]' class='cbo-nincumplidas-select2 form-control' multiple='multiple' id='ni-".$i."' multiple='multiple' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
											echo "<option></option>";
											if (isset($list_all_codigos)){
												foreach ($list_all_codigos as $id => $cod):
												echo "<option value = ".$id.">".$cod."</option>";
												endforeach;
											}
											echo "</select></td>";
										//}
										echo "</tr>";
								}
							?>
						</table>
					</div>
					<div class="row" id ="div-btn-add-um">
						<div class="span3 col-md-12 col-sm-6 col-xs-6" style="text-align: right;">
							<a class="btn btn-primary add-more-row-um">+</a>
						</div>
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
							id="table-um-rep">
							<thead>
								<tr>
									<th
										style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('UNIDADES MÓVILES') ?>
									</th>
									<th>
										Cumplimiento
									</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i<=2; $i++){?>
								<tr>
									<td><textarea name="data[Acta][cumplimiento_um][<?php echo $i; ?>][info_des_um]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"></textarea></td>
									<td>
										<select name= "data[Acta][cumplimiento_um][<?php echo $i; ?>][alternativa]">
											<option value="2">--</option>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="row" id="div-btn-add-um-rep">
							<div class="span3 col-md-12 col-sm-6 col-xs-6"
								style="text-align: right;">
								<a class="btn btn-primary add-more-row-um-rep">+</a>
							</div>
						</div>
						<br>
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<tbody>
								<tr>
									<td>
									<div class="fileupload" data-type="FotoUm">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- DOCUMENTACIÓN DE SEGURIDAD -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-ipp">
						<table class="table table-striped table-bordered table-hover"
							id="table-ds-rep">
							<thead>
								<tr>
									<th
										style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('DOCUMENTACIÓN DE SEGURIDAD') ?>
									</th>
									<th>
										Cumplimiento
									</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i<=2; $i++){?>
								<tr>
									<td><textarea name="data[Acta][cumplimiento_ds][<?php echo $i; ?>][info_des_doc]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"></textarea></td>
									<td>
										<select name= "data[Acta][cumplimiento_ds][<?php echo $i; ?>][alternativa]">
											<option value="2">--</option>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="row" id="div-btn-add-ds-rep">
							<div class="span3 col-md-12 col-sm-6 col-xs-6"
								style="text-align: right;">
								<a class="btn btn-primary add-more-row-ds-rep">+</a>
							</div>
						</div>
						<br>
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<tbody>
								<tr>
									<td>
									<div class="fileupload" data-type="FotoDoc">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
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
					<div class="table-responsive" id="div-as">
						<table class="table table-striped table-bordered table-hover"
							id="table-as-rep">
							<thead>
								<tr>
									<th
										style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('ACTOS SUBESTÁNDARES') ?>
									</th>
									<th>
										Cumplimiento
									</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i<=2; $i++){?>
								<tr>
									<td><textarea name="data[Acta][cumplimiento_act][<?php echo $i; ?>][info_des_act]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"></textarea></td>
									<td>
										<select name= "data[Acta][cumplimiento_act][<?php echo $i; ?>][alternativa]">
											<option value="2">--</option>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="row" id="div-btn-add-as-rep">
							<div class="span3 col-md-12 col-sm-6 col-xs-6"
								style="text-align: right;">
								<a class="btn btn-primary add-more-row-as-rep">+</a>
							</div>
						</div>
						<br>
						<table class="table table-striped table-bordered table-hover">
						<tbody>	
								<tr>
									<td colspan=2>
									<div class="fileupload" data-type="FotoAct">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="table-responsive" id="div-cs">
						<table class="table table-striped table-bordered table-hover"
							id="table-cond-rep">
							<thead>
								<tr>
									<th
										style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('CONDICIONES SUBESTÁNDARES') ?>
									</th>
									<th>
										Cumplimiento
									</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i<=2; $i++){?>
								<tr>
									<td><textarea name="data[Acta][cumplimiento_cond][<?php echo $i; ?>][info_des_cond]" rows="2" class="txtInfDesCond4 form-control" id="txtInfDesCond4" cols="30"></textarea></td>
									<td>
										<select name= "data[Acta][cumplimiento_cond][<?php echo $i; ?>][alternativa]">
											<option value="2">--</option>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</td>
								</tr>
								<?php }?>
								</tbody>
						</table>
						<div class="row" id="div-btn-add-cond-rep">
							<div class="span3 col-md-12 col-sm-6 col-xs-6"
								style="text-align: right;">
								<a class="btn btn-primary add-more-row-cond-rep">+</a>
							</div>
						</div>
						<br>
						<table class="table table-striped table-bordered table-hover">
						<tbody>	
								<tr>
									<td colspan=2>
									<div class="fileupload" data-type="FotoCond">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
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
								<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la Supervisión de SST'); ?>
								</td>
							</tr>
							<tr>
								<td style='width:35%;'>Nombre:
								<?php
									echo "<span style='display: inline-flex; width: 100%;'>";
									echo "<select name='data[Acta][reponsable_act_id]' class='cbo-responsable-select2 form-control' id='ResId1' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
							 	    if (isset($list_all_trabajadores)){
										echo "<option></option>";
								    	foreach ($list_all_trabajadores as $id => $nom):
								    	echo "<option value = ".$id.">".$nom."</option>";
								    	endforeach;
								    }
									echo "</select>&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-responsable' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-resp1'>...</a></span></td>";
								?>
								<td style='width:35%;'>Nombre:
								<?php
									echo "<span style='display: inline-flex; width: 100%;'>";
									echo "<select name='data[Acta][reponsable_sup_id]' class='cbo-responsable-select2 form-control' id='ResId2' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
							 	    if (isset($list_all_trabajadores)){
										echo "<option></option>";
								    	foreach ($list_all_trabajadores as $id => $nom):
								    	echo "<option value = ".$id.">".$nom."</option>";
								    	endforeach;
								    }
									echo "</select>&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-responsable' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-resp2'>...</a></span></td>";
								?>
							</tr>
							<tr>
								<td>DNI:<input name='data[ResponsableAct1][dni_res_act]'
									id='txtDniRes1' class='form-control' maxlength=8 />
								</td>
								<td>DNI:<input name='data[ResponsableSup1][dni_res_sup]'
									id='txtDniRes2' class='form-control' maxlength=8 />
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
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('CONCLUSIONES') ?>
									</th>
									<th
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('RECOMENDACIONES') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr id="father-container1">
									<td><?php echo $this->Form->input('info_des_conclusion', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5','cols'=>'80', 'class'=> 'txt-conclusiones form-control','id' =>'txtConclusiones')); ?></td>
									<td><?php echo $this->Form->input('info_des_rec', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5','cols'=>'80', 'class'=> 'txt-recomendaciones form-control','id' =>'txtRecomendaciones')); ?></td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align: middle; text-align: center;"><strong>MEDIDAS DE CONTROL</strong></td>
								</tr>
								<tr id="father-container2">
									<td colspan="2"><?php echo $this->Form->input('info_des_med', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txt-med-control form-control','id' =>'txtMedControl')); ?></td>
								</tr>
								<tr>
									<td colspan="2">
									<?php //echo $this->Form->input('foto',array('type' => 'file')); ?>
									<div class="fileupload" data-type="FotoMed">
								        <!-- Redirect browsers with JavaScript disabled to the origin page -->
								        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
								        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								        <div class="row fileupload-buttonbar">
								            <div class="col-lg-7">
								                <!-- The fileinput-button span is used to style the file input field as button -->
								                <span class="btn btn-success fileinput-button">
								                    <i class="glyphicon glyphicon-plus"></i>
								                    <span>Add files...</span>
								                    <input type="file" name="files[]" multiple>
								                </span>
								                <button type="submit" class="btn btn-primary start">
								                    <i class="glyphicon glyphicon-upload"></i>
								                    <span>Start upload</span>
								                </button>
								                <button type="reset" class="btn btn-warning cancel">
								                    <i class="glyphicon glyphicon-ban-circle"></i>
								                    <span>Cancel upload</span>
								                </button>
								                <!-- The global file processing state -->
								                <span class="fileupload-process"></span>
								            </div>
								            <!-- The global progress state -->
								            <div class="col-lg-5 fileupload-progress fade">
								                <!-- The global progress bar -->
								                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
								                </div>
								                <!-- The extended global progress state -->
								                <div class="progress-extended">&nbsp;</div>
								            </div>
								        </div>
								        <!-- The table listing the files available for upload/download -->
								        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
								    </div>
									</td>
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

<!-- The template to display files available for upload -->
     <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td>
                {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
 <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" width="80px"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
						<input type="hidden" value="{%=file.name%}" name="data[{%=type%}][{%=file.name%}][Imagen][]">
						<textarea value="" rows="2"  name="data[{%=type%}][{%=file.name%}][Observacion][]" placeholder="Observaci&oacute;n"></textarea>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
 </script>
 
 <?php echo $this->Element('Empresa/modal_add_empresa'); ?>
 <?php echo $this->Element('Trabajadore/modal_add_trabajador'); ?>
 <?php echo $this->Element('Vehiculo/modal_add_vehiculo'); ?>
