<script>
function visitorData (valores) {
	   $('#container').highcharts({
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'N\u00FAmero de informes por empresa - 2014'
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
        
	    series: [{
	    	name: valores.name,
		    data: valores.data
	       }]
	  });
	}
	
	$(document).ready(function() {
		 $.ajax({
		    url: env_webroot_script + 'reportes/prueba_data',
		    type: 'GET',
		    async: true,
		    dataType: "json",
		 }).done(function(data){
				if(data.success == true){
					visitorData (data);
				}
		});
	});


</script>
<div class="row">
	<div class="col-md-12">
		<h2><?php echo utf8_encode(__('Número de Informes de Empresas por Año')); ?></h2>
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
		          <th><?php echo utf8_encode(__('Total de informes')); ?></th>
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
	</center>
</div>