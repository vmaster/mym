<script>
/*var chart; 

function requestData() {
    $.ajax({
        url: env_webroot_script+ 'reportes/prueba_data',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20
		
            // add the point
            chart.series[0].addPoint(point, true, shift);
            // call it again after one second
            //setTimeout(requestData, 1000);    
        },
        cache: false
    });
}

$(function () {
	

	chart = new Highcharts.Chart({
	//$('#container').highcharts({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'column',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Live random data'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value',
                margin: 80
            }
        },
        series: [{
            name: 'Random data',
            data: []
        }]
    });
});     */   
     
    $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'N\u00FAmero de Normas incumplidas por empresa - 2014'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'MONTALVO SAC',
                'ITALY CORPORATION',
                'ELECTROCENTRO',
                'ARSAC'/*,
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'*/
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de Normas incumplidas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Total: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Empresas',
            data: [15, 20 , 8, 5/*49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4*/]

        }/*, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }*/]
    });

    });

</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Total de Normas incumplidas de empresas por Año')); ?></h2>
	</div>
</div>
<hr />
<div id="reporte1">
	<p>
	<div class="row">
		<?php /* 
		<div class="col-md-2 col-sm-6 col-xs-6" style="margin-top: 16px;"><label><?php echo __('Buscar por');?>:</label></div>
		<div class="col-md-3 col-sm-6 col-xs-6">
		<label><?php echo __('Actividad');?> <input type = "text" name ="txtBuscarDescripcion" id="txtBuscarDescripcion" class="form-control"></label> */?>
		</div>
	</div>
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<center>
	<div class="well" style="width:50%;">
	    <?php 
		if(empty($list_sep_emp)){ 
			echo __('No hay datos estad&iacuter;sticos');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <table class="table" id="table_content">
			<thead>
		        <tr>
		          <th><?php echo utf8_encode(__('Nombre de Empresa')); ?></th>
		          <th style="text-align:center"><?php echo utf8_encode(__('Total Normas incumplidas')); ?></th>
		        </tr>
		    </thead>
			
			<tbody>
			    <?php 
			foreach ($list_sep_emp as $key => $arr_emp):
			?>
					<tr class="actividad_row_container" actividad_id="<?php // echo $nombre; ?>">
						<td>
						<?php 
						echo $arr_emp['EmpresaJoin']['nombre'];
						?></td>
						<td style="text-align:center">
						<?php 
						echo $arr_emp[0]['Cantidad'];
						?></td>
					</tr>
					<?php 
					endforeach;
					?>
			</tbody>	
		</table>
	      </div>
	    <?php }?>
	</div>
	</center>
</div>