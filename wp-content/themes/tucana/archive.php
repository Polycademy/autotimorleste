        <?php get_header();?>

        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php if (have_posts()) : ?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <h4><?php echo __("Archive for ",'tucana');?> <?php echo '"';?><?php single_cat_title();?><?php echo '"';?></h4>
              </div>
                <!-- End of Newsflash -->
                
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
                      	<div class="meta-date">
                        <span class="date"><?php the_time('d'); ?></span><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span>
                        </div>
                      	<h3 class="heading-green blog-h"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <span class="meta"><?php echo __('Posted by ','tucana');?> : <?php the_author_posts_link();?>  |  <?php echo __('Categories ','tucana');?>: <?php the_category(',');?> | <?php echo __('Comments ','tucana');?>: <?php comments_popup_link('0','1','%');?></span>
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
                    
                    <?php pagination();?>
                    
                </div>
                <!-- End of Content Left -->
                
                <?php endif;?>
                <?php wp_reset_query();?>
                <?php get_sidebar();?>
                    
              <div class="clr"></div>
              
          </div>
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>