<?php
// wp-meetup
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    
    <title><?php wp_title(''); ?></title>  

    <!-- meta -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="shortcut icon" href="/favicon.ico">

    <!-- css -->

    <link rel="stylesheet" href="<?php echo get_bloginfo( 'template_directory' ); ?>/style.css">

    <!-- js -->
    
    <script src="<?php echo get_bloginfo( 'template_directory' ); ?>/js/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <!-- pingback -->
    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- wp head -->
    
    <?php wp_head(); ?>

</head>

<!--[if lt IE 7 ]> <body <?php body_class('ie6'); ?>> <![endif]-->
<!--[if IE 7 ]>    <body <?php body_class('ie7'); ?>> <![endif]-->
<!--[if IE 8 ]>    <body <?php body_class('ie8'); ?>> <![endif]-->
<!--[if IE 9 ]>    <body <?php body_class('ie9'); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body <?php body_class('ie6'); ?>> <!--<![endif]-->