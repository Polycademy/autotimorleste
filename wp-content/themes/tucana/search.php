        <?php get_header();?>
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php if (have_posts()) : ?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <h4><?php echo __('Search result for ','tucana') . '"'.$s.'"';?></h4>
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
                  while ( have_posts() ) : the_post();
                  ?>
                	<!-- Begin of Post 1 -->
           	   	 	<div class="post">
                  	  <div class="title-post">
                        <?php if ($disable_postmeta != true) { ?>
                      	<div class="meta-date">
                        <span class="date"><?php the_time('d'); ?></span><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span>
                        </div>
                        <?php } ?>
                      	<h3 class="heading-green blog-h"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <?php if ($disable_postmeta != true) { ?><span class="meta"><?php echo __('Posted by ','tucana');?> : <?php the_author_posts_link();?>  |  <?php echo __('Categories ','tucana');?>: <?php the_category(',');?> | <?php echo __('Comments ','tucana');?>: <?php comments_popup_link('0','1','%');?></span> <?php } ?>
                      </div>
                      <div class="entry">
                      	<?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                      	 <img src="<?php echo indonez_resize_image(190,148);?>" alt="" class="imgleft shadow" />
                        <?php } ?>
                      	<?php the_excerpt();?>
                       <span class="readmore"><a href="<?php the_permalink();?>" ><?php echo __('more','tucana');?></a></span>
                      </div>
                       <div class="clr"></div>
                    </div>
                    <!-- End of Post 1 -->
                    <?php endwhile;?>
                    <?php wp_reset_query();?>
                    
                    <div class="pages blogpages">
                      <?php 
                      global $wp_query; 
                      $total_pages = $wp_query->max_num_pages; 
                      if ( $total_pages > 1 ) {
                      if (function_exists("wpapi_pagination")) {
                          wpapi_pagination($total_pages); 
                        }
                      }
                      ?>
                    </div>
                    
                </div>
                <!-- End of Content Left -->
                
                <?php endif;?>
                
                <?php get_sidebar();?>
                    
              <div class="clr"></div>
              
          </div>
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>