<table class="table" id="table_content_tareas">
	<thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo __('Fecha'); ?></th>
          <th><?php echo 'Actividades'; ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_tarea as $tarea):
		$n = $n + 1;
		?>
		<tr class="tarea_row_container" tarea_id="<?php echo $tarea->getAttr('id'); ?>" estado="<?php echo $tarea->getAttr('estado'); ?>">
			<?php 
				$f_creacion = date("d-m-Y", strtotime($tarea->getAttr('created')));
				$f_hoy = date("d-m-Y");
			?> 
			<td><?php echo $n; ?></td>
			<td><?php echo $f_creacion; ?></td>
			<td><?php echo $tarea->getAttr('descripcion'); ?></td>
			<td>
				<a href="#myModalViewTarea" role="button" data-toggle="modal"><i class="fa fa-eye view-tarea-trigger"></i> </a>
				&nbsp;
				
				<?php if(($f_creacion == $f_hoy) || ($tarea->getAttr('estado') == 1)) { ?>
					<a><i class="fa fa-pencil edit-tarea-trigger"></i> </a>
				<?php } ?>

				<?php 
				if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<!--<a href="#myModalDeleteTarea" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-tarea"></i> </a>
					-->	
					<a href="#myModalActiveEditTarea" role="button" data-toggle="modal"><i class="fa <?php echo ($tarea->getAttr('estado') == 1)?'fa-check-square-o': 'fa-square-o'; ?>  open-modal-edit-tarea"></i> </a>
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