<?php


/* ===================================== Custom Post Excerpt ============================== */
function excerpt($excerpt_length) {
  global $post;
	$content = $post->post_content;
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
  
  $content = strip_tags(strip_shortcodes($content));
  
	return $content;

}

function indonez_truncate($string, $limit, $break=".", $pad="...") {
	if(strlen($string) <= $limit) return $string;
	
	 if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	  }
	return $string; 
}

/* ===================================== Comments ============================== */
function indonez_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div class="avatar"><?php echo get_avatar($comment,$size='64'); ?></div>
     <div class="comment-text" ><h4><?php echo get_comment_author_link(); ?></h4>
      <?php if ($comment->comment_approved == '0') : ?>
			<em><?php echo __('Your comment is awaiting moderation.','tucana');?></em>
			<div class="clear"></div>
			<?php endif; ?>
		  <?php comment_text() ?>
      <small>
        <?php printf(__('%1$s at %2$s','tucana'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)','tucana'),'  ','') ?>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </small>
      </div>
  </li>   
<?php
}

// Output the styling for the seperated Pings
function indonez_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


/* ===================================== Content Filter ============================== */
/**
 * Disable Automatic Formatting on Posts
 * Thanks to TheBinaryPenguin (http://wordpress.org/support/topic/plugin-remove-wpautop-wptexturize-with-a-shortcode)
 */
function theme_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');

add_filter('the_content', 'theme_formatter', 99);

/* Remove Wordpress automatic formatting */
function remove_wpautop( $content ) { 
    $content = do_shortcode( shortcode_unautop( $content ) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

function theme_widget_text_shortcode($content) {
	$content = do_shortcode($content);
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= do_shortcode($piece);
		}
	}

	return $new_content;
}
// Allow Shortcodes in Sidebar Widgets
add_filter('widget_text', 'theme_widget_text_shortcode');


add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

add_theme_support('automatic-feed-links');

/* ===================================== Latest News Scroll ============================== */
/* Latest News */
function indonez_latestnews_scroll($num=4,$title="") { 
  global $post,$data;
  
  echo $title;
  
  $blog_cats_include = $data['blog_categories'];
  if(is_array($blog_cats_include)) {
    $blog_cats_include = implode(",",$blog_cats_include);
  }  
  
  query_posts('cat='.$blog_cats_include.'&showposts='.$num);
  ?>
  <!-- Begin of Newsflash -->
	<div id="newsflash">
      <div id="tnews"><?php echo __('Latest news','tucana');?></div>
      <div id="newsflash-text">
        <?php
        while ( have_posts() ) : the_post();
        ?>
      	<span><a href="<?php the_permalink();?>"><strong><?php the_time( get_option('date_format') ); ?> </strong> - <?php the_title();?></a> &rarr; </span>
        <?php endwhile;?>
        <?php wp_reset_query();?>
      </div>
    </div>
    <!-- End Of Newsflash -->
  <?php
}


/* ===================================== Latest Products ============================== */
function indonez_latestproducts($num=2,$title="") { 
  global $post;
  
  if ($title!="") echo $title;
  
  query_posts(array( 'post_type' => 'products', 'showposts' => $num,'orderby'=>'date'));
  ?>
  <ul class="list2">
    <?php 
    $counter = 0;
    while (have_posts()) : the_post();
    $product_url = get_post_meta($post->ID,"_product_url",true);
    $product_highlights = get_post_meta($post->ID,'_product_highlight',true);
    $product_highlights = explode(",",$product_highlights);
    $counter++;
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 92,92, true ); //resize & crop the image
    ?>
   	  <li <?php if ($counter %2 == 0) echo 'class="marginoff"';?>>
          <img src="<?php echo $image;?>" alt="" class="imgleft shadow" />
          <h5 class="heading-green"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
          <span><?php echo get_the_excerpt();?></span>
          <span class="but-details"><a href="<?php the_permalink();?>"><?php echo __('Details','tucana');?></a></span>
          <?php if ($product_url !="") { ?>
            <span class="but-buynow"><a href="#"><?php echo __('Buy Now','tucana');?></a></span>
          <?php } ?>
           <?php if ($counter %2 == 0) echo '<br/><br/>';?>
      </li>
    <?php endwhile;wp_reset_query();?>
  </ul>
  <?php
}

