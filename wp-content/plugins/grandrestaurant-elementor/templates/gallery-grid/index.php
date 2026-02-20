<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();

	//Get selected gallery
	if($settings['gallery_content_type'] == 'gallery_post')
	{
		$images = grandrestaurant_get_gallery_images($settings['gallery_id']);
	}
	else
	{
		$images = $this->get_settings('gallery');
	}

	if(!empty($images))
	{	
		//Get spacing class
		$spacing_class = '';
		if($settings['spacing'] != 'yes')
		{
			$spacing_class = 'has-no-space';
		}
		
		//Get entrance animation option
		$smoove_animation_attr = '';
		switch($settings['entrance_animation'])
		{
			case 'slide-up':
			default:
				$smoove_animation_attr = 'data-move-y="60px"';
				
			break;
			
			case 'popout':
				$smoove_animation_attr = 'data-scale="0"';
				
			break;
			
			case 'fade-in':
				$smoove_animation_attr = 'data-opacity="0"';
				
			break;
		}
		
		//Get lightbox link
		$is_lighbox = false;
		if($settings['lightbox'] == 'yes')
		{
			$is_lighbox = true;
		}
		
		$column_class = 1;
		$thumb_image_name = 'grandrestaurant-gallery-grid';
		if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
		{
			$thumb_image_name = $settings['image_dimension'];
		}
		
		//Start displaying gallery columns
		switch($settings['columns']['size'])
		{
		   	case 1:
		   	default:
		   		$column_class = 'grandrestaurant-one-cols';
		   		$thumb_image_name = 'original';
		   	break;
		   	
		   	case 2:
		   		$column_class = 'grandrestaurant-two-cols';
		   	break;
		   	
		   	case 3:
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
		
		$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
?>
<div class="grandrestaurant-gallery-grid-content-wrapper layout-<?php echo esc_attr($column_class); ?> <?php echo esc_attr($spacing_class); ?>">
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
		
		foreach ( $images as $image ) 
		{
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}

			if($settings['gallery_content_type'] == 'gallery_post')
			{
				$image_ID = $image;
			}
			else
			{
				if(isset($image['id']) && !empty($image['id']))
				{
					$image_ID = $image['id'];
				}
				else
				{
					$image_ID = grandrestaurant_get_image_id($image['url']);
				}
			}
			
			$thumb_image_url = wp_get_attachment_image_src($image_ID, $thumb_image_name, true);
			$lightbox_image_url = wp_get_attachment_image_src($image_ID, 'full', true);
			
			if(is_numeric($image_ID))
			{
				//Get image meta data
			    $image_alt = get_post_meta($image_ID, '_wp_attachment_image_alt', true);
			    
			    //Get lightbox content
			    $image_title = '';
			    $image_desc = '';
			    switch($settings['lightbox_content'])
				{
					case 'title':
						$image_title = get_the_title($image_ID);
					break;
					
					case 'title_caption':
						$image_title = get_the_title($image_ID);
						$image_desc = get_post_field('post_excerpt', $image_ID);
					break;
				}
			}
			
			$return_attr = grandrestaurant_get_lazy_img_attr();
			
			//Calculation for animation queue
			if(!isset($queue))
			{
				$queue = 1;	
			}
			
			if($queue > $settings['columns']['size'])
			{
				$queue = 1;
			}
?>
		<div class="gallery-grid-item <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?> <?php if(!empty($tg_enable_lazy_loading)) { ?>lazy<?php } ?> smoove <?php echo esc_attr($settings['entrance_animation']); ?>" data-delay="<?php echo intval($queue*150); ?>" data-minwidth="<?php echo esc_attr($smoove_min_width); ?>" <?php echo $smoove_animation_attr; ?>>
			<?php
				if($is_lighbox)	
				{
			?>
				<a class="grandrestaurant_gallery_lightbox" data-rel="tg_gallery<?php echo esc_attr($widget_id); ?>" href="<?php echo esc_url($lightbox_image_url[0]); ?>">
			<?php
				}
			?>
				<img <?php echo grandrestaurant_get_blank_img_attr(); ?> <?php echo esc_attr($return_attr['source']); ?>="<?php echo esc_url($thumb_image_url[0]); ?>" class="<?php echo esc_attr($return_attr['class']); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			<?php
				if($settings['show_title'] == 'yes')
				{
					if(empty($image_title))
					{
						$image_title = get_the_title($image);
					}
			?>		
				<div class="bg-overlay"></div>
				<div class="gallery-grid-title"><?php echo esc_html($image_title); ?></div>
			<?php
				}
				
				if($is_lighbox)	
				{
			?>
				</a>
			<?php
				}
			?>
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