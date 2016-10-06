<link href="<?php echo asset_url(); ?>css/nivo-slider.css" rel="stylesheet">
<link href="<?php echo asset_url(); ?>css/themes/default/default.css" rel="stylesheet">
<script src="<?php echo asset_url(); ?>js/jquery.nivo.slider.pack.js"></script>

<div class="slider-wrapper theme-default" style="margin-top: 65px;">
    <div id="slider" class="nivoSlider">

        <a href="#">
            <img src="<?php echo asset_url() . 'images/slider/'; ?>banner01.jpg" alt="" title="#caption1"  />
        </a>
        <a href="#">
            <img src="<?php echo asset_url() . 'images/slider/'; ?>banner02.jpg" alt="" title="#caption2"  />
        </a>
        <a href="#">
            <img src="<?php echo asset_url() . 'images/slider/'; ?>banner03.jpg" alt="" title="#caption3"  />
        </a>
        <a href="#">
            <img src="<?php echo asset_url() . 'images/slider/'; ?>banner04.jpg" alt="" title="#caption4"  />
        </a>
        <a href="#">
            <img src="<?php echo asset_url() . 'images/slider/'; ?>banner05.jpg" alt="" title="#caption5"  />
        </a>
    </div>

<!--    <div id="caption1" class="nivo-html-caption">-->
<!--        <p class="nivotitle"><span class="yekan">111</span></p>-->
<!--    </div>-->

    <div id="caption1" class="nivo-html-caption"></div>

    <div id="caption2" class="nivo-html-caption"></div>

    <div id="caption3" class="nivo-html-caption">
        <p class="nivotitle"><span class="yekan">دوازدهمین مراسم بزرگداشت پیوند اعضا(جشن نفس)</span></p>
    </div>

    <div id="caption4" class="nivo-html-caption">
        <p class="nivotitle"><span class="yekan">دوازدهمین مراسم بزرگداشت پیوند اعضا(جشن نفس)</span></p>
    </div>

    <div id="caption5" class="nivo-html-caption">
        <p class="nivotitle"><span class="yekan">دوازدهمین مراسم بزرگداشت پیوند اعضا(جشن نفس)</span></p>
    </div>

    <div class="main-wrapper app-wrapper">
        <div class="clearfix"></div>
    </div>
</div>
<!-- End Main Slider -->

<script>
    $(window).load(function() {
        "use strict";
        $('#slider').nivoSlider({
            effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
            slices: 15,                     // For slice animations
            boxCols: 8,                     // For box animations
            boxRows: 4,                     // For box animations
            animSpeed: 500,                 // Slide transition speed
            pauseTime: 4000,                 // How long each slide will show
            startSlide: 0,                     // Set starting Slide (0 index)
            directionNav: true,             // Next & Prev navigation
            controlNav: false,                 // 1,2,3... navigation
            controlNavThumbs: false,         // Use thumbnails for Control Nav
            pauseOnHover: true,             // Stop animation while hovering
            manualAdvance: false,             // Force manual transitions
            prevText: 'Prev',                 // Prev directionNav text
            nextText: 'Next',                 // Next directionNav text
            randomStart: false,             // Start on a random slide
            beforeChange: function(){},     // Triggers before a slide transition
            afterChange: function(){},         // Triggers after a slide transition
            slideshowEnd: function(){},     // Triggers after all slides have been shown
            lastSlide: function(){},         // Triggers when last slide is shown
            afterLoad: function(){}         // Triggers when slider has loaded
        });
    });
</script>