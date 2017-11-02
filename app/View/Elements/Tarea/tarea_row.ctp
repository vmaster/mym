<table class="table" id="table_content_tareas">
	<thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo __('Numero Tarea'); ?></th>
          <th><?php echo __('Fecha'); ?></th>
          <th><?php echo 'Informe de Ref'; ?></th>
		  <th><?php echo 'Medio de Transporte'; ?></th>
          <th><?php echo 'Trabajador'; ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_tarea as $tarea):
		$n = $n + 1;
		?>
		<tr class="tarea_row_container" tarea_id="<?php echo $tarea->getAttr('id'); ?>" estado="<?php echo $tarea->getAttr('estado'); ?>" dia_libre="<?php echo $tarea->getAttr('dia_libre'); ?>">
			<?php 
				$f_creacion = date("d-m-Y", strtotime($tarea->getAttr('created')));
				$f_hoy = date("d-m-Y");
			?> 
			<td><?php echo $n; ?></td>
			<td><?php echo $tarea->getAttr('id'); ?></td>
			<td><?php echo $f_creacion; ?></td>
			<td><?php echo 'M&M - '.str_pad($tarea->getAttr('informe_ref'), 5, "0", STR_PAD_LEFT); ?></td>
			<td><?php echo ($tarea->getAttr('movilidad') == 0)?'Viaticos':'Placa: '.$tarea->getAttr('placa_auto'); ?></td>
			<td><?php echo $tarea->User->Trabajadore->getAttr('apellido_nombre'); ?></td>
			<td>
				<a href="#myModalViewTarea" class="tooltip-mym" title="Ver" role="button" data-toggle="modal"><i class="fa fa-eye view-tarea-trigger"></i> </a>
				&nbsp;
				
				<?php if(($f_creacion == $f_hoy) || ($tarea->getAttr('estado') == 1)) { ?>
					<a href="<?= ENV_WEBROOT_FULL_URL; ?>tareas/editar_tarea/<?php echo $tarea->getAttr('id')?>" class="tooltip-mym" title="Editar" role="button"><i class="fa fa-pencil edit-tarea-trigger"></i> </a>
				<?php } ?>

				<?php 
				if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<!--<a href="#myModalDeleteTarea" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-tarea"></i> </a>
					-->	
					<a href="#myModalActiveEditTarea" class="tooltip-mym" title="Permitir Editar" role="button" data-toggle="modal"><i class="fa <?php echo ($tarea->getAttr('estado') == 1)?'fa-check-square-o': 'fa-square-o'; ?>  open-modal-edit-tarea"></i> </a>
					&nbsp;
					<a href="#myModalActiveDiaLibre" class="tooltip-mym" title="Dia Libre" role="button" data-toggle="modal"><i class="fa <?php echo ($tarea->getAttr('dia_libre') == 1)?'fa-user': 'fa-sun-o'; ?>  open-modal-dia-libre"></i> </a>
				<?php } ?>


				<?php if(($f_creacion == $f_hoy)) { 
					echo " <b>HOY</b>";
				} ?>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>