<script type="text/javascript">
$(document).ready(function() {
	$('#table-report6').DataTable({
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
	if(empty($list_total_ni_nc)){
		echo __('No hay datos estad&iacute;sticos');
			}else{ ?>
	<div id="conteiner_all_rows">
		<table id="table-report6" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo utf8_encode(__('Nombre de Empresa')); ?>
					</th>
					<th><?php echo utf8_encode(__('N° Informe')); ?>
					</th>
					<th><?php echo utf8_encode(__('Fecha')); ?>
					</th>
					<th><?php echo utf8_encode(__('Cumplimiento(%)')); ?>
					</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				foreach ($list_total_ni_nc as $arr_informe):
				?>
				<tr class="report_row_container">
					<td><?php echo $arr_informe->Empresa->getAttr('nombre'); ?></td>
					<td><?php echo $arr_informe->getAttr('num_informe'); ?></td>
					<td><?php echo date('Y-m-d H:i',strtotime($arr_informe->getAttr('fecha'))); ?></td>
					<td><?php echo $arr_informe->getAttr('cumplimiento'); ?></td>
				</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?php }?>
</div>