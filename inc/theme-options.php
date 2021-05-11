<?php
// add a new logo to the login page
function admin_login_logo() {
$custom_logo_id = get_theme_mod('custom_logo');
$custom_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
if($custom_logo[0] !=''){
//	echo '<style>.login #login h1 a {background-image: url(' . $custom_logo[0] . '); background-size: 100% auto;}</style>';
	}
echo '<style>.login #login h1 a {background-image: url(' . get_theme_file_uri('/assets/images/centum_logo.png' ) . '); background-size: 100% auto;}</style>';
	?>
<style type="text/css">
body{background:#fff!important}
#login{padding:5% 0 0!important}
.login #login h1 a {width:160px; height:90px; margin:0 auto!important}
.login form{background:rgba(48, 91, 222,0.1)!important; padding:20px 25px 25px!important; border:solid 1px rgba(85, 128, 255, 0.5); margin-top: 5px!important }
.login label{color:#14584b!important; font-size:16px!important}
.login form .input, .login form input[type="checkbox"], .login input[type="text"]{background:#fff; border:solid 1px rgba(85, 128, 255, 0.5);}
.login #backtoblog a:focus, .login #nav a:focus, .login h1 a:focus{box-shadow:none}
.login #login_error { background: rgba(220, 50, 50, 0.15)!important;}
.login form input[type="submit"]{ background:#156ac4!important; border-color:#0d477b !important; box-shadow: 0 1px 0 rgba(20, 81, 196, 0.5) inset!important; font-size:15px!important}
.login form input[type="submit"]:hover{ background:#0b4196!important; border-color:#082b58!important; box-shadow: 0 1px 0 rgba(20, 81, 196, 0.8) inset!important}
#backtoblog{display:none!important}
.wp-core-ui .button-primary{text-shadow: 0 1px 1px #333!important}
</style>
<?php }
	add_action( 'login_enqueue_scripts', 'admin_login_logo' );	
		function admin_login_logo_url() {
			return get_bloginfo( 'url' );
		}
	add_filter( 'login_headerurl', 'admin_login_logo_url' );
		function admin_login_logo_url_title() {  
			return get_bloginfo('name');
		}
	add_filter( 'login_headertitle', 'admin_login_logo_url_title' );
		function remove_lostpassword_text ( $text ) {
			if ($text == 'Lost your password?'){$text = '';}
			return $text;
		}
	add_filter( 'gettext', 'remove_lostpassword_text' );


function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );



// Banner
add_action('init', 'banner_register');
function banner_register() {
	$labels = array(
		'name' => _x('Carousal', 'post type general name'),
		'singular_name' => _x('Carousal', 'post type singular name'),
		'add_new' => _x('Add New Slider', 'Sliders'),
		'add_new_item' => __('Add New Slider'),
		'edit_item' => __('Edit Slider'),
		'new_item' => __('New Slider'),
		'view_item' => __('View Slider'),
		'search_items' => __('Search Slider'),
		'all_items' => __( 'All Sliders' ),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
	    'menu_name' => 'Carousal'
);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('with_front' => false),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => true,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title', 'thumbnail', 'editor')				
  ); 


register_post_type("banner" , $args );
register_taxonomy("slider", array("banner"), array("hierarchical" => true, "label" => "Carousal Group", "singular_label" => "Carousal Group", "rewrite" => true, ));


add_filter('manage_banner_posts_columns', 'banner_posts_columns');
function banner_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Slider Image');
    $defaults['category_group'] = __('Carousal Slug');	
    return $defaults;
}

add_filter('manage_banner_posts_columns', 'banner_columns_head');  

function banner_columns_head($defaults){  
    $new = array();
    $tags = $defaults['category_group'];  
    foreach($defaults as $key=>$value){
        if($key=='date') {  
		   $new['post_thumbs'] = $tags;
           $new['category_group'] = $tags;			   
        }    
       $new[$key]=$value;
    }  
   return $new;  
} 

add_action('manage_banner_posts_custom_column', 'banner_posts_custom_columns', 10, 2);
function banner_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="80" height="45" alt="" />';
        else
           echo "N/A";
    }
	
    if($column_name === 'category_group'){		
	$term_list = wp_get_post_terms($post_id, 'slider', array("fields" => "all"));
		foreach( $term_list as $thisslug ) {
			echo $thisslug->slug . ', ';
	}
	}
}

}

// Company 
add_action('init', 'company_logo_register');
function company_logo_register() {
	$labels = array(
		'name' => _x('Awards Support', 'post type general name'),
		'singular_name' => _x('Awards Support', 'post type singular name'),
		'add_new' => _x('Add New Awards', 'Awards'),
		'add_new_item' => __('Add New Awards'),
		'edit_item' => __('Edit Awards Support'),
		'new_item' => __('New Awards'),
		'view_item' => __('View Awards'),
		'search_items' => __('Search Awards'),
		'all_items' => __( 'All Awards Support' ),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
//	    'menu_name' => 'Media Center'
);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('with_front' => false),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => true,
		'menu_icon' => 'dashicons-shield',
		'supports' => array( 'title', 'thumbnail')	
); 

register_post_type("company_logo" , $args);


add_filter('manage_company_logo_posts_columns', 'company_logo_posts_columns');
function company_logo_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Logo');
    return $defaults;
}