/* ===================================== Latest Products Scroll ============================== */
function indonez_latestproducts_scroll($num=4,$title="") { 
  global $post;
  
  query_posts(array( 'post_type' => 'products', 'posts_per_page' => $num,'orderby'=>'date'));
  ?>
  <div class="box2">
  	<h5><?php if ($title!="") echo $title;?></h5>
      <div id="arrowprev"></div>
      <div id="arrownext"></div>
  	<div id="scroll-box">
    <?php 
    $counter = 0;
    while (have_posts()) : the_post();
    $product_url = get_post_meta($post->ID,"_product_url",true);
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 185,104, true ); //resize & crop the image
    ?>
    	<div>
        <img src="<?php echo $image;?>"  alt="" /><br />
        <span class="green-text"><?php the_title();?></span>
      </div>
    <?php endwhile;?>
    </div>
  </div>
  <div class="clr" style="margin-bottom: 20px;"></div>
  <?php
}

function main_delear_list($title="",$num=4) { ?>
  <h3><?php echo $title;?></h3><br />
  <img src="<?php echo get_template_directory_uri();?>/images/map.gif" width="253" height="131" alt="" />
  <ul class="list1">
  <?php
  query_posts(array( 'post_type' => 'dealer', 'posts_per_page' => $num,"orderby" => 'date','order'=> 'DESC'));
  while (have_posts()) : the_post();
  ?>
  	<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
  <?php endwhile;wp_reset_query();?>
  </ul>
<?php  
}

/* ===================================== Delear List Widget ============================== */
function indonez_delear_list($num=4,$title="") { 
  global $post;
  
  echo $title;
  
  query_posts(array( 'post_type' => 'dealer', 'posts_per_page' => $num,'orderby'=>'date'));
  ?>
    <ul>
  	<?php 
    $counter = 0;
    while (have_posts()) : the_post();
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 64,64, true ); //resize & crop the image
    ?>
    <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
    
    <?php endwhile;?>
    </ul>
  <?php
}

/* ===================================== Post Scroll ============================== */
function indonez_postscroll($category, $num, $orderby="date",$order="DESC") {  
  global $post;
  
  $category_id = get_cat_ID($category);
  
  $cat_num = ($num) ? $num : 4;
  $counter = 0;
  $out = "";
  query_posts('cat='.$category_id.'&posts_per_page='.$cat_num.'&orderby='.$orderby.'&order='.$order);
  ?>
  <ul id="fade-box">
  <?php  
  while (have_posts()) : the_post();
  $thumb   = get_post_thumbnail_id();
  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
  $image   = aq_resize( $img_url, 254, 100, true ); //resize & crop the image
  $page_description = get_post_meta($post->ID,'_page_short_desc',true);
  $counter++;
  ?>
    <li>
    	<img src="<?php echo $image;?>"  alt="" /><br />
      <h5 class="heading-green"><?php the_title();?></h5>
    </li>
  <?php endwhile;?>
   </ul>
   <div id="fade-nav"></div>
<?php   
}
                
/* ===================================== Testimonials ============================== */
function indonez_testimonial($cat,$num=1,$title="",$place="") {
  global $post;
  
  echo $title;
  ?>
  <?php
    if (!is_numeric($cat))
      $testicatid = get_cat_ID($cat); 
    else 
      $testicatid = $cat;
    
    query_posts('cat='.$testicatid.'&showposts='.$num.'&orderby=rand');
    ?>
    <?php    
    while ( have_posts() ) : the_post();
    ?>
    <blockquote><?php the_content();?></blockquote>
    <p class="testiname"><?php the_title();?></p>
    <div class="sidebarheading"></div>    
  <?php endwhile;wp_reset_query();?>
  <?php
}

/* ===================================== Vimeo and Youtube Video ID ============================== */
/* Get vimeo Video ID */
function vimeo_videoID($url) {
	if ( 'http://' == substr( $url, 0, 7 ) ) {
		preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches );
		if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ovum');

		$videoid = $matches[3];
		return $videoid;
	}
}

