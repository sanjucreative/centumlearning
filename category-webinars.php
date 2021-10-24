<?php get_header();

$stdate = current_time('mysql');
$todays_date =  date("Ymd", strtotime($stdate));


$web_upcoming_args = array(
	'posts_per_page' => 1, 'category_name' => 'webinars', 'orderby' => 'post_date',
	'order' => 'DESC', 'post_status' => 'publish', 	'meta_key' => 'schedule_date',
	'meta_query' => array(
						array('key' => 'schedule_date', 'value' => $todays_date, 'compare' => '>')
			)
	);
	$web_upcoming_query = new WP_Query( $web_upcoming_args );
	$count = $web_upcoming_query->found_posts;
	$upcomingCont='';
	if($count > 0){
		$upcomingCont .= '<div class="feature_content"><div class="feature_wrap"><h2>Upcoming Webinars</h2>';
		if ($web_upcoming_query->have_posts()) : while ($web_upcoming_query->have_posts()) : $web_upcoming_query->the_post();
			$schedule_date = get_post_meta(get_the_ID(), 'schedule_date', true );
			$schedule_time = get_post_meta(get_the_ID(), 'schedule_time', true );
			$sdate =  date("dS, M Y", strtotime($schedule_date));

			$upcomingCont .= '<figure class="feature_img">';
			$upcomingCont .= '<h3><a href="'. get_the_permalink().'">'. get_the_title() .'</a></h3></figure>';
			$upcomingCont .= '<p>'. get_the_excerpt() .'</p>';
			$upcomingCont .= '<div class="schedule_date">' . $sdate . ' | ' . $schedule_time . '</div>';
			$upcomingCont .= '<div class="heading">Speakers:</div>';
			
					if( have_rows('select_speakers') ): 
						foreach ( get_field("select_speakers") as $i => $item  ) {
							$post_id = $item['speaker_name']->ID;
							$upcomingCont .= '<p><a href="'. get_the_permalink() .'"><strong>'. $item['speaker_name']->post_title . '</strong></br>';
							$upcomingCont .= get_post_meta($post_id, 'designation', true ) .', '.  get_post_meta($post_id, 'company_name', true ) .'</a></p>';
					}
				endif;
			$upcomingCont .= '<div class="text-center mt-3"><a href="'. get_the_permalink() . '" class="btn btn-white btn-register">Register Now</a></div>';
		endwhile;
		endif;
		wp_reset_postdata();
		$upcomingCont .= '</div></div>';
	} else{
		$upcomingCont .= '<div class="video_cont"><figure><img src="'. get_theme_file_uri( '/assets/images/Webinar-Listing-right.png') .'"></figure></div>';
	}
?>
<div class="container">
	<div class="row justify-content-center pb-5" data-aos="fade-up" data-aos-delay="50" id="nextFold">
		<h2 class="col-12 text-center mt-2 mb-4">Previous Webinars</h2>
		<?php 		
		if (have_posts()) : while (have_posts()) : the_post(); 
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
		?>
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">
				<div class="cat_wrap">			
						<?php if( has_post_thumbnail() ) {
								echo '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
							}else{
								echo '<figure class="cat-featured-image webinarThumb"></figure>';
							} ?>
											
							<h4><?php the_title(); ?></h4>
							<p><?php echo get_the_excerpt(); ?></p>
							<div class="heading">Speakers:</div>
							<?php
									if( have_rows('select_speakers') ): 
										foreach ( get_field("select_speakers") as $i => $item  ) {
											$post_id = $item['speaker_name']->ID;
											echo '<p><strong>'. $item['speaker_name']->post_title . ': </strong> ';
											echo get_post_meta($post_id, 'designation', true ) .', '.  get_post_meta($post_id, 'company_name', true ) .'</p>';
									}
								endif;
							?>
							<div class="know_more"><a  href="<?php the_permalink(); ?>">VIEW MORE</a></div>
				</div>
			</div>
			
		<?php 
			// }
	endwhile; endif; ?>
	</div>
	<div class="row" style="display:none" id="inifiniteLoader"><div class="col-12 text-center"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>" alt="" /></div></div>

</div>
<?php get_footer(); ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
	$(".banner_right").html('<?php echo $upcomingCont; ?>');

	var count = 2;
	var total = <?php echo $wp_query->max_num_pages; ?>;
	$(window).scroll(function(){
		var footerH = $("footer").height();
		if ($(window).scrollTop() + $(window).height()  >= $(document).height() - footerH) {
		if (count > total){
			return false;
		}else{
			loadArticle(count);
		}
		count++;
		}
	});

   function loadArticle(pageNumber){
     $('#inifiniteLoader').show();
     $.ajax({
       url: "<?php echo admin_url(); ?>admin-ajax.php",
       type:'POST',
       data: "action=infinite_scroll&page_no="+ pageNumber +"&cat_no=13",
       success: function (html) {
         $('#inifiniteLoader').hide();
         $("#nextFold").append(html);
       }
     });
     return false;
   }
  });  
</script>