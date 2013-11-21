        <?php get_header();?>
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
            
            	<!-- Begin of Content Left -->
            	<div id="main-left">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post();?>
                <?php the_content();?>
                <?php endwhile;?>       
             </div>
             <!-- End of Content Left -->
             
             <?php endif;?>
             
             <?php get_sidebar();?>
              
             <div class="clr"></div>
          </div>
          
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>