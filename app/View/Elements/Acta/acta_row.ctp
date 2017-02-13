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
				<?php if((($this->Session->read('Auth.User.tipo_user_id') != 3) && ($this->Session->read('Auth.User.id') == $acta->getAttr('reponsable_sup_id'))) || $this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/editar_informe/<?php echo $acta->getAttr('id')?>"><i class="fa fa-pencil fa-lg"></i> </a>| 
				<?php } ?>
				<a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/view_informe/<?php echo $acta->getAttr('id')?>" target="_blank"><i class="fa fa-search fa-lg"></i> </a>
				<?php if((($this->Session->read('Auth.User.tipo_user_id') == 2) && ($this->Session->read('Auth.User.id') == $acta->getAttr('reponsable_sup_id'))) || $this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					|
					<a href="#myModalDeleteActa" role="button" data-toggle="modal" class="<?php if(($this->Session->read('Auth.User.tipo_user_id') == 2) && ($this->Session->read('Auth.User.id') != $acta->getAttr('reponsable_sup_id'))) { ?>not-active<?php }?>"><i class="fa fa-times open-model-delete-acta fa-lg"></i> </a>
				<?php } ?>	
					<?php if($this->Session->read('Auth.User.tipo_user_id') == 1){ ?>
					 | <input name="chRevisado<?php echo $cont++; ?>" type="checkbox" value="<?php echo ($acta->getAttr('revisado')==1)?1 : 0; ?>" id="chRevisado" <?php echo ($acta->getAttr('revisado')==1)?'checked':''; ?>> | 
					<a href="#myModalSendReport" role="button" data-toggle="modal" class="<?php if(($this->Session->read('Auth.User.tipo_user_id') == 2) && ($this->Session->read('Auth.User.id') != $acta->getAttr('reponsable_sup_id'))) { ?>not-active<?php }?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo ($acta->getAttr('fecha_envio')!='' && $acta->getAttr('fecha_envio')!=null)?'Se envio':'No se envio'?>" class="fa fa-envelope open-model-send-informe fa-lg" style="<?php echo ($acta->getAttr('fecha_envio')!='' && $acta->getAttr('fecha_envio')!=null)?'color:burlywood':''?>"></i> </a>
					<?php }?>
			</center>
			</td>
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>