<?php
function centumlearning_setup() {
	load_theme_textdomain('centumlearning');
		update_option( 'large_size_w', 1280 );
		update_option( 'large_size_h', 1080 );
		update_option( 'medium_size_w', 800 );
		update_option( 'medium_size_h', 600 );	

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'centumlearning' ),
		'copyrights' => __( 'Copy Rights Links Menu', 'centumlearning' ),
	) );



function copyrights_nav()
{
	wp_nav_menu(array('theme_location'  => 'copyrights', 'menu' => '', 'container' => '', 'container_class' => '', 'container_id' => '', 'menu_class' => '', 'menu_id' =>  '', 'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '%3$s', 'depth' => 0, ));
}

	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support('post-thumbnails');
	add_theme_support( 'html5', array('comment-form', 'comment-list', 'gallery', 'caption', ) );
	add_theme_support( 'post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio',) );
	add_theme_support( 'custom-logo', array('flex-width'  => true, 'flex-height' => true,) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-header', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/inner-banner-default.jpg',
	) );
    add_theme_support( 'custom-background' );
    add_theme_support( 'customize-selective-refresh-widgets' );	
    add_post_type_support('page', 'excerpt');
    
}
add_action( 'after_setup_theme', 'centumlearning_setup' );

add_filter('use_block_editor_for_post', '__return_false');


function wc_prevent_clickjacking() {
	header( 'X-FRAME-OPTIONS: SAMEORIGIN' );
}
add_action( 'send_headers', 'wc_prevent_clickjacking', 10 );


function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');


/**
 * Register custom fonts.
 */
