<?php
	
$format=get_post_meta($post->ID, 'ompf_portfolio_type', true);
if(!$format)
	$format='custom';
	
$page_slider=om_get_page_slider($post->ID);
om_custom_header_setup($post->ID);
om_custom_sidebar_setup($post->ID);
get_header();
?>
	<?php if(isset($page_slider) && $page_slider && $page_slider['layout'] != 'before_header') om_tpl_header_slider($page_slider) ?>
	<?php om_tpl_page_title($post->ID, the_title('','',false)) ?>
	<div class="content">
		<div class="container">
			<div class="container-inner">
				
				<div class="content-column-content">
					<?php //e do_shortcode( get_option(OM_THEME_PREFIX . 'code_after_portfolio_h1') ); ?>
										
					<?php while (have_posts()) : the_post(); ?>
							<?php 
								if(function_exists('ompf_portfolio_single_the_content')) {
									ob_start();
									the_content();
									$content=ob_get_clean();
									echo ompf_portfolio_single_the_content($content);
								} else {
									echo '<p><i><b style="color:red">'.__('Please install and activate Olevmedia Portfolio plugin to display the portfolio content.','om_theme').'</b></i></p>';
								}
					   	?>
					<?php endwhile; ?>
					

					<?php //e do_shortcode( get_option(OM_THEME_PREFIX . 'code_after_portfolio_content') ); ?>

					<?php om_wp_link_pages();	?>
					
					<?php get_template_part( 'includes/comments' ); ?>
						
				</div>
								
				<?php //get_sidebar(); ?>
				
				<div class="clear">&nbsp;</div>
				
			</div>
		</div>
	</div>
<?php get_footer(); ?>