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
		'menu_position' => 20,
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
        //    echo "N/A";
		   echo '<img src="' . get_theme_file_uri( "/assets/images/ic-video.svg") . '" width="50" height="" />';
    }
	
    if($column_name === 'category_group'){		
	$term_list = wp_get_post_terms($post_id, 'slider', array("fields" => "all"));
		foreach( $term_list as $thisslug ) {
			echo $thisslug->slug . ', ';
	}
	}
}

}


// Trusted By 
add_action('init', 'trusted_company_register');
function trusted_company_register() {
	$labels = array(
		'name' => _x('Trusted Company', 'post type general name'),
		'singular_name' => _x('Trusted Company', 'post type singular name'),
		'add_new' => _x('Add New Company', 'Company'),
		'add_new_item' => __('Add New Company'),
		'edit_item' => __('Edit Company'),
		'new_item' => __('New Company'),
		'view_item' => __('View Company'),
		'search_items' => __('Search Company'),
		'all_items' => __( 'All Company' ),
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
		'menu_position' => 21,
		'menu_icon' => 'dashicons-shield',
		'supports' => array( 'title', 'thumbnail')	
); 

register_post_type("trusted_company" , $args);


add_filter('manage_trusted_company_posts_columns', 'trusted_company_posts_columns');
function trusted_company_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Logo');
    return $defaults;
}

add_filter('manage_trusted_company_posts_columns', 'trusted_company_head');  

function trusted_company_head($defaults){  
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

add_action('manage_trusted_company_posts_custom_column', 'trusted_company_posts_custom_columns', 10, 2);
function trusted_company_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="" height="45" alt="" />';
        else
           echo "N/A";
    }
}



}


// Awards Support 
add_action('init', 'awards_support_register');
function awards_support_register() {
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
		'menu_position' => 22,
		'menu_icon' => 'dashicons-awards',
		'supports' => array( 'title', 'thumbnail')	
); 

register_post_type("awards_support" , $args);


add_filter('manage_awards_support_posts_columns', 'awards_support_posts_columns');
function awards_support_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Logo');
    return $defaults;
}

add_filter('manage_awards_support_posts_columns', 'award_columns_head');  

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

add_action('manage_awards_support_posts_custom_column', 'awards_support_posts_custom_columns', 10, 2);
function awards_support_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="" height="45" alt="" />';
        else
           echo "N/A";
    }
}

}


// Client Speak 
add_action('init', 'client_speak_register');
function client_speak_register() {
	$labels = array(
		'name' => _x('Client Speak', 'post type general name'),
		'singular_name' => _x('Client Speak', 'post type singular name'),
		'add_new' => _x('Add New Client', 'Client'),
		'add_new_item' => __('Add New Client '),
		'edit_item' => __('Edit Client Speak'),
		'new_item' => __('New Client'),
		'view_item' => __('View Client'),
		'search_items' => __('Search Client'),
		'all_items' => __( 'All Clients' ),
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
		'menu_position' => 23,
		'menu_icon' => 'dashicons-testimonial',
		'supports' => array( 'title', 'thumbnail')	
); 

register_post_type("client" , $args);



add_filter('manage_client_posts_columns', 'client_posts_columns');
function client_posts_columns($defaults){
	$defaults['title'] = __('Client Name');
	$defaults['post_thumbs'] = __('Profile Picture');
	$defaults['designation'] = __('Designation');
	$defaults['company'] = __('Company');
    return $defaults;
}

add_filter('manage_client_posts_columns', 'client_columns_head');  

function client_columns_head($defaults){  
    $new = array();
    $tags = $defaults['category_group'];  
    foreach($defaults as $key=>$value){
        if($key=='date') {  
		   $new['post_thumbs'] = $tags;	
		   $new['designation'] = $tags;	
		   $new['company'] = $tags;		   
        }    
       $new[$key]=$value;
    }  
   return $new;  
} 

add_action('manage_client_posts_custom_column', 'client_posts_custom_columns', 10, 2);
function client_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="40" height="40" alt="" />';
        else
           echo "N/A";
    }
	if($column_name === 'designation'){
           echo get_post_meta( $post_id, 'designation', true );
    }

	if($column_name === 'company'){
		echo get_post_meta( $post_id, 'company_name', true );
 	}
}