/* Get Youtube Video ID */
function youtube_videoID($url) {
	preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $url, $matches );
	if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ovum');
  
  $videoid = $matches[3];
	return $videoid;
}

// Use shortcodes in text widget.
add_filter('widget_text', 'do_shortcode');

/* ===================================== Localization ============================== */
// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'tucana', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/* ===================================== Posts List ============================== */
function indonez_postslist($category, $num, $orderby="date",$order="DESC") {  
  global $post;
  
  $category_id = get_cat_ID($category);
  
  $cat_num = ($num) ? $num : 4;
  $counter = 0;
  $out = "";
  query_posts('cat='.$category_id.'&posts_per_page='.$cat_num.'&orderby='.$orderby.'&order='.$order);
  
  while (have_posts()) : the_post();
  $thumb   = get_post_thumbnail_id();
  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
  $image   = aq_resize( $img_url, 78, 78, true ); //resize & crop the image
  $page_description = get_post_meta($post->ID,'_page_short_desc',true);
  $counter++;
    
    if ($counter %2 ==0) {
      $out .= '<div class="col_12_inner last">'; 
    } else {
      $out .= '<div class="col_12_inner">';
    }
	  $out .= '<div class="title-box">';
  	$out .= '<div class="number">'.$counter.'</div>';
  	$out .= '<h2 class="heading-green"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
    $out .= '</div>';
    $out .= '<img src="'.$image.'" alt="" class="imgleft shadow" />';
    $out .= '<span>'.get_the_excerpt().'</span>';
    $out .= '</div>';
    if ($counter %2 ==0) $out .= '<div class="clr" style="margin-bottom:10px;"></div>';
  
  endwhile;
  wp_reset_query();
  return $out;
}

/* ===================================== Pages List ============================== */
function indonez_pagelist($page_name, $num, $orderby="menu_order",$order="DESC") {  
  global $post;
  
  $page_id = get_page_by_title($page_name);
  
  $page_num = ($num) ? $num : 4;
  $counter = 0;
  $out = "";
     
  query_posts('post_type=page&post_parent='.$page_id->ID.'&posts_per_page='.$page_num.'&orderby='.$orderby.'&order='.$order);
    
  while (have_posts()) : the_post();
  $thumb   = get_post_thumbnail_id();
  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
  $image   = aq_resize( $img_url, 78, 78, true ); //resize & crop the image
  $page_description = get_post_meta($post->ID,'_page_short_desc',true);
  $counter++;
    
    if ($counter %2 ==0) {
      $out .= '<div class="col_12_inner last">'; 
    } else {
      $out .= '<div class="col_12_inner">';
    }
	  $out .= '<div class="title-box">';
  	$out .= '<div class="number">'.$counter.'</div>';
  	$out .= '<h5 class="heading-green"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>'.stripslashes($page_description);
    $out .= '</div>';
    $out .= '<img src="'.$image.'" alt="" class="imgleft shadow" />';
    $out .= '<span>'.get_the_excerpt().'</span>';
    $out .= '</div>';
    if ($counter %2 ==0) $out .= '<div class="clr" style="margin-bottom:10px;"></div>';
  endwhile;        
  wp_reset_query();
  return $out;
}

/* ===================================== Custom Columns ============================== */
/* Thumbnail Column */
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
 
  function fb_AddThumbColumn($cols) {
    $cols['thumbnail'] = __('Thumbnail','tucana');
    return $cols;
  }
   
  function fb_AddThumbValue($column_name, $post_id) {
   
  $width = (int) 100;
  $height = (int) 100;
   
  if ( 'thumbnail' == $column_name ) {
    // thumbnail of WP 2.9
    $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
    // image from gallery
    $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
    if ($thumbnail_id)
    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
    elseif ($attachments) {
      foreach ( $attachments as $attachment_id => $attachment ) {
        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
      }
    }
      if ( isset($thumb) && $thumb ) {
      echo $thumb;
      } else {
      echo __('None','tucana');
      }
    }
  }
 
  // for posts
  add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
  add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
   
  // for pages
  add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
  add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
  
  // for Products
  add_filter( 'manage_products_columns', 'fb_AddThumbColumn' );
  add_action( 'manage_products_custom_column', 'fb_AddThumbValue', 10, 2 );
  
  // for slideshow
  add_filter( 'manage_slideshow_columns', 'fb_AddThumbColumn' );
  add_action( 'manage_slideshow_custom_column', 'fb_AddThumbValue', 10, 2 );
}

