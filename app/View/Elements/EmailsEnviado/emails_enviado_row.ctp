<table class="table" id="table_content_emails">
	<thead>
        <tr>
          <th>N&uacute;mero Informe</th>
          <th>Fecha</th>
          <th>Email destino</th>
          <th>Email Copia</th>
          <!--<th>Oper</th>-->
        </tr>
    </thead>
	<tbody>
		<?php
		$n = 0;
		foreach ($list_emails_enviado as $emails_enviado):
		$n = $n + 1;
		?>
		<tr class="emails_enviado_row_container" email-enviado-id="<?php echo $emails_enviado->getAttr('id'); ?>">
			<td><?php echo $emails_enviado->Acta->getAttr('num_informe'); ?></td>
			<td><?php echo $emails_enviado->getAttr('created'); ?></td>
			<td><?php echo $emails_enviado->getAttr('emails_destino'); ?></td>
			<td><?php echo $emails_enviado->getAttr('emails_copy'); ?></td>
			<!--
			<td><?php if($this->Session->read('Auth.User.tipo_user_id') == 1) { ?>
					<a href="#myModalDeleteEmailsEnvio" role="button" data-toggle="modal"><i class="fa fa-times open-model-delete-emails-enviado"></i> </a>
				<?php } ?>
			</td>
			-->
		</tr>
		<?php 
		endforeach;
		?>
	</tbody>	
</table>