<?php 
/* Template Name: Media */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$media_banner_image = get_field('media_banner_image');
$media_banner_left_side = get_field('media_banner_left_side');
$media_banner_right_side = get_field('media_banner_right_side');

?>
<div class="TemplateBanner temp_media" style="background-image: url('<?php echo $media_banner_image; ?>')">
	<div class="container">
		<div class="row banner_content">
			<div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
				<?php echo $media_banner_left_side ?>

				<ul class="scrollspy_location">
					<li><a class="scrollspy" data-offset-top="200" href="#media_coverage"><i class="mc"><img src="<?php echo get_theme_file_uri( '/assets/images/ic-media-coverage.svg')?>" alt="" /></i> <span>Media Coverage</span></a></li>
					<li><a class="scrollspy" data-offset-top="200" href="#Press_release"><i><img src="<?php echo get_theme_file_uri( '/assets/images/ic-news.svg')?>" alt="" /></i> <span>Press Releases</span></a></li>

				</ul>
			</div>
			<div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
				<div class="contact_info">
				<?php echo $media_banner_right_side ?>
				</div>
			</div>
		</div>
	</div>
	<a class="nextFold scrollspy" href="#nextFold"></a>
</div>


<div class="animation_wrap">
	<div class="container mb-5">
			<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
					<div class="col-12 col-md-10 py-5 text-center" id="nextFold">
						<p><?php echo get_field("media_content_excerpt");?></p> 
						<div class="more_content"><p><?php echo get_field("media_content_excerpt_read_more");?></p></div>
            			<a class="readmore" href="#">View More</a>
					</div>
			</div>

			<div class="row media_wrap" data-aos="fade-up" data-aos-delay="50" id="media_coverage">
				<h2 class="col-12 text-center">Media Coverage</h2>

				<?php /*
				<ul class="media_year_list news_year col-12">
					<?php
						foreach ( get_posts_years_array('news', 5) as $i => $year  ) {
					?>
						<li>
							<a data-type="news" data-container="news_content" href="#" class="<?php if($i == 0) echo 'active'; ?>"><?php echo $year;?></a>
						</li>
					<?php
						}
					?>
						<li><a data-type="news" data-container="news_content" href="#">Archived</a></li>
				</ul>
				*/?>
				<div class="media-tab-container col-12" id="news_content">
					<div class="loader"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>"></div>
				</div>
			</div>


			<div class="row media_wrap" data-aos="fade-up" data-aos-delay="50" id="Press_release">
				<h2 class="col-12 text-center mt-4">Press Releases</h2>
				<?php /*
				<ul class="media_year_list pressRelease_year col-12">
					<?php
						foreach ( get_posts_years_array('press-releases', 5) as $i => $year  ) {
					?>
						<li>
							<a data-type="press-releases" data-container="press_releases_content" href="#" class="<?php if($i == 0) echo 'active'; ?>"><?php echo $year;?></a>
						</li>
					<?php
						}
					?>
						<li><a data-type="press-releases" data-container="press_releases_content" href="#">Archived</a></li>
				</ul>
				*/ ?>
				<div class="media-tab-container col-12" id="press_releases_content">
					<div class="loader"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>"></div>
				</div>
			</div>

			<div class="row justify-content-center media_wrap" data-aos="fade-up" data-aos-delay="50">
				<h2 class="col-12 text-center">Download Logos</h2>
				<div class="col-6 col-md download_logo">
					<img src="<?php echo get_theme_file_uri( '/download/1/1.jpg')?>" alt="Centum Learning" title="Centum Learning" class="img-fluid">
					<h5>Download on Click</h5>
					<p>
						<a href="<?php echo get_theme_file_uri( '/download/1/CL_logo.cdr')?>">CDR Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/1/CL_logo.eps')?>">EPS Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/1/CL_logo.jpg')?>">JPG Format</a>
					</p>
				</div>
				<div class="col-6 col-md download_logo">
					<img src="<?php echo get_theme_file_uri( '/download/2/2.jpg')?>" alt="Centum Learn Pro" title="Centum Learn Pro" class="img-fluid">
					<h5>Download on Click</h5>
					<p>
						<a href="<?php echo get_theme_file_uri( '/download/2/CL_logo.cdr')?>">CDR Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/2/CL_logo.eps')?>">EPS Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/2/CL_logo.jpg')?>">JPG Format</a>
					</p>
				</div>
				<div class="col-6 col-md download_logo">
					<img src="<?php echo get_theme_file_uri( '/download/3/3.jpg')?>" alt="Centum Work Skills" title="Centum Work Skills" class="img-fluid">
					<h5>Download on Click</h5>
					<p>
						<a href="<?php echo get_theme_file_uri( '/download/3/CL_logo.cdr')?>">CDR Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/3/CL_logo.eps')?>">EPS Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/3/CL_logo.jpg')?>">JPG Format</a>
					</p>
				</div>
				<div class="col-6 col-md download_logo">
					<img src="<?php echo get_theme_file_uri( '/download/4/4.jpg')?>" alt="Centum Foundation" title="Centum Foundation" class="img-fluid">
					<h5>Download on Click</h5>
					<p>
						<a href="<?php echo get_theme_file_uri( '/download/4/CL_logo.cdr')?>">CDR Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/4/CL_logo.eps')?>">EPS Format</a> |
						<a href="<?php echo get_theme_file_uri( '/download/4/CL_logo.jpg')?>">JPG Format</a>
					</p>
				</div>

			</div>

		
		<?php include('polygonizr-animation.php'); ?>
	</div>
