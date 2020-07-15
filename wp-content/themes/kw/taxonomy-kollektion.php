<?php get_header(); ?>

<?php
    $taxonomySlug = get_query_var( 'kollektion' );

    $the_query = new WP_Query( array(
        'post_type' => 'produkte',
        'posts_per_page' => '-1',
        'tax_query' => array(
            array (
                'taxonomy' => 'kollektion',
                'field' => 'slug',
                'terms' => $taxonomySlug,
            )
        )
    ) );
?>

<div class="collection-slider js-collection-slider">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
        $kollektions  = get_the_terms( $post->ID, 'kollektion' );

        if($kollektions) :
            foreach ( $kollektions as $kollektion ) : ?>
                <?php
                    $collectionYear = get_field('collection_year', $kollektion);
                    $productImagesDesktop = get_field('product_images_desktop');
                    $productImagesTablet = get_field('product_images_tablet');
                    $productImagesMobile = get_field('product_images_mobile');
                    $productDescription = get_field('product_description');
                ?>

                   <?php if($kollektion->slug === $taxonomySlug) : ?>
                        <div>
                            <span class="collection-name">
                                <?php echo $kollektion->name . ' (' . $collectionYear . ')'; ?>
                            </span>

                            <picture>
                                <source media="(min-width: 1024px)" srcset="<?php echo $productImagesDesktop[0]['sizes']['large']; ?>">
                                <source media="(min-width: 768px)" srcset="<?php echo $productImagesTablet[0]['sizes']['large']; ?>">
                                <source media="(min-width: 320px)" srcset="<?php echo $productImagesMobile[0]['sizes']['large']; ?>">
                                <img class="img-item" src="<?php echo $productImagesDesktop[0]['sizes']['large']; ?>">
                            </picture>

                            <span class="product-title">
                                <?php echo the_title(); ?>
                            </span>

                            <div class="product-information">
                                <p class="img-caption"><?php echo $productImagesDesktop[0]['Caption']; ?></p>
                            </div>

                            <div class="product-information">
                                <a href="#gallery<?php echo $index; ?>" class="product-gallery js-product-gallery">
                                    Gallerie (<?php if( $productImagesDesktop ):  echo count($productImagesDesktop); endif; ?>),
                                </a>
                                <a href="#information<?php echo $index; ?>" class="product-information js-product-information">
                                    Informationen
                                </a>
                            </div>

                            <div id="gallery<?php echo $index; ?>" class="js-product-information-gallery mfp-hide">
                                <?php if( $productImagesDesktop ): ?>
                                    <?php foreach ( $productImagesDesktop as $productDesktopImage ) : ?>
                                        <div class="slide">
                                            <picture>
                                                <source media="(min-width: 1024px)" srcset="<?php echo $productDesktopImage['sizes']['large']; ?>">
                                                <source media="(min-width: 768px)" srcset="<?php echo $productImagesTablet['sizes']['large'] ?>">
                                                <source media="(min-width: 320px)" srcset="<?php echo $productImagesMobile['sizes']['large'] ?>">
                                                <img src="<?php echo $productDesktopImage['sizes']['large'] ?>">
                                            </picture>
                                            <p class="img-caption"><?php echo $productImagesDesktop['Caption']; ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div id="information<?php echo $index; ?>" class="product-information-text mfp-hide">
                                <div class="content">
                                    <?php echo $productDescription; ?>
                                </div>
                            </div>
                        </div>
                        <?php $index++; ?>
                    <?php break; ?>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>