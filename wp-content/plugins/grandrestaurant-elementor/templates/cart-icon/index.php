<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
?>
<div class="grandrestaurant-cart-icon">
	<?php
		if(class_exists('Woocommerce')) {
			global $woocommerce;
			$cart_url = wc_get_cart_url();
			
			if(is_object($woocommerce->cart)) {
				$cart_counter = $woocommerce->cart->cart_contents_count;
			}
			else 
			{
				$cart_counter = 0;
			}
?>
		<div class="grandrestaurant-cart-wrapper">
			<a href="<?php echo esc_url($cart_url); ?>" title="<?php esc_attr_e('View Cart', 'grandrestaurant-elementor' ); ?>">
				<div class="grandrestaurant-cart-counter"><?php echo esc_html($cart_counter); ?></div>
				<img class="grandrestaurant-cart-icon-image" src="<?php echo esc_url($settings['cart_icon']['url']) ?>" alt="<?php esc_attr_e('View Cart', 'grandrestaurant-elementor' ); ?>" />
			</a>
		</div>
	<?php
		}
		else
		{
			echo __( 'Please install and activate WooCommerce plugin to use this widget', 'grandrestaurant-elementor' );
		}
	?>
</div>