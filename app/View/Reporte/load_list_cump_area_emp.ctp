<script type="text/javascript">
$(document).ready(function() {
	$('#table-report001').DataTable({
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
			},
			paging: false
		});
} );
</script>
<div class="well" style="width: 80%;">
	<?php	
	if(empty($list_sep_emp)){
		echo __('No hay datos estad&iacute;sticos');
			}else{ ?>
	<div id="conteiner_all_rows">
		<table id="table-report001" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><?php echo utf8_encode(__('Fecha')); ?>
					</th>
					<?php
					foreach ($list_sep_emp as $arr_acta){
					?>
						<th><?php echo $arr_acta->getAttr('num_informe'); ?></th>

					<?php
					}
					?>
				</tr>
			</thead>

			<tbody>
				<?php 
				foreach ($list_sep_emp as $arr_fecha1):
				?>
				<tr class="report_row_container">
					<td><?php echo $arr_fecha1->getAttr('fecha'); ?></td>
					<?php 
					foreach ($list_sep_emp as $arr_fecha2):
						if($arr_fecha1->getAttr('fecha') == $arr_fecha2->getAttr('fecha')){
					?>
							<td><?= $arr_fecha1->getAttr('cumplimiento'); ?>%</td>
					<?php
						}else{
					?>
							<td></td>
					<?php
						}
					endforeach;
					?>
					</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?php }?>
</div>
