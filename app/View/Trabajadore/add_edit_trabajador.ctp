<script>
$(document).ready(function(){
	/* Propiedades de algunos componentes */
	/*$('#txtFechaNacimiento').datepicker(
		{
			changeYear: true, 
			dateFormat: 'dd-mm-yy',
			minDate: new Date(1924, 1 - 1, 1),
			maxDate: new Date()
		});*/

	/* Permitiendo el ingreso de solo números - Nro Doc */
	$("#TrabajadorNroDocumento").keydown(function(event) {
		if(event.shiftKey){
		   event.preventDefault();
		}
		 
		if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9)    {
		}else{
			if (event.keyCode < 95) {
				if (event.keyCode < 48 || event.keyCode > 57) {
		        	event.preventDefault();
		        }
		    }else{
		       if (event.keyCode < 96 || event.keyCode > 105) {
		       	event.preventDefault();
		       }
		    }
		}
	});

	$("#chbox-vigente").click(function() {  
        if($("#chbox-vigente").is(':checked')) {  
        	$(this).val(1);
        } else {  
        	$(this).val(0);
        }  
    });
})
</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo (isset($trabajador_id) && $trabajador_id > 0)?"Modificar datos de Trabajador":"Registrar Nuevo Trabajador"; ?></h2>
	</div>
