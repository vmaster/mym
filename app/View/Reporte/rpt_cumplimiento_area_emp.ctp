<script>
function visitorData (valores) {
	   $('#container-graf001').highcharts({
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'N\u00FAmero de informes por empresa'
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
	    	colorByPoint: true,
		    data: valores.data
	       }]
	  });
}
	
	$(document).ready(function() {

		function ExecuteReport001(){
			fec_incio = $('#txtFecIni').val();
			fec_fin = $('#txtFecFin').val();
			area_id = $('#txtTipoLugar').val();
			empresa_id = $('#txtEmpresa').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_cant_info_emp/'+fec_incio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData (data);
					}
	
					$('div#reporte_001 #list-data-cant-info-emp').unbind();
					$('div#reporte_001 #list-data-cant-info-emp').load(env_webroot_script + 'reportes/load_list_cump_area_emp/'+fec_incio+'/'+fec_fin+'/'+area_id+'/'+empresa_id,function(){
						
					});
			});
		}

		ExecuteReport001();

		$( ".btn-consultar-report001" ).click(function() {
				ExecuteReport001();
		});

		/* Date Picker */
		$('#txtFecIni').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#txtFecFin').datepicker(
				{
					changeYear: true, 
					dateFormat: 'dd-mm-yy',
					minDate: new Date(1924, 1 - 1, 1),
					maxDate: new Date()
		});

		$('#table-report001').DataTable();
	});


</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Número de Informes por Empresas')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte_001">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio');?></label> <input type="text"
				name="txtFecIni" id="txtFecIni"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin');?></label> <input type="text"
				name="txtFecFin" id="txtFecFin"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
	</div>
	<p>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label>&Aacute;rea:</label>
				<select class="cbo-tipo-lugares-select2 form-control" id ="txtTipoLugar">
										<?php 
										if (isset($list_all_tipo_lugares)){
										echo "<option></option>";
										foreach ($list_all_tipo_lugares as $id => $des):
										echo "<option value = ".$id.">".$des."</option>";
										endforeach;
										}
										?>
				</select>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-6">
				<label>Empresa:</label>
				<select class="cbo-empresas-select2 form-control" id ="txtEmpresa">
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
			<button type="button" class="btn btn-large btn-consultar-report001"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-graf1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-info-emp">
		</div>
	</center>
</div>
