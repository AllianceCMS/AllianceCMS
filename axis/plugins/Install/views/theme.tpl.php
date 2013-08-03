<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

    <head>
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    	<meta name="description" content=""/>
    	<meta name="keywords" content="" />
    	<meta name="author" content="<?php echo $author; ?>" />
    	<link rel="stylesheet" type="text/css" href="<?php echo $theme_folder; ?>/css/style.css" media="screen" />
    	<title><?php echo $title; ?></title>
    </head>

    <body>

        <div id="header">
        	<div class="center_wrapper">

                <div class="clearer">&nbsp;</div>

        		<div id="site_title">
        			<h1><a href="#">Alliance<span>CMS</span></a></h1>
        			<p>Bringing Us Together</p>
        		</div>

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

                        		<?php
                                    for ($i = 0; $i < count($menu); $i++) {
                                        echo $menu[$i];
                                    }
                                ?>

                        	</div>

                        </div>

                        <div class="clearer">&nbsp;</div>

        			</div>
        		</div>
        	</div>

        </div>

        <div id="footer">
        	<div class="center_wrapper">

        		<div class="left">
        			&copy; 2004-2013 <a href="http://www.jbWebware.com">jbWebware.com</a> - Bringing The Web To You!
        		</div>
        		<div class="right">
        			<a href="http://templates.arcsin.se/">Website template</a> by <a href="http://arcsin.se/">Arcsin</a>
        		</div>

        		<div class="clearer">&nbsp;</div>

        	</div>
        </div>

    </body>
</html>