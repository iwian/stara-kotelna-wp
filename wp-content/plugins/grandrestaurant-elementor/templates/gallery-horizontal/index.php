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
		$timer_arr = $this->get_settings('timer');
		$timer = intval($timer_arr['size']) * 1000;
		
		if($settings['autoplay'] != 'yes')
		{
			$timer = 0;
		}
		
		$loop = 0;
		if($settings['loop'] == 'yes')
		{
			$loop = 1;
		}
		
		$navigation = 0;
		if($settings['navigation'] == 'yes')
		{
			$navigation = 1;
		}
		
		$pagination = 0;
		if($settings['pagination'] == 'yes')
		{
			$pagination = 1;
		}
		
		$parallax = 0;
		if($settings['parallax'] == 'yes')
		{
			$parallax = 1;
		}
		
		$fullscreen = 0;
		if($settings['fullscreen'] == 'yes')
		{
			$fullscreen = 1;
		}
?>
<div class="horizontal-gallery-wrapper" data-autoplay="<?php echo intval($timer); ?>" data-loop="<?php echo intval($loop); ?>" data-navigation="<?php echo intval($navigation); ?>" data-pagination="<?php echo intval($pagination); ?>" data-parallax="<?php echo intval($parallax); ?>" data-fullscreen="<?php echo intval($fullscreen); ?>">
<?php
		$counter = 0;
	
		foreach ( $images as $image ) 
		{	
			$image_alt = '';
			
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
			
			$image_url = wp_get_attachment_image_src($image_ID, $settings['image_size'], true);
			$full_image_url = wp_get_attachment_image_src($image_ID, 'full', true);
			
			if(is_numeric($image_ID))
			{
				//Get image meta data
				$image_alt = get_post_meta($image_ID, '_wp_attachment_image_alt', true);
			}
			
			$themegoods_link_url = get_post_meta($image_ID, 'grandrestaurant_purchase_url', true);
?>
		<div class="horizontal-gallery-cell" style="margin-right:<?php echo intval($settings['spacing']['size']).$settings['spacing']['unit']; ?>">
			<?php
			if(!empty($themegoods_link_url)) 
			{
			?>
			<a href="<?php echo esc_url($themegoods_link_url); ?>" target="_blank">
			<?php
				}
			?>
			<img class="horizontal-gallery-cell-img" data-flickity-lazyload="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" style="height:<?php echo intval($settings['height']['size']).$settings['height']['unit']; ?>;" />
			<?php
			if(!empty($themegoods_link_url)) 
			{
			?>
			</a>
			<?php
				}
			?>
		</div>
<?php
			$counter++;
		}
?>
</div>
<?php
	}
?>