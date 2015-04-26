<script>
function visitorData (valores) {
	   $('#container-graf3').highcharts({
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
	   /* series: [{
	        name: 'Ordenes Pendientes',
	        colorByPoint: true,
	        data: [{
	            name: 'Asignado',
	            y: 10,
	            drilldown: 'estado-0'
	        },{
	            name: 'Descargado',
	            y: 124,
	            drilldown: 'estado-1'
	        },{
	            name: 'Exportado',
	            y: 8,
	            drilldown: 'estado-2'
	        }]
	    }]*/
	  });
	}
	
	$(document).ready(function() {

		function ExecuteReport3(){
			fec_inicio = $('#txtBuscarFecIncioRep3').val();
			fec_fin = $('#txtBuscarFecFinRep3').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_cant_ni_trab/'+fec_inicio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte3 #list-data-cant-ni-emp-trab').unbind();
					$('div#reporte3 #list-data-cant-ni-emp-trab').load(env_webroot_script + 'reportes/load_list_cant_ni_emp_trab/'+fec_inicio+'/'+fec_fin,function(){
						
					});
			});
		}

		ExecuteReport3();

		$( ".btn-consultar-report3" ).click(function() {
				ExecuteReport3();
		});

		/* Date Picker */
		$('#txtBuscarFecIncioRep3').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinRep3').datepicker(
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
		<h2><?php echo utf8_encode(__('Normas Incumplidas de Trabajadores por Empresa')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte3">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncioRep3" id="txtBuscarFecIncioRep3"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinRep3" id="txtBuscarFecFinRep3"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
			<button type="button" class="btn btn-large btn-consultar-report3"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-ni-emp-trab">
		</div>
	</center>
</div>