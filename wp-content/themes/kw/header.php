<!doctype html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>

    <?php
        if( is_front_page() ){
            $kw_classes = array( 'kw-class', 'home' );
        }
    ?>
	
	<body <?php body_class($kw_classes); ?>>
        <div class="page-wrap">
            <header class="header">
                <div class="menu-wrap">
                    <div class="flex-wrap">
                        <div class="burger-icon js-burger-icon">
                            <div class="stripe one"></div>
                            <div class="stripe two"></div>
                            <div class="stripe three"></div>
                        </div>

                        <span class="title">Kristina Wirsching</span>
                    </div>

                    <div class="menu-outline">
                        <?php
                        wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'js-menu menu navbar-nav'
                            )
                        );
                        ?>
                    </div>
                </div>
            </header>