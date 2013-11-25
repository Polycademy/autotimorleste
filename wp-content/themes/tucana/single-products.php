				<?php get_header();?>
				<script type="text/javascript">
				jQuery(document).ready(function($) {
						$('#img-slide-large').cycle({
						fx:     'fade',
						speed:  'slow',
						timeout: 6000,
						pager:  '#nav-thumb',
						pagerAnchorBuilder: function(idx, slide) {
								// return sel string for existing anchor
								return '#nav-thumb li:eq(' + (idx) + ') a';
						}
				});      
					
			});
			</script>
				
				<!-- Begin of Content -->
				<div id="content">
					<div id="top-content">
						<?php global $post;?>
						
						<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post();?>
						
							<!-- Begin of Newsflash -->
							<div id="newsflash">
								<h3><?php the_title();?></h3>
							</div>
								<!-- End of Newsflash -->
								
						</div>
						
						<div id="main-inner">
						
							<!-- Begin of Content Left -->
								<div id="img-slide">
								<div id="img-slide-large">
									<?php
										$args = array(
											'order'          => 'ASC',
											'post_type'      => 'attachment',
											'post_parent'    => $post->ID,
											'post_mime_type' => 'image',
											'post_status'    => null,
											'orderby'		 => 'menu_order',
											'numberposts'    => -1,
										);
										$attachments = get_posts( $args );
										
										if ($attachments) {
											foreach ($attachments as $attachment) {
												$attachment_url = wp_get_attachment_url( $attachment->ID , 'full' );
												$image = aq_resize( $attachment_url, 518, 263, true ); //resize & retain image proportions (soft crop)
												echo '<img src="' . $image . '"/>';
											}	
										}
										?>
								</div>
									<div id="img-slide-thumb">
										<ul id="nav-thumb">
											<?php
												if ($attachments) {
													foreach ($attachments as $attachment) {
													 $attachment_url = wp_get_attachment_url( $attachment->ID , 'full' );
													$image = aq_resize( $attachment_url, 80, 80, true); //resize & retain image proportions (soft crop)
												 ?>
												<li><a href="#"><?php  echo '<img src="' . $image . '"/>'; ?></a></li>
											 <?php 
												} 
											 } ?>
											</ul>
									</div>
							 </div>
							<div class="clr"></div>
							<?php the_content();?>
							<!-- End of Content Left -->
						 <?php endwhile;?>
						 <?php endif;?>
						 
						 <?php wp_reset_query();?>

						 <div class="clr"></div>
					</div>
					
				</div>
				<!-- End of Content -->
				
				<?php get_footer();?>