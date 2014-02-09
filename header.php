<?php 
include "inc/data.php";
include "inc/queries.php";
include "inc/settings.php";
// include "controllers.php" ?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->	
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
        <meta name="description" content="<?php echo bloginfo('description') ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/main.css">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/lightbox/css/lightbox.css">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!--<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>-->
        <script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.6/angular.min.js"></script>
        <style type="text/css">
        	#header {
        		background-image:url(<?php echo $settings->header_strip ?>);
        	}
        	.strapline {
        		background-image:url(<?php echo $settings->dropdown_background ?>) !important;
        	}
        </style>
    	<?php wp_head(); ?>
    </head>
    <body <?php body_class();?> >
    <div id="bg" data-0="background-position:center 0px;"
    	data-2000="background-position:center -900px;"></div>
    <div id="image-cache" style="position:absolute;height:0;top:0;left:0;width:0;overflow:hidden;opacity:0.01;">
    	<img src="<?php echo get_stylesheet_directory_uri() ?>/img/border-image.png" alt='border-image' />
    	<img src="<?php echo $settings->dropdown_background ?>" alt='dropdown' />
    </div>
	<header id="header">
		<?php
	    $args = array(
			'container'       => 'nav',
			'container_class' => 'top-nav'
			);
		?>
		<div class="desktop">
	   		 <?php wp_nav_menu($args) ?>
		    <div class="user">
		    	<a class="logout" href="<?php echo get_bloginfo('wpurl') ?>?logout=true">
		    		 <img src="<?php echo get_stylesheet_directory_uri() ?>/img/power.png" alt='logout' /> <span>logout</span>
		    	</a>
		    </div>			
		</div>
		<div class="mobile menu-trigger">
			<i class="fa fa-bars"></i><span>Menu</span>		
		</div>
	 </header>
	<div class="mobile-nav-sidebar mobile center-container">
		<div class="center">
		    <?php wp_nav_menu($args) ?>    
		    <div class="user">
		    	<a class="logout" href="<?php echo get_bloginfo('wpurl') ?>?logout=true">
		    		 <img src="<?php echo get_stylesheet_directory_uri() ?>/img/power.png" alt='logout' /> <span>logout</span>
		    	</a>
	    	</div>
	    </div>
    </div>		 
	<div class="site-fade"></div>
    <div class="top-logo"
     data-start="opacity: 1;-webkit-transform: translateY(0px);transform: translateY(0px);-moz-transform: translateY(0px);"
    data-top-bottom="opacity: 0;-webkit-transform: translateY(-70px);-moz-transform: translateY(-70px);transform: translateY(-70px);"
    ><a href="<?php echo get_bloginfo('url')?>"><img src="<?php echo $settings->logo ?>" alt="what the logo" /></a></div>
	
 	<div class="wrapper">
 	