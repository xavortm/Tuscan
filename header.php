<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php
        global $page, $paged;
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'inplus' ), max( $paged, $page ) );

        ?></title>
        <meta name="description" content="">
        <meta name="author" content="<?php bloginfo('description'); ?>">
        <meta name="description" content="<?php bloginfo('description') ?>">
        <meta name="viewport" content="width=device-width">

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans|Arvo:400,700|Droid+Serif|Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <header id="header">
            <div class="top">
                <a href="<?php echo site_url() ?>" class="logo">
                    <h1><?php bloginfo('name'); ?></h1>
                </a>
                <p class="description"><?php bloginfo('description') ?></p>
            </div>
            <nav class="wrapper">
                <?php wp_nav_menu( array('theme_location' => 'main-menu') ) ?>
            </nav>
        </header>

        <div id="main" class="wrapper">