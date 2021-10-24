<?php 
/* Template Name: Solutions Page */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$template_banner_image = get_field('template_banner_image');
$template_banner_content = get_field('template_banner_content');
$page_video_cover_image = get_field('page_video_cover_image');
$page_video_url = get_field('page_video_url');
$page_url = get_field('page_url');
$check_for_page_url = get_field('check_for_page_url');
if($template_banner_image ==''){
	$template_banner_image = get_theme_file_uri('/assets/images/solutions_banner_bg.jpg');
}
$page_id = get_the_ID();
?>
<div class="TemplateBanner temp_CTS" style="background-image: url('<?php echo $template_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row">
			<div class="col-12 col-lg-6 pr-3 pr-lg-5" data-aos="fade-up" data-aos-delay="50">
				<?php echo $template_banner_content ?>
			</div>
			<div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
			<?php if($page_video_cover_image){ ?>
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
				<?php } else{
					echo solutionGridLayout($page_id);
				}
			?>
			</div>
		</div>
	</div>
	<a class="nextFold scrollspy" href="#nextFold"></a>
</div>
<div class="animation_wrap">
	<?php
		if( have_rows('content_row') ): 
		foreach ( get_field("content_row")  as $i => $item  ) {
			echo '<div class="section_content2" data-aos="fade-up" data-aos-delay="50" id="solution_'. $i .'"><div class="container">';
			echo '<div id="nextFold" class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">';
			if($item['heading'] !=''){
				echo '<h2 class="col-12 text-center my-3 section-heading" id="section_heading_'. $i .'">'. $item['heading'] .'</h2>';
			}
			echo '<div class="col-12 mb-5">'. wpautop($item['content']) .'</div>';
			echo '</div></div>';
			echo '</div>';
			}
		endif;
	?>
	<div class="section_content2" data-aos="fade-up" data-aos-delay="50">
		<div class="container"><?php include('client-speak.php'); ?></div>
	</div>
	<div class="section_content2" data-aos="fade-up" data-aos-delay="50">
		<div class="container"><?php include('case-studies.php'); ?></div>	
	</div>
	<?php include('polygonizr-animation.php'); ?>
</div>
</div>

<div class="video_modal">
    <div class="closed"></div>
    <div class="modal_container">
        <div class="videoWrapper">
                <iframe id="iframe_video" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen"></iframe>
        </div>
    </div>
</div>




