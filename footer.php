<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 footer_address" data-aos="fade-up" data-aos-delay="50">
                <div class="footer_logo"><img src="<?php echo get_theme_file_uri( '/assets/images/footer-logo.png')?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></div>
                <?php if (is_active_sidebar('footer_address' )) dynamic_sidebar( 'footer_address' ); ?>            
            </div>
            <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="50"><?php if (is_active_sidebar('footer_links' )) dynamic_sidebar( 'footer_links' ); ?></div>
            <div class="col-12 col-sm-6 col-md-4 get_in_touch" data-aos="fade-up" data-aos-delay="50">
                <?php if (is_active_sidebar('footer_get_in_touch' )) dynamic_sidebar( 'footer_get_in_touch' ); ?>
                <ul class="socialmedia">
                    <?php 
                    if (get_theme_option('linkedin')) echo '<li><a href="'. get_theme_option('linkedin'). '" target="_blank"><i class="c_icon linkedIn"></i></a>';

                    if (get_theme_option('facebook')) echo '<li><a href="'. get_theme_option('facebook'). '" target="_blank"><i class="c_icon facebook"></i></a></li>'; 

                    if (get_theme_option('twitter')) echo '<li><a href="'. get_theme_option('twitter'). '" target="_blank"><i class="c_icon twitter"></i></a>';                    

                    if (get_theme_option('youtube')) echo '<li><a href="'. get_theme_option('youtube'). '" target="_blank"><i class="c_icon youtube"></i></a>';
                    ?>
                </ul>
            </div>           
        </div>



    </div>
</footer>
<div class="copyright">
            <div class="container">
            <div class="row">    
                <div class="col-12">
                    &copy <?php echo date('Y'); ?> Centum Learning Limited. All rights reserved. <ul class="copyrights_nav"> <?php copyrights_nav(); ?></ul>
                </div>
            </div>
            </div>
</div>
<a id="top-link" href="#top"></a>
<div class="contact_us_btn"><a href="<?php echo get_permalink( get_page_by_path('contact-us')); ?>"></a></div>

<?php wp_footer();  ?> 
<script>
jQuery(document).ready(function($){
    let $sitelading = $('.polygonizr');
    $sitelading.polygonizr({
            canvasWidth: '250',
            canvasHeight: $('.polygonizr').height(),
            // duration: 10,
            // nodeMovementDistance: 10,
            // numberOfNodes: 1,
            // numberOfUnconnectedNode: 25,
            nodeDotColor:"8, 8, 8",
            nodeLineColor:"4, 4, 4",
            nodeFillColor:"4, 4, 4",
    });

});

setTimeout(function () {
	AOS.init({
		duration: 800,
		easing: "ease-in-out"
	})

}, 800);
</script>
<?php
    echo get_theme_option('footer_script');
	$queried_object = get_queried_object(); 
	$taxonomy = $queried_object->taxonomy;
	$term_id = $queried_object->term_id;  	
	if(is_category()){
		echo get_field('page_footer_script_and_style', $taxonomy . '_' . $term_id);
	}else{
		echo get_field('page_footer_script_and_style');
	}


    $arr_cookie_options = array ('path' => '/', 'domain' => 'localhost',  'secure' => true, 'httponly' => true,);
    setcookie('cookielawinfo', 'A', $arr_cookie_options);   

?>
</body>