<?php get_header(); ?>

<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
<div class="container">
	<div class="row justify-content-center pb-5" data-aos="fade-up" data-aos-delay="50">
	<h2 class="col-12 text-center mt-2 mb-4">Featured</h2>
	<?php
		$queried_object = get_queried_object(); 
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;  

		$ids = get_field('select_post', $taxonomy . '_' . $term_id);
		
		$post_id = array();
		$keys = array_keys($ids);
		for($i = 0; $i < count($ids); $i++) {
			foreach($ids[$keys[$i]] as $key => $value) {
				$post_id[] = $value;
			}
		}


		 $args = array('cat' => 4, 'posts_per_page'=> 4, 'post__in' => $post_id, 'orderby' => 'post__in');
	 




	$loop = new WP_Query( $args );
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
		<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">
		<div class="cat_wrap">			
				<?php if( has_post_thumbnail() ) {
					$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
					echo '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
				}else{
					echo '<figure class="cat-featured-image webinarThumb"></figure>';
				} ?>
								
				<h4><?php the_title(); ?></h4>
				<div class="know_more"><a class="know_more_btn" href="<?php the_permalink(); ?>"><span>KNOW MORE</span></a></div>
		</div>
		</div>
	<?php
	endwhile; endif;
	?>
	</div>
	
	<div class="row justify-content-center pb-5" data-aos="fade-up" data-aos-delay="50">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">
				<div class="cat_wrap">			
						<?php if( has_post_thumbnail() ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
							 echo '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
						 }else{
							 echo '<figure class="cat-featured-image webinarThumb"></figure>';
						 } ?>
										
						<h4><?php the_title(); ?></h4>
						<div class="know_more"><a class="know_more_btn" href="<?php the_permalink(); ?>"><span>KNOW MORE</span></a></div>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>

</div>
<?php get_footer(); ?>