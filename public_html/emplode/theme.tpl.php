<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

    <head>
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    	<meta name="description" content="<?php echo $site_description; ?>"/>
    	<meta name="keywords" content="" />
    	<meta name="author" content="<?php echo $site_author; ?>" />
    	<link rel="stylesheet" type="text/css" href="<?php echo $site_styleSheet; ?>" media="screen" />
    	<title><?php echo $site_title; ?></title>
    	<!-- START Custom Headers -->
    	<?php if (!empty($customHeaders)) echo $customHeaders; ?>
    	<!-- END Custom Headers -->
    </head>

    <body>

        <div id="header">
        	<div class="center_wrapper">

        		<div id="toplinks">
        			<div id="toplinks_inner">
        				<a href="#">Sitemap</a> | <a href="#">Privacy Policy</a> | <a href="#">FAQ</a>
        			</div>
        		</div>
        		<div class="clearer">&nbsp;</div>

        		<div id="site_title">
        			<h1>
                        <!-- <a href="">Alliance<span>CMS</span></a> -->
                        <a href="/"><?php echo $site_title; ?></a>
                    </h1>
        			<p>Bringing The Web To You!!!</p>
        		</div>

        	</div>
        </div>

        <div id="navigation">
        	<div class="center_wrapper">

        		<?php /* echo $nav1; */ ?>

        		<div class="clearer">&nbsp;</div>

        	</div>
        </div>

        <div id="layout_body">

        	<div id="main_wrapper_outer">
        		<div id="main_wrapper_inner">
        			<div class="center_wrapper">

        				<div class="left" id="main">
        					<div id="main_content">

                                <?php echo $body; ?>

                            </div>
        				</div>

        				<div class="right" id="sidebar">

        					<div id="sidebar_content">

        						<?php /* for ($i=0; $i < count($menu1); $i++): */ ?>

        							<div class="box">

        							    <?php /* echo $menu1[$i]; */ ?>

									</div>

                            	<?php /* endfor; */ ?>

        					</div>

        				</div>

        				<div class="clearer">&nbsp;</div>

        			</div>
        		</div>
        	</div>

        </div>

        <div id="dashboard">
        	<div id="dashboard_content">
        		<div class="center_wrapper">

        			<div class="col3 left">
        				<div class="col3_content">

        					<h4>Tincidunt</h4>
        					<ul>
        						<li><a href="#">Consequat molestie</a></li>
        						<li><a href="#">Sem justo</a></li>
        						<li><a href="#">Semper eros</a></li>
        						<li><a href="#">Magna sed purus</a></li>
        						<li><a href="#">Tincidunt morbi</a></li>
        					</ul>

        				</div>
        			</div>

        			<div class="col3mid left">
        				<div class="col3_content">

        					<h4>Fermentum</h4>
        					<ul>
        						<li><a href="#">Semper fermentum</a></li>
        						<li><a href="#">Sem justo</a></li>
        						<li><a href="#">Magna sed purus</a></li>
        						<li><a href="#">Tincidunt nisl</a></li>
        						<li><a href="#">Consequat molestie</a></li>
        					</ul>

        				</div>
        			</div>

        			<div class="col3 right">
        				<div class="col3_content">

        					<h4>Praesent</h4>
        					<ul>
        						<li><a href="#">Semper lobortis</a></li>
        						<li><a href="#">Consequat molestie</a></li>
        						<li><a href="#">Magna sed purus</a></li>
        						<li><a href="#">Sem morbi</a></li>
        						<li><a href="#">Tincidunt sed</a></li>
        					</ul>

        				</div>
        			</div>

        			<div class="clearer">&nbsp;</div>

        		</div>
        	</div>
        </div>

        <div id="footer">
        	<div class="center_wrapper">

        		<div class="left">
        			&copy; 2009 <a href="http://www.jbwebware.com">jbWebWare.com</a> - Bringing The Web To You!!!
        		</div>
        		<div class="right">
        			<a href="http://templates.arcsin.se/">Website template</a> by <a href="http://arcsin.se/">Arcsin</a>
        		</div>

        		<div class="clearer">&nbsp;</div>

        	</div>
        </div>

    </body>
</html>
