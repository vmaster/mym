<div class="container div-crear-vehiculo form" id="div-crear-vehiculo">
	<?php echo $this->Form->create('Vehiculo',array('method'=>'post', 'id'=>'add_edit_vehiculo'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblPlacaVehiculo'>".__('Nro de Placa')."</label>"; ?>
				<?php echo $this->Form->input('nro_placa', array('div' => false, 'label' => false, 'class'=> 'txtNroPlaca form-control','id' =>'txtNroPlaca','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblTipoVehiculo'>".__('Tipo Vehiculo')."</label>"; ?>
				<select name="data[Vehiculo][tipo_vehiculo_id]" class="cboTipoVehiculos form-control">
					<?php 
					if (isset($list_all_vehiculos)){
						foreach ($list_all_vehiculos as $id => $des):
						if(isset($obj_vehiculo) || isset($vehiculo_id)){
							if($id == $obj_vehiculo->getAttr('tipo_vehiculo_id')){
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
				<?php echo "<label id='lblNroSoat'>".__('Nro de SOAT')."</label>"; ?>
				<?php echo $this->Form->input('nro_soat', array('div' => false, 'label' => false, 'class'=> 'txtNroSoat form-control','id' =>'txtNroSoat','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<p>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php 
				echo "<label id='lblFecVecSoat'>".__('Fecha Venc SOAT')."</label>"; 
				if(isset($obj_vehiculo)){
					$fec_ven_soat = $obj_vehiculo->getAttr('fec_ven_soat');//1990-12-12

					if($fec_ven_soat == '' || $fec_ven_soat == NULL){
						$fec_ven_soat = '';
					}else{
						$dd = substr($fec_ven_soat,-2);
						$mm = substr($fec_ven_soat, 5, 2);
						$yy = substr($fec_ven_soat, 0, 4);
						$fec_ven_soat = $dd.'-'.$mm.'-'.$yy;//12-12-1990
					}
				}else{
					$fec_ven_soat = '';
				}
				?>
				<input name="data[Vehiculo][fec_ven_soat]" class="txtFecVenSoat form-control" id="txtFecVenSoat" placeholder="dd-mm-aaaa" type="text" value="<?php echo $fec_ven_soat;?>">
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNroRevTec'>".utf8_encode(__('Nro Revisión Técnica'))."</label>"; ?>
				<?php echo $this->Form->input('nro_rev_tec', array('div' => false, 'label' => false, 'class'=> 'txtNroRevTec form-control','id' =>'txtNroRevTec','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php 
				echo "<label id='lblFecVecSoat'>".utf8_encode(__('Fecha Rev Técnica'))."</label>"; 
				if(isset($obj_vehiculo)){
					$fec_rev_tec = $obj_vehiculo->getAttr('fec_rev_tec');//1990-12-12

					if($fec_rev_tec == '' || $fec_rev_tec == NULL){
						$fec_rev_tec = '';
					}else{
						$dd = substr($fec_rev_tec,-2);
						$mm = substr($fec_rev_tec, 5, 2);
						$yy = substr($fec_rev_tec, 0, 4);
						$fec_rev_tec = $dd.'-'.$mm.'-'.$yy;//12-12-1990
					}
				}else{
					$fec_rev_tec = '';
				}
				?>
				<input name="data[Vehiculo][fec_rev_tec]" class="txtFecRevTec form-control" id="txtFecRevTec" placeholder="dd-mm-aaaa" type="text" value="<?php echo $fec_rev_tec;?>">
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn-crear-vehiculo-trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-vehiculo"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>