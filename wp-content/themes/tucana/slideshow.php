        <?php
        global $post,$data;
        $slideshow_order = $data['slideshow_order'];
        $enable_slide_bg = $data['enable_slide_bg'];
        $slide_bg = $data['slide_bg'];
        ?>
        <!-- Begin of Slideshow -->
        <div id="header<?php if ($enable_slide_bg ==true) echo '-alt';?>">           
            <ul id="slideshow" <?php if ($enable_slide_bg == true) echo 'class="slide2"';?>>
              <?php
                switch ($slide_bg) {
                  case "bg-slide1" : $class="bg1";break;
                  case "bg-slide2" : $class="bg2";break;
                  case "bg-slide3" : $class="bg3";break;
                  case "bg-slide4" : $class="bg4";break;
                }
                query_posts(array( 'post_type' => 'slideshow', 'showposts' => -1,'orderby'=>$slideshow_order));
                
                while (have_posts()) : the_post();
                $slideshow_url = get_post_meta($post->ID,"_slideshow_url",true) ? get_post_meta($post->ID,"_slideshow_url",true) : get_permalink();
                $thumb   = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                $image   = aq_resize( $img_url, 615,325, true ); //resize & crop the image
                $features_highlights = get_post_meta($post->ID,'_features_highlight',true);
                $features_highlights = explode("\n",$features_highlights);
                ?>
              <?php if ($enable_slide_bg != true) {?>
            	 <li>
                	<div class="header-left">
                  	<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
                      <p><?php echo get_the_content();?></p>
                      <div class="glow-box">
                      	<ul>
                         <?php foreach ($features_highlights as $features_highlight) { ?>
                          <li><?php echo $features_highlight;?></li>
                        <?php } ?>
                         </ul>
                      </div>
                    </div>
                    <div class="header-right">
                    <img src="<?php echo $image;?>" alt="<?php the_title();?>" />
                    </div>
                </li>
              <?php } else { ?>
                <li class="<?php echo $class;?>">
                <div class="header-left"><img src="<?php echo $image;?>" alt="" /></div>
                	<div class="header-right">
                      <div class="glow-box-alt">
                    	<h1><?php the_title();?></h1>
                        <p><?php echo get_the_content();?></p>
                        	<ul>
                        	   <?php foreach ($features_highlights as $features_highlight) { ?>
                             <li><?php echo $features_highlight;?></li>
                             <?php } ?>
                          </ul>
                        </div>
                    </div>
                  </li>
              <?php } ?>
             <?php endwhile;?>
            </ul>
        	<div id="pagerslide"></div>
            
        </div>
        <!-- End Of Slideshow -->