</div>

<?php endwhile; endif; ?>

<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.js')?>"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo get_theme_file_uri( '/assets/plugins/fancybox/jquery.fancybox.min.css')?>" />
<script type="text/javascript">
  jQuery(document).ready(function($) {

// For News	
	var start_news_year = $("ul.news_year li:first-child a").text();
	var show_news_container = 'news_content';
	loadData('news', start_news_year, show_news_container, '');

// For Press Releases	
var start_press_year = $("ul.pressRelease_year li:first-child a").text();
	var show_press_container = 'press_releases_content';
	loadData('press-releases', start_press_year, show_press_container, '');
	
	
    $( 'ul.media_year_list li a' ).on('click', function(e) {
		e.preventDefault();
		$(this).parents('ul').find('li a').removeClass("active");
		$(this).addClass("active");

        var post_type = $(this).data('type');
		var post_year = $(this).text();
		var archive_before_year = $(this).parents('ul').find('li').last().prev().find('a').text();
		var container = $(this).data('container');
		loadData(post_type, post_year, container, archive_before_year);
    });

	function loadData(post_type, post_year, container, archive_before_year){
		$("#" +  container).html('<div class="loader"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>"></div>');
		$.ajax({
				type: 'POST',  
				url: '<?php echo admin_url('admin-ajax.php');?>',
				data: {
					'action':'load_post_type_media',
					'post_type' : post_type,
					'post_year' : post_year,
					'archive_before_year' : archive_before_year
				},
				success:function(data) {
					$("#" +  container).html(data);
					$("#" +  container).find('.media').slick({
						slidesToShow: 4,
						slidesToScroll: 4,
						infinite: false,
						arrows: false,
						dots: true,
						autoplay: false,
						speed: 1000,
						responsive: [{
							breakpoint: 992,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 3,
							}
							},{
								breakpoint: 800,
								settings: {
								slidesToShow: 2,
								slidesToScroll: 2,
								}
							},{
								breakpoint: 640,
								settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
								}
							}]
					})
					
						$("#" +  container + " .view_featured").fancybox();

					
				},
				error: function(errorThrown){
					$("#" +  container).html('<p>Data Not Found</p>');
				}
			});
	}



  });  

</script>
<?php get_footer(); ?>