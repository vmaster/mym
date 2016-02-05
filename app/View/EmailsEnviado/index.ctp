<script type="text/javascript">
$(document).ready(function(){

	$('#table_content_emails').DataTable({
	 	dom: 'T<"clear">lfrtip',
		tableTools: {
			"sSwfPath": env_webroot_script + "/lib/data.tables-1.10.6/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
	                "copy",
	                "csv",
	                "xls",
	                "pdf"
	                /*{
	                    "sExtends":    "collection",
	                    "aButtons":    [ "csv", "xls", "pdf" ]
	                }*/
	        ]
		}
	});

});
</script>
<div class="row">
	<div class="col-md-12">
		<h2>Listado de Emails Enviados</h2>
	</div>
</div>
<hr />
<div id="emails_enviado">
	<div class="well">
		<div id = "conteiner_all_rows">
	    <?php 
		if(empty($list_emails_enviado)){ 
			echo __('No hay datos de Emails enviados');
		}else{ ?>  
	      <?php 
	      	echo $this->element('EmailsEnviado/emails_enviado_row');
	 	  ?>
	    <?php }?>
	    </div>
	</div>


	<div class="modal fade" id="myModalDeleteEmailsEnviado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" empresa_id=''>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
					<h3 id="myModalLabel"><?php echo utf8_encode(__('Confirmar Eliminación')); ?></h3>
				</div>
				<div class="modal-body">
					<p class="error-text">
						<i class="icon-warning-sign modal-icon"></i>
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el Email enviado?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-emails-enviado-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
	
</div>