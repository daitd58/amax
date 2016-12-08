<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

if ($el_class)
    $el_class = ' ' . $el_class;

$styles = array();
$tag_attributes = array();
$classes = array(apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_om-detail-box wpb_content_element' . $el_class, $this->settings['base'], $atts));

echo '<div class="' . implode(' ', $classes) . '"' . (!empty($styles) ? ' style="' . implode(';', $styles) . '"' : '') . '>';
?>
    <div class="title">
        <h2><?php echo $title ?></h2>
    </div>
    <div class="excerpt">
        <p><?php echo substr($service_info, 0, 100). '...'; ?></p>
    </div>
    <div style="display:none" class="detail-content">
        <p><?php echo $service_info ?></p>
    </div>
    <div class="detail-button">
        <a class="readmore">read more</a>
        <a class="hide-detail" style="display:none">hide</a>
    </div>
    
<?php
echo '</div>';