add_action('manage_posts_custom_column',  'products_show_columns');
function products_show_columns($name) {
    global $post;
    switch ($name) {
        case 'category':
            $cats = get_the_term_list( $post->ID, 'products_category', '', ', ', '' );
            echo $cats;
    }
}

/*	===================================== Post Thumbnail ============================== */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

function indonez_resize_image($width="",$height="",$crop=true){
  global $post;
  
  $thumb = get_post_thumbnail_id();
  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
  $image = aq_resize( $img_url, $width, $height, $crop ); //resize & crop the image

  return $image;
}

/* ===================================== Add Custom Javascript ============================== */

function indonez_add_javascripts() {
  
  wp_enqueue_scripts('jquery'); 
  wp_enqueue_script( 'jquery.cycle', get_template_directory_uri().'/js/jquery.cycle.all.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.tools.tabs.min', get_template_directory_uri().'/js/jquery.tools.tabs.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.gmap.min', get_template_directory_uri().'/js/jquery.gmap.min.js', array('jquery'));
  wp_enqueue_script( 'filterable.pack', get_template_directory_uri().'/js/filterable.pack.js', array( 'jquery' ) );
  wp_enqueue_script( 'functions', get_template_directory_uri().'/js/functions.js', array( 'jquery' ) );
  if (is_page_template('gallery.php')) {
    wp_enqueue_script( 'jquery.aw-showcase.min', get_template_directory_uri().'/js/jquery.aw-showcase.min.js', array( 'jquery' ) );  
  }
}

if (!is_admin()) {
  add_action( 'wp_print_scripts', 'indonez_add_javascripts' ); 
}

/* ===================================== Add Custom Stylesheet ============================== */

function indonez_add_stylesheet() { 
  ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/prettyPhoto.css" type="text/css" media="screen" />
<?php if (is_page_template('gallery.php')) { ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/gallery-style.css" type="text/css" media="screen" />
  <?php  
    }
}

add_action('wp_head', 'indonez_add_stylesheet');


/* ===================================== Register Nav Menu Features ============================== */

register_nav_menus( array(
	'topnav' => __( 'Main Navigation','tucana'),
  'footernav' => __( 'Footer Navigation','tucana')
) );

/* Remove Default Container for Nav Menu Features */
function imediapixel_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
} 
add_filter( 'wp_nav_menu_args', 'imediapixel_nav_menu_args' );

/* ===================================== pagination function ===================================== */
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"pages blogpages\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

/* ===================================== Post type pagination ===================================== */

// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
	global $data;
	global $option_posts_per_page;
	
	// Get theme panel admin
	if($data['product_number_per_page']) {
		$product_number_per_page = $data['product_number_per_page'];
		} else {
			$product_number_per_page = '-1';
			}
	
    if (is_tax( 'products_cats') ) {
        return $product_number_per_page;
    }
	else {
        return $option_posts_per_page;
    }
}

function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*-----------------------------------------------------------------------------------*/
/*	Output Custom CSS Into Header
/*-----------------------------------------------------------------------------------*/

function indonez_custom_css() {
  global $data;
  
  $custom_css_code = $data['custom_css'];
  $body_font = $data['body_font'];
  
  if ($custom_body_text !== "") {
    $custom_css .=  'body { font-family: '.$body_font['face'].';font-size:'.$body_font['size'].'px;font-style:'.$body_font['style'].'}';
  }
  
  if ($custom_css_code !="") {
    $custom_css .= $custom_css_code;
  }
  
	/**echo all css**/
	$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css . "\n</style>";
	
	if(!empty($custom_css)) {
		echo $css_output;
	}
}

add_action('wp_head', 'indonez_custom_css');
?>
