<?php

/* ======================================
   List Styles 
   ======================================*/
/* List Styles */
function indonez_checklist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('checklist', 'indonez_checklist');

function indonez_bulletlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="circle-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('bulletlist', 'indonez_bulletlist');

function indonez_arrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrow-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('arrowlist', 'indonez_arrowlist');

function indonez_starlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="star-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('starlist', 'indonez_starlist');

function indonez_greenarrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="greenarrow-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('green_arrowlist', 'indonez_greenarrowlist');

function indonez_deletelist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="delete-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('deletelist', 'indonez_deletelist');

function imediapixel_itemlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="itemlist">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('itemlist', 'imediapixel_itemlist');


/* ======================================
   Messages Box
   ======================================*/
function indonez_warningbox( $atts, $content = null ) {
   return '<div class="warning">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning', 'indonez_warningbox');


function indonez_infobox( $atts, $content = null ) {
   return '<div class="info">' . do_shortcode($content) . '</div>';
}
add_shortcode('info', 'indonez_infobox');

function indonez_successbox( $atts, $content = null ) {
   return '<div class="success">' . do_shortcode($content) . '</div>';
}
add_shortcode('success', 'indonez_successbox');

function indonez_errorbox( $atts, $content = null ) {
   return '<div class="error">' . do_shortcode($content) . '</div>';
}
add_shortcode('error', 'indonez_errorbox');

/* ======================================
   Pullquote
   ======================================*/

function indonez_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'indonez_pullquote_right');


function indonez_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'indonez_pullquote_left');

function indonez_quotebox( $atts, $content = null ) {
  return '<div class="content_quotebox"><h3>'.do_shortcode($content).'</h3></div>';
}
add_shortcode('quotebox', 'indonez_quotebox');


/* ======================================
   Dropcap
   ======================================*/
/* Dropcap */
function indonez_drop_cap( $atts, $content = null ) {
   return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'indonez_drop_cap');

function indonez_drop_cap2( $atts, $content = null ) {
   return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'indonez_drop_cap2');

function indonez_drop_cap3( $atts, $content = null ) {
   return '<span class="dropcap3">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap3', 'indonez_drop_cap3');


/* ======================================
   Spacer
   ======================================*/
function indonez_spacer( $atts, $content = null ) {
   return '<div class="spacer"></div>';
}
add_shortcode('spacer', 'indonez_spacer');


/* ======================================
   Highlight
   ======================================*/
   
function indonez_highlight_purple( $atts, $content = null ) {
   return '<span class="highlight-purple">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_purple', 'indonez_highlight_purple');

function indonez_highlight_brown( $atts, $content = null ) {
   return '<span class="highlight-brown">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_brown', 'indonez_highlight_brown');

function indonez_highlight_pink( $atts, $content = null ) {
   return '<span class="highlight-pink">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_pink', 'indonez_highlight_pink');

function indonez_highlight_red( $atts, $content = null ) {
   return '<span class="highlight-red">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_red', 'indonez_highlight_red');

function indonez_highlight_yellow( $atts, $content = null ) {
   return '<span class="highlight-yellow">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_yellow', 'indonez_highlight_yellow');

function indonez_highlight_blue( $atts, $content = null ) {
   return '<span class="highlight-blue">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_blue', 'indonez_highlight_blue');

function indonez_highlight_green( $atts, $content = null ) {
   return '<span class="highlight-green">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_green', 'indonez_highlight_green');


/* Images */
function indonez_imgalignment( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'source'      => '#',
        'align' => '',
        'border' => false
    ), $atts));
  
  switch ($align) {
    case "left" :
      $class="imgleft";
    break;
    case "right" :
      $class="imgright";
    break;
    case "center" :
      $class="imgcenter";
    break;
  }
  
  if ($border == "true") {
    $out = "<img class=\"".$class." imgborder\" src=\"" .$source. "\" alt=\"\">"; 
  } else {
    $out = "<img class=\"".$class."\" src=\"" .$source. "\" alt=\"\">";
  }
    
  return $out;
}
add_shortcode('image', 'indonez_imgalignment');

/* Tables */

function indonez_table( $atts, $content = null ) {
  extract(shortcode_atts(array(
        'color'      => ''
    ), $atts));
    
	$content = "<div class=\"table-$color\">".str_replace('<table>', '<table class="table">', do_shortcode($content))."</div>";
	return $content;
	
}
add_shortcode('table', 'indonez_table');

/* ======================================
   Columns
   ======================================*/
function indonez_col_12( $atts, $content = null ) {
   return '<div class="col_12">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_12', 'indonez_col_12');

