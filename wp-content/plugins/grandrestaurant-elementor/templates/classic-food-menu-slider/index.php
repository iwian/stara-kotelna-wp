<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	$shortcode = '[ppb_menu_slider ';
	
	if(isset($settings['menu_category']) && !empty($settings['menu_category']))
	{
		//Get terms slug by ID
		$obj_term = get_term_by('ID', $settings['menu_category'], 'menucats');
		/*var_dump($settings['menu_category']);
		var_dump($obj_term);*/
		if(is_object($obj_term)) {
			$shortcode.= 'cat="'.$obj_term->slug.'" ';
		}
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$shortcode.= 'items="'.$settings['items']['size'].'" ';
	}
	
	$shortcode.= '][/ppb_menu_slider]';
	
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
<br class="clear"/>