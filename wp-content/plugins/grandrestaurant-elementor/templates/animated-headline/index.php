<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	if(!isset($settings['title_alignment'])) {
		$settings['title_alignment'] = 'left';
	}
	
	$allowed_tags = [ 'h1','h2','h3','h4','h5','h6','div','span','p' ]; // keep tight
	$title_html_tag = isset($settings['title_html_tag']) ? strtolower((string) $settings['title_html_tag']) : 'h1';
	
	if (!in_array($title_html_tag, $allowed_tags, true)) {
		$title_html_tag = 'h1';
	}
?>
<div class="themegoods-animated-headline text-alignment-<?php echo esc_attr($settings['title_alignment']); ?>" data-animation="<?php echo esc_attr($settings['headline_animation']); ?>">
	<<?php echo esc_html($title_html_tag); ?> class="animated-headline ah-headline">
	<?php
		//Display before text
		if(isset($settings['headline_before']) && !empty($settings['headline_before'])) {
	?>
		<span><?php echo ($settings['headline_before']); ?></span>
	<?php
		}
	?>
	<?php
		//Display animated text
		if(isset($settings['headline_animated']) && !empty($settings['headline_animated']) && is_array($settings['headline_animated'])) {
	?>
		<span class="ah-words-wrapper">
	<?php
			foreach ( $settings['headline_animated'] as $key => $item) {
				$class_name = '';
				if(empty($key)) {
					$class_name = 'class="is-visible"';
				}
	?>
			<b <?php echo $class_name; ?>><?php echo $item['headline_animated_text']; ?></b>
	<?php	
			}
	?>
		</span>
	<?php
		}
	?>
	
	<?php
		//Display after text
		if(isset($settings['headline_after']) && !empty($settings['headline_after'])) {
	?>
		<span><?php echo ($settings['headline_after']); ?></span>
	<?php
		}
	?>
	</<?php echo esc_attr($settings['title_html_tag']); ?>>
</div>