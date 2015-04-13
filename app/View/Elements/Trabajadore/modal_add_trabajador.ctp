<div class="modal fade" id="myModalAddTrabajador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" index-button="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Registrar Nuevo Trabajador')); ?></h3>
				</div>
				
				<div class="modal-body">
				<form action="<?= ENV_WEBROOT_FULL_URL; ?>trabajadore/add_trabajador" method="post" id="form_create_trabajador" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Apellidos y Nombres:')); ?> </label>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php //echo $this->Form->input('apellido_nombre', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'txt-apellido-nombre')); ?>
									<input name="data[Trabajadore][apellido_nombre]" class= 'form-control' id ='txt-apellido-nombre'/>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo __('Actividad:'); ?> </label>
								</div>
								<div class="span3 col-md-3 col-sm-6 col-xs-6">
									<select name="data[Trabajadore][actividade_id]" class="cboTipoTrabajadores form-control">
										<?php 
										App::import('Model', 'Actividade');
										$this->Actividade = new Actividade();
										$list_all_actividades = $this->Actividade->listActividades();
										
										if (isset($list_all_actividades)){
											foreach ($list_all_actividades as $i => $d):
											echo "<option value = ".$i.">".$d."</option>";
											endforeach;
										}
										?>
									</select>
								</div>
							</div>
				</form>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger save-trabajador-modal-trigger"><?php echo __('Enviar'); ?></button>
				</div>
				
			</div>
		</div>
</div>