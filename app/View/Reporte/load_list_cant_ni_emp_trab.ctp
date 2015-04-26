<script type="text/javascript">
$(document).ready(function() {
	$('#table-report3').DataTable({
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
<div class="well" style="width: 50%;">
	<?php	
	if(empty($list_info_emp_trab)){
		echo __('No hay datos estad&iacuter;sticos');
			}else{ ?>
	<div id="conteiner_all_rows">
		<table id="table-report3" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo utf8_encode(__('Nombre de Empresa')); ?>
					</th>
					<th><?php echo utf8_encode(__('Trabajador')); ?>
					</th>
					<th><?php echo utf8_encode(__('NI')); ?>
					</th>
					<th><?php echo utf8_encode(__('N° Informe')); ?>
					</th>
					<th><?php echo utf8_encode(__('Fecha')); ?>
					</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				foreach ($list_info_emp_trab as $key => $arr_emp_trab):
				?>
				<tr class="report_row_container">
					<td><?php echo $arr_emp_trab['EmpresasJoin']['nombre']; ?></td>
					<td><?php echo $arr_emp_trab['TrabajadorJoin']['apellido_nombre']; ?></td>
					<td><?php echo $arr_emp_trab['CodigosJoin']['codigo']; ?></td>
					<td><?php echo $arr_emp_trab['Acta']['num_informe']; ?></td>
					<td><?php echo $arr_emp_trab['Acta']['fecha']; ?></td>
				</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?php }?>
</div>
