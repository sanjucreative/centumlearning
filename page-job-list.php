<?php 
/* Template Name: Job List */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$template_banner_content = get_field('template_banner_content');
$page_video_cover_image = get_field('page_video_cover_image');
$page_video_url = get_field('page_video_url');
$page_url = get_field('page_url');
$check_for_page_url = get_field('check_for_page_url');

$location_list = get_terms( array(
	'taxonomy' => 'locations',
	// 'hide_empty' => false,
) );

$department_list = get_terms( array(
	'taxonomy' => 'departments',
	// 'hide_empty' => false,
) );

$category_list = get_terms( array(
	'taxonomy' => 'job-categories',
	// 'hide_empty' => false,
) );
?>
<div class="TemplateBanner temp_job_list" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content pt-0 pt-md-5">
		<div class="row">
			<div class="col-12 col-lg-8 pr-3 pr-md-5" data-aos="fade-up" data-aos-delay="50">
				<?php echo $template_banner_content ?>
				<div class="row">
						<div class="col-12 col-md-4">
							<div class="filter_drop">
							<label>Choose Locations</label>
							<select class="form-control" id="job_location">
								<?php
								echo '<option value=" ">Select Locations</option>';
								foreach($location_list   as $key => $locations){
										echo '<option value="'. $locations->term_id.'">'. $locations->name . '</option>';
								}
								?>
							</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="filter_drop">
							<label>Choose Departments</label>
							<select class="form-control" id="job_department">
								<?php
								echo '<option value=" ">Select Department</option>';
								foreach($department_list   as $key => $department){
										echo '<option value="'. $department->term_id.'">'. $department->name . '</option>';
								}
								?>
							</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="filter_drop">
							<label>Choose Category</label>
							<select class="form-control" id="job_category">
								<?php
								echo '<option value=" ">Select Category</option>';
								foreach($category_list   as $key => $category){
										echo '<option value="'. $category->term_id.'">'. $category->name . '</option>';
								}
								?>
							</select>
							</div>
						</div>

						<div class="col-12 mt-4">
								<ul class="scrollspy_location">
									<li><a class="scrollspy" href="#open_job_opportunities"><i class="mc"><img src="<?php echo get_theme_file_uri( '/assets/images/icon-job.png')?>" alt=""></i> <span>View Opportunities</span></a></li>
								</ul>
						</div>
				</div>
			</div>
			<div class="col-12 col-lg-4" data-aos="fade-up" data-aos-delay="50">
				<div class="video_cont">
					<figure>
						<?php if($page_video_url !='' && $check_for_page_url[0] != 'Yes'){ 
							echo '<div class="video_play" data-url="'. $page_video_url.'"></div>';
						}
						if($check_for_page_url[0] == 'Yes'){
							echo '<a class="page_url" href="'. $page_url.'"></a>';
						}
						?>
						<img src="<?php echo $page_video_cover_image; ?>">
					</figure>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="animation_wrap">
	<div class="container" data-aos="fade-up" data-aos-delay="50" id="open_job_opportunities">
				<div class="row justify-content-center">
					<h2 class="col-12 text-center py-4">Browse Open Job Positions</h2>
				</div>
				<div class="row justify-content-center pb-5" id="job_opportunities_list">
				<?php
				$jobOpening_args = array('post_type' => 'job', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC');
				$jobOpening = new WP_Query($jobOpening_args);
				
				if ($jobOpening->have_posts()) :  while ( $jobOpening->have_posts() ) : $jobOpening->the_post();
				?>
				<div class="col-12 col-md-3 mb-4">
					<div class="jobList_wrap">
						<h4><?php the_title();?></h4>
						<div class="opeing_date"><?php echo 'Opening Till - ' .get_field('job_opening_closed'); ?></div>
						<hr/>
						<ul>
								<?php
									$location_list = get_the_terms( $post->ID, 'locations' );
									if(!empty($location_list)){
										echo '<li>';
											array_list_item($location_list);
										echo '</li>';
									}

									$department_list = get_the_terms( $post->ID, 'departments' );
									if(!empty($department_list)){
										echo '<li>';
											array_list_item($department_list);
										echo '</li>';
									}

									$category_list = get_the_terms( $post->ID, 'job-categories' );
									if(!empty($category_list)){
										echo '<li>';
											array_list_item($category_list);
										echo '</li>';
									}
								?>
								
						</ul>
						<div class="applynow_btn"><a href="<?php the_permalink(); ?>" class="btn btn-primary">Apply Now</a></div>
					</div>
				</div>
				<?php endwhile;  endif; ?>
				</div>
				
			</div>

			
	</div>
	<?php include('polygonizr-animation-left.php'); ?>
</div>


<div class="video_modal">
    <div class="closed"></div>
    <div class="modal_container">
        <div class="videoWrapper">
                <iframe id="iframe_video" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen"></iframe>
        </div>
    </div>
</div>
<?php endwhile; endif; ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $( '.filter_drop select' ).on('change', function() {

        var job_location = $("#job_location option:selected").val();
		var job_department = $("#job_department option:selected").val();
		var job_category = $("#job_category option:selected").val();

		$("#job_opportunities_list").html('<div class="loader"><img src="<?php echo get_theme_file_uri( '/assets/images/loader.svg')?>"></div>');
		
			$.ajax({
				type: 'POST',  
				url: '<?php echo admin_url('admin-ajax.php');?>',
				data: {
					'action':'get_job_opportunities',
					'location' : job_location,
					'department' : job_department,
					'category' : job_category
				},
				success:function(data) {
					$("#job_opportunities_list").html(data);
				},

				error: function(errorThrown){
					$("#job_opportunities_list").html('<p>Job Opportunity Not Found</p>');
				}
			});
    });

  });  

</script>
<?php get_footer(); ?>