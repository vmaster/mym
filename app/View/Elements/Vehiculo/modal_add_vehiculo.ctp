<div class="modal fade" id="myModalAddVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" index-button="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Registrar Nuevo Vehiculo')); ?></h3>
				</div>
				
				<div class="modal-body">
				<form action="<?= ENV_WEBROOT_FULL_URL; ?>vehiculo/add_vehiculo" method="post" id="form_create_vehiculo" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Nro Placa:')); ?> </label>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<input name="data[Vehiculo][nro_placa]" class= 'form-control' id ='txt-nro-placa'/>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo __('Tipo Vehiculo:'); ?> </label>
								</div>
								<div class="span3 col-md-3 col-sm-6 col-xs-6">
									<select name="data[Vehiculo][tipo_vehiculo_id]" class="cboTipoVehiculo form-control">
										<?php 
										App::import('Model', 'TipoVehiculo');
										$this->TipoVehiculo = new TipoVehiculo();
										$list_all_tipo_vehiculos = $this->TipoVehiculo->listTipoVehiculos();
										
										if (isset($list_all_tipo_vehiculos)){
											foreach ($list_all_tipo_vehiculos as $i => $d):
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
					<button class="btn btn-danger save-vehiculo-modal-trigger"><?php echo __('Enviar'); ?></button>
				</div>
				
			</div>
		</div>
</div>