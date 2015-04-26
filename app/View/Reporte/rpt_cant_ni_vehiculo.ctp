<script>
function visitorData (valores) {
	   $('#container-graf4').highcharts({
	    chart: {
	        type: 'column'
	    },
	    lang: {
	        drillUpText: '< Regresar a {series.name}'
	    },
	    title: {
	        text: 'N\u00FAmero de Normas Incumplidas por empresa'
	    },
	    xAxis: {
	        categories: true//valores.categoria
	    },
	    yAxis: {
	        title: {
	            text: 'Cantidad de Normas Incumplidas'
	        }
	    },
	    drilldown: {
	        series: valores.data_drilldown
		           
	    },
	    
	    legend: {
	        enabled: false
	    },
	    
	    plotOptions: {
	        series: {
	            dataLabels: {
	                enabled: true
	            },
	            shadow: false
	        },
	        pie: {
	            size: '80%'
	        }
	    },

	    tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> Normas Incumplidas<br/>'
        }, 

        credits: {
            enabled: false
        },
        series: [{
	    	name: valores.name,
		    data: valores.data
	       }]
	  });
	}
	
	$(document).ready(function() {

		function ExecuteReport4(){
			fec_inicio = $('#txtBuscarFecIncioRep4').val();
			fec_fin = $('#txtBuscarFecFinRep4').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_cant_ni_ve/'+fec_inicio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte4 #list-data-cant-ni-emp').unbind();
					$('div#reporte4 #list-data-cant-ni-emp').load(env_webroot_script + 'reportes/load_list_cant_ni_emp_veh/'+fec_inicio+'/'+fec_fin,function(){
						
					});
			});
		}

		ExecuteReport4();

		$( ".btn-consultar-report4" ).click(function() {
				ExecuteReport4();
		});

		/* Date Picker */
		$('#txtBuscarFecIncioRep4').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinRep4').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#table-report1').DataTable();
	});


</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Normas Incumplidas de Vehiculos por Empresa')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte4">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncioRep4" id="txtBuscarFecIncioRep4"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinRep4" id="txtBuscarFecFinRep4"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-report4"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-ni-emp">
		</div>
	</center>
</div>