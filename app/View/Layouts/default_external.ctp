<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>M & M Ingenieros - Ingeniería Obras y Servicios</title>
<!-- BOOTSTRAP STYLES-->
<link href="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/css/bootstrap.css"
	rel="stylesheet">
<!-- FONTAWESOME STYLES-->
<link href="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/css/font-awesome.css"
	rel="stylesheet">
<!-- CUSTOM STYLES-->
<link href="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/css/custom.css"
	rel="stylesheet">
<!-- GOOGLE FONTS-->
<link href="http://fonts.googleapis.com/css?family=Open+Sans"
	rel="stylesheet" type="text/css">

</head>
<body>
	<div class="container">
		<?php /* <div class="alert alert-info">
			<?php echo $this->Session->flash(); ?>
			<?php
			if ($this->Session->check('Message.flash')) {
				        $this->Session->flash();
				    }
				    if ($this->Session->check('Message.auth')) {
				        $this->Session->flash('auth');
				    }
			?>
		</div> */?>
		<?php echo $this->fetch('content'); ?>
	</div>


	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script async="" src="//www.google-analytics.com/analytics.js"></script>
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script
		src="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/js/jquery.metisMenu.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="<?= ENV_WEBROOT_FULL_URL;?>lib/theme/js/custom.js"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-38955291-1', 'auto');
  ga('send', 'pageview');

</script>


</body>
</html>
