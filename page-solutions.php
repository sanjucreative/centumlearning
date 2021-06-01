<?php 
/* Template Name: Solutions Page */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$template_banner_content = get_field('template_banner_content');
$page_video_cover_image = get_field('page_video_cover_image');
$page_video_url = get_field('page_video_url');
$page_url = get_field('page_url');

$check_for_page_url = get_field('check_for_page_url');
?>
<div class="TemplateBanner temp_CTS" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content pt-0 pt-md-5">
		<div class="row">
			<div class="col-12 col-md-7 pr-0 pr-md-5" data-aos="fade-up" data-aos-delay="50">
				<h1><?php the_title();?></h1>
				<?php echo $template_banner_content ?>
			</div>
			<div class="col-12 col-md-5" data-aos="fade-up" data-aos-delay="50">
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
	<?php
		if( have_rows('content_row') ): 
		echo '<div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="50">';
		foreach ( get_field("content_row") as $item  ) {
			if($item['heading'] !=''){
				echo '<h2 class="col-12 text-center my-3">'. $item['heading'] .'</h2>';
			}
			echo '<div class="col-12">'. $item['content'] .'</div>';
			}
		echo '</div>';
		endif;
	?>

	<?php include('client-speak.php'); ?>
	<?php include('case-studies.php'); ?>

	<?php include('polygonizr-animation-left.php'); ?>
</div>
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