function centumlearning_fonts_url() {
	$fonts_url = '';
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'centumlearning' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array(
			"Poppins:100,200,300,400,500,700",
			//"Lato:300,400,700,900"
		 );
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

function centumlearning_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'centumlearning-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'centumlearning_resource_hints', 10, 2 );

function centumlearning_widgets_init() {
	register_sidebar( array(
		'name'          => __('Blog Sidebar', 'centumlearning' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in sidebar on blog posts.', 'centumlearning' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s box">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="h-title"><span>',
		'after_title'   => '</span></h6>',
	) );	
	
	register_sidebar( array(
		'name'          => __( 'Footer Address', 'centumlearning' ),
		'id'            => 'footer_address',
		'description'   => __( 'Add widgets here to appear in Footer Address.', 'centumlearning' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="heading">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Links', 'centumlearning' ),
		'id'            => 'footer_links',
		'description'   => __( 'Add widgets here to appear in Footer Links.', 'centumlearning' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="heading">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Get In Touch', 'centumlearning' ),
		'id'            => 'footer_get_in_touch',
		'description'   => __( 'Add widgets here to appear in Footer Get In Touch.', 'centumlearning' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="heading">',
		'after_title'   => '</h5>',
	) );	


}
add_action( 'widgets_init', 'centumlearning_widgets_init');

function centumlearning_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'centumlearning' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'centumlearning_excerpt_more' );


function get_excerpt($length){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = substr($excerpt, 0, $length);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
$excerpt = strip_tags($excerpt);
$excerpt = $excerpt.'...';
return $excerpt;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');


function centumlearning_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'centumlearning_javascript_detection', 0 );

/** Add a pingback url auto-discovery header for singularly identifiable articles. */
function centumlearning_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'centumlearning_pingback_header' );

/** Enqueue scripts and styles. */
function centumlearning_scripts() {
	wp_enqueue_style( 'centumlearning-fonts', centumlearning_fonts_url(), array(), null );
    wp_enqueue_style( 'centumlearning-style', get_stylesheet_uri() );
    wp_enqueue_style( 'centumlearning-theme-style', get_theme_file_uri( '/assets/css/theme-style.min.css'), array(), '1.0');
	wp_enqueue_style( 'aoscss', get_theme_file_uri( '/assets/plugins/aos/aos.css'), array(), '1.0');
	// wp_enqueue_style( 'centumlearning-font-awesome', get_theme_file_uri( '/assets/plugins/font-awesome/font-awesome.css'), array(), '4.7.0');
	


	// Load the html5 shiv.
	wp_enqueue_script('html5', get_theme_file_uri( '/assets/plugins/html5/html5.js'), array(), '3.7.3' );
	wp_script_add_data('html5', 'conditional', 'lt IE 9');
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap',  get_theme_file_uri( '/assets/js/bootstrap.min.js'), array(), '4.4.1' );
	wp_enqueue_script('slick-carousel', get_theme_file_uri( '/assets/js/slick.min.js'), '', '', true);
	wp_enqueue_script('aosjs', get_theme_file_uri( '/assets/plugins/aos/aos.js'), '', '', true);
	wp_enqueue_script('themefyn', get_theme_file_uri( '/assets/js/theme-function.min.js'), '', '', true);
	wp_enqueue_script('polygonizr', get_theme_file_uri( '/assets/plugins/polygonizr/polygonizr.min.js'), '', '', true);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'centumlearning_scripts' );


function centumlearning_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'centumlearning_front_page_template' );


function centumlearning_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'centumlearning_widget_tag_cloud_args' );


function remove_dashboard_meta() {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action( 'admin_init', 'remove_dashboard_meta' );


// add_action('init', 'create_cf7editor_role');
function create_cf7editor_role(){
  add_role('cf7_editor', 'Form Editor',
    array('wpcf7_edit_contact_forms'=>1,
    'wpcf7_edit_others_contact_forms'=>1,
    'wpcf7_edit_published_contact_forms'=>1,
    'wpcf7_read_contact_forms'=>1,
    'wpcf7_publish_contact_forms'=>1,
    'wpcf7_delete_contact_forms'=>1,
    'wpcf7_delete_published_contact_forms'=>1,
    'wpcf7_delete_others_contact_forms'=>1)
    );
}

// remove_role( 'cf7_editor' );

require get_template_directory() . '/inc/sanitize-functions.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/acf.php';
define( 'ACF_LITE', true );
require get_template_directory() . '/inc/acf-custom.php';


add_filter('site_transient_update_plugins', 'remove_auto_update_link');
function remove_auto_update_link($value) {
 unset($value->response[ 'advanced-custom-fields-pro/acf.php' ]);
 return $value;
}

// add_filter('acf/settings/show_admin', 'acf_menu_show_admin');
function acf_menu_show_admin( $show_admin ) {
    return false;
}

// ################################################### Theme Options ############################################## 
$themename = "Themes";
global $MengaMenu;
$shortname = str_replace(' ', '_', strtolower($themename));
function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}

$options = array (
	array(	"type" => "open"),
		array(	"name" => "Social Media Link",
        "type" => "title",
		),	
		array(	"name" => "Facebook",
		"desc" => "Insert here Facebook link",
        "id" => $shortname."_facebook",
        "type" => "text",
		//"std" => ''
		),	

		array(	"name" => "Twitter",
		"desc" => "Insert here Twitter link",
        "id" => $shortname."_twitter",
        "type" => "text",
		//"std" => ''
		),	

		array(	"name" => "LinkedIn",
		"desc" => "Insert here LinkedIn link",
        "id" => $shortname."_linkedin",
        "type" => "text",
		//"std" => ''
		),
		array(	"name" => "youtube",
		"desc" => "Insert here youtube link",
        "id" => $shortname."_youtube",
        "type" => "text",
		//"std" => ''
		),		
		array(	"name" => "Header & Footer Script",
        "type" => "title",
		),		
		array(	"name" => "Header Script",
		"desc" => "Insert here Header Script & Style",
        "id" => $shortname."_header_script",
        "type" => "textarea",
		//"std" => ''
		),	
		array(	"name" => "Footer Script",
		"desc" => "Insert here Footer Script & Style",
        "id" => $shortname."_footer_script",
        "type" => "textarea",
		//"std" => ''
		),		
		
	array(	"type" => "close"),
);

function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
	}
add_filter( 'body_class', 'add_slug_body_class' );


function mytheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

               echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
                die;
        } 
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}


