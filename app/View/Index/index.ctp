<script>  
     
    $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'N\u00FAmero de Informes por empresa - 2014'
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
                text: 'Cantidad de Informes'
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

        }]
    });




    $('#container2').highcharts({
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
            data: [30, 20 , 40, 15/*49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4*/]

        }]
    });
    

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
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-red set-icon"> <i
				class="fa fa-file-text-o"></i>
			</span>
			<div class="text-box">
				<p class="main-text" style="font-size:20px !important"><?php echo (isset($count_informe_day))? $count_informe_day :''; ?> Nuevos</p>
				<p class="text-muted">Informes</p>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-green set-icon"> <i
				class="fa fa-users"></i>
			</span>
			<div class="text-box">
				<p class="main-text" style="font-size:20px !important"><?php echo (isset($count_usuarios))? $count_usuarios :''; ?> Users</p>
				<p class="text-muted">Registrados</p>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-blue set-icon"> <i
				class="fa fa-building-o"></i>
			</span>
			<div class="text-box">
				<p class="main-text" style="font-size:20px !important"><?php echo (isset($count_empresas))? $count_empresas :''; ?> Empresas</p>
				<p class="text-muted">Registradas</p>
			</div>
		</div>
	</div>
	<!-- <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">3 Orders</p>
                    <p class="text-muted">Pending</p>
                </div>
             </div>
		     </div>-->
</div>
<!-- /. ROW  -->
                <hr />                
                <!-- <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue">
                    <i class="fa fa-warning"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">52 Important Issues to Fix </p>
                    <p class="text-muted">Please fix these issues to work smooth</p>
                    <p class="text-muted">Time Left: 30 mins</p>
                    <hr />
                    <p class="text-muted">
                          <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
                               Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn. 
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn. 
                               </span>
                    </p>
                </div>
             </div>
		     </div>
                    
                    
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel back-dash">
                               <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; SPEED</strong>
                             <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing sit ametsit amet elit ftr. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                       
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                        <div class="panel ">
          <div class="main-temp-back">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Newyork City </div>
                <div class="col-xs-6">
                  <div class="text-temp"> 10° </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
                     <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-desktop"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Display</p>
                    <p class="text-muted">Looking Good</p>
                </div>
             </div>
			
    </div>
                        
        </div>-->
                 <!-- /. ROW  -->
                <div class="row"> 
                    
                      
                 <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo utf8_encode("Gráfica: Número de informes por Empresa"); ?>
                        </div>
                        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>            
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo utf8_encode("Gráfica: Número de Normas incumplidas por empresa"); ?>
                        </div>
                        <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>            
                </div>
                    <!-- <div class="col-md-3 col-sm-12 col-xs-12">                       
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>120 GB </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                           Disk Space Available
                            
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-edit fa-5x"></i>
                            <h3>20,000 </h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Articles Pending
                            
                        </div>
                    </div>                         
                        </div> -->
                
           </div>