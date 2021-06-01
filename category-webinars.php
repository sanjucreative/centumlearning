<?php get_header(); ?>

<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
<div class="container">
	<div class="row justify-content-center pb-5" data-aos="fade-up" data-aos-delay="50">
		<h2 class="col-12 text-center mt-2 mb-4">Previous Webinars</h2>
		<?php 		
		if (have_posts()) : while (have_posts()) : the_post(); 
			$stdate = current_time('mysql');
			$todays_date =  date("Ymd", strtotime($stdate));
			$schedule_date = get_post_meta(get_the_ID(), 'schedule_date', true );
			$schedule_time = get_post_meta(get_the_ID(), 'schedule_time', true );
			$sdate =  date("dS, F Y", strtotime($schedule_date)) . " | " . $schedule_time;
			$register_now_url = get_post_meta(get_the_ID(), 'register_now_url', true );
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
			if($schedule_date >= $todays_date){
				
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var bannerCont = '<div class="banner_upcoming_webinars">';
				bannerCont +='<h6>Upcoming Webinar</h6>';
				<?php if( has_post_thumbnail() ) {?>
						bannerCont +='<figure class="featured-image" style="background-image:url(<?php echo $img[0] ?>)"></figure>';
				<?php	 }else{ ?>
						bannerCont +='<figure class="featured-image webinarThumb"></figure>';
				<?php } ?>
				bannerCont +='<h2><?php the_title(); ?></h2>';
				bannerCont +='<div class="date_time"><span>Date:</span> <?php echo date("dS, M Y", strtotime($schedule_date)); ?> | <span>Time:</span> <?php echo $schedule_time; ?></div>';
				bannerCont +='<div class="know_more"><a class="know_more_btn" href="<?php the_permalink(); ?>"><span>KNOW MORE</span></a></div>';
				bannerCont +='</div>';
				

				setTimeout(function(){ 
					$(".banner_content .banner_right").html(bannerCont);
				 }, 100);
			});  
		</script>
		<?php
			}else{
		?>
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">
				<div class="cat_wrap">			
						<?php if( has_post_thumbnail() ) {
							 echo '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
						 }else{
							 echo '<figure class="cat-featured-image webinarThumb"></figure>';
						 } ?>
										
						<h4><?php the_title(); ?></h4>
						<p><strong>Date:</strong> <?php echo date("dS, M Y", strtotime($schedule_date)); ?></p>
						<p><strong>Time:</strong> <?php echo $schedule_time; ?></p>
						<div class="know_more"><a class="know_more_btn" href="<?php the_permalink(); ?>"><span>KNOW MORE</span></a></div>
				</div>
			</div>
						
			
		<?php 
			}
	endwhile; endif; ?>
	</div>

</div>
<?php get_footer(); ?>