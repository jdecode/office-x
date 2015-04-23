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
			"/assets/css/style-responsive.css",
			"/assets/css/custom.css"
		))
		?>
		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<?php
		echo $this->Html->script(array(
			"/assets/js/jquery.js",
			"/assets/js/bootstrap.min.js",
		))
		?>


		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<section id="container" >
			<!-- **********************************************************************************************************************************************************
			TOP BAR CONTENT & NOTIFICATIONS
			*********************************************************************************************************************************************************** -->
			<!--header start-->
			<header class="header black-bg">
				<div class="sidebar-toggle-box">
					<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
				</div>
				<!--logo start-->
				<a href="<?php echo $this->webroot.'' ?>" class="logo"><b>E-DOCUMENT MANAGEMENT SYSTEM</b></a>
				<!--logo end-->

				<div class="top-menu">
					<ul class="nav pull-right top-menu">
						<li><?php echo "<span style='text-transform:uppercase; position:relative;top:20px;' class ='logout'>".$_client_data['username']."</span>" ?></li>         <!--$_admin_data['username']-->
						<li>
							<?php echo $this->Html->link("Change password", array("controller" => "users", "action" => "changepassword"), array("class" => "logout")); ?>
						</li>
						<li>
							<?php echo $this->Html->link("Logout", array("controller" => "users", "action" => "logout"), array("class" => "logout")); ?>
						</li>
					</ul>
				</div>
			</header>
			<!--header end-->

			<!-- **********************************************************************************************************************************************************
			MAIN SIDEBAR MENU
			*********************************************************************************************************************************************************** -->
			<!--sidebar start-->
			<aside>
				<div id="sidebar"  class="nav-collapse ">
					<!-- sidebar menu start-->
					<?php echo $this->element("client-sidebar"); ?>
					<!-- sidebar menu end-->
				</div>
			</aside>
			<!--sidebar end-->

			<!-- **********************************************************************************************************************************************************
			MAIN CONTENT
			*********************************************************************************************************************************************************** -->
			<!--main content start-->
			<section id="main-content">
				<section class="wrapper">
					<div class="row mt">

						<?php echo $content_for_layout; ?>



					</div><!-- /row -->

				</section><! --/wrapper -->
			</section><!-- /MAIN CONTENT -->

			<!--main content end-->
			<!--footer start-->
			<footer class="site-footer">
				<div class="text-center">
					<?php echo date('Y') ?> - himsoftsolution.com
					<a href="#" class="go-top">
						<i class="fa fa-angle-up"></i>
					</a>
				</div>
			</footer>
			<!--footer end-->
		</section>

		<!-- js placed at the end of the document so the pages load faster -->
		<?php /*  <script src="assets/js/jquery.js"></script>
		  <script src="assets/js/bootstrap.min.js"></script>
		  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
		  <script src="assets/js/jquery.scrollTo.min.js"></script>
		  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
		 */ ?>


		<?php
		echo $this->Html->script(array(
			"/assets/js/jquery.dcjqaccordion.2.7.js",
			"/assets/js/jquery.scrollTo.min.js",
			"/assets/js/common-scripts.js"
		))
		?>



		<!--common script for all pages-->


		<!--script for this page-->

		<script>
            //custom select box

            $(function () {
                $('select.styled').customSelect();
            });

		</script>
		<?php echo $this->element('sql_dump');?> 
	</body>
</html>
