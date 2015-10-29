<table class="table" id="table_content_empresas">
	<thead>
        <tr>
          <th><?php echo __('ID'); ?></th>
          <th><?php echo utf8_encode(__('Nombre de Empresa')); ?></th>
          <th><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php 
		$n = 0;
		foreach ($list_empresa as $empresa):
		$n = $n + 1;
		?>
		<tr class="empresa_row_container" empresa_id="<?php echo $empresa->getAttr('id'); ?>">
			<td><?php echo $n; ?></td>
			<td><?php echo $empresa->getAttr('nombre'); ?></td>
			<td><a><i class="fa fa-pencil edit-empresa-trigger"></i> </a> <?php if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
				<a href="#myModalDeleteEmpresa" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-empresa"></i> </a><?php } ?>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>