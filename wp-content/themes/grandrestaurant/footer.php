<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>

<?php
	//Check if blank template
	global $is_no_header;
	
	if(!is_bool($is_no_header) OR !$is_no_header)
	{

	global $pp_homepage_style;
	
	//Check footer contents options
	$grandrestaurant_footer_content = get_theme_mod('grandrestaurant_footer_content', 'sidebar');
	$grandrestaurant_page_hide_footer_default = 0;
	
	if(is_page())
	{
		//Check if hide footer
		$grandrestaurant_page_hide_footer_default = get_post_meta($post->ID, 'page_hide_footer', false);
	}
	
	// This is a 404 not found page
	if( is_404() ) {
		$tg_pages_template_404 = get_theme_mod('tg_pages_template_404');
		if(!empty($tg_pages_template_404)) {
			$grandrestaurant_page_hide_footer_default = get_post_meta($tg_pages_template_404, 'page_hide_footer', false);
		}
	}
	
	//If not hide footer
	if(empty($grandrestaurant_page_hide_footer_default))
	{
		//if using footer post content
		if($grandrestaurant_footer_content == 'content')
		{
?>
		<div id="footer-wrapper">
			<?php
				// This is a 404 not found page
				if( is_404() ) {
					$tg_pages_template_404 = get_theme_mod('tg_pages_template_404');
					if(!empty($tg_pages_template_404)) {
						$grandrestaurant_footer_content_default = get_post_meta($tg_pages_template_404, 'page_footer', true);
					}
				}
			
				//Display Elementor footer contents
				if(is_page())
				{
					$grandrestaurant_footer_content_default = get_post_meta($post->ID, 'page_footer', true);
					
					if(empty($grandrestaurant_footer_content_default))
					{
						$grandrestaurant_footer_content_default = get_theme_mod('grandrestaurant_footer_content_default');
					}
				}
				else
				{
					$grandrestaurant_footer_content_default = get_theme_mod('grandrestaurant_footer_content_default');
				}
				
				//Add Polylang plugin support
				if (function_exists('pll_get_post')) {
					$grandrestaurant_footer_content_default = pll_get_post($grandrestaurant_footer_content_default);
				}
				
				//Add WPML plugin support
				if (function_exists('icl_object_id')) {
					$grandrestaurant_footer_content_default = icl_object_id($grandrestaurant_footer_content_default, 'page', false, ICL_LANGUAGE_CODE);
				}
			
				if(!empty($grandrestaurant_footer_content_default) && class_exists("\\Elementor\\Plugin"))
				{
					echo grandrestaurant_get_elementor_content($grandrestaurant_footer_content_default);
				}	
			?>
		</div>
<?php
		}
		//if use footer sidebar as content
		else if($grandrestaurant_footer_content == 'sidebar')
		{
?>
<div class="footer_bar <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo esc_attr($pp_homepage_style); } ?>">
	<?php
		//Get footer logo and text
		$tg_retina_footer_logo = get_theme_mod('tg_retina_footer_logo', '');
		
		if(!empty($tg_retina_footer_logo))
		{
			//Get image width and height
	    	$image_id = pp_get_image_id($tg_retina_footer_logo);
	    	$obj_image = wp_get_attachment_image_src($image_id, 'original');
	    	$image_width = 0;
	    	$image_height = 0;
	    	
	    	if(isset($obj_image[1]))
	    	{
	    		$image_width = $obj_image[1];
	    	}
	    	if(isset($obj_image[2]))
	    	{
	    		$image_height = $obj_image[2];
	    	}
	?>
		<div class="footer_before_widget">
			<a href="<?php echo home_url(); ?>" class="logo_wrapper footer_logo">
				<?php
					if($image_width > 0 && $image_height > 0)
					{
				?>
				<img src="<?php echo esc_url($tg_retina_footer_logo); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
				<?php
					}
					else
					{
				?>
	    	    <img src="<?php echo esc_url($tg_retina_footer_logo); ?>" alt="<?php bloginfo('name'); ?>"/>
	    	    <?php 
	    	    	}
	    	    ?>
	    	</a>
		</div>
	<?php
		}
	?>
	
	<?php
	    //Display footer text
	    $tg_footer_text = get_theme_mod('tg_footer_text', '');
	?>
	<div id="footer_before_widget_text"><?php echo wp_kses_post(do_shortcode(htmlspecialchars_decode($tg_footer_text))); ?></div>

	<?php
		//Get Footer Sidebar
	    $tg_footer_sidebar = get_theme_mod('tg_footer_sidebar', 4);
	
	    if(!empty($tg_footer_sidebar))
	    {
	    	$footer_class = '';
	    	
	    	switch($tg_footer_sidebar)
	    	{
	    		case 1:
	    			$footer_class = 'one';
	    		break;
	    		case 2:
	    			$footer_class = 'two';
	    		break;
	    		case 3:
	    			$footer_class = 'three';
	    		break;
	    		case 4:
	    			$footer_class = 'four';
	    		break;
	    		default:
	    			$footer_class = 'four';
	    		break;
	    	}
	    	
	    	global $pp_homepage_style;
	?>
	<div id="footer" class="<?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo esc_attr($pp_homepage_style); } ?>">
	<ul class="sidebar_widget <?php echo esc_attr($footer_class); ?>">
	    <?php dynamic_sidebar('Footer Sidebar'); ?>
	</ul>
	</div>
	<br class="clear"/>
	<?php
	    }
	?>

	<div class="footer_bar_wrapper <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo esc_attr($pp_homepage_style); } ?>">
		<?php
			//Check if display social icons or footer menu
			$tg_footer_copyright_right_area = get_theme_mod('tg_footer_copyright_right_area', 'menu');
			
			if($tg_footer_copyright_right_area=='social')
			{
				if($pp_homepage_style!='flow' && $pp_homepage_style!='fullscreen' && $pp_homepage_style!='carousel' && $pp_homepage_style!='flip' && $pp_homepage_style!='fullscreen_video')
				{	
					//Check if open link in new window
					$tg_footer_social_link = get_theme_mod('tg_footer_social_link', 1);
			?>
			<div class="social_wrapper">
			    <ul>
			    	<?php
			    		$pp_facebook_url = get_option('pp_facebook_url');
			    		
			    		if(!empty($pp_facebook_url))
			    		{
			    	?>
			    	<li class="facebook"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> href="<?php echo esc_url($pp_facebook_url); ?>"><i class="fa fa-facebook"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_twitter_username = get_option('pp_twitter_username');
			    		
			    		if(!empty($pp_twitter_username))
			    		{
			    	?>
			    	<li class="twitter"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> href="https://twitter.com/<?php echo esc_attr($pp_twitter_username); ?>"><i class="fa fa-twitter"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_flickr_username = get_option('pp_flickr_username');
			    		
			    		if(!empty($pp_flickr_username))
			    		{
			    	?>
			    	<li class="flickr"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Flickr" href="https://flickr.com/people/<?php echo esc_attr($pp_flickr_username); ?>"><i class="fa fa-flickr"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_youtube_url = get_option('pp_youtube_url');
			    		
			    		if(!empty($pp_youtube_url))
			    		{
			    	?>
			    	<li class="youtube"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Youtube" href="https://youtube.com/channel/<?php echo esc_attr($pp_youtube_url); ?>"><i class="fa fa-youtube"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_vimeo_username = get_option('pp_vimeo_username');
			    		
			    		if(!empty($pp_vimeo_username))
			    		{
			    	?>
			    	<li class="vimeo"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Vimeo" href="https://vimeo.com/<?php echo esc_attr($pp_vimeo_username); ?>"><i class="fa fa-vimeo-square"></i></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_tumblr_username = get_option('pp_tumblr_username');
			    		
			    		if(!empty($pp_tumblr_username))
			    		{
			    	?>
			    	<li class="tumblr"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Tumblr" href="https://<?php echo esc_attr($pp_tumblr_username); ?>.tumblr.com"><i class="fa fa-tumblr"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_dribbble_username = get_option('pp_dribbble_username');
			    		
			    		if(!empty($pp_dribbble_username))
			    		{
			    	?>
			    	<li class="dribbble"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Dribbble" href="https://dribbble.com/<?php echo esc_attr($pp_dribbble_username); ?>"><i class="fa fa-dribbble"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_linkedin_url = get_option('pp_linkedin_url');
			    		
			    		if(!empty($pp_linkedin_url))
			    		{
			    	?>
			    	<li class="linkedin"><a <?php if(!empty($tg_topbar_social_link)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo esc_url($pp_linkedin_url); ?>"><i class="fa fa-linkedin"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			            $pp_pinterest_username = get_option('pp_pinterest_username');
			            
			            if(!empty($pp_pinterest_username))
			            {
			        ?>
			        <li class="pinterest"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Pinterest" href="https://pinterest.com/<?php echo esc_attr($pp_pinterest_username); ?>"><i class="fa fa-pinterest"></i></a></li>
			        <?php
			            }
			        ?>
			        <?php
			        	$pp_instagram_username = get_option('pp_instagram_username');
			        	
			        	if(!empty($pp_instagram_username))
			        	{
			        ?>
			        <li class="instagram"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Instagram" href="https://instagram.com/<?php echo esc_attr($pp_instagram_username); ?>"><i class="fa fa-instagram"></i></a></li>
			        <?php
			        	}
			        ?>
			        <?php
					    $pp_behance_username = get_option('pp_behance_username');
					    
					    if(!empty($pp_behance_username))
					    {
					?>
					<li class="behance"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Behance" href="https://behance.net/<?php echo esc_attr($pp_behance_username); ?>"><i class="fa fa-behance-square"></i></a></li>
					<?php
					    }
					?>
					<?php
					    $pp_tripadvisor_url = get_option('pp_tripadvisor_url');
					    
					    if(!empty($pp_tripadvisor_url))
					    {
					?>
					<li class="tripadvisor"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Tripadvisor" href="<?php echo $pp_tripadvisor_url; ?>"><i class="fa fa-tripadvisor"></i></a></li>
					<?php
					    }
					?>
					
					<?php
					    $pp_yelp_url = get_option('pp_yelp_url');
					    
					    if(!empty($pp_yelp_url))
					    {
					?>
					<li class="yelp"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Yelp" href="<?php echo $pp_yelp_url; ?>"><i class="fa fa-yelp"></i></a></li>
					<?php
					    }
					?>
			    </ul>
			</div>
		<?php
				}
			} //End if display social icons
			else
			{
				if ( has_nav_menu( 'footer-menu' ) ) 
			    {
				    wp_nav_menu( 
				        	array( 
				        		'menu_id'			=> 'footer_menu',
				        		'menu_class'		=> 'footer_nav',
				        		'theme_location' 	=> 'footer-menu',
				        	) 
				    ); 
				}
			}
		?>
	    <?php
	    	//Display copyright text
	        $tg_footer_copyright_text = get_theme_mod('tg_footer_copyright_text');

	        if(!empty($tg_footer_copyright_text))
	        {
	        	echo '<div id="copyright">'.wp_kses_post(htmlspecialchars_decode($tg_footer_copyright_text)).'</div><br class="clear"/>';
	        }
	    ?>
	</div>
	<?php
		}//End if displays footer sidebar
	?>
</div>
	<?php
		} //End if hide footer	
	?>
	
	<?php
		//Check if display fly-out mini cart
		$tg_mini_cart = get_theme_mod('tg_mini_cart', 1);
		
		if(!empty($tg_mini_cart) && class_exists('WooCommerce'))
		{
	?>
	<div id="woocommerce-mini-cart-wrapper">
		<?php
			//Display when in single product
			get_template_part("/templates/template-mini-cart");
		?>
	</div>
	<?php
		}
	?>
</div>

<?php
} //End if not blank template
?>

<?php
 	//Check if display to top button
 	$tg_footer_copyright_totop = get_theme_mod('tg_footer_copyright_totop', 1);
 	
 	if(!empty($tg_footer_copyright_totop))
 	{
?>
 		<a id="toTop"><i class="fa fa-angle-up"></i></a>
<?php
 	}
?>
<div id="overlay_background"></div>

<?php
	//Include reservation popup template
	get_template_part("/templates/template-reservation");	

	//Display fullscreen menu
	$grandrestaurant_fullmenu_default = get_theme_mod('tg_fullmenu_default');
	
	if(!empty($grandrestaurant_fullmenu_default))
	{
		//Add Polylang plugin support
		if (function_exists('pll_get_post')) {
			$grandrestaurant_fullmenu_default = pll_get_post($grandrestaurant_fullmenu_default);
		}
			
		//Add WPML plugin support
		if (function_exists('icl_object_id')) {
			$grandrestaurant_fullmenu_default = icl_object_id($grandrestaurant_fullmenu_default, 'page', false, ICL_LANGUAGE_CODE);
		}
			
		if(!empty($grandrestaurant_fullmenu_default) && class_exists("\\Elementor\\Plugin"))
		{
?>
	<div id="fullmenu-wrapper-<?php echo esc_attr($grandrestaurant_fullmenu_default); ?>" class="fullmenu-wrapper">
<?php
		echo grandrestaurant_get_elementor_content($grandrestaurant_fullmenu_default);
?>
	</div>
<?php
		}
	}
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