function indonez_col_12_last( $atts, $content = null ) {
   return '<div class="col_12 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_12_last', 'indonez_col_12_last');

function indonez_col_13( $atts, $content = null ) {
   return '<div class="col_13">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_13', 'indonez_col_13');

function indonez_col_13_last( $atts, $content = null ) {
   return '<div class="col_13 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_13_last', 'indonez_col_13_last');

function indonez_col_14( $atts, $content = null ) {
   return '<div class="col_14">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14', 'indonez_col_14');

function indonez_col_14_last( $atts, $content = null ) {
   return '<div class="col_14 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14_last', 'indonez_col_14_last');

function indonez_col_23( $atts, $content = null ) {
   return '<div class="col_23">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_23', 'indonez_col_23');

function indonez_col_23_last( $atts, $content = null ) {
   return '<div class="col_23 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_23_last', 'indonez_col_23_last');

function indonez_col_34($atts, $content = null ) {
   return '<div class="col_34">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_34', 'indonez_col_34');

function indonez_col_34_last($atts, $content = null ) {
   return '<div class="col_34 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_34_last', 'indonez_col_34_last');

/* ======================================
   Inner Columns
   ======================================*/
function indonez_col_12_inner( $atts, $content = null ) {
   return '<div class="col_12_inner">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_12_inner', 'indonez_col_12_inner');

function indonez_col_12_inner_last( $atts, $content = null ) {
   return '<div class="col_12_inner last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_12_inner_last', 'indonez_col_12_inner_last');

function indonez_col_13_inner( $atts, $content = null ) {
   return '<div class="col_13_inner">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_13_inner', 'indonez_col_13_inner');

function indonez_col_13_inner_last( $atts, $content = null ) {
   return '<div class="col_13_inner last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_13_inner_last', 'indonez_col_13_inner_last');

function indonez_col_14_inner( $atts, $content = null ) {
   return '<div class="col_14_inner">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14_inner', 'indonez_col_14_inner');

function indonez_col_24_inner( $atts, $content = null ) {
   return '<div class="col_24_inner">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_24_inner', 'indonez_col_24_inner');

function indonez_col_14_inner_last( $atts, $content = null ) {
   return '<div class="col_14_inner last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_14_inner_last', 'indonez_col_14_inner_last');

function indonez_col_23_inner( $atts, $content = null ) {
   return '<div class="col_23_inner">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_23_inner', 'indonez_col_23_inner');

function indonez_col_23_inner_last( $atts, $content = null ) {
   return '<div class="col_23_inner last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_23_inner_last', 'indonez_col_23_inner_last');

function indonez_col_34_inner($atts, $content = null ) {
   return '<div class="col_34_inner">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_34_inner', 'indonez_col_34_inner');

function indonez_col_34_inner_last($atts, $content = null ) {
   return '<div class="col_34_inner last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('col_34_inner_last', 'indonez_col_34_inner_last');


/* ======================================
   Buttons 
   ======================================*/
function indonez_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
        'color'      => '',
        'size'      => '',
    ), $atts));
  
  
	$out = "<a class=\"button $color $size\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
  return $out;
}
add_shortcode('button', 'indonez_button');

/* ======================================
   Video
   ======================================*/
#### Vimeo eg http://vimeo.com/5363880 id="5363880"
function vimeo_code($atts,$content = null){

	extract(shortcode_atts(array(  
		"id" 		=> '',
		"width"		=> '', 
		"height" 	=> ''
	), $atts)); 
	 
	$data = "<object width='$width' height='$height' data='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com&amp;autoplay=0&amps;loop=0' type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' />
		</object>";
	return $data;
} 
add_shortcode("vimeo_video", "vimeo_code"); 

#### YouTube eg http://www.youtube.com/v/MWYi4_COZMU&hl=en&fs=1& id="MWYi4_COZMU&hl=en&fs=1&"
function youTube_code($atts,$content = null){

	extract(shortcode_atts(array(  
      "id" 		=> '',
  		"width"		=> '', 
  		"height" 	=> ''
		 ), $atts)); 
	 
	$data = "<object width='$width' height='$height' data='http://www.youtube.com/v/$id' type='application/x-shockwave-flash'>			
      <param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='FlashVars' value='playerMode=embedded' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://www.youtube.com/v/$id' />
		</object>";
	return $data;
} 
add_shortcode("youtube_video", "youTube_code");

/* ======================================
   Child pages list base on parent page
   ====================================== */
