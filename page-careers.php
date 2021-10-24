<?php 
/* Template Name: Careers */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="animation_wrap">
	<div class="section_content" data-aos="fade-up" data-aos-delay="50">	
		<div class="container">
			<div class="row justify-content-center"  id="nextFold">
				<article class="col-12"><?php the_content(); ?></article>
			</div>
		</div>
	</div>

	<div class="section_content" data-aos="fade-up" data-aos-delay="50">
		<div class="container">
			<div class="row justify-content-center">
			<h2 class="col-12 text-center section-heading"><?php echo get_field('careers_gallery_heading');?></h2>
				<?php
					if( have_rows('careers_gallery_images') ): 
					foreach ( get_field("careers_gallery_images") as $item  ) {
						$title = $item['careers_add_image']['title'];
						$thumbnail = $item['careers_add_image']['sizes']['thumbnail'];
						$url = $item['careers_add_image']['url'];
						echo '<div class="col-12 col-sm-6 col-md-3 mb-3"><figure>';
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
				<h2 class="col-12 text-center section-heading"><?php echo get_field('careers_infographic_heading');?></h2>
				<div class="careers_infographic_bg" style="background-image:url('<?php echo get_field('careers_infographic_image');?>');">
					<?php if(get_field('show_apply_now_button')[0] == 'Yes'){
							$url = get_permalink( get_page_by_path('job-list'));
							echo '<a class="btn btn-primary" href="'. $url.'">Apply Now</a>';
					 } ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php include('polygonizr-animation.php'); ?>
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
	<?php if(get_field('show_apply_now_button')[0] == 'Yes'){
			$url = get_permalink( get_page_by_path('job-list'));
		?>
		$('<a class="btn btn-primary" href="<?php echo $url;?>">Apply Now</a>').appendTo(".banner_content .banner_left");
	<?php }?>
			$(".fancybox").fancybox({
				showNavArrows: true,
			});
  });  

</script>
<?php get_footer(); ?>