<script>
function visitorData (valores) {
	   $('#container-graf6').highcharts({
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Nivel de cumplimiento por empresa'
	    },
	    xAxis: {
	        categories: valores.categoria
	    },
	    yAxis: {
	        title: {
	            text: 'Porcentaje de cumplimiento'
	        }
	    },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Porcentaje de Cumplimiento: {point.y:.f}%</td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },        
	    series: [{
	    	name: valores.name,
	    	colorByPoint: true,
		    data: valores.data
	       }]
	  });
}
	
	$(document).ready(function() {

		function ExecuteReport6(){
			fec_incio = $('#txtBuscarFecIncioRep6').val();
			fec_fin = $('#txtBuscarFecFinRep6').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_cumplimiento_emp/'+fec_incio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte6 #list-data-cumplimiento-emp').unbind();
					$('div#reporte6 #list-data-cumplimiento-emp').load(env_webroot_script + 'reportes/load_list_cumplimiento_emp/'+fec_incio+'/'+fec_fin,function(){
						
					});
			});
		}

		ExecuteReport6();

		$( ".btn-consultar-report6" ).click(function() {
				ExecuteReport6();
		});

		/* Date Picker */
		$('#txtBuscarFecIncioRep6').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinRep6').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#table-report6').DataTable();
	});


</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Nivel de Cumplimiento por Empresas (%)')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte6">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncioRep6" id="txtBuscarFecIncioRep6"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinRep6" id="txtBuscarFecFinRep6"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-report6"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf6" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cumplimiento-emp">
		</div>
	</center>
</div>
