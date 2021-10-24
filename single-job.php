<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$template_banner_image = get_theme_file_uri('/assets/images/job-details_bg.jpg');
	$show_page_banner = get_field('show_page_banner');
/*
<div class="TemplateBanner temp_job_list" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
			<h1 class="col-12 col-lg-9 text-center"><?php the_title();?></h1>
			<div class="col-12">
				<div class="row pt-5">
					<div class="col-12 col-sm-6 col-md-4 col-lg mb-5">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_location.png'); ?>" alt="icon" /></figure>
						<h5>Location</h5>
						<?php
							$locations_list = get_the_terms( $post->ID, 'locations' );
							array_list_item($locations_list);
						?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg mb-5">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_positions.png'); ?>" alt="icon" /></figure>
						<h5>Position(s)</h5>
						<?php echo  get_field('job_positions');?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg mb-5">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_job_type.png'); ?>" alt="icon" /></figure>
						<h5>Job Type</h5>
						<?php echo  get_field('job_type');?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg mb-5">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_salary.png'); ?>" alt="icon" /></figure>
						<h5>Salary</h5>
						<?php echo  get_field('job_salary');?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg mb-5">
						<div class="job_wrap">
						<figure><img src="<?php echo get_theme_file_uri('/assets/images/icon_opening.png'); ?>" alt="icon" /></figure>
						<h5>Last day of application</h5>
						<?php echo  get_field('job_opening_closed'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a class="nextFold scrollspy" href="#nextFold"></a>
</div>
*/
?>

<div class="no_page_banner"></div>
<div class="animation_wrap">
	<div class="container pt-4" id="nextFold">
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
		<div class="col-12 col-md-2"><h3 class="pt-2">Job Position</h3></div>
		<div class="col-12 col-md-10"><h1><?php the_title();?></h1></div>
			<div class="col-12">
				<div class="row py-3">
					<div class="col-12 col-sm-6 col-md-3 col-lg job_position_itenery">
						<h5>Location</h5>
						<?php
							$locations_list = get_the_terms( $post->ID, 'locations' );
							array_list_item($locations_list);
						?>
					</div>
					<div class="col-12 col-sm-6 col-md-3 col-lg job_position_itenery">
						<h5>Position(s)</h5>
						<?php echo  get_field('job_positions');?>
					</div>
					<div class="col-12 col-sm-6 col-md-3 col-lg job_position_itenery">
						<h5>Job Type</h5>
						<?php echo  get_field('job_type');?>
					</div>
					<div class="col-12 col-sm-6 col-md-3 col-lg job_position_itenery">
						<h5>Salary</h5>
						<?php echo  get_field('job_salary');?>
					</div>
				</div>
			</div>
		</div>

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
					<div class="col-12 col-xl-9 job_from_wrap centum-form"><?php echo do_shortcode(get_field('job_form')); ?></div>
			</div>


	</div>
	<?php include('polygonizr-animation-left.php'); ?>
</div>

<?php endwhile; endif; ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
		$("header").addClass("no_banner");
  });  
</script>
<?php get_footer(); ?>