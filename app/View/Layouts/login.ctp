<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Dashboard">
		<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

		<title><?php echo isset($page_title) ? $page_title : "Office"; ?></title>


		<?php
		echo $this->Html->css(array(
			"/assets/css/bootstrap.css",
			"/assets/font-awesome/css/font-awesome.css",
			"/assets/css/style.css",
			"/assets/css/style-responsive.css"
		));
		echo $this->Html->script(array(
			"/assets/js/jquery.js",
		))
		?>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<!-- **********************************************************************************************************************************************************
		MAIN CONTENT
		*********************************************************************************************************************************************************** -->

		<div id="login-page">

			<?php echo $content_for_layout; ?>
		</div>
		<?php
		echo $this->Html->script(array(
			"/assets/js/bootstrap.min.js",
			"/assets/js/jquery.backstretch.min.js"
		))
		?>

		<script>
			$.backstretch("<?php echo $this->webroot ?>assets/img/login-bg.jpg", {speed: 500});
		</script>

		<?php echo $this->element('sql_dump'); ?>

	</body>
</html>