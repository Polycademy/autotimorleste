<?php
/*
Template Name: Blog
*/
?>        
        <?php get_header();?>
        <!-- Begin of Page Title -->
        <div id="header-inner">
        	<h1 class="title-page"><?php the_title();?></h1>
        </div>
        <!-- End of Page Title -->
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php if (have_posts()) : ?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <?php $page_description = get_post_meta($post->ID,'_page_short_desc',true);?>
                <h4><?php echo stripslashes($page_description);?></h4>
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
                  $blog_cats_include = $data['blog_categories'];
                  if(is_array($blog_cats_include)) {
                    $blog_cats_include = implode(",",$blog_cats_include);
                  } 
                  $blog_order = $data['blog_order'];
                  $blog_item_number = $data['blog_item_number'];
                  $disable_postmeta = $data['disable_postmeta'];
                  
                  $paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
                  
                  query_posts(array('cat'=>$blog_cats_include,'posts_per_page'=>$blog_item_number,'orderby'=>$blog_order,'paged'=>$paged));
                  while ( have_posts() ) : the_post();
                  ?>
                	<!-- Begin of Post 1 -->
           	   	 	<div id="post-<?php the_ID(); ?>" class="post <?php post_class(); ?>">
                  	  <div class="title-post">
                        <?php if ($disable_postmeta != true) { ?>
                      	<div class="meta-date">
                        <span class="date"><?php the_time('d'); ?></span><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span>
                        </div>
                        <?php } ?>
                      	<h3 class="heading-green blog-h"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <?php if ($disable_postmeta != true) { ?><span class="meta"><?php echo __('Posted by ','tucana');?> : <?php the_author_posts_link();?>  |  <?php echo __('Categories ','tucana');?>: <?php the_category(',');?> | <?php echo __('Comments ','tucana');?>: <?php comments_popup_link('0','1','%');?></span><?php } ?>
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