<?php
/*
if (!is_plugin_active( 'advanced-custom-fields/acf.php' ) ){
		echo '<div id="message" class="error"><strong>This theme requires you to install the Advanced Custom Fields	 plugin, <a class="thickbox open-plugin-details-modal" href="'. esc_url(home_url()) .'/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=advanced-custom-fields&amp;TB_iframe=true&amp;width=772&amp;height=287">download it from here</a>.</strong></div>';		
}
*/

if(class_exists('acf') ) {
	function remove_acf_menu() {
		remove_menu_page('edit.php?post_type=acf');
	}
//	add_action( 'admin_menu', 'remove_acf_menu', 999);	
}


if(function_exists("register_field_group"))
{
// ################### For Carousel #######################
	register_field_group(array (
		'id' => 'acf_category-meta',
		'title' => 'Page Carousel/Banner',
		'fields' => array (		
			array (
				'key' => 'field_5ad356d348d33',
				'label' => 'Check for Show Top Carousel/Banner in Page',
				'name' => 'show_page_banner',
				'type' => 'checkbox',
				// 'instructions' => 'Check for show top Banner in Page',
				'choices' => array (
					'Yes' => 'Yes',
				),				
				'default_value' => 'Yes : No',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_5ad356d348d34',
				'label' => 'Active Carousel/ Text Banner',
				'name' => 'active_carousel',
				'type' => 'checkbox',
				'choices' => array (
					'Yes' => 'Yes',
				),
				'default_value' => 'No',
				'layout' => 'vertical',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5ad356d348d33',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5ad359d4f73c5',
				'label' => 'Carousel slug',
				'name' => 'carousel_slug',
				'type' => 'text',
				'default_value' => 'carousal-default',
				'placeholder' => 'Put here carousal group slug name',
				'instructions' => 'Create group of Slider and put that slug name',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5ad356d348d34',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5ad014e64c21d',
				'label' => 'Banner BG Image',
				'name' => 'category_image',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5ad356d348d33',
							'operator' => '==',
							'value' => 'Yes',
						),
						array (
							'field' => 'field_5ad356d348d34',
							'operator' => '!=',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
			),
			array (
				'key' => 'field_5c7b7ea09eeb1',
				'label' => 'Banner Text',
				'name' => 'banner_text',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5ad356d348d33',
							'operator' => '==',
							'value' => 'Yes',
						),
						array (
							'field' => 'field_5ad356d348d34',
							'operator' => '!=',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
			),

			
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),	
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
// ################### For Banner Video ########################	
register_field_group(array (
		'id' => 'acf_banner-thumbnail-info',
		'title' => 'Right side Image/Video',
		'fields' => array (
			array (
				'key' => 'field_5ae818625ee66',
				'label' => 'Add	Cover Image',
				'name' => 'add_video_cover_image',
				'type' => 'file',
				'save_format' => 'url',
				'library' => 'all',
			),
			array (
				'key' => 'field_5ad1d1e3744f8',
				'label' => 'Add	Video URL',
				'name' => 'add_video_cover_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),	
			array (
				'key' => 'field_5ad1d1e3744g9',
				'label' => 'Add	Page URL',
				'name' => 'add_page_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),						
			array (
				'key' => 'field_5ad1d1e3744f5',
				'label' => 'Person Name',
				'name' => 'video_person_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5ad1d232744f7',
				'label' => 'Person Designation',
				'name' => 'video_person_designation',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'banner',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));	
	
// ################### For Featured Video #######################	
	register_field_group(array (
		'id' => 'acf_featured-video',
		'title' => 'Featured Video',
		'fields' => array (
			array (
				'key' => 'field_5ad7fde04f40f',
				'label' => 'Do you want to play video in slide',
				'name' => 'active_video_in_slide',
				'type' => 'checkbox',
				'choices' => array (
					'Yes' => 'Yes',
				),
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5ae818625ee44',
				'label' => 'Add	Media Gallery',
				'name' => 'add__media_gallery',
				'type' => 'file',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5ad7fde04f40f',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'library' => 'all',
			),
			array (
				'key' => 'field_5ae818aa00f8f',
				'label' => 'Put Youtube video url',
				'name' => 'youtube_video_url',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5ad7fde04f40f',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'banner',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));	

// #################### For Category Title ########################	
	register_field_group(array (
		'id' => 'acf_category-title',
		'title' => 'Category Title',
		'fields' => array (
			array (
				'key' => 'field_5ad014aa4c21c',
				'label' => 'Title',
				'name' => 'cat_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Category Title',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b7eadb9a16c4',
				'label' => 'Category Page Description',
				'name' => 'category_page_description',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => 'This content show on category page',
				'maxlength' => '',
				'rows' => 4,
				'formatting' => 'html',
			),				
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),			
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

// ############ For Show Featured Image in Post/Page ###################	
register_field_group(array (
		'id' => 'acf_show-featured-image-in-post',
		'title' => 'Show Featured Image in Post',
		'fields' => array (
			array (
				'key' => 'field_5ad8b226b8306',
				'label' => '',
				'name' => 'show_featured_image_in_post',
				'type' => 'checkbox',
				'choices' => array (
					'Yes' => 'Yes',
				),
				//'default_value' => '',
				'default_value' => 'Yes',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));	
	

}