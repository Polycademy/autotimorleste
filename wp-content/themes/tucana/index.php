<?php get_header();?>
        <?php $enable_slide_bg = $data['enable_slide_bg'];?>
        <?php get_template_part('slideshow','tucana slideshow');?>
        
        <!-- Begin of Content -->
        <div id="content" <?php if ($enable_slide_bg == true) echo 'class="alt"';?>>
        	<div id="top-content">
              <?php indonez_latestnews_scroll();?>
              
            	<!-- Begin of Search -->
            	<div id="topsearch">
                <?php get_template_part('searchbox','tucana search box');?>
              </div>
                <!-- End of Search -->
                                
            </div>
            
            <div id="main">
            
            	<!-- Begin of Content Left -->
            	<div id="main-home-left">
                	 <?php main_delear_list("Locate Our Dealers",-1);?>
                </div>
                <!-- End of Content Left -->
               
              <!-- Begin of Content Right -->  
           	  <div id="main-home-right">
              
                  <?php indonez_latestproducts(2,"<h3>Latest Cars</h3>");?>
                  
                  <div class="clr"></div>
                  
                  <div class="grey-box">
                    <?php
                      $promobox1_title = $data['promobox1_title'];
                      $promobox1_url = $data['promobox1_url'];
                      $promobox1_image = $data['promobox1_image'];
                      $promobox1_desc = $data['promobox1_desc'];
                      $promobox2_title = $data['promobox2_title'];
                      $promobox2_url = $data['promobox2_url'];
                      $promobox2_image = $data['promobox2_image'];
                      $promobox2_desc = $data['promobox2_desc'];
                    ?>
                  		<ul class="column-two">
                        	<li class="borderright">
                            <?php if ($promobox1_image) { ?>
                              <img src="<?php echo $promobox1_image;?>" alt="" class="imgleft" />
                            <?php } ?>
                                <h4><a href="<?php echo $promobox1_url;?>"><?php echo stripslashes($promobox1_title);?></a></h4>
                                <p class="front-box-text"><?php echo stripslashes($promobox1_desc);?></p>
                            </li>
                        	<li class="marginoff-box">
                            	<img src="<?php echo $promobox2_image;?>" alt="" class="imgleft" />
                                <h4><a href="<?php echo $promobox2_url;?>"><?php echo stripslashes($promobox2_title);?></a></h4>
                                <p class="front-box-text"><?php echo stripslashes($promobox2_desc);?></p>
                            </li>
                        </ul>
                        <div class="clr"></div>
                  </div>
                  
                </div>
                <!-- End Of Content Right -->
                
                <div class="clr"></div>
          </div>
          
        </div>
        <!-- End Of Content -->
        
        <?php get_footer();?>