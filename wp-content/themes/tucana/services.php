<?php
/*
Template Name: Services
*/
?>        
        <?php get_header();?>
        
        <!-- Begin of Content -->
        <div id="content">
          <div id="top-content">
              <!-- Begin of Newsflash -->
              <div id="newsflash">
                <h3><?php the_title();?></h3>
              </div>
                <!-- End of Newsflash -->
            </div>
            
            <div id="main-inner">
            
            	<!-- Begin of Content Left -->
            	<div id="main-fullwidth-text">
                <ul class="serviceslist">
                   <?php 
                  if (have_posts()) : while (have_posts()) : the_post();
                    the_content();
                  endwhile; endif;
                  
                  global $post;
                  $counter = 0;
                  $services_page = get_option('vulcan_services_pid');
                  $services_order = get_option('vulcan_services_order');

                  $servicespid = get_page_by_title($services_page);
                  $spid = ($post->ID) ? ($post->ID)  : $servicespid->id; 
                  query_posts('post_type=page&post_parent='.$spid.'&posts_per_page=-1&orderby='.$services_order);                  
                  while ( have_posts() ) : the_post();
                  $thumb   = get_post_thumbnail_id();
                  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                  $image   = aq_resize( $img_url, 286, 100, true ); //resize & crop the image
                  $counter++;
                 	?>
                  <li <?php if ($counter %3 == 0) echo 'class="last"';?>>
                    <img src="<?php echo $image;?>" alt="" class="shadow" />
                    <h4 class="heading-green"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <span><?php echo get_the_excerpt();?></span>
                  </li>
                  <?php endwhile;?>
                </ul>
                <div class="clr"></div> 
             </div>
                <!-- End of Content Left -->
             
          </div>
          
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>