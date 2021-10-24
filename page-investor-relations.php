<?php 
/* Template Name: Investor Relations */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="animation_wrap">
	<div class="container pt-4 pb-5">
			<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
				<div class="col-12">
				<ul class="nav nav-pills justify-content-center investor_relations_tabs row " role="tablist">
                        <li class="nav-item col-6 pr-0">
                            <a href="#tab_policies" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab_policies" aria-selected="true">Policies</a>
                        </li>
                        <li class="nav-item col-6 pl-0">
                            <a href="#tab_nnual_results" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab_nnual_results" aria-selected="false">Annual Results</a>
						</li>
					</ul>
				</div>
				<div class="col-12 tab-content pb-4">
				<ul class="investor_relations_list tab-pane fade active show"  role="tabpanel" id="tab_policies">
				<?php
				 		$policies_args = array('post_type' => 'investor-relation', 'posts_per_page' => -1, 'orderby' => 'post_date',
						 'order' => 'DESC', 'post_status' => 'publish', 'tax_query' => array(
							array('taxonomy' => 'relations', 'field' => 'slug', 'terms' => 'policies')));

						 $policies_query = new WP_Query($policies_args);
						if ($policies_query->have_posts()) : while ($policies_query->have_posts()) : $policies_query->the_post();
						$publication_pdf = get_the_guid(get_post_meta( $post->ID, 'upload_investor_relations_file', true ));
						?>
						<li><span class="icon"></span><a class="fancybox" href="<?php echo $publication_pdf;?>"><?php the_title(); ?></a></li>					
				<?php
				endwhile;
				endif;
				wp_reset_postdata();
				?>
				</ul>


				<div class="tab-pane fade"  role="tabpanel" id="tab_nnual_results">
					<ul class="investor_relations_list">
						<h4>Audited Financial Statements Of Subsidiary Companies:</h4>
					<?php
							$annual_args = array('post_type' => 'investor-relation', 'posts_per_page' => -1, 'orderby' => 'post_date',
							'order' => 'DESC', 'post_status' => 'publish', 'tax_query' => array(
								array('taxonomy' => 'relations', 'field' => 'slug', 'terms' => 'annual-results')));
							$annual_query = new WP_Query($annual_args);
							$count = $annual_query->found_posts;
							if($count == 0){
								echo '<p>No results found.</p>';
							}else{
								if ($annual_query->have_posts()) : while ($annual_query->have_posts()) : $annual_query->the_post();
								$publication_pdf = get_the_guid(get_post_meta( $post->ID, 'upload_investor_relations_file', true ));
								?>
								<li><span class="icon"></span><a class="fancybox" href="<?php echo $publication_pdf;?>"><?php the_title(); ?></a></li>					
							<?php
								endwhile;
								endif;
								wp_reset_postdata();
							}
							?>
					</ul>
				</div>

				
			
			
			
			
			</div>

			</div>
	</div>
	<?php include('polygonizr-animation.php'); ?>
</div>
<?php endwhile; endif; ?>
<div class="video_modal">
    <div class="closed"></div>
    <div class="modal_container">
        <div class="videoWrapper">
                <iframe id="iframe_video" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen"></iframe>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.js')?>"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.css')?>" />
<script type="text/javascript">
  jQuery(document).ready(function($) {
	$(".fancybox").fancybox();
  })
</script>
<?php get_footer(); ?>