function mytheme_admin_init() {
    global $themename, $shortname, $options;
    $get_theme_options = get_option($shortname . '_options');
    if($get_theme_options != 'yes') {
    	$new_options = $options;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['std'] ); 
		}
    	update_option($shortname . '_options', 'yes');
    }
}


function wp_initialize_the_theme_finish() { 
	$uri = strtolower($_SERVER["REQUEST_URI"]);
	 if(is_admin() || substr_count($uri, "wp-admin") > 0 || substr_count($uri, "wp-login") > 0 ) {
		 // Write code
		 } else { $l = '';  }
	 } wp_initialize_the_theme_finish();	

function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
?>

<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>
<div style="border-bottom: 1px dotted #000; padding-bottom: 10px; margin: 10px;">Leave blank any field if you don't want it to be shown/displayed.</div>
<form method="post">
  <?php foreach ($options as $value) {   
	switch ( $value['type'] ) {
		case "open":
		?>
  <table width="100%" border="0" style=" padding:10px;">
    <?php break;
		case "close":
		?>
  </table>
  <br />
  <?php break;
		case "title":
  ?>
  <table width="100%" border="0" style="padding:5px 10px;">
    <tr>
      <td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
    </tr>
    <?php break;
		case 'text':
		?>
    <tr>
      <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
      <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" placeholder="<?php echo $value['std']; ?>" /></td>
    </tr>
    <tr>
      <td><small><?php echo $value['desc']; ?></small></td>
    </tr>
    <tr>
      <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?php 
		break;
		case 'textarea':
		?>
    <tr>
      <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
      <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" placeholder="<?php echo $value['std']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
    </tr>
    <tr>
      <td><small><?php echo $value['desc']; ?></small></td>
    </tr>
    <tr>
      <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?php 
		break;
		case 'select':
		?>
    <tr>
      <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
      <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
          <?php 
		foreach ($value['options'] as $option) { ?>
          <option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <td><small><?php echo $value['desc']; ?></small></td>
    </tr>
    <tr>
      <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?php
        break;
		case "checkbox":
	?>
    <tr>
      <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
      <td width="80%"><? if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /></td>
    </tr>
    <tr>
      <td><small><?php echo $value['desc']; ?></small></td>
    </tr>
    <tr>
      <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?php 
  break;
} 
}




?>
  </table>
  <p class="submit">
    <input name="save" type="submit" value="Save changes" />
    <input type="hidden" name="action" value="save" />
  </p>
</form>
<?php
}

mytheme_admin_init();

function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } }
add_action('admin_menu', 'mytheme_add_admin');
// ##################### End Theme toolkit ################################## 





/* ###################### Get Location Map Data  ####################################### */
add_action('wp_ajax_get_location_map', 'ajax_get_location_map');
add_action('wp_ajax_nopriv_get_location_map', 'ajax_get_location_map');
function ajax_get_location_map(){
	$post_Id = $_POST['Post_id'];
	$metakey = $_POST['Map_meta'];
	echo get_post_meta( $post_Id, $metakey, true );
	die();
}


/* ###################### Get Meta Data  ####################################### */
add_action('wp_ajax_get_metakey_data', 'ajax_get_metakey_data');
add_action('wp_ajax_nopriv_get_metakey_data', 'ajax_get_metakey_data');
function ajax_get_metakey_data(){
	$post_Id = $_POST['post_Id'];
	$metakey = $_POST['metakey'];
	echo get_post_meta( $post_Id, $metakey, true );
	die();
}

/* ###################### Get Page Id   ########################################### */
function get_page_id($page_name){
	global $wpdb;
	 $page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type ='page' && post_name = '".$page_name."'");
	 return $page_name;
}

