<?php 
/* Template Name: Careers */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="animation_wrap">
	<div class="section_content" data-aos="fade-up" data-aos-delay="50">	
		<div class="container">
			<div class="row justify-content-center">
				<article class="col-12"><?php the_content(); ?></article>
			</div>
		</div>
	</div>

	<div class="section_content" data-aos="fade-up" data-aos-delay="50">
		<div class="container">
			<div class="row justify-content-center">
			<h2 class="col-12 text-center"><?php echo get_field('careers_gallery_heading');?></h2>
				<?php
					if( have_rows('careers_gallery_images') ): 
					foreach ( get_field("careers_gallery_images") as $item  ) {
						$title = $item['careers_add_image']['title'];
						$thumbnail = $item['careers_add_image']['sizes']['thumbnail'];
						$url = $item['careers_add_image']['url'];
						echo '<div class="col-6 col-md-3 mb-3"><figure>';
						echo '<a class="fancybox" data-fancybox="images"  href="'. $url .'"><img class="img-fluid" src="'.  $url .'" alt="'. $title .'" /></a>';
						echo '</figure></div>';
						}
					endif;
				?>
			</div>
		</div>
	</div>


	<div class="section_content" data-aos="fade-up" data-aos-delay="50">
		<div class="container">
			<div class="row" data-aos="fade-up" data-aos-delay="50">
				<h2 class="col-12 text-center"><?php echo get_field('careers_infographic_heading');?></h2>
				<div class="careers_infographic_bg" style="background-image:url('<?php echo get_field('careers_infographic_image');?>');">
						<a class="btn btn-primary" href="<?php echo get_field('careers_apply_now_url');?>" target="_blank">Apply Now</a>
				</div>
			</div>
		</div>
	</div>
	
	<?php include('polygonizr-animation-left.php'); ?>
</div>
<?php endwhile; endif; ?>
<div class="video_modal">
    <div class="closed"></div>
    <div class="modal_container">
        <div class="videoWrapper">
                <iframe id="iframe_video" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen"></iframe>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.js')?>"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.css')?>" />
<script type="text/javascript">
  jQuery(document).ready(function($) {
		$('<a class="btn btn-primary" href="<?php echo get_field('careers_apply_now_url');?>" target="_blank">Apply Now</a>').appendTo(".banner_content .banner_left");

			$(".fancybox").fancybox({
				showNavArrows: true,
			});
  });  

</script>
<?php get_footer(); ?>