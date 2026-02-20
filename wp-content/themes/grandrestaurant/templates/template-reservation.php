<?php
	$pp_reservation_email = get_option('pp_reservation_email');
	
	//Reservation Form 		
	if(!empty($pp_reservation_email))
	{   
		wp_enqueue_style("jquery.timepicker", get_template_directory_uri()."/functions/jquery.timepicker.css", false, "1.0", "all");
		
		//wp_enqueue_script("jquery-ui-datepicker");
		//wp_enqueue_style("datepicker", get_template_directory_uri()."/css/datepicker.css", false, "1.0", "all");
		//wp_enqueue_script('custom-date', get_template_directory_uri()."/js/custom-date.js", false, THEMEVERSION, true);
		wp_enqueue_script("jquery.timepicker", get_template_directory_uri()."/functions/jquery.timepicker.js", false);
		wp_enqueue_script('custom-time', get_template_directory_uri()."/js/custom-time.js", false, THEMEVERSION, true);
	    wp_enqueue_script("jquery.validate", get_template_directory_uri()."/js/jquery.validate.js", false, THEMEVERSION, true);	
		wp_register_script("script-reservation-form", get_template_directory_uri()."/templates/script-reservation-form.php", false, THEMEVERSION, true);
		$params = array(
		  'ajaxurl' => admin_url('admin-ajax.php'),
		  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
		);
		wp_localize_script( 'script-reservation-form', 'tgAjax', $params );
		wp_enqueue_script("script-reservation-form", get_template_directory_uri()."/templates/script-reservation-form.php", false, THEMEVERSION, true);
?>
<div id="reservation_wrapper">
	<div class="reservation_content">
		<div class="reservation_form">
			<div class="reservation_form_wrapper">
				<a id="reservation_cancel_btn" href="javascript:;"><span class="ti-close"></span></a>
			
				<h2 class="ppb_title"><?php echo tg_get_first_title_word(__( "Table Booking", 'grandrestaurant' )); ?></h2>
				<div id="reponse_msg"><ul></ul></div>
				
				<form id="tg_reservation_form" method="post">
			    	<input type="hidden" id="action" name="action" value="tg_reservation_mailer"/>
			    	
			    	<div class="one_third">
				    	<label for="your_name"><?php echo _e( 'Name*', 'grandrestaurant' ); ?></label>
						<input id="your_name" name="your_name" type="text" class="required_field"/>
			    	</div>
			    	
			    	<div class="one_third">
				    	<label for="email"><?php echo _e( 'Email*', 'grandrestaurant' ); ?></label>
						<input id="email" name="email" type="text" class="email required_field"/>
			    	</div>
					
					<div class="one_third last">
						<label for="phone"><?php echo _e( 'Phone*', 'grandrestaurant' ); ?></label>
						<input id="phone" name="phone" type="text" class="required_field"/>
					</div>
					
					<br class="clear"/><br/>
					
					<div class="one_third">
						<label for="date" class="hidden"><?php echo _e( 'Date*', 'grandrestaurant' ); ?></label>
						<input type="date" class="pp_date required_field" id="date" name="date" value="<?php echo date('m/d/Y'); ?>">
					</div>
					
					<div class="one_third">
						<label for="time"><?php echo _e( 'Time*', 'grandrestaurant' ); ?></label>
						<input type="text" class="pp_time required_field" id="time" name="time" value=""/>
					</div>
					
					<div class="one_third last">
						<label for="seats"><?php echo _e( 'Seats*', 'grandrestaurant' ); ?></label>
				        <select id="seats" name="seats" class="required_field" style="width:99%">
				        	<?php
				        		for ($i = 1; $i < 21 ; $i++) {
				        			$option_title = $i;
				        			if($i==1)
				        			{
					        			$option_title.=  ' '.__( 'person', 'grandrestaurant' );
				        			}
				        			elseif($i<20)
				        			{
					        			$option_title.=  ' '.__( 'people', 'grandrestaurant' );
				        			}
				        			else
				        			{
					        			$option_title.=  '+ '.__( 'people', 'grandrestaurant' );
				        			}
				        	?>
				        		<option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($option_title); ?></option>
				        	<?php
				        		}
				        	?>
				        </select>
					</div>
					
					<br class="clear"/><br/>
					
					<div class="one">
						<label for="message"><?php echo _e( 'Special Requests', 'grandrestaurant' ); ?></label>
					    <textarea id="message" name="message" rows="7" cols="10"></textarea>
					</div>
					
					<?php
						$pp_contact_enable_gdpr = get_option('pp_contact_enable_gdpr');
    
					    if(!empty($pp_contact_enable_gdpr))
					    {	
					?>
					<br class="clear"/><br/><input id="gdpr" name="gdpr" type="checkbox" class="required_field gdpr" value=""/>
					<label for="gdpr" class="gdpr_label"><?php echo esc_html__('I consent to ', 'grandrestaurant' ); ?> <?php echo get_bloginfo('name'); ?> <?php echo esc_html__(' collecting my details through this form.', 'grandrestaurant' ); ?></label>
					<?php
						}
					?>
					
					<br class="clear"/><br/>
				    
				    <div class="one">
					    <p>
		    				<input id="reservation_submit_btn" type="submit" value="<?php echo _e( 'Book Now', 'grandrestaurant' ); ?>"/>
					    </p>
				    </div>
				    
				    <br class="clear"/>
				</form>
			</div>
		</div>
	</div>
	<div class="parallax_overlay_header"></div>
</div>
<?php
	}
?>