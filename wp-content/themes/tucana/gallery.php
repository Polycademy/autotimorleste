<?php
/*
Template Name: Gallery
*/
?>        
  
  <?php get_header();?>
        
    <script type="text/javascript">
      jQuery(document).ready(function() {
    	jQuery("#showcase").awShowcase({
    		content_width:			898,
    		content_height:			476,
    		fit_to_parent:			false,
    		auto:					false,
    		interval:				3000,
    		continuous:				false,
    		loading:				true,
    		tooltip_width:			200,
    		tooltip_icon_width:		32,
    		tooltip_icon_height:	32,
    		tooltip_offsetx:		18,
    		tooltip_offsety:		0,
    		arrows:					false,
    		buttons:				false,
    		btn_numbers:			false,
    		keybord_keys:			false,
    		mousetrace:				false, /* Trace x and y coordinates for the mouse */
    		pauseonover:			true,
    		stoponclick:			true,
    		transition:				'hslide', /* hslide/vslide/fade */
    		transition_delay:		300,
    		transition_speed:		500,
    		show_caption:			'onhover', /* onload/onhover/show */
    		thumbnails:				true,
    		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
    		thumbnails_direction:	'horizontal', /* vertical/horizontal */
    		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
    		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
    		speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
    		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
    	});
    });
    </script>
        <!-- Begin pf Page Title -->
        <div id="header-inner">
        	<h1 class="title-page"><?php the_title();?></h1>
        </div>
        <!-- End of Page Title -->
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php $page_description = get_post_meta($post->ID,'_page_short_desc',true);?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <h3><?php echo stripslashes($page_description);?></h3>
              </div>
                <!-- End of Newsflash -->
                
              <!-- Begin of Search -->
            	<div id="topsearch">
                <?php get_template_part('searchbox','tucana search box');?>  	
              </div>
              <!-- End of Search -->
                
            </div>
            
            <div id="main-inner">
            
            	<!-- Begin of Gallery -->
            <div id="gallery-box">
              <div id="showcase" class="showcase">
              	<?php
          //get attachement count
              $get_attachments = get_children( array( 'post_parent' => $post->ID ) );
      		
      		//get ID of featured image
              $featured_image_id = get_post_thumbnail_id( $post->ID );
    		
            //attachement loop
            $args = array(
                'orderby' => 'menu_order',
                'post_type' => 'attachment',
                'post_parent' => get_the_ID(),
                'post_mime_type' => 'image',
                'post_status' => null,
                'posts_per_page' => -1,
                'exclude' => $featured_image_id
              );
              $attachments = get_posts($args);
              ?>
              
              <?php if ($attachments) { ?>
      
      			<?php
              foreach ($attachments as $attachment) :
              //get images
              $attachment_url = wp_get_attachment_url( $attachment->ID , 'full' );
   		        $full_image = aq_resize( $attachment_url, 898, 476, true ); 
              $thumb_image = aq_resize( $attachment_url, 140, 94, true );
              ?>
              <div class="showcase-slide">
          			<!-- Put the slide content in a div with the class .showcase-content. -->
          			<div class="showcase-content">
          				<img src="<?php echo $full_image;?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
          			</div>
          			<!-- Put the thumbnail content in a div with the class .showcase-thumbnail -->
          			<div class="showcase-thumbnail">
          				<img src="<?php echo $thumb_image;?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" />
          				<!-- The div below with the class .showcase-thumbnail-caption contains the thumbnail caption. -->
          				<div class="showcase-thumbnail-caption"></div>
          				<!-- The div below with the class .showcase-thumbnail-cover is used for the thumbnails active state. -->
          				<div class="showcase-thumbnail-cover"></div>
          			</div>
          			<!-- Put the caption content in a div with the class .showcase-caption -->
          			<div class="showcase-caption">
          				<h2><?php echo apply_filters('the_title', $attachment->post_title); ?></h2>
          			</div>
          		</div>
              <?php endforeach;?>
              <?php } ?>
             </div>
            </div>
          </div>
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>
        