<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Home | Page</title> -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="header">
		<nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-main">
                    <div class="navbar-header">
                        <button id="sidenav-toggle" type="button" class="navbar-toggle" aria-expanded="false" aria-controls="navbar"> 
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo home_url(); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo">
                        </a>
                    </div>
                     
                    <div id="navbar" class="collapse navbar-collapse sidenav" data-sidenav  data-sidenav-toggle="#sidenav-toggle">
                        <a class="sidenav-logo visible-xs" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo"></a>
                        <?php wp_nav_menu(
                                    array(
                                        'theme_location' => 'header_menu',
                                        'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                        'menu_class' => 'nav navbar-nav navbar-right',
                                        'fallback_cb' => '',
                                        'menu_id' => 'header_menu',
                                        // 'walker' => new wp_bootstrap_navwalker()
                                    )
                            ); ?>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container -->
		</nav>
	</header>