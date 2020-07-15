<?php get_header(); ?>

<?php
    $taxonomyTerm = get_query_var( 'kollektion' );

    $the_query = new WP_Query( array(
        'post_type' => 'produkte',
        'posts_per_page' => '-1',
        'tax_query' => array(
            array (
                'taxonomy' => 'kollektion',
                'field' => 'slug',
                'terms' => $taxonomyTerm,
            )
        )
    ) );

    $index = 0;
?>

<div class="collection-slider js-collection-slider">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
        $terms  = get_the_terms( $post->ID, 'kollektion' );

        if($terms) :
            foreach ( $terms as $term ) : ?>
                <?php
                $collectionName = $term->name;
                $collectionYear = get_field('collection_year', $term);
                $productDescription = get_field('product_description');
                $productImagesDesktop = get_field('product_images_desktop');
                $productImagesTablet = get_field('product_images_tablet');
                $productImagesMobile = get_field('product_images_mobile');
                $allProductImages = array();

                for($i = 0; $i < count($productImagesDesktop); $i++) {
                    $allProductImages[$i]['Desktop'] = $productImagesDesktop[$i]['sizes']['large'];
                    $allProductImages[$i]['Tablet'] = $productImagesTablet[$i]['sizes']['large'];
                    $allProductImages[$i]['Mobile'] = $productImagesMobile[$i]['sizes']['large'];
                    $allProductImages[$i]['Caption'] = $productImagesDesktop[$i]['caption'];
                }
                ?>

                <div>
                        <span class="collection-name">
                            <?php echo $collectionName . ' (' . $collectionYear . ')'; ?>
                        </span>

                    <?php if( $productImagesDesktop): ?>
                        <picture>
                            <source media="(min-width: 1024px)" srcset="<?php echo $productImagesDesktop[0]['sizes']['large']; ?>">
                            <source media="(min-width: 768px)" srcset="<?php echo $productImagesTablet[0]['sizes']['large']; ?>">
                            <source media="(min-width: 320px)" srcset="<?php echo $productImagesMobile[0]['sizes']['large']; ?>">
                            <img class="img-item" src="<?php echo $productImagesDesktop[0]['sizes']['large']; ?>" title="<?php echo the_title(); ?>">
                        </picture>
                    <?php endif; ?>

                    <span class="product-title">
                            <?php echo the_title(); ?>
                        </span>

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
                            <?php for($x = 0; $x < count($allProductImages); $x++) : ?>
                                <div class="slide">
                                    <picture>
                                        <source media="(min-width: 1024px)" srcset="<?php echo $allProductImages[$x]['Desktop']; ?>">
                                        <source media="(min-width: 768px)" srcset="<?php echo $allProductImages[$x]['Tablet']; ?>">
                                        <source media="(min-width: 320px)" srcset="<?php echo $allProductImages[$x]['Mobile']; ?>">
                                        <img src="<?php echo $allProductImages[$x]['Desktop']; ?>">
                                    </picture>
                                    <p class="img-caption"><?php echo $allProductImages[$x]['Caption']; ?></p>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>

                    <div id="information<?php echo $index; ?>" class="product-information-text mfp-hide">
                        <div class="content">
                            <?php echo $productDescription; ?>
                        </div>
                    </div>
                </div>
                <?php $index++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>