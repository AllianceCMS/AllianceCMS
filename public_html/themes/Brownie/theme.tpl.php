<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title><?php echo $venue_title; ?></title>
        <meta name="description" content="<?php echo $venue_description; ?>" />
        <meta name="keywords" content="" />
        <meta name="robots" content="index,follow" />

    	<!-- The styles -->

    	<!-- Begin AllianceCMS styles -->

        <!-- Begin PureCSS Includes -->
        <link rel="stylesheet" href="<?php echo $templateFolder; ?>/tools/pure/0.3.0/pure-min.css">
        <!-- End PureCSS Includes -->

        <!-- Begin Font Awesome Includes -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!-- End Font Awesome Includes -->

        <!-- Begin Hint.css Includes -->
        <link rel="stylesheet" href="<?php echo $templateFolder; ?>/tools/hint.css/1.3.0/hint.min.css">
        <!-- End Hint.css Includes -->

        <!-- Begin AllianceCMS Axis Includes -->
		<link rel="stylesheet" href="<?php echo $templateFolder; ?>/tools/acms/css/style.css"/>
    	<link href="<?php echo $theme_folder; ?>/acms/css/style.css" rel="stylesheet">
        <!-- End AllianceCMS Axis Includes -->

    	<!-- End AllianceCMS styles -->


        <!-- Begin Brownie Includes -->
        <link rel="shortcut icon" href="<?php echo $theme_folder; ?>/images/favicon.ico" />
        <link rel="stylesheet" href="<?php echo $theme_folder; ?>/css/prettyPhoto.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $theme_folder; ?>/css/flexslider.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $theme_folder; ?>/css/style.css" type="text/css" />

        <!--[if (gte IE 6)&(lte IE 8)]>
            <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/html5.js"></script>
            <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/selectivizr-min.js"></script>
            <link rel="stylesheet" href="<?php echo $theme_folder; ?>/css/ie_7.css" type="text/css" />
        <![endif]-->

        <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/all-in-one-min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_folder; ?>/js/setup.js"></script>

        <script type="text/javascript">
            $(window).load(function(){
            	$('#demo-side-bar').removeAttr('style');
            });
        </script>

        <style type="text/css">
            .demobar {
            	display: none;
            }

            #demo-side-bar {
            	top: 53px !important;
            	left: 90% !important;
            	display: block !important;
            }
        </style>

        <!--Dynamically creates ads markup-->
        <?php /* include("http://www.egrappler.com/ads-header.php"); */ ?>

        <!-- End Brownie Includes -->

        <!-- Begin Custom Brownie Includes -->
        <link rel="stylesheet" href="<?php echo $theme_folder; ?>/css/acms.css" type="text/css" />
        <!-- End Custom Brownie Includes -->

		<!-- Begin Custom AllianceCMS Module Includes -->
    	<?php if (!empty($customHeaders)): ?>
            <?php foreach ($customHeaders as $customHeader): ?>
                <?php echo $customHeader; ?>
            <?php endforeach; ?>
        <?php endif; ?>
		<!-- End Custom AllianceCMS Module Includes -->

    </head>

    <body>

    	<!-- Header -->
        <header class="header_bg clearfix">
            <div class="container clearfix">

                <!-- Social -->
                <ul class="social-links">
                    <li>
                        <a href="https://www.facebook.com/alliancecms" target="_blank">
                            <span class="hint--rounded hint--bottom hint--blend" data-hint="Facebook"><i class="fa fa-facebook-square fa-2x"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/AllianceCMS" target="_blank">
                            <span class="hint--rounded hint--bottom hint--blend" data-hint="Twitter"><i class="fa fa-twitter-square fa-2x"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/+Alliancecms" rel="publisher" target="_blank">
                            <span class="hint--rounded hint--bottom hint--blend" data-hint="Google+"><i class="fa fa-google-plus-square fa-2x"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="irc://chat.freenode.net/alliancecms">
                            <span class="hint--rounded hint--bottom hint--blend" data-hint="IRC"><i class="fa fa-comments-o fa-2x"></i></span>
                        </a>
                    </li>
                </ul>
                <!-- /Social -->

                <!-- Logo -->
                <div class="logo">

                    <a href="<?php echo $base_url; ?>">
                        <h3><?php echo $venue_title; ?></h3>
                    </a>

                    <p>
                        <?php echo $venue_tagline; ?>
                    </p>

                </div>
                <!-- /Logo -->

                <!-- Master Nav -->
                <nav class="main-menu">
                    <?php echo $nav1; ?>
                </nav>
                <!-- /Master Nav -->

            </div>
        </header>
        <!-- /Header -->

        <!-- START CONTENT -->
        <section class="container clearfix">

    		<!-- Page Title -->
    		<!--
			<header class="container page_info clearfix">
					<h1 class="regular brown bottom_line">Blog</h1>
				<div class="clear"></div>
			</header>
			-->
    		<!-- /Page Title -->

    		<!-- START CONTENT SIDE -->
    		<div class="content clearfix">

    			<?php echo $content; ?>

    		</div>
    		<!-- END CONTENT SIDE -->

    		<!-- START SIDEBAR SIDE -->
    		<div class="sidebar">

    			<?php if (isset($blocks_area_1)): ?>
                	<?php foreach ($blocks_area_1 as $area_1): ?>

                        <?php echo $area_1; ?>

                	<?php endforeach; ?>
            	<?php endif; ?>

            	<?php if (isset($blocks_area_2)): ?>
                	<?php foreach ($blocks_area_2 as $area_2): ?>

                        <?php echo $area_2; ?>

                	<?php endforeach; ?>
            	<?php endif; ?>

    		</div>
    		<!-- END SIDEBAR SIDE -->

    		<div class="clear padding40"></div>

    	</section>
        <!-- END CONTENT -->

        <!-- footer -->
        <footer class="footer_bg_bottom clearfix">
            <div class="footer_bottom container">
                <div class="col_2_3">

                    <div class="menu">
                        <?php echo $nav1; ?>
                    </div>

                    <div class="clear padding20"></div>

                    <p>
                        &copy; 2004 - 2014 -- <a href="http://www.jbwebware.com">jbWebWare.com</a> - Bringing The Web To You!!!
                    </p>

                </div>

                <div class="clear padding20"></div>

            </div>
        </footer>
        <!-- /footer -->

        <!-- wrapper -->
        <div id="demo-side-bar">
            <?php /* include("http://www.egrappler.com/ad-sidebar.php"); */ ?>
        </div>
        <!-- /wrapper-->

    	<!-- external javascript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->

        <!--Dynamically creates analytics markup-->
        <?php /* include("http://www.egrappler.com/analytics.php"); */ ?>

        <!-- Begin Custom AllianceCMS Bootstrap 3.0 Includes -->
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/js/alert.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/js/collapse.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/js/dropdown.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/js/tab.js"></script>
    	<script src="<?php echo $templateFolder; ?>/tools/bootstrap/3.0.0/js/transition.js"></script>
        <!-- End Custom AllianceCMS Bootstrap 3.0 Includes -->

        <!-- Begin Custom AllianceCMS Includes -->
    	<script src="<?php echo $templateFolder; ?>/tools/acms/js/acms.js"></script>
        <!-- End Custom AllianceCMS Includes -->

    </body>
</html>