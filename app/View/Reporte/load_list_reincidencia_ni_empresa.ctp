<script type="text/javascript">
$(document).ready(function() {
	$('#table-report5').DataTable({
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
	if(empty($list_ni_emp1) && empty($list_ni_emp2)){
		echo __('No hay datos estad&iacute;sticos');
			}else{ ?>
	<div id="conteiner_all_rows">
		<table id="table-report5" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo utf8_encode(__('Trabajador / U. Móvil')); ?>
					</th>
					<th><?php echo utf8_encode(__('Norma Incumplida')); ?>
					</th>
					<th><?php echo utf8_encode(__('N° de Informe')); ?>
					</th>
					<th><?php echo utf8_encode(__('Fecha')); ?>
					</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				foreach ($list_ni_emp1 as $key1 => $arr_emp1):
				?>
				<tr class="report_row_container">
					<td><?php echo "TRAB-".$arr_emp1['TrabajadorJoin']['apellido_nombre']; ?></td>
					<td><?php echo $arr_emp1['CodigosJoin']['codigo']; ?></td>
					<td><?php echo $arr_emp1['Acta']['num_informe']; ?></td>
					<td><?php echo $arr_emp1['Acta']['fecha']; ?></td>
				</tr>
				<?php 
				endforeach;

				foreach ($list_ni_emp2 as $key2 => $arr_emp2):
				?>
				<tr class="report_row_container">
					<td><?php echo "VEH-".$arr_emp2['VehiculosJoin']['nro_placa']; ?></td>
					<td><?php echo $arr_emp2['CodigosJoin']['codigo']; ?></td>
					<td><?php echo $arr_emp2['Acta']['num_informe']; ?></td>
					<td><?php echo date('Y-m-d H:i',strtotime($arr_emp2['Acta']['fecha'])); ?></td>
				</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?php }?>
</div>
