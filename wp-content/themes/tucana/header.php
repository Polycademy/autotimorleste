<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"  />
<title><?php if (is_home () ) { bloginfo('name'); echo " - "; bloginfo('description'); 
} elseif (is_category() ) {single_cat_title(); echo " - "; bloginfo('name');
} elseif (is_single() || is_page() ) {single_post_title(); echo " - "; bloginfo('name');
} elseif (is_search() ) {bloginfo('name'); echo " search results: "; echo esc_html($s);
} else { wp_title('',true); }?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="follow, all" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php global $data; ?>
<?php $favico = $data['favicon'];?>
<link rel="shortcut icon" href="<?php echo ($favico) ? $favico : get_template_directory_uri().'/images/favicon.ico';?>"/>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<link href='http://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css' />
<?php wp_head(); ?>

<script type="text/javascript">
  jQuery(document).ready(function($) {
	$('#newsflash-text').cycle({
    timeout: 5000,  // milliseconds between slide transitions (0 to disable auto advance)
    fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...                        
    pause:   0,	  // true to enable "pause on hover"
    cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
    pauseOnPagerHover: 0 // true to pause when hovering over pager link
  });  
  
  <?php if (is_home()) { ?>
  <?php 
  $slideshow_speed = $data['slideshow_speed'];
  $slideshow_transition = $data['slide_transition'];
  ?>
	$('#slideshow').cycle({
    timeout: <?php echo $slideshow_speed ? $slideshow_speed : 4000;?>,  // milliseconds between slide transitions (0 to disable auto advance)
    fx:      '<?php echo $slideshow_transition ? $slideshow_transition : "fade";?>', // choose your transition type, ex: fade, scrollUp, shuffle, etc...                        
    pause:   0,	  // true to enable "pause on hover"
		pager:'#pagerslide',
		cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
    pauseOnPagerHover: 0 // true to pause when hovering over pager link
  });      
  <?php } ?>
});
</script>

<!--[if IE 6]>    
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/DD_belatedPNG.js"></script>
	<script type="text/javascript"> 
	   DD_belatedPNG.fix('img'); 
	</script>    
<![endif]-->
<!--[if IE 7]>    
    <style type="text/css">
       .shadow{padding:4px; border:1px solid #e4e4e4;}
	</style>    
<![endif]-->
<!--[if IE 8]>    
    <style type="text/css">
       .shadow{padding:4px; border:1px solid #e4e4e4;}
	</style>    
<![endif]-->
</head>

<body <?php $class =''; body_class( $class ); ?>>
<!-- Begin Wrapper -->
<?php if ( ! isset( $content_width ) ) $content_width='';?>
<div id="wrapper">
	<div id="container">
    
    	<!-- Begin of Top -->
        <div id="top">
        	
            <!-- Begin of Logo -->
            <div id="logo">
              <?php $logo = $data['main_logo']; ?>
              <a href="<?php echo home_url();?>"><img src="<?php echo ($logo) ? $logo : get_template_directory_uri().'/images/toyota_atl_logo.png';?>" alt="Logo"/></a>
            </div>
            <!-- End of Logo -->
            
            <!-- Begin of Mainmenu -->
            <div id="mainmenu">
            	<?php 
                if (function_exists('wp_nav_menu')) { 
                  wp_nav_menu( array( 'menu_id' => 'menu','menu_class' => '', 'theme_location' => 'topnav', 'fallback_cb'=>'','depth' =>4 ) );
                } 
                ?>
            </div>
            <!-- End Of Mainmenu -->
            
        </div>
        <!-- End Of Top -->