<div class="row pt-4 pb-5" data-aos="fade-up" data-aos-delay="50">
	<h6 class="col-12 section-heading text-center pb-3">Awards & Recognition</h6>
	<div class="col-12">
		<div class="awards">
		<?php
        $awards_args = array('post_type' => 'awards_support', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC');
        $awards = new WP_Query($awards_args);
        
        if ($awards->have_posts()) :  while ( $awards->have_posts() ) : $awards->the_post();
                $company_logo = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                ?>
                <figure><img class="img-fluid" src="<?php echo $company_logo; ?>" alt="" /></figure>
        <?php endwhile;  endif; ?>
		</div>
	</div>
</div>