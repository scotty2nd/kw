<?php
/*
	Template Name: Kollektionen
*/
?>

<?php get_header(); ?>

<div class="js-collection-slider-new tiles">
    <?php
        $kollektions = get_terms( array(
            'taxonomy'   => 'kollektion',
            'hide_empty' => true,
        ));

        // Alle Kollektionen durchlaufen
        foreach( $kollektions as $kollektion ) { ?>
            <?php
                $collectionName = $kollektion->name;
                $collectionYear = get_field('collection_year', $kollektion);
                $collectionImageDesktop = get_field('collection_image_desktop', $kollektion);
                $collectionImageTablet = get_field('collection_image_tablet', $kollektion);
                $collectionImageMobile = get_field('collection_image_mobile', $kollektion);
            ?>

            <div class="item-wrap">
                <a href="<?php echo get_term_link( $kollektion ); ?>" class="item effect-oscar">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="<?php echo $collectionImageDesktop; ?>">
                        <source media="(min-width: 768px)" srcset="<?php echo $collectionImageTablet; ?>">
                        <source media="(min-width: 320px)" srcset="<?php echo $collectionImageMobile; ?>">
                        <img src="<?php echo $collectionImageDesktop; ?>">
                    </picture>

                    <figcaption>
                        <p><?php echo $collectionName; ?></p>
                    </figcaption>
                </a>
            </div>

        <?php } ?>

        <?php wp_reset_postdata(); ?>

    </div>
</div>

<?php get_footer(); ?>
