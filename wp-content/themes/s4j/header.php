<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>Я Співаю для Ісуса — Щорічний християнський молодіжний фестиваль</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<script>(function(){document.documentElement.className='js'})();</script>
	
	<meta property="og:title" content="Я Співаю для Ісуса" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/fb_image.png" />
	<meta property="og:url" content="https://sing4jesus.org.ua" />
	<meta property="og:description" content="Щорічний християнський молодіжний фестиваль" />
	<?php wp_head(); ?>
</head>
<!-- NAVBAR
================================================== -->
<body <?php body_class(); ?> id="index">
    <div id="app">
        <?php if (Theme_S4J::getOption('ga_account')):?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo Theme_S4J::getOption('ga_account');?>', 'auto');
            ga('send', 'pageview');
        </script>
        <?php endif;?>
        <script>
            /* <![CDATA[ */
            window.Theme_Options = {
                contact_latitude: <?php echo floatval(Theme_S4J::getOption('contact_latitude'))?>,
                contact_longitude: <?php echo floatval(Theme_S4J::getOption('contact_longitude'))?>
            }
            /* ]]> */
        </script>
