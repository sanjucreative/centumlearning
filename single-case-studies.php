<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$template_banner_content = get_field('template_banner_content');
$page_video_cover_image = get_field('page_video_cover_image');
$page_video_url = get_field('page_video_url');
$page_url = get_field('page_url');
$check_for_page_url = get_field('check_for_page_url');
if($template_banner_image ==''){
	$template_banner_image = get_theme_file_uri('/assets/images/case-studies-bg.jpg');
}
if($page_video_cover_image ==''){
	$page_video_cover_image = get_theme_file_uri('/assets/images/case-studies-cover.png');
}
?>
<div class="TemplateBanner temp_case_studies" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row">
			<div class="col-12 col-lg-7 pr-3 pr-md-5" data-aos="fade-up" data-aos-delay="50">
				<?php echo $template_banner_content ?>
				<p class="label">-A Case Study</p>
				
					<?php 
					/*
						echo '<ul class="scrollspy_location">';
						if(get_field('case_centum_challenge') !=''){
							echo '<li><a class="scrollspy text-uppercase" href="#challenge_location">'. get_field('case_centum_challenge_heading') .'</a></li>';
						}
						if(get_field('case_impact_content') !='' || get_field('case_centum_impact_list') !=''){ 
							echo '<li><a class="scrollspy text-uppercase" href="#impact_location">'. get_field('case_centum_impact_heading') .'</a></li>';
						}
						if(get_field('case_centum_approach_content') !='' || get_field('case_centum_impact_list') !=''){
							echo '<li><a class="scrollspy text-uppercase" href="#centum_5d_location">'. get_field('case_centum_approach_heading') .'</a></li>';
						}
						echo '</ul>';
					*/
					?>					
				
			</div>
			<div class="col-12 col-lg-5" data-aos="fade-up" data-aos-delay="50">
				<div class="video_cont">
					<figure>
						<?php if($page_video_url !='' && $check_for_page_url[0] != 'Yes'){ 
							echo '<div class="video_play" data-url="'. $page_video_url.'"></div>';
						}
						if($check_for_page_url[0] == 'Yes'){
							echo '<a class="page_url" href="'. $page_url.'"></a>';
						}
						?>
						<img src="<?php echo $page_video_cover_image; ?>">
					</figure>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="animation_wrap">
<div class="container">
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50" id="challenge_location">
		<?php if(get_field('case_centum_challenge') !=''){
			echo '<h2 class="col-12 col-xl-10 text-center">'. get_field('case_centum_challenge_heading') .'</h2>';
			echo '<div class="col-12 col-xl-10 text-center mb-5">' . get_field('case_centum_challenge') . '</div>';

		}?>
	</div>
</div>

<?php if(get_field('case_impact_content') !='' || get_field('case_centum_impact_list') !=''){ 
		$impact_bg = get_field('case_section_impact_bg');
	?>
<div class="centum_impact_section" <?php if($impact_bg !=''){echo 'style=background-image:url("'.$impact_bg.'")';} ?> id="impact_location">
	<div class="container">
		<div class="row justify-content-center pt-5 pb-4" data-aos="fade-up" data-aos-delay="50">
				<h2 class="col-12 col-xl-10 text-center"><?php echo get_field('case_centum_impact_heading'); ?></h2>
				<div class="col-12 col-xl-10 text-center mb-5"><?php echo get_field('case_impact_content'); ?></div>
				<div class="col-12 col-xl-10">
					<div class="row justify-content-center ~~row-cols-4">
						<?php
							if( have_rows('case_centum_impact_list') ): 
							foreach ( get_field("case_centum_impact_list") as $i  => $item  ) {
								echo '<div class="col-12 col-md text-center p-4 mb-4"><div class="box_wrap">';
								echo '<figure><img src="'. $item['centum_impact_list_icon'] .'" alt="icon" /></figure>' . $item['centum_impact_list_content'] . '</div></div>';
							}
						endif;
						?>
					</div>
				</div>
		</div>
	</div>
</div>
<?php } ?>

<?php if(get_field('case_centum_approach_content') !='' || get_field('case_centum_impact_list') !=''){ 
	$numrows = count(get_field('case_centum_approach_item' ));
	?>
<div class="container">
	<div class="row justify-content-center pt-5 pb-4" data-aos="fade-up" data-aos-delay="50" id="centum_5d_location">
			<h2 class="col-12 col-xl-10 text-center"><?php echo get_field('case_centum_approach_heading');?></h2>
			<div class="col-12 col-xl-10 text-center mb-5"><?php echo get_field('case_centum_approach_content'); ?></div>
			<div class="col-12 col-xl-10">
				<div class="row justify-content-center approch_list">
					<?php
						if( have_rows('case_centum_approach_item') ): 
						foreach ( get_field("case_centum_approach_item") as $i  => $item  ) {
							echo '<div class="col-12 py-3"><div class="heading"><figure><img src="'. $item['case_centum_approach_icon'] .'" alt="icon" /></figure><h4>' . $item['case_centum_approach_heading'] .'</h4></div>';
							echo '<div class="wrapper">'. $item['case_centum_approach_content'] . '</div></div>';
						}
					endif;
					?>
				</div>
			</div>
	</div>
</div>
<?php } ?>

<?php include('polygonizr-animation-left.php'); ?>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>