/* ###################### Get Archive Year   ########################################### */
function get_posts_years_array($post_type, $y) {
    global $wpdb;
    $result = array();
	$post_type = $post_type;
	$y = $y;

    $query_prepare = $wpdb->prepare("SELECT YEAR(post_date) FROM ($wpdb->posts) WHERE post_status = 'publish' AND post_type = %s GROUP BY YEAR(post_date) DESC", $post_type);

    $years = $wpdb->get_results($query_prepare);

    if ( is_array( $years ) && count( $years ) > 0 ) {
        foreach ( $years as $i => $year ) {
			if($i == $y) break;
			$obj =  json_decode(json_encode($year), true);			
			$result[] =  $obj['YEAR(post_date)'];
        }
    }
	return $result;
}

// #################################### For load post Media  #############################3
add_action('wp_ajax_load_post_type_media', 'ajax_load_post_type_media');
add_action('wp_ajax_nopriv_load_post_type_media', 'ajax_load_post_type_media');
function ajax_load_post_type_media(){
 	$post_type = $_POST['post_type'];
 	$post_year = $_POST['post_year'];
	$archive_before_year = $_POST['archive_before_year'];	
	$arch_year = '';


	if($post_type.'_'.$post_year == $post_type.'_Archived'){
		$post_year = '';
		$arch_year = ['before' => 'December 31st, ' . $archive_before_year];
	}

    $args = array (
		'post_type' => $post_type,
		'numberposts' => 10,
		'order' => 'DESE',
		'year' => $post_year,
		'date_query' => array($arch_year)
    );

	$posts = get_posts($args);
    ob_start ();
	echo '<div class="media" data-aos="fade-left" data-aos-delay="50">';
    foreach ($posts as $post ) {
	 setup_postdata( $post );
		// echo $post->ID;
		// echo $post->post_title;
		$publication = get_post_meta( $post->ID, 'media_publication_name', true );
		$media_check_for_web = get_post_meta( $post->ID, 'media_check_for_web', true )[0];
		$publication_url = get_post_meta( $post->ID, 'media_web_url', true );
		$publication_pdf = get_the_guid(get_post_meta( $post->ID, 'media_upload_published_pdf', true ));
		$newsDate = $post->post_date;
		
		echo '<div class="media_box">';

		echo '<h4>'. $post->post_title .'</h4>';
			if($publication!=''){
			echo '<p><strong>Publication</strong>: ' . $publication . '</p>';
			}
		// echo '<p><strong>Date</strong>: ' . $newsDate . '</p>';
	
		if($media_check_for_web =='Yes' &&  $publication_url !=''){
			echo '<div class="view_btn"><a class="know_more_btn" href="'. $publication_url .'" target="_blank"><span>VIEW MORE</span></a></div>';			
		}
		
		if($media_check_for_web !='Yes' && $publication_pdf!=''){
			// $ext = 	substr(strrchr($publication_pdf, "."), 1); 	
			// if($ext == 'pdf'){
				// echo '<div class="view_btn"><a class="know_more_btn" href="'. $publication_pdf .'" target="_blank"><span>VIEW MORE</span></a></div>';
			// }else{
				echo '<div class="view_btn"><a class="know_more_btn view_featured" href="'. $publication_pdf .'"><span>VIEW MORE</span></a></div>';
			// }
		}
		echo '</div>';

   } 
   echo '</div>';
   wp_reset_postdata();
 //  ob_end_clean();
 die();
}


// #################################### For load post Client  #############################3
add_action('wp_ajax_load_post_type_client', 'ajax_load_post_type_client');
add_action('wp_ajax_nopriv_load_post_type_client', 'ajax_load_post_type_client');
function ajax_load_post_type_client(){
 	$post_ID = $_POST['post_ID'];
    $args = array (
		'post_type' => 'client',
		'numberposts' => 1,
		'include' => array($post_ID)
    );

	$posts = get_posts($args);
    ob_start ();
    foreach ($posts as $post ) {
	 setup_postdata( $post );
		// echo $post->ID;
		// echo $post->post_title;
		$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
		echo '<div class="client_speak_modal">';
			echo '<div class="row">';
			echo '<div class="client_said col-12  ' . (($img)?  ' col-md-8' : ' ') . '">'.  get_field('client_content' ,  $post->ID) . '</div>';
			echo '<div class="client_info col-12 ' . (($img)?  ' col-md-4' : ' ') . '">';
			if($img){
				echo '<figure><img class="img-fluid" src="'. $img . '" alt=" " /></figure>';
			}
			echo '<h4 class="text-center">'. $post->post_title .'</h4>';
			if(get_field('client_designation' ,  $post->ID)){
				echo '<p class="text-center">' .get_field('client_designation' ,  $post->ID) . '</p>';
			}
			if(get_field('client_company_name' ,  $post->ID)){
				echo '<p class="text-center">' .get_field('client_company_name' ,  $post->ID) . '</p>';
			}
			if(get_field('client_address' ,  $post->ID)){
				echo '<p class="text-center">' .get_field('client_address' ,  $post->ID) . '</p>';
			}
			echo '</div></div>';
		echo '</div>';
   } 
   wp_reset_postdata();
 //  ob_end_clean();
 die();
}


