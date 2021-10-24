<?php 
/* Template Name: Africa */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$template_banner_content = get_field('template_banner_content');
$page_video_cover_image = get_field('page_video_cover_image');
$page_video_url = get_field('page_video_url');
$page_url = get_field('page_url');
$check_for_page_url = get_field('check_for_page_url');
if($template_banner_image ==''){
	$template_banner_image = get_theme_file_uri('/assets/images/solutions_banner_bg.jpg');
}
$page_id = get_the_ID();
?>
<div class="TemplateBanner temp_CTS" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row">
			<div class="col-12 col-xl-6" data-aos="fade-up" data-aos-delay="50">
				<?php echo $template_banner_content ?>
			</div>
			<div class="col-12 col-xl-6" data-aos="fade-up" data-aos-delay="50">
					<?php echo solutionGridLayout($page_id);?>
			</div>
		</div>
	</div>
</div>
<div class="animation_wrap">
	<div class="container" data-aos="fade-up" data-aos-delay="50" id="open_job_opportunities">
		<div class="row justify-content-center" id="nextFold">
			<h2 class="col-12 text-center py-4 section-heading"><?php echo get_field('transforming_africa_heading');?></h2>
			<div class="col-12 col-md-5"><img class="img-fluid" src="<?php echo get_field('transforming_africa_map');?>" alt="Africa Map" /></div>
			<div class="col-12 col-md-7"><?php echo get_field('transforming_africa_content');?></div>
		</div>

		<div class="row justify-content-center mt-5">
			<h3 class="col-12 text-center py-4 section-heading"><?php echo get_field('africa_learning_solutions_heading');?></h3>
			<div class="col-12 africa_LS">
			<?php
	if( have_rows('africa_learning_solutions') ): 
	foreach ( get_field("africa_learning_solutions") as $i => $item  ) {
		echo '<div class="africa_LMS">';
		echo '<figure><img src="'.$item['africa_featured_image'].'" alt="' . $item['africa_learning_solutions_heading'] .'" /></figure>';
		echo '<div class="africa_LMS_content"><h4>' . $item['africa_learning_solutions_heading'] .'</h4>';
		echo  $item['africa_learning_solutions_content'] ;
		echo '</div></div>';
	}
	endif
?>
		</div>
		</div>


	</div>


	<div class="container">
		<?php include('client-speak.php'); ?>
		<div class="row  py-3" data-aos="fade-up" data-aos-delay="50">
			<h3 class="col-12 text-center section-heading">Our Clients</h3>
			<div class="col-12 text-center"><?php echo get_field('africa_our_client');?></div>
		</div>

		<?php include('trustedby-africa.php'); ?>

		<div class="row py-4" data-aos="fade-up" data-aos-delay="50">
			<h3 class="col-12 text-center section-heading mt-4 mb-5">Impacting Lives</h3>
			<div class="col-12 impacting_lives">
			<?php
				if( have_rows('africa_impacting_lives') ): 
				foreach ( get_field("africa_impacting_lives") as $i => $item  ) {
					echo '<div class="impacting_item">';
					echo '<figure><img src="'. $item['africa_profile_picture'].'" alt=""/></figure>';
					echo '<div class="impacting_lives_wrap"><h4>Success Stories</h4>';
					echo $item['africa_testimonials_content'];
					echo '<div class="address">' . $item['name_and_address']. '</div>';
					echo '</div></div>';
				}
				endif
			?>
			</div>
		</div>

		

		<?php include('awards-africa.php'); ?>
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