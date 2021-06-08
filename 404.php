<?php get_header(); ?>
<div class="TemplateBanner temp_404" style="background-image: url(<?php echo get_theme_file_uri('/assets/images/404-bg.jpg'); ?>)">
	<div class="container banner_content">
		<div class="row">
			<div class="col-12 aos-init aos-animate text-center" data-aos="fade-up" data-aos-delay="50">
				<h1 class="text-center">Oops!</h1>
				<p class="h3">We can’t find the page you are looking for.</p>
				<div class="found_404"><img src="<?php echo get_theme_file_uri('/assets/images/404.png'); ?>" alt="Centumlerning" /></div>
				<div class="text-center my-4"><a class="btn btn-primary" href="<?php echo get_home_url();?>">Go to Home Page</a></div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>