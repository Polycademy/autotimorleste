        <?php global $data;?>
        <!-- Begin of Footer -->
        <div id="footer">
        
        	<!-- Begin of Footer Link and Copyright -->
        	<div id="footer-link">
            	<?php 
              if (function_exists('wp_nav_menu')) { 
                wp_nav_menu( array( 'menu_id' => '','menu_class' => '', 'theme_location' => 'footernav', 'fallback_cb'=>'','depth' =>1 ) );
              } 
              ?>
                <span class="copyright">
                <?php $footer_text = $data['footer_text'];?>
                <?php echo $footer_text ? stripslashes($footer_text) : "copyright &copy; 2010 tucana car dealer. all rights reserved";?>
                </span>
            </div>
            <!-- End of Footer Link and Copyright -->
            
            <!-- Begin of Footer Phone -->
            <div id="footer-right">
           		<img src="<?php echo get_template_directory_uri();?>/images/headphone.gif" width="29" height="31" alt="" class="imgleft" />
              <?php
                $info_phone = $data['info_phone'];
                $info_phone2 = $data['info_phone2'];
              ?>
             	<span class="phone"><?php echo $info_phone;?></span><br />
             	<span class="phone"><?php echo $info_phone2?></span>
            </div>
            <!-- End of Footer Phone -->
            
            <div class="clr"></div>
        </div>
        <!-- End of Footer -->
        
    </div>    
</div>
<!-- End Of Wrapper -->
  <?php echo stripslashes($data['google_analytics']);?>
  <?php wp_footer();?>
  
</body>
</html>