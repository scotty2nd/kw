<?php get_header(); ?>

    <?php
    /*
    *
    * Post Loop für den eigentlichen Seiten Inhalt
    *
    */

    if ( have_posts() ):

        while ( have_posts() ) : the_post();

            the_content();

        endwhile;

    endif;
    ?>

<?php get_footer(); ?>