<?php
/*
 Template Name: Insights
 Template Name Posts: Insights 
 Template Post Type: post
 */
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
<div class="animation_wrap">
<div class="container">
	<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
		<div class="col-12 col-md-10 pt-3 pt-md-5 pb-5">
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


</div>
<?php include('polygonizr-animation-left.php'); ?>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {
	  var bannerCont = '<div class="temp_webinar_post">';
	  bannerCont +='<h6 class="cat_name">Insights on</h6>';
	  bannerCont +='<h1><?php the_title(); ?></h1>';
	  bannerCont +='</div>';
	  $(bannerCont).appendTo(".banner_content .banner_left");	
  });  
</script>
<?php endwhile; endif; ?>
<?php get_footer(); ?>