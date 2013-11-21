<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
    }
		//$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		$of_slide_effects = array("fade","scrollUp","scrollDown","scrollRight","scrollLeft","scrollHorz","scrollVert");
    
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		
		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( "name" => "General",
					"type" => "heading");
					
$of_options[] = array( "name" => "Custom Logo",
					"desc" => "Upload your logo here, or define the URL directly",
					"id" => "main_logo",
					"std" => "",
					"type" => "media");
					
$of_options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload your logo here, or define the URL directly",
					"id" => "favicon",
					"std" => "",
					"type" => "media");
          
$of_options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => "google_analytics",
					"std" => "",
					"type" => "textarea");        

$of_options[] = array( "name" => "404 Text",
					"desc" => "Enter your 404 (Page Not Found) text here.",
					"id" => "page_not_found_text",
					"std" => "",
					"type" => "textarea");        

$of_options[] = array( "name" => "Footer Text (copyright)",
					"desc" => "Enter your footer text here.",
					"id" => "footer_text",
					"std" => "",
					"type" => "textarea");  
					
$of_options[] = array( "name" => "Homepage",
                    "type" => "heading");

$of_options[] = array( "name" => "Promo Boxes",
					"desc" => "",
					"id" => "introduction",
					"std" => "Homepage 2 Columns promo boxes",
					"icon" => true,
					"type" => "info");                                                          

$of_options[] = array( "name" => "Promo Box 1 Title",
					"desc" => "Promo box 1 title here.",
					"id" => "promobox1_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Promo Box 1 URL",
					"desc" => "Promo box 1 URL here.",
					"id" => "promobox1_url",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Promo Box 1 Image",
					"desc" => "Promo box 1 image here.",
					"id" => "promobox1_image",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "Promo Box 1 Description",
					"desc" => "Promo box 1 short description here.",
					"id" => "promobox1_desc",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Promo Box 2 Title",
					"desc" => "Promo box 2 title here.",
					"id" => "promobox2_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Promo Box 2 URL",
					"desc" => "Promo box 2 URL here.",
					"id" => "promobox2_url",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Promo Box 2 Image",
					"desc" => "Promo box 2 image here.",
					"id" => "promobox2_image",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "Promo Box 1 Description",
					"desc" => "Promo box 2 short description here.",
					"id" => "promobox2_desc",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Slideshow",
					"type" => "heading");

$of_options[] = array( "name" => "Slideshow Items Order",
					"desc" => "Select your order parameter for slideshow items.",
					"id" => "slideshow_order",
					"std" => "date",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    

$of_options[]	= array(	"name" => "Slideshow speed",
    			"desc" => "Please enter your slideshow here (in millisecond), eg. 4000.",
          "std" => "4000",
    			"id" => "slideshow_speed",
    			"type" => "text");				                                                    

$of_options[]	= array(	"name" => "Transition Types",
    			"desc" => "Please select transition types for your slideshow translation effect.",
    			"id" => "slide_transition",
          "std" => "fade",
    			"type" => "select",
          "options" => $of_slide_effects);
          
$of_options[] = array( "name" => "Enable Slideshow Background",
					"desc" => "This checkbox will hide/show a couple of options group. Try it out!",
					"id" => "enable_slide_bg",
					"std" => 0,
  			   "folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Select Slideshow Background",
					"desc" => "Please select your background as default slideshow background",
					"id" => "slide_bg",
					"std" => "",
          "fold" => "enable_slide_bg", /* the checkbox hook */
					"type" => "select",
          "options" => array("bg-slide1","bg-slide2","bg-slide3","bg-slide4"));
                    
$of_options[] = array( "name" => "Showroom",
					"type" => "heading");

$of_options[] = array( "name" => "Product Items Order",
					"desc" => "Select your order parameter for product items.",
					"id" => "showroom_order",
					"std" => "date",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));

$of_options[]	= array(	"name" => "Product Items number per group category",
    			"desc" => "Please enter your items number for each group product categories.",
          "std" => "4",
    			"id" => "product_item_number",
    			"type" => "text");

$of_options[]	= array(	"name" => "Product Items number per category page",
    			"desc" => "Please enter your items number for each group product categories.",
          "std" => "4",
    			"id" => "product_number_per_page",
    			"type" => "text");

$of_options[] = array( "name" => "Additional Products Page Information boxes (3 columns)",
					"desc" => "",
					"id" => "add_product_box",
					"std" => "Additional Products Page Information boxes (3 columns)",
					"icon" => true,
					"type" => "info");                                                          

