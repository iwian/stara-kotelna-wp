<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	$shortcode = '[ppb_team_column padding="0" ';
	
	if(isset($settings['team_category']) && !empty($settings['team_category']))
	{
		$obj_term = get_term($settings['team_category'], 'teamcats');
		if(is_object($obj_term)) {
			$shortcode.= 'cat="'.$obj_term->slug.'" ';
		}
	}
	
	if(isset($settings['columns']['size']) && !empty($settings['columns']['size']))
	{
		$shortcode.= 'columns="'.$settings['columns']['size'].'" ';
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$shortcode.= 'items="'.$settings['items']['size'].'" ';
	}
	
	$shortcode.= '][/ppb_team_column]';
	
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
<br class="clear"/>