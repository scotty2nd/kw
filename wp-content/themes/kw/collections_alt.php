<?php
/*
	Template Name: Kollektionen alt
*/
?>

<?php get_header(); ?>


    <?php
        $the_query = new WP_Query( array(
            'post_type' => 'produkte',
            'posts_per_page' => '-1'
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
                            <a href="#gallery<?php echo $index; ?>" class="show-product-gallery js-product-gallery effect-oscar">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 416 416" xml:space="preserve"> <g> <g> <path d="M240,0v32h89.6c14.573,0.036,28.964-3.247,42.08-9.6l1.92-0.96l-352,352v-0.96c6.653-13.099,10.211-27.55,10.4-42.24V240 H0v176h176v-32H85.76c-14.159-0.018-28.146,3.097-40.96,9.12l-1.76,0.8l352-352v1.6C388.069,56.758,384.288,71.442,384,86.4V176 h32V0H240z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                <picture>
                                    <source media="(min-width: 1024px)" srcset="<?php echo $productImagesDesktop[0]['sizes']['large']; ?>">
                                    <source media="(min-width: 768px)" srcset="<?php echo $productImagesTablet[0]['sizes']['large']; ?>">
                                    <source media="(min-width: 320px)" srcset="<?php echo $productImagesMobile[0]['sizes']['large']; ?>">
                                    <img class="img-item" src="<?php echo $productImagesDesktop[0]['sizes']['large']; ?>" title="<?php echo the_title(); ?>">
                                </picture>
                            </a>
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