function indonez_pagelist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "parent_page" => '',
    "num" => '',
    "orderby" => '',
    "order" => ''
  ),$atts));
   
  return indonez_pagelist($parent_page,$num,$orderby,$order);
}

add_shortcode('pagelist','indonez_pagelist_shortcode');

/* ======================================
   Post list base on category
   ======================================*/
function indonez_postlist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "category" => '',
    "num" => '',
    "orderby" => '',
    "order" => ''
  ),$atts));
  
  return indonez_postslist($category, $num, $orderby,$order);
}

add_shortcode('postlist','indonez_postlist_shortcode');

/* ======================================
   Blog list base on category
   ======================================*/
function indonez_bloglist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "cat" => '',
    "num" => '' 
  ),$atts));
  
  return indonez_bloglist($cat, $num);
}

add_shortcode('bloglist','indonez_bloglist_shortcode');



/* ======================================
   Google Map
   ======================================*/
function theme_shortcode_googlemap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		"width" => false,
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 14,
		"html" => '',
		"popup" => 'false',
		"controls" => 'false',
		'pancontrol' => 'true',
		'zoomcontrol' => 'true',
		'maptypecontrol' => 'true',
		'scalecontrol' => 'true',
		'streetviewcontrol' => 'true',
		'overviewmapcontrol' => 'true',
		"scrollwheel" => 'true',
		'doubleclickzoom' =>'true',
		"maptype" => 'ROADMAP',
		"marker" => 'true',
		'align' => false,
	), $atts));
	
	if($width){
		if(is_numeric($width)){
			$width = $width.'px';
		}
		$width = 'width:'.$width.';';
	}else{
		$width = '';
		$align = false;
	}
	if($height){
		if(is_numeric($height)){
			$height = $height.'px';
		}
		$height = 'height:'.$height.';';
	}else{
		$height = '';
	}
	
	wp_print_scripts( 'jquery-gmap');
	
	/* fix */
	$search  = array('G_NORMAL_MAP', 'G_SATELLITE_MAP', 'G_HYBRID_MAP', 'G_DEFAULT_MAP_TYPES', 'G_PHYSICAL_MAP');
	$replace = array('ROADMAP', 'SATELLITE', 'HYBRID', 'HYBRID', 'TERRAIN');
	$maptype = str_replace($search, $replace, $maptype);
	/* end fix */
	
	if($controls == 'true'){
		$controls = <<<HTML
{
	panControl: {$pancontrol},
	zoomControl: {$zoomcontrol},
	mapTypeControl: {$maptypecontrol},
	scaleControl: {$scalecontrol},
	streetViewControl: {$streetviewcontrol},
	overviewMapControl: {$overviewmapcontrol}
}
HTML;
	}
	
	$align = $align?' align'.$align:'';
	$id = rand(100,1000);
	if($marker != 'false'){
		return <<<HTML
<div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div>
[raw]
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion');
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery(this).gMap({
			zoom: {$zoom},
			markers:[{
				address: "{$address}",
				latitude: {$latitude},
				longitude: {$longitude},
				html: "{$html}",
				popup: {$popup}
			}],
			controls: {$controls},
			maptype: '{$maptype}',
			doubleclickzoom:{$doubleclickzoom},
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	if(tabs.size()!=0){
		tabs.find('ul.tabs,ul.mini_tabs,.accordion').data("tabs").onClick(function(index) {
			this.getCurrentPane().find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
[/raw]
HTML;
	}else{
return <<<HTML
<div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div>
[raw]
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion');
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery("#google_map_{$id}").gMap({
			zoom: {$zoom},
			latitude: {$latitude},
			longitude: {$longitude},
			address: "{$address}",
			controls: {$controls},
			maptype: '{$maptype}',
			doubleclickzoom:{$doubleclickzoom},
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	if(tabs.size()!=0){
		tabs.find('ul.tabs,ul.mini_tabs,.accordion').data("tabs").onClick(function(index) {
			this.getCurrentPane().find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
[/raw]
HTML;
	}
}

add_shortcode('gmap','theme_shortcode_googlemap');

function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h5 class="toggle_title">' . $title . '</h5><div class="toggle_content"><p>' . do_shortcode(trim($content)) . '</p></div></div>';
}
add_shortcode('toggle', 'theme_shortcode_toggle');

/* Tabs and Accordiaon */
function theme_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<div class="tabs-wrapper"><ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div></div>';
		
		return '<div class="'.$code.'_container">' . $output . '</div>';
	}
}
add_shortcode('tabs', 'theme_shortcode_tabs');
add_shortcode('mini_tabs', 'theme_shortcode_tabs');
?>