<?php
wp_reset_postdata();
$animtionOption = get_field('polygon_animation', $post->ID);
// print_r($animtionOption);
if($animtionOption[0]) echo '<div class="left_aninamtion polygonizr"></div>';
if($animtionOption[1]) echo '<div class="right_aninamtion polygonizr"></div>';
?>