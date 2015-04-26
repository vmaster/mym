<div class="container div-crear-unidades-negocio form" id="div-crear-unidades-negocio">
	<?php echo $this->Form->create('UnidadesNegocio',array('method'=>'post', 'id'=>'add_edit_unidades_negocio'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblUnidadesNegocio'>".__('UUNN')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false, 'class'=> 'txtUuNn form-control','id' =>'txtUuNnMant','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn-crear-unidades-negocio-trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-unidades-negocio"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>