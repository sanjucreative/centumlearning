<?php 
/* Template Name: Corporate Training Solutions */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');

?>
<div class="TemplateBanner temp_CTS" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content" data-aos="fade-up" data-aos-delay="50">
		<div class="row">
			<div class="col-12 col-md-6 pt-0 pt-md-3 pr-0 pr-md-3">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
			</div>
			<div class="col-12 col-md-6">
				<div class="CTS_page_list_wrap row">
				<?php
                if( have_rows('page_cover_image') ): 
                foreach ( get_field("page_cover_image") as $i => $item ) {

					if($i == 0 || $i == 1 || $i == 3  ){ 
						echo '<div class="col-12 col-sm-6 col-md-4 CTS_page_child_wrap">';
					} elseif($i == 2){ 
						echo '';
					}else{
					echo '<div class="col-12 col-md-6 CTS_page_child_wrap">';
					}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["page_cover_image"] .')" ></figure>';
				echo '<h4>' . $item["parent_page_name"] . '</h4>';

				?>
					<ul class="page_child_list">
					<?php
						wp_list_pages( array(
						'title_li'    => '',
						'child_of'    => $item['parent_page_id'],
						'depth'    	  => 1,
						) );
					?>
					</ul>
				<?php    
						$args = array('post_parent' => $item['parent_page_id']);
						$children = get_children( $args );
						if (empty($children) ) {
							echo '<a class="parent_link" href="' . get_permalink($item['parent_page_id']) .'"></a>';
						}
				echo '</div>';


				if($i == 1){ 
					echo '';

				} elseif($i == 2){ 
					echo '</div>';

				}else{
				echo '</div>';
				}



					}
					endif;
				?>					
				</div>

			</div>
		</div>
	</div>
</div>

<div class="animation_wrap">
	<div class="container">
		<?php include('trustedby.php'); ?>
		<?php include('awards.php'); ?>
		<?php include('polygonizr-animation.php'); ?>
	</div>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>