<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	//Get testimonial items
	$args = array(
	    'numberposts' => $settings['items']['size'],
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('testimonials'),
	);
	
	if(!empty($settings['testimonial_category']))
	{
		//$args['testimonialcats'] = $settings['testimonial_category'];
		
		$args['tax_query'] = array(
			array (
				'taxonomy' => 'testimonialcats',
				'field' => 'id',
				'terms' => $settings['testimonial_category'],
			)
		);
	}
	$slides = get_posts($args);
	
	if(!empty($slides))
	{
		$pagination = 0;
		if($settings['pagination'] == 'yes')
		{
			$pagination = 1;
		}
		
		$autoplay = 0;
		if($settings['autoplay'] == 'yes')
		{
			$autoplay = 1;
		}
		
		$timer = intval($settings['timer']['size']*1000);
?>
<div class="testimonials-card-wrapper">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>">
<?php
		$counter = 1;
	
		foreach ($slides as $slide) 
		{
?>
			<div class="item">
				<div class="shadow-effect">	
					<?php
						if($settings['show_title'] == 'yes')
						{
					?>
					<h2><?php echo esc_html($slide->post_title); ?></h2>
					<?php
						}
					?>
		          	<?php
			          	if(!empty($slide->post_content))
						{
					?>
						<div class="testimonial-info-desc">
							<?php echo $slide->post_content; ?>
						</div>
					<?php
						}
					?>
					
					<?php
						//Get image meta data
						$image_id = get_post_thumbnail_id($slide->ID);
						$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
						$image_alt = get_post_meta($slide->ID, '_wp_attachment_image_alt', true);
						
						if(isset($image_url[0]) && !empty($image_url[0]) && $settings['show_customer_image'] == 'yes')
						{
					?>
					<div class="testimonial-info-img">
						<img class="img-circle" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
					</div>
					<?php
						}
					?>
					
					<?php
						$testimonial_name = get_post_meta($slide->ID, 'testimonial_name', true);
					
					 	if(!empty($testimonial_name))
					 	{
					?>
					 	<div class="testimonial-name"><?php echo esc_html($testimonial_name); ?></div>
					<?php
					    }
					?>
			</div>
		</div>
<?php
			$counter++;
		}
?>
	</div>
</div>
<?php
	}
?>