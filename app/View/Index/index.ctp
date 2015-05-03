<script>
 $(function () {
	 var d = new Date(); 
	 var month = d.getMonth()+1; 
	 var day = d.getDate();
	 var fec_fin = (day<10 ? '0' : '') + day + '-' + (month<10 ? '0' : '') + month + '-' + d.getFullYear();
	 var fec_inicio = '01' + '-' + (month<10 ? '0' : '') + month + '-' + d.getFullYear();
	 
	 
	 function visitorData1 (valores) {
		   $('#container-graf1').highcharts({
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
    
	function ExecuteReport1(){
			 $.ajax({
			    url: env_webroot_script + 'reportes/load_graf_cant_info_emp/'+fec_inicio+'/'+fec_fin,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData1 (data);
					}
			});
		}

	ExecuteReport1();


	function visitorData2 (valores) {
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
		    	colorByPoint: true,
			    data: valores.data
		       }]
		  });
	}

	function ExecuteReport2(){
		 $.ajax({
		    url: env_webroot_script + 'reportes/load_graf_cant_info_uunn/'+fec_inicio+'/'+fec_fin,
		    type: 'GET',
		    async: true,
		    dataType: "json",
		 }).done(function(data){
				if(data.success == true){
					visitorData2 (data);
				}
		});
	}

	ExecuteReport2();

	
	function visitorData3 (valores) {
		   $('#container-graf3').highcharts({
		    chart: {
		        type: 'column',
		        marginTop: 80
		    },
		    lang: {
		        drillUpText: '< Regresar a {series.name}'
		    },
		    title: {
		        text: 'N\u00FAmero de Normas Incumplidas Empresa - Trabajador'
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
		    	colorByPoint: true,
			    data: valores.data
		       }]
		  });
		}

	function ExecuteReport3(){
		 $.ajax({
		    url: env_webroot_script + 'reportes/load_graf_cant_ni_trab/'+fec_inicio+'/'+fec_fin,
		    type: 'GET',
		    async: true,
		    dataType: "json",
		 }).done(function(data){
				if(data.success == true){
					visitorData3 (data);
				}
		});
	}

	ExecuteReport3();

	function visitorData4 (valores) {
		   $('#container-graf4').highcharts({
		    chart: {
		        type: 'column'
		    },
		    lang: {
		        drillUpText: '< Regresar a {series.name}'
		    },
		    title: {
		        text: 'N\u00FAmero de Normas Incumplidas Empresa - Unidad Movil'
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
		    	colorByPoint: true,
			    data: valores.data
		       }]
		  });
		}

	function ExecuteReport4(){
		 $.ajax({
		    url: env_webroot_script + 'reportes/load_graf_cant_ni_ve/'+fec_inicio+'/'+fec_fin,
		    type: 'GET',
		    async: true,
		    dataType: "json",
		 }).done(function(data){
				if(data.success == true){
					visitorData4 (data);
				}
		});
	}

	ExecuteReport4();
 });

</script>
<div class="row">
	<div class="col-md-12">
		<h2>Admin Dashboard</h2>
	</div>
</div>
<hr />
<!-- <img src="<?= ENV_WEBROOT_FULL_URL; ?>/img/iceperu.jpg"/> -->
<!-- /. NAV SIDE  -->
        
                 <!-- /. ROW  -->
