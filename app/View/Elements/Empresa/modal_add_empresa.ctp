<div class="modal fade" id="myModalAddEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" acta_id= ''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Registrar nueva Empresa')); ?></h3>
				</div>
				
				<div class="modal-body">
				<?php echo $this->Form->create('Empresa',array('method'=>'post', 'id'=>'form_create_empresa','action'=> false));?>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Nombre de empresa')); ?> </label>
								</div>
								<div class="span3 col-md-5 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('nombre', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'txt-nombre-empresa')); ?>
								</div>
							</div>
				<?php echo $this->Form->end(); ?>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger save-empresa-modal-trigger"><?php echo __('Enviar'); ?></button>
				</div>
				
			</div>
		</div>
</div>