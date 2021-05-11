<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div>
<div class="container">
	<div class="post-content">
			<h1 class="text-center"><?php the_title(); ?></h1>
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
<?php endwhile; endif; ?>
<?php get_footer(); ?>