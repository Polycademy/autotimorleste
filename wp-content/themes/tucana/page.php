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