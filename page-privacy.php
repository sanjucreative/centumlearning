<?php 
/* Template Name: Privacy */
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="animation_wrap">
<div class="container">
	<div class="post-content py-5">
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
			<article><?php  the_content(); ?></article>
		
	</div>

</div>

<div class="privacy_contact_wrap">
		<div class="container">
		 <div class="row">
			 <div class="col-12 col-lg-10"><?php echo get_field('privacy_issue_contact'); ?></div>
		 </div>
		</div>
</div>

<div class="container">
		 <div class="row">
			 <div class="col-12 py-5"><?php echo get_field('after_issue_contact'); ?></div>
		 </div>
</div>
<?php include('polygonizr-animation-left.php'); ?>
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
<?php get_footer(); ?>