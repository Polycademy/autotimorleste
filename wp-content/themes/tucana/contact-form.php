<?php
/*
Template Name: Contact Form
*/
?>        
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
              
              <?php
              $info_latitude = $data['info_latitude'];
              $info_longitude = $data['info_longitude'];
              $info_address = $data['info_address'];
              $info_phone = $data['info_phone'];
              $info_phone2 = $data['info_phone2'];
              $info_fax = $data['info_fax'];
              $info_email = $data['info_email'];
              $info_email2 = $data['info_email2'];
              
              ?>
              
            	<!-- Begin of Content Left -->
            	<div id="main-fullwidth-text">
                <!-- Begin of Content Left -->
            	<div class="col-458">
                			<?php while (have_posts()) : the_post();?>
                        <?php the_content();?>
                      <?php endwhile;?>
                            
                           <div class="contact-area">                                         
                                <?php $success_message = $data['success_message'];?>
                                <div class="success-contact"><?php echo ($success_message) ? stripslashes($success_message) : __("Your message has been sent successfully. Thank you!",'tucana');?></div>
                                <div id="contactFormArea">
                                
                                      <!-- Contact Form Start //-->
                                      <form action="#" id="contactform"> 
                                      <fieldset>
                                      <label><?php echo __('Name','Tucana');?></label>
                                      <input type="text" name="contactname" class="textfield" id="contactname" value="" />
                                      <div class="clear"></div>
                                      <label><?php echo __('E-mail','Tucana');?></label>
                                      <input type="text" name="contactemail" class="textfield" id="contactemail" value="" />
                                      <div class="clear"></div>
                                      <label><?php echo __('Subject','Tucana');?></label>
                                      <input type="text" name="contactsubject" class="textfield" id="contactsubject" value="" />
                                      <div class="clear"></div>    
                                      <label><?php echo __('Message','Tucana');?></label>
                                      <textarea name="contactmessage" id="contactmessage" class="textarea" cols="2" rows="7"></textarea>
                                      <div class="clear"></div> 
                                      <label>&nbsp;</label>
                                      <input type="submit" name="submit" class="buttoncontact" id="buttonsend" value="Send" />
                                      <input type="hidden" name="sendto" id="sendto" value="<?php echo $info_email ? $info_email : get_option('admin_email');?>" />
                                      <input type="hidden" name="siteurl" id="siteurl" value="<?php echo get_template_directory_uri();?>" />
                                      <span class="loading" style="display: none;"><?php echo __('Please wait..','tucana');?></span>
                                      <div class="clear"></div>
                                      </fieldset> 
                                      </form>
                                      <!-- Contact Form End //-->  
                                         
                            	</div>
                                
                             </div><!-- end of contact-area -->
                </div>
                <!-- End of Content Left -->
                
                <!-- Begin of Content Right -->
                <div class="col-458">
                    <div class="col-right">
                        
                    		<div id="box-map">
                          <div id="map">
                          <?php echo theme_widget_text_shortcode(do_shortcode('[gmap width="427" height="265" latitude="'.$info_latitude.'" longitude="'.$info_longitude.'" zoom="15" html="'.$info_address.'" popup="true"]'));?>
                          </div>
                        </div>                                               		
                        	<div class="grey-box">
                                <ul class="column-two">
                                    <li class="borderright">
                                        <h4 class="heading-contact"><img src="<?php echo get_template_directory_uri();?>/images/icon-sales.png" alt="" class="imgmiddle" />Sales Contact</h4>
                                        <ul class="list3">
                                            <li><?php echo $info_email;?></li>
                                            <li><?php echo $info_phone;?></li>
                                            <li><?php echo $info_fax;?></li>
                                        </ul>
                                    </li>
                                    <li class="marginoff">
                                        <h4 class="heading-contact"><img src="<?php echo get_template_directory_uri();?>/images/icon-services.png" alt="" class="imgmiddle" />Services Contact</h4>
                                        <ul class="list3">
                                            <li><?php echo $info_email2;?></li>
                                            <li><?php echo $info_phone2;?></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="clr"></div>
                              </div>
                    </div>
              </div>
              <!-- End of Content Right -->
                <div class="clr"></div> 
             </div>
                <!-- End of Content Left -->
             
          </div>
          
        </div>
        <!-- End of Content -->
        
        <?php get_footer();?>
            
            	