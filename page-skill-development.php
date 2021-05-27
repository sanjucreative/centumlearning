<?php 
/* Template Name: Skill Development */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$page_video_cover_image = get_field('page_video_cover_image');
$page_video_url = get_field('page_video_url');
$page_url = get_field('page_url');

$check_for_page_url = get_field('check_for_page_url');
?>
<div class="TemplateBanner temp_CTS" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content pt-0 pt-md-5">
		<div class="row">
			<div class="col-12 col-md-5 pr-0 pr-md-5" data-aos="fade-up" data-aos-delay="50">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
			</div>
			<div class="col-12 col-md-7" data-aos="fade-up" data-aos-delay="50">
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


<?php
	if( have_rows('sd_content_section_row') ): 
	foreach ( get_field("sd_content_section_row") as $i => $item  ) {
?>
<div class="section_content" data-aos="fade-up" data-aos-delay="50">
	<div class="container">
		<div class="row justify-content-center">
			<?php if($item['sd_section_heading'] !=''){
				echo '<h3 class="col-12 col-md-10 text-center section-title font-weight-bold">'. $item['sd_section_heading'] .'</h3>';
			}?>
			<div class="col-12 col-md-10 text-center"><?php echo $item['sk_section_content']; ?></div>
		</div>
	</div>
</div>
<?php
		}
	endif;
?>

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