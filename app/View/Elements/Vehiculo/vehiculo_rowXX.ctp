<script type="text/javascript">
<!--
$(document).ready(function(){
    $('#js-datatable').dataTable(
    		"columns": [
    		            { "data": "descripcion" }
    		        ]
   );

    
});
//-->
</script>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table" id="js-datatable">
			<thead>
				<tr>
					<th><?php echo __('ID'); ?></th>

					<th><?php echo utf8_encode(__('Descripción')); ?></th>

					<th><?php echo __('Operaciones'); ?></th>
					<th style="width: 26px;"></th>
				</tr>
			</thead>
			<?php 
			$n = 0;
			foreach ($list_vehiculo as $vehiculo):
			$n = $n + 1;
			?>
			<tbody>
				<tr class="vehiculo_row_container"
					vehiculo_id="<?php echo $vehiculo->getAttr('id'); ?>">
					<td><?php echo $n; ?></td>
					<td><?php echo $vehiculo->getAttr('descripcion'); ?></td>
					<td><a><i class="fa fa-pencil edit-vehiculo-trigger"></i> </a> <a
						href="#myModalDeleteVehiculo" role="button" data-toggle="modal"><i
							class="fa fa-times open-model-delete-vehiculo"></i> </a>
					</td>
				</tr>
				<?php 
				endforeach;
				?>
			</tbody>
		</table>
	</div>
</div>
