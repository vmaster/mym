<script>
$(document).ready(function() {
	$('#exampletable').dataTable( {
        "ajax": "vehiculos/server_processing",
        "columns": [
            { "data": "descripcion" }
        ]
    } );
});
</script>
<div id="vehiculo">
	<div id="add_edit_vehiculo_container">
	</div>
	
	<div class="btn-toolbar">
	    <button class="btn btn-primary btn-nuevo-vehiculo"><i class="icon-plus"></i> <?php echo __('Nuevo Veh&iacute;culo'); ?></button>
	  <div class="btn-group">
	  </div>
	</div>
	<p>
	<div class="row">
		<div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div>
	</div>
	<div class="well">
		<div id="conteiner_all_rows">

			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="exampletable">
						<thead>
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="example" aria-sort="ascending" aria-label="Name: activate to sort column descending"><?php echo __('ID'); ?></th>

								<th class="sorting_asc" tabindex="0" aria-controls="example" aria-sort="ascending" aria-label="Name: activate to sort column descending"><?php echo utf8_encode(__('Descripción')); ?></th>

								<th><?php echo __('Operaciones'); ?></th>
								<th style="width: 26px;"></th>
							</tr>
						</thead>

						<tbody>
							<tr role="row" class="vehiculo_row_container"
								vehiculo_id="">
								<td></td>
								<td></td>
								<td><a><i class="fa fa-pencil edit-vehiculo-trigger"></i> </a> <a
									href="#myModalDeleteVehiculo" role="button" data-toggle="modal"><i
										class="fa fa-times open-model-delete-vehiculo"></i> </a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="pagination">
	    <ul>
	        <li><a href="#">Prev</a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li><a href="#">Next</a></li>
	    </ul>
	</div>
	 -->

	<div class="modal fade" id="myModalDeleteVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" vehiculo_id=''>
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
						<?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el Tipo de Vehículo?')); ?>
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Cancelar'); ?></button>
					<button class="btn btn-danger eliminar-vehiculo-trigger" data-dismiss="modal"><?php echo __('Aceptar'); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>