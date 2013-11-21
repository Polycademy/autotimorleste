        <?php get_header();?>
        <!-- Begin pf Page Title -->
        <div id="header-inner">
        	<h1 class="title-page"><?php echo __('blog','tucana');?></h1>
        </div>
        <!-- End of Page Title -->
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post();?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <h4><?php echo __('Blog','tucana');?></h4>
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
                <!-- Begin of Post 1 -->
         	   	 	<div class="post">
             	      <div class="title-post">
                      <?php $disable_postmeta = $data['disable_postmeta'];?>
                      <?php if ($disable_postmeta != true) { ?>
                      	<div class="meta-date">
                        <span class="date"><?php the_time('d'); ?></span><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span>
                        </div>
                      <?php } ?>
                  	<h3 class="heading-green blog-h"><?php the_title();?></h3>
                    <?php if ($disable_postmeta != true) { ?><span class="meta"><?php echo __('Posted by ','tucana');?> : <?php the_author_posts_link();?>  |  <?php echo __('Categories ','tucana');?>: <?php the_category(',');?> | <?php echo __('Comments ','tucana');?>: <?php comments_popup_link('0','1','%');?></span> <?php } ?>
                  </div>
                  <div class="entry">
                  	<?php the_content();?>
                  </div>
                   <div class="clr"></div>
                </div>
                <!-- End of Post 1 -->
                
                <?php 
                if ($disable_comment !="true") {
                  comments_template('', true);  
                }
                ?>
                
             </div>
                <!-- End of Content Left -->
             <?php endwhile;?>
             <?php endif;?>
             
             <?php get_sidebar();?>
              
             <div class="clr"></div>
          </div>
          
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>