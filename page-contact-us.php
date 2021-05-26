<?php 
/* Template Name: Contact Us */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$contact_page_banner_image = get_field('contact_page_banner_image');
$contact_banner_content = get_field('contact_banner_content');
$contact_banner_form = get_field('contact_banner_form');

?>
<div class="TemplateBanner temp_contact_us" style="background-image: url('<?php echo $contact_page_banner_image; ?>')">
	<div class="container">
		<div class="row banner_content pt-0 pt-md-5">
			<div class="col-12 col-md-5 pr-0 pr-md-5" data-aos="fade-up" data-aos-delay="50">
				<?php echo $contact_banner_content ?>

				<ul class="scrollspy_location">
				<?php
				if( have_rows('contact_locations') ): 
					foreach ( get_field("contact_locations") as $item  ) {
						$location = $item['contact_location_office_for'];
				?>
					<li><a class="scrollspy" data-offset-top="200" href="#<?php echo $location; ?>_location"><i></i> <span><?php echo $location; ?> Locations</span></a></li>
				<?php
					}
				endif;
				?>
				</ul>
			</div>
			<div class="col-12 col-md-7" data-aos="fade-up" data-aos-delay="50">
				<div class="form_wrap">
				<?php echo $contact_banner_form ?>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="animation_wrap">
	<div class="container mb-5 contact_us">
			<?php
				if( have_rows('contact_locations') ): 
				foreach ( get_field("contact_locations") as $i => $item  ) {
			?>
				<div class="row mt-5" data-aos="fade-up" data-aos-delay="50">
					
					<div class="col-12 col-md-6 pr-0 pr-md-5" id="<?php echo $item['contact_location_office_for'];?>_location">
						<h3><?php echo $item['contact_location_office_for'];?></h3>
						<?php echo $item['contact_corporate_office']; ?>
					</div>
					<div class="col-12 col-md-6"><?php echo $item['office_map']; ?></div>
				</div>

				<div class="row" data-aos="fade-up" data-aos-delay="50">
				
				<?php 
						if($i == 0){
							echo '<h3 class="col-12 mb-2 mt-4">Other Offices</h3>';
						}else{
							echo '<h3 class="col-12 mb-2 mt-4">Other Location</h3>';
						}
						if(!empty($item['other_loctions'])):
							foreach (  $item['other_loctions'] as $j => $location  ) {
								 echo '<div class="col-12 col-md-4 mb-3"><div class="location_box">';
								 echo $location['office_addres'];
								 if ($location['office_map'] !=''){
									echo '<div class="map_location_btn" ><a href="javascript:void(0)" data-post-id="'. $post->ID .'" data-map-meta="contact_locations_'. $i .'_other_loctions_'. $j .'_office_map" data-toggle="modal" data-target="#location_map_modal">MAP LOCATION</a></div>';
								 }
								echo '</div></div>';
							}
						endif;	
					?>
				</div>
			<?php
					}
				endif;
			?>
		
		<?php include('polygonizr-animation-left.php'); ?>
	</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="location_map_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
		<div class="modal-body">
				<div class="loader"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>"></div>
		</div>
    </div>
  </div>
</div>

<?php endwhile; endif; ?>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $( '.map_location_btn a' ).on('click', function() {
        var Post_id = $(this).data('post-id');
		var Map_meta = $(this).data('map-meta');
          
			$.ajax({
				type: 'POST',  
				url: '<?php echo admin_url('admin-ajax.php');?>',
				data: {
					'action':'get_location_map',
					'Post_id' : Post_id,
					'Map_meta' : Map_meta
				},
				success:function(data) {
					$("#location_map_modal .modal-body").html(data);
				},

				error: function(errorThrown){
						$("#location_map_modal .modal-body").html('<p>Map Not Found</p>');
				}
			});
    });

	$('#location_map_modal .close').on('click', function() {
		$("#location_map_modal .modal-body").html('<div class="loader"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>"></div>');
	})


  });  

</script>

<?php get_footer(); ?>