<?php
/*
	Template Name: Nur Text
*/
?>

<?php get_header(); ?>

<div class="wp-block-column">
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

</div>

<?php get_footer(); ?>
