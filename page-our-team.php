<?php 
/* Template Name: Our Team */
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$our_team_banner_image = get_field('our_team_banner_image');
$banner_content = get_field('banner_content');

function team_member($item){
$memeber ='<div class="col-12 col-md-3 my-3">';
$memeber .='<div class="flip-box ourTeam-flipBox"><div class="flip-box-inner">';
$memeber .='<div class="flip-box-front">';
	$memeber .='<figure><img src="'. $item ['our_team_profile_picture'].'" /></figure>';
	$memeber .='<h4>'. $item ['our_team_name'].'</h4><p>' . $item ['our_team_designation']. '</p>';
	if($item ['our_team_about_team'] !=''){
		$memeber .='<div>'. $item ['our_team_about_team'].'</div>';
	}
$memeber .='</div>';
$memeber .='<div class="flip-box-back">';
	if($item ['our_team_area_of_expertise'] !=''){
		$memeber .='<h5>Area of Expertise:</h5>';
		$memeber .='<p>'. $item ['our_team_area_of_expertise'].'</p>';
	}
	if($item ['our_team_previous_experience'] !=''){
		$memeber .='<h5>Previous Experience:</h5>';
		$memeber .='<p>'. $item ['our_team_previous_experience'].'</p>';
	}

	if($item['our_team_linkedin'] !=='' || $item['our_team_twitter'] !=='' || $item['our_team_facebook'] !==''){
		$memeber .='<ul class="socialLink">';
	}
		if($item['our_team_linkedin'] !==''){
			$memeber .= '<li><a href="'. $item['our_team_linkedin'].'" target="_blank"><i class="linkedIn"></i></a></li>';
		}
		if($item['our_team_twitter'] !==''){
			$memeber .= '<li><a href="'. $item['our_team_twitter'].'" target="_blank"><i class="twitter"></i></a></li>';
		}
		if($item['our_team_facebook'] !==''){
			$memeber .= '<li><a href="'. $item['our_team_facebook'].'" target="_blank"><i class="facebook"></i></a></li>';
		}

	if($item['our_team_linkedin'] !=='' || $item['our_team_twitter'] !=='' || $item['our_team_facebook'] !==''){
		$memeber .='</ul>';
	}
	
$memeber .='</div>';
$memeber .='</div></div></div>';
return $memeber;
}
?>
<div class="TemplateBanner temp_out_team" style="background-image: url('<?php echo $our_team_banner_image; ?>')">
	<div class="container banner_content">
		<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="50">
			<div class="col-12 col-md-10 text-center"><?php echo $banner_content;?></div>

			<?php
				if( have_rows('team_member') ): 
				$x = 0;
				foreach ( get_field("team_member") as $x  => $item  ) {
				if ($x == 4) break;
					echo team_member($item);					
				}
				endif;
			?>
		</div>
	</div>
</div>

<div class="container">
	<div class="row justify-content-center py-5" data-aos="fade-up" data-aos-delay="50">
		<?php
			if( have_rows('team_member') ): 
			foreach ( get_field("team_member") as $i  => $item  ) {
				if ($i > 3){
					echo team_member($item);
				}
		?>
				
		<?php
				}
			endif;
		?>
	</div>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>