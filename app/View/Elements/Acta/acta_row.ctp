<table class="table" id="table_content_actas">
	<thead>
        <tr>
          <th><?php echo utf8_encode(__('Nro Acta')); ?></th>
          <th><?php echo utf8_encode(__('Actividad')); ?></th>
          <th><?php echo utf8_encode(__('Obra')); ?></th>
          <th><?php echo utf8_encode(__('Responsable Supervisión')); ?></th>
          
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		foreach ($list_acta as $acta):
		?>
		<tr class="acta_row_container" acta_id="<?php echo $acta->getAttr('id'); ?>">
		
			<td><?php echo $acta->getAttr('numero'); ?></td>
			<td><?php echo ($acta->getAttr('actividad')=='')?"":$acta->getAttr('actividad'); ?></td>
			<td><?php echo $acta->getAttr('obra'); ?></td>
			<td><?php echo $acta->Trabajadore2->getAttr('apellido_nombre'); ?></td>
			<td><a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/editar_informe/<?php echo $acta->getAttr('id')?>"><i class="fa fa-pencil fa-lg"></i> </a>| 
				<a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/view_informe/<?php echo $acta->getAttr('id')?>" target="_blank"><i class="fa fa-search fa-lg"></i> </a> |
				<a href="#myModalDeleteActa" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-acta fa-lg"></i> </a>|
				<a href="#myModalSendReport" role="button" data-toggle="modal"><i class="fa fa-envelope open-model-send-informe fa-lg"></i> </a>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>