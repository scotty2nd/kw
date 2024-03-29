jQuery( document ).ready(function(){
    /**
     * Hauptmenu
     */

    var menuContainer = jQuery( '.js-menu' ),
        menuOverlayContainer = jQuery( '.js-menu-overlay' ),
        burgerIcon = jQuery( '.js-burger-icon' );


    jQuery( '.menu-wrap .title' ).mouseenter(function(event) {
        event.stopPropagation();
        menuContainer.toggleClass( 'open' );
        menuOverlayContainer.removeClass( 'hide' );
    });

    menuContainer.mouseleave(function(event) {
        event.stopPropagation();
        menuContainer.toggleClass( 'open' );
        menuOverlayContainer.addClass( 'hide' );
    });

    jQuery( '.js-menu-overlay' ).on('click', function (event) {
        event.stopPropagation();
        menuContainer.toggleClass( 'open' );
        menuOverlayContainer.addClass( 'hide' );
        burgerIcon.toggleClass( 'change' );
    });


    /**
     * Burger Menu Animation
     */

    jQuery( '.js-burger-icon' ).on('click', function (event) {
        // Icon Animation
        jQuery( this ).toggleClass( 'change' );


        // Open Menu
        menuContainer.toggleClass( 'open' );
    });

    /**
     * Collection Slider on Home
     */

    var collectionSliderNew = jQuery( '.js-collection-slider-new' );

    if(window.innerWidth <= 1023) {
        console.log('asdsadsad');
        jQuery( '.js-collection-slider-new' ).on('init reInit afterChange', function(event, slick, currentSlide){
            //currentSlide is undefined on init
            var currentSlide = (currentSlide ? currentSlide : 0) + 1,
                currentTitle = collectionSliderNew.find( '.slick-current figcaption p' ).text();

            jQuery( '.slick-dots' ).html( '<li><span class="title">' + currentTitle + '</span> (' + currentSlide + '/' + slick.slideCount + ')</li>');
        });
    }

    collectionSliderNew.slick({
        mobileFirst: true,
        arrows: true,
        nextArrow: '<i class="slick-arrow slick-next"></i>',
        prevArrow: '<i class="slick-arrow slick-prev"></i>',
        dots: true,
        infinite: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
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