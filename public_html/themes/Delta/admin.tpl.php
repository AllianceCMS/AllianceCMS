<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $venue_title; ?></title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet/less" type="text/css" href="<?php echo $theme_folder; ?>/themes/less/bootstrap.less">
		<script src="<?php echo $theme_folder; ?>/themes/js/less/less.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/themes/style/fullcalendar.css" />

		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/themes/style/delta.main.css" />
		<link rel="stylesheet" href="<?php echo $theme_folder; ?>/themes/style/delta.grey.css"/>
	</head>
	<body>
        <br>
        <div id="sidebar">
        	<h1 id="logo"><a href="index.php"></a></h1>
        	<a href="<?php echo $basePath; ?>/admin/dashboard" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        	<ul>

                <?php if (isset($adminNavLinks)): ?>
                	<?php foreach ($adminNavLinks as $adminNavLink): ?>

                        <?php echo $adminNavLink; ?>

                	<?php endforeach; ?>
            	<?php endif; ?>

        		<li class="submenu">
        			<a href="#"><i class="icon icon-wrench"></i> <span>Form elements</span> <span class="label">3</span></a>
        			<ul>
        				<li><a href="#">Common elements</a></li>
        				<li><a href="#">Validation</a></li>
        				<li><a href="#">Wizard</a></li>
        			</ul>
        		</li>
        		<li><a href="#"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
        		<li><a href="#"><i class="icon icon-pencil"></i> <span>Interface elements</span></a></li>
        		<li><a href="#"><i class="icon icon-th"></i> <span>Tables</span></a></li>
        		<li><a href="#"><i class="icon icon-th-list"></i> <span>Grid Layout</span></a></li>
        		<li class="submenu">
        			<a href="#"><i class="icon icon-file"></i> <span>Sample pages</span> <span class="label">4</span></a>
        			<ul>
        				<li><a href="#">Invoice</a></li>
        				<li><a href="#">Support chat</a></li>
        				<li><a href="#">Calendar</a></li>
        				<li><a href="#">Gallery</a></li>
        			</ul>
        		</li>
        		<li>
        			<a href="#"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a>
        		</li>
        		<li>
        			<a href="#"><i class="icon icon-inbox"></i> <span>Widgets</span></a>
        		</li>
        	</ul>
        </div>
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
                        <p>
                    		<strong>Warning: The AllianceCMS Administrative Dashboard is Under Construction!</strong>
                    		<a href="#" data-dismiss="alert" class="close">×</a>
                    	</p>
                    </div>
                </div>

        	    <?php echo $content; ?>

        		<div class="row-fluid">
        			<div id="footer" class="span12">
        				2012 - 2013 &copy; AllianceCMS. Brought to you by <a id="poweredBy" href="http://www.jbwebware.com" target="_blank" title="jbWebWare.com: Bringing The Web To You!">jbWebWare.com</a>
        			</div>
        		</div>
        	</div>
    	</div>

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
	</body>
</html>