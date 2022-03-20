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
        }else {
            $kw_classes = '';
        }
    ?>
	
	<body <?php body_class($kw_classes); ?>>
        <div class="page-wrap">
            <header class="header">
                <div class="menu-wrap">
                    <div class="flex-wrap menu-title">
                        <div class="burger-icon js-burger-icon">
                            <div class="stripe one"></div>
                            <div class="stripe two"></div>
                            <div class="stripe three"></div>
                        </div>

                        <span class="title">
                            <a href="/">
                                <svg id="Ebene_1" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.36 19.84"><defs><style>.cls-1{fill:#1a171b;}</style></defs><path class="cls-1" d="M37,57.06V41.85c0-1.28.12-1.43,1.06-1.6L39.25,40v-.49H32.52V40l1.12.23c.86.17,1.09.32,1.09,1.6V57.06c0,1.29-.26,1.43-1.09,1.6l-1.12.23v.49h6.73l0-.49L38,58.66C37.05,58.49,37,58.35,37,57.06Z" transform="translate(-32.52 -39.53)"/><path class="cls-1" d="M64.65,39.53V40l1,.26c.6.17.83.43.83,1a9.14,9.14,0,0,1-.37,2L62.56,55.86h-.15L58.26,43a6.67,6.67,0,0,1-.37-1.69,1,1,0,0,1,.91-1.09l.86-.17v-.49H53.31V40l.83.2c.8.2,1.06.52,1.83,2.81l.49,1.46L52.71,55.86h-.15L48.44,43a6.05,6.05,0,0,1-.4-1.75c0-.6.31-.85.94-1l1-.2v-.49H42.4V40l1,.29c.69.2,1,.37,1,.8a1.46,1.46,0,0,1-.45.94l-6,7v.32a58.12,58.12,0,0,0,7.3,10H49v-.49l-.75-.2a2.18,2.18,0,0,1-1.43-.92,65.41,65.41,0,0,1-7.1-9.56l5.33-6,.55-.61h.09s.26.71.44,1.27L51.5,59.38h1l4.4-13.2H57l4.44,13.2h1.09l4.69-16c.6-2.12.83-2.83,1.72-3.06l1-.26v-.49Z" transform="translate(-32.52 -39.53)"/></svg>
                            </a>
                        </span>
                    </div>

                    <div class="menu-outline menu-items js-menu ">
                        <?php
                        wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'menu navbar-nav'
                            )
                        );
                        ?>
                    </div>
                </div>
            </header>