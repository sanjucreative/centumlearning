<?php
/*
 Template Name: Webinars
 Template Name Posts: Webinars 
 Template Post Type: post
 */
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$stdate = current_time('mysql');
	$todays_date =  date("Ymd", strtotime($stdate));
	$schedule_date = get_post_meta(get_the_ID(), 'schedule_date', true );
	$schedule_time = get_post_meta(get_the_ID(), 'schedule_time', true );
	$sdate =  date("dS, F Y", strtotime($schedule_date)) . " | " . $schedule_time;
	$register_now_url = get_post_meta(get_the_ID(), 'register_now_url', true );
	if($schedule_date < $todays_date){
		$register_now_url ='';
	}
?>
<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
<div class="animation_wrap">
<div class="container">
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
		<div class="col-12 col-md-10 pt-3 pt-md-5">
			<!-- <h1 class="text-center"><?php // the_title(); ?></h1> -->
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
			<article><?php the_content();?></article>
		</div>
	</div>

	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
		<div class="col-12">
			<h2 class="text-center heading">Speakers</h2>
			<div class="speakers_slider">
			<?php
				if( have_rows('select_speakers') ): 
					foreach ( get_field("select_speakers") as $i => $item  ) {
							$post_id = $item['speaker_name']->ID;
							$img = wp_get_attachment_image_src(get_post_thumbnail_id($item['speaker_name']->ID), 'full' );
				?>
				<div class="speakers_wrap">
					<div class="speakers_info">
						<h4><?php echo $item['speaker_name']->post_title; ?></h4>
						<p><?php echo get_post_meta($post_id, 'designation', true ); ?></p>
						<p><strong><?php echo get_post_meta($post_id, 'company_name', true ); ?></strong></p>
					</div>
					<figure><img src="<?php echo $img[0]; ?>" alt="<?php echo $item['speaker_name']->post_title; ?>" /></figure>

					<div class="about_speakers">
					<?php echo  wpautop(get_post_meta($post_id, 'speaker_content', true )); ?>
					<div class="more_content"><?php echo  wpautop(get_post_meta($post_id, 'speaker_content_read_more', true )); ?></div>
					<div class="more_content"><?php echo  wpautop(get_post_meta($post_id, 'speaker_content_read_more', true )); ?></div>
					<?php if(wpautop(get_post_meta($post_id, 'speaker_content_read_more', true )) !=='') echo '<div class="text-center readmore"><a class="" href="#">Read More <i></i></a></div>';?>
					
					<?php // echo  wpautop($item['speaker_name']->post_content); ?>
					</div>

				</div>

				<?php
					}
				endif;
				?>
			</div>
		</div>
	</div>

	
		
			<?php
				if( have_rows('key_features') ): 
					echo '<div class="row justify-content-center key_features pb-5 px-md-4" data-aos="fade-up" data-aos-delay="50">';
					foreach ( get_field("key_features") as $i => $item  ) {	?>
					<div class="col-12 col-md-6 mb-3">
						<div class="card key_features_wrap">
							<div class="card-heading"><h3><?php echo $item['key_features'];?></h3></div>
							<div class="card-body">
								<?php echo  wpautop($item['key_content']); ?>
							</div>
						</div>
					</div>
				<?php
					}
				echo '</div>';
				endif;
			?>
		
			<div class="row justify-content-center pb-5" data-aos="fade-up" data-aos-delay="50">
				<?php 
				if($register_now_url!='') {
					echo '<a class="btn btn-primary" href="'. $register_now_url .'">Register Now!</a>';
				} else{
					echo '<div class="reg_closed_msg">REGISTRATIONS FOR THIS WEBINAR ARE CLOSED!</div>';
				}?>
			</div>

</div>
<?php include('polygonizr-animation-left.php'); ?>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {
	  var bannerCont = '<div class="temp_webinar_post">';
	  bannerCont +='<h6 class="cat_name">Webinar on</h6>';
	  bannerCont +='<h1><?php the_title(); ?></h1>';
	  bannerCont +=''
	  bannerCont +='<div class="date_time"><span><?php echo $sdate; ?></span></div>';
	  <?php if($register_now_url != ''){ ?>
	  	bannerCont +='<a class="btn btn-primary" href="<?php echo $register_now_url;?>">Register Now!</a>';
	  <?php } else{?>
		bannerCont +='<div class="closed_msg">REGISTRATIONS FOR THIS WEBINAR ARE CLOSED!</div>'
	  <?php } ?>
	  bannerCont +='</div>';
	  	$(bannerCont).appendTo(".banner_content .banner_left");	
  });  
</script>
<?php endwhile; endif; ?>
<?php get_footer(); ?>