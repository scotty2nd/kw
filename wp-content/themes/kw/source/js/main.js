jQuery( document ).ready(function(){
    /**
     * Menu
     */

    var menuContainer = jQuery( '.js-menu' );

    jQuery( '.menu-wrap .title' ).on('click', function (event) {
        menuContainer.toggleClass( 'open' );
    });

    menuContainer.mouseleave(function(event) {
        event.stopPropagation();
        menuContainer.toggleClass( 'open' );
    });

    /**
     * Burger Menu Animation
     */

    jQuery( '.js-burger-icon ' ).on('click', function (event) {
        // Icon Animation
        jQuery( this ).toggleClass( 'change' );

        // Open Menu
        menuContainer.toggleClass( 'open' );
    });

    /**
     * Welcome Tiles
     */
    var welcomeTiles = jQuery( '.js-welcome-tiles' );

    welcomeTiles.on('init reInit afterChange', function(event, slick, currentSlide){
        //currentSlide is undefined on init
        var currentSlide = (currentSlide ? currentSlide : 0) + 1,
            currentTitle = welcomeTiles.find( '.slick-current figcaption p' ).text();

        jQuery( '.slick-dots' ).html( '<li><span class="title">' + currentTitle + '</span> (' + currentSlide + '/' + slick.slideCount + ')</li>');
    });

    welcomeTiles.slick({
        mobileFirst: true,
        arrows: true,
        nextArrow: '<i class="slick-arrow slick-next"></i>',
        prevArrow: '<i class="slick-arrow slick-prev"></i>',
        dots: true,
        infinite: false,
        responsive: [
            {
                breakpoint: 1023,
                settings: "unslick"
            }
        ]
    });

    /**
     * Welcome Tiles
     */
    var tiles = jQuery( '.js-tiles' );

    tiles.on('init reInit afterChange', function(event, slick, currentSlide){
        //currentSlide is undefined on init
        var currentSlide = (currentSlide ? currentSlide : 0) + 1,
            currentTitle = tiles.find( '.slick-current figcaption p' ).text();

        jQuery( '.slick-dots' ).html( '<li><span class="title">' + currentTitle + '</span> (' + currentSlide + '/' + slick.slideCount + ')</li>');
    });

    tiles.slick({
        mobileFirst: true,
        arrows: true,
        nextArrow: '<i class="slick-arrow slick-next"></i>',
        prevArrow: '<i class="slick-arrow slick-prev"></i>',
        dots: true,
        infinite: false,
        responsive: [
            {
                breakpoint: 1023,
                settings: "unslick"
            }
        ]
    });

    /**
     * Kollektions Slider
     */
    jQuery( '.js-collection-slider' ).slick({
        mobileFirst: true,
        dots: false,
        infinite: false,
        nextArrow: '<i class="slick-arrow slick-next"></i>',
        prevArrow: '<i class="slick-arrow slick-prev"></i>'
    });

    jQuery( '.js-collection-slider' ).on('init reInit afterChange', function(event, slick){
        console.log(jQuery( '.slick-current .test123' ));
        jQuery( '.slick-current .open-popup-link' ).magnificPopup({
            type:'inline'
        });
    });

    /**
     * Produkt Slider in Modal
     */
    jQuery( '.js-product-gallery' ).click(function(event) {
        event.preventDefault();

        var items = [];

        jQuery( jQuery( this ).attr( 'href' ) ).find( '.slide' ).each(function() {
            items.push( {
                src: jQuery( this )
            } );
        });

        jQuery.magnificPopup.open({
            items:items,
            removalDelay: 300,
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true
            },
            callbacks: {
                beforeOpen: function() {
                    jQuery( '.slick-arrow' ).toggleClass( 'hide' );
                },
                open: function() {
                    jQuery( '.mfp-content' ).addClass( 'product-gallery-modal' );
                },
                beforeClose: function() {
                    jQuery( '.slick-arrow' ).toggleClass( 'hide' );
                }
            }
        });
    });
    /**
     * Produkt Informationen Klick
     */
    jQuery('.js-product-information').magnificPopup({
        type:'inline',
        removalDelay: 300,
        mainClass: 'mfp-fade',
        callbacks: {
            open: function() {
                jQuery( '.mfp-content' ).addClass( 'information-text-modal' );
            }
        }
    });
});