<?php get_header(); ?>
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
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
		<div class="post-content col-12 col-md-10 pt-5">
			<h1 class="text-center"><?php the_title(); ?></h1>
				<?php if (has_excerpt()){ ?>
					<article class="text-center"><?php the_excerpt();?></article>
				<?php } ?>
			
			<?php $featured_image_display = get_field('show_featured_image_in_post');
					if($featured_image_display[0] == 'Yes'):
						if( has_post_thumbnail() ) { ?>
							<figure class="post-featured-image"><?php the_post_thumbnail(); ?></figure>
						<?php }
					endif;
			?>
			<article><?php the_content(); ?></article>
		</div>
	</div>

</div>
<?php include('polygonizr-animation-left.php'); ?>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>