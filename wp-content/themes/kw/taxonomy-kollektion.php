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

<body <?php body_class($kw_classes); ?>>
<div class="page-wrap">
    <header class="header">
        <div class="menu-wrap">
            <div class="flex-wrap">
                <div class="burger-icon js-burger-icon">
                    <div class="stripe one"></div>
                    <div class="stripe two"></div>
                    <div class="stripe three"></div>
                </div>

                <span class="title">
                            <a href="/">Kristina Wirsching</a>
                        </span>
            </div>

            <div class="menu-outline">
                <?php
                wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'js-menu menu navbar-nav'
                    )
                );
                ?>
            </div>
        </div>

        <span class="collection-name">
        <?php
            $collection = get_term_by('slug', $taxonomySlug, 'kollektion');
            $collectionYear = get_field('collection_year', $collection);

            echo $collection->name . ' (' . $collectionYear . ')';
        ?>
    </span>

    </header>

<div class="collection-slider-wrap">

    <?php wp_reset_postdata(); ?>

    <div class="collection-slider js-collection-slider">
        <?php $index = 0; ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post();
            $collections  = get_the_terms( $post->ID, 'kollektion' );

            if($collections) :
                foreach ( $collections as $collection ) : ?>
                    <?php
                        $productImagesDesktop = get_field('product_images_desktop');
                        $productImagesTablet = get_field('product_images_tablet');
                        $productImagesMobile = get_field('product_images_mobile');
                        $productDescription = get_field('product_description');
                    ?>

                    <?php if($collection->slug === $taxonomySlug) : ?>
                        <div>
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
                                <a href="#gallery<?php echo $index; ?>" class="product-gallery js-product-gallery">
                                    Gallerie (<?php if( $productImagesDesktop ):  echo count($productImagesDesktop); endif; ?>),
                                </a>
                                <a href="#information<?php echo $index; ?>" class="product-information js-product-information">
                                    Informationen
                                </a>
                            </div>

                            <div id="gallery<?php echo $index; ?>" class="js-product-information-gallery mfp-hide">
                                <?php if( $productImagesDesktop ): ?>
                                    <?php $count = 1; ?>
                                    <?php foreach ( $productImagesDesktop as $productDesktopImage ) : ?>
                                        <div class="slide">
                                            <picture>
                                                <source media="(min-width: 1024px)" srcset="<?php if ( isset ( $productDesktopImage ) ){echo $productDesktopImage['sizes']['large'];} ?>">
                                                <source media="(min-width: 768px)" srcset="<?php if ( isset ( $productImagesTablet ) ){echo $productImagesTablet['sizes']['large'];} ?>">
                                                <source media="(min-width: 320px)" srcset="<?php if ( isset ( $productImagesMobile ) ){echo $productImagesMobile['sizes']['large'];} ?>">
                                                <img src="<?php if ( isset ( $productDesktopImage ) ){echo $productDesktopImage['sizes']['large'];} ?>">
                                            </picture>
                                            <p class="img-caption">
                                                <?php echo $productDesktopImage['caption']; ?>
                                                <span class="counter">
                                                    <?php if ( isset ( $productImagesDesktop ) ){echo $count . '/' . count($productImagesDesktop);} ?>
                                                </span>
                                            </p>
                                        </div>
                                        <?php $count++; ?>
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
</div>


<?php get_footer(); ?>