<div class="col-12">
			<?php
		 	$selected_infographic = get_field('infographic_select_option');
			$infographic = '';
			$infographic .= '<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">';


			// For Inforgraphic Arrow 
			if($selected_infographic == 'Arrow'){
				$infographic .= '<div class="col-12 text-center"><ul class="infographic_arrow">';
				if( have_rows('Infographics_item_content') ): 
					foreach ( get_field("Infographics_item_content") as $i => $item  ) {
						if($item["Infographics_excerpt"] ==''){
							$infographic .= '<li class="empty"></li>';
						}else{
							$infographic .= '<li><div class="arrow_excerpt"><div>' . str_replace("\n", "",  wpautop($item["Infographics_excerpt"])) .'</div></div></li>';
						}
					}
				endif;
				$infographic .= '</ul></div>';
			}

			// For Inforgraphic Line 
			if($selected_infographic == 'Line'){
				$infographic .= '<div class="col-12 text-center"><ul class="infographic_line">';
				if( have_rows('Infographics_item_content') ): 
					foreach ( get_field("Infographics_item_content") as $i => $item  ) {
						$infographic .= '<li><div>' . str_replace("\n", "",  wpautop($item["Infographics_excerpt"])) .'</div></li>';
					}
				endif;
				$infographic .= '</ul></div>';
			}
			
			// For Inforgraphic Circle 
			if($selected_infographic == 'Circle'){
				$infographic .= '<div class="col-12 text-center"><ul class="infographic_circle">';
					if( have_rows('Infographics_item_content') ): 
					foreach ( get_field("Infographics_item_content") as $i => $item  ) {
						$infographic .= '<li><div class="circle_excerpt"><div>' . str_replace("\n", "",  wpautop($item["Infographics_excerpt"])) .'</div></div></li>';
					}
					endif;
				$infographic .= '</ul></div>';
			}

			// For Inforgraphic Circle Wave 
			if($selected_infographic == 'Circle Wave'){
				$infographic .= '<div class="col-12 text-center"><ul class="infographic_circle_wave">';
					if( have_rows('Infographics_circle_wave') ): 
					foreach ( get_field("Infographics_circle_wave") as $i => $item  ) {
						$infographic .= '<li><div class="follow_circle">';
						$infographic .=  '<div class="follow_heading"><figure><img class="img-fluid" src="'. $item['circle_wave_icon'] . '" alt="'. $item['circle_wave_label'].'" /></figure>';
						$infographic .=  '<span>' . $item['circle_wave_label'] .'</span></div>';
						$infographic .=  '<div class="follow_excerpt">' . str_replace("\n", "",  wpautop($item["circle_wave_excerpt"])) .'</div>';
						$infographic .=  '</div></li>';
					}
					endif;
				$infographic .= '</ul></div>';
			}

			// For Inforgraphic Column 
			if($selected_infographic == 'Column'){
				if( have_rows('Infographics_column') ): 
					foreach ( get_field("Infographics_column") as $i => $item  ) {
						$col_no = count(get_field("Infographics_column"));
						$col = 'col-md-6 col-xl-6';
						if($col_no > 1 && $col_no <=3){
							$col = 'col-md-6 col-xl-4';
						}
						if($col_no > 3){
							$col = 'col-md-6 col-xl-3';
						}
						
						$infographic .= '<div class="col-12 '. $col .' my-3"><div class="card col_wrap">';
						if($item['Infographics_column_heading'] !=''){
							$infographic .= '<div class="card-heading">';
								if($item['Infographics_column_icon'] !=''){
									$infographic .= '<figure><img src="'. $item['Infographics_column_icon'] .'" alt="icon" /></figure>';
								}
								$infographic .= '<h4>' . $item['Infographics_column_heading'] .'</h4></div>';
						}
							$infographic .= '<div class="card-body">'.  str_replace("\n", "",  $item['Infographics_column_content']) .'</div>';
						$infographic .= '</div></div>';
						}
					
					endif;

			}
			// For Inforgraphic Table 
			if($selected_infographic == 'Table'){
				
				$table = get_field( 'Infographics_table' );
				if ( ! empty ( $table ) ) {
					echo $col_no = count( $table['header']);
					$col = 'col-md-8 col-xl-6';
					if($col_no > 1 && $col_no <=2){
						$col = 'col-md-10 col-xl-9';
					}
					if($col_no > 2 && $col_no <=3){
						$col = 'col-md-12 col-xl-10';
					}
					if($col_no > 3){
						$col = '';
					}

					$infographic .= '<div class="col-12 '. $col.' table_responsive"><table border="0" width="100%">';
						if ( ! empty( $table['caption'] ) ) {
							$infographic .= '<caption>' . $table['caption'] . '</caption>';
						}

						if ( ! empty( $table['header'] ) ) {
							$infographic .= '<thead><tr>';
									foreach ( $table['header'] as $th ) {
										$infographic .= '<th>'.  $th['c'] . '</th>';
									}
							$infographic .= '</tr></thead>';
						}

						$infographic .= '<tbody>';
							foreach ( $table['body'] as $tr ) {
								$infographic .= '<tr>';
									foreach ( $tr as $td ) {
										$infographic .= '<td>'. $td['c'] .'</td>';
									}
								$infographic .= '</tr>';
							}

					$infographic .= '</tbody>';
					$infographic .= '</table></div>';
				}
			}
			$infographic .= '</div>';
		?>	
</div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
		$("#infographic").html('<?php echo $infographic; ?>');
  });  

</script>