// #################################### For load Job Opportunities  #############################3

add_action('wp_ajax_get_job_opportunities', 'ajax_get_job_opportunities');
add_action('wp_ajax_nopriv_get_job_opportunities', 'ajax_get_job_opportunities');
function ajax_get_job_opportunities(){
 	$location = $_POST['location'];
 	// $department = $_POST['department'];
	$category = $_POST['category'];

	 

    $args = array (
		'post_type' => 'job',
		'numberposts' => -1,
		'order' => 'DESE',
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'locations',
				'field'    => 'id',
				'terms'    => $location,
			),
			// array(
			// 	'taxonomy' => 'departments',
			// 	'field'    => 'id',
			// 	'terms'    => $department,
			// ),
			array(
				'taxonomy' => 'job-categories',
				'field'    => 'id',
				'terms'    => $category,
			),			
		),
    );

	// echo '<pre>';
	// print_r($args);
	// echo '</pre>';
	$posts = get_posts($args);
    ob_start ();

	if(count($posts) > 0){
    foreach ($posts as $post ) {
	 setup_postdata( $post );
		// echo $post->ID;
		// echo $post->post_title;
		?>
		<div class="col-12 col-md-6 col-xl-4 mb-4 jobList_col">
		<div class="jobList_wrap">
			<h4><?php echo $post->post_title ?></h4>
			<ul>
				<?php
					$category_list = get_the_terms( $post->ID, 'job-categories' );
					if(!empty($category_list)){
						echo '<li><strong>Role: </strong>';
							array_list_item($category_list);
						echo '</li>';
					}

					$location_list = get_the_terms( $post->ID, 'locations' );
					if(!empty($location_list)){
						echo '<li><strong>Location: </strong>';
							array_list_item($location_list);
						echo '</li>';
					}

					$department_list = get_the_terms( $post->ID, 'departments' );
					if(!empty($department_list)){
						echo '<li><strong>Department: </strong>';
							array_list_item($department_list);
						echo '</li>';
					}
				?>
			</ul>
			<div class="applynow_btn">
					<small>Last day of application<br/><?php echo get_field('job_opening_closed', $post->ID); ?></small>
					<a href="<?php the_permalink($post->ID); ?>" class="btn btn-primary">Apply Now</a>
			</div>
		</div>
	</div>		


	<?php
		 } 

		}else{
			echo 'No available opportunity as per filter used';
		}
  

   wp_reset_postdata();
 //  ob_end_clean();
 die();
}


