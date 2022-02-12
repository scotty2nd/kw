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
            ?>

            <div class="item-wrap">
                <a href="<?php echo get_term_link( $kollektion ); ?>" class="item effect-oscar">
                    <div class="picture" style="background-image: url('<?php echo $collectionImageDesktop; ?>'); background-size: cover; background-repeat: no-repeat; background-position:center; padding-bottom: 100%; height: 100%"></div>

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
