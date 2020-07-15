<?php
/*
	Template Name: Startseite
*/
?>

<?php get_header(); ?>

<div class="welcome-tiles js-welcome-tiles">
    <?php
        /*Tile Left*/
        $desktopImageLeft = get_field('tile_left_desktop_img');
        $tabletImageLeft = get_field('tile_left_tablet_img');
        $mobileImageLeft = get_field('tile_left_mobil_img');
        $titleLeft = get_field('tile_left_title');
        $linkLeft = get_field('tile_left_link');

        /*Tile Middle*/
        $desktopImageMiddle = get_field('tile_middle_desktop_img');
        $tabletImageMiddle = get_field('tile_middle_tablet_img');
        $mobileImageMiddle = get_field('tile_middle_mobil_img');
        $titleMiddle = get_field('tile_middle_title');
        $linkMiddle = get_field('tile_middle_link');

        /*Tile Right*/
        $desktopImageRight = get_field('tile_right_desktop_img');
        $tabletImageRight = get_field('tile_right_tablet_img');
        $mobileImageRight = get_field('tile_right_mobil_img');
        $titleRight = get_field('tile_right_title');
        $linkRight = get_field('tile_right_link');
    ?>

    <a href="<?php if( $linkLeft ) { echo get_term_link( $linkLeft ); } ?>" class="item effect-oscar">
        <picture>
            <source media="(min-width: 1024px)" srcset="<?php echo $desktopImageLeft; ?>">
            <source media="(min-width: 768px)" srcset="<?php echo $tabletImageLeft; ?>">
            <source media="(min-width: 320px)" srcset="<?php echo $mobileImageLeft; ?>">
            <img src="<?php echo $desktopImageLeft; ?>">
        </picture>

        <figcaption>
            <p><?php echo $titleLeft; ?></p>
        </figcaption>
    </a>

    <a href="<?php if( $linkMiddle ) { echo get_term_link( $linkMiddle ); } ?>" class="item effect-oscar">
        <picture>
            <source media="(min-width: 1024px)" srcset="<?php echo $desktopImageMiddle; ?>">
            <source media="(min-width: 768px)" srcset="<?php echo $tabletImageMiddle; ?>">
            <source media="(min-width: 320px)" srcset="<?php echo $mobileImageMiddle; ?>">
            <img src="<?php echo $desktopImageMiddle; ?>">
        </picture>

        <figcaption>
            <p><?php echo $titleMiddle; ?></p>
        </figcaption>
    </a>

    <a href="<?php if( $linkRight ) { echo get_term_link( $linkRight ); } ?>" class="item effect-oscar">
        <picture>
            <source media="(min-width: 1024px)" srcset="<?php echo $desktopImageRight; ?>">
            <source media="(min-width: 768px)" srcset="<?php echo $tabletImageRight; ?>">
            <source media="(min-width: 320px)" srcset="<?php echo $mobileImageRight; ?>">
            <img src="<?php echo $desktopImageRight; ?>">
        </picture>

        <figcaption>
            <p><?php echo $titleRight; ?></p>
        </figcaption>
    </a>
</div>

<?php get_footer(); ?>