/* ################################# Carousel  ############################################ */
function carouselLoop($slug, $sliderID){	
	$args = array('posts_per_page' => 10, 'order' => 'ASC', 'orderby' => 'menu_order', 'tax_query' => array(
			array('taxonomy' => 'slider', 'field' => 'slug', 'terms' => $slug)));
	$content = '';
	$content .= '<div id="'. $sliderID .'">';
	$loop = new WP_Query( $args );
	
	$postCount = $loop->post_count;
	$i=0;
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
		$Bannerimage =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full' );	
		$active_video = get_field("active_video_in_slide");
		$active_video_url =  get_field('add__media_gallery');
		$active_video_url_youtube =  get_field('youtube_video_url');

		$add_video_cover_image =  get_field('add_video_cover_image');
		$add_video_cover_url =  get_field('add_video_cover_url');
		$add_page_url =  get_field('add_page_url');
		$video_person_name =  get_field('video_person_name');
		$video_person_designation =  get_field('video_person_designation');

		
	
	
		$content .= '<div class="item" data-title="'. get_the_title() .'">';
		if((!is_home() || !is_front_page())) {
		//	$content .=  '<div class="breadcrumbs">' . breadcrumbs() . '</div>'  ;
		}
		

		$thecontent = get_the_content();
		$content .= '<div class="banner_content" data-aos="fade-up" data-aos-delay="50"><div class="container"><div class="banner_left">' . apply_filters( 'the_content', $thecontent ) . '</div>';
		$content .= '<div class="banner_right banner_right_silider">';
		if( have_rows('right_side_imagevideo_list') ): 
			foreach ( get_field("right_side_imagevideo_list") as $i => $item ) {
				if($item['banner_right_side_cover_image'] !=''){
					$content .= '<div class="video_cont"><figure>';
					if($item['banner_right_side_video_url']!=''){
						$content .= '<div class="video_play" data-url="'. $item['banner_right_side_video_url'] .'"></div>';
					}
					if($item['banner_right_side_page_url']!=''){
						$content .= '<a class="page_url" href="'.$item['banner_right_side_page_url'] .'"></a>';
					}
					$content .= '<img src="' . $item['banner_right_side_cover_image'] . '" /></figure>';
					$content .= '<p><strong>' . $item['banner_right_side_person_name'] . '</strong></p>';
					$content .= '<p>' . $item['banner_right_side_person_designation'] . '</p>';
					$content .= '</div>';
				}

			}
		endif;

		$content .= '</div></div></div>';
		
		if($active_video[0] == 'Yes'){
					if($active_video_url_youtube !=''){
						$content .='<div class="ytube_wrap">' .$active_video_url_youtube .'</div>';
						
					}else{
						$content .='<div class="video_wrap"><video autoplay="false" muted="muted" preload="none" loop  id="video_'. $i.'"><source src="' .$active_video_url .'" type="video/mp4">Your browser does not support HTML5 video.</video></div>';
					}
		}else{
		$content .= '<figure style="background:url(' . $Bannerimage[0] .') no-repeat center top; background-size:cover"></figure>';
		}
		$content .='</div>';
	
	$i++;
	endwhile;
	$content .='</div>';
	$content .='<div class="arrows"><div class="arrowleft"><i></i></div><div class="arrowright"><i></i></div></div>';
endif; 
return $content;
wp_reset_query();
}



function infographics_shortcode( $atts ) {
	$message = '<div id="infographic"></div>';
	return $message;
}
add_shortcode( 'infographic', 'infographics_shortcode' );
add_filter('acf/format_value/type=textarea', 'do_shortcode');


add_filter('acf/fields/post_object/result', 'my_acf_fields_post_object_result', 10, 4);
function my_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
	if($post->post_type == "client"){
		$format =  get_post_meta( $post->ID, 'client_video_format', true );
		$profilePic = wp_get_attachment_url( get_post_thumbnail_id($post->ID));	
			if($format[0] == 'Yes'){
				$text .= ' (Video)';
			}else{
				if($profilePic !=''){ 
					$text .= ' (Text - With Profile Image)';
				} else{
					$text .= ' (Text)';
				}
			}
	}
	if($post->post_type == "case-studies"){
		$term_list = wp_get_post_terms( $post->ID, 'case', array( 'fields' => 'names' ) );
		$text .= ' ('. $term_list[0] .')';

	}
	return $text;
}

function array_list_item($arr){
	$arr_no = count($arr);
	foreach($arr   as $key => $item){
		echo  $item->name;
		if(($arr_no > $key) && ($key < $arr_no - 2)){
			echo  ', ';
		}
		if($key == ($arr_no -2)){
			echo  ' & ';
		}
	} 
}



