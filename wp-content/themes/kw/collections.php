<?php
/*
	Template Name: Kollektionen
*/
?>

<?php get_header(); ?>

<div class="welcome-tiles">
    <?php
        $kollektions = get_terms( array(
            'taxonomy'   => 'kollektion',
            'hide_empty' => true,
        ));

        // Alle Kollektionen durchlaufen
        foreach( $kollektions as $kollektion ) { ?>
            <?php
                $posts[$kollektion->name] = get_posts(array( 'posts_per_page' => -1, 'post_type' => 'produkte', 'tax_query' => array(
                    array (
                        'taxonomy' => 'kollektion',
                        'field' => 'slug',
                        'terms' => $kollektion->name,
                    )
                ) ));

                $variable = get_field('product_images_desktop', $posts[$kollektion->name][0]->ID);

                echo '<pre>';
                //var_dump($posts[$kollektion->name]);
                var_dump($posts[$kollektion->name][0]->ID);
                var_dump($variable[0]['sizes']['large']);
                echo '<pre>';
            ?>

            <a href="<?php echo get_term_link( $kollektion ); ?>" class="item effect-oscar">
                <picture>
                    <!--<source media="(min-width: 1024px)" srcset="http://kw.local/wp-content/uploads/2020/03/Startseite-Links-scaled.jpg">
                    <source media="(min-width: 768px)" srcset="http://kw.local/wp-content/uploads/2020/04/Startseite-Links-1-scaled-e1587387216114.jpg">
                    <source media="(min-width: 320px)" srcset="http://kw.local/wp-content/uploads/2020/04/Startseite-Links-scaled-e1587049947145.jpg">-->
                    <img src="<?php echo $variable[0]['sizes']['large'] ?>">
                </picture>

                <figcaption>
                    <p><?php echo $kollektion->name ?></p>
                </figcaption>
            </a>
        <?php } ?>

    <?php wp_reset_postdata(); ?>

    -------------------------------------------------------------<br><br>



        <?php wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?>
