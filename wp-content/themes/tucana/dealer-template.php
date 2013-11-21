<?php
/*
Template Name: Dealer
*/
?>
        <?php get_header();?>
        <!-- Begin pf Page Title -->
        <div id="header-inner">
        	<h1 class="title-page"><?php the_title();?></h1>
        </div>
        <!-- End of Page Title -->
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php if (have_posts()) : ?>
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
            
            	<!-- Begin of Content Left -->
            	<div id="main-left">
                <?php
                  
                  global $post;
                  
                  $dealer_item_number = $data['dealer_item_number'];
                  $paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
                  
                  query_posts(array( 'post_type' => 'dealer', 'posts_per_page' => $dealer_item_number,'orderby'=>'date','order'=>'DESC','paged'=>$paged));
                  
                  $counter = 0;
                  while (have_posts()) : the_post();
                  $counter++;
                  $thumb   = get_post_thumbnail_id();
                  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                  $image   = aq_resize( $img_url, 64, 64, true ); //resize & crop the image
                ?>
                  <div class="col_12_inner <?php if ($counter %2 == 0) echo 'last';?>">
                    <div class="dealer-img">
                      <img src="<?php echo $image;?>" alt="" class="alignleft dealer-image" />
                    </div>
                    <div class="dealer-desc">
                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php the_excerpt();?>
                    </div>
                    <hr />
                  </div>
                    
                <?php endwhile;?>
                
                <?php pagination();?>
                
                <?php wp_reset_query();?>
             </div>
                <!-- End of Content Left -->
             <?php endif;?>
             
             <?php get_sidebar();?>
              
             <div class="clr"></div>
          </div>
          
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>