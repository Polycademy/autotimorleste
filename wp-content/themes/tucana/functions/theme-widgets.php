<?php

/* Widgets Functions  */
$dynamic_widget_sidebar_areas = array(
		/* rename or create new dynamic sidebars */
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
if ( function_exists('register_sidebar')) {
    foreach ($dynamic_widget_sidebar_areas as $widget_area_name) {
        register_sidebar(array(
           'name'=> $widget_area_name,
           'before_widget' => '<li id="%1$s"  class="%2$s"><div class="box">',
           'after_widget' => '</div></li>',
           'before_title' => '<h3>',
           'after_title' => '</h3>'
        ));
    }
}


class PageBox_Widget extends WP_Widget {
  function PageBox_Widget() {
    $widgets_opt = array('description'=>'Display pages as small box in sidebar');
    parent::WP_Widget(false,$name= "tucana - Page to Box",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $pageid = esc_attr($instance['pageid']);
    $opt_thumbnail = esc_attr($instance['opt_thumbnail']);
    
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
  ?>  
	 <p><label>Please select the page
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($opt_thumbnail == "on") echo "checked";?> id="<?php echo $this->get_field_id('opt_thumbnail'); ?>" name="<?php echo $this->get_field_name('opt_thumbnail'); ?>" />
		<label for="<?php echo $this->get_field_id('opt_thumbnail'); ?>"><small>display thumbnail?</small></label><br />
    </p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $pageid = apply_filters('pageid',$instance['pageid']);
    $opt_thumbnail = apply_filters('opt_thumbnail',$instance['opt_thumbnail']);
  
    $pagelist = new WP_Query('post_type=page&page_id='.$pageid);
    
    echo $before_widget;
    
    while ($pagelist->have_posts()) : $pagelist->the_post();
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 254,100, true ); //resize & crop the image
    
    $title = $before_title.get_the_title().$after_title;
    
    echo $title;
    ?>
    <?php if ($opt_thumbnail == "on") { ?>
      <img src="<?php echo $image;?>" alt="" class="imgleft"/>
      <div class="clr"></div>
    <?php }?>
    <span><?php echo get_the_excerpt();?></span>
    <?php   
    endwhile;
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("PageBox_Widget");'));

/* Dealer List Widget */

class DealerList_Widget extends WP_Widget {
  
  function DealerList_Widget() {
    $widgets_opt = array('description'=>'Display list of Dealer');
    parent::WP_Widget(false,$name= "tucana - Dealer List",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $dealer_title = esc_attr($instance['dealer_title']);
    $dealer_num = esc_attr($instance['dealer_num']);
    
    
  ?>
    <p><label for="dealer_title"><?php echo __('Title','tucana');?>:
  		<input id="<?php echo $this->get_field_id('dealer_title'); ?>" name="<?php echo $this->get_field_name('dealer_title'); ?>" type="text" class="widefat" value="<?php echo $dealer_title;?>" /></label></p>
    <p><label for="dealer_num"><?php echo __('Number to display','tucana');?>:
  		<input id="<?php echo $this->get_field_id('dealer_num'); ?>" name="<?php echo $this->get_field_name('dealer_num'); ?>" type="text" class="widefat" value="<?php echo $dealer_num;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $dealer_title = apply_filters('dealer_title',$instance['dealer_title']);
    $dealer_num = apply_filters('dealer_num',$instance['dealer_num']);
    
    if ($dealer_title == "") $dealer_title = __("Dealer List",'tucana');
    
    echo $before_widget;
    $title = $before_title.$dealer_title.$after_title;
    indonez_delear_list($dealer_num,$title)
    ?>
   <?php
   wp_reset_query();    
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("DealerList_Widget");'));

/* Latest Products Widget */

class LatestProducts_Widget extends WP_Widget {
  
  function LatestProducts_Widget () {
    $widgets_opt = array('description'=>'Latest Products Scroll');
    parent::WP_Widget(false,$name= "tucana - Latest Products",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $prodtitle = esc_attr($instance['prodtitle']);
    $prodnum = esc_attr($instance['prodnum']);    
    
    
  ?>
    <p><label for="prodtitle"><?php echo __('Title','tucana');?>:
  		<input id="<?php echo $this->get_field_id('prodtitle'); ?>" name="<?php echo $this->get_field_name('prodtitle'); ?>" type="text" class="widefat" value="<?php echo $prodtitle;?>" /></label></p>
    <p><label for="prodnum"><?php echo __('number to display','tucana');?>:
  		<input id="<?php echo $this->get_field_id('prodnum'); ?>" name="<?php echo $this->get_field_name('prodnum'); ?>" type="text" class="widefat" value="<?php echo $prodnum;?>" /></label></p>      
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $prodtitle = apply_filters('prodtitle',$instance['prodtitle']);
    $prodnum = apply_filters('prodnum',$instance['prodnum']);    
    
    if ($prodtitle == "") $prodtitle = __("Latest Products",'tucana');
    
    $before_widget;
    indonez_latestproducts_scroll($prodnum,$prodtitle);
    $after_widget;
    ?>
   <?php
   wp_reset_query();  
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("LatestProducts_Widget");'));

/* Testimonial Widget */

class Testimonial_Widget extends WP_Widget {
  function Testimonial_Widget() {
    $widgets_opt = array('description'=>'tucana Testimonial Theme Widget');
    parent::WP_Widget(false,$name= "tucana - Testimonial",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $catid = esc_attr($instance['catid']);
    $testititle = esc_attr($instance['testititle']);
    $numtesti = esc_attr($instance['numtesti']);
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="testititle">Title:
  		<input id="<?php echo $this->get_field_id('testititle'); ?>" name="<?php echo $this->get_field_name('testititle'); ?>" type="text" class="widefat" value="<?php echo $testititle;?>" /></label></p>  
	 <p><small>Please select category for <b>Testimonial</b>.</small></p>
		<select  name="<?php echo $this->get_field_name('catid'); ?>"  id="<?php echo $this->get_field_id('catid'); ?>" >
			<?php foreach ($categories as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $catid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>	
    <p><label for="numtesti">Number to display:
  		<input id="<?php echo $this->get_field_id('numtesti'); ?>" name="<?php echo $this->get_field_name('numtesti'); ?>" type="text" class="widefat" value="<?php echo $numtesti;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = apply_filters('catid',$instance['catid']);
    $testititle = apply_filters('testititle',$instance['testititle']);
    $numtesti = apply_filters('numtesti',$instance['numtesti']);    
        
    if ($numtesti == "") $numtesti = 1;
    if ($testititle == "") $testititle = "Testimonials";
    
    $title = $before_title.$testititle.$after_title;
      indonez_testimonial($catid,$numtesti,$title,"");
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Testimonial_Widget");'));

/* Post Scroll Widget */

class PostScroll_Widget extends WP_Widget {
  
  function PostScroll_Widget() {
    $widgets_opt = array('description'=>'List posts in sidebar as scroll box');
    parent::WP_Widget(false,$name= "tucana - Post Scroll",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $catid = esc_attr($instance['catid']);
    $newstitle = esc_attr($instance['newstitle']);
    $numnews = esc_attr($instance['numnews']);
    $opt_excerpt = esc_attr($instance['opt_excerpt']);
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="newstitle">Title:
  		<input id="<?php echo $this->get_field_id('newstitle'); ?>" name="<?php echo $this->get_field_name('newstitle'); ?>" type="text" class="widefat" value="<?php echo $newstitle;?>" /></label></p>  
	 <p><small>Please select category for <b>News</b>.</small></p>
		<select  name="<?php echo $this->get_field_name('catid'); ?>"  id="<?php echo $this->get_field_id('catid'); ?>" >
			<?php foreach ($categories as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $catid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>	
    <p><label for="numnews">Number to display:
  		<input id="<?php echo $this->get_field_id('numnews'); ?>" name="<?php echo $this->get_field_name('numnews'); ?>" type="text" class="widefat" value="<?php echo $numnews;?>" /></label></p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = apply_filters('catid',$instance['catid']);
    $newstitle = apply_filters('newstitle',$instance['newstitle']);
    $numnews = apply_filters('numnews',$instance['numnews']);
    
    if ($numnews == "") $numnews = 4;
    
    echo $before_widget;
    $title = $before_title.$newstitle.$after_title;
    indonez_postscroll($catid,$numnews,$title);
    ?>
   <div class="clear"></div>
   <?php
   wp_reset_query();    
   echo $after_widget;
  } 
}
add_action('widgets_init', create_function('', 'return register_widget("PostScroll_Widget");'));

/* Post to Homepage Box or Sidebar Box Widget */
class PostBox_Widget extends WP_Widget {
  function PostBox_Widget() {
    $widgets_opt = array('description'=>'Display Posts as small box in sidebar');
    parent::WP_Widget(false,$name= "tucana - Post to Box",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $postid = esc_attr($instance['postid']);
    $opt_thumbnail = esc_attr($instance['opt_thumbnail']);
    $postexcerpt = esc_attr($instance['postexcerpt']);
    
		$tucanaposts = get_posts('numberposts=-1')
		?>  
	<p><label>Please select post display
			<select  name="<?php echo $this->get_field_name('postid'); ?>"  id="<?php echo $this->get_field_id('postid'); ?>" >
				<?php foreach ($tucanaposts as $post) { ?>
			<option value="<?php echo $post->ID;?>" <?php if ( $postid  ==  $post->ID) { echo ' selected="selected" '; }?>><?php echo  the_title(); ?></option>
			<?php } ?>
			</select>
	</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($opt_thumbnail == "on") echo "checked";?> id="<?php echo $this->get_field_id('opt_thumbnail'); ?>" name="<?php echo $this->get_field_name('opt_thumbnail'); ?>" />
		<label for="<?php echo $this->get_field_id('opt_thumbnail'); ?>"><small>display thumbnail?</small></label><br />
    </p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $postid = apply_filters('postid',$instance['postid']);
    $opt_thumbnail = apply_filters('opt_thumbnail',$instance['opt_thumbnail']);
    
    echo $before_widget;
    $postlist = new WP_Query('p='.$postid);
    
    while ($postlist->have_posts()) : $postlist->the_post();
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 254,100, true ); //resize & crop the image
    
    $title = $before_title.get_the_title().$after_title;
    
    echo $title;
    ?>
    <?php if ($opt_thumbnail == "on") { ?>
      <img src="<?php echo $image;?>" alt="" class="imgleft"/>
      <div class="clr"></div>
    <?php }?>
    <span><?php echo get_the_excerpt();?></span>
    <?php   
    endwhile;
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("PostBox_Widget");'));

/* Brochure Widget */
class Brochure_Widget extends WP_Widget {
  function Brochure_Widget() {
    $widgets_opt = array('description'=>'Display your brochure and download link');
    parent::WP_Widget(false,$name= "tucana - Brochure",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $brochure_title = esc_attr($instance['brochure_title']);
    $brochure_subtitle = esc_attr($instance['brochure_subtitle']);
    $brochure_download_url = esc_attr($instance['brochure_download_url']);

  ?>
    <p><label for="brochure_title"><?php echo __('Title','tucana');?>:
  		<input id="<?php echo $this->get_field_id('brochure_title'); ?>" name="<?php echo $this->get_field_name('brochure_title'); ?>" type="text" class="widefat" value="<?php echo $brochure_title;?>" /></label></p>
    <p><label for="brochure_subtitle"><?php echo __('Sub Title','tucana');?>:
		  <input id="<?php echo $this->get_field_id('brochure_subtitle'); ?>" name="<?php echo $this->get_field_name('brochure_subtitle'); ?>" type="text" class="widefat" value="<?php echo $brochure_subtitle;?>" /></label></p>
    <p><label for="brochure_download_url"><?php echo __('Brochure Download Url','tucana');?>:
  		<input id="<?php echo $this->get_field_id('brochure_download_url'); ?>" name="<?php echo $this->get_field_name('brochure_download_url'); ?>" class="widefat" value="<?php echo $brochure_download_url;?>"/></label></p>
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $brochure_title = apply_filters('brochure_title',$instance['brochure_title']);
    $brochure_subtitle = apply_filters('brochure_subtitle',$instance['brochure_subtitle']);
    $brochure_download_url = apply_filters('brochure_download_url',$instance['brochure_download_url']);    
    
    echo $before_widget;
    ?>
    <a href="<?php echo $brochure_download_url;?>"><img src="<?php echo get_template_directory_uri();?>/images/brochure.png" alt="" class="imgleft" /></a><h5 class="heading-green brochure"><?php echo $brochure_title;?></h5>
    <h6><a href="<?php echo $brochure_download_url;?>"><?php echo $brochure_subtitle;?></a></h6>
    <div class="clear"></div>    
  <?php 
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Brochure_Widget");'));

?>