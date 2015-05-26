<script type="text/javascript">
$(document).ready(function() {
	$('#table-report2').DataTable({
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
<div class="well" style="width: 65%;">
	<?php	
	if(empty($list_info_uunn)){
		echo __('No hay datos estad&iacute;sticos');
			}else{ ?>
	<div id="conteiner_all_rows">
		<table id="table-report2" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo utf8_encode(__('Unidad de Negocio')); ?>
					</th>
					<th><?php echo utf8_encode(__('N° de Informe')); ?>
					</th>
					<th><?php echo utf8_encode(__('Fecha')); ?>
					</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				foreach ($list_info_uunn as $arr_uunn):
				?>
				<tr class="report_row_container">
					<td><?php echo $arr_uunn->UnidadesNegocio->getAttr('descripcion'); ?></td>
					<td><?php echo $arr_uunn->getAttr('num_informe'); ?></td>
					<td><?php echo date('Y-m-d H:i',strtotime($arr_uunn->getAttr('fecha'))); ?></td>
				</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?php }?>
</div>
