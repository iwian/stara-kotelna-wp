jQuery(document).ready(function(){ 
	"use strict";
	
	//Woocommerce mini cart support
	if(jQuery('#woocommerce-mini-cart-wrapper').length) {
		jQuery('body').on('added_to_cart removed_from_cart',function(e,data) {
			jQuery('#go-to-top').css('opacity', 0);
			
			var data = {
			   'action': 'grandrestaurant_update_mini_cart'
			 };
			 jQuery.post(
			   tgAjax.ajaxurl, 
			   data, 
			   function(response){
				 jQuery('.single_add_to_cart_button').removeClass('loading');
				 jQuery('#woocommerce-mini-cart-wrapper').html(response);
				 
				 setTimeout(function () { jQuery('#woocommerce-mini-cart-wrapper').addClass('visible'); }, 10);
				 
				 jQuery('#woocommerce-mini-cart-overlay').on( 'click', function(){
					jQuery('#woocommerce-mini-cart-wrapper').removeClass('visible');
					jQuery('#go-to-top').css('opacity', 1);
				 });
			   }
			 );
		});
		
	}
});