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
            setTimeout(requestData, 1000);    
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
});*/        
     
    $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'N\u00FAmero de supervisiones por empresa - 2014'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'MONTALVO SAC',
                'ITALY CORPORATION',
                'ELECTROCENTRO',
                'ARSAC'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de supervisiones'
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
            data: [15, 20 , 8, 5]

        }]
    });

 });

</script>
<div class="row">
	<div class="col-md-12">
		<h2>Total de Empresas Supervisadas por fecha</h2>
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
	<div class="well">
	    <?php 
		if(empty($list_sep_emp)){ 
			echo __('No hay datos estad&iacuter;sticos');
		}else{ ?>  
	      <div id = "conteiner_all_rows">
	      <table class="table" id="table_content">
			<thead>
		        <tr>
		          <th><?php echo __('ID'); ?></th>
		          <th><?php echo utf8_encode(__('Nombre de Empresa')); ?></th>
		          <th><?php echo utf8_encode(__('Cantidad')); ?></th>
		        </tr>
		    </thead>
			
			<tbody>
			    <?php 
			$n = 0;
			foreach ($list_sep_emp as $key => $arr_emp):
			$n = $n + 1;
			?>
					<tr class="actividad_row_container" actividad_id="<?php // echo $nombre; ?>">
						<td><?php echo $n; ?></td>
						<td>
						<?php 
						echo $arr_emp['EmpresaJoin']['nombre'];
						?></td>
						<td>
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
	
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	
</div>