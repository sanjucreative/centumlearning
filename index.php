<?php 
/* Template Name: Home */
get_header(); 
$pageid =  get_page_id('home');
?>


<!-- #############################   About Us Section    ###########################  -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="animation_wrap">
    <div class="container">
        <div class="about_us" data-aos="fade-up" data-aos-delay="100">
            <h3><?php echo get_field("heading_first");?></h3>
            <h4><?php echo get_field("heading_second");?></h4>
            <p><?php echo get_field("content_excerpt");?></p>        
            <div class="more_content"><p><?php echo get_field("content_excerpt_read_more");?></p></div>
            <a class="readmore" href="#">Read More <i></i></a>
        </div>
        <div class="carousel" data-aos="fade-up" data-aos-delay="100">
            <div class="slides"> 
            <?php
                if( have_rows('video_gallery') ): 
                foreach ( get_field("video_gallery") as $item ) {
                        echo '<div class="slideItem">';
                        echo '<figure><div class="video_play" data-url="'. $item['video_url'] .'"></div><img src="'. $item['video_cover_image'] .'"/></figure>';
                        echo '<div><p>"'. $item['video_title'] .'"</p>';
                        echo '<h5>'. $item['video_author'] .'</h5>';
                        echo '<h6>'. $item['video_author_designation'] .'</h6>';
                        echo '</div></div>';
                }
                endif;
            ?>
            </div>
        </div>

        <div class="left_aninamtion polygonizr"></div>
        <div class="right_aninamtion polygonizr"></div>
</div>
<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/polygonizr/polygonizr.min.js')?>"></script>
<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/carousel/scripts/jquery.mousewheel.min.js')?>"></script>
<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/carousel/scripts/carousel.min.js')?>"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo get_theme_file_uri( '/assets/plugins/carousel/style/carousel.css')?>" />

<script>
jQuery(document).ready(function($){
    $('.carousel').carousel({
        carouselWidth:900,
        carouselHeight:280,
        directionNav:true,
        // reflection: true,
        // shadow:true,
        // buttonNav:'bullets',
        frontWidth:320,
        frontHeight: 180,
        hMargin: 1.1,
        vMargin: 0.2,
        autoplayInterval: 10000,
    });
    let $sitelading = $('.polygonizr');
    $sitelading.polygonizr({
            canvasWidth: '250',
            canvasHeight: $('.polygonizr').height(),
            // duration: 10,
            // nodeMovementDistance: 10,
            // numberOfNodes: 1,
            // numberOfUnconnectedNode: 25,
            nodeDotColor:"10, 10, 10",
            nodeLineColor:"5, 5, 5",
            nodeFillColor:"5, 5, 5",
    });

});
</script>




</div>
<div class="video_modal">
    <div class="closed"></div>
    <div class="modal_container">
        <div class="videoWrapper">
                <iframe id="iframe_video" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen"></iframe>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>