<script>
function visitorData (valores) {
	   $('#container-graf5').highcharts({
		   chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Grafico: Reincidencias de Normas Incumplidas'
		    },
		    xAxis: {
		        categories: valores.categoria
		    },
		    yAxis: {
		        title: {
		            text: 'Cantidad de Reincidencias'
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
	            pointFormat: '<tr><td style="color:{series.color};padding:0">Cantidad de Reincidencias: {point.y:.f}</td></tr>',
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

		function ExecuteReport5(){
			fec_inicio = $('#txtBuscarFecIncioRep5').val();
			fec_fin = $('#txtBuscarFecFinRep5').val();
			empresa_id = $('#cbo-empresa-search').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_reincidencia_ni_empresa/'+fec_inicio+'/'+fec_fin+'/'+empresa_id,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte5 #list-data-cant-ni-emp').unbind();
					$('div#reporte5 #list-data-cant-ni-emp').load(env_webroot_script + 'reportes/load_list_reincidencia_ni_empresa/'+fec_inicio+'/'+fec_fin+'/'+empresa_id,function(){
						
					});
			});
		}

		ExecuteReport5();

		$( ".btn-consultar-report5" ).click(function() {
				ExecuteReport5();
		});

		/* Date Picker */
		$('#txtBuscarFecIncioRep5').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinRep5').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$(".cbo-rpte-empresas-select2").select2({
			  placeholder: "Seleccione una empresa",
			  allowClear: true
			});
	});


</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Reincidencia de Normas Incumplidas por Empresa')); ?></h2>
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
				name="txtBuscarFecIncioRep5" id="txtBuscarFecIncioRep5"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinRep5" id="txtBuscarFecFinRep5"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
			<label><?php echo __('Empresa:');?></label>
			<select class="cbo-rpte-empresas-select2 form-control" id="cbo-empresa-search">
				<?php 
				if (isset($list_all_empresas)){
					echo "<option></option>";
					foreach ($list_all_empresas as $id => $des):
					echo "<option value = ".$id.">".$des."</option>";
					endforeach;
					}
				?>						
			</select>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-report5"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf5" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-ni-emp">
		</div>
	</center>
</div>