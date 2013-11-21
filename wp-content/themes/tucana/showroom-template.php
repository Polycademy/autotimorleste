<?php
/*
Template Name: Showroom
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
            
            <div id="main-fullwidth">
            
            	<!-- Begin of Car List 1 -->
            	<div class="list-block">
                	  <?php
                      global $post;
                      $showroom_order = $data['showroom_order'];
                      $product_item_number = $data['product_item_number'];
                      
                  		$terms = get_terms('products_cats','orderby=name&order=ASC');
                  		foreach($terms as $term) {
                  	?>
                    <h3 class="title-list"><a href="<?php echo get_term_link($term->slug, 'products_cats'); ?>"><?php echo $term->name; ?></a></h3>
                    
                      <div class="list-column">
                      <ul>
                        <?php
                    		$tax_query = array(
                    		array(
                    			'taxonomy' => 'products_cats',
                    			'terms' => $term->slug,
                    			'field' => 'slug'
                    			)
                    		);
                    		$term_post_args = array(
                    			'post_type' => 'products',
                    			'numberposts' => $product_item_number,
                    			'tax_query' => $tax_query,
                          'orderby' => $showroom_order
                    		);
                    		$term_posts = get_posts($term_post_args);
                    		
                    		//start loop
                        $counter = 0;
                    		foreach ($term_posts as $post) : setup_postdata($post);
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
                        <?php endforeach;?>
                        </ul>
                        </div><!-- End Of List Column -->
                        <div class="spacer"></div>
                      <?php } ?>
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