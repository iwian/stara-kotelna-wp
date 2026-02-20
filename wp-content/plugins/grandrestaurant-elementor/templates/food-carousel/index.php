<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$autoplay = 0;
	if($settings['autoplay'] == 'yes')
	{
		$autoplay = 1;
	}
	
	$pagination = 0;
	if($settings['pagination'] == 'yes')
	{
		$pagination = 1;
	}
	
	$timer = intval($settings['timer']['size']*1000);

	$thumb_image_name = 'grandrestaurant-gallery-grid';
	if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
	{
		//If display original dimension and less initial items then display higher resolution image
		if($settings['image_dimension'] == 'medium_large' && $settings['ini_item']['size'] < 3)
		{
			$settings['image_dimension'] = 'large';
		}
		
		$thumb_image_name = $settings['image_dimension'];
	}

	$widget_id = $this->get_id();
	
	//Get food menu items
	$args = array(
		'numberposts' => $settings['items']['size'],
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'post_type' => array('menus'),
	);
	
	if(!empty($settings['menu_category']))
	{
		//$args['menucats'] = $settings['menu_category'];
		
		$args['tax_query'] = array(
			array (
				'taxonomy' => 'menucats',
				'field' => 'id',
				'terms' => $settings['menu_category'],
			)
		);
	}
	
	$slides = get_posts($args);
	$count_slides = count($slides);
	
	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
		$count = 1;
?>
<div class="food-carousel-wrapper">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>" data-items="<?php echo intval($settings['ini_item']['size']); ?>" data-stage-padding="<?php echo esc_attr($settings['stage_padding']['size']); ?>" data-margin="<?php echo esc_attr($settings['item_margin']['size']); ?>">
<?php
		foreach ( $slides as $slide ) 
		{
			//Get image meta data
			$image_id = get_post_thumbnail_id($slide->ID);
			$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
			$image_alt = get_post_meta($slide->ID, '_wp_attachment_image_alt', true);
			
			//Calculate menu highlight
			$menu_price = get_post_meta($slide->ID, 'menu_price');
			$menu_highlight = get_post_meta($slide->ID, 'menu_highlight');
			$menu_highlight_title = get_post_meta($slide->ID, 'menu_highlight_title');
			
			$menu_order_url = get_post_meta($slide->ID, 'menu_order_url');
			if(isset($menu_order_url[0]))
			{
				$menu_order_url = $menu_order_url[0];
			}
?>
			<div class="item food-tooltip" <?php if(!empty($slide->post_content) && $settings['show_tooltip'] == 'yes') { ?>data-tooltip-content="#tooltip-content-<?php echo esc_attr($widget_id); ?>-<?php echo esc_attr($count); ?>"<?php } ?>>
			
				<?php 
					if(!empty($slide->post_content) && $settings['show_tooltip'] == 'yes')
					{
				?>
				<div class="tooltip_templates">
					<div id="tooltip-content-<?php echo esc_attr($widget_id); ?>-<?php echo esc_attr($count); ?>" class="food-menu-tooltip-content">
						<h5><?php esc_html_e("Menu Information", 'grandrestaurant-elementor' ); ?></h5>
						<div class="food-menu-tooltip-templates-content">
							<?php echo htmlspecialchars_decode($slide->post_content); ?>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			
				<div class="food-carousel-handle"></div>
				
				<?php
					//Display featured image
					if(isset($image_url[0]) && !empty($image_url[0]))
					{
				?>
					<div class="food-carousel-image">
						<div class="food-carousel-image-overflow">
							<?php
								if(isset($menu_price[0]) && !empty($menu_price[0]))
								{
							?>
							<div class="food-menu-content-price-holder">
								<span class="food-menu-content-price-normal">
									<?php echo esc_html(grandrestaurant_format_price($menu_price[0], $slide->ID)); ?>
								</span>
							</div>
							<?php
								}
							?>
							<?php 
								if(!empty($menu_order_url))
								{
							?>
								<a href="<?php echo esc_url($menu_order_url); ?>">
							<?php
								}
							?>
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
							<?php 
								if(!empty($menu_order_url))
								{
							?>
							</a>
							<?php
								}
							?>
						</div>
					</div>
				<?php
					}
				?>
				
				<div class="food-carousel-content">
					<div class="overflow-inner">
						<div class="overflow-text">
							<h3 class="food-carousel-title">
								<?php 
									if(!empty($menu_order_url))
									{
								?>
									<a href="<?php echo esc_url($menu_order_url); ?>">
								<?php
									}
								?>
								<?php echo esc_html($slide->post_title); ?>
								<?php 
									if(!empty($menu_order_url))
									{
								?>
									</a>
								<?php
									}
								?>
							</h3>
							<div class="food-carousel-subtitle"><?php echo $slide->post_excerpt; ?></div>
							
							<?php
								//Get menu size options
								$menu_size_item_title_arr = get_post_meta($slide->ID, 'menu_size_item_title', true);
								$menu_size_item_price_arr = get_post_meta($slide->ID, 'menu_size_item_price', true);
								$return_html = '';
								
								if(!empty($menu_size_item_title_arr) && is_array($menu_size_item_title_arr))
								{
									foreach($menu_size_item_title_arr as $key => $menu_size_item_title_item)
									{
										if(!empty($menu_size_item_title_item))
										{
											$return_html.= '<h5 class="menu_post size"><span class="menu_title size">'.$menu_size_item_title_item.'</span>';
										}
											
										if(isset($menu_size_item_price_arr[$key]) && !empty($menu_size_item_price_arr[$key]))
										{
											$return_html.= '<span class="menu_price size">'.grandrestaurant_format_price($menu_size_item_price_arr[$key], $slide->ID).'</span>';
										}
									}
								}
								
								echo $return_html;
							?>
						</div>
					</div>
				</div>
			</div>
<?php
		}	//End foreach	 
?>
	</div>
</div>
<?php
	}
?>