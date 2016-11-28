<?php

function om_wpb_detect($post) {

	global $_WPB_PAGE_SUPPORT_CUSTOM_ROW;
	$_WPB_PAGE_SUPPORT_CUSTOM_ROW=true;	
	
	if( strcasecmp( substr(ltrim($post->post_content),0,7), '[vc_row' ) == 0 ) {
		om_body_add_class('om-wpb-active');
	} else {
		om_body_remove_class('om-wpb-active');
	}
	
}


function om_wpb_cleanup($content) {
	
	$content=str_replace('<p></div></div>','</div></div>', $content);
	$content=str_replace('<div class="om-c-container-inner"></p>','<div class="om-c-container-inner">', $content);
	$content=str_replace('<div class="om-c-container"><div class="om-c-container-inner"></div></div>','', $content);
	
	return $content;
}
add_filter('the_content', 'om_wpb_cleanup', 11);


function om_wpb_get_animation($atts) {
	
	$animation=array(
		'classes' => '',
		'atts' => '',
	);
	
	if(isset($atts['css_animation']) && $atts['css_animation'] != '') {
		$animation['classes'].=' om-animation om-effect-'.$atts['css_animation'];
		if(isset($atts['css_animation_delay'])) {
			$delay=intval($atts['css_animation_delay']);
			if($delay)
				$animation['atts'].=' data-animation-delay="'.$delay.'"';
		}
	}
	
	return $animation;
}

function om_wpb_std_colors() {
	
	$colors=array(
		'blue' => array('name' => 'Blue', 'color' => '#5472d2'),
		'turquoise' => array('name' => 'Turquoise', 'color' => '#00c1cf'),
		'pink' => array('name' => 'Pink', 'color' => '#fe6c61'),
		'violet' => array('name' => 'Violet', 'color' => '#8d6dc4'),
		'peacoc' => array('name' => 'Peacoc', 'color' => '#4cadc9'),
		'chino' => array('name' => 'Chino', 'color' => '#cec2ab'),
		'mulled-wine' => array('name' => 'Mulled Wine', 'color' => '#50485b'),
		'mulled_wine' => array('name' => 'Mulled Wine', 'color' => '#50485b'),
		'vista-blue' => array('name' => 'Vista Blue', 'color' => '#75d69c'),
		'vista_blue' => array('name' => 'Vista Blue', 'color' => '#75d69c'),
		'black' => array('name' => 'Black', 'color' => '#2a2a2a'),
		'grey' => array('name' => 'Grey', 'color' => '#ebebeb'),
		'orange' => array('name' => 'Orange', 'color' => '#f7be68'),
		'sky' => array('name' => 'Sky', 'color' => '#5aa1e3'),
		'green' => array('name' => 'Green', 'color' => '#6dab3c'),
		'juicy-pink' => array('name' => 'Juicy pink', 'color' => '#f4524d'),
		'juicy_pink' => array('name' => 'Juicy pink', 'color' => '#f4524d'),
		'sandy-brown' => array('name' => 'Sandy brown', 'color' => '#f79468'),
		'sandy_brown' => array('name' => 'Sandy brown', 'color' => '#f79468'),
		'purple' => array('name' => 'Purple', 'color' => '#b97ebb'),
		'white' => array('name' => 'White', 'color' => '#ffffff'),
	);
	
	return $colors;
}

function om_wpb_get_std_colors() {
	$colors=om_wpb_std_colors();
	$out=array();
	foreach($colors as $k=>$v) {
		$out[$v['name']]=$k;
	}
	return $out;
}

function om_wpb_get_std_color_code($key) {
	$colors=om_wpb_std_colors();
	if(isset($colors[$key])) {
		return $colors[$key]['color'];
	} else {
		return false;
	}
}

function om_wpb_icon_params($empty = false, $dependency = false) {
	
	$type=array(
		__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
		__( 'Open Iconic', 'js_composer' ) => 'openiconic',
		__( 'Typicons', 'js_composer' ) => 'typicons',
		__( 'Entypo', 'js_composer' ) => 'entypo',
		__( 'Linecons', 'js_composer' ) => 'linecons',
	);
	
	if($empty)
		$type=array_merge(array(__('No Icon', 'om_theme') => '') , $type);
	
	$icon_params=array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon library', 'js_composer' ),
			'value' => $type,
			'param_name' => 'icon_type',
			'description' => __( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'openiconic',
			),
			'description' => __( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
			'element' => 'icon_type',
			'value' => 'typicons',
		),
			'description' => __( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'linecons',
			),
			'description' => __( 'Select icon from library.', 'js_composer' ),
		),
	);
	
	if($dependency) {
		$icon_params[0]['dependency']=$dependency;
	}
	
	return $icon_params;
}

/**
 *
 */
 
function om_wpb_remove_pixel_icons($param) {
	$param_new=array();
	foreach($param as $k=>$v)	 {
		if($v != 'pixelicons')
			$param_new[$k]=$v;
	}
	return $param_new;
}

