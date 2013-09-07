<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $venue_title; ?></title>

		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Begin PureCSS Includes -->
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">
        <!-- End PureCSS Includes -->

        <!-- Begin Delta Includes -->
		<link rel="stylesheet/less" type="text/css" href="<?php echo $theme_folder; ?>/themes/less/bootstrap.less">
		<script src="<?php echo $theme_folder; ?>/themes/js/less/less.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/themes/style/fullcalendar.css" />

		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/themes/style/delta.main.css" />
		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/themes/style/delta.grey.css"/>
        <!-- End Delta Includes -->

        <!-- Begin Custom Includes -->
		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/acms/css/style.css"/>
        <!-- End Custom Includes -->

	</head>
	<body>
        <br>

        <?php echo $adminNavbar; ?>

        <div id="mainBody">
        	<h1><?php echo $venue_name; ?>
        		<div class="pull-right">
            		<a class="btn btn-large tip-bottom" title="Manage Files"><i class="icon-file"></i></a>
            		<a class="btn btn-large tip-bottom" title="Manage Users"><i class="icon-user"></i></a>
            		<a class="btn btn-large tip-bottom" title="Manage Comments" style="position:relative"><i class="icon-comment"></i>
            		<span style="position:absolute; border-radius:12px; top:-23%; height:16px; width:16px" class="label label-important">5</span></a>
            		<a class="btn btn-large tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a>
            		<a class="btn btn-large tip-bottom"  title="View Profile" href="#"><i class="icon icon-user"></i> <span>Profile</span></a>
            		<a class="btn btn-large tip-bottom" title="Edit Profile Settings" href="#"><i class="icon icon-cog"></i> Settings</a>
            		<a class="btn btn-large btn-danger tip-bottom" title="Log Off" href="#"><i class="icon-off"></i></a>
        		</div>
        	</h1>
        	<div id="breadcrumb">
        		<a href="<?php echo $basePath; ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        		<a href="<?php echo $basePath; ?>/admin/dashboard" class="current">Dashboard</a>
        	</div>
        	<div class="container-fluid">
                <div class="row-fluid">
                    <div class="alert alert-danger">
                		<strong>Warning: The AllianceCMS Administrative Dashboard is Under Construction!</strong>
                		<a href="#" data-dismiss="alert" class="close">&times;</a>
                    </div>
                </div>

                <div id="acms_content">
                    <?php echo $content; ?>
        	    </div>

        		<div class="row-fluid">
        			<div id="footer" class="span12">
        				2012 - 2013 &copy; AllianceCMS. Brought to you by <a id="poweredBy" href="http://www.jbwebware.com" target="_blank" title="jbWebWare.com: Bringing The Web To You!">jbWebWare.com</a> - Bringing The Web To You!
        			</div>
        		</div>
        	</div>
    	</div>

        <!-- JavaScript at the bottom for fast page loading -->

    	<!-- More Scripts-->

        <!-- Begin Delta Includes -->
        <script src="<?php echo $theme_folder; ?>/themes/js/excanvas.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/jquery.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/jquery.ui.custom.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/bootstrap.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/jquery.flot.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/jquery.flot.resize.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/jquery.peity.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/fullcalendar.min.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/delta.js"></script>
        <script src="<?php echo $theme_folder; ?>/themes/js/delta.dashboard.js"></script>
        <!-- End Delta Includes -->

	</body>
</html>