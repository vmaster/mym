<script type="text/javascript">
	$(document).ready(function(){
		$('#txtBuscarFecIncio').datepicker(
				{
					changeYear: true, 
					dateFormat: 'yy-mm-dd',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFin').datepicker(
				{
					changeYear: true, 
					dateFormat: 'yy-mm-dd',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		function DownloadExcelResumenSeguimiento (){
			fec_incio = $('#txtBuscarFecIncio').val();
			fec_fin = $('#txtBuscarFecFin').val();
			location.href = env_webroot_script + "reportes/excel_tareas_asistencia/" + "?fec_inicio=" + fec_incio + "&fec_fin="+fec_fin;
		}

		$('.btn-consultar-descargar').click(function(){
			DownloadExcelResumenSeguimiento();
		})
	})
</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Descargar Excel - Control de Asistencia')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte5">
	<?php 
	$fecha_inicio= date('Y').'-'.date('m')."-01";
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncio" id="txtBuscarFecIncio"
				class="form-control" value="<?php echo $fecha_inicio; ?>" placeholder="aaaa-mm-dd">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFin" id="txtBuscarFecFin"
				class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="aaaa-mm-dd">
		</div>
	</div>
	<p>
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<button type="button" class="btn btn-large btn-consultar-descargar"><?php echo __('Descargar Resumen Seguimiento');?></button>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<!--<a href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/excel_resumen_seguimiento"><i class="fa fa-file"></i> descargar excel de resumen seguimiento</a>-->
		</div>
	</div>

</div>