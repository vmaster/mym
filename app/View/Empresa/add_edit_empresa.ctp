<div class="container div-crear-empresa form" id="div-crear-empresa">
	<?php echo $this->Form->create('Empresa',array('method'=>'post', 'id'=>'add_edit_empresa'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreEmpresa'>".__('Nombre de Empresa')."</label>"; ?>
				<?php echo $this->Form->input('nombre', array('div' => false, 'label' => false, 'class'=> 'txtNombreEmpresa form-control','id' =>'txtEmpresaMant','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn_crear_empresa_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-empresa"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>