<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>M & M - Ingeniería Obras y Servicios</title>
	<!-- BOOTSTRAP STYLES-->
    <link rel="stylesheet" type="text/css" href="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/css/bootstrap.css">
     <!-- FONTAWESOME STYLES-->
     <link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/css/font-awesome.css">
    <!-- CUSTOM STYLES-->
    <link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/css/custom.css">
    <!-- DATATABLE -->
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    
    <!-- AUTOCOMPLETE -->
    <link href="<?= ENV_WEBROOT_FULL_URL;?>js/jquery_autocomplete/content/styles.css" rel="stylesheet" />
    
    <!-- SELECT 2 -->
    <link href="<?= ENV_WEBROOT_FULL_URL;?>lib/select2-4.0.0-rc.2/dist/css/select2.min.css" rel="stylesheet" />
    
    <script>var env_webroot_script = '<?php echo ENV_WEBROOT_FULL_URL; ?>';</script>
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   	<!-- STYLES OF ALERT MESSAGE -->
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>lib/alertify-0.3.11/css/alertify.core.css" rel="stylesheet">
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>lib/alertify-0.3.11/css/alertify.default.css" rel="stylesheet">
    <link href="<?= ENV_WEBROOT_FULL_URL; ?>lib/jquery_ui/css/jquery.ui.all.css" rel="stylesheet">

   	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/jquery_ui/jquery-1.8.3.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>
    
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/user.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/trabajador.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/actividad.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/tipo_vehiculo.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/vehiculo.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/empresa.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/acta.js" type="text/javascript"></script>
   <!--<script src="<?= ENV_WEBROOT_FULL_URL;?>js/acta_instalaciones.js" type="text/javascript"></script>-->
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/categoria_norma.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/codigo.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/uunn.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/configuration.js" type="text/javascript"></script>
    
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/jquery_datepicker/jquery.ui.datepicker-es.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/alertify-0.3.11/alertify.min.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/nice-edit/nicEdit.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>/lib/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>

    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/canvg/rgbcolor.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/canvg/StackBlur.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>lib/canvg/canvg.js" type="text/javascript"></script>
	
    <!-- FILE UPLOAD -->
    <!-- Force latest IE rendering engine or ChromeFrame if installed -->
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/css/jquery.fileupload.css">
	<link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/css/jquery.fileupload-ui.css">
	<!-- CSS adjustments for browsers with JavaScript disabled -->
	<noscript><link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/css/jquery.fileupload-noscript.css"></noscript>
	<noscript><link rel="stylesheet" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/css/jquery.fileupload-ui-noscript.css"></noscript>
	<!-- END FILE UPLOAD -->
	
	
	<!-- STYLE DATA-TABLE  -->	
	<link rel="stylesheet" type="text/css" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/extensions/TableTools/css/dataTables.tableTools.css">
	<link rel="stylesheet" type="text/css" href="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/resources/syntax/shCore.css">

	<!-- END STYLE DATA-TABLE -->
	
	
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-cls-top " role="navigation"
			style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?= ENV_WEBROOT_FULL_URL; ?>" style="padding:5px 5px">
					<div style="font-size:19px">GISEMM</div>
					<div style="font-size: 11px;line-height: 15px;font-weight: 100;padding: 5px">Gesti&oacute;n de Ingenier&iacute;a y Sostenibilidad empresarial M&M</div>
				</a>
			</div>
			<div
				style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<strong><?php echo __('Bienvenido').': '.$this->Session->read('Auth.User.username'); ?></strong> &nbsp;
				<?php echo $this->Html->link(__('Cerrar Sesión'),array('ajax'=>false,'controller' => 'users', 'action' => 'logout'), array('class'=>'btn btn-danger square-btn-adjust', 'style'=>'background-color:#428bca !important; border-color:#357ebd !important;')); ?>
			</div>
		</nav>
		<!-- /. NAV TOP  (MENU LATERAL)-->
		<?php echo $this->Element('menu_lateral');  ?>
		<!-- /. NAV SIDE  -->
		<div id="page-wrapper">
			<div id="page-inner">
				<?php echo $this->fetch('content'); ?>
			<!-- /. PAGE INNER  -->
		</div>
		<!-- /. PAGE WRAPPER  -->
	</div> 

	<!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <!-- <script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/js/jquery-1.10.2.js"></script> -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/theme/js/custom.js"></script>
    
    <script type="text/javascript">
    var myProccess;
    myProccess = myProccess || (function () {

		var pleaseWaitDiv = $('<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"><div class="modal-dialog modal-sm"><div class="modal-content" style="padding:10px;"><center>Procesando.. <img src="<?= ENV_WEBROOT_FULL_URL; ?>img/ajax-loader.gif" alt="Cargando..."/></center><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div></div>');
	    
		return {
			showPleaseWait: function () {
				pleaseWaitDiv.modal({backdrop: 'static',keyboard: false});
			},
			hidePleaseWait: function () {
				pleaseWaitDiv.modal('hide');
			},
		};
	})();
    
    </script>

    <!-- FILE:UPLOAD -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
	<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
	<!-- blueimp Gallery script -->
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload-validate.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<script src="<?= ENV_WEBROOT_FULL_URL; ?>lib/file.upload/js/main.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="js/cors/jquery.xdr-transport.js"></script>
	<![endif]-->
    <!-- END FILE UPLOAD -->

    <!-- SCRIPT SELECT2 -->
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/select2-4.0.0-rc.2/dist/js/select2.min.js"></script>
	
	<!-- SCRIPT FILEUPLOAD -->
	<?php if($this->request->params['action']=='add_edit_trabajador'){?>
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/bootstrap-fileupload.js"></script>
	<?php }?>
	
	<!-- HIGHCHART -->
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/highcharts-4.1.5/highcharts.js"></script>
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/highcharts-4.1.5/modules/drilldown.js"></script>
	
	<!-- DATA TABLE -->	
	<script type="text/javascript" language="javascript" src="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/extensions/TableTools/js/dataTables.tableTools.js"></script>
	<script type="text/javascript" language="javascript" src="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="<?= ENV_WEBROOT_FULL_URL; ?>lib/data.tables-1.10.6/resources/demo.js"></script>
	
</body>
</html>
