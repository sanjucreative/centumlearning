<?php 
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('dialogues_banner_image');
$banner_content = get_field('dialogues_banner_content');
?>
<div class="TemplateBanner temp_dialogues" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container">
		<div class="row">
			<div class="col-12 banner_content">
				<?php echo $banner_content; ?>
			</div>
			<div class="col-12 page_banner_content">
				<div class="row justify-content-center">
					<?php

					//$todays_date = date('Y-m-d H:i:s');	
					$stdate = current_time('mysql');
					$todays_date =  date("Ymd", strtotime($stdate));
					//$todays_date = date('d/m/Y', strtotime('-1 day', strtotime($stdate)));


					$web_upcoming_args = array(
					'posts_per_page' => 5, 'category_name' => 'webinars', 'orderby' => 'post_date',
					'order' => 'DESC', 'post_status' => 'publish', 	'meta_key' => 'schedule_date',
					'meta_query' => array(
										array('key' => 'schedule_date', 'value' => $todays_date, 'compare' => '>')
							)
					);
					$web_upcoming_query = new WP_Query( $web_upcoming_args );
					$count = $web_upcoming_query->found_posts;
					// echo '<pre>';
					// print_r($web_upcoming_query);
					// echo $count;
					// echo '</pre>';
					
					if($count > 0){
					?>
						<div class="col-12 col-lg-3">
							<h2>Upcoming Discussions</h2>
							<div class="block_scrollbar1">
								<ul class="upcoming_discussions">
									<?php
										if ($web_upcoming_query->have_posts()) : while ($web_upcoming_query->have_posts()) : $web_upcoming_query->the_post();
											$schedule_date = get_post_meta(get_the_ID(), 'schedule_date', true );
											$schedule_time = get_post_meta(get_the_ID(), 'schedule_time', true );
											$sdate =  date("dS, M Y", strtotime($schedule_date));
										?>
											<li>
													<figure class="feature_img">
														<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
													</figure>
													<div class="schedule_date"><?php echo $sdate . ' | ' . $schedule_time; ?></div>
													<div class="heading">Speakers:</div>
													<?php
															if( have_rows('select_speakers') ): 
																foreach ( get_field("select_speakers") as $i => $item  ) {
																	$post_id = $item['speaker_name']->ID;
																	echo '<p><a href="'. get_the_permalink() .'"><strong>'. $item['speaker_name']->post_title . '</strong></br>';
																	echo get_post_meta($post_id, 'designation', true ) .', '.  get_post_meta($post_id, 'company_name', true ) .'</a></p>';
															}
														endif;
													?>
											</li>
										<?php
										endwhile;
										endif;
										wp_reset_postdata();

										?>
								</ul>
							</div>
						</div>
						<?php } ?>
						<div class="col-12 col-lg-5">
							<h2>Recent Discussions</h2>
							<div class="block_scrollbar">
							<ul class="recent_discussions">
							<?php
								$web_args = array(
									'posts_per_page' => 5,
									'category_name' => 'webinars',
									'orderby' => 'post_date',
									'order' => 'DESC',
									'post_status' => 'publish',
									'meta_key' => 'schedule_date',
									'meta_query' => array(
										array(
											'key' => 'schedule_date',
											'value' => $todays_date,
											'compare' => '<='
										)
									)
							);

								$web_query = new WP_Query( $web_args );
								if ($web_query->have_posts()) : while ($web_query->have_posts()) : $web_query->the_post();?>
									<li>
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<div class="heading">Speakers:</div>
											<?php
													if( have_rows('select_speakers') ): 
														foreach ( get_field("select_speakers") as $i => $item  ) {
															$post_id = $item['speaker_name']->ID;
															echo '<p><a href="'. get_the_permalink() .'"><strong>'. $item['speaker_name']->post_title . '</strong></br>';
															echo get_post_meta($post_id, 'designation', true ) .', '.  get_post_meta($post_id, 'company_name', true ) .'</a></p>';
													}
												endif;
											?>
									</li>
								<?php
								endwhile;
								endif;
								wp_reset_postdata();
								?>
							</ul>
							</div>
							<div class="more_post_btn"><a href="<?php echo get_bloginfo('url');?>/webinars">More Discussions <i></i></a></div>
						</div>
						<div class="col-12 col-lg-4">
							<h2>Insights</h2>
							<div class="block_scrollbar">
							<ul class="insights">
							<?php
								$web_args = array('posts_per_page' => 5, 'category_name' => 'insights', 'orderby'=> 'post_date', 'order' => 'DESC');
								$web_query = new WP_Query( $web_args );
								if ($web_query->have_posts()) : while ($web_query->have_posts()) : $web_query->the_post();
									$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
								?>
										<li>
											<figure style="background-image:url(<?php echo $img[0]; ?>)"></figure>
											<h3><?php the_title(); ?></h3>
											<div class="reamore_btn"><a href="<?php the_permalink(); ?>">Read More</a></div>
										</li>

								<?php
								endwhile;
								endif;
								wp_reset_postdata();
								?>
								</ul>
								</div>
								<div class="more_post_btn"><a href="<?php echo get_bloginfo('url');?>/insights">More Insights <i></i></a></div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>