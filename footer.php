			</div>
			<?php
				$subfooter = get_option( OM_THEME_PREFIX.'subfooter_text' );
				$footer_columns_layout = get_option( OM_THEME_PREFIX.'footer_layout' );
				$footer_menu = has_nav_menu( 'footer-menu' );
				$footer_social_icons = ( get_option( OM_THEME_PREFIX . 'social_icons_footer' ) == 'true' ) ? om_get_social_icons_html() : false;
				
				if( $footer_columns_layout == '1v4-1v4-1v4-1v4')
					$footer_columns=array(
						'footer-column-1'=>'one-fourth',
						'footer-column-2'=>'one-fourth',
						'footer-column-3'=>'one-fourth',
						'footer-column-4'=>'one-fourth last',
					);
				elseif( $footer_columns_layout == '2v4-1v4-1v4')
					$footer_columns=array(
						'footer-column-1'=>'one-half',
						'footer-column-2'=>'one-fourth',
						'footer-column-3'=>'one-fourth last',
					);
				elseif( $footer_columns_layout == '1v4-1v4-2v4')
					$footer_columns=array(
						'footer-column-1'=>'one-fourth',
						'footer-column-2'=>'one-fourth',
						'footer-column-3'=>'one-half last',
					);
				elseif( $footer_columns_layout == '1v3-1v3-1v3')
					$footer_columns=array(
						'footer-column-1'=>'one-third',
						'footer-column-2'=>'one-third',
						'footer-column-3'=>'one-third last',
					);
				elseif( $footer_columns_layout == '2v3-1v3')
					$footer_columns=array(
						'footer-column-1'=>'two-third',
						'footer-column-2'=>'one-third last',
					);
				elseif( $footer_columns_layout == '1v3-2v3')
					$footer_columns=array(
						'footer-column-1'=>'one-third',
						'footer-column-2'=>'two-third last',
					);
				elseif( $footer_columns_layout == '1v2-1v2')
					$footer_columns=array(
						'footer-column-1'=>'one-half',
						'footer-column-2'=>'one-half last',
					);
				else
					$footer_columns=array(
						'footer-column-1'=>'',
					);
				$is_footer_sidebars=false;
				foreach($footer_columns as $id=>$class) {
					if ( is_active_sidebar($id) ) {
						$is_footer_sidebars=true;
						break;
					}
				}
				
				if($is_footer_sidebars || $subfooter || $footer_menu || $footer_social_icons) { ?>
				
					<footer>
						<div class="footer">
							<?php if($is_footer_sidebars) { ?>
								<div class="footer-widgets">
									<div class="container">
										<div class="container-inner">
											<?php
												foreach($footer_columns as $id=>$class) {
													echo '<div class="footer-widgets-column '.esc_attr($class).'">';
													dynamic_sidebar( $id );
													echo '</div>';
												}
											?>
											<div class="clear"></div>	
										</div>
									</div>		
								</div>
							<?php } ?>
							
							<?php if($is_footer_sidebars && ($subfooter || $footer_menu || $footer_social_icons)) { ?>
								<div class="footer-hor-divider"></div>
							<?php } ?>
							
							<?php if($subfooter || $footer_menu || $footer_social_icons) { ?>
								<div class="sub-footer<?php echo (($subfooter!='')?' with-sub-footer-text':' no-sub-footer-text'); ?>">
									<div class="container">
										<div class="container-inner">
											<div class="sub-footer-menu-social-text clearfix">
												<?php if($footer_menu || $footer_social_icons) { ?>
													<div class="sub-footer-menu-social">
														<?php
															if($footer_menu) {
																wp_nav_menu( array(
																	'theme_location' => 'footer-menu',
																	'container' => false,
																	'menu_class' => 'footer-menu clearfix',
																) );
															}
															if($footer_social_icons) {
																echo '<div class="footer-social-icons'. esc_attr( ( $color = get_option( OM_THEME_PREFIX . 'social_icons_color_footer') ) ? ' '.$color.'-social-icons':'' ) .'">';
																echo wp_kses_post( $footer_social_icons );
																echo '</div>';
															}
														?>
													</div>
												<?php } ?>
												<?php if($subfooter) { echo '<div class="sub-footer-text">'.wp_kses_post($subfooter).'</div>'; } ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						
							
						</div>
					</footer>
					
				<?php } ?>
		</div>
	</div>
<?php echo get_option( OM_THEME_PREFIX . 'code_before_body' ) ?>
<?php wp_footer(); ?>
</body>
</html>