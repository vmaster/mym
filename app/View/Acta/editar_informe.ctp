<div class="row">
	<div class="col-md-12">
		<h2>Editar Informe</h2>
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
								<td rowspan=3 style="vertical-align: middle; width: 22%">
									<div class="form-group input-group" style="margin-bottom: -13px;">
										<span class="input-group-addon"><?php echo utf8_encode('N° I') ?>
										</span>
										<?php echo $this->Form->input('num_informe', array('div' => false, 'label' => false, 'class'=> 'txtNumero form-control','id' =>'txtNumero','maxlength' =>'18','readonly'=>'readonly')); ?>
									</div>
									<br>
									<div class="form-group input-group">
										<span class="input-group-addon"><?php echo utf8_encode('N° A') ?>
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
								<td><?php echo utf8_encode('Acta Referencia')?></td>
								<td><select name="data[Acta][acta_referencia]"
									class="cbo-acta-refer-select2 form-control">
									<option></option>
										<?php 
										if (isset($list_all_actas)){
											foreach ($list_all_actas as $id => $num):
											if(isset($obj_acta) || isset($acta_id)){
												if($id == $obj_acta->getAttr('acta_referencia')){
													$selected = " selected = 'selected'";
												}else{
													$selected = "";
												}
					
											}else{
												$selected = "";
											}
											echo "<option value = ".$id.$selected.">".$num."</option>";
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
								<td style="vertical-align: middle; width: 55%;">Actividad: <?php echo $this->Form->input('actividad', array('div' => false, 'label' => false, 'class'=> 'txtActividad form-control','id' =>'txtActividadActa','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
								<td style="vertical-align: middle" colspan=3><?php echo utf8_encode('Sector/Área'); ?>: <?php echo $this->Form->input('sector', array('div' => false, 'label' => false, 'class'=> 'txtSector form-control','id' =>'txtSectorInforme','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
							</tr>
							<tr>
								<td>Empresa:<br>
								<span style="display: inline-flex;">
								<select name="data[Acta][empresa_id]"
									class="cbo-empresas-select2 form-control">
										<?php 
										if (isset($list_all_empresas)){
										foreach ($list_all_empresas as $id => $des):
											if(isset($obj_acta) || isset($acta_id)){
												if($id == $obj_acta->getAttr('empresa_id')){
													$selected = " selected = 'selected'";
												}else{
													$selected = "";
												}
					
											}else{
												$selected = "";
											}
										echo "<option value = ".$id.$selected.">".$des."</option>";
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
								<td style="vertical-align: middle">Lugar: <?php echo $this->Form->input('lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
								<td style="vertical-align: middle" colspan=3>UU.NN:<br>
								<?php //echo $this->Form->input('uunn', array('div' => false, 'label' => false, 'class'=> 'txtUunn form-control','id' =>'txtUunn','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								<select name="data[Acta][uunn_id]"
									class="cbo-uunn-select2 form-control">
								<?php 
									if (isset($list_all_unidades_negocios)){
										foreach ($list_all_unidades_negocios as $id => $des):
										if(isset($obj_acta) || isset($acta_id)){
											if($id == $obj_acta->getAttr('uunn_id')){
												$selected = " selected = 'selected'";
											}else{
												$selected = "";
											}
									
										}else{
											$selected = "";
										}
										echo "<option value = ".$id.$selected.">".$des."</option>";
										endforeach;
									}		
								?>
								</select>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle">Obra: <?php echo $this->Form->input('obra', array('div' => false, 'label' => false, 'class'=> 'txtObra form-control','id' =>'txtObraActa','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
								</td>
								<td style="vertical-align: middle" colspan=2>
								Empresa supervisada al servicio de:
									<div class="radio">
											<label> MyM <input name="rbtLugar" type="radio" value="M" id="rbMym" <?php echo ($obj_acta->getAttr('empresa_supervisora')=='MyM')? 'checked':'' ?>>
											</label>
									</div>
									<div class="radio" style="display: -webkit-inline-box">
									<?php if($obj_acta->getAttr('empresa_supervisora')!='MyM') $style_display=""; else  $style_display ="display:none"; ?>
										<label>Otro <input name="rbtLugar" type="radio" value="O" id="rbOtro" <?php echo ($obj_acta->getAttr('empresa_supervisora')!='MyM')? 'checked':'' ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo $this->Form->input('empresa_supervisora', array('div' => false, 'label' => false, 'class'=> 'txtEmpSup form-control','id' =>'txtEmpSup', 'type' =>'text', 'style' => $style_display)); ?>
										</label>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle">
									Planeada: <input
									name="data[Acta][tipo]" type="radio" value="P" id="rbTipo1" <?php echo ($obj_acta->getAttr('tipo') == 'P')? 'checked':''; ?>>
									Inopinada: <input name="data[Acta][tipo]" type="radio"
									value="I" id="rbTipo2" <?php echo ($obj_acta->getAttr('tipo') == 'I')? 'checked':''; ?>>
								</td>
								<td style="vertical-align: middle" width="40%">Tipo de Lugar:
									<select name="data[Acta][tipo_lugar_id]"
									class="form-control">
									<option>--Seleccione--</option>
										<?php 
										if (isset($list_all_tipo_lugares)){
											foreach ($list_all_tipo_lugares as $id => $des):
											if(isset($obj_acta) || isset($acta_id)){
												if($id == $obj_acta->getAttr('tipo_lugar_id')){
													$selected = " selected = 'selected'";
												}else{
													$selected = "";
												}
											}else{
												$selected = "";
											}
												echo "<option value = ".$id.$selected.">".utf8_encode($des)."</option>";
											endforeach;
										}
										?>
									</select>
								</td>
								<?php 
										$fecha = $obj_acta->getAttr('fecha');//1990-12-12
											
										if($fecha == '' || $fecha == NULL){
											$fecha_format = '';
										}else{
											$dd = substr($fecha,-2);
											$mm = substr($fecha, 5, 2);
											$yy = substr($fecha, 0, 4);
											$fecha_format = $dd.'-'.$mm.'-'.$yy;//12-12-1990
										}
								?>
								<td>Fecha: <input type="text" name="data[Acta][fecha]" id="txtFechaActa" class="form-control" placeholder="dd-mm-aaaa" value="<?php echo $fecha_format; ?>">
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
								//echo "<td style='width:28%;'><input name='data[TrabajadorActa".($key+1)."][nombre_trabajador]' id='Trabajador".($key+1)."' class='form-control txt-trabajador' value='". $obj_imp_prot_personal->Trabajadore->getAttr('apellido_nombre')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								//echo "<input name='data[TrabajadorActa][trabajador_id".($key+1)."]' type='hidden' value='".$obj_imp_prot_personal->Trabajadore->getID()."' id='txtTrabajadorid".($key+1)."'>";
								echo "<td style='width:28%;'>";
								echo "<span style='display: inline-flex; width: 100%;'>";
								echo "<select name='data[TrabajadorActa][".($key+1)."][trabajador_id]' class='cbo-trabajadores-select2 form-control' id='Trabajador".($key+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								if (isset($list_all_trabajadores)){
									foreach ($list_all_trabajadores as $id => $nom):
										if($id == $obj_imp_prot_personal->Trabajadore->getID()){
											$selected = " selected = 'selected'";
										}else{
											$selected = "";
										}
									
									echo "<option value = ".$id.$selected.">".$nom."</option>";
									endforeach;
								}
								echo "</select>";
								echo "<input name='data[TrabajadorActa][".($key+1)."][ipp_id]' type='hidden' value='".$obj_imp_prot_personal->getID()."' id='hiddenIppid".($key+1)."'>";
								echo "&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-trabajador' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-trabajador".($key+1)."'>...</a></span>";
								echo "</td>";
								
								echo "<td><select name='data[TrabajadorActa][".($key+1)."][actividad_id]' class='cbo-actividades-select2 form-control' id='Actividad".($key+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								if (isset($list_all_actividades)){
									foreach ($list_all_actividades as $id => $des):
									if($id == $obj_imp_prot_personal->getAttr('actividad_id')){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$id.$selected.">".$des."</option>";
									endforeach;
								}
								echo "</select></td>";
								
								$count_obj_ipp_ni = count($obj_imp_prot_personal->IppNormasIncumplida);
								if($count_obj_ipp_ni > 0){
									foreach($obj_imp_prot_personal->IppNormasIncumplida as $k =>$v){
										//echo "<td style='width:7%;'><input name='data[NiActa][ni-".($key+1)."-".($k+1)."]' id='ni-".($key+1)."-".($k+1)."' class='form-control txt-ni".($key+1)."' value='".$v->Codigo->getAttr('codigo')."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										//echo "<input name='data[NiActa][ni-id".($key+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('codigo_id')."' id='hiddenNid".($key+1)."-".($k+1)."'>";
										echo "<td style='width:7%;'><select name='data[NiActa][ni-id".($key+1)."-".($k+1)."]' class='cbo-nincumplidas-select2 form-control' id='Nid-".($key+1)."-".($k+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											if($id == $v->getAttr('codigo_id')){
												$selected = " selected = 'selected'";
											}else{
												$selected = "";
											}
											echo "<option value = ".$id.$selected.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";	
										echo "<input name='data[IppNi][ippni-id".($key+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('id')."' id='hiddenIppNid".($key+1)."-".($k+1)."'></td>";
									}
									
									for($j= ($k+2); $j <=7; $j++){
										echo "<td style='width:7%;'><select name='data[NiActa][ni-id".($key+1)."-".$j."]' class='cbo-nincumplidas-select2 form-control' id='Nid-".($key+1)."-".$j."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											echo "<option value = ".$id.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";
										echo "<input name='data[IppNi][ippni-id".($key+1)."-".$j."]' type='hidden' value='' id='hiddenIppNid".($key+1)."-".$j."'></td>";
									}
									
								}else{
									for($x= 1; $x <=7; $x++){
										echo "<td style='width:7%;'><select name='data[NiActa][ni-id".($key+1)."-".$x."]' class='cbo-nincumplidas-select2 form-control' id='Nid-".($key+1)."-".$x."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											echo "<option value = ".$id.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";
										echo "<input name='data[IppNi][ippni-id".($key+1)."-".$x."]' type='hidden' value='' id='hiddenIppNid".($key+1)."-".$x."'></td>";
									}
								}
								
							}
							echo "</tr>";
							
							for ($i = ($key+2); $i <= 10; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:28%;'>";
								    echo "<span style='display: inline-flex; width: 100%;'>";
								    echo "<select name='data[TrabajadorActa][".$i."][trabajador_id]' class='cbo-trabajadores-select2 form-control' id='Trabajador".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    echo "<option></option>";
								    if (isset($list_all_trabajadores)){
								    	foreach ($list_all_trabajadores as $id => $nom):
								    	echo "<option value = ".$id.">".$nom."</option>";
								    	endforeach;
								    }
								    echo "</select>";
								    echo "<input name='data[TrabajadorActa][".$i."][ipp_id]' type='hidden' value='' id='hiddenIppid".$i."'>";
								    echo "&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-trabajador' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-trabajador".$i."'>...</a></span>";
								    echo "</td>";
								    echo "<td><select name='data[TrabajadorActa][".$i."][actividad_id]' class='cbo-actividades-select2 form-control' id='Actividad".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    echo "<option>--Cargo--</option>";
								    if (isset($list_all_actividades)){
								    	foreach ($list_all_actividades as $id => $des):
								    	echo "<option value = ".$id.">".$des."</option>";
								    	endforeach;
								    }
								    echo "</select></td>";
								    
								    for($j= 1; $j <=7; $j++){
								    	//echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-".$j."]' id='ni-".$i."-".$j."' class='form-control txt-ni".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								   		//echo "<input name='data[NiActa][ni-id".$i."-".$j."]' type='hidden' value='' id='hiddenNid".$i."-".$j."'>";
								   		echo "<td style='width:7%;'><select name='data[NiActa][ni-id".$i."-".$j."]' class='cbo-nincumplidas-select2 form-control' id='Nid-".$id."-".$j."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											echo "<option value = ".$id.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";
								   		echo "<input name='data[IppNi][ippni-id".$i."-".$j."]' type='hidden' value='' id='hiddenIppNid".$i."-".$j."'></td>";
								    }
								    echo "</tr>";
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="row" id ="div-btn-add-ipp">
						<div class="span3 col-md-9 col-sm-6 col-xs-6">
							<?php echo utf8_encode('Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
						</div>
						<div class="span3 col-md-3 col-sm-6 col-xs-6" style="text-align: right;">
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
										<table role="presentation" class="table table-striped">
											<tbody class="files">
											<?php foreach($obj_acta->FotoIpp as $key => $obj_foto_ipp) {?> 
											<?php $file_name =$obj_foto_ipp->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
												<tr class="template-download fade in" foto_ipp="<?php echo $file_name_explode[0];?>">
													<td><span class="preview"> <a
															href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>"
															title="<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
															data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/thumbnail/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" width='80px'>
														</a>
														<textarea rows="2"  name="data[FotoIppUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_ipp->getAttr('observacion'); ?></textarea>
														<input type="hidden" value="<?php echo $obj_foto_ipp->getAttr('id'); ?>" name="data[FotoIppUpdate][<?php echo $key; ?>][id][]">
													</span>
													</td>
													<td>
														<p class="name">
															<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>"
																title="<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																data-gallery=""><?php echo $obj_foto_ipp->getAttr('file_name'); ?></a> 
														</p>
													</td>
													<td><span class="size">120.37 KB</span>
													</td>
													<td>
														<a data-url="<?php echo $obj_foto_ipp->getAttr('file_name');?>" data-foto_ipp="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-ipp">
															<i class="glyphicon glyphicon-trash"></i> <span>Delete</span>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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
										<table role="presentation" class="table table-striped">
											<tbody class="files">
											<?php foreach($obj_acta->FotoSd as $key => $obj_foto_sd) {?> 
											<?php $file_name =$obj_foto_sd->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
												<tr class="template-download fade in" foto_sd="<?php echo $file_name_explode[0];?>">
													<td><span class="preview"> <a
															href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_sd/<?php echo $obj_foto_sd->getAttr('file_name'); ?>"
															title="<?php echo $obj_foto_sd->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
															data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_sd/thumbnail/<?php echo $obj_foto_sd->getAttr('file_name'); ?>" width='80px'>
														</a>
														<textarea rows="2"  name="data[FotoSdUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_sd->getAttr('observacion'); ?></textarea>
														<input type="hidden" value="<?php echo $obj_foto_sd->getAttr('id'); ?>" name="data[FotoSdUpdate][<?php echo $key; ?>][id][]">
													</span>
													</td>
													<td>
														<p class="name">
															<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_sd/<?php echo $obj_foto_sd->getAttr('file_name'); ?>"
																title="<?php echo $obj_foto_sd->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																data-gallery=""><?php echo $obj_foto_sd->getAttr('file_name'); ?></a> 
														</p>
													</td>
													<td><span class="size">120.37 KB</span>
													</td>
													<td>
														<a data-url="<?php echo $obj_foto_sd->getAttr('file_name');?>" data-foto_sd="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-sd">
															<i class="glyphicon glyphicon-trash"></i> <span>Delete</span>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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
									<th style="width: 6%;"
										style="vertical-align:middle; text-align: center;"><?php echo utf8_encode('N° T'); ?>
									</th>
									<th><?php echo utf8_encode('N° de Placa'); ?></th>
									<th><?php echo utf8_encode('Tipo Vehículo'); ?></th>
									<th colspan=9
										style="vertical-align: middle; text-align: center;">Normas
										Incumplidas (Ver parte posterior de la hoja)</th>
								</tr>
							</thead>
							<?php //debug($obj_acta->ImpProtPersonale);
							if(count($obj_acta->UnidadesMovile)>0){
								$key2 = 0; 
							}else{
								$key2 = -1;
							}
							foreach ($obj_acta->UnidadesMovile as $key2 => $obj_uni_movil){
								echo "<tr>";
								echo "<td>".($key2 +1)."</td>";
								echo "<td style='width:14%;'>";
								echo "<span style='display: inline-flex; width: 100%; margin-right: -20px;'>";
								echo "<select name='data[UnidadMovil][".($key2 +1)."][nro_placa_id]' class='cbo-placas-select2 form-control' id='PlacaActa".($key2 +1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								if (isset($list_all_vehiculos)){
									echo "<option></option>";
									foreach ($list_all_vehiculos as $id => $pla):
									if($id == $obj_uni_movil->Vehiculo->getAttr('id')){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$id.$selected.">".$pla."</option>";
									endforeach;
								}
								echo "</select>";
								echo "<input name='data[UnidadMovil][".($key2 +1)."][um_id]' type='hidden' value='".$obj_uni_movil->getID()."' id='hiddenUmId".($key2 +1)."'>";
								echo "<a href='#myModalAddVehiculo' class='btn btn-primary btn-open-modal-vehiculo' style='height: 28px; padding-right: 3px; padding-left: 3px;' role='button' data-toggle='modal' id='btn-open-create-vehiculo".($key2 +1)."'>...</a></span>";
								echo "</td>";
								echo "<td style='width:15%;'><input name='data[UnidadMovil][".($key2 +1)."][vehiculo]' id='TipoVehiculoActa".($key2 +1)."' value='".$obj_uni_movil->Vehiculo->TipoVehiculo->getAttr('descripcion')."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								echo "<input name='data[UnidadMovil][".($key2 +1)."][vehiculo_id]' type='hidden' value='' id='hiddenVehiculoid".($key2 +1)."'></td>";
								
								$count_obj_um_ni = count($obj_uni_movil->UmNormasIncumplida);
								if($count_obj_um_ni > 0){
									foreach($obj_uni_movil->UmNormasIncumplida as $k =>$v){
										echo "<td><select name='data[UnidadNorma][ni-id".($key2+1)."-".($k+1)."]' class='cbo-nincumplidas-select2 form-control' id='ni-".($key2+1)."-".($k+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											if($id == $v->getAttr('codigo_id')){
												$selected = " selected = 'selected'";
											}else{
												$selected = "";
											}
											echo "<option value = ".$id.$selected.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";
										echo "<input name='data[UmNi][umni-id".($key2+1)."-".($k+1)."]' type='hidden' value='".$v->getAttr('id')."' id='hiddenUmNid".($key2+1)."-".($k+1)."'></td>";
									}
									
									for($j= ($k+2); $j <=9; $j++){
										//echo "<td><input name='data[UnidadNorma][ni-".($key2+1)."-".$j."]' id='ni-placa-".($key2+1)."-".$j."' class='form-control txt-ni-placa".($key2+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										//echo "<input name='data[UnidadNorma][ni-id".($key2+1)."-".$j."]' type='hidden' value='' id='hiddenPlacaNid".($key2+1)."-".$j."'>";
										echo "<td><select name='data[UnidadNorma][ni-id".($key2+1)."-".$j."]' class='cbo-nincumplidas-select2 form-control' id='ni-".($key2+1)."-".$j."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											echo "<option value = ".$id.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";
										echo "<input name='data[UmNi][umni-id".($key2+1)."-".$j."]' type='hidden' value='' id='hiddenUmNid".($key2+1)."-".$j."'></td>";
									}
									
								}else{
									for($x= 1; $x <=9; $x++){
										//echo "<td><input name='data[UnidadNorma][ni-".($key2+1)."-".$x."]' id='ni-placa-".($key2+1)."-".$x."' class='form-control txt-ni-placa".($key2+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
										//echo "<input name='data[UnidadNorma][ni-id".($key2+1)."-".$x."]' type='hidden' value='' id='hiddenPlacaNid".($key2+1)."-".$x."'>";
										echo "<td><select name='data[UnidadNorma][ni-id".($key2+1)."-".$x."]' class='cbo-nincumplidas-select2 form-control' id='ni-".($key2+1)."-".$x."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
										echo "<option></option>";
										if (isset($list_all_codigos)){
											foreach ($list_all_codigos as $id => $cod):
											echo "<option value = ".$id.">".$cod."</option>";
											endforeach;
										}
										echo "</select>";
										echo "<input name='data[UmNi][umni-id".($key2+1)."-".$x."]' type='hidden' value='' id='hiddenUmNid".($key2+1)."-".$x."'></td>";
									}
								}
								
							}
							echo "</tr>";
							
							for ($i = ($key2+2); $i <= 4; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    //echo "<td style='width:14%;'><input name='data[UnidadMovil".$i."][nro_placa]' id='PlacaActa".$i."' class='form-control txt-nro-placa' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
								    //echo "<input name='data[UnidadMovil][nro_placa_id".$i."]' type='hidden' value='' id='hiddenPlacaId".$i."'>";
								    echo "<td style='width:14%;'>";
								    echo "<span style='display: inline-flex; width: 100%; margin-right: -20px;'>";
								    echo "<select name='data[UnidadMovil][".$i."][nro_placa_id]' class='cbo-placas-select2 form-control' id='PlacaActa".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    if (isset($list_all_vehiculos)){
								    	echo "<option></option>";
								    	foreach ($list_all_vehiculos as $id => $pla):
								    	echo "<option value = ".$id.">".$pla."</option>";
								    	endforeach;
								    }
								    echo "</select>";
								    echo "<input name='data[UnidadMovil][".$i."][um_id]' type='hidden' value='' id='hiddenUmId".$i."'>";
								    echo "<a href='#myModalAddVehiculo' class='btn btn-primary btn-open-modal-vehiculo' style='height: 28px; padding-right: 3px; padding-left: 3px;' role='button' data-toggle='modal' id='btn-open-create-vehiculo".$i."'>...</a></span>";
								    echo "</td>";
								    echo "<td style='width:15%;'><input name='data[UnidadMovil][".$i."][vehiculo]' id='TipoVehiculoActa".$i."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
								    echo "<input name='data[UnidadMovil][".$i."][vehiculo_id]' type='hidden' value='' id='hiddenVehiculoid".$i."'></td>";
										
										for($j= 1; $j <=9; $j++){
											//echo "<td><input name='data[UnidadNorma][ni-".$i."-".$j."]' id='ni-placa-".$i."-".$j."' class='form-control txt-ni-placa".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
											//echo "<input name='data[UnidadNorma][ni-id".$i."-".$j."]' type='hidden' value='' id='hiddenPlacaNid".$i."-".$j."'>";
											echo "<td><select name='data[UnidadNorma][ni-id".$i."-".$j."]' class='cbo-nincumplidas-select2 form-control' id='ni-".$i."-".$j."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
											echo "<option></option>";
											if (isset($list_all_codigos)){
												foreach ($list_all_codigos as $id => $cod):
												echo "<option value = ".$id.">".$cod."</option>";
												endforeach;
											}
											echo "</select>";
											echo "<input name='data[UmNi][umni-id".$i."-".$j."]' type='hidden' value='' id='hiddenUmNid".$i."-".$j."'></td>";
										}
										echo "</tr>";
								}
								?>
						</table>
					</div>
					<div class="row" id ="div-btn-add-um">
						<div class="span3 col-md-9 col-sm-6 col-xs-6">
							<?php echo utf8_encode('Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
						</div>
						<div class="span3 col-md-3 col-sm-6 col-xs-6" style="text-align: right;">
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
										<table role="presentation" class="table table-striped">
											<tbody class="files">
											<?php foreach($obj_acta->FotoUm as $key => $obj_foto_um) {?> 
											<?php $file_name =$obj_foto_um->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
												<tr class="template-download fade in" foto_um="<?php echo $file_name_explode[0];?>">
													<td><span class="preview"> <a
															href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_um/<?php echo $obj_foto_um->getAttr('file_name'); ?>"
															title="<?php echo $obj_foto_um->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
															data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_um/thumbnail/<?php echo $obj_foto_um->getAttr('file_name'); ?>" width='80px'>
														</a>
														<textarea rows="3"  name="data[FotoUmUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_um->getAttr('observacion'); ?></textarea>
														<input type="hidden" value="<?php echo $obj_foto_um->getAttr('id'); ?>" name="data[FotoUmUpdate][<?php echo $key; ?>][id][]">
													</span>
													</td>
													<td>
														<p class="name">
															<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_um/<?php echo $obj_foto_um->getAttr('file_name'); ?>"
																title="<?php echo $obj_foto_um->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																data-gallery=""><?php echo $obj_foto_um->getAttr('file_name'); ?></a> 
														</p>
													</td>
													<td><span class="size">120.37 KB</span>
													</td>
													<td>
														<a data-url="<?php echo $obj_foto_um->getAttr('file_name');?>" data-foto_um="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-um">
															<i class="glyphicon glyphicon-trash"></i> <span>Delete</span>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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
	
	<!-- Documentación de Seguridad -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" id="div-doc">
						<table class="table table-striped table-bordered table-hover"
							id="table-ipp">
							<thead>
								<tr>
									<th colspan=10
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('DOCUMENTACIÓN DE SEGURIDAD (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_doc', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'2', 'class'=> 'txtInfDes3 form-control','id' =>'txtInfDes3')); ?></td>
								</tr>
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
										<table role="presentation" class="table table-striped">
											<tbody class="files">
											<?php foreach($obj_acta->FotoDoc as $key => $obj_foto_doc) {?> 
											<?php $file_name =$obj_foto_doc->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
												<tr class="template-download fade in" foto_doc="<?php echo $file_name_explode[0];?>">
													<td><span class="preview"> <a
															href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_doc/<?php echo $obj_foto_doc->getAttr('file_name'); ?>"
															title="<?php echo $obj_foto_doc->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
															data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_doc/thumbnail/<?php echo $obj_foto_doc->getAttr('file_name'); ?>" width='80px'>
														</a>
														<textarea rows="3"  name="data[FotoDocUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_doc->getAttr('observacion'); ?></textarea>
														<input type="hidden" value="<?php echo $obj_foto_doc->getAttr('id'); ?>" name="data[FotoDocUpdate][<?php echo $key; ?>][id][]">
													</span>
													</td>
													<td>
														<p class="name">
															<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_doc/<?php echo $obj_foto_doc->getAttr('file_name'); ?>"
																title="<?php echo $obj_foto_doc->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																data-gallery=""><?php echo $obj_foto_doc->getAttr('file_name'); ?></a> 
														</p>
													</td>
													<td><span class="size">120.37 KB</span>
													</td>
													<td>
														<a data-url="<?php echo $obj_foto_doc->getAttr('file_name');?>" data-foto_doc="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-doc">
															<i class="glyphicon glyphicon-trash"></i> <span>Delete</span>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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
	
	
	
	<!-- Actos subestandares -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover"
							id="table-as-inf">
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
								echo "<td style='width:89%;'>";
								//echo"<input name='data[ActoSubestandar".($key3+1)."][descripcion]' id='txtActoSubDes".($key3+1)."' value='".$obj_act_sub->getAttr('descripcion')."' class='form-control'/>";
								echo "<select name='data[ActoSubestandar][".($key3+1)."][act_sub_tipo_id]' class='cbo-tipo-act-sub-select2 form-control' id='cboActoSubDes".($key3+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								echo "<option></option>";
								if (isset($list_all_tipos_actos_sub)){
									foreach ($list_all_tipos_actos_sub as $id => $des):
										if($id == $obj_act_sub->getAttr('act_sub_tipo_id')){
											$selected = " selected = 'selected'";
										}else{
											$selected = "";
										}
										echo "<option value = ".$id.$selected.">".utf8_encode($des)."</option>";
									endforeach;
								}
								echo "</select>";
								echo "<input name='data[ActoSubestandar][".($key3+1)."][as-id]' id='hiddenActoSubId".($key3+1)."' type='hidden' class='form-control' value='".$obj_act_sub->getID()."'></td>";
								echo "<td><select name='data[ActoSubestandar][".($key3+1)."][ni-id]' class='cbo-nincumplidas-select2 form-control' id='ActoSubNid-".($key3+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								echo "<option></option>";
								if (isset($list_all_codigos)){
									foreach ($list_all_codigos as $id => $cod):
									if($id == $obj_act_sub->getAttr('codigo_id')){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$id.$selected.">".$cod."</option>";
									endforeach;
								}
								echo "</select></td>";
								echo "</tr>";
							}
							
							
							for ($i = ($key3+2); $i <= 5; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td style='width:89%;'>";
								    //echo "<input name='data[ActoSubestandar][descripcion".$i."]' id='txtActoSubDes".$i."' class='form-control'/>";
								    echo "<select name='data[ActoSubestandar][".$i."][act_sub_tipo_id]' class='cbo-tipo-act-sub-select2 form-control' id='cboActoSubDes".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    echo "<option></option>";
								    if (isset($list_all_tipos_actos_sub)){
								    	foreach ($list_all_tipos_actos_sub as $id => $des):
								    	echo "<option value = ".$id.">".utf8_encode($des)."</option>";
								    	endforeach;
								    }
								    echo "</select>";
								    echo "<input name='data[ActoSubestandar][".$i."][as-id]' id='hiddenActoSubId".$i."' type='hidden' class='form-control' value=''></td>";
								    echo "<td><select name='data[ActoSubestandar][".$i."][ni-id]' class='cbo-nincumplidas-select2 form-control' id='ActoSubNid-".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
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
						</table>
					</div>
					<div class="row" id ="div-btn-add-as">
						<div class="span3 col-md-9 col-sm-6 col-xs-6">
							<?php echo utf8_encode('Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
						</div>
						<div class="span3 col-md-3 col-sm-6 col-xs-6" style="text-align: right;">
							<a class="btn btn-primary add-more-row-as">+</a>
						</div>
					</div>
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
							id="table-cs-inf">
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
								echo "<td style='width:89%;'>"; 
								//echo "<input name='data[CondiSubestandar".($key4+1)."][descripcion]' id='txtCondiSubDes".($key4+1)."' value='".$obj_cond_sub->getAttr('descripcion')."' class='form-control'/>";
								echo "<select name='data[CondiSubestandar][".($key4+1)."][cond_sub_tipo_id]' class='cbo-tipo-cond-sub-select2 form-control' id='cboCondiSubDes".($key4+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								echo "<option></option>";
								if (isset($list_all_tipos_condiciones_sub)){
									foreach ($list_all_tipos_condiciones_sub as $id => $des):
									if($id == $obj_cond_sub->getAttr('cond_sub_tipo_id')){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$id.$selected.">".utf8_encode($des)."</option>";
									endforeach;
								}
								echo "</select>";
								echo "<input name='data[CondiSubestandar][".($key4+1)."][cs-id]' id='hiddenCondiSubId".($key4+1)."' type='hidden' class='form-control' value='".$obj_cond_sub->getID()."'></td>";
								echo "<td><select name='data[CondiSubestandar][".($key4+1)."][ni-id]' class='cbo-nincumplidas-select2 form-control' id='CondiSubNid-".($key4+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								echo "<option></option>";
								if (isset($list_all_codigos)){
									foreach ($list_all_codigos as $id => $cod):
									if($id == $obj_cond_sub->getAttr('codigo_id')){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$id.$selected.">".$cod."</option>";
									endforeach;
								}
								echo "</select></td>";
								echo "</tr>";
							}
							
							for ($i = ($key4+2); $i <= 5; $i++) {
								    echo "<tr>";
								    echo "<td style='width:4%;'>".$i."</td>";
								    echo "<td style='width:89%;'>"; 
								    //echo "<input name='data[CondiSubestandar".$i."][descripcion]' id='txtCondiSubDes".$i."' class='form-control'/>";
								    echo "<select name='data[CondiSubestandar][".$i."][cond_sub_tipo_id]' class='cbo-tipo-cond-sub-select2 form-control' id='cboCondiSubDes".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								    echo "<option></option>";
								    if (isset($list_all_tipos_condiciones_sub)){
								    	foreach ($list_all_tipos_condiciones_sub as $id => $des):
								    	echo "<option value = ".$id.">".utf8_encode($des)."</option>";
								    	endforeach;
								    }
								    echo "</select>";
								    echo "<input name='data[CondiSubestandar][".$i."][cs-id]' id='hiddenCondiSubId".$i."' type='hidden' class='form-control' value=''></td>";
								    echo "<td><select name='data[CondiSubestandar][".$i."][ni-id]' class='cbo-nincumplidas-select2 form-control' id='CondiSubNid-".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
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
						</table>
					</div>
					<div class="row" id ="div-btn-add-cs">
						<div class="span3 col-md-9 col-sm-6 col-xs-6">
							<?php echo utf8_encode('(Ver parte posterior de la hoja) Si subsanó la no conformidad al momento de la supervisión marcar el recuadro con un aspa(X).'); ?>
						</div>
						<div class="span3 col-md-3 col-sm-6 col-xs-6" style="text-align: right;">
							<a class="btn btn-primary add-more-row-cs">+</a>
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
							id="table-ipp">
							<thead>
								<tr>
									<tr>
									<th
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('ACTOS SUBESTÁNDARES (PARA EL INFORME)') ?>
									</th>
									<th
										style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('CONDICIONES SUBESTÁNDARES (PARA EL INFORME)') ?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $this->Form->input('info_des_act', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'4', 'class'=> 'txtInfDesAct4 form-control','id' =>'txtInfDesAct4')); ?></td>
									<td><?php echo $this->Form->input('info_des_cond', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'4', 'class'=> 'txtInfDesCond4 form-control','id' =>'txtInfDesCond4')); ?></td>
								</tr>
								<tr>
									<td colspan=2>
									<div class="fileupload" data-type="FotoAc">
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
										<table role="presentation" class="table table-striped">
											<tbody class="files">
											<?php foreach($obj_acta->FotoAc as $key => $obj_foto_ac) {?> 
											<?php $file_name =$obj_foto_ac->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
												<tr class="template-download fade in" foto_ac="<?php echo $file_name_explode[0];?>">
													<td><span class="preview"> <a
															href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ac/<?php echo $obj_foto_ac->getAttr('file_name'); ?>"
															title="<?php echo $obj_foto_ac->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
															data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ac/thumbnail/<?php echo $obj_foto_ac->getAttr('file_name'); ?>" width='80px'>
														</a>
														<textarea rows="3"  name="data[FotoAcUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_ac->getAttr('observacion'); ?></textarea>
														<input type="hidden" value="<?php echo $obj_foto_ac->getAttr('id'); ?>" name="data[FotoAcUpdate][<?php echo $key; ?>][id][]">
													</span>
													</td>
													<td>
														<p class="name">
															<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ac/<?php echo $obj_foto_ac->getAttr('file_name'); ?>"
																title="<?php echo $obj_foto_ac->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																data-gallery=""><?php echo $obj_foto_ac->getAttr('file_name'); ?></a> 
														</p>
													</td>
													<td><span class="size">120.37 KB</span>
													</td>
													<td>
														<a data-url="<?php echo $obj_foto_ac->getAttr('file_name');?>" data-foto_ac="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-ac">
															<i class="glyphicon glyphicon-trash"></i> <span>Delete</span>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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
								<td rowspan="3" style="vertical-align: bottom;"><hr> Firma</td>
								<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la Supervisión de SST'); ?>
								</td>
								<td rowspan="3" style="vertical-align: bottom;"><hr> Firma</td>
							</tr>
							<tr>
								<td style='width:35%;'>Nombre: 
								<?php
									echo "<span style='display: inline-flex; width: 100%;'>";
									echo "<select name='data[Acta][reponsable_act_id]' class='cbo-responsable-select2 form-control' id='ResId1' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
							 	    if (isset($list_all_trabajadores)){
										echo "<option></option>";
								    	foreach ($list_all_trabajadores as $id => $nom):
								    	if($id == $obj_acta->Trabajadore1->getAttr('id')){
								    		$selected = " selected = 'selected'";
								    	}else{
								    		$selected = "";
								    	}
								    	echo "<option value = ".$id.$selected.">".$nom."</option>";
								    	endforeach;
								    }
									echo "</select>&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-responsable' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-resp1'>...</a></span></td>";
								?>
								</td>
								<td style='width:35%;'>Nombre:
									<?php 
									echo "<span style='display: inline-flex; width: 100%;'>";
									echo "<select name='data[Acta][reponsable_sup_id]' class='cbo-responsable-select2 form-control' id='ResId2' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
							 	    if (isset($list_all_trabajadores)){
										echo "<option></option>";
								    	foreach ($list_all_trabajadores as $id => $nom):
								    	if($id == $obj_acta->Trabajadore2->getAttr('id')){
								    		$selected = " selected = 'selected'";
								    	}else{
								    		$selected = "";
								    	}
								    	echo "<option value = ".$id.$selected.">".$nom."</option>";
								    	endforeach;
								    }
									echo "</select>&nbsp;<a href='#myModalAddTrabajador' class='btn btn-primary btn-open-modal-responsable' style='height: 28px; padding-right: 4px; padding-left: 4px;' role='button' data-toggle='modal' id='btn-open-create-resp2'>...</a></span></td>";
									?>
								</td>
								
							</tr>
							<tr>
								<td>DNI:<input name='data[ResponsableAct1][dni_res_act]'
									id='txtDniRes1' class='form-control' maxlength=8 value="<?php echo $obj_acta->Trabajadore1->getAttr('nro_documento'); ?>" disabled/>
								</td>
								<td>DNI:<input name='data[ResponsableSup1][dni_res_sup]'
									id='txtDniRes2' class='form-control' maxlength=8 value="<?php echo $obj_acta->Trabajadore2->getAttr('nro_documento'); ?>" disabled/>
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
						id="table-mc-inf">
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
							echo "<td><input name='data[MedidasAdoptadas][".($key5+1)."][descripcion]' id='txtMedidasAdopDes".($key5+1)."' value='".$obj_cierre_acta->getAttr('descripcion')."' class='form-control'/>";
							echo "<input name='data[MedidasAdoptadas][".($key5+1)."][ca_id]' type='hidden' id='hiddenCierreActa".($key5+1)."' value='".$obj_cierre_acta->getID()."' class='form-control'/></td>";
							echo "</tr>";
						}
						 
						for ($i = ($key5+2); $i <= 7; $i++) {
								    echo "<tr>";
								    echo "<td>".$i."</td>";
								    echo "<td><input name='data[MedidasAdoptadas][".$i."][descripcion]' id='txtMedidasAdopDes".$i."' value='' class='form-control'/>";
								    echo "<input name='data[MedidasAdoptadas][".$i."][ca_id]' type='hidden' id='hiddenCierreActa".$i."' value='' class='form-control'/></td>";
								    echo "</tr>";
								}
								?>
					</table>
					<div class="row" id ="div-btn-add-mc">
						<div class="span3 col-md-12 col-sm-6 col-xs-6" style="text-align: right; margin-top: -15px;">
							<a class="btn btn-primary add-more-row-mc">+</a>
						</div>
					</div>
					<br>
					<?php /*
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
					*/ ?>
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
								<tr>
									<td colspan="2" style="vertical-align: middle; text-align: center;"><strong>MEDIDAS DE CONTROL (PARA EL INFORME)</strong></td>
								</tr>
								<tr>
									<td colspan="2"><?php echo $this->Form->input('info_des_med', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txtInfDes7 form-control','id' =>'txtInfDes7')); ?></td>
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