<?php

	if($slider) {
		$slider_html=om_display_page_slider($slider, false);
		if($slider_html) {
			if($slider['layout'] == 'boxed') {
				?>
				<div class="header-slider layout-<?php echo esc_attr($slider['layout']) ?> clearfix">
					<div class="container">
						<div class="container-inner">
							<?php echo om_esc_sg($slider_html); ?>
						</div>
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="header-slider layout-<?php echo esc_attr($slider['layout']) ?> clearfix">
					<?php echo om_esc_sg($slider_html); ?>
				</div>
				<?php
			}
		}
		unset($slider_html);
	}