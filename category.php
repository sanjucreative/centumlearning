<?php get_header();
$category = get_queried_object();
$cat_id = $category->term_id;
?>

<?php /* <div class="breadcrumbs"><div class="container" data-aos="fade-right" data-aos-delay="50"><?php echo bcn_display(true) ?></div></div> */?>
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
	
	$("#inifiniteLoader").height($(window).height());
	var count = 2;
	var total = <?php echo $wp_query->max_num_pages; ?>;
	var catID = <?php echo $cat_id ?>;
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
       data: "action=infinite_scroll&page_no="+ pageNumber +"&cat_no=" + catID,
       success: function (html) {
         $('#inifiniteLoader').hide();
         $("#nextFold").append(html);
       }
     });
     return false;
   }
  });  
</script>