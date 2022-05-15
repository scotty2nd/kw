<?php
/*
	Template Name: Swipeable Text
*/
?>

<?php get_header(); ?>
<div class="swipaple-text-wrap" style="position: relative; cursor: pointer">
    <div class="swipe">
        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
        <style type="text/css">
            .st0{fill:none;stroke:#000000;stroke-width:0.7;stroke-miterlimit:10;}
        </style>
                <path class="st0" d="M43.8,49.1c0,0-10.2-14.3-24.2-24.2c14-9.8,24.2-24.2,24.2-24.2"/>
                <path class="st0" d="M29.7,49.1c0,0-10.2-14.3-24.2-24.2c14-9.8,24.2-24.2,24.2-24.2"/>
        </svg>
    </div>

    <div class="swipeable-text">
        <?php
        echo get_field('swipeable_text');
        ?>
    </div>
</div>

<?php get_footer(); ?>
