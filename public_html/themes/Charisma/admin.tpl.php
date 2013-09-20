<!DOCTYPE html>
<html lang="en">
    <head>

    	<!--
    		Charisma v1.0.0

    		Copyright 2012 Muhammad Usman
    		Licensed under the Apache License v2.0
    		http://www.apache.org/licenses/LICENSE-2.0

    		http://usman.it
    		http://twitter.com/halalit_usman
    	-->

    	<meta charset="utf-8">
    	<title><?php echo $venue_title; ?></title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="Jesse Burns">

    	<!-- The styles -->

        <!-- Begin PureCSS Includes -->
        <link rel="stylesheet" href="<?php echo $templateFolder; ?>/tools/pure/0.3.0/pure-min.css">
        <!-- End PureCSS Includes -->

        <!-- Begin Hint.css Includes -->
        <link rel="stylesheet" href="<?php echo $templateFolder; ?>/tools/hint.css/1.3.0/hint.min.css">
        <!-- End Hint.css Includes -->

        <!-- Begin Charisma Includes -->
    	<link id="bs-css" href="" rel="stylesheet">
    	<style type="text/css">
    	  body {
    		padding-bottom: 40px;
    	  }
    	  .sidebar-nav {
    		padding: 9px 0;
    	  }
    	</style>
    	<link href="<?php echo $theme_folder; ?>/css/bootstrap-responsive.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/charisma-app.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/fullcalendar.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/fullcalendar.print.css" rel="stylesheet"  media="print">
    	<link href="<?php echo $theme_folder; ?>/css/chosen.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/uniform.default.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/colorbox.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/jquery.cleditor.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/jquery.noty.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/noty_theme_default.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/elfinder.min.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/elfinder.theme.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/jquery.iphone.toggle.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/opa-icons.css" rel="stylesheet">
    	<link href="<?php echo $theme_folder; ?>/css/uploadify.css" rel="stylesheet">

    	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    	<!--[if lt IE 9]>
    	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    	<![endif]-->

    	<!-- The fav icon -->
    	<!-- <link rel="shortcut icon" href="<?php /*echo $theme_folder;*/ ?>/img/favicon.ico"> -->
        <!-- End Charisma Includes -->

        <!-- Begin Custom Includes -->
    	<link href="<?php echo $theme_folder; ?>/acms/css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $templateFolder; ?>/tools/acms/css/style.css"/>
    	<script src="<?php echo $templateFolder; ?>/tools/acms/js/acms.js"></script>
        <!-- End Custom Includes -->

		<!-- Begin Custom Plugin Includes -->

        <?php foreach ($customHeaders as $customHeader): ?>
            <?php echo $customHeader; ?>
        <?php endforeach; ?>

		<!-- End Custom Plugin Includes -->

    </head>

    <body>
		<!-- topbar starts -->
    	<div class="navbar">
    		<div class="navbar-inner">
    			<div class="container-fluid">
    				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
    					<span class="icon-bar"></span>
    					<span class="icon-bar"></span>
    					<span class="icon-bar"></span>
    				</a>
    				<a class="brand" href="<?php echo $basePath; ?>"> <span><?php echo $venue_name; ?></span></a>

    				<!-- theme selector starts -->
    				<div class="btn-group pull-right theme-container" >
    					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
    						<span class="caret"></span>
    					</a>
    					<ul class="dropdown-menu" id="themes">
    						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
    						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
    						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
    						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
    						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
    						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
    						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
    					</ul>
    				</div>
    				<!-- theme selector ends -->

    				<!-- user dropdown starts -->
    				<div class="btn-group pull-right" >
    					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
    						<span class="caret"></span>
    					</a>
    					<ul class="dropdown-menu">
    						<li><a href="#">Profile</a></li>
    						<li class="divider"></li>
    						<li><a href="login.html">Logout</a></li>
    					</ul>
    				</div>
    				<!-- user dropdown ends -->

    				<div class="top-nav nav-collapse">
    					<ul class="nav">
                            <?php echo $nav1; ?>
    					</ul>
    				</div><!--/.nav-collapse -->
    			</div>
    		</div>
    	</div>
    	<!-- topbar ends -->

		<div class="container-fluid">
    		<div class="row-fluid">

    			<!-- left menu starts -->
    			<div id="accordion" class="span2 main-menu-span">
    				<div class="well nav-collapse sidebar-nav">
    					<ul class="nav nav-tabs nav-stacked main-menu">

                            <?php echo $adminNavbar; ?>

    					</ul>
    					<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
    				</div><!--/.well -->
    			</div><!--/span-->
    			<!-- left menu ends -->

    			<noscript>
    				<div class="alert alert-block span10">
    					<h4 class="alert-heading">Warning!</h4>
    					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    				</div>
    			</noscript>

    			<div id="content" class="span10">

                    <!-- content starts -->
        			<div>
        				<ul class="breadcrumb">
        					<li>
        						<a href="<?php echo $basePath; ?>">Home</a> <span class="divider">/</span>
        					</li>
        					<li>
        						<a href="<?php echo $basePath; ?>/admin/dashboard">Dashboard</a>
        					</li>
        				</ul>
        			</div>

        			<div class="sortable row-fluid">
                        <div class="alert alert-error">
                            <strong>Warning: The AllianceCMS Administrative Dashboard is Under Construction!</strong>
                            <a href="#" data-dismiss="alert" class="close">&times;</a>
                        </div>
        			</div>

                    <!-- Plugin content starts -->

                    <div id="acms_content">
                        <?php echo $content; ?>
            	    </div>

                    <!-- Plugin content ends -->

					<!-- content ends -->
    			</div><!--/#content.span10-->
			</div><!--/fluid-row-->

    		<hr>

    		<div class="modal hide fade" id="myModal">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">×</button>
    				<h3>Settings</h3>
    			</div>
    			<div class="modal-body">
    				<p>Here settings can be configured...</p>
    			</div>
    			<div class="modal-footer">
    				<a href="#" class="btn" data-dismiss="modal">Close</a>
    				<a href="#" class="btn btn-primary">Save changes</a>
    			</div>
    		</div>

    		<footer>
    			<p class="pull-left">&copy; 2012 - 2013 <a href="http://www.alliancecms.com" target="_blank">AllianceCMS</a>. All rights reserved.</p>
    			<p class="pull-right">Brought to you by: <a id="poweredBy" href="http://www.jbwebware.com" target="_blank" title="jbWebWare.com: Bringing The Web To You!">jbWebWare.com</a> - Bringing The Web To You!</p>
    		</footer>

    	</div><!--/.fluid-container-->

    	<!-- external javascript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->

    	<!-- jQuery -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery-1.7.2.min.js"></script>
    	<!-- jQuery UI -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery-ui-1.8.21.custom.min.js"></script>
    	<!-- transition / effect library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-transition.js"></script>
    	<!-- alert enhancer library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-alert.js"></script>
    	<!-- modal / dialog library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-modal.js"></script>
    	<!-- custom dropdown library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-dropdown.js"></script>
    	<!-- scrolspy library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-scrollspy.js"></script>
    	<!-- library for creating tabs -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-tab.js"></script>
    	<!-- library for advanced tooltip -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-tooltip.js"></script>
    	<!-- popover effect library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-popover.js"></script>
    	<!-- button enhancer library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-button.js"></script>
    	<!-- accordion library (optional, not used in demo) -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-collapse.js"></script>
    	<!-- carousel slideshow library (optional, not used in demo) -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-carousel.js"></script>
    	<!-- autocomplete library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-typeahead.js"></script>
    	<!-- tour library -->
    	<script src="<?php echo $theme_folder; ?>/js/bootstrap-tour.js"></script>
    	<!-- library for cookie management -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.cookie.js"></script>
    	<!-- calander plugin -->
    	<script src="<?php echo $theme_folder; ?>/js/fullcalendar.min.js"></script>
    	<!-- data table plugin -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.dataTables.min.js"></script>

    	<!-- chart libraries start -->
    	<script src="<?php echo $theme_folder; ?>/js/excanvas.js"></script>
    	<script src="<?php echo $theme_folder; ?>/js/jquery.flot.min.js"></script>
    	<script src="<?php echo $theme_folder; ?>/js/jquery.flot.pie.min.js"></script>
    	<script src="<?php echo $theme_folder; ?>/js/jquery.flot.stack.js"></script>
    	<script src="<?php echo $theme_folder; ?>/js/jquery.flot.resize.min.js"></script>
    	<!-- chart libraries end -->

    	<!-- select or dropdown enhancer -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.chosen.min.js"></script>
    	<!-- checkbox, radio, and file input styler -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.uniform.min.js"></script>
    	<!-- plugin for gallery image view -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.colorbox.min.js"></script>
    	<!-- rich text editor library -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.cleditor.min.js"></script>
    	<!-- notification plugin -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.noty.js"></script>
    	<!-- file manager library -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.elfinder.min.js"></script>
    	<!-- star rating plugin -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.raty.min.js"></script>
    	<!-- for iOS style toggle switch -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.iphone.toggle.js"></script>
    	<!-- autogrowing textarea plugin -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.autogrow-textarea.js"></script>
    	<!-- multiple file upload plugin -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.uploadify-3.1.min.js"></script>
    	<!-- history.js for cross-browser state change on ajax -->
    	<script src="<?php echo $theme_folder; ?>/js/jquery.history.js"></script>
    	<!-- application script for Charisma demo -->
    	<script src="<?php echo $theme_folder; ?>/js/charisma.js"></script>

        <!-- Begin Custom Bootstrap 3.0 Includes -->
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/alert.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/collapse.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/dropdown.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/transition.js"></script>
        <!-- End Custom Bootstrap 3.0 Includes -->

    </body>
</html>
