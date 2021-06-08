<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
if(the_content() !=''){
?>
<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
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
			<article><?php the_content(); ?></article>
		
	</div>

</div>
<?php 
}
endwhile; endif; ?>
<div class="video_modal">
    <div class="closed"></div>
    <div class="modal_container">
        <div class="videoWrapper">
                <iframe id="iframe_video" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen"></iframe>
        </div>
    </div>
</div>
<?php get_footer(); ?>