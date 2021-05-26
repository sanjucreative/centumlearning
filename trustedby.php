<div class="row py-4" data-aos="fade-up" data-aos-delay="50">
	<h6 class="col-12 section-heading text-center pb-3">Trusted by 400+ Customers</h6>
	<div class="col-12">
		<div class="trustedBy">
		<?php
        $trusted_args = array('post_type' => 'trusted_company', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC');
        $trusted = new WP_Query($trusted_args);
        
        if ($trusted->have_posts()) :  while ( $trusted->have_posts() ) : $trusted->the_post();
                $company_logo = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                ?>
                <figure><img class="img-fluid" src="<?php echo $company_logo; ?>" alt="" /></figure>
        <?php endwhile;  endif; ?>
		</div>
	</div>
</div>