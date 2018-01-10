<script type="text/javascript">
$(document).ready(function() {
	$('#table-report1').DataTable({
			bFilter: false,
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
} );
</script>
<div class="well" style="width: 80%;">
	<?php	
	if(empty($list_camioneta_asesor)){
		echo __('No hay datos estad&iacute;sticos');
			}else{ ?>
	<div id="conteiner_all_rows">
		<table id="table-report1" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo utf8_encode(__('Nombre de Asesor')); ?></th>
					<th><?php echo utf8_encode(__('N° Informe Ref.')); ?></th>
					<th><?php echo utf8_encode(__('Placa Camioneta')); ?></th>
					<th><?php echo utf8_encode(__('Fecha')); ?></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				foreach ($list_camioneta_asesor as $arr_camioneta):
				?>
				<tr class="report_row_container">
					<td><?php echo $arr_camioneta->User->Trabajadore->getAttr('apellido_nombre'); ?></td>
					<td><?php echo $arr_camioneta->getAttr('informe_ref'); ?></td>
					<td><?php echo $arr_camioneta->getAttr('placa_auto	'); ?></td>
					<td><?php echo date('Y-m-d H:i',strtotime($arr_camioneta->getAttr('created'))); ?></td>
				</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?php }?>
</div>
