<?php
/* Register Custom Post Type for Slideshow */
function slideshow_post_type_init() {
  $labels = array(
    'name' => __('Slideshow', 'post type general name','tucana'),
    'singular_name' => __('slideshow', 'post type singular name','tucana'),
    'add_new' => __('Add New', 'slideshow','tucana'),
    'add_new_item' => __('Add New slideshow','tucana'),
    'edit_item' => __('Edit slideshow','tucana'),
    'new_item' => __('New slideshow','tucana'),
    'view_item' => __('View slideshow','tucana'),
    'search_items' => __('Search slideshow','tucana'),
    'not_found' =>  __('No slideshow found','tucana'),
    'not_found_in_trash' => __('No slideshow found in Trash','tucana'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'slideshow_item',
      'with_front' => FALSE,
    ),
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'comments',
      'thumbnail',
      'trackbacks',
      'custom-fields',
      'revisions'       
    )
  );
  register_post_type('slideshow',$args);
}

add_action('init', 'slideshow_post_type_init');
                
/* Register Custom Post Type for Products */
add_action('init', 'products_post_type_init');
function products_post_type_init() {
  $labels = array(
    'name' => __('Products', 'post type general name','tucana'),
    'singular_name' => __('Products', 'post type singular name','tucana'),
    'add_new' => __('Add New', 'Products','tucana'),
    'add_new_item' => __('Add New Products','tucana'),
    'edit_item' => __('Edit Products','tucana'),
    'new_item' => __('New Products','tucana'),
    'view_item' => __('View Products','tucana'),
    'search_items' => __('Search Products','tucana'),
    'not_found' =>  __('No Products found','tucana'),
    'not_found_in_trash' => __('No Products found in Trash','tucana'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'product_item',
      'with_front' => FALSE,
    ),    
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt'  
    )
  );
  register_post_type('products',$args);
}

	register_taxonomy("products_cats", 
  	array("products"), 
  	array( "hierarchical" => true, 
  			"label" => __("Product Categories",'tucana'), 
  			"singular_label" => __("Product Categories",'tucana'), 
  			"rewrite" => true,
  			"query_var" => true,
        "rewrite" => array(
          "slug" => "product_category"
        )				 				    			
  		));

/* Register Custom Post Type for Dealer */
add_action('init', 'dealer_post_type_init');
function dealer_post_type_init() {
  $labels = array(
    'name' => __('Dealer', 'post type general name','tucana'),
    'singular_name' => __('Dealer', 'post type singular name','tucana'),
    'add_new' => __('Add New', 'Products','tucana'),
    'add_new_item' => __('Add New Products','tucana'),
    'edit_item' => __('Edit Dealer','tucana'),
    'new_item' => __('New Dealer','tucana'),
    'view_item' => __('View Dealer','tucana'),
    'search_items' => __('Search Dealer','tucana'),
    'not_found' =>  __('No Dealer found','tucana'),
    'not_found_in_trash' => __('No Dealer found in Trash','tucana'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'dealer_detail',
      'with_front' => FALSE,
    ),    
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt'  
    )
  );
  register_post_type('dealer',$args);
}