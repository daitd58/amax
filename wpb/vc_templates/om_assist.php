<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

if ($el_class)
    $el_class = ' ' . $el_class;

$styles = array();
$tag_attributes = array();
$classes = array(apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_om-assist wpb_content_element' . $el_class, $this->settings['base'], $atts));

echo '<div class="'.implode(' ',$classes).'"'.(!empty($styles)?' style="'.implode(';',$styles).'"':'').'>';
?>
    <a href="#contact_form_pop" class="fancybox"><?php echo $title ?></a>
    <div style="display:none" class="fancybox-hidden">
        <div id="contact_form_pop">
            <div class="title"><?php echo $title ?></div>
            <?php echo do_shortcode($contact_form) ?>
        </div>
    </div>
<?php
echo '</div>';
