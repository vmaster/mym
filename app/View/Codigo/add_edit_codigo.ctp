<div class="container div-crear-codigo form" id="div-crear-codigo">
	<?php echo $this->Form->create('Codigo',array('method'=>'post', 'id'=>'add_edit_codigo'));?>
	<section>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblPlacaCodigo'>".__('Codigo')."</label>"; ?>
				<?php echo $this->Form->input('codigo', array('div' => false, 'label' => false, 'class'=> 'txtCodigo form-control','id' =>'txtCodigo','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();','maxlength'=>'100')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblCategoria'>".__('Categor&iacute;a')."</label>"; ?>
				<select name="data[Codigo][categoria_id]" class="cboCategorias form-control">
					<?php 
					if (isset($list_all_categorias)){
						foreach ($list_all_categorias as $id => $des):
						if(isset($obj_codigo) || isset($codigo_id)){
							if($id == $obj_codigo->getAttr('categoria_id')){
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
			</div>
		</div>
		<p>
		<div class="row">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblCategoria'>".utf8_encode(__('Observación'))."</label>"; ?>
				<?php echo $this->Form->textarea('observacion', array('div' => false, 'rows' => '3', 'cols' => '5', 'label' => false, 'class'=> 'txtObservacion form-control','id' =>'txtObservacion','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<?php echo "<label id='lblNormaIncumplida'>".utf8_encode(__('Norma Incumplida'))."</label>"; ?>
				<?php echo $this->Form->textarea('norma_incumplida', array('div' => false, 'rows' => '3', 'cols' => '5', 'label' => false, 'class'=> 'txtNorInc form-control','id' =>'txtNorInc','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();')); ?>
			</div>
		</div>
		<br>
		<div class="row" style="text-align:left;">
			<div class="span3 col-md-3 col-sm-6 col-xs-6">
				<button type="button" class="btn btn-large btn-success btn-crear-codigo-trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
				<button type="button" class="btn btn-large btn-cancelar-crear-codigo"><?php echo __('Cancelar');?></button>
			</div>
		</div>
	</section>
	<?php echo $this->Form->end(); ?>
<hr>
</div>