<table class="table" id="table_content_vehiculos">
	<thead>
        <tr>
          <th><?php echo utf8_encode(__('N°')); ?></th>
          <th><?php echo utf8_encode(__('Nro Placa')); ?></th>
          <th><?php echo utf8_encode(__('Nro Soat')); ?></th>
          <th><?php echo utf8_encode(__('Nro Revisión Técnica')); ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_vehiculo as $vehiculo):
		$n = $n + 1;
		?>
		<tr class="vehiculo_row_container" vehiculo_id="<?php echo $vehiculo->getAttr('id'); ?>">
			<td><?php echo $n; ?></td>
			<td><?php echo $vehiculo->getAttr('nro_placa'); ?></td>
			<td><?php echo $vehiculo->getAttr('nro_soat'); ?></td>
			<td><?php echo $vehiculo->getAttr('nro_rev_tec'); ?></td>
			<td><a><i class="fa fa-pencil edit-vehiculo-trigger"></i> </a> 
				<a href="#myModalDeleteVehiculo" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-vehiculo"></i> </a>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>