add_action("admin_init", "client_data"); 
	function client_data(){
	  add_meta_box("client_meta", "Client Info:", "client_meta", "client", "title", "low");
	}
	function client_meta() {
	  global $post;
	  $custom = get_post_custom($post->ID);
	  $designation = $custom["designation"][0];
	  $company_name = $custom["company_name"][0];
	  ?>
<p><label>Client Designation:-</label>
  <input type="text" name="designation" value="<?php echo $designation; ?>" style="width:100%;" />
</p>
<p><label>Company Name:-</label>
  <input type="text" name="company_name" value="<?php echo $company_name; ?>" style="width:100%;" />
</p>
<?php
	}
add_action('save_post', 'save_client_meta');
function save_client_meta(){
  global $post;
  update_post_meta($post->ID, "designation", $_POST["designation"]);
  update_post_meta($post->ID, "company_name", $_POST["company_name"]);
}
}


// Speakers
add_action('init', 'speakers_register');
function speakers_register() {
	$labels = array(
		'name' => _x('Speakers', 'post type general name'),
		'singular_name' => _x('Speakers', 'post type singular name'),
		'add_new' => _x('Add New Speaker', 'Speaker'),
		'add_new_item' => __('Add New Speaker'),
		'edit_item' => __('Edit Speaker'),
		'new_item' => __('New Speaker'),
		'view_item' => __('View Speaker'),
		'search_items' => __('Search Speaker'),
		'all_items' => __( 'All Speakers' ),
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
		'menu_position' => 24,
		'menu_icon' => 'dashicons-businessman',
		'supports' => array( 'title', 'thumbnail')	
); 

register_post_type("speakers" , $args);

add_filter('manage_speakers_posts_columns', 'speakers_posts_columns');
function speakers_posts_columns($defaults){
	$defaults['post_thumbs'] = __('Picture');
    return $defaults;
}

add_filter('manage_speakers_posts_columns', 'speakers_columns_head');  

function speakers_columns_head($defaults){  
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

add_action('manage_speakers_posts_custom_column', 'speakers_posts_custom_columns', 10, 2);
function speakers_posts_custom_columns($column_name, $post_id){
	if($column_name === 'post_thumbs'){		
		$SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));	
        if ($SlideImgUrl !='')
           echo '<img src="' .$SlideImgUrl.' " width="45" height="45" alt="" />';
        else
           echo "N/A";
    }
}


add_action("edit_form_after_title", "speakers_data"); 
	function speakers_data(){
	  add_meta_box("speakers_meta", "Speaker Info:", "speakers_meta", "speakers", "normal", "low");
	}
	function speakers_meta() {
	  global $post;
	  $custom = get_post_custom($post->ID);
	  $designation = $custom["designation"][0];
	  $company_name = $custom["company_name"][0];
	  ?>
<p><label>Speaker Designation:-</label>
  <input type="text" name="designation" value="<?php echo $designation; ?>" style="width:100%;" />
</p>
<p><label>Company Name:-</label>
  <input type="text" name="company_name" value="<?php echo $company_name; ?>" style="width:100%;" />
</p>
<?php
	}
add_action('save_post', 'save_speakers_meta');
function save_speakers_meta(){
  global $post;
  update_post_meta($post->ID, "designation", $_POST["designation"]);
  update_post_meta($post->ID, "company_name", $_POST["company_name"]);
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
		'menu_position' => 25,
		'menu_icon' => 'dashicons-lightbulb',
		'supports' => array( 'title')		
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
		// $SlideImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post_id));
		$published_pdf = get_post_meta( $post_id, 'media_upload_published_pdf', true );
        if ($published_pdf !=''){
			$ImgUrl = get_the_guid(get_post_meta( $post_id, 'media_upload_published_pdf', true ));
			$ext = 	substr(strrchr($ImgUrl, "."), 1); 	
			if($ext == 'pdf'){
				echo '<img src="' . get_theme_file_uri( "/assets/images/ic-pdf.svg") . '" width="" height="45" />';
			}else{
				echo '<img src="' .$ImgUrl.' " width="" height="45" alt="" />';
			}
		   
		}else{
			echo 'Web Link';
		}
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
		'menu_position' => 26,
		'menu_icon' => 'dashicons-megaphone',
		'supports' => array( 'title')	
); 

register_post_type("press-releases" , $args);
}

