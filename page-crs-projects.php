<?php 
/* Template Name: CRS Projects */
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


<?php
	if( have_rows('csr_section_content') ): 
	foreach ( get_field("csr_section_content") as $i => $item  ) {
?>
	<div class="section_content" data-aos="fade-up" data-aos-delay="50">
		<div class="container">
			<div class="row">
				<h3 class="col-12 text-center section-title font-weight-bold"><?php echo $item['heading']; ?></h3>
				<?php
					if($i % 2 == 0) echo '<figure class="col-12 col-md-5 pr-0 pr-md-5"><img class="img-fluid" src="'. $item['thumbnail'] .'" alt="'. $item['heading'] .'" /></figure>';	
				?>
				<div class="col-12 col-md-7">
					<?php echo $item['content']; ?>
					<div class="row mt-5">
					<?php 
						if(!empty($item['know_more'])):
							foreach (  $item['know_more'] as $know  ) {
								echo '<div class="col-6"><div class="knowmore_box">';
								echo '<h5>'. $know['heading'] . '</h5>';
								echo '<p>'. $know['sub_heading'] . '</p>';
								if($know['url'] !=''){
									echo '<a href="'. $know['url'] .'" class="know_more_btn"><span>KNOW MORE</span></a>';
								}

								echo '</div></div>';
							}
						endif;	
					?>
					</div>
				
				</div>
				<?php
					if($i % 2 != 0) echo '<figure class="col-12 col-md-5 pr-0 pr-md-5"><img class="img-fluid" src="'. $item['thumbnail'] .'" alt="'. $item['heading'] .'" /></figure>';	
				?>
				
			</div>
		</div>
	</div>


<?php
		}
	endif;
?>

<div class="section_content" data-aos="fade-up" data-aos-delay="50">
	<div class="container">
		<div class="row justify-content-center">
				<h3 class="col-12 text-center section-title font-weight-bold"><?php echo get_field('project_management_heading'); ?></h3>
				<div class="col-12 col-md-8 text-center"><?php echo get_field('project_management_excerpt'); ?></div>
				<div class="col-12">
						<ul class="project_follow">
						<?php
							if( have_rows('project_management_follow') ): 
							foreach ( get_field("project_management_follow") as $item  ) {
								echo '<li>';
								echo '<div class="follow_circle"><figure><img class="img-fluid" src="'. $item['follow_icon'] . '" alt="" /></figure>';
								echo '<span>' . $item['follow_label'] .'</span>';
								echo '<div class="follow_excerpt">' . $item['follow_excerpt'] .'</div></div>';
								// echo '<div class="follow_excerpt">' . $item['follow_excerpt'] .'</div>';
								echo '</li>';
							}
							endif;
						?>
						</ul>
				</div>
		</div>
	</div>
</div>

<div class="section_content py-3" data-aos="fade-up" data-aos-delay="50">
	<div class="container">
		<?php include('client-speak.php'); ?>
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