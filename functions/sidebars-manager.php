<?php

/*************************************************************************************
 *	Sidebars Manager Page
 *************************************************************************************/
 
function om_sidebars_add_page() {

  add_theme_page(__('Sidebars', 'om_theme'), __('Sidebars', 'om_theme'), 'edit_theme_options', 'om_sidebars', 'om_sidebars_page');
	
} 

add_action('admin_menu', 'om_sidebars_add_page');

/*************************************************************************************
 *	Build the Sidebars Page
 *************************************************************************************/

function om_sidebars_page(){
	
	?>
	<style>
		.om-error {
			border-color:red !important;
		}
	</style>
	<div class="wrap" id="om-sidebars">
		<h2><?php _e('Sidebars', 'om_theme'); ?></h2>
		<p><em><?php printf(__('Any number of sidebars is possible. You can choose a certain sidebar which should be displayed on a specific page, when you edit a page. Widgets can be added into sidebars <a href="%s">here</a>.', 'om_theme'), admin_url( 'widgets.php' )) ?></em></p>
		<br/>
		<table class="wp-list-table widefat fixed" style="width:auto">
			<thead>
				<tr>
					<th><?php _e('Sidebar name', 'om_theme'); ?></th>
				</tr>
			</thead>
			<tbody id="om-sidebars-table-body">
				<?php
					$sidebars=get_option(OM_THEME_PREFIX.'extra_sidebars');
					if(is_array($sidebars)) {
						foreach($sidebars as $k=>$v) {
							?>
							<tr>
								<td><?php echo esc_html($v) ?> [<a href="#" class="om-sidebars-remove" data-name="<?php echo esc_attr($v) ?>" data-key="<?php echo esc_attr($k) ?>"><?php _e('remove','om_theme') ?></a>]</td>
							</tr>
							<?php
						}
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>
						<div style="margin-bottom:5px">Add new sidebar:</div>
						<input type="text" style="margin:0 10px 0 0;width:250px;padding:4px" id="om-sidebar-add-name" /><input type="button" class="button-primary" value="<?php _e('Add', 'om_theme') ?>" id="om-sidebar-add-button" />
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<script>
		jQuery(function($){
			$('#om-sidebar-add-button').click(function(){
				var $name=$('#om-sidebar-add-name');
				var $button=$(this);
				
				if($name.val() != '') {
					
					$name.attr('disabled','disabled');
					$button.attr('disabled','disabled');
					jQuery.post(ajaxurl, {
						type: 'add',
						action: 'om_theme_sidebars_ajax',
						name: $name.val()
					}, function(response) {
						if(!response.error) {
							var $remove=$('<a href="" class="om-sidebars-remove"><?php _e('remove','om_theme') ?></a>');
							$remove.data('name',$name.val());
							$remove.data('key',response.key);
							remove_init($remove);
							var $td=$('<td />');
							$td.text($name.val() + ' [')
							$remove.appendTo($td);
							$td.append(']');
							var $tr=$('<tr/>');
							$td.appendTo($tr);
							$tr.appendTo($('#om-sidebars-table-body'));
							$name.val('');
						} else {
							$name.addClass('om-error');
							setTimeout(function(){
								$name.removeClass('om-error');
							},2000);
						}
					}).always(function(){
						$name.attr('disabled',false);
						$button.attr('disabled',false);
					});
					
				} else {
					$name.addClass('om-error');
					setTimeout(function(){
						$name.removeClass('om-error');
					},2000);
				}
			});
			
			function remove_init($obj) {
				$obj.click(function(){
					var $a=$(this);
					if(confirm('<?php esc_attr(_e('Are you sure you want to remove sidebar ','om_theme'))?>"' + $(this).data('name') + '"?')) {
						jQuery.post(ajaxurl, {
							type: 'remove',
							action: 'om_theme_sidebars_ajax',
							key: $(this).data('key')
						}, function(response) {
							if(!response.error) {
								$a.parents('tr').remove();
							}
						});
					}
					
					return false;
				});
			}
			remove_init($('.om-sidebars-remove'));

		});
	</script>
	<?php
	
}

/*************************************************************************************
 *	Ajax Action
 *************************************************************************************/

add_action('wp_ajax_om_theme_sidebars_ajax', 'om_sidebars_ajax_callback');

function om_sidebars_ajax_callback() {
	
	if($_POST['type'] == 'add') {
		
		$ret=array('error' => false);
		
		$name=stripslashes($_POST['name']);
		$key=preg_replace('/[^A-Za-z0-9-_]/','', sanitize_title($name));
		if(!$key) {
			$ret['error'] = 'empty';
			wp_send_json($ret);
		}
		
		$sidebars=get_option(OM_THEME_PREFIX.'extra_sidebars');
		if(isset($sidebars[$key])) {
			$ret['error'] = 'duplicate';
			wp_send_json($ret);
		}
		
		$sidebars[$key]=$name;
		asort($sidebars);
		update_option(OM_THEME_PREFIX.'extra_sidebars',$sidebars);
		
		$ret['key']=$key;
		
		wp_send_json($ret);
		
	} elseif($_POST['type'] == 'remove') {
		
		$ret=array('error' => false);
		
		$key=$_POST['key'];
		if(!$key) {
			$ret['error'] = 'empty';
			wp_send_json($ret);
		}
		
		$sidebars=get_option(OM_THEME_PREFIX.'extra_sidebars');
		unset($sidebars[$key]);
		update_option(OM_THEME_PREFIX.'extra_sidebars',$sidebars);
		
		wp_send_json($ret);
		
	}
}