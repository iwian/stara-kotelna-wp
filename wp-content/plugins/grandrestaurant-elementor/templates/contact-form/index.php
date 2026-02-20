<?php
	//Get all settings
	$settings = $this->get_settings();
	$shortcode = '';
?>
<div class="grandrestaurant-contact-form-content-wrapper <?php echo esc_attr($settings['form_layout']); ?> content-align-<?php echo esc_attr($settings['alignment']); ?>">
	<?php
		if(isset($settings['form_id']) && !empty($settings['form_id'])) {
			echo do_shortcode('[contact-form-7 id="'.esc_attr($settings['form_id']).'" title=""]');
		}
	?>
</div>