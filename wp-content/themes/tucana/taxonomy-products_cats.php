<?php get_header();?>
        
        <!-- Begin of Content -->
        <div id="content">
        	<div id="top-content">
            
            	<?php if (have_posts()) : ?>
            	<?php $page_description = get_post_meta($post->ID,'_page_short_desc',true);?>
            	<!-- Begin of Newsflash -->
            	<div id="newsflash">
                <h3><?php single_cat_title();?></h3>
              </div>
                <!-- End of Newsflash -->
                
            </div>
            
            <div id="main-fullwidth">
            
            	<!-- Begin of Car List 1 -->
            	<div class="list-block">
                     
                      <div class="list-column">
                      <ul>
                        <?php
                        while (have_posts()) : the_post();
                    		$counter++;
                        $thumb   = get_post_thumbnail_id();
                        $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                        $image   = aq_resize( $img_url, 210, 117, true ); //resize & crop the image
                        $product_highlights = get_post_meta($post->ID,'_product_highlight',true);
                        $product_highlights = explode("\n",$product_highlights);
                    		?>
                            <li <?php if ($counter %4 ==0) echo 'class="marginoff"';?>>
                            <img src="<?php echo $image;?>" alt="" />
                             <div class="box-desc">
                                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                <ul>
                                  <?php foreach ($product_highlights as $product_highlight) { ?>
                                    <li><?php echo $product_highlight;?></li>
                                  <?php } ?>
                                </ul>
                             </div>
                            </li>
                        <?php endwhile;?>
                        </ul>
                        </div><!-- End Of List Column -->
                        <div class="spacer"></div>
                       	<?php pagination();?>
                      <?php wp_reset_query();?>
                   <?php endif;?>
                </div>
                <!-- End of Car List 1 -->
                
                
                <div class="clr"></div>
                
                <!-- Begin of Bottom Box -->
                <div id="block-bottom">
                  <?php
                  $add_product_box1_title = $data['add_product_box1_title'];
                  $add_product_box1_url = $data['add_product_box1_url'];
                  $add_product_box1_image = $data['add_product_box1_image'];
                  $add_product_box1_desc = $data['add_product_box1_desc'];
                  $add_product_box2_title = $data['add_product_box2_title'];
                  $add_product_box2_url = $data['add_product_box2_url'];
                  $add_product_box2_image = $data['add_product_box2_image'];
                  $add_product_box2_desc = $data['add_product_box2_desc'];
                  $add_product_box3_title = $data['add_product_box3_title'];
                  $add_product_box3_url = $data['add_product_box3_url'];
                  $add_product_box3_image = $data['add_product_box3_image'];
                  $add_product_box3_desc = $data['add_product_box3_desc'];
                  ?>
                	<ul>
                    	<li><img src="<?php echo $add_product_box1_image;?>" alt="" class="imgleft" />
                        <h5><a href="<?php echo $add_product_box1_url;?>"><?php echo stripslashes($add_product_box1_title);?></a></h5>
                        <?php echo stripslashes($add_product_box2_desc);?></li>
                    	<li><img src="<?php echo $add_product_box2_image;?>" alt="" class="imgleft" />
                        <h5><a href="<?php echo $add_product_box2_url;?>"><?php echo stripslashes($add_product_box2_title);?></a></h5>
                        <?php echo stripslashes($add_product_box2_desc);?></li>
                    	<li class="nomargin"><img src="<?php echo $add_product_box3_image;?>" alt="" class="imgleft" />
                        <h5><a href="<?php echo $add_product_box3_url;?>"><?php echo stripslashes($add_product_box3_title);?></a></h5>
                        <?php echo stripslashes($add_product_box3_desc);?></li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <!-- End of Bottom Box -->
                
          </div>
        </div>
        <!-- End of Content -->
        
<?php get_footer();?> 