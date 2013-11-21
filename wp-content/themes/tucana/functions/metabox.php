<?php  

function indonez_slideshow_meta_boxes() {

  $meta_boxes = array(
    "slideshow_url" => array(
      "name" => "_slideshow_url",
      "title" => __("Custom Slideshow URL",'tucana'),
      "description" => __("Custom URL for slideshow items.",'tucana'),
      "type" => "text"
    ),
    "features_highlight" => array(
      "name" => "_features_highlight",
      "title" => __("Features Highlight",'tucana'),
      "description" => __("Add product featuire highlights in a new line-separated, eg.<br/> Feature 1<br/>Feature 2",'tucana'),
      "type" => "textarea"
    ),
  );

	return apply_filters( 'indonez_slideshow_meta_boxes', $meta_boxes );
}


function indonez_products_meta_boxes() {

  $meta_boxes = array(
    "product_highlight" => array(
      "name" => "_product_highlight",
      "title" => __("Product Highlight",'tucana'),
      "description" => __("Add product featuire highlights in a new line, eg.<br/> Feature 1<br/>Feature 2",'tucana'),
      "type" => "textarea"
    ),
    "product_url" => array(
      "name" => "_product_url",
      "title" => __("Custom Product Url",'tucana'),
      "description" => __("Please enter your custom url for your product,if not setted then will be linked to actual product page",'tucana'),
      "type" => "text"
    )         
  );

	return apply_filters( 'indonez_products_meta_boxes', $meta_boxes );
}

function indonez_page_meta_boxes() {

  $meta_boxes = array(
    "page_short_desc" => array(
      "name" => "_page_short_desc",
      "title" => __("Short Description",'tucana'),
      "description" => __("Add short description for your page.",'tucana'),
      "type" => "text"
    ),
    "page_sidebar_widget" => array(
      "name" => "_page_sidebar_widget",
      "title" => __("Sidebar Position",'corbiz'),
      "description" => __("Select default page sidebar widget",'corbiz'),
      "std" => "None",
      "type" => "select_sidebar_widget"
    ),
  );

	return apply_filters( 'indonez_slideshow_meta_boxes', $meta_boxes );
}

function slideshow_meta_boxes() {
	global $post;
	$meta_boxes = indonez_slideshow_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}


function products_meta_boxes() {
	global $post;
	$meta_boxes = indonez_products_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function page_meta_boxes() {
	global $post;
	$meta_boxes = indonez_page_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
    elseif ( $meta['type'] == 'select_sidebar_widget' )
			get_meta_select_sidebar_widget( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function get_meta_text_input( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;" /><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function get_meta_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo esc_html( $value, 1 ); ?></textarea><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function get_meta_select_sidebar_widget( $args = array(), $value = false ) {

	extract( $args ); 
  
  $dynamic_widget_sidebar_areas = array(
    "General Sidebar",
		"Blog Sidebar",
		"Single Showroom Page",
		"Single Dealer Page",
		"Sidebar Page 1",
		"Sidebar Page 2",
		"Sidebar Page 3",
		"Sidebar Page 4",
		"Sidebar Page 5"
  );
  ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $dynamic_widget_sidebar_areas as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function indonez_create_meta_box() {
	global $theme_name;

  add_meta_box( 'page-meta-boxes', __('Page options','tucana'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'slideshow-meta-boxes', __('Slideshow options','tucana'), 'slideshow_meta_boxes', 'slideshow', 'normal', 'high' );
	//add_meta_box( 'portfolio-meta-boxes', __('Portfolio options','tucana'), 'portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
	add_meta_box( 'products-meta-boxes', __('Product options','tucana'), 'products_meta_boxes', 'products', 'normal', 'high' );
}

function indonez_save_meta_data( $post_id ) {
	global $post;
  
  if ( 'slideshow' == $_POST['post_type'] )
    $meta_boxes = array_merge( indonez_slideshow_meta_boxes() );
  else if ( 'page' == $_POST['post_type'] )
    $meta_boxes = array_merge( indonez_page_meta_boxes() );
  else
    $meta_boxes = array_merge( indonez_products_meta_boxes() );    
  /*else
    $meta_boxes = array_merge( indonez_portfolio_meta_boxes() );*/
  
	foreach ( $meta_boxes as $meta_box ) :

		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;
    
    elseif ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
      
		elseif ( 'slideshow' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		elseif ( 'portfolio' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		elseif ( 'products' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
			
		$data = stripslashes( $_POST[$meta_box['name']] );

		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
}



/* Add a new meta box to the admin menu. */
	add_action( 'admin_menu', 'indonez_create_meta_box' );

/* Saves the meta box data. */
	add_action( 'save_post', 'indonez_save_meta_data' );

?>