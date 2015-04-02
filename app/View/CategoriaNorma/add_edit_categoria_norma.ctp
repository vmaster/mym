<div class="container div-crear-categoria-norma form" id="div-crear-categoria-norma">
	<?php echo $this->Form->create('CategoriaNorma',array('method'=>'post', 'id'=>'add_edit_categoria_norma'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNombreNormaCategoria'>".__('Categor&iacute;a')."</label>"; ?>
				<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false, 'class'=> 'txtDescripcion form-control','id' =>'txtDescripcion','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn-crear-categoria-norma-trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-categoria-norma"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>