<script>
	function showHighchart (porc_in_categorias, porc_cu_categorias, porc_cu){
		console.log(porc_cu_categorias);
		//$(function () {
				//alert(categorias);
			    var colors = Highcharts.getOptions().colors,
			        categories = ['NI', 'NC'],
			        data = [{
			            y: porc_ni,
			            color: '#E03737',
			            drilldown: {
			                name: 'NI Items',
			                categories: ['EPP', 'SE', 'UM', 'DOC', 'CP', 'AC'],
			                data: [porc_ni, 0, 0, 0, 0, 0],
			                color: '#E03737'
			            }
			        }, {
			            y: porc_nc,
			            color: colors[0],
			            drilldown: {
			                name: 'NC Items',
			                categories: ['EPP', 'SE', 'UM', 'DOC', 'CP', 'AC'],
			                data: porc_cu_categorias,
			                color: colors[0]
			            }
			        }],
			        browserData = [],
			        versionsData = [],
			        i,
			        j,
			        dataLen = data.length,
			        drillDataLen,
			        brightness;


				var leyendtitle = ["EQUIPOS DE PROTECCIÓN (PERSONAL Y/O COLECTIVO)", "SEÑALIZACIÓN Y DELIMITACIÓN", "UNIDADES MÓVILES", "DOCUMENTACIÓN DE SEGURIDAD", "CUMPLIMIENTO DEL PROCEDIMIENTO DE TRABAJO SEGURO", "ACTOS Y CONDICIONES ESTANDARES Y/O SUB-ESTANDARES"];
			    // Build the data arrays
			    for (i = 0; i < dataLen; i += 1) {

			        // add browser data
			        browserData.push({
			            name: categories[i],
						category_porc: categories[i]+': '+data[i].y +'%',
			            y: data[i].y,
			            color: data[i].color
			        });

			        // add version data
			        drillDataLen = data[i].drilldown.data.length;
			        for (j = 0; j < drillDataLen; j += 1) {
			            brightness = 0.2 - (j / drillDataLen) / 5;
			            versionsData.push({
			                name: data[i].drilldown.categories[j],
			                y: data[i].drilldown.data[j],
							leyendtitle: leyendtitle[j],
							category: categories[i],
							indice: j,
							valor: porc_cu[j],
			                color: Highcharts.Color(data[i].color).brighten(brightness).get()
			            });
			        }
			    }


			    // Create the chart
			    $('#container-grafico').highcharts({
			        chart: {
			            type: 'pie'
			        },
			        title: {
			            text: ''
			        },
			        credits: {
						enabled: false
					},
			        yAxis: {
			            title: {
			                text: 'Total percent market share'
			            }
			        },
			        plotOptions: {
			            pie: {
			                shadow: false,
			                center: ['50%', '50%'],
			                showInLegend: true
			            }
			        },
			        tooltip: {
			            valueSuffix: '%'
			        },
			        legend: {
						layout: 'vertical',
						backgroundColor: '#FFFFFF',
						floating: false,
						align: 'center',
						verticalAlign: 'bottom',
						labelFormatter: function () {
							if(this.category == 'NC'){
								if(this.indice == 5){
									return '<span style="font-size:5px"><strong>'+this.name + '</strong>: <span style="font-weight:100">'+this.leyendtitle+'</span></span><br><br><span style="font-size:5px"><strong>NI</strong>: <span style="font-weight:100">NIVEL INCUMPLIMIENTO</span></span><br><span style="font-size:5px"><strong>NC</strong>: <span style="font-weight:100">NIVEL CUMPLIMIENTO</span></span>';
								}else{
									return '<span style="font-size:5px"><strong>'+this.name + '</strong>: <span style="font-weight:100">'+this.leyendtitle+'</span></span>';
								}
							}
						}
					},
			        series: [{
			            name: 'Browsers',
			            data: browserData,
			            size: '60%',
			            dataLabels: {
			                formatter: function () {
			                    return this.y > 5 ? this.point.category_porc : null;
			                },
			                color: '#000000',
			                distance: -30
			            }
			        }, {
			            name: 'Versions',
			            data: versionsData,
			            size: '80%',
			            innerSize: '60%',
			            dataLabels: {
			                formatter: function () {
			                    // display only if larger than 1
								if(this.point.category=='NC'){
									return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.point.valor + '%' : null;
								}
			                }
			            }
			        }]
			    });
			//});

	}

	$(document).ready(function() {

		function ExecuteReport(){
			fec_incio = $('#txtBuscarFecIncioRep2').val();
			fec_fin = $('#txtBuscarFecFinRep2').val();
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_total_ni_nc/'+fec_incio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						console.log(data.nc); //VALORES DE LA SUMA RESPECTIVA DE LA "N.CUMPLI" DE: epp, sd, um, doc, cp, ac 
						console.log(data.ni); //VALORES DE LA SUMA RESPECTIVA DE LA "N.INCUMPLI" DE: epp, sd, um, doc, cp, ac

						n_cu_epp = data.nc[0];
						n_cu_sd = data.nc[1];
						n_cu_um = data.nc[2];
						n_cu_ds = data.nc[3];
						n_cu_cp = data.nc[4];
						n_cu_as = data.nc[5];

						n_in_epp = data.ni[0];
						n_in_sd = data.ni[1];
						n_in_um = data.ni[2];
						n_in_ds = data.ni[3];
						n_in_cp = data.ni[4];
						n_in_as = data.ni[5];
						
						normas_cumplidas = Math.round(n_cu_epp + n_cu_sd + n_cu_um + n_cu_ds + n_cu_cp + n_cu_as);
						normas_incumplidas = Math.round(n_in_epp + n_in_sd + n_in_um + n_in_ds + n_in_cp + n_in_as);
						suma_normas = normas_cumplidas + normas_incumplidas;

						porc_nc = Math.round((normas_cumplidas * 100) / suma_normas);
						porc_ni = Math.round((normas_incumplidas * 100) / suma_normas);

						porc_cu_epp = Math.round((n_cu_epp*100)/suma_normas);
						porc_in_epp = Math.round((n_in_epp*100)/suma_normas);
						porc_epp = Math.round((n_cu_epp*100)/(n_cu_epp + n_in_epp));
						porc_epp_vivo = porc_cu_epp > 0 ? 1 : 0;

						porc_cu_sd = Math.round((n_cu_sd*100)/suma_normas);
						porc_in_sd = Math.round((n_in_sd*100)/suma_normas);
						porc_sd = Math.round((n_cu_sd*100)/(n_cu_sd + n_in_sd));
						porc_sd_vivo = porc_cu_sd > 0 ? 1 : 0;

						porc_cu_um = Math.round((n_cu_um*100)/suma_normas);
						porc_in_um = Math.round((n_in_um*100)/suma_normas);
						porc_um = Math.round((n_cu_um*100)/(n_cu_um + n_in_um));
						porc_um_vivo = porc_cu_um > 0 ? 1 : 0;

						porc_cu_ds = Math.round((n_cu_ds*100)/suma_normas);
						porc_in_ds = Math.round((n_in_ds*100)/suma_normas);
						porc_ds = Math.round((n_cu_ds*100)/(n_cu_ds + n_in_ds));
						porc_ds_vivo = porc_cu_ds > 0 ? 1 : 0;

						porc_cu_cp = Math.round((n_cu_cp*100)/suma_normas);
						porc_in_cp = Math.round((n_in_cp*100)/suma_normas);
						porc_cp = Math.round((n_cu_cp*100)/(n_cu_cp + n_in_cp));
						porc_cp_vivo = porc_cu_cp > 0 ? 1 : 0;

						porc_cu_as = Math.round((n_cu_as*100)/suma_normas);
						porc_in_as = Math.round((n_in_as*100)/suma_normas);
						porc_as = Math.round((n_cu_as*100)/(n_cu_as + n_in_as));
						porc_as_vivo = porc_cu_as > 0 ? 1 : 0;

						suma_porc = porc_cu_epp + porc_cu_sd + porc_cu_um + porc_cu_ds + porc_cu_cp + porc_cu_as;
						suma_vivo = porc_epp_vivo + porc_sd_vivo + porc_um_vivo + porc_ds_vivo + porc_cp_vivo + porc_as_vivo;
						
						porc_epp_vivo_test = porc_cu_epp > 0 ? (suma_porc/suma_vivo) : 0;
						porc_sd_vivo_test = porc_cu_sd > 0 ? (suma_porc/suma_vivo) : 0;
						porc_um_vivo_test = porc_cu_um > 0 ? (suma_porc/suma_vivo) : 0;
						porc_ds_vivo_test = porc_cu_ds > 0 ? (suma_porc/suma_vivo) : 0;
						porc_cp_vivo_test = porc_cu_cp > 0 ? (suma_porc/suma_vivo) : 0;
						porc_as_vivo_test = porc_cu_as > 0 ?(suma_porc/suma_vivo) : 0;
						
						var porc_cu_categorias = [porc_cu_epp, porc_cu_sd, porc_cu_um, porc_cu_ds, porc_cu_cp, porc_cu_as];
						var porc_cu_categoriastest = [porc_epp_vivo_test, porc_sd_vivo_test, porc_um_vivo_test, porc_ds_vivo_test, porc_cp_vivo_test, porc_as_vivo_test];
						var porc_in_categorias = [porc_in_epp, porc_in_sd, porc_in_um, porc_in_ds, porc_in_cp, porc_in_as];
						var porc_cu = [porc_epp, porc_sd, porc_um, porc_ds, porc_cp, porc_as];

						showHighchart(porc_in_categorias, porc_cu_categoriastest, porc_cu);
						
					}

			});
		}

		//ExecuteReport();

		$( ".btn-consultar-report" ).click(function() {
				ExecuteReport();
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
		<h2><?php echo utf8_encode(__('Total de normas Cumplidas e incumplidas por fecha')); ?></h2>
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
		<div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-report"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	
	<div id="container-grafico" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
	<center>
		<div id="list-data-cant-info-uunn">
		</div>
	</center>
</div>
