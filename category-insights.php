<?php get_header(); ?>
<?php
	$queried_object = get_queried_object(); 
	$taxonomy = $queried_object->taxonomy;
	$term_id = $queried_object->term_id;  	
	$Selected_insight = get_field('select_insight_article', $taxonomy . '_' . $term_id);
	
	$insight_cont = '<div class="feature_content"><div class="feature_wrap">';
	$insight_cont .= '<figure class="feature_img"><h3><a href="'. get_the_permalink($Selected_insight->ID) .'">'. $Selected_insight->post_title.'</a></h3></figure>';
	$insight_cont .= '<p>'. str_replace('"', '', $Selected_insight->post_excerpt) .'</p>';
	$insight_cont .= '<div class="text-center mt-3"><a href="'. get_the_permalink($Selected_insight->ID) .'" class="btn btn-white btn-register">View More</a></div>';
	$insight_cont .= '</div></div>';
	// print_r($Selected_insight);
	// echo $insight_cont;
?>

<div class="container">
	<div class="row justify-content-center py-5" data-aos="fade-up" data-aos-delay="50" id="nextFold">		
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
			$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false, '' );
		?>
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">
				<div class="cat_wrap">			
					<?php if( has_post_thumbnail() ) {
						echo '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
					}else{
						echo '<figure class="cat-featured-image webinarThumb"></figure>';
					} ?>
									
					<h4><?php the_title(); ?></h4>
					<p><?php echo get_the_excerpt(); ?></p>
					<div class="know_more"><a  href="<?php the_permalink(); ?>">VIEW MORE</a></div>
				</div>
			</div>
		<?php endwhile; endif; ?>
		
	</div>
	<div class="row" style="display:none;" id="inifiniteLoader"><div class="col-12 text-center"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>" alt="" /></div></div>

</div>
<?php get_footer(); ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
	$(".banner_right").html('<?php echo $insight_cont; ?>');
	$("#inifiniteLoader").height($(window).height());
	var count = 2;
	var total = <?php echo $wp_query->max_num_pages; ?>;
	$(window).scroll(function(){
		var footerH = $("footer").height();
		if ($(window).scrollTop() + $(window).height()  >= $("footer").offset().top) {
		if (count > total){
			return false;
		}else{
			 loadArticle(count);
		}
		count++;
		}
	});

   function loadArticle(pageNumber){
     $('#inifiniteLoader').show();
     $.ajax({
       url: "<?php echo admin_url(); ?>admin-ajax.php",
       type:'POST',
       data: "action=infinite_scroll&page_no="+ pageNumber +"&cat_no=4",
       success: function (html) {
         $('#inifiniteLoader').hide();
         $("#nextFold").append(html);
       }
     });
     return false;
   }
  });  
</script>