add_filter('manage_company_logo_posts_columns', 'award_columns_head');  

function award_columns_head($defaults){  
    $new = array();
    $tags = $defaults['category_group'];  
    foreach($defaults as $key=>$value){
        if($key=='date') {  
		   $new['post_thumbs'] = $tags;		   
        }    
       $new[$key]=$value;
    }  
   return $new;  
} 

add_action('manage_company_logo_posts_custom_column', 'company_logo_posts_custom_columns', 10, 2);
function company_logo_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="" height="45" alt="" />';
        else
           echo "N/A";
    }
}



}


// Employes Testimonials
add_action('init', 'testimonials_register');
function testimonials_register() {
	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonials', 'post type singular name'),
		'add_new' => _x('Add New Testimonial', 'Testimonials'),
		'add_new_item' => __('Add New Testimonials'),
		'edit_item' => __('Edit Testimonials'),
		'new_item' => __('New Testimonials'),
		'view_item' => __('View Testimonials'),
		'search_items' => __('Search Testimonials'),
		'all_items' => __( 'All Testimonials' ),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
//	    'menu_name' => 'Media Center'
);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('with_front' => false),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => true,
		'menu_icon' => 'dashicons-testimonial',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')	
); 

register_post_type("testimonials" , $args);

add_filter('manage_testimonials_posts_columns', 'testimonials_posts_columns');
function testimonials_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Picture');
    return $defaults;
}

add_filter('manage_testimonials_posts_columns', 'testimonials_columns_head');  

function testimonials_columns_head($defaults){  
    $new = array();
    $tags = $defaults['category_group'];  
    foreach($defaults as $key=>$value){
        if($key=='date') {  
		   $new['post_thumbs'] = $tags;		   
        }    
       $new[$key]=$value;
    }  
   return $new;  
} 

add_action('manage_testimonials_posts_custom_column', 'testimonials_posts_custom_columns', 10, 2);
function testimonials_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="45" height="45" alt="" />';
        else
           echo "N/A";
    }
}


}

// News
add_action('init', 'news_register');
function news_register() {
	$labels = array(
		'name' => _x('News', 'post type general name'),
		'singular_name' => _x('News', 'post type singular name'),
		'add_new' => _x('Add New News', 'News'),
		'add_new_item' => __('Add New News'),
		'edit_item' => __('Edit News'),
		'new_item' => __('New News'),
		'view_item' => __('View News'),
		'search_items' => __('Search News'),
		'all_items' => __('All News'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
//	    'menu_name' => 'Media Center'
);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('with_front' => false),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => true,
		'menu_icon' => 'dashicons-lightbulb',
		'supports' => array( 'title', 'editor', 'thumbnail')		
); 

register_post_type("news" , $args);


add_filter('manage_news_posts_columns', 'news_posts_columns');
function news_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Logo');
    return $defaults;
}

add_filter('manage_news_posts_columns', 'news_columns_head');  