/* ################################# Solution Grid  ############################################ */
function solutionGridLayout($pageID){
	$grid_types = get_field('grid_types', $pageID);
	echo '<div class="CTS_page_list_wrap row justify-content-center '. $grid_types .'">';
	if(have_rows('soution_grid_item', $pageID)): 
	foreach (get_field("soution_grid_item", $pageID) as $i => $item ) {
			
			// echo $i;
			// For Grid Box 1
			if($grid_types == 'grid1' && $i == 0){
				echo '<div class="col-12 col-md-8 CTS_page_child_wrap"><div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}
				echo '</div></div></div>';
			}
			
			// For Grid Box 2
			if($grid_types == 'grid2' && $i <= 1){
				echo '<div class="col-12 col-md-5 CTS_page_child_wrap"><div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}
				echo '</div></div></div>';
			}

			// For Grid Box 3
			if($grid_types == 'grid3' && $i <= 2){
				if($i == 0 || $i == 1){ 
					echo '<div class="col-12 col-md-6 col-lg-5 CTS_page_child_wrap">';
				} elseif($i == 2){ 
					echo '';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}
					if($i == 0 || $i == 2){ 
						echo '</div>';
					} elseif($i == 1){ 
						echo '';
					}
				echo '</div></div>';
			}
			
			// For Grid Box 4
			if($grid_types == 'grid4' && $i <= 3){
				if($i == 0 || $i == 2){ 
					echo '<div class="col-12 col-md-6 col-lg-5 CTS_page_child_wrap">';
				} elseif($i == 1 || $i == 3){ 
					echo '';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}
					if($i == 1 || $i == 3){ 
						echo '</div>';
					} elseif($i == 0 || $i == 2){ 
						echo '';
					}
				echo '</div></div>';
			}	
			
			// For Grid Box 5
			if($grid_types == 'grid5' && $i <= 4){
				if($i <= 2){ 
					echo '<div class="col-12 col-md-4 CTS_page_child_wrap">';
				} elseif($i >= 3 || $i == 4){ 
					echo '<div class="col-12 col-md-6 CTS_page_child_wrap">';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}
				echo '</div></div></div>';
			}

			// For Grid Box 5 with logo
			if(($grid_types == 'grid5a') && $i <= 5){
				if($i <= 2){ 
					echo '<div class="col-12 col-md-4 CTS_page_child_wrap">';
				} 
				if($i == 3){ 
					echo '<div class="col-12 col-md-8 CTS_page_child_wrap">';
				}
				if($i == 4){ 
					echo '<div class="col-12 col-md-4 CTS_page_child_wrap">';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}
				echo '</div></div></div>';
			}

			// For Grid Box 6
			if(($grid_types == 'grid6') && $i <= 5){
				if($i == 0 || $i == 1 || $i == 3){ 
					echo '<div class="col-12 col-md-4 CTS_page_child_wrap">';
				} elseif($i > 3){ 
					echo '<div class="col-12 col-md-6 CTS_page_child_wrap">';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}

				if($i == 1){ 
					echo '';
				}else {
					echo '</div>';
				}

				echo '</div></div>';
			}

			// For Grid Box 6 with logo
			if($grid_types == 'grid6a' && $i <= 6){
				if($i == 0 || $i == 1 || $i == 3){ 
					echo '<div class="col-12 col-md-4 CTS_page_child_wrap">';
				} elseif($i > 3){ 
					echo '<div class="col-12 col-md-6 CTS_page_child_wrap">';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}

				if($i == 1){ 
					echo '';
				}else {
					echo '</div>';
				}

				echo '</div></div>';
			}


			// For Grid Box 7
			if($grid_types == 'grid7' && $i <= 6){
				if($i == 0 || $i == 2 || $i == 3  ){ 
					echo '<div class="col-12 col-md-6 col-lg-4 CTS_page_child_wrap">';
				} elseif($i == 1 || $i == 4){ 
					echo '';
				}else{
				echo '<div class="col-12 col-lg-6 CTS_page_child_wrap">';
				}
				echo '<div class="CTS_page_child_content">';
				echo '<figure style="background-image:url('. $item["grid_item_page_cover_image"]["url"] .')" ></figure>';
				echo '<h4><a href="' . get_permalink($item['parent_page_id']) .'">' . $item["grid_item_heading"] . '</a></h4>';
				echo '<div class="child_data">';
				$pageLink = $item['grid_item_inner_page'];
				if( $pageLink ) {
					echo '<ul class="page_child_list">';
					foreach( $pageLink as $page ) {
						$pageName = $page['grid_item_inner_page_link'];
						if($pageName){
							echo '<li><a '. (($pageName['target'] !='')? 'target="_blank"': '' ).' href="'. $pageName['url'] .'">'. $pageName['title'] .'</a></li>';
						}
					}
					echo '</ul>';
				}else{
					echo '<div class="paraText">';
					echo ($item['grid_item_inner_text_link'] !='') ? '<a class="scrollspy" href="'. $item['grid_item_inner_text_link'] .'"></a>':'';
					echo '<p>' . $item['grid_item_inner_text'] . '</p></div>';
				}

				if($i == 0 || $i == 3){ 
					echo '';
				} elseif($i == 1 || $i == 2){ 
					echo '</div>';

				}else{
				echo '</div>';
				}

				echo '</div></div>';
			}


	}
	endif;
	echo '</div>';
}


