<?php
// Change page title for Shop Archive page
add_filter( 'wp_title', 'title_for_shop' );
function title_for_shop( $title )
{
  if ( is_shop() ) {
    return __( 'Delivery Store', 'grandrestaurant' );
  }
  return $title;
}

//Change number of products per page
add_filter( 'loop_shop_per_page', 'tg_shop_per_page', 20 );
function tg_shop_per_page()
{
	$tg_shop_items = get_theme_mod('tg_shop_items', 16);
	return $tg_shop_items;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'tg_loop_columns');
if (!function_exists('tg_loop_columns')) {
	function tg_loop_columns() {
		//Get Shop columns Settting
		$tg_shop_columns = get_theme_mod('tg_shop_columns', 3);
		if(empty($tg_shop_columns))
		{
			$tg_shop_columns = 3;
		}
		
		return $tg_shop_columns; // products per row
	}
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
add_filter( 'woocommerce_output_related_products_args', 'tg_related_products_args' );

function tg_related_products_args( $args ) 
{
  	//Check if display related products
	$tg_shop_related_products = get_theme_mod('tg_shop_related_products', 1);
	
	if(!empty($tg_shop_related_products))
	{
		$args['posts_per_page'] = 3; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
	}
	else
	{
		$args['posts_per_page'] = 0;
	}
	
	return $args;
}

//Check if display fly-out mini cart
$grandrestaurant_mini_cart = get_theme_mod('tg_mini_cart', 1);

if(!empty($grandrestaurant_mini_cart))
{
	function grandrestaurant_update_mini_cart() {
	  echo get_template_part("/templates/template-mini-cart");
	  die();
	}
	add_filter( 'wp_ajax_nopriv_grandrestaurant_update_mini_cart', 'grandrestaurant_update_mini_cart' );
	add_filter( 'wp_ajax_grandrestaurant_update_mini_cart', 'grandrestaurant_update_mini_cart' );
	
	function grandrestaurant_ajax_add_to_cart_js() {
		wp_enqueue_script('grandrestaurant_mini_cart-ajax-add-to-cart', get_template_directory_uri() . '/js/ajax-add-to-cart.js', array('jquery'), '', true);
	}
	
	add_action('wp_enqueue_scripts', 'grandrestaurant_ajax_add_to_cart_js', 99);add_action('wp_enqueue_scripts', 'grandrestaurant_ajax_add_to_cart_js', 99);
	
	
	add_action('wp_footer', 'grandrestaurant_single_added_to_cart_event');
	function grandrestaurant_single_added_to_cart_event()
	{
		//If add to cart with POST data
		if( isset($_POST['add-to-cart']) && isset($_POST['quantity']) ) {
			// Get added to cart product ID (or variation ID) and quantity (if needed)
			$quantity   = $_POST['quantity'];
			$product_id = isset($_POST['variation_id']) ? $_POST['variation_id'] : $_POST['add-to-cart'];
		}
		
		if( isset($_GET['product_added_to_cart']) && isset($_GET['quantity']) ) {
			// Get added to cart product ID (or variation ID) and quantity (if needed)
			$quantity   = $_GET['quantity'];
			$product_id = isset($_GET['variation_id']) ? $_GET['variation_id'] : $_GET['product_added_to_cart'];
		}
		
		if( !empty($quantity) && !empty($product_id) ) {
			// JS code goes here below
			?>
			<script>
			jQuery(document).ready(function(){ 
				if(jQuery('#woocommerce-mini-cart-wrapper').length) {
					jQuery('#woocommerce-mini-cart-wrapper').addClass('visible');
				 
					jQuery('#woocommerce-mini-cart-overlay').on( 'click', function(){
					   jQuery('#woocommerce-mini-cart-wrapper').removeClass('visible');
					   jQuery('#go-to-top').css('opacity', 1);
					});
				}
			});
			</script>
			<?php
		}
	}
	
	function grandrestaurant_remove_added_to_cart_notice()
	{
		$notices = WC()->session->get('wc_notices', array());
		$added_to_cart_key = '';
	
		if(is_array($notices) && !empty($notices)) {
			foreach( $notices['success'] as $key => $notice){
				if( strpos( $notice['notice'], 'has been added' ) !== false){
					$added_to_cart_key = $key;
					break;
				}
			}
			unset( $notices['success'][$added_to_cart_key] );
		
			WC()->session->set('wc_notices', $notices);
		}
	}
	add_action('woocommerce_before_single_product','grandrestaurant_remove_added_to_cart_notice',1);
	add_action('woocommerce_shortcode_before_product_cat_loop','grandrestaurant_remove_added_to_cart_notice',1);
	add_action('woocommerce_before_shop_loop','grandrestaurant_remove_added_to_cart_notice',1);
}
?>