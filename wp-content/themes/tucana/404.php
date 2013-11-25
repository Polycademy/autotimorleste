        <?php get_header();?>
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            <?php $page_description = get_post_meta($post->ID,'_page_short_desc',true);?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <h3><?php echo __('Page Not Found','tucana');?></h3>
              </div>
                <!-- End of Newsflash -->
                
            </div>
            
            <div id="main-inner">
            
            	<!-- Begin of Content Left -->
            	<div>
                <?php $page_not_found_text = $data['page_not_found_text'];?>  
                <h1><?php echo nl2br($page_not_found_text);?></h1>
                
             </div>
             <!-- End of Content Left -->
              
             <div class="clr"></div>

             <div id="block-bottom">
              <div class="clr"></div>
             </div>
          </div>
          
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>