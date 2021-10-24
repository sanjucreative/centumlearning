<?php 
/* Template Name: Home */
get_header(); 
$pageid =  get_page_id('home');
?>


<!-- #############################   About Us Section    ###########################  -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="animation_wrap" id="about_us">
    <div class="container" id="nextFold">
        <div class="about_us" data-aos="fade-up" data-aos-delay="100">
            <h3><?php echo get_field("heading_first");?></h3>
            <h4><?php echo get_field("heading_second");?></h4>
            <p><?php echo get_field("content_excerpt");?></p>        
            <div class="more_content"><p><?php echo get_field("content_excerpt_read_more");?></p></div>
            <a class="readmore" href="#">View More</a>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <h2 class="col-12 text-center section-heading mt-4">Our Business Areas</h2>
            <div class="col-12 mb-5" id="home_our_business">
            <?php
                if( have_rows('our_business_areas_items') ): 
                foreach ( get_field("our_business_areas_items") as $item ) {
                        echo '<div class="slideItem">';
                        echo '<figure><a href="'. $item['our_business_area_url'].'"><span>'. $item['our_business_area_heading'].'</span></a><img src="'. $item['our_business_area_featured_image'] .'"/></figure>';
                        echo '</div>';
                }
                endif;
            ?>
            </div>
        </div>

        


        <?php include('polygonizr-animation.php'); ?>
</div>
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