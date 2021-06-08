<div class="row pt-4 pb-5" data-aos="fade-up" data-aos-delay="50">
	<h3 class="col-12 h2 text-center py-3">Case Studies</h3>
	<div class="col-12">
    <?php

$page_id = get_queried_object_id();
$case_id  = get_field("select_case", $page_id);

if($case_id){
    $case_args = array('post_type' => 'case-studies', 'posts_per_page' => -1, 'orderby' => 'post__in', 'post__in' => $case_id);
}else{
    $case_args = array('post_type' => 'case-studies', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC');
}


$case = new WP_Query($case_args);
?>
		<div class="solution_slider case_slider">
		<?php        
        if ($case->have_posts()) :  while ( $case->have_posts() ) : $case->the_post();
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                ?>
                <div class="case_box_wrap">
                    <figure><a href="<?php the_permalink(); ?>"><img class="img-fluid" src="<?php echo $img;?>" alt="<?php echo get_the_title();?>" /></a></figure>
                </div>
        <?php endwhile;  endif; 
        wp_reset_query();
        ?>
		</div>
	</div>
</div>