function video_wrapper_shortcode( $atts ) {
	$message = '<div class="video_wrapper" style="max-width:'.  $atts["width"] .'px"><figure>';
	$message .= '<div class="video_play" data-url="'. $atts["url"] .'"></div>';
	$message .= '<img src="'. $atts["thumb"] .'"></figure>';
	$message .= '<p><strong>'. $atts["name"] .'</strong></p>';
	$message .= '<p>'. $atts["caption"] .'</p></div>';
	// print_r($atts);
	return $message;
}
add_shortcode( 'youtube_video', 'video_wrapper_shortcode' );




// For Insight post load on Infinite Scroll
function wp_infinitepaginate(){
	$paged = $_POST['page_no'];
	$cat = $_POST['cat_no'];

	$args = array('post_type' => 'post', 'cat' => $cat, 'paged' => $paged);
	$loop = new WP_Query($args);
	$content = '';
    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
		$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );

	if($cat == '13'){
		$content .= '<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">';
		$content .= '<div class="cat_wrap">';
				if(has_post_thumbnail()) {
					$content .= '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
				}else{
					$content .= '<figure class="cat-featured-image webinarThumb"></figure>';
				}
											
		$content .= '<h4><?php the_title(); ?></h4>';
		$content .= '<p>'. get_the_excerpt() . '</p>';
		$content .= '<div class="heading">Speakers:</div>';
				if(have_rows('select_speakers')): 
					foreach ( get_field("select_speakers") as $i => $item  ) {
					$post_id = $item['speaker_name']->ID;
					$content .= '<p><strong>'. $item['speaker_name']->post_title . ': </strong> ';
					$content .=  get_post_meta($post_id, 'designation', true ) .', '.  get_post_meta($post_id, 'company_name', true ) .'</p>';
				}
				endif;
		
		$content .= '<div class="know_more"><a  href="' . get_the_permalink() .'">VIEW MORE</a></div>';
		$content .= '</div></div>';

	}else{
        $content .= '<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 pb-2">';
		$content .= '<div class="cat_wrap">';
					 if( has_post_thumbnail() ) {
						 $content .= '<figure class="cat-featured-image" style="background-image:url('. $img[0] .')"></figure>';
					 }else{
						 $content .=	'<figure class="cat-featured-image webinarThumb"></figure>';
					 }
		$content .=	'<h4>'. get_the_title() . '</h4><p>' . get_the_excerpt() .'</p>';
		$content .= '<div class="know_more"><a  href="' .get_the_permalink() .'">VIEW MORE</a></div>';
		$content .=	'</div></div>';
	}

    endwhile;
    endif;
    wp_reset_postdata();
    die($content);
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');