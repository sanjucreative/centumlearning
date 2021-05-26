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
<?php wp_footer();  ?> 
<script>
        setTimeout(function () {
            AOS.init({
                duration: 800,
                easing: "ease-in-out"
            })

        }, 800);
    </script>
</body>