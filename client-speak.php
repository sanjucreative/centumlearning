<div class="row pt-4 pb-4" data-aos="fade-up" data-aos-delay="50">
	<h3 class="col-12 text-center py-3 section-heading">Client Speak</h3>
	<div class="col-12">
    <?php
wp_reset_query();
$page_id = get_queried_object_id();
$client_choosed_id  = get_field("select_speak", $page_id);
// print_r($client_choosed_id);
if($client_choosed_id){
    $client_args = array('post_type' => 'client', 'posts_per_page' => -1, 'orderby' => 'post__in', 'post__in' => $client_choosed_id);
}else{
    $client_args = array('post_type' => 'client', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC');
}


$client = new WP_Query($client_args);
// print_r($client);
?>
		<div class="client_slider">
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
                        $video_url = get_field('client_video_url');
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
                                echo '<a class="show_btn cta_client_video" data-fancybox="video" data-src="'. $video_url .'"></a>';
                            }else{
                                echo '<a class="read_btn cta_client_text" data-id="'. $post->ID .'">Read</a>';
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
        <?php endwhile;  endif;
        wp_reset_query();
        ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.js')?>"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.css')?>" />
<script type="text/javascript">
  jQuery(document).ready(function($) {
    // $(".cta_client_video").fancybox();
    $(document).on('click', '.cta_client_text', function(e){
        e.preventDefault();
        var This = $(this);
        var post_ID = $(this).data('id');
        $.ajax({
		    type: 'POST',  
				url: '<?php echo admin_url('admin-ajax.php');?>',
				data: {
					'action':'load_post_type_client',
					'post_ID' : post_ID,
				},
                success: function (data) {
                    $("body").append(data);
                    $('.client_speak_modal').fancybox({
                        afterClose 	:	function() {
                            $('.client_speak_modal, .fancybox-container').remove();
		                        }
                    }).trigger('click');
                }
        });
    });
    
  })
  </script>
<style>
.fancybox-navigation, .fancybox-infobar{display:none!important}
.fancybox-slide--video{width: 100% !important; height: calc(100% - 60px) !important; padding: 0px!important;}
.fancybox-slide--video .fancybox-content{padding-bottom: 56.25%; width: 100% !important; height: 0;}
</style>