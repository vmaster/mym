<style>
.not-active {
   pointer-events: none;
   cursor: default;
   color: gray;
}
</style>
<table class="table" id="table_content_actas">
	<thead>
        <tr>
	  <th width="15"><?php echo utf8_encode(__('Nro Informe')); ?></th>
	  <th width="20"><?php echo utf8_encode(__('Empresa')); ?></th>
          <th width="30"><?php echo utf8_encode(__('Actividad')); ?></th>
          <th width="20"><?php echo utf8_encode(__('Responsable Supervisión')); ?></th>
          <th width="7"><?php echo utf8_encode(__('Fecha')); ?></th>
          <th width="8"><?php echo __('Operaciones'); ?></th>
        </tr>
    </thead>
	<tbody>
		<?php
		$cont = 1;
		foreach ($list_acta as $acta):
		?>
		<tr class="acta_row_container" acta_id="<?php echo $acta->getAttr('id'); ?>" style="<?php echo ($acta->getAttr('revisado')==0)?'background-color:#BADEFB' : ''; ?>">
			<td><?php echo $acta->getAttr('num_informe'); ?></td>
			<td><?php echo $acta->Empresa->getAttr('nombre'); ?></td>
			<td><?php echo ($acta->getAttr('actividad')=='')?"":$acta->getAttr('actividad'); ?></td>
						
			<td><?php  
				if($acta->getAttr('reponsable_sup_id') > 0){
							//if($acta->Trabajadore2){
					echo $acta->Trabajadore2->getAttr('apellido_nombre');
					}else{
						echo "--";
							//}
				}
			?>
			</td>
			<td><?php echo date('Y-m-d',strtotime($acta->getAttr('fecha'))); ?></td>
			<td>
			<center>
					<a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/descargar_img/<?php echo $acta->getAttr('id')?>"><i class="fa fa-download fa-lg"></i> </a>
			</center>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>