<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="theme-color" content="#ecce70">
    <meta name="msapplication-navbutton-color" content="#ecce70">
	<?php
		if ( is_singular() && pings_open() ) :
			printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
		endif;
	?>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<link rel="profile" href="https://gmpg.org/xfn/11" />	
<?php wp_head(); ?>
<script>
jQuery(document).ready(function($){
	<?php if (is_home() || is_front_page() || is_page_template('index.php')) { ?>
		$(document).on('click', '#primary-menu li.menuScroll a[href^="#"]', function (event) {
			var hash = this.hash;
			$('html, body').animate({
			scrollTop: $(hash).offset().top - 90
			}, 800);

		})


		if (window.location.hash) {
			var hash = window.location.hash;
			if ($(hash).length) {
				$('html, body').animate({
					scrollTop: $(hash).offset().top - 90
				}, 800);
			}
		}


	<?php }else{ ?>
			$("#primary-menu li.menuScroll a").attr("href", "<?php echo get_home_url(); ?>#about_us");
	<?php } ?>
})
</script>
</head>
<body <?php body_class(); ?>>
<?php

	$queried_object = get_queried_object(); 
	$taxonomy = $queried_object->taxonomy;
	$term_id = $queried_object->term_id;  	
	if(is_category()){
		$CarouselActive = get_field('active_carousel', $taxonomy . '_' . $term_id);
		$CarouselSlug = get_field('carousel_slug', $taxonomy . '_' . $term_id);
		$category_image_url = get_field('category_image', $taxonomy . '_' . $term_id);
		$category_banner_text = get_field('banner_text', $taxonomy . '_' . $term_id);
		$show_page_banner = get_field('show_page_banner', $taxonomy . '_' . $term_id);
	}else{
		$CarouselActive = get_field('active_carousel');
		$CarouselSlug = get_field('carousel_slug');
		$category_image_url = get_field('category_image');	
		$category_banner_text = get_field('banner_text');
		$show_page_banner = get_field('show_page_banner');
	}
	if($category_image_url ==''){
			$category_image_url = get_header_image();
    }
    
    
?>
<header>
<div class="container">
            <div class="logo"><?php the_custom_logo(); ?></div>
        <div class="menu-toggle">      
            <div class="line-one"></div>
            <div class="line-two"></div>
            <div class="line-three"></div>
        </div>
        <nav id="site-navigation" class="main-navigation clearfix">
            <?php  wp_nav_menu(array('theme_location' => 'top', 'container' => 'ul', 'menu_id' => 'primary-menu', 'menu_class' => 'menu nav-menu')); ?>
        </nav>
</header>
<?php 
if (is_home() || is_front_page() || is_page_template('index.php')) {  ?>
	<div class="HomeCarousel">
            <?php echo carouselLoop('home', 'home_hero'); ?>
    </div>
<?php } else{
	if($show_page_banner[0] == 'Yes'){

	if($CarouselActive[0] != 'Yes'){
		echo '<div class="InnerCarousel">';
        echo '<div class="banner_content">';
				if($category_banner_text){
					echo $category_banner_text;
				} else{
					echo '<h1>'. get_the_title() .'</h1>';
				}
        echo '</div>';
        echo '<figure style="background-image:url('. $category_image_url.')"> </figure>';
		echo '</div>';
	} else { 
		echo '<div class="HomeCarousel">';
		echo carouselLoop($CarouselSlug, 'home_hero'); 
		echo '</div>';
	 }
	} 
}  
?>