<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('location_banner_image');
$location_address = get_field('location_address');
$location_banner_heading = get_field('location_banner_heading');

if($template_banner_image ==''){
	$template_banner_image = get_theme_file_uri('/assets/images/contact_us_bg.jpg');
}
if($location_banner_heading ==''){
	$location_banner_heading = 'Corporate Training Services in ' . get_the_title();
}
?>
<div class="TemplateBanner temp_contact_us" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row">
			<div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
				<h1><?php echo $location_banner_heading; ?></h1>
				<?php echo wpautop($location_address); ?>
				<ul class="scrollspy_location">
						<li><a class="scrollspy" href="#our_services_location"><img src="<?php echo get_theme_file_uri('/assets/images/our-services.png'); ?>" alt="icon" /> <span>Our Services</span></a></li>
				<ul>
			</div>
			<div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
				<div class="map_wrap"><?php echo get_field('location_map'); ?></div>

			</div>
		</div>
	</div>
</div>


<div class="animation_wrap">
<div class="container">
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50" id="our_services_location">
		<h2 class="text-center">Our Services in <?php echo get_the_title(); ?></h2>
		<div class="col-12 col-lg-10 pt-5 pb-3">
			<div class="row">
					<?php
						if( have_rows('our_services') ): 
							foreach ( get_field("our_services") as $i => $item  ) {	

								echo '<div class="col-12 col-md-2 col-lg-4 mb-5"><div class="location_our_services">';
								if($item["location_services_page_url"] !=''){
									echo '<a href="'.$item["location_services_page_url"].'"></a>';
								}
								echo '<figure><img src="'. $item["location_services_icon"].'" alt="'.$item["location_services_heading"].'" /></figure>';
								echo '<h4>'. $item["location_services_heading"].'</h4>';
								echo '</div></div>';
							}
						endif; 
					?>
				</div>
			</div>
	</div>

	</div>
	<?php include('polygonizr-animation.php'); ?>
</div>


<?php endwhile; endif; ?>
<?php get_footer(); ?>