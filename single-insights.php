<?php
/*
 Template Name: Insights
 Template Name Posts: Insights 
 Template Post Type: post
 */
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$show_page_banner = get_field('show_page_banner');
?>
<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
<?php if($show_page_banner[0] != 'Yes') echo '<div class="no_page_banner"></div>'; ?>
<div class="animation_wrap">
<div class="container">
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50" id="nextFold">
		<div class="col-12 col-md-10 pt-3 pt-md-5 pb-5">			
			<?php $featured_image_display = get_field('show_featured_image_in_post');
					if($featured_image_display[0] == 'Yes'):
						if( has_post_thumbnail() ) { ?>
							<figure class="post-featured-image"><?php the_post_thumbnail(); ?></figure>
						<?php }
					endif;
			?>
			<article><?php the_content();?></article>
		</div>
	</div>


</div>
<?php include('polygonizr-animation.php'); ?>
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