<?php

if(is_admin()){
  add_action('admin_head', 'of_admin_head'); 
	add_action('admin_init', 'add_admin_scripts');
}


function add_admin_scripts() {
  wp_enqueue_script( 'shortcodes', get_template_directory_uri() . '/admin/tinymce/shortcodelocalization.js');
	wp_localize_script( 'shortcodes', 'objectL10n', array(
  'columns_title' => __('Columns','tucana'),
  'elements_title' => __('Elements','tucana'),
  'list_title' => __('List Style','tucana'),
  'messagebox_title' => __('Message Box','tucana'),
  'onefourth_title' => __('One Fourth','tucana'),
  'onefourth_last_title' => __('One Fourth Last','tucana'),
  'onethird_title' => __('One Third','tucana'),
  'onethird_last_title' => __('One Third Last','tucana'),
  'onehalf_title' => __('One Half','tucana'),
  'onehalf_last_title' => __('One Half Last','tucana'),
  'twothird_title' => __('Two Third','tucana'),
  'threefourth_title' => __('Three Fourth','tucana'),
  'onefifth_title' => __('One Fifth','tucana'),
  'onefifth_last_title' => __('One Fifth Last','tucana'),
  'dropcap1_title' => __('Dropcap 1','tucana'),
  'dropcap2_title' => __('Dropcap 2','tucana'),
  'dropcap3_title' => __('Dropcap 3','tucana'),
  'pullquote_left_title' => __('Pullquote Left','tucana'),
  'pullquote_right_title' => __('Pullquote Right','tucana'),
  'tabs_title' => __('Tabs','tucana'),
  'toggle_title' => __('Toggle','tucana'),
  'image_title' => __('Image','tucana'),
  'gmap_title' => __('Google Map','tucana'),
  'youtube_title' => __('Youtube','tucana'),
  'vimeo_title' => __('Vimeo','tucana'),
  'button_title' => __('Buttons','tucana'),
  'bulletlist_title' => __('Bullet List','tucana'),
  'starlist_title' => __('Star List','tucana'),
  'arrowlist_title' => __('Arrow List','tucana'),
  'green_arrowlist_title' => __('Green Arrow List','tucana'),
  'deletelist_title' => __('Delete List','tucana'),
  'checklist_title' => __('Check List','tucana'),
  'infobox_title' => __('Info Box','tucana'),
  'successbox_title' => __('Success Box','tucana'),
  'warningbox_title' => __('Warning Box','tucana'),
  'errorbox_title' => __('Error Box','tucana')
	
	));

}
