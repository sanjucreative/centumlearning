<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$template_banner_image = get_theme_file_uri('/assets/images/job-details_bg.jpg');
?>
<div class="TemplateBanner temp_job_list" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
			<h1 class="col-12 col-lg-9 text-center"><?php the_title();?></h1>
			<div class="col-12">
				<div class="row pt-5">
					<div class="col-12 col-sm-6 col-md-4 col-lg">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_location.png'); ?>" alt="icon" /></figure>
						<h5>Location</h5>
						<?php
							$locations_list = get_the_terms( $post->ID, 'locations' );
							array_list_item($locations_list);
						?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_positions.png'); ?>" alt="icon" /></figure>
						<h5>Positions</h5>
						<?php echo  get_field('job_positions');?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_job_type.png'); ?>" alt="icon" /></figure>
						<h5>Job Type</h5>
						<?php echo  get_field('job_type');?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_salary.png'); ?>" alt="icon" /></figure>
						<h5>Salary</h5>
						<?php echo  get_field('job_salary');?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_opening.png'); ?>" alt="icon" /></figure>
						<h5>Opening Till</h5>
						<?php echo  get_field('job_opening_closed'); ?>
						</div>
					</div>

					<div class="col-12 mt-5 text-center"><a class="btn btn-primary px-4 py-2" href="<?php echo get_home_url();?>/job-list">View All Opportunities</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="animation_wrap">
	<div class="container pt-4">
		<?php
			if( have_rows('job_description') ): 
			foreach ( get_field("job_description") as $item  ) {
		?>
			<div class="row my-4" data-aos="fade-up" data-aos-delay="50">
					<div class="col-12 col-md-2"><h4><?php echo  $item['heading']; ?></h4></div>
					<div class="col-12 col-md-10 pb-3"><?php echo  $item['job_details_description']; ?></div>
					<hr class="col-12"/>
			</div>
		<?php 
		}
		endif;
		?>

			<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
					<div class="col-12 col-xl-9"><?php echo get_field('job_apply_notes'); ?></div>
					<div class="col-12 col-xl-9 job_from_wrap"><?php echo do_shortcode(get_field('job_form')); ?></div>
			</div>


	</div>
	<?php include('polygonizr-animation-left.php'); ?>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>