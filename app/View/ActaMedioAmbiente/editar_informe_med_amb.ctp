<script type="text/javascript">
tinymce.init({
	save_enablewhendirty: true,
    save_onsavecallback: function() {console.log("Save");},
    selector: "textarea.editor",
    language: "es",
	mode : "textareas",
    browser_spellcheck : true,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Crear un Nuevo Informe de Inspección de medio Ambiente</h2>
	</div>
</div>
<hr />
<div class="div-crear-acta-med-amb form" id="div-editar-acta-med-amb">
	<?php echo $this->Form->create('ActaMedioAmbiente',array('method'=>'post', 'id'=>'add_edit_acta_med_amb','type'=>'file','acta_med_ambacion_id'=>$obj_acta->getID()));?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false" style="color: white;">ACTA DE INSPECCIÓN DE MEDIO AMBIENTE A INSTALACIONES</a>
				</div>
				<div id="collapseOne" class="panel-collapse in">
					<div class="panel-body">
						<div class="panel panel-primary">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover"
										id="dataTables-example">
										<tr>
											<td rowspan=3 style="vertical-align: middle; width: 40%">
												<div class="form-group input-group" style="margin-bottom: -13px;">
													<span class="input-group-addon"><label id="ni" data-toggle="tooltip" title="N&uacute;mero de informe" style="width: 30px;">N&deg; I</label>
													</span>
													<?php echo $this->Form->input('num_informe', array('div' => false, 'label' => false, 'class'=> 'txtNumero form-control','id' =>'txtNumero')); ?>
												</div>
											</td>
											</td>
											<td>C&oacute;digo</td>
											<td><?php echo $this->Form->input('codigo', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo', 'value'=>$obj_acta->getAttr('codigo'))); ?>
											</td>
										</tr>
										<tr>
											<td>Versi&oacute;n</td>
											<td><?php echo $this->Form->input('version', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo', 'value'=>$obj_acta->getAttr('version'))); ?>
											</td>
										</tr>
										<tr>
											<td><?php echo utf8_encode('Informe Referencia')?></td>
											<td><select name="data[ActaMedioAmbiente][acta_referencia]"
												class="cbo-acta-med-amb-refer-select2 form-control">
												<option></option>
													<?php 
													if (isset($list_all_actas)){
														echo "<option>---</option>";
														foreach ($list_all_actas as $id => $num):
														if(isset($obj_acta) || isset($acta_med_ambacion_id)){
															if($num['ActaMedioAmbiente']['id'] == $obj_acta->getAttr('acta_referencia')){
																$selected = " selected = 'selected'";
															}else{
																$selected = "";
															}
								
														}else{
															$selected = "";
														}
														echo "<option value = ".$num['ActaMedioAmbiente']['id'].$selected.">".$num['ActaMedioAmbiente']['num_informe']."</option>";
														endforeach;
													}
													?>
											</select></td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<div class="panel panel-primary">
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
											<span style="display: inline-flex;" class="span-cbo-empresa">
											<select name="data[ActaMedioAmbiente][empresa_id]"
												class="cbo-empresas-select2 form-control">
													<?php 
													if (isset($list_all_empresas)){
													foreach ($list_all_empresas as $id => $des):
														if(isset($obj_acta) || isset($acta_med_ambacion_id)){
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
											<td colspan=3>
											</td>
										</tr>
										<tr>
											<td style="vertical-align: middle">Lugar: <?php echo $this->Form->input('lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','maxlength'=>'200')); ?>
											</td>
											<td style="vertical-align: middle" colspan=3 class="td-cbo-uunn">UU.NN:<br>
											<?php //echo $this->Form->input('uunn', array('div' => false, 'label' => false, 'class'=> 'txtUunn form-control','id' =>'txtUunn','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
											<select name="data[ActaMedioAmbiente][uunn_id]"
												class="cbo-uunn-select2 form-control">
											<?php 
												if (isset($list_all_unidades_negocios)){
													echo "<option>---</option>";
													foreach ($list_all_unidades_negocios as $id => $des):
													if(isset($obj_acta) || isset($acta_med_ambacion_id)){
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
											<td style="vertical-align: middle">Responsable: <?php echo $this->Form->input('obra', array('div' => false, 'label' => false, 'class'=> 'txtResonsable form-control','id' =>'txtResponsableActa','maxlength'=>'200')); ?>
											</td>

											<td style="vertical-align: middle" colspan=2>Llenado de actividad: <?php echo $this->Form->input('llenado_lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','maxlength'=>'200')); ?>
											</td>
											
										</tr>
										<tr>
											<td style="vertical-align: middle">
												Planeada: <input
												name="data[ActaMedioAmbiente][tipo]" type="radio" value="P" id="rbTipo1" <?php echo ($obj_acta->getAttr('tipo') == 'P')? 'checked':''; ?>>
												Inopinada: <input name="data[ActaMedioAmbiente][tipo]" type="radio"
												value="I" id="rbTipo2" <?php echo ($obj_acta->getAttr('tipo') == 'I')? 'checked':''; ?>>
											</td>
											<td style="vertical-align: middle" width="40%">&Aacute;rea:
												<select name="data[ActaMedioAmbiente][tipo_lugar_id]"
												class="form-control">
												<option>---</option>
													<?php 
													if (isset($list_all_tipo_lugares)){
														foreach ($list_all_tipo_lugares as $id => $des):
														if(isset($obj_acta) || isset($acta_med_ambacion_id)){
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
													$fecha = $obj_acta->getAttr('fecha'); //1990-12-12
														
													if($fecha == '' || $fecha == NULL){
														$fecha_format = '';
													}else{
														$dd = substr($fecha,8,2);
														$mm = substr($fecha, 5, 2);
														$yy = substr($fecha, 0, 4);
														$time = substr($fecha, 11, 8);
														$fecha_format = $dd.'-'.$mm.'-'.$yy.' '.$time;//12-12-1990
													}
											?>
											<td>Fecha: <input type="text" name="data[ActaMedioAmbiente][fecha]" id="txtFechaActa" class="form-control" placeholder="dd-mm-aaaa" value="<?php echo $fecha_format; ?>">
											</td>
											<?php echo $this->Form->input('grafico', array('type'=>'hidden','div' => false, 'label' => false, 'maxlength' =>'15')); ?>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false" style="color: white;">SUPERVISIÓN E INSPECCIÓN DEL ESTADO DEL MEDIOAMBIENTAL</a>
                </div>
                <div id="collapseThree" class="panel-collapse in">
					<div class="panel-body">
						<ul class="nav nav-pills">
	                        <li class="active"><a href="#home-pills" data-toggle="tab">DOCUMENTACI&Oacute;N MEDIO AMBIENTAL</a>
	                        </li>
	                        <li class=""><a href="#profile-pills" data-toggle="tab">CONDICIONES AMBIENTALES</a>
	                        </li>
	                    </ul>
	                    <div class="tab-content">
	                        <div class="tab-pane fade active in" id="home-pills">
	                            <h4>&nbsp;</h4>
	                            <div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover"
												id="table-dm-rep">
												<thead>
													<tr>
														<th style="vertical-align: middle; text-align: center;width:85%">DOCUMENTACI&Oacute;N MEDIO AMBIENTAL
														</th>
														<th>
															Cumplimiento
														</th>
														<th>
															Incidencia
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_inf_des_act = json_decode($obj_acta->json_doc_med_amb)?>
													<?php foreach($arr_inf_des_act as $i => $inf_des_act){?>
													<tr>
														<td><textarea name="data[ActaMedioAmbiente][cumplimiento_doc_med][<?php echo $i; ?>][inf_des_doc_med]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($inf_des_act->inf_des_doc_med) && $inf_des_act->inf_des_doc_med != '')?$inf_des_act->inf_des_doc_med:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_dm" name= "data[ActaMedioAmbiente][cumplimiento_doc_med][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($inf_des_act->alternativa) && $inf_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($inf_des_act->alternativa) && $inf_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($inf_des_act->alternativa) && $inf_des_act->alternativa == 0)?"selected":""?>>NO</option>
															</select>
														</td>
														<td>
															<select class="form-control select_re_dm" name= "data[ActaMedioAmbiente][cumplimiento_doc_med][<?php echo $i; ?>][incidencia]">
																<option value="4" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 4)?"selected":""?>>--</option>
																<option value="3" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 3)?"selected":""?>>N - Nueva Insp./Obs.</option>
																<option value="2" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 2)?"selected":""?>>S - Subsanado</option>
																<option value="1" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 1)?"selected":""?>>R - Reiterativo</option>
																<option value="0" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 0)?"selected":""?>>NO</option>
															</select>
														</td>
													</tr>
													<?php }?>
													</tbody>
											</table>
											<div class="row" id="div-btn-add-dm-rep">
												<div class="span3 col-md-12 col-sm-6 col-xs-6"
													style="text-align: right;">
													<a class="btn btn-primary add-more-row-dm-rep">+</a>
												</div>
											</div>
											<br>
											<table class="table table-striped table-bordered table-hover"
												id="table-dm">
												<tbody>
													<tr>
														<td>
														<?php //echo $this->Form->input('foto',array('type' => 'file')); ?>
														<div class="fileupload" data-type="FotoMedAmbDoc">
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
																<?php foreach($obj_acta->FotoMedAmbDoc as $key => $obj_foto_dm) {?> 
																<?php $file_name =$obj_foto_dm->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto-dm="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_doc/<?php echo $obj_foto_dm->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_dm->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_doc/thumbnail/<?php echo $obj_foto_dm->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="2"  name="data[FotoDmUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_dm->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_dm->getAttr('id'); ?>" name="data[FotoDmUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_doc/<?php echo $obj_foto_dm->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_dm->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																					><?php echo $obj_foto_dm->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_dm->getAttr('file_name');?>" data-foto-dm="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-dm">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_doc/<?php echo $obj_foto_dm->getAttr('file_name'); ?>" title="<?php echo $obj_foto_dm->getAttr('file_name'); ?>" download="<?php echo $obj_foto_dm->getAttr('file_name'); ?>" class="btn btn-default">
																				<i class="fa fa-download"></i> <span>Descargar</span>
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

							<div class="tab-pane fade" id="profile-pills">
	                            <h4>&nbsp;</h4>
	                            <div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover"
												id="table-ca-rep">
												<thead>
													<tr>
														<th style="vertical-align: middle; text-align: center;width:85%">CONDICIONES AMBIENTALES
														</th>
														<th>
															Cumplimiento
														</th>
														<th>
															Incidencia
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_inf_des_act = json_decode($obj_acta->json_cond_amb)?>
													<?php foreach($arr_inf_des_act as $i => $inf_des_act){?>
													<tr>
														<td><textarea name="data[ActaMedioAmbiente][cumplimiento_cond_amb][<?php echo $i; ?>][inf_des_cond_amb]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($inf_des_act->inf_des_cond_amb) && $inf_des_act->inf_des_cond_amb != '')?$inf_des_act->inf_des_cond_amb:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_ca" name= "data[ActaMedioAmbiente][cumplimiento_cond_amb][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($inf_des_act->alternativa) && $inf_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($inf_des_act->alternativa) && $inf_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($inf_des_act->alternativa) && $inf_des_act->alternativa == 0)?"selected":""?>>NO</option>
															</select>
														</td>
														<td>
															<select class="form-control select_re_ca" name= "data[ActaMedioAmbiente][cumplimiento_cond_amb][<?php echo $i; ?>][incidencia]">
																<option value="4" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 4)?"selected":""?>>--</option>
																<option value="3" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 3)?"selected":""?>>N - Nueva Insp./Obs.</option>
																<option value="2" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 2)?"selected":""?>>S - Subsanado</option>
																<option value="1" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 1)?"selected":""?>>R - Reiterativo</option>
																<option value="0" <?php echo (isset($inf_des_act->incidencia) && $inf_des_act->incidencia == 0)?"selected":""?>>NO</option>
															</select>
														</td>
													</tr>
													<?php }?>
												</tbody>
											</table>
											<div class="row" id="div-btn-add-ca-rep">
												<div class="span3 col-md-12 col-sm-6 col-xs-6"
													style="text-align: right;">
													<a class="btn btn-primary add-more-row-ca-rep">+</a>
												</div>
											</div>
											<br>
											<table class="table table-striped table-bordered table-hover"
												id="table-ca">
												<tbody>
													<tr>
														<td>
														<div class="fileupload" data-type="FotoMedAmbCond">
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
																<?php foreach($obj_acta->FotoMedAmbCond as $key => $obj_foto_ca) {?> 
																<?php $file_name =$obj_foto_ca->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto-ca="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_cond/<?php echo $obj_foto_ca->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_ca->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_cond/thumbnail/<?php echo $obj_foto_ca->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="2"  name="data[FotoCaUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_ca->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_ca->getAttr('id'); ?>" name="data[FotoCaUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_cond/<?php echo $obj_foto_ca->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_ca->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																					data-gallery=""><?php echo $obj_foto_ca->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_ca->getAttr('file_name');?>" data-foto-ca="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-ca">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_cond/<?php echo $obj_foto_ca->getAttr('file_name'); ?>" title="<?php echo $obj_foto_ca->getAttr('file_name'); ?>" download="<?php echo $obj_foto_ca->getAttr('file_name'); ?>" class="btn btn-default">
																					<i class="fa fa-download"></i> <span>Descargar</span>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="container_graf_cu" style="width: 650px; height: 500px; margin: 0 auto; display:none"></div>
	<canvas id="canvas" style="display:none;"></canvas>

	<!-- Responsables Previos Corrección -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false" style="color: white;">RESPONSABLES DE LA SUPERVISI&Oacute;N</a>
				</div>
				<div id="collapseFour" class="panel-collapse in">
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover"
								id="dataTables-example">
								<tr>
									<td style="vertical-align: middle; text-align: center;">Responsable de la Supervisi&oacute;n de SST
									</td>
								</tr>
								<tr>
									<td style="vertical-align: middle; width:50%;padding-right: 44%;">Cargo:
									<?php
										echo "<span style='display: inline-flex; width: 100%;' class='span-cbo-responsable-sup-cargo'>";
										echo "<select name='data[ActaMedioAmbiente][reponsable_sup_cargo_id]' class='cbo-responsable-select2 cbo-reponsable-sup-cargo form-control'style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								 	    if (isset($list_all_actividades)){
											//echo "<option>---</option>";
									    	foreach ($list_all_actividades as $id => $des):
									    	if($id == $obj_acta->Actividade2->getAttr('id')){
									    		$selected = " selected = 'selected'";
									    	}else{
									    		$selected = "";
									    	}
									    	echo "<option value = ".$id.$selected.">".$des."</option>";
									    	endforeach;
									    }
									    echo "</select>";
									?>
									</td>
								</tr>
								<tr>
									<td style='width:35%;padding-right: 44%;'>Nombre:
										<?php 
										echo "<span style='display: inline-flex; width: 100%;' class='span-cbo-responsable_sup'>";
										echo "<select name='data[ActaMedioAmbiente][reponsable_sup_id]' class='cbo-responsable-select2 cbo-reponsable-sup form-control' id='ResId2' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								 	    if (isset($list_all_trabajadores)){
											//echo "<option>---</option>";
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
									<td style="padding-right: 44%;">DNI:<input name='data[ResponsableSup1][dni_res_sup]'
										id='txtDniRes2' class='form-control' maxlength=8 value="<?php echo $obj_acta->Trabajadore2->getAttr('nro_documento'); ?>" disabled/>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false" style="color: white;">CONCLUSIONES Y RECOMENDACIONES</a>
				</div>
				<div id="collapseFive" class="panel-collapse in">
					<div class="panel-body">
						<div class="table-responsive" id="div-ipp">
							<table class="table table-striped table-bordered table-hover"
								id="table-med">
								<thead>
									<tr>
										<th 
											style="vertical-align: middle; text-align: center; width:50%"><?php echo utf8_encode('CONCLUSIONES') ?>
										</th>
										<th
											style="vertical-align: middle; text-align: center; width:50%"><?php echo utf8_encode('RECOMENDACIONES') ?>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr id="father-container1">
										<td><?php echo $this->Form->input('info_des_conclusion', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5','cols'=>'80', 'class'=> 'txt-conclusiones editor form-control','id' =>'txtConclusiones')); ?></td>
										<td><?php echo $this->Form->input('info_des_rec', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5','cols'=>'80', 'class'=> 'txt-recomendaciones editor form-control','id' =>'txtRecomendaciones')); ?></td>
									</tr>
									<tr>
										<td colspan="2" style="vertical-align: middle; text-align: center;"><strong>MEDIDAS DE CONTROL</strong></td>
									</tr>
									<tr id="father-container2">
										<td colspan="2"><?php echo $this->Form->input('info_des_med', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txt-med-control editor form-control','id' =>'txtMedControl')); ?></td>
									</tr>
									<tr>
										<td colspan=2>
										<div class="fileupload" data-type="FotoMedAmbMedida">
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
																<?php foreach($obj_acta->FotoMedAmbMedida as $key => $obj_foto_med) {?> 
																<?php $file_name =$obj_foto_med->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto-med="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_medida/<?php echo $obj_foto_med->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_med->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_medida/thumbnail/<?php echo $obj_foto_med->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="3"  name="data[FotoMedUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_med->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_med->getAttr('id'); ?>" name="data[FotoMedUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_medida/<?php echo $obj_foto_med->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_med->getAttr('file_name'); ?>" download=""
																					data-gallery=""><?php echo $obj_foto_med->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_med->getAttr('file_name');?>" data-foto-med="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-medida">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_medida/<?php echo $obj_foto_med->getAttr('file_name'); ?>" title="<?php echo $obj_foto_med->getAttr('file_name'); ?>" download="<?php echo $obj_foto_med->getAttr('file_name'); ?>" class="btn btn-default">
																					<i class="fa fa-download"></i> <span>Descargar</span>
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
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false" style="color: white;">ACTA DE INSPECCIÓN</a>
				</div>
				<div id="collapseFive" class="panel-collapse in">
					<div class="panel-body">
						<div class="table-responsive" id="div-act-insp-seg">
							<table class="table table-striped table-bordered table-hover"
								id="table-med">
								<tbody>
									<tr>
										<td colspan=2>
										<div class="fileupload" data-type="FotoMedAmbActa">
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
																<?php foreach($obj_acta->FotoMedAmbActa as $key => $obj_foto_acta) {?> 
																<?php $file_name =$obj_foto_acta->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto-acta="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_acta/<?php echo $obj_foto_acta->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_acta->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_acta/thumbnail/<?php echo $obj_foto_acta->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="3"  name="data[FotoMedAmbActaUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_acta->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_acta->getAttr('id'); ?>" name="data[FotoMedAmbActaUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_acta/<?php echo $obj_foto_acta->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_acta->getAttr('file_name'); ?>" download=""
																					data-gallery=""><?php echo $obj_foto_acta->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_acta->getAttr('file_name');?>" data-foto-acta="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-acta">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med_amb_acta/<?php echo $obj_foto_acta->getAttr('file_name'); ?>" title="<?php echo $obj_foto_acta->getAttr('file_name'); ?>" download="<?php echo $obj_foto_acta->getAttr('file_name'); ?>" class="btn btn-default">
																					<i class="fa fa-download"></i> <span>Descargar</span>
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
	</div>

	<br>
	<div class="row" style="text-align: center;">
		<div class="col-md-12">
			<button type="button"
				class="btn btn-large btn-success btn_crear_acta_med_amb_trigger"
				style="margin-right: 17px;width: 150px;">
				<?php echo __('Guardar'); ?>
			</button>
			<button type="button" class="btn btn-large btn-cancelar-crear-acta-med-amb" style="width: 150px;">
				<?php echo __('Cancelar');?>
			</button>
		</div>
	</div>

	<div class="row" style="text-align: center; color:#0489B1;height: 16px;"><div style='border:0px;font-size:11px;padding: 0px 5px;'><strong>Copyright © Todos los Derechos Reservados</strong></div></div>

	<div class="row" style="text-align: center; color:#0489B1;"><div style='border:0px;font-size:11px;padding: 0px 5px;'><strong>M&M Ingeniería Obras y Servicios EIRL</strong></div></div>
	
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