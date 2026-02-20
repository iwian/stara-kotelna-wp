<div class="food-menu-container">
<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
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
	
	if($settings['show_image'] == 'yes')
	{
		$args['meta_key'] = '_thumbnail_id';
	}
	//var_dump($args);
	$slides = get_posts($args);
	$count_slides = count($slides);
	
	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
		
		$column_class = 1;
		$thumb_image_name = 'thumbnail';
?>
<div class="food-menu-content-wrapper food-menu">
<?php		
		$count = 1;
		
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
		<div class="food-menu-grid-wrapper food-tooltip food-menu-<?php echo esc_attr($count); ?> <?php if(!empty($menu_highlight)) { ?>food-menu-highlight<?php } ?>" <?php if(!empty($slide->post_content) && $settings['show_tooltip'] == 'yes') { ?>data-tooltip-content="#tooltip-content-<?php echo esc_attr($widget_id); ?>-<?php echo esc_attr($count); ?>"<?php } ?>>
			
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
			
			<?php 
				if(isset($menu_highlight[0]) && !empty($menu_highlight[0])) { 
			?>
				<div class="food-menu-content-highlight-holder">
					<?php 
						if(isset($menu_highlight_title[0]) && !empty($menu_highlight_title[0])) { 
					?>
						<h4><?php echo esc_html($menu_highlight_title[0]); ?></h4>
					<?php
						}
					?>
				</div>
			<?php
				}
			?>
			
			<?php
				if(isset($image_url[0]) && !empty($image_url[0]) && $settings['show_image'] == 'yes')
				{
			?>
				<div class="food-menu-img">
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
			<?php
				}
			?>

			<div class="food-menu-content <?php if((isset($image_url[0]) && empty($image_url[0])) OR $settings['show_image'] != 'yes') { ?>no-food-img<?php } ?> <?php if(!empty($menu_highlight)) { ?>menu-highlight<?php } ?>">
				
				<div class="food-menu-content-top-holder">
					<div class="food-menu-content-title-holder">
						<h3 class="food-menu-title">
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
					</div>
					
					<div class="food-menu-content-title-line"></div>
					
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
				</div>
				
				<div class="food-menu-desc"><?php echo $slide->post_excerpt; ?></div>
				
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
<?php
			$count++;
		}
?>
</div>
<?php
	}
?>
</div>