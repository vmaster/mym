<script type="text/javascript">
	$(document).ready(function(){
		$('#txtBuscarFecIncio').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFin').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		function DownloadExcelResumenSeguimiento (){
			fec_incio = $('#txtBuscarFecIncio').val();
			fec_fin = $('#txtBuscarFecFin').val();
			location.href = env_webroot_script + "reportes/excel_resumen_seguimiento/" + "?fec_inicio=" + fec_incio + "&fec_fin="+fec_fin;
		}

		$('.btn-consultar-descargar').click(function(){
			DownloadExcelResumenSeguimiento();
		})


		function DownloadExcelResumenSeguimientoMedioAmbiente (){
			fec_incio = $('#txtBuscarFecIncio').val();
			fec_fin = $('#txtBuscarFecFin').val();
			location.href = env_webroot_script + "reportes/excel_resumen_seguimiento_medio_ambiente/" + "?fec_inicio=" + fec_incio + "&fec_fin="+fec_fin;
		}

		$('.btn-consultar-descargar-ma').click(function(){
			DownloadExcelResumenSeguimientoMedioAmbiente();
		})


		function DownloadExcelResumenSeguimientoInstalaciones (){
			fec_incio = $('#txtBuscarFecIncio').val();
			fec_fin = $('#txtBuscarFecFin').val();
			location.href = env_webroot_script + "reportes/excel_resumen_seguimiento_instalaciones/" + "?fec_inicio=" + fec_incio + "&fec_fin="+fec_fin;
		}

		$('.btn-consultar-descargar-i').click(function(){
			DownloadExcelResumenSeguimientoInstalaciones();
		})
	})
</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Reporte de descargo excel')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte5">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncio" id="txtBuscarFecIncio"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFin" id="txtBuscarFecFin"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
	</div>
	<p>
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<button type="button" style="background-color: gainsboro;margin-top: 5px" class="btn btn-large btn-consultar-descargar"><?php echo __('Descargar Resumen Seguimiento');?></button>
			<button type="button" style="background-color: gainsboro;margin-top: 5px" class="btn btn-large btn-consultar-descargar-ma"><?php echo __('Descargar Resumen Seguimiento de Medio Ambiente');?></button>
			<button type="button" style="background-color: gainsboro;margin-top: 5px" class="btn btn-large btn-consultar-descargar-i"><?php echo __('Descargar Resumen Seguimiento de Instalaciones');?></button>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<!--<a href="<?= ENV_WEBROOT_FULL_URL; ?>reportes/excel_resumen_seguimiento"><i class="fa fa-file"></i> descargar excel de resumen seguimiento</a>-->
		</div>
	</div>

</div>