</div>
<hr />
<div class="container div-crear-trabajador form" id="div-crear-trabajador">
	<?php echo $this->Form->create('Trabajadore',array('action'=>'add_edit_trabajador','method'=>'post', 'id'=>'add_edit_trabajador', 'type' => 'file'));?>
	<!-- <form method="post" id="add_edit_trabajador" enctype="multipart/form-data" accept-charset="utf-8" > -->
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombre'>".__('Apellidos y Nombres')."</label>"; ?>
				<?php echo $this->Form->input('apellido_nombre', array('div' => false, 'label' => false, 'class'=> 'txtApellidoNombre form-control','id' =>'txtApellidoNombre','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<?php /*?> <div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label  id='lblApellido'>".__('Apellidos')."</label>"; ?>
				<?php echo $this->Form->input('apellido', array('div' => false, 'label' => false, 'class'=> 'txtApellido form-control','id' =>'txtApellido')); ?>
			</div>
			 */?>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo utf8_encode(__('Nro Documento')); ?> </label>
				<?php echo $this->Form->input('nro_documento', array('id' =>'TrabajadorNroDocumento', 'div' => false, 'label' => false, 'class'=>'form-control','maxlength'=>8)); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Tipo Trabajador'); ?> </label>
				<select name="data[Trabajadore][tipo_trabajador]" class="cboTipoTrabajador form-control" id = "cboTipoTrabajador">
						<?php
							if (isset($obj_trabajador)){
								echo "<option value = ".$obj_trabajador->getAttr('tipo_trabajador')." selected='selected'>";
								if($obj_trabajador->getAttr('tipo_trabajador') == 'E'){ 
									echo __('EXTERNO')."</option>";
									echo "<option value = 'I'>".__('INTERNO')."</option>";
								}else{ 
									echo __('INTERNO')."</option>";
									echo "<option value = 'E'>".__('EXTERNO')."</option>";
								}
							}else{
							?>
							<option value="E">
								<?php echo __('EXTERNO'); ?>
							</option>
							<option value="I">
								<?php echo __('INTERNO'); ?>
							</option>
						<?php } ?>
				</select>
			</div>
		</div>
		<p>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Empresa'); ?> </label>
				<select name="data[Trabajadore][empresa_id]" class="cboEmpresas form-control">
					<?php 
					if (isset($list_all_empresas)){
						foreach ($list_all_empresas as $id => $des):
						if(isset($obj_trabajador) || isset($trabajador_id)){
							if($id == $obj_trabajador->getAttr('empresa_id')){
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
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Actividad'); ?> </label>
				<select name="data[Trabajadore][actividade_id]" class="cboTipoTrabajadores form-control">
					<?php 
					if (isset($list_all_actividades)){
						foreach ($list_all_actividades as $i => $d):
						if(isset($obj_trabajador) || isset($trabajador_id)){
							if($i == $obj_trabajador->getAttr('actividade_id')){
								$selected = " selected = 'selected'";
							}else{
								$selected = "";
							}

						}else{
							$selected = "";
						}
						echo "<option value = ".$i.$selected.">".$d."</option>";
						endforeach;
					}
					?>
				</select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label  id='lblSexo'>".__('Sexo')."</label>"; ?>
				<select name="data[Trabajadore][sexo]" class="cboSexo form-control" id = "cboSexo">
					<?php
						if (isset($obj_trabajador)){
							echo "<option value = ".$obj_trabajador->getAttr('sexo')." selected='selected'>";
							if($obj_trabajador->getAttr('sexo') == 'M'){ 
								echo __('Masculino')."</option>";
								echo "<option value = 'F'>".__('Femenino')."</option>";
							}else{ 
								echo __('Femenino')."</option>";
								echo "<option value = 'M'>".__('Masculino')."</option>";
							}
						}else{
						?>
						<option value="M">
							<?php echo __('Masculino'); ?>
						</option>
						<option value="F">
							<?php echo __('Femenino'); ?>
						</option>
					<?php } ?>
				</select>
			</div>
		</div>
		<p>
		
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label  id='lblSexo'>".utf8_encode(__('Examen Médico'))."</label>"; ?>
				<?php echo $this->Form->input('examen_medico', array('div' => false, 'label' => false, 'class'=> 'txtExaMedico form-control','id' =>'txt-exa-medico','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo utf8_encode(__('N° de Poliza')); ?> </label>
				<?php echo $this->Form->input('nro_poliza', array('div' => false, 'label' => false, 'class'=> 'txtNroPoliza form-control','id' =>'txt-nro-poliza','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Poliza Videgente'); ?> </label><br>
				<input name="data[Trabajadore][poliza_vigente]" type="checkbox" value="<?php if(isset($obj_trabajador)){ echo ($obj_trabajador->getAttr('poliza_vigente') == 1)? "1":"0";}else{echo "0";} ?>" id="chbox-vigente" <?php if(isset($obj_trabajador)){ echo ($obj_trabajador->getAttr('poliza_vigente') == '1')? 'checked':'';}else{echo "";} ?>>
			</div>
		</div>
		<p>
		
		<div class="row">
			<?php
			if(isset($obj_trabajador) || isset($trabajador_id)){
				foreach($get_ids as $departamento_user => $v):
					foreach ($v as $distrito_user =>$provincia_user):
					//echo $departamento."--".$distrito ."--".$provincia;
					?>
					<input type="hidden" id="get_id_distrito" value="<?php echo $distrito_user; ?>"> 
					<input type="hidden" id="get_id_provincia" value="<?php echo $provincia_user; ?>">
					<input type="hidden" id="get_id_departamento" value="<?php echo $departamento_user; ?>">
					<?php
					endforeach;
				endforeach;
			}
			?>
			<div class="span3 col-md-3 col-sm-6 col-xs-6" style="margin-left: auto;">
				<?php echo "<label id='lblDepartamentos'>".utf8_encode(__('Departamento'))."</label>"; ?>
				<select name="data[Trabajadore][dpto]" class="cboDepartamentos form-control">
					<?php if(!$obj_trabajador){ ?>
					<option selected="selected" value="">
						--
						<?php echo utf8_encode(__('Seleccione Departamento')); ?>
						--
					</option>
					<?php }?>
					<?php 
					if (isset($list_all_departamentos)){
						foreach ($list_all_departamentos as $list_all_departamento):
							if(isset($obj_trabajador) || isset($trabajador_id)){
								if($list_all_departamento->getAttr('id') == $departamento_user){
									$selected = " selected = 'selected'";
								}else{
									$selected = "";
								}
							}
						echo "<option value = ".$list_all_departamento->getAttr('id').$selected.">".$list_all_departamento->getAttr('nomdepartamento')."</option>";
						endforeach;
					}
					?>
				</select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblProvincia'>".utf8_encode(__('Provincia'))."</label>"; ?>
				<select disabled class="cboProvincia form-control">
					<option selected="selected">
						--
						<?php echo utf8_encode(__('Seleccione Provincia')); ?>
						--
					</option>
					<?php
					if(isset($obj_trabajador) || isset($trabajador_id)){
						if (isset($list_all_provincias)){
							foreach ($list_all_provincias as $provincia_item => $v):
								
									if($provincia_item == $provincia_user){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
							echo "<option value = ".$provincia_item.$selected.">".$v."</option>";
							endforeach;
						}
					}
					?>
				</select>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblDistrito'>".utf8_encode(__('Distrito'))."</label>"; ?>
				<select disabled name="data[Trabajadore][distrito_id]" class="cboDistrito form-control">
					<option selected="selected" value="">
						--
						<?php echo  __('Seleccione Distrito'); ?>
						--
					</option>
					<?php
					if(isset($obj_trabajador) || isset($trabajador_id)){
						if (isset($list_all_distritos)){
							foreach ($list_all_distritos as $distrito_item):
								//if($distrito_user != 0){
									if($distrito_item->getAttr('id') == $distrito_user){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
								//}else{
								//	echo "<option value =0 selected>";
								//}
							echo "<option value = ".$distrito_item->getAttr('id').$selected.">".$distrito_item->getAttr('nomdistrito')."</option>";
							endforeach;
						}
					}
					?>
				</select>
			</div>
		</div>
		<p>
		<?php /*
		<div class="row">
			
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblFecNacimiento'>".__('Fecha de nacimiento')."</label>"; ?>
				<?php 
				if(isset($obj_trabajador)){
					$fec_nac = $obj_trabajador->getAttr('fec_nac');//1990-12-12
				
					if($fec_nac == '' || $fec_nac == NULL){
						$fec_nac = '';
					}else{
						$dd = substr($fec_nac,-2);
						$mm = substr($fec_nac, 5, 2);
						$yy = substr($fec_nac, 0, 4);
						$fec_nac = $dd.'-'.$mm.'-'.$yy;//12-12-1990
					}
				}
				?>
				<input name="data[Trabajadore][fec_nac]" class="txtFechaNacimiento form-control" id="txtFechaNacimiento" placeholder="dd-mm-aaaa" type="text" value="<?php if(isset($obj_trabajador)){ echo $fec_nac;}?>">
				<?php //echo $this->Form->input('fec_nac', array('type'=>'text', 'class'=> 'txtFechaNacimiento','id' =>'txtFechaNacimiento','div' => false, 'label' => false,'placeholder'=>'dd-mm-aaaa')); ?>
			</div>
			
			
		</div>*/?>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblEstCivil'>".__('Estado Civil')."</label>"; ?>
				<select name="data[Trabajadore][estado_civil_id]" class="cboEstadoCivil form-control"
					id="cboEstadoCivil">
					<?php 
						if(isset($list_all_estados_civiles)){
							foreach ($list_all_estados_civiles as $list_all_estados_civil):
							if(isset($obj_trabajador) || isset($trabajador_id)){
								if($list_all_estados_civil->getAttr('id') == $obj_trabajador->getAttr('estado_civil_id')){
									$selected = " selected = 'selected'";
								}else{
									$selected = "";
								}
							}else{
								$selected = "";
							}
							echo "<option value = ".$list_all_estados_civil->getAttr('id').$selected.">".$list_all_estados_civil->getAttr('descripcion')."</option>";
							endforeach;
						}
					?>
				</select>
			</div>
			
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label>".utf8_encode(__('Dirección'))."</label>"; ?>
				<?php echo $this->Form->input('direccion', array('id' =>'txtDireccion','class' =>'txtDireccion form-control','div' => false, 'label' => false,'placeholder' => utf8_encode(__("dirección")))); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label>".utf8_encode(__('Correo electrónico'))."</label>"; ?>
				<?php echo $this->Form->input('email', array('id' =>'txtCorreo','class' =>'txtCorreo form-control','div' => false, 'label' => false,'placeholder' =>'email')); ?>
			</div>
			
		</div>
		<p>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label>".utf8_encode(__('Teléfono/Celular'))."</label>"; ?>
				<?php echo $this->Form->input('telefono', array('id' =>'txtTelefono','class' =>'txtTelefono form-control','div' => false, 'label' => false,'placeholder' => utf8_encode(__("teléfono")))); ?>
				<?php echo $this->Form->input('celular', array('id' =>'txtMovil','class' =>'txtMovil form-control','div' => false, 'label' => false,'placeholder' => utf8_encode(__("móvil")))); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<label for="TrabajadoreFirma">Firma</label>
				<div class='fileupload fileupload-new' data-provides='fileupload'>
					<div class='uneditable-input span2'><i class='icon-file fileupload-exists'></i>
						<span class="btn btn-default btn-file" style="width:106px;height: 37px;margin-bottom: 4px;">
							<input type="file" name="data[Trabajadore][firma]" style="opacity:0; position:absolute;height: 35px;left: 0px;top: 29px;" id="TrabajadoreFirma">
							<span class="fileinput-new">Select image</span>
						</span>
					</div>
					<div class='fileupload-preview thumbnail' style='width:40%;height:40%;'>
					<?php if($obj_trabajador->getAttr('firma')!=''){?>
						<img src="<?php echo ENV_WEBROOT_FULL_URL.'files/firmas/'.$obj_trabajador->getAttr('firma'); ?>">
					<?php }else{?>
						<img src="">
					<?php }?>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:center;">
			<div class="span9">
				<button type="button" class="btn btn-large btn-success btn_crear_trabajador_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-trabajador"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
	<!--  </form>  -->
</div>
<hr>