<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-red set-icon"> <i
				class="fa fa-file-text-o"></i>
			</span>
			<div class="text-box">
				<p class="main-text" style="font-size:22px !important"><?php echo (isset($count_informe_enviados))? $count_informe_enviados :''; ?> Informes</p>
				<p class="text-muted" style="padding-top:10px !important">Enviados</p>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-blue set-icon"> <i
				class="fa fa-building-o"></i>
			</span>
			<div class="text-box">
				<p class="main-text" style="font-size:22px !important"><?php echo (isset($count_empresas))? $count_empresas :''; ?> Empresas</p>
				<p class="text-muted" style="padding-top:10px !important">Registradas</p>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-green set-icon"> <i
				class="fa fa-users"></i>
			</span>
			<div class="text-box">
				<p class="main-text" style="font-size:22px !important"><?php echo (isset($count_trabajadores))? $count_trabajadores :''; ?> Trabajadores</p>
				<p class="text-muted" style="padding-top:10px !important">Registrados</p>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-6">           
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-brown set-icon">
            	<i class="fa fa-rocket"></i>
			</span>
			<div class="text-box" >
				<p class="main-text" style="font-size:20px !important"><?php echo (isset($count_unidades_moviles))? $count_unidades_moviles :''; ?> Unidades M&oacute;viles</p>
				<p class="text-muted" style="padding-top:10px !important">Registradas</p>
        	</div>
    	</div>
	</div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
	<div class="col-md-5 col-sm-12 col-xs-12">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-blue"> <i class="fa fa-warning"></i>
			</span>
			<div class="text-box">
				<p class="main-text">
					<?php echo (isset($count_informe_pendientes))? $count_informe_pendientes :''; ?>
					Informes pendientes
				</p>
				<!-- <p class="text-muted">Please fix these issues to work smooth</p>
                    <p class="text-muted">Time Left: 30 mins</p> -->
				<hr />
				<p class="text-muted">
					<span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
						Aquellos informes que aun faltan registrar sus Conclusiones y
						Recomendaciones. </span>
				</p>
			</div>
		</div>
	</div>


	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="panel back-dash">
			<i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; 5 &Uacute;LTIMOS INFORMES</strong>
				<?php if(isset($list_ultimos_informes)) {?>
				<table class="table" style="font-size: 13px; text-align:center;">
				<thead>
			        <tr>
			          <th style="text-align:center;"><?php echo utf8_encode(__('N°')); ?></th>
			          <th style="text-align:center;"><?php echo utf8_encode(__('Nro Informe')); ?></th>
			          <th style="text-align:center;"><?php echo utf8_encode(__('Enlace')); ?></th>
			        </tr>
			    </thead>
				<?php 
				$n = 0;
				?>
					<tbody>
						<?php foreach ($list_ultimos_informes as $array_info):
						$n = $n + 1;
						?>
							<tr class="acta_rows">
								<td><?php echo $n; ?></td>
								<td><?php echo $array_info->getAttr('num_informe'); ?></td>
								<td><a href="<?= ENV_WEBROOT_FULL_URL; ?>actas/view_informe/<?php echo $array_info->getAttr('id')?>" target="_blank"><i class="fa fa-file-text fa-lg"></i> </a></td>
							</tr>
						<?php 
							endforeach;
						?>
					</tbody>	
				</table>
				<?php } ?>
		</div>

	</div>
	<div class="col-md-3 col-sm-12 col-xs-12 ">
		<div class="panel ">
			<div class="main-temp-back">
				<div class="panel-body">
					<div class="row">
						<span class="icon-box bg-color-white set-icon"> <i
							class="fa fa-user fa-3x"></i>
						</span>
						<div class="main-text"><?php echo (isset($trabajador_mayor_numero_normas))? $trabajador_mayor_numero_normas: ""; ?></div>
					</div>
					<div class="row">Trabajador con mayor normas incumplidas</div>
				</div>
			</div>

		</div>
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-green set-icon"> <i
				class="fa fa-building-o"></i>
			</span>
			<div class="text-box">
				<p class="main-text"><?php echo (isset($empresa_mayor_numero_normas))? $empresa_mayor_numero_normas: ""; ?></p>
				<p class="text-muted">Empresa con mayor normas incumplidas</p>
			</div>
		</div>

	</div>

</div>
<!-- /. ROW  -->
<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo utf8_encode("Gráfica: Número de informes por Empresa"); ?>
			</div>
			<div id="container-graf1"
				style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo utf8_encode("Gráfica: Número de informes por Unidad de Negocio"); ?>
			</div>
			<div id="container-graf2"
				style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo utf8_encode("Gráfica: Cantidad Normas Incumplidas Empresa - Trabajador"); ?>
			</div>
			<div id="container-graf3"
				style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo utf8_encode("Gráfica: Cantidad Normas Incumplidas Empresa - Unidad Móvil"); ?>
			</div>
			<div id="container-graf4"
				style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		</div>
	</div>
</div>