function news_columns_head($defaults){  
    $new = array();
    $tags = $defaults['category_group'];  
    foreach($defaults as $key=>$value){
        if($key=='date') {  
		   $new['post_thumbs'] = $tags;		   
        }    
       $new[$key]=$value;
    }  
   return $new;  
} 

add_action('manage_news_posts_custom_column', 'news_posts_custom_columns', 10, 2);
function news_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="" height="45" alt="" />';
        else
           echo "N/A";
    }
}


}

// Press Releases
add_action('init', 'press_releases_register');
function press_releases_register() {
	$labels = array(
		'name' => _x('Press Releases', 'post type general name'),
		'singular_name' => _x('Press Releases', 'post type singular name'),
		'add_new' => _x('Add New Press Releases', 'Press Releases'),
		'add_new_item' => __('Add New Press Releases'),
		'edit_item' => __('Edit Press Releases'),
		'new_item' => __('New Press Releases'),
		'view_item' => __('View Press Releases'),
		'search_items' => __('Search Press Releases'),
		'all_items' => __('All Press Releases'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
//	    'menu_name' => 'Media Center'
);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('with_front' => false),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => true,
		'menu_icon' => 'dashicons-megaphone',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')	
); 

register_post_type("press-releases" , $args);
}

// Leadership Team 
add_action('init', 'leadership_register');
function leadership_register() {
	$labels = array(
		'name' => _x('Leadership Team', 'post type general name'),
		'singular_name' => _x('Leadership Team', 'post type singular name'),
		'add_new' => _x('Add New Leadership', 'Leadership'),
		'add_new_item' => __('Add New Leadership'),
		'edit_item' => __('Edit Leadership Team'),
		'new_item' => __('New Leadership'),
		'view_item' => __('View Leadership'),
		'search_items' => __('Search Leadership'),
		'all_items' => __( 'All Leadership Team' ),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
//	    'menu_name' => 'Media Center'
);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('with_front' => false),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => true,
		'menu_icon' => 'dashicons-businessman',
		'supports' => array( 'title', 'thumbnail')	
); 

register_post_type("leadership" , $args);



add_filter('manage_leadership_posts_columns', 'leadership_posts_columns');
function leadership_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Logo');
    return $defaults;
}

add_filter('manage_leadership_posts_columns', 'leadership_columns_head');  

function leadership_columns_head($defaults){  
    $new = array();
    $tags = $defaults['category_group'];  
    foreach($defaults as $key=>$value){
        if($key=='date') {  
		   $new['post_thumbs'] = $tags;		   
        }    
       $new[$key]=$value;
    }  
   return $new;  
} 

add_action('manage_leadership_posts_custom_column', 'leadership_posts_custom_columns', 10, 2);
function leadership_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="40" height="40" alt="" />';
        else
           echo "N/A";
    }
}


add_action("admin_init", "leadership_data"); 
	function leadership_data(){
	  add_meta_box("leadership_meta", "Leader Info:", "leadership_meta", "leadership", "normal", "low");
	}
	function leadership_meta() {
	  global $post;
	  $custom = get_post_custom($post->ID);
	  $designation = $custom["designation"][0];
	  $linkedin = $custom["linkedin"][0];
	  $twitter = $custom["twitter"][0];
	  $facebook = $custom["facebook"][0];
	  ?>
<p><label>Leader Designation:-</label>
  <input type="text" name="designation" value="<?php echo $designation; ?>" style="width:100%;" />
</p>
<p><label>LinkedIn:-</label>
  <input type="text" name="linkedin" value="<?php echo $linkedin; ?>" style="width:100%;" />
</p>
<p><label>Twitter:-</label>
  <input type="text" name="twitter" value="<?php echo $twitter; ?>" style="width:100%;" />
</p>
<p><label>Facebook:-</label>
  <input type="text" name="facebook" value="<?php echo $facebook; ?>" style="width:100%;" />
</p>
<?php
	}
add_action('save_post', 'save_leadership_meta');
function save_leadership_meta(){
  global $post;
  update_post_meta($post->ID, "designation", $_POST["designation"]);
  update_post_meta($post->ID, "linkedin", $_POST["linkedin"]);
  update_post_meta($post->ID, "twitter", $_POST["twitter"]);
  update_post_meta($post->ID, "facebook", $_POST["facebook"]);
}
}
