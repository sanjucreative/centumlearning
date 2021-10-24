<?php 
/* Template Name: Corporate Training Solutions */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$template_banner_content = get_field('template_banner_content');
$page_id = get_the_ID();
?>
<div class="TemplateBanner temp_CTS" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content" data-aos="fade-up" data-aos-delay="50">
		<div class="row">
			<div class="col-12 col-lg-6 pr-0 pr-lg-3" data-aos="fade-up" data-aos-delay="50">
				<?php echo $template_banner_content ?>
			</div>
			<div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
					<?php echo solutionGridLayout($page_id);?>
			</div>
		</div>
	</div>
	<a class="nextFold scrollspy" href="#nextFold"></a>
</div>

<div class="animation_wrap">
	<div class="container" id="nextFold">
		<?php include('trustedby.php'); ?>
		<?php include('awards.php'); ?>
		<?php include('client-speak.php'); ?>
		<?php include('polygonizr-animation.php'); ?>
	</div>
</div>
<?php 
endwhile; endif; ?>
<?php get_footer(); ?>
<?php /*
<script>
jQuery(document).ready(function($){
	var index = 0;
	var myVar = setInterval(myTimer, 6000);
	var boxSize = $(".CTS_page_list_wrap .CTS_page_child_content").length;
	function myTimer() {
		$(".CTS_page_list_wrap .CTS_page_child_content").removeClass("active");
		$(".CTS_page_list_wrap .CTS_page_child_content").eq(index).addClass('active');

		index++;
		if(index == boxSize){
			index = 0;
		}
	}
})
</script>
*/
?>