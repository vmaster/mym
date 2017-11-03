<table class="table" id="table_content_trabajadores">
	<thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo utf8_encode(__('Nombre y Apellido')); ?></th>
          <th><?php echo __('Actividad'); ?></th>
          <th><?php echo __('Sexo'); ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_trabajador as $trabajador):
		$n = $n + 1;
		?>
		<tr class="trabajador_row_container" trabajador_id="<?php echo $trabajador->getAttr('id'); ?>">
			<td><?php echo $n; ?></td>
			<td><?php echo $trabajador->getAttr('apellido_nombre'); ?></td>
			<td><?php echo ($trabajador->getAttr('actividade_id')==0)? "":$trabajador->Actividade->getAttr('descripcion'); ?></td>
			<td><?php echo $trabajador->getAttr('sexo'); ?></td>
			<td><a class="tooltip-mym" title="Ver" role="button" ><i class="fa fa-table view-actividades-trigger"></i> </a></td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>