<script>
function visitorData (valores) {
	   $('#container-graf2').highcharts({
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'N\u00FAmero de informes por Unidad de Negocio'
	    },
	    xAxis: {
	        categories: valores.categoria
	    },
	    yAxis: {
	        title: {
	            text: 'N\u00FAmero de informes'
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
            pointFormat: '<tr><td style="color:{series.color};padding:0">Total Imformes: {point.y:.f}</td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        
	    series: [{
	    	name: valores.name,
		    data: valores.data
	       }]
	  });
	}
	
	$(document).ready(function() {

		function ExecuteReport2(){
			fec_incio = $('#txtBuscarFecIncioRep2').val();
			fec_fin = $('#txtBuscarFecFinRep2').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_cant_info_uunn/'+fec_incio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte2 #list-data-cant-info-uunn').unbind();
					$('div#reporte2 #list-data-cant-info-uunn').load(env_webroot_script + 'reportes/load_list_cant_info_uunn/'+fec_incio+'/'+fec_fin,function(){
						
					});
			});
		}

		ExecuteReport2();

		$( ".btn-consultar-report2" ).click(function() {
				ExecuteReport2();
		});

		/* Date Picker */
		$('#txtBuscarFecIncioRep2').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinRep2').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});
	});


</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Número de Informes por Unidad de Negocio')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte2">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncioRep2" id="txtBuscarFecIncioRep2"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinRep2" id="txtBuscarFecFinRep2"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
			<button type="button" class="btn btn-large btn-consultar-report2"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-info-uunn">
		</div>
	</center>
</div>
