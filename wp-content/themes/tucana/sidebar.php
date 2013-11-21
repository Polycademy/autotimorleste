                <?php 
                  global $post; 
                  $page_sidebar_position = get_post_meta($post->ID,'_page_sidebar_position',true);
                ?>
                <!-- Begin of Sidebar --> 
                <div id="main-right">
                	<div id="sidebar">
                  <?php 
                		$children=wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li' );
                		if ($children) {
                			$parent = $post->ID;
                		}else{
                			$parent = $post->post_parent;
                			if(!$parent){
                				$parent = $post->ID;
                			}
                		}              
                    $children = wp_list_pages("title_li=&child_of=".$parent."&echo=0&depth=1&menu_order=sort_column");
                    $parent_title = get_the_title($parent);
                    ?>      
                    
                	<ul>
                    <?php if ($children) { ?>
                    	<li>
                        	<h3><?php echo $parent_title;?></h3>
                            <div class="box">
                            	<ul>
                                <?php echo $children;?>
                                </ul>
                            </div>
                        </li>
                     <?php } ?>
                      <?php 
                        $sidebar_name = get_post_meta($post->ID,"_page_sidebar_widget",true);
                        dynamic_sidebar($sidebar_name);
                        
                        if ( is_archive() || is_category() || is_search() || is_404()) {
                    		  dynamic_sidebar('Blog Sidebar');
                        } else if (is_singular('products')) {
                          dynamic_sidebar('Single Showroom Page');
                        } else if (is_singular('dealer')) {
                          dynamic_sidebar('Single Dealer Page');
                        } else if (is_single()) {
                          dynamic_sidebar('Blog Sidebar');
                        }
                        ?>
                      
                    </ul>
                    </div>
                    
              </div>
              <!-- End of Sidebar --> 