<div class="portfolio-classic-container contain grandrestaurant-team-grid">
<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	//Get team items
	$args = array(
	    'numberposts' => $settings['items']['size'],
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('team'),
	);
	
	if(!empty($settings['team_category']))
	{
		//$args['team_category'] = $settings['team_category'];
		
		$args['tax_query'] = array(
			array (
				'taxonomy' => 'teamcats',
				'field' => 'id',
				'terms' => $settings['team_category'],
			)
		);
	}
	$slides = get_posts($args);
	$count_slides = count($slides);
	
	if(!empty($slides))
	{
		//Get spacing class
		$spacing_class = '';
		if($settings['spacing'] != 'yes')
		{
			$spacing_class = 'has-no-space';
		}
		
		$column_class = 1;
		$thumb_image_name = 'grandrestaurant-album-grid';
		if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
		{
			$thumb_image_name = $settings['image_dimension'];
		}
		
		//Start displaying gallery columns
		switch($settings['columns']['size'])
		{
			case 1:
		   		$column_class = 'grandrestaurant-one-col';
		   	break;
		   	
			case 2:
		   		$column_class = 'grandrestaurant-two-cols';
		   	break;
		   	
		   	case 3:
		   	default:
		   		$column_class = 'grandrestaurant-three-cols';
		   	break;
		   	
		   	case 4:
		   		$column_class = 'grandrestaurant-four-cols';
		   	break;
		   	
		   	case 5:
		   		$column_class = 'grandrestaurant-five-cols';
		   	break;
		   	
		   	case 6:
		   		$column_class = 'tg_six_cols';
		   	break;
		}
?>
<div class="portfolio-classic-content-wrapper portfolio-classic layout-<?php echo esc_attr($column_class); ?> <?php echo esc_attr($spacing_class); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>">
<?php		
		$animation_class = '';
		if(isset($settings['disable_animation']))
		{
			$animation_class = 'disable_'.$settings['disable_animation'];
		}
		
		$smoove_min_width = 1;
		switch($settings['disable_animation'])
		{
			case 'none':
				$smoove_min_width = 1;
			break;
			
			case 'tablet':
				$smoove_min_width = 769;
			break;
			
			case 'mobile':
				$smoove_min_width = 415;
			break;
			
			case 'all':
				$smoove_min_width = 5000;
			break;
		}
	
		$last_class = '';
		$count = 1;
		
		foreach ( $slides as $slide ) 
		{
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}
			
			//Get image meta data
			$image_id = get_post_thumbnail_id($slide->ID);
			$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
			$image_alt = get_post_meta($slide->ID, '_wp_attachment_image_alt', true);
			
			//Calculation for animation queue
			if(!isset($queue))
			{
				$queue = 1;	
			}
			
			if($queue > $settings['columns']['size'])
			{
				$queue = 1;
			}
			
			//Get team meta data
			$team_position = get_post_meta($slide->ID, 'team_position', true);
?>
		<div class="portfolio-classic-grid-wrapper <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?>  portfolio-<?php echo esc_attr($count); ?> tile scale-anm all smoove <?php echo esc_attr($animation_class); ?>" data-delay="<?php echo intval($queue*150); ?>" data-minwidth="<?php echo esc_attr($smoove_min_width); ?>" data-move-y="45px">
			<div class="portfolio-classic-img grid_tilt">
				<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
			</div>
			<br class="clear"/>
			<div class="portfolio-classic-content">
				<div class="portfolio-classic-subtitle"><?php echo esc_html($team_position); ?></div>
				<h3 class="portfolio-classic_title"><?php echo esc_html($slide->post_title); ?></h3>
				
				<div class="portfolio-classic-description"><?php echo $slide->post_content; ?></div>
			</div>
		</div>
<?php
			$count++;
			$queue++;
		}
?>
<?php
	if($settings['spacing'] == 'yes')
	{
?>
<br class="clear"/>
<?php
	}
?>
</div>
<?php
	}
?>
</div>