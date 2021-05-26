<?php 
/* Template Name: How We work */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="animation_wrap">
	<div class="container">
		<div class="row justify-content-center pt-5 pb-3" data-aos="fade-up" data-aos-delay="50">	
			<article class="col-12 col-md-10"><?php the_content(); ?></article>
		</div>

		<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
			<h2 class="col-12 text-center"><?php echo get_field('hww_approach_heading');?></h2>
			<div class="col-12 col-md-9">
				<div class="row">
					<div class="col-12 col-md-6"><figure><img class="img-fluid" src="<?php echo get_field('hww_approach_image');?>" alt="" /></figure></div>
					<div class="col-12 col-md-6 align-self-center"><?php echo get_field('hww_approach_content');?></div>
				</div>
			</div>
		</div>
	</div>

	<?php include('polygonizr-animation-left.php'); ?>
</div>
<div class="animation_wrap">
<div class="container">
	<div class="row justify-content-center my-5" data-aos="fade-up" data-aos-delay="50">	
		<?php
			if( have_rows('hww_approach_infograph') ): 
			foreach ( get_field("hww_approach_infograph") as $item  ) {
				echo '<div class="col-12 col-md-auto my-3"><div class="approach_wrap">';
				echo '<figure><img class="img-fluid" src="'. $item['approach_infograph_image'] .'" alt="'. $item['approach_infograph_heading'] .'" /></figure>';
				echo '<h4>'. $item['approach_infograph_heading'] .'</h4>';
				echo '<p>'. $item['approach_infograph_excerpt'] . '</p>';
				echo '</div></div>';
				}
			endif;
		?>
	</div>
</div>
<?php include('polygonizr-animation-right.php'); ?>
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
<?php get_footer(); ?>