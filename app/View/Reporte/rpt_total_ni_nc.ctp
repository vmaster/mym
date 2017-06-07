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
			            enabled: false
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

			$form = $('#frm-rpt-ni-nc').eq(0);
			/*fec_inicio = $('#txtBuscarFecIncioRep2').val();
			fec_fin = $('#txtBuscarFecFinRep2').val();
			empresa = $('#cbo-empresa-search').val();
			uunn = $('#cbo-uunn-search').val();*/
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_total_ni_nc',
			    type: 'post',
			    async: true,
			    data: $form.serialize(),
			    dataType: "json"
			 }).done(function(data){
					if(data.success == true){
						console.log(data.nc); //VALORES DE LA SUMA RESPECTIVA DE LA "N.CUMPLI" DE: epp, sd, um, doc, cp, ac 
						console.log(data.ni); //VALORES DE LA SUMA RESPECTIVA DE LA "N.INCUMPLI" DE: epp, sd, um, doc, cp, ac

						if(data.nc[0] == 0){
							$('#container-grafico').html("No hay resultados");
							return false;
						}

						$array_serialize =  $form.serialize();

						$('#list-data-total-ni-nc').unbind();
												
						/*$('#list-data-total-ni-nc').load(env_webroot_script + 'reportes/load_list_total_ni_nc/'+fec_inicio+'/'+fec_fin+'/'+empresa+'/'+uunn,function(){

							
						});*/

						$.ajax({
							url:env_webroot_script + 'reportes/load_list_total_ni_nc',
							type:'post',
							async:true,
							data: $form.serialize(),
							dataType: 'html'
						}).done(function(dato){
								$('#list-data-total-ni-nc').html(dato);
							//}
						})



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

						porc_cu_epp = n_cu_epp > 0 ? Math.round((n_cu_epp*100)/suma_normas) : 0;
						porc_in_epp = n_in_epp > 0 ? Math.round((n_in_epp*100)/suma_normas) : 0;
						porc_epp = Math.round((n_cu_epp*100)/(n_cu_epp + n_in_epp));
						porc_epp_vivo = porc_cu_epp > 0 ? 1 : 0;

						porc_cu_sd = n_cu_sd > 0 ? Math.round((n_cu_sd*100)/suma_normas) : 0;
						porc_in_sd = n_in_sd > 0 ? Math.round((n_in_sd*100)/suma_normas) : 0;
						porc_sd = Math.round((n_cu_sd*100)/(n_cu_sd + n_in_sd));
						porc_sd_vivo = porc_cu_sd > 0 ? 1 : 0;

						porc_cu_um = n_cu_um > 0 ? Math.round((n_cu_um*100)/suma_normas) : 0;
						porc_in_um = n_in_um > 0 ? Math.round((n_in_um*100)/suma_normas) : 0;
						porc_um = Math.round((n_cu_um*100)/(n_cu_um + n_in_um));
						porc_um_vivo = porc_cu_um > 0 ? 1 : 0;

						porc_cu_ds = n_cu_ds > 0 ? Math.round((n_cu_ds*100)/suma_normas) : 0;
						porc_in_ds = n_in_ds > 0 ? Math.round((n_in_ds*100)/suma_normas) : 0;
						porc_ds = Math.round((n_cu_ds*100)/(n_cu_ds + n_in_ds));
						porc_ds_vivo = porc_cu_ds > 0 ? 1 : 0;

						porc_cu_cp = n_cu_cp > 0 ? Math.round((n_cu_cp*100)/suma_normas) : 0;
						porc_in_cp = n_in_cp > 0 ? Math.round((n_in_cp*100)/suma_normas) : 0;
						porc_cp = Math.round((n_cu_cp*100)/(n_cu_cp + n_in_cp));
						porc_cp_vivo = porc_cu_cp > 0 ? 1 : 0;

						porc_cu_as = n_cu_as > 0 ? Math.round((n_cu_as*100)/suma_normas) : 0;
						porc_in_as = n_in_as > 0 ? Math.round((n_in_as*100)/suma_normas) : 0;
						porc_as = Math.round((n_cu_as*100)/(n_cu_as + n_in_as));
						porc_as_vivo = porc_cu_as > 0 ? 1 : 0;

						suma_porc = porc_cu_epp + porc_cu_sd + porc_cu_um + porc_cu_ds + porc_cu_cp + porc_cu_as;
						suma_vivo = porc_epp_vivo + porc_sd_vivo + porc_um_vivo + porc_ds_vivo + porc_cp_vivo + porc_as_vivo;
						
						count=0;
						divisor=0;
						if(porc_cu_epp == 0){
							count = count + 2;
							divisor++;
						}
						if(porc_cu_sd == 0){
							count = count + 2;
							divisor++;
						}
						if(porc_cu_um == 0){
							count = count + 2;
							divisor++;
						}
						if(porc_cu_ds == 0){
							count = count + 2;
							divisor++;
						}
						if(porc_cu_cp == 0){
							count = count + 2;
							divisor++;
						}
						if(porc_cu_as == 0){
							count = count + 2;
							divisor++;
						}

						porc_nc2 = porc_nc - count;
						divisor = 6 - divisor;

						porc_epp_vivo_test = porc_cu_epp > 0 ? (porc_nc2/divisor) : 2;
						porc_sd_vivo_test = porc_cu_sd > 0 ? (porc_nc2/divisor) : 2;
						porc_um_vivo_test = porc_cu_um > 0 ? (porc_nc2/divisor) : 2;
						porc_ds_vivo_test = porc_cu_ds > 0 ? (porc_nc2/divisor) : 2;
						porc_cp_vivo_test = porc_cu_cp > 0 ? (porc_nc2/divisor) : 2;
						porc_as_vivo_test = porc_cu_as > 0 ?(porc_nc2/divisor) : 2;
						
						var porc_cu_categorias = [porc_cu_epp, porc_cu_sd, porc_cu_um, porc_cu_ds, porc_cu_cp, porc_cu_as];
						var porc_cu_categoriastest = [porc_epp_vivo_test, porc_sd_vivo_test, porc_um_vivo_test, porc_ds_vivo_test, porc_cp_vivo_test, porc_as_vivo_test];
						var porc_in_categorias = [porc_in_epp, porc_in_sd, porc_in_um, porc_in_ds, porc_in_cp, porc_in_as];
						var porc_cu = [porc_epp, porc_sd, porc_um, porc_ds, porc_cp, porc_as];

						showHighchart(porc_in_categorias, porc_cu_categoriastest, porc_cu);
						
						var content = ""
						content += '<table width="100%" border=1 ><tbody><tr><th colspan="8" style="    background-color: #D6E3BC;text-align: center;"><strong>CUADRO RESUMEN DE NIVEL DE CUMPLIMIENTO A NORMAS DE SEGURIDAD</strong></th></tr><tr><td></td>';
						content += '<td>EPP</td><td>SE</td><td>UM</td><td>DOC</td><td>CP</td><td>AC</td><td>TOTAL</td></tr><tr><td><strong>TOTAL CUMPLIMIENTO (NC):</strong> </td><td>'+n_cu_epp+'</td><td>'+n_cu_sd+'</td><td>'+n_cu_um+'</td><td>'+n_cu_ds+'</td><td>'+n_cu_cp+'</td><td>'+n_cu_as+'</td><td>'+normas_cumplidas+'</td></tr><tr><td><strong>TOTAL INCUMPLIMIENTO (NI):</strong> </td><td>'+n_in_epp+'</td><td>'+n_in_sd+'</td><td>'+n_in_um+'</td><td>'+n_in_ds+'</td><td>'+n_in_cp+'</td><td>'+n_in_as+'</td><td>'+normas_incumplidas+'</td></tr><tr><td><strong>NIVEL DE CUMPLIMIENTO:</strong> </td><td>'+porc_epp+'%</td><td>'+porc_sd+'%</td><td>'+porc_um+'%</td><td>'+porc_ds+'%</td><td>'+porc_cp+'%</td><td>'+porc_as+'%</td><td>'+Math.round((normas_cumplidas * 100)/suma_normas)+'%</td></tr></tbody></table>';
						$('#container-table').empty();
						$('#container-table').append(content);
					}

			});
			
			$(".cbo-rpte-empresas-select2").select2({
			  placeholder: "Seleccione una empresa",
			  allowClear: true
			});
			
			$(".cbo-rpte-uunn-select2").select2({
			  placeholder: "Seleccione una UUNN",
			  allowClear: true
			});
		}

		//ExecuteReport();

		$( ".btn-consultar-report" ).click(function() {
				ExecuteReport();
				setTimeout(function(){
  					var svg = document.getElementById('container-grafico').children[0].innerHTML;
					canvg(document.getElementById('canvas'),svg);

					//var canvas = new Canvas();
					var img = canvas.toDataURL("image/png"); //img is data:image/png;base64
					img = img.replace('data:image/png;base64,', '');

					$('#id-name-graf').attr("value",img); //Agregamos la imagen base64 en un input oculto para luego enviarlo por Submit

					$("#btn-generar-pdf").css("display", "block");
				}, 2000);	
				
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
		<h2><?php echo utf8_encode(__('Total de Normas Cumplidas e Incumplidas')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte2">
	<?php 
	$fin= date('t');
	$mes= date('m')."-".date('Y');
	?>
	<form method="post" action="<?= ENV_WEBROOT_FULL_URL; ?>actas/ajax_export_report_pdf" id="frm-rpt-ni-nc">
	<div class="row">
		<div class="col-md-2 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Inicio:');?></label> <input name="data[RptTotalNiNc][fec_inicio]" type="text"
				name="fec_inicio" id="txtBuscarFecIncioRep2"
				class="form-control" value="<?php echo '01-'.$mes; ?>" placeholder="dd-mm-aaaa">
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6">
				<label><?php echo __('Fecha Fin:');?></label> <input name="data[RptTotalNiNc][fec_fin]" type="text"
				name="fec_fin" id="txtBuscarFecFinRep2"
				class="form-control" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-aaaa">
		</div>
	</div>
	<p>
	<div class="row">
		
		<div class="col-md-4 col-sm-6 col-xs-6">
			<label><?php echo __('Empresa:');?></label>
			<select name="data[RptTotalNiNc][empresa][]" class="cbo-rpte-empresas-select2 form-control" id="cbo-empresa-search" name="empresa" multiple="multiple">
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
		<div class="col-md-4 col-sm-6 col-xs-6">
			<label><?php echo __('UUNN:');?></label>
			<select name="data[RptTotalNiNc][uunn][]" class="cbo-rpte-uunn-select2 form-control" id="cbo-uunn-search" name="uunn" multiple ="multiple">
				<?php 
				if (isset($list_all_uunn)){
					echo "<option></option>";
					foreach ($list_all_uunn as $id => $des):
					echo "<option value = ".$id.">".$des."</option>";
					endforeach;
					}
				?>						
			</select>
		</div>
	</div>
	<div class="row">
		<input type="hidden" name="graf" id="id-name-graf" value=""/>
		<div class="col-md-4 col-sm-6 col-xs-6" style="margin-top: 26px;">
			<button type="button" class="btn btn-large btn-consultar-report"><?php echo __('Consultar');?></button>
		</div>
	</div>
	<p>
	
	<div id="container-table"></div>
	<div id="container-grafico" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
	<canvas id="canvas" style="display:none;"></canvas>
	<p>
	<center>
		<button type="submit" class="btn btn-large btn-generar-pdf" id="btn-generar-pdf" style="display: none;"><?php echo __('Generar PDF');?></button>
	</center>
	</p>
	<div id="list-data-cant-info-uunn">
	</div>
	<center>
		<div id="list-data-total-ni-nc">
		</div>
	</center>
	</form>
</div>