/**
 *
 */

class OMWPBScParams {
	
	protected $params=array();
	
	protected $sc=false;
	
	
	function OMWPBScParams($tag) {
		$this->sc=$tag;
		
		$settings=WPBMap::getShortCode($tag);
		
		if(!empty($settings) && isset($settings['params'])) {
			$this->params=$settings['params'];
		}
	}
	
	public function save() {
		vc_map_update( $this->sc, array('params' => $this->params) );
	}

	public function remove($attribute_name) {
		foreach ( $this->params as $index => $param ) {
			if ( $param['param_name'] == $attribute_name ) {
				array_splice( $this->params, $index, 1 );
			}
		}
	}	
	
	public function removeIntegratedShortcode($shortcode, $prefix) {
		$new_params=array();
		
		foreach ( $this->params as $index => $param ) {
			if( isset($param['integrated_shortcode']) && $param['integrated_shortcode'] == $shortcode && strpos($param['param_name'],$prefix) === 0) {
				continue;
			}
			$new_params[]=$param;
		}
		
		$this->params=$new_params;
	}	
	
	public function add($new_param, $after=false) {
	
		$after_index=false;
		
		if($after) {
			foreach ( $this->params as $index => $param ) {
				if ( $param['param_name'] == $after ) {
					$after_index=$index;
					break;
				}
			}
		}
		
		if($after_index) {
			array_splice( $this->params, $after_index+1, 0, array($new_param) );
		} else {
			$this->params[]=$new_param;
		}
	}
	
	public function get($attribute_name) {
		foreach ( $this->params as $index => $param ) {
			if ( $param['param_name'] == $attribute_name ) {
				return $param;
			}
		}
		
		return false;
	}
	
	public function update($new_param) {
		foreach ( $this->params as $index => $param ) {
			if ( $param['param_name'] == $new_param['param_name'] ) {
				$this->params[$index]=$new_param;
			}
		}
	}
	
	public function updateIntegratedShortcode($shortcode, $field_prefix = '', $group_prefix = '', $change_fields = null, $dependency = null) {
		
		$new_params=array();
		$insert_index=false;
		foreach($this->params as $index => $param) {
			if( isset($param['integrated_shortcode']) && $param['integrated_shortcode'] == $shortcode && strpos($param['param_name'],$field_prefix) === 0) {
				if(!$insert_index)
					$insert_index=count($new_params);
				continue;
			}
			$new_params[]=$param;
		}
		
		if($insert_index) {
			$new_params=array_merge(
				array_slice($new_params,0,$insert_index), 
				vc_map_integrate_shortcode( $shortcode, $field_prefix, $group_prefix,	$change_fields,	$dependency ),
				array_slice($new_params,$insert_index) 
			);
		}
		
		$this->params=$new_params;
		
	}
	
}

/**
 *
 */

class OMWPBMap extends WPBMap {
	
	/**
	 * Add new param to shortcode params list after specified parameter.
	 *
	 * @static
	 *
	 * @param $name
	 * @param array $attribute
	 *
	 * @return bool - true if added, false if scheduled/rejected
	 */
	 
	public static function addParamAfter( $name, $attribute = Array(), $after = false ) {
		
		if(!$after) {
			return self::addParam($name, $attribute);
		}
		
		if ( ! self::$is_init ) {
			vc_mapper()->addActivity(
				'mapper', 'add_param', array(
					'name' => $name,
					'attribute' => $attribute
				)
			);

			return false;
		}
		if ( ! isset( self::$sc[ $name ] ) ) {
			trigger_error( sprintf( __( "Wrong name for shortcode:%s. Name required", "js_composer" ), $name ) );
		} elseif ( ! isset( $attribute['param_name'] ) ) {
			trigger_error( sprintf( __( "Wrong attribute for '%s' shortcode. Attribute 'param_name' required", "js_composer" ), $name ) );
		} else {

			$replaced = false;

			foreach ( self::$sc[ $name ]['params'] as $index => $param ) {
				if ( $param['param_name'] == $attribute['param_name'] ) {
					$replaced = true;
					self::$sc[ $name ]['params'][ $index ] = $attribute;
				}
			}
			if ( $replaced === false ) {
				$after_index=false;
				
				foreach ( self::$sc[ $name ]['params'] as $index => $param ) {
					if ( $param['param_name'] == $after ) {
						$after_index=$index;
						break;
					}
				}

				if($after_index) {
					array_splice( self::$sc[ $name ]['params'], $after_index+1, 0, array($attribute) );
				} else {
					self::$sc[ $name ]['params'][] = $attribute;
				}
			}
			$sort = new Vc_Sort( self::$sc[ $name ]['params'] );
			self::$sc[ $name ]['params'] = $sort->sortByKey();
			visual_composer()->addShortCode( self::$sc[ $name ] );

			return true;
		}

		return false;
	}
		
}
