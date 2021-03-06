<script>
function visitorData (valores) {
	   $('#container-graf1').highcharts({
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Cantidad de uso de viatico'
	    },
	    xAxis: {
	        categories: valores.categoria
	    },
	    yAxis: {
	        title: {
	            text: 'Cantidad de uso de viatico'
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
            pointFormat: '<tr><td style="color:{series.color};padding:0">Total uso de viatico: {point.y:.f}</td></tr>',
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

		function ExecuteReport1(){
			fec_incio = $('#txtBuscarFecIncioRep1').val();
			fec_fin = $('#txtBuscarFecFinRep1').val();
			asesor = $('#txtAsesor').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_uso_viatico_asesor/'+fec_incio+'/'+fec_fin+'/'+asesor,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte1 #list-data-cant-info-emp').unbind();
					$('div#reporte1 #list-data-cant-info-emp').load(env_webroot_script + 'reportes/load_list_uso_viatico_asesor/'+fec_incio+'/'+fec_fin+'/'+asesor,function(){
						
					});
			});
		}

		ExecuteReport1();

		$( ".btn-consultar-report1" ).click(function() {
				ExecuteReport1();
		});

		/* Date Picker */
		$('#txtBuscarFecIncioRep1').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtBuscarFecFinRep1').datepicker(
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
		<h2><?php echo utf8_encode(__('N�mero de uso de viatico')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte1">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtBuscarFecIncioRep1" id="txtBuscarFecIncioRep1"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtBuscarFecFinRep1" id="txtBuscarFecFinRep1"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Asesor');?></label> 
				<select class="cbo-empresas-select2 form-control" id ="txtAsesor">
										<?php 
										if (isset($list_all_asesores)){
										echo "<option>---</option>";
										foreach ($list_all_asesores as $id => $des):
										echo "<option value = ".$des->getAttr('user_id').">".$des->User->Trabajadore->getAttr('apellido_nombre')."</option>";
										endforeach;
										}
										?>
				</select>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-report1"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-info-emp">
		</div>
	</center>
</div>
