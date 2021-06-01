<div class="row pt-4 pb-4" data-aos="fade-up" data-aos-delay="50">
	<h3 class="col-12 h2 text-center py-3">Client Speak</h3>
	<div class="col-12">
    <?php

$page_id = get_queried_object_id();
$client_choosed_id  = get_field("select_speak", $page_id);

if($client_choosed_id){
    $client_args = array('post_type' => 'client', 'posts_per_page' => -1, 'orderby' => 'post__in', 'post__in' => $client_choosed_id);
}else{
    $client_args = array('post_type' => 'client', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC');
}


$client = new WP_Query($client_args);
?>
		<div class="solution_slider client_slider">
		<?php        
        if ($client->have_posts()) :  while ( $client->have_posts() ) : $client->the_post();
                // $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                $video_format =  get_field('client_video_format');
                $video_cover = get_theme_file_uri('/assets/images/clients_dummy.jpg');
                
                ?>
                <div class="client_box_wrap">
                    <?php                     
                    if($video_format[0] == 'Yes'){
                        $format = 'video';
                        $video_cover =  get_field('client_video_cover_image');
                    }else{
                        $format = 'text';
                        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                            if($img !=''){
                                $video_cover =  $img;
                            }
                    }
                ?>
                    
                    <figure class="<?php echo $format; ?>" 
                        <?php  // echo 'style="background-image:url('. $video_cover .')"'; ?>
                    >
                        <?php 
                            if($format == 'video'){
                                echo '<div class="show_btn"></div>';
                            }else{
                                echo '<div class="read_btn">Read</div>';
                            }

                            echo '<img src="'. $video_cover .'" alt=" " />';
                        ?>
                        
                    </figure>
                    <div class="client_meta">
                        <h5><?php the_title(); ?></h5> 
                        <?php 
                            if(get_field('client_designation') !=''){
                                echo "<p>" . get_field('client_designation') . "</p>";
                            }
                            if(get_field('client_company_name') !=''){
                                echo "<p><strong>" . get_field('client_company_name') . "</strong></p>";
                            }                          
                        ?>
                    </div>
                </div>
        <?php endwhile;  endif; ?>
		</div>
	</div>
</div>