$of_options[] = array( "name" => "Box 1 Title",
					"desc" => " box 1 title here.",
					"id" => "add_product_box1_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Box 1 URL",
					"desc" => "box 1 URL here.",
					"id" => "add_product_box1_url",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Box 1 Image",
					"desc" => "Promo box 1 image here.",
					"id" => "add_product_box1_image",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "Box 1 Description",
					"desc" => "box 1 short description here.",
					"id" => "add_product_box1_desc",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Box 2 Title",
					"desc" => " box 2 title here.",
					"id" => "add_product_box2_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Box 2 URL",
					"desc" => "box 2 URL here.",
					"id" => "add_product_box2_url",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Box 2 Image",
					"desc" => "Promo box 2 image here.",
					"id" => "add_product_box2_image",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "Box 2 Description",
					"desc" => "box 2 short description here.",
					"id" => "add_product_box2_desc",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Box 3 Title",
					"desc" => " box 3 title here.",
					"id" => "add_product_box3_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Box 3 URL",
					"desc" => "box 3 URL here.",
					"id" => "add_product_box3_url",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Box 3 Image",
					"desc" => "Promo box 3 image here.",
					"id" => "add_product_box3_image",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "Box 3 Description",
					"desc" => "box 3 short description here.",
					"id" => "add_product_box3_desc",
					"std" => "",
					"type" => "textarea");
          
$of_options[] = array( "name" => "Dealer",
					"type" => "heading");

$of_options[] = array( "name" => "Dealer Items Order",
					"desc" => "Select your order parameter for slideshow items.",
					"id" => "dealer_order",
					"std" => "date",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));
          
$of_options[]	= array(	"name" => "Dealer number per page",
    			"desc" => "Please enter your number for dealer per page.",
          "std" => "6",
    			"id" => "dealer_item_number",
    			"type" => "text");					                                                    

$of_options[] = array( "name" => "Blog",
					"type" => "heading");

$of_options[] = array( "name" => "Blog Categories",
					"desc" => "Please check the categories that you want to include in Blog page.",
					"id" => "blog_categories",
					"std" => "",
					"type" => "multicheck",
					"options" => $of_categories);
          
$of_options[] = array( "name" => "Blog Items Order",
					"desc" => "Select your order parameter for blog items.",
					"id" => "blog_order",
					"std" => "date",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));
          
$of_options[]	= array(	"name" => "Blog items number per page",
    			"desc" => "Please enter your number for blog items per page.",
          "std" => "3",
    			"id" => "blog_item_number",
    			"type" => "text");			

$of_options[] = array( "name" => "Disable Post Meta?",
					"desc" => "Please check this option if you want to disable blog post meta (date, author, comment, category) info.",
					"id" => "disable_postmeta",
					"std" => 0,
					"type" => "checkbox");    
                    
$of_options[] = array( "name" => "Contact",
					"type" => "heading");

$of_options[] = 	array(	"name" => "Latitude",
			"desc" => "Enter your latitude here, for quick search your latitude, please visit <a href='http://itouchmap.com/latlong.html'>http://itouchmap.com/latlong.html</a>",
      "std" => "",
			"id" => "info_latitude",
			"type" => "text");

$of_options[] = 	array(	"name" => "Longitude",
			"desc" => "Enter your longitude here, for quick search your longitude, <a href='http://itouchmap.com/latlong.html'>http://itouchmap.com/latlong.html</a>",
      "std" => "",
			"id" => "info_longitude",
			"type" => "text");
      
$of_options[] = array( "name" => "Your main office addess",
					"desc" => "Please add your main office address here.",
					"id" => "info_address",
					"std" => "",
					"type" => "textarea");    

$of_options[] = array( "name" => "Phone nubmer",
					"desc" => "Please add your phone number here.",
					"id" => "info_phone",
					"std" => "",
					"type" => "text");    


$of_options[] = array( "name" => "Additional Phone nubmer",
					"desc" => "Please add your phone number here.",
					"id" => "info_phone2",
					"std" => "",
					"type" => "text");    
          
$of_options[] = array( "name" => "FAX nubmer",
					"desc" => "Please add your FAX number here.",
					"id" => "info_fax",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "E-mail Address",
					"desc" => "Please add your e-mail address here.",
					"id" => "info_email",
					"std" => "",
					"type" => "text");
          
$of_options[] = array( "name" => "Addiotional E-mail Address",
					"desc" => "Please add your e-mail address here.",
					"id" => "info_email2",
					"std" => "",
					"type" => "text");
          
$of_options[] = array( "name" => "Success Message",
					"desc" => "Please add success message for contact form.",
					"id" => "success_message",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Styling",
					"type" => "heading");
          
$of_options[] = array( "name" => "Body Font",
					"desc" => "Specify the body font properties",
					"id" => "body_font",
					"std" => array('size' => '12px','face' => 'arial','style' => 'normal','color' => '#b5b5b5'),
					"type" => "typography");  
					
$of_options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");

// Backup Options
$of_options[] = array( "name" => "Backup",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
