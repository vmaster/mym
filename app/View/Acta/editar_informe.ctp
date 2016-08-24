<script type="text/javascript">
tinymce.init({
	save_enablewhendirty: true,
    save_onsavecallback: function() {console.log("Save");},
    selector: "textarea.editor",
    language: "es",
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
		<h2>Editar Informe</h2>
	</div>
</div>
<hr />
<div class="div-crear-acta form" id="div-editar-acta">
	<?php echo $this->Form->create('Acta',array('method'=>'post', 'id'=>'add_edit_acta','type'=>'file','acta_id'=>$obj_acta->getID()));?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false" style="color: white;">ACTA DE SUPERVISI&Oacute;N SEGURIDAD Y SALUD EN EL TRABAJO</a>
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
													<span class="input-group-addon"><label id="ni" data-toggle="tooltip" title="N&uacute;mero de informe" style="width: 30px;"><?php echo utf8_encode('N° I') ?></label>
													</span>
													<?php echo $this->Form->input('num_informe', array('div' => false, 'label' => false, 'class'=> 'txtNumero form-control','id' =>'txtNumero')); ?>
												</div>
												<br>
												<div class="form-group input-group">
													<span class="input-group-addon"><label id="na" data-toggle="tooltip" title="N&uacute;mero de Acta" style="width: 30px;"><?php echo utf8_encode('N° A') ?></label>
													</span>
													<?php echo $this->Form->input('numero', array('div' => false, 'label' => false, 'class'=> 'txtNumero form-control','id' =>'txtNumero','maxlength' =>'15')); ?>
												</div>
											</td>
											</td>
											<td><?php echo utf8_encode('Código:');?></td>
											<td><?php echo $this->Form->input('codigo', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo', 'value'=>'M001-SST')); ?>
											</td>
										</tr>
										<tr>
											<td><?php echo utf8_encode('Versión:'); ?></td>
											<td><?php echo $this->Form->input('version', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo', 'value'=>'00/2015-M001')); ?>
											</td>
										</tr>
										<tr>
											<td><?php echo utf8_encode('Informe Referencia')?></td>
											<td><select name="data[Acta][acta_referencia]"
												class="cbo-acta-refer-select2 form-control">
												<option></option>
													<?php 
													if (isset($list_all_actas)){
														foreach ($list_all_actas as $id => $num):
														if(isset($obj_acta) || isset($acta_id)){
															if($num['Acta']['id'] == $obj_acta->getAttr('acta_referencia')){
																$selected = " selected = 'selected'";
															}else{
																$selected = "";
															}
								
														}else{
															$selected = "";
														}
														echo "<option value = ".$num['Acta']['id'].$selected.">".$num['Acta']['num_informe']."</option>";
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
											<td style="vertical-align: middle">Lugar: <?php echo $this->Form->input('lugar', array('div' => false, 'label' => false, 'class'=> 'txtLugar form-control','id' =>'txtLugar','maxlength'=>'200')); ?>
											</td>
											<td style="vertical-align: middle" colspan=3 class="td-cbo-uunn">UU.NN:<br>
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
											<td style="vertical-align: middle">Obra: <?php echo $this->Form->input('obra', array('div' => false, 'label' => false, 'class'=> 'txtObra form-control','id' =>'txtObraActa','maxlength'=>'200')); ?>
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
											<td style="vertical-align: middle" width="40%">&Aacute;rea:
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
											<td>Fecha: <input type="text" name="data[Acta][fecha]" id="txtFechaActa" class="form-control" placeholder="dd-mm-aaaa" value="<?php echo $fecha_format; ?>">
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

	<!-- IMPLEMENTOS DE PROTECCIÓN PERSONAL -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false" style="color: white;">IMPLEMENTOS DE PROTECCI&Oacute;N PERSONAL / UNIDADES M&Oacute;VILES</a>
				</div>
				<div id="collapseTwo" class="panel-collapse in">
					<div class="panel-body">
						<ul class="nav nav-pills">
			                <li class="active"><a href="#home-pills1" data-toggle="tab">IMPLEMENTOS DE PROTECCI&Oacute;N PERSONAL</a>
			                </li>
			                <li class=""><a href="#profile-pills2" data-toggle="tab">UNIDADES M&Oacute;VILES</a>
			                </li>
			            </ul>
			            <div class="tab-content">
			                <div class="tab-pane fade active in" id="home-pills1">
			                    <h4>&nbsp;</h4>
			                    <div class="panel panel-primary">
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
													echo "<tr>";
													echo "<td style='width:5%;'>".($key+1)."</td>";
													echo "<td style='width:25%;'>";
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
													
													echo "<td style='width:30%;'><select name='data[TrabajadorActa][".($key+1)."][actividad_id]' class='cbo-actividades-select2 form-control' id='Actividad".($key+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
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
													//if($count_obj_ipp_ni > 0){

													$arr_normas_incumplidas = array();
													$arr_normas_incumplidas_id = array();
													foreach($obj_imp_prot_personal->IppNormasIncumplida as $k =>$v){
														$arr_normas_incumplidas[] = $v->getAttr('codigo_id');
														$arr_normas_incumplidas_id[] = $v->getAttr('id');
													}
														echo "<td><select name='data[NiActa][".($key+1)."][]' class='cbo-nincumplidas-select2 form-control' id='Nid' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' multiple='multiple'>";
															echo "<option></option>";
															if (isset($list_all_codigos)){
																foreach ($list_all_codigos as $id => $cod){
																	if(in_array($id, $arr_normas_incumplidas)){
																	//if($id == $v->getAttr('codigo_id')){
																		$selected = " selected = 'selected'";
																	}else{
																		$selected = "";
																	}
																	echo "<option value = ".$id.$selected.">".$cod."</option>";
																}
															}
																
														echo "</select></td>";
														
														echo "<input name='data[IppNi][".($key+1)."]' type='hidden' value='".implode(',', $arr_normas_incumplidas_id)."' id='hiddenIppNid".($key+1)."'>";
														
												echo "</tr>";
												}
												
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
													    
													   // for($j= 1; $j <=7; $j++){
													    	//echo "<td style='width:7%;'><input name='data[NiActa][ni-".$i."-".$j."]' id='ni-".$i."-".$j."' class='form-control txt-ni".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
													   		//echo "<input name='data[NiActa][ni-id".$i."-".$j."]' type='hidden' value='' id='hiddenNid".$i."-".$j."'>";
													   		echo "<td style='width:7%;'><select name='data[NiActa][".($i)."][]' class='cbo-nincumplidas-select2 form-control' id='Nid' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' multiple='multiple'>";
															echo "<option></option>";
															if (isset($list_all_codigos)){
																foreach ($list_all_codigos as $id => $cod):
																echo "<option value = ".$id.">".$cod."</option>";
																endforeach;
															}
															echo "</select>";
													   		echo "<input name='data[IppNi][".($i)."]' type='hidden' value='' id='hiddenIppNid".$i."'></td>";
													    //}
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
							<div class="tab-pane fade" id="profile-pills2">
			                    <h4>&nbsp;</h4>
			                    <div class="panel panel-primary">
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
															style="vertical-align:middle; text-align: center;"><?php echo utf8_encode('N°'); ?>
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
													echo "<td style='width:5%;'>".($key2 +1)."</td>";
													echo "<td style='width:20%;'>";
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
													echo "<td style='width:20%;'><input name='data[UnidadMovil][".($key2 +1)."][vehiculo]' id='TipoVehiculoActa".($key2 +1)."' value='".$obj_uni_movil->Vehiculo->TipoVehiculo->getAttr('descripcion')."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/>";
													echo "<input name='data[UnidadMovil][".($key2 +1)."][vehiculo_id]' type='hidden' value='' id='hiddenVehiculoid".($key2 +1)."'></td>";
													
													$arr_normas_incumplidas = array();
													$arr_normas_incumplidas_id = array();
													
													foreach($obj_uni_movil->UmNormasIncumplida as $k =>$v){
														$arr_normas_incumplidas[] = $v->getAttr('codigo_id');
														$arr_normas_incumplidas_id[] = $v->getAttr('id');
													}
													
													echo "<td><select name='data[UnidadNorma][".($key2+1)."][]' class='cbo-nincumplidas-select2 form-control' id='ni-".($key2+1)."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' multiple='multiple'>";
													echo "<option></option>";
													if (isset($list_all_codigos)){
																foreach ($list_all_codigos as $id => $cod):
																if(in_array($id, $arr_normas_incumplidas)){
																	$selected = " selected = 'selected'";
																}else{
																	$selected = "";
																}
																echo "<option value = ".$id.$selected.">".$cod."</option>";
																endforeach;
													}
													echo "</select></td>";
													echo "<input name='data[UmNi][".($key2+1)."]' type='hidden' value='".implode(',', $arr_normas_incumplidas_id)."' id='hiddenUmNid".($key2+1)."'>";

												}
												echo "</tr>";
												
												for ($i = ($key2+2); $i <= 4; $i++) {
													    echo "<tr>";
													    echo "<td style='width:5%;'>".$i."</td>";
													    echo "<td style='width:20%;'>";
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
													    echo "<td style='width:20%;'><input name='data[UnidadMovil][".$i."][vehiculo]' id='TipoVehiculoActa".$i."' class='form-control txt-vehiculo' style=' text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'/></td>";
													    echo "<input name='data[UnidadMovil][".$i."][vehiculo_id]' type='hidden' value='' id='hiddenVehiculoid".$i."'></td>";
															
																echo "<td><select name='data[UnidadNorma][".($i)."][]' class='cbo-nincumplidas-select2 form-control' id='ni-".$i."' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' multiple='multiple'>";
																echo "<option></option>";
																if (isset($list_all_codigos)){
																	foreach ($list_all_codigos as $id => $cod):
																	echo "<option value = ".$id.">".$cod."</option>";
																	endforeach;
																}
																echo "</select>";
																echo "<input name='data[UmNi][".($i)."]' type='hidden' value='' id='hiddenUmNid".$i."'></td>";
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
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false" style="color: white;">NIVEL DE CUMPLIMIENTO</a>
                </div>
                <div id="collapseThree" class="panel-collapse in">
					<div class="panel-body">
						<ul class="nav nav-pills">
	                        <li class="active"><a href="#home-pills" data-toggle="tab">EQUIPO DE PROTECCI&Oacute;N</a>
	                        </li>
	                        <li class=""><a href="#profile-pills" data-toggle="tab">SE&Ntilde;ALIZACI&Oacute;N Y DELIMITACI&Oacute;N</a>
	                        </li>
	                        <li class=""><a href="#messages-pills" data-toggle="tab">UNIDADES M&Oacute;VILES</a>
	                        </li>
	                        <li class=""><a href="#settings-pills" data-toggle="tab">DOCUMENTACI&Oacute;N DE SEGURIDAD</a>
	                        </li>
	                        <li class=""><a href="#settings-pills2" data-toggle="tab">CUMPLIMIENTO DEL PROCEDIMIENTO</a>
	                        </li>
	                        <li class=""><a href="#settings-pills3" data-toggle="tab">ACTOS Y CONDICIONES</a>
	                        </li>
	                    </ul>
	                    <div class="tab-content">
	                        <div class="tab-pane fade active in" id="home-pills">
	                            <h4>&nbsp;</h4>
	                            <div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover"
												id="table-epp-rep">
												<thead>
													<tr>
														<th style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('EQUIPO DE PROTECCIÓN (PERSONAL Y/O COLECTIVO)') ?>
														</th>
														<th>
															Cumplimiento
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_info_des_act = json_decode($obj_acta->info_des_epp)?>
													<?php foreach($arr_info_des_act as $i => $info_des_act){?>
													<tr>
														<td><textarea name="data[Acta][cumplimiento_epp][<?php echo $i; ?>][info_des_epp]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($info_des_act->info_des_epp) && $info_des_act->info_des_epp != '')?$info_des_act->info_des_epp:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_epp" name= "data[Acta][cumplimiento_epp][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 0)?"selected":""?>>NO</option>
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
															<table role="presentation" class="table table-striped">
																<tbody class="files">
																<?php foreach($obj_acta->FotoIpp as $key => $obj_foto_ipp) {?> 
																<?php $file_name =$obj_foto_ipp->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto_ipp="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/thumbnail/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="2"  name="data[FotoIppUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_ipp->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_ipp->getAttr('id'); ?>" name="data[FotoIppUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																					><?php echo $obj_foto_ipp->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_ipp->getAttr('file_name');?>" data-foto_ipp="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-ipp">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_ipp/<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" title="<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" download="<?php echo $obj_foto_ipp->getAttr('file_name'); ?>" class="btn btn-default">
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
												id="table-sd-rep">
												<thead>
													<tr>
														<th style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('SEÑALIZACIÓN Y DELIMITACIÓN') ?>
														</th>
														<th>
															Cumplimiento
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_info_des_act = json_decode($obj_acta->info_des_se_de)?>
													<?php foreach($arr_info_des_act as $i => $info_des_act){?>
													<tr>
														<td><textarea name="data[Acta][cumplimiento_sd][<?php echo $i; ?>][info_des_se_de]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($info_des_act->info_des_se_de) && $info_des_act->info_des_se_de != '')?$info_des_act->info_des_se_de:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_sd" name= "data[Acta][cumplimiento_sd][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 0)?"selected":""?>>NO</option>
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
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_sd/<?php echo $obj_foto_sd->getAttr('file_name'); ?>" title="<?php echo $obj_foto_sd->getAttr('file_name'); ?>" download="<?php echo $obj_foto_sd->getAttr('file_name'); ?>" class="btn btn-default">
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

	                        <div class="tab-pane fade" id="messages-pills">
                            	<h4>&nbsp;</h4>
                            	<div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive" id="div-ipp">
											<table class="table table-striped table-bordered table-hover"
												id="table-um-rep">
												<thead>
													<tr>
														<th style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('UNIDADES MÓVILES') ?>
														</th>
														<th>
															Cumplimiento
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_info_des_act = json_decode($obj_acta->info_des_um)?>
													<?php foreach($arr_info_des_act as $i => $info_des_act){?>
													<tr>
														<td><textarea name="data[Acta][cumplimiento_um][<?php echo $i; ?>][info_des_um]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($info_des_act->info_des_um) && $info_des_act->info_des_um != '')?$info_des_act->info_des_um:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_um" name= "data[Acta][cumplimiento_um][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 0)?"selected":""?>>NO</option>
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
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_um/<?php echo $obj_foto_um->getAttr('file_name'); ?>" title="<?php echo $obj_foto_um->getAttr('file_name'); ?>" download="<?php echo $obj_foto_um->getAttr('file_name'); ?>" class="btn btn-default">
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

                            <div class="tab-pane fade" id="settings-pills">
                            	<h4>&nbsp;</h4>
                            	<div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive" id="div-doc">
											<table class="table table-striped table-bordered table-hover"
												id="table-ds-rep">
												<thead>
													<tr>
														<th style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('DOCUMENTACIÓN DE SEGURIDAD') ?>
														</th>
														<th>
															Cumplimiento
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_info_des_act = json_decode($obj_acta->info_des_doc)?>
													<?php foreach($arr_info_des_act as $i => $info_des_act){?>
													<tr>
														<td><textarea name="data[Acta][cumplimiento_ds][<?php echo $i; ?>][info_des_doc]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($info_des_act->info_des_doc) && $info_des_act->info_des_doc != '')?$info_des_act->info_des_doc:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_ds" name= "data[Acta][cumplimiento_ds][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 0)?"selected":""?>>NO</option>
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
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_doc/<?php echo $obj_foto_doc->getAttr('file_name'); ?>" title="<?php echo $obj_foto_doc->getAttr('file_name'); ?>" download="<?php echo $obj_foto_doc->getAttr('file_name'); ?>" class="btn btn-default">
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

                        	<div class="tab-pane fade" id="settings-pills2">
                            	<h4>&nbsp;</h4>
                            	<div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive" id="div-as">
											<table class="table table-striped table-bordered table-hover"
												id="table-as-rep">
												<thead>
													<tr>
														<th	style="vertical-align: middle; text-align: center;width:85%">
															<?php echo utf8_encode('CUMPLIMIENTO DEL PROCEDIMIENTO DE TRABAJO SEGURO') ?>
														</th>
														<th>
															Cumplimiento
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_info_des_act = json_decode($obj_acta->info_des_act)?>
													<?php foreach($arr_info_des_act as $i => $info_des_act){?>
													<tr>
														<td><textarea name="data[Acta][cumplimiento_act][<?php echo $i; ?>][info_des_act]" rows="2" class="txtInfDesAct4 form-control" id="txtInfDesAct4" cols="30"><?php echo (isset($info_des_act->info_des_act) && $info_des_act->info_des_act != '')?$info_des_act->info_des_act:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_cp" name= "data[Acta][cumplimiento_act][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 0)?"selected":""?>>NO</option>
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
															<table role="presentation" class="table table-striped">
																<tbody class="files">
																<?php foreach($obj_acta->FotoAct as $key => $obj_foto_as) {?> 
																<?php $file_name =$obj_foto_as->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto_as="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_as/<?php echo $obj_foto_as->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_as->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_as/thumbnail/<?php echo $obj_foto_as->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="3"  name="data[FotoActUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_as->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_as->getAttr('id'); ?>" name="data[FotoActUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_as/<?php echo $obj_foto_as->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_as->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																					data-gallery=""><?php echo $obj_foto_as->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_as->getAttr('file_name');?>" data-foto-as="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-as">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_as/<?php echo $obj_foto_as->getAttr('file_name'); ?>" title="<?php echo $obj_foto_as->getAttr('file_name'); ?>" download="<?php echo $obj_foto_as->getAttr('file_name'); ?>" class="btn btn-default">
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

                        	<div class="tab-pane fade" id="settings-pills3">
	                            <h4>&nbsp;</h4>
	                            <div class="panel panel-primary">
									<div class="panel-body">
										<div class="table-responsive" id="div-cs">
											<table class="table table-striped table-bordered table-hover"
												id="table-cond-rep">
												<thead>
													<tr>
														<tr>
														<th style="vertical-align: middle; text-align: center;width:85%"><?php echo utf8_encode('ACTOS Y CONDICIONES SUBESTÁNDARES') ?>
														</th>
														<th>
															Cumplimiento
														</th>
													</tr>
												</thead>
												<tbody>
													<?php $arr_info_des_act = json_decode($obj_acta->info_des_cond)?>
													<?php foreach($arr_info_des_act as $i => $info_des_act){?>
													<tr>
														<td><textarea name="data[Acta][cumplimiento_cond][<?php echo $i; ?>][info_des_cond]" rows="2" class="txtInfDesCond4 form-control" id="txtInfDesCond4" cols="30"><?php echo (isset($info_des_act->info_des_cond) && $info_des_act->info_des_cond != '')?$info_des_act->info_des_cond:'';?></textarea></td>
														<td>
															<select class="form-control select-NI-NC select_cu_as" name= "data[Acta][cumplimiento_cond][<?php echo $i; ?>][alternativa]">
																<option value="2" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 2)?"selected":""?>>--</option>
																<option value="1" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 1)?"selected":""?>>SI</option>
																<option value="0" <?php echo (isset($info_des_act->alternativa) && $info_des_act->alternativa == 0)?"selected":""?>>NO</option>
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
															<table role="presentation" class="table table-striped">
																<tbody class="files">
																<?php foreach($obj_acta->FotoCond as $key => $obj_foto_cs) {?> 
																<?php $file_name =$obj_foto_cs->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
																	<tr class="template-download fade in" foto_cs="<?php echo $file_name_explode[0];?>">
																		<td><span class="preview"> <a
																				href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_cs/<?php echo $obj_foto_cs->getAttr('file_name'); ?>"
																				title="<?php echo $obj_foto_cs->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																				data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_cs/thumbnail/<?php echo $obj_foto_cs->getAttr('file_name'); ?>" width='80px'>
																			</a>
																			<textarea rows="3"  name="data[FotoCondUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_cs->getAttr('observacion'); ?></textarea>
																			<input type="hidden" value="<?php echo $obj_foto_cs->getAttr('id'); ?>" name="data[FotoCondUpdate][<?php echo $key; ?>][id][]">
																		</span>
																		</td>
																		<td>
																			<p class="name">
																				<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_cs/<?php echo $obj_foto_cs->getAttr('file_name'); ?>"
																					title="<?php echo $obj_foto_cs->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																					data-gallery=""><?php echo $obj_foto_cs->getAttr('file_name'); ?></a> 
																			</p>
																		</td>
																		<td><span class="size">120.37 KB</span>
																		</td>
																		<td>
																			<a data-url="<?php echo $obj_foto_cs->getAttr('file_name');?>" data-foto-cs="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-cs">
																				<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
																			</a>
																			<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_cs/<?php echo $obj_foto_cs->getAttr('file_name'); ?>" title="<?php echo $obj_foto_cs->getAttr('file_name'); ?>" download="<?php echo $obj_foto_cs->getAttr('file_name'); ?>" class="btn btn-default">
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
									<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la actividad'); ?>
									</td>
									<td style="vertical-align: middle; text-align: center;"><?php echo utf8_encode('Responsable de la Supervisión de SST'); ?>
									</td>
								</tr>
								<tr>
									<td style="vertical-align: middle; width:50%">Cargo:
									<?php
										echo "<span style='display: inline-flex; width: 100%;'>";
										echo "<select name='data[Acta][reponsable_act_cargo_id]' class='cbo-responsable-select2 form-control'style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								 	    if (isset($list_all_actividades)){
											echo "<option></option>";
									    	foreach ($list_all_actividades as $id => $des):
									    	if($id == $obj_acta->Actividade1->getAttr('id')){
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
									<td style="vertical-align: middle; width:50%">Cargo:
									<?php
										echo "<span style='display: inline-flex; width: 100%;'>";
										echo "<select name='data[Acta][reponsable_sup_cargo_id]' class='cbo-responsable-select2 form-control'style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
								 	    if (isset($list_all_actividades)){
											echo "<option></option>";
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
								id="table-ipp">
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
											<table role="presentation" class="table table-striped">
												<tbody class="files">
												<?php foreach($obj_acta->FotoMed as $key => $obj_foto_med) {?> 
												<?php $file_name =$obj_foto_med->getAttr('file_name'); $file_name_explode =explode('.', $file_name);?>
													<tr class="template-download fade in" foto-med="<?php echo $file_name_explode[0];?>">
														<td><span class="preview"> <a
																href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_as/<?php echo $obj_foto_med->getAttr('file_name'); ?>"
																title="<?php echo $obj_foto_med->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																data-gallery=""><img src="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med/thumbnail/<?php echo $obj_foto_med->getAttr('file_name'); ?>" width='80px'>
															</a>
															<textarea rows="3"  name="data[FotoMedUpdate][<?php echo $key; ?>][Observacion][]" placeholder="Observaci&oacute;n"><?php echo $obj_foto_med->getAttr('observacion'); ?></textarea>
															<input type="hidden" value="<?php echo $obj_foto_med->getAttr('id'); ?>" name="data[FotoMedUpdate][<?php echo $key; ?>][id][]">
														</span>
														</td>
														<td>
															<p class="name">
																<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med/<?php echo $obj_foto_med->getAttr('file_name'); ?>"
																	title="<?php echo $obj_foto_med->getAttr('file_name'); ?>" download="b. precios  maestrias soles.png"
																	data-gallery=""><?php echo $obj_foto_med->getAttr('file_name'); ?></a> 
															</p>
														</td>
														<td><span class="size">120.37 KB</span>
														</td>
														<td>
															<a data-url="<?php echo $obj_foto_med->getAttr('file_name');?>" data-foto-med="<?php echo $file_name_explode[0];?>" class="btn btn-danger delete-file-med">
																<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
															</a>
															<a href="<?= ENV_WEBROOT_FULL_URL; ?>files/fotos_med/<?php echo $obj_foto_med->getAttr('file_name'); ?>" title="<?php echo $obj_foto_med->getAttr('file_name'); ?>" download="<?php echo $obj_foto_med->getAttr('file_name'); ?>" class="btn btn-default">
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
				class="btn btn-large btn-success btn_crear_acta_trigger"
				style="margin-right: 17px;width: 150px;">
				<?php echo __('Guardar'); ?>
			</button>
			<button type="button" class="btn btn-large btn-cancelar-crear-acta" style="width: 150px;">
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