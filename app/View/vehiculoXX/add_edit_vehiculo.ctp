<div class="container div-crear-vehiculo form" id="div-crear-vehiculo">
	<?php echo $this->Form->create('Vehiculo',array('method'=>'post', 'id'=>'add_edit_vehiculo'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreVehiculo'>".__('Nombre de veh&iacute;culo')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false, 'class'=> 'txtDescripcion form-control','id' =>'txtDescripcion')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn_crear_vehiculo_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-vehiculo"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>