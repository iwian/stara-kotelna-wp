<?php
//grandrestaurant_themegoods_action();
$is_verified_envato_purchase_code = false;

//Get verified purchase code data
$is_verified_envato_purchase_code = grandrestaurant_is_registered();

//Begin Create customizer styling import options
$customizer_styling_arr = array( 
	array('id'	=>	'demo1', 'title' => 'Demo 1', 'demo' => 1),
	array('id'	=>	'demo2', 'title' => 'Demo 2', 'demo' => 2),
	array('id'	=>	'demo3', 'title' => 'Demo 3', 'demo' => 3),
	array('id'	=>	'demo4', 'title' => 'Demo 4', 'demo' => 4),
	array('id'	=>	'demo5', 'title' => 'Demo 5', 'demo' => 5),
	array('id'	=>	'demo6', 'title' => 'Demo 6', 'demo' => 6),
	array('id'	=>	'demo7', 'title' => 'Demo 7', 'demo' => 7),
);

$customizer_styling_html = '';

//if verified envato purchase code
if($is_verified_envato_purchase_code)
{
	$customizer_styling_html.= '
		<div class="tg_notice">
			<span class="dashicons dashicons-warning"></span>
			Activating demo styling will replace all current theme customizer options.
		</div><br style="clear:both;"/>
		<ul id="get_styling_content" class="demo_list">';
	
	foreach($customizer_styling_arr as $key => $customizer_styling)
	{
		$last_class = '';
		if(($key+1)%3 == 0)
		{
			$last_class = 'last';
		}
		
		$demo_url = 'https://themes.themegoods.com/grandrestaurant/demo'.$customizer_styling['demo'].'/';
		
		$customizer_styling_html.= '<li class="'.$last_class.'" data-styling="'.$customizer_styling['demo'].'">
			    	<div class="item_content_wrapper">
			    		<div class="item_content">
			    			<div class="item_thumb">
			    				<a class="preview_wrapper" href="'.esc_url($demo_url).'" target="_blank">Preview</a>
			    				<img src="'.get_template_directory_uri().'/cache/demos/xml/demo'.$customizer_styling['demo'].'/'.$customizer_styling['demo'].'.jpg" alt=""/></div>
			    			<div class="item_content">
			    				<div class="title"><strong>'.$customizer_styling['title'].'</strong></div>
						    	<div class="import">
							    	<input data-styling="'.$customizer_styling['demo'].'" type="button" value="Activate" class="pp_get_styling_button button-primary"/>
							    </div>
						    </div>
					    </div>
				    </div>
			    </li>';
	}
	
	$customizer_styling_html.= '</ul>
	<div class="styling_message"><div class="import_message_success"><span class="tg_loading dashicons dashicons-update"></span>Data is being imported please be patient, don\'t navigate away from this page</div></div>';
}
else
{
	$customizer_styling_html.= '
		<div class="tg_notice">
			<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
			<span style="color:#FF3B30">'.THEMENAME.' Demos can only be imported with a valid purchase code</span><br/><br/>
			Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to import the full '.THEMENAME.' demos and single pages through Content Builder.
		</div>';
}
//End Create customizer styling import options

/*
	Begin creating admin options
*/

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$getting_started_html = '<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("themes.php?page=install-required-plugins").'">
				<div class="step_number">Step <div class="int_number">1</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Install the recommended plugins</h3>
			Theme has required and recommended plugins in order to build your website using layouts you saw on our demo site. We recommend you to install recommended plugins.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="javascript:;" onclick="jQuery(\'#pp_panel_demo-content_a\').trigger(\'click\');">
				<div class="step_number">Step <div class="int_number">2</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Import the demo data</h3>
			Here you can import the demo data to your site. Doing this will make your site look like the demo site. It helps you to understand better the theme and build something similar to our demo quicker.
		</div>
	</div>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("customize.php").'">
				<div class="step_number">Step <div class="int_number">3</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Customize theme elements and options</h3>
			Start customize theme\'s layouts, typography, elements colors using WordPress customize and see your changes in live preview instantly.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="'.admin_url("post-new.php?post_type=page").'">
				<div class="step_number">Step <div class="int_number">4</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Create pages, galleries and food menus</h3>
			'.THEMENAME.' support standard WordPress <a href="'.admin_url("post-new.php?post_type=page").'">page option</a>. Theme also has <a href="'.admin_url("post-new.php?post_type=galleries").'">gallery</a> and <a href="'.admin_url("post-new.php?post_type=menus").'">food menus</a> options. You can use theme content builder to create and organise page contents.
		</div>
	</div>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="'.admin_url("nav-menus.php").'">
				<div class="step_number">Step <div class="int_number">5</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Setting up navigation menu</h3>
			Once you imported demo or created your own pages. You can setup navigation menu and assign to your website main header or any other places.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="'.admin_url("options-permalink.php").'">
				<div class="step_number">Step <div class="int_number">6</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Permalinks structure</h3>
			You can change your website permalink structure to better SEO result. Click here to setup WordPress permalink options.
		</div>
	</div>';

$getting_started_html.='<br style="clear:both;"/>
	<h1>View Changelog</h1>
	<div class="getting_started_desc">We are always keep adding new features to our theme. This is why we highly recommend to stay up to date with each new theme version and all required plugins. You can view all <a href="https://themes.themegoods.com/grandrestaurant/doc/theme-changelog/" target="_blank">theme changelog</a> here</div>
	<br style="clear:both;"/>
	
	<div style="height:30px"></div>
	';
	
$tutorial_html = '';	
	
	if(!empty($is_verified_envato_purchase_code))
	{
		$tutorial_html = '
			<div class="one_third">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/ior5XoZa2wc?si=DokOE92ODfTdFfoi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to create website header</div>
			</div>
			
			<div class="one_third">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/Or9lfbEM69o?si=ArcLkEJeLIgQalPe" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to change website logo image from demo header</div>
			</div>
			
			<div class="one_third last">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/mEqc3F3CN20?si=r-J3yH2SxjweHjqx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to create a mobile menu</div>
			</div>
			
			<div class="one_third">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/-hQm1bkxATs?si=EeL30Wd6gUYfvjgI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to create a fullscreen menu</div>
			</div>
			
			<div class="one_third">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/OBKrgNTMots?si=7Din_6SKam9j4V4Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to create website footer</div>
			</div>
			
			<div class="one_third last">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/GqvgKk8pPRs?si=hINjvNHp4S7O3MKz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to set different header for specific page</div>
			</div>
			
			<div class="one_third">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/yRIjpaafHmM?si=nfPrx81ZRK9_P-ac" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to set basic table booking using appointment booking plugin</div>
			</div>
			
			<div class="one_third">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/lTQMOvvQ6h8?si=pThEQCFnyS-BiAoq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to set default reservation popup</div>
			</div>
			
			<div class="one_third last">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/LKNJtPMecm8?si=6HtUEBp2XLTMTYX8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
				<div class="themegoods-video-title">How to translate theme strings</div>
			</div>
		';
	}
	else
	{
		$tutorial_html = '
		<div class="tg_notice">
						<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
						<span style="color:#FF3B30">'.THEMENAME.' theme tutorials can only be activated with a valid purchase code</span><br/><br/>
						Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to activate this section.
					</div>
			';
	}

$support_html = '';	
if($is_verified_envato_purchase_code)
{
	
	$support_html.='
	<div class="one_half nomargin">
		<div class="step_icon">
			<a href="https://themegoods.ticksy.com/submit/" target="_blank">
				<span class="dashicons dashicons-testimonial"></span>
				<div class="step_title">Submit a Ticket</div>
			</a>
		</div>
		<div class="step_info">
			<h3>Theme support</h3>
			We offer excellent support through our ticket system. Please make sure you prepare your purchased code first to access our services.
		</div>
	</div>
	
	<div class="one_half last nomargin">
		<div class="step_icon">
			<a href="https://themes.themegoods.com/grandrestaurant/doc" target="_blank">
				<span class="dashicons dashicons-book-alt"></span>
				<div class="step_title">Theme Document</div>
			</a>
		</div>
		<div class="step_info">
			<h3>Online documentation</h3>
			This is the place to go find all reference aspects of theme functionalities. Our online documentation is resource for you to start using theme.
		</div>
	</div>
';
}
else
{
	$support_html = '
	<div class="tg_notice">
					<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
					<span style="color:#FF3B30">'.THEMENAME.' theme support can only be activated with a valid purchase code</span><br/><br/>
					Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to activate this section.
				</div>
		';
}

//Get product registration

//if verified envato purchase code
$check_icon = '';
$verification_desc = 'Thank you for choosing '.THEMENAME.'. Your product must be registered to receive many advantage features ex. demos import and support. We are sorry about this extra step but we built the activation system to prevent mass piracy of our themes. This will help us to better serve our paying customers.';

//Check if have any purchase code verification error
$response_html = '';
$purchase_code = '';
$register_button_html = '<input type="submit" name="submit" id="themegoods-envato-code-submit" class="button button-primary button-large" value="Register"/>';

//If already registered
if(!empty($is_verified_envato_purchase_code))
{
	$response_html.= '<br style="clear:both;"/><div class="tg_valid"><span class="dashicons dashicons-yes"></span>Your product is registered.</div>';
	$register_button_html = '<input type="submit" name="submit" id="themegoods-envato-code-unregister" class="button button-primary button-large" value="Unregister"/>';
	$purchase_code = $is_verified_envato_purchase_code;
}

//Displays purchase code verification response
if(isset($_GET['response']) && !empty($_GET['response'])) {
	$response_arr = json_decode(stripcslashes($_GET['response']));
	$purchase_code = '';
	if(isset($_GET['purchase_code']) && !empty($_GET['purchase_code'])) {
		$purchase_code = $_GET['purchase_code'];
	}
	
	if(isset($response_arr->response_code)) {
		if(!$response_arr->response_code) {
			$response_html.= '<br style="clear:both;"/><div class="tg_error"><span class="dashicons dashicons-warning"></span>'.esc_html($response_arr->response).'</div>';
		}
	}
	else {
		$response_html.= '<br style="clear:both;"/><div class="tg_error"><span class="dashicons dashicons-warning"></span> We can\'t verify your purchase of '.THEMENAME.' theme. Please make sure you enter correct purchase code. If you are sure you enter correct one. <a href="https://themegoods.ticksy.com" target="_blank">Please open a ticket</a> to us so our support staff can help you. Thank you very much.</div>';
	}
}

$product_registration_html ='
		<h1>Product Registration</h1>
		<div class="getting_started_desc">'.$verification_desc.'</div>
		<br style="clear:both;"/>
		
		<div style="height:10px"></div>
		
		<label for="pp_envato_personal_token">'.$check_icon.'Purchase Code</label>
		<small class="description">Please enter your Purchase Code.</small>';
$product_registration_html.= $register_button_html;

$purchase_code_input_class = '';
if(!empty($is_verified_envato_purchase_code)) {
	$purchase_code_input_class = 'themegoods-verified';
}

$product_registration_html.= '<input name="pp_envato_personal_token" id="pp_envato_personal_token" type="text" value="'.esc_attr($purchase_code).'" class="'.esc_attr($purchase_code_input_class).'"/>
		<input name="themegoods-site-domain" id="themegoods-site-domain" type="hidden" value="'.esc_attr(grandrestaurant_get_site_domain()).'"/>
	';
	
	$product_registration_html.= $response_html;
	
if(isset($_GET['action']) && $_GET['action'] == 'invalid-purchase')
{
	$product_registration_html.='<br style="clear:both;"/><div style="height:20px"></div><div class="tg_error"><span class="dashicons dashicons-warning"></span> We can\'t find your purchase of '.THEMENAME.' theme. Please make sure you enter correct purchase code. If you are sure you enter correct one. <a href="https://themegoods.ticksy.com" target="_blank">Please open a ticket</a> to us so our support staff can help you. Thank you very much.</div>
	
	<br style="clear:both;"/>
	
	<div style="height:10px"></div>';
}

$is_purchase_code_removed = get_option("envato_purchase_code_".ENVATOITEMID."_removed");
   
if($is_purchase_code_removed && empty($is_verified_envato_purchase_code)) {
	$product_registration_html.='<br style="clear:both;"/><div style="height:20px"></div><div class="tg_error"><span class="dashicons dashicons-warning"></span>Your purchase code was unregistered because the registered domain and this website domain are different. In case you want to remove/change registered domain. Please register your account <a href="https://license.themegoods.com/manager/" target="_blank">here</a>
	Then you will be able to manage/remove your purchase code registration\'s domain from there. <br/><br/>If you think the unregistration wasn\'t done correctly. Please <a href="https://themegoods.ticksy.com/submit/" target="_blank">open a ticket</a> or contact us using the contact form on <a href="https://themeforest.net/user/themegoods" target="_blank">this page</a> so we can check it for you. Thank you.</div>';
}

if(!$is_verified_envato_purchase_code)
{
	$product_registration_html.='
	<br style="clear:both;"/>
	<div style="height:30px"></div>
	<h1>How to get Purchase Code</h1>
	<div style="height:5px"></div>
	<ol>
	 <li>You must be logged into the same Envato account that purchased '.THEMENAME.' theme.</li>
	 <li>Hover the mouse over your username at the top right corner of the screen.</li>
							<li>Click "Downloads" from the drop-down menu.</li>
							<li>Find '.THEMENAME.' theme your downloads list</li>
							<li>Click "Download" button and click "License certificate & purchase code" (available as PDF or text file).</li>
	</ol>
	<strong>You can see detailed article and video screencast about "how to find your purchase code" <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">here</a>.</strong>
';
}

//If already registered and add a link to license manager
if(!empty($is_verified_envato_purchase_code))
{
	$product_registration_html.='<br style="clear:both;"/><div style="height:20px"></div>
	<div class="one_third grey_bg">
	<h2>Manage Your License</h2>
	<div class="getting_started_desc half_size">To manage all your purchase code registration domain. Please open an account or login on <a href="https://license.themegoods.com/manager/" target="_blank">ThemeGoods License Manager</a>.
	</div>
	</div>
	';
}

$document_last_class = '';
if($is_verified_envato_purchase_code)
{
	$product_registration_html.='<div class="one_third grey_bg">
	<h2>Auto Update</h2>
	<div class="getting_started_desc half_size">To enable auto update feature. You first must <a href="'.admin_url('themes.php?page=install-required-plugins').'">install Envato Market plugin</a> and enter your Envato account token there.</div>
	</div>
	';
	
	$document_last_class = 'last';
}
else 
{
	$product_registration_html.='<br style="clear:both;"/><div style="height:30px"></div>';
}

$product_registration_html.='<div class="one_third blue_bg '.esc_attr($document_last_class).'">
<h2>Documentation</h2>
<div class="getting_started_desc half_size">It is a great starting point to fix some of the most common issues. <a href="https://docs.themegoods.com/grand-restaurant" target="_blank">Read theme documentation</a>.</div>
</div>
';

$product_registration_html.='<br style="clear:both;"/><div style="height:30px"></div>
<h2 class="sub-header">Frequently Asked Questions</h2>
<ul class="themegoods_faq">
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/my-website-header-footer-and-some-elements-are-missing/" target="_blank">My website header, footer and some elements are missing</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/i-changed-the-logo-image-in-customizer-but-its-not-working-on-the-frontend/" target="_blank">I changed the logo image in customizer but it\'s not working on the frontend</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/header-footer-and-other-custom-post-types-cant-edit-using-elementor/" target="_blank">Header, Footer and other custom post types can\'t edit using Elementor</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/my-changes-within-elementor-pages-post-elements-are-not-working-on-the-frontend/" target="_blank">My changes within Elementor pages/post elements are not working on the frontend</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/imported-demo-websites-menu-items-are-broken/" target="_blank">Imported demo website\'s menu items are broken</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/do-i-need-to-purchase-elementor-pro/" target="_blank">Do I need to purchase Elementor Pro</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/how-to-change-translate-text-within-pages-posts/" target="_blank">How to change/translate text within pages/posts</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/my-page-post-returns-404-not-found/" target="_blank">My page/post returns 404 not found</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/how-to-display-food-prices-in-decimals/" target="_blank">How to display food prices in decimals</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/how-to-order-food-menu-posts/" target="_blank">How to order food menu posts</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/where-is-my-revolution-slider-plugin-purchase-code/" target="_blank">Where is my Revolution Slider plugin purchase code</a></li>
	<li><a href="https://docs.themegoods.com/docs/grand-restaurant/faq/my-website-is-slow/" target="_blank">My website is slow</a></li>
</ul>
';

//Get system info
$has_red_status = false;

//Get memory_limit
$memory_limit = ini_get('memory_limit');
$memory_limit_class = 'tg_valid';
$memory_limit_text = '';
if(intval($memory_limit) < 128)
{
    $memory_limit_class = 'tg_error';
    $has_error = 1;
    $memory_limit_text = '*RECOMMENDED 128M';
    
    $has_red_status = true;
}

$memory_limit_text = '<div class="'.$memory_limit_class.'">'.$memory_limit.' '.$memory_limit_text.'</div>';

//Get post_max_size
$post_max_size = ini_get('post_max_size');
$post_max_size_class = 'tg_valid';
$post_max_size_text = '';
if(intval($post_max_size) < 32)
{
    $post_max_size_class = 'tg_error';
    $has_error = 1;
    $post_max_size_text = '*RECOMMENDED 32M';
    
    $has_red_status = true;
}
$post_max_size_text = '<div class="'.$post_max_size_class.'">'.$post_max_size.' '.$post_max_size_text.'</div>';

//Get max_execution_time
$max_execution_time = ini_get('max_execution_time');
$max_execution_time_class = 'tg_valid';
$max_execution_time_text = '';
if($max_execution_time < 180)
{
    $max_execution_time_class = 'tg_error';
    $has_error = 1;
    $max_execution_time_text = '*RECOMMENDED 180';
    
    $has_red_status = true;
}
$max_execution_time_text = '<div class="'.$max_execution_time_class.'">'.$max_execution_time.' '.$max_execution_time_text.'</div>';

//Get max_input_vars
$max_input_vars = ini_get('max_input_vars');
$max_input_vars_class = 'tg_valid';
$max_input_vars_text = '';
if(intval($max_input_vars) < 2000)
{
    $max_input_vars_class = 'tg_error';
    $has_error = 1;
    $max_input_vars_text = '*RECOMMENDED 2000';
    
    $has_red_status = true;
}
$max_input_vars_text = '<div class="'.$max_input_vars_class.'">'.$max_input_vars.' '.$max_input_vars_text.'</div>';

//Get upload_max_filesize
$upload_max_filesize = ini_get('upload_max_filesize');
$upload_max_filesize_class = 'tg_valid';
$upload_max_filesize_text = '';
if(intval($upload_max_filesize) < 32)
{
    $upload_max_filesize_class = 'tg_error';
    $has_error = 1;
    $upload_max_filesize_text = '*RECOMMENDED 32M';
    
    $has_red_status = true;
}
$upload_max_filesize_text = '<div class="'.$upload_max_filesize_class.'">'.$upload_max_filesize.' '.$upload_max_filesize_text.'</div>';

//Check if has red status for server resource
if($has_red_status) {
	define("DEMO_GENERATE_THUMB", false);
}
else {
	define("DEMO_GENERATE_THUMB", true);
}

//Get GD library version
if(function_exists('gd_info')) {
	$php_gd_arr = gd_info();
}
else {
	$php_gd_arr = array('GD Version' => 'Not Installed');
}

$system_info_html = '';
if(!$is_verified_envato_purchase_code)
{
	$system_info_html = '<div style="height:20px"></div>
	<div class="tg_notice">
					<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
					<span style="color:#FF3B30">'.THEMENAME.' Demos can only be imported with a valid purchase code</span><br/><br/>
					Please visit <a href="javascript:jQuery(\'#pp_panel_registration_a\').trigger(\'click\');">Product Registration page</a> and enter a valid purchase code to import the full '.THEMENAME.' demos and single pages through Elementor.
				</div>
		
		<div style="height:40px"></div>
		';
}
else
{
	$system_info_html = '<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3">Server Environment</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="title">PHP Version:</td>
					<td class="help"><a href="javascript" title="The version of PHP installed on your hosting server." class="tooltipster">[?]</a></td>
					<td class="value">'.phpversion().'</td>
				</tr>
				<tr>
					<td class="title">WP Memory Limit:</td>
					<td class="help"><a href="javascript" title="The maximum amount of memory (RAM) that your site can use at one time." class="tooltipster">[?]</a></td>
					<td class="value">'.$memory_limit_text.'</td>
				</tr>
				<tr>
					<td class="title">PHP Post Max Size:</td>
					<td class="help"><a href="javascript" title="The largest file size that can be contained in one post." class="tooltipster">[?]</a></td>
					<td class="value">'.$post_max_size_text.'</td>
				</tr>
				<tr>
					<td class="title">PHP Time Limit:</td>
					<td class="help"><a href="javascript" title="The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)" class="tooltipster">[?]</a></td>
					<td class="value">'.$max_execution_time_text.'</td>
				</tr>
				<tr>
					<td class="title">PHP Max Input Vars:</td>
					<td class="help"><a href="javascript" title="The maximum number of variables your server can use for a single function to avoid overloads." class="tooltipster">[?]</a></td>
					<td class="value">'.$max_input_vars_text.'</td>
				</tr>
				<tr>
					<td class="title">Max Upload Size:</td>
					<td class="help"><a href="javascript" title="The largest filesize that can be uploaded to your WordPress installation." class="tooltipster">[?]</a></td>
					<td class="value">'.$upload_max_filesize_text.'</td>
				</tr>
				<tr>
					<td class="title">GD Library:</td>
					<td class="help"><a href="javascript" title="This library help resizing images and improve site loading speed" class="tooltipster">[?]</a></td>
					<td class="value">'.$php_gd_arr['GD Version'].'</td>
				</tr>
			</tbody>
		</table>
		
		<div style="height:20px"></div>';
		
		//Check if required plugins is installed
		$grandrestaurant_custom_post_activated = function_exists('post_type_menus');
		$grandrestaurant_elementor_activated = function_exists('grandrestaurant_elementor_load');
		$revslider_activated = class_exists('RevSlider');
		$ocdi_activated = class_exists('OCDI_Plugin');
		
		if($grandrestaurant_custom_post_activated && $ocdi_activated && $grandrestaurant_elementor_activated)
		{
			if($has_red_status)
			{
				$system_info_html.= '<div style="height:20px"></div>
			<div class="tg_notice">
				<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
				<span>There are some settings which are below theme recommendation values and it might causes issue importing demo contents.</span>
			</div>';
			
				$import_demo_button_label = 'I understand and want to process demo importing process';
			}
			else
			{
				$import_demo_button_label = 'Begin importing demo process';
			}
			
			$system_info_html.= '<div class="tg_begin_import"><a href="'.admin_url('themes.php?page=tg-one-click-demo-import').'" class="button button-primary button-large">'.$import_demo_button_label.'</a></div>';
		}
		else
		{
			$system_info_html.= '<div style="height:20px"></div>
			<div class="tg_notice">
				<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
				<span style="color:#FF3B30">One Click Demo Import, '.THEMENAME.' Theme Elements for Elementor and Custom Post Type plugins required</span><br/><br/>
				Please <a href="'.admin_url("themes.php?page=install-required-plugins").'">install and activate these required plugins.</a> first so demo contents can be imported properly.
			</div>';
		}
}

/*
	Begin creating admin options
*/

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$options = array (
 
//Begin admin header
array( 
		"name" => THEMENAME." Options",
		"type" => "title"
),
//End admin header

//Begin second tab "Registration"
array( 	"name" => "Registration",
		"type" => "section",
		"icon" => "dashicons-admin-network",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_registration",
	"type" => "html",
	"html" => $product_registration_html,
),

array( "type" => "close"),
//End second tab "Registration"

//Begin second tab "Home"
array( 	"name" => "Getting-Started",
		"type" => "section",
		"icon" => "dashicons-admin-home",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_home",
	"type" => "html",
	"html" => '
	<h1>Getting Started</h1>
	<div class="getting_started_desc">Welcome to '.THEMENAME.' theme. '.THEMENAME.' is now installed and ready to use! Read below for additional informations. We hope you enjoy using the theme!</div>
	<div style="height:40px"></div>
	'.$getting_started_html.'
	',
),

array( "type" => "close"),
//End second tab "Home"

//Begin second tab "Tutorials"
array( 	"name" => "Tutorials",
		"type" => "section",
		"icon" => "",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_tutorials",
	"type" => "html",
	"html" => '<h1>Tutorials</h1><div style="height:20px"></div>'.$tutorial_html,
),

array( "type" => "close"),
//End second tab "Tutorials"

//Begin second tab "Support"
array( 	"name" => "Support",
		"type" => "section",
		"icon" => "dashicons-sos",	
),
array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_support",
	"type" => "html",
	"html" => '<h1>Support</h1>
	<div class="getting_started_desc">'.THEMENAME.' comes with 6 months of free support for every license you purchase. Support can be <a href="https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support">extended through subscriptions</a> via ThemeForest. All support for '.THEMENAME.' is handled through our support center on our company site. Below are all the resources we offer.</div>
	<div style="height:40px"></div>'.$support_html,
),

array( "type" => "close"),
//End second tab "Support"


//Begin second tab "General"
array( 	"name" => "General",
		"type" => "section",
		"icon" => "dashicons-admin-generic",	
),
array( "type" => "open"),

array( "name" => "<h2>Reservation Button Settings</h2>Link reservation button to URL (optional)",
	"desc" => "By default. Reservation button will open reservation form but you can also link it to URL instead",
	"id" => SHORTNAME."_reservation_url",
	"type" => "text",
	"validation" => "text",
	"std" => ""
),

array( "name" => "<h2>Reservation Email Settings</h2>Your reservation email address",
	"desc" => "Enter which email address will be sent from reservation form",
	"id" => SHORTNAME."_reservation_email",
	"type" => "text",
	"validation" => "email",
	"std" => ""
),

array( "name" => "Bcc reservation email address (Optional)",
	"desc" => "Enter which Bcc email address will be sent from reservation form. You can use comma(,) between each address",
	"id" => SHORTNAME."_reservation_bcc_email",
	"type" => "text",
	"validation" => "text",
	"std" => ""
),

array( "name" => "Cc reservation email address (Optional)",
	"desc" => "Enter which Cc email address will be sent from reservation form. You can use comma(,) between each address",
	"id" => SHORTNAME."_reservation_cc_email",
	"type" => "text",
	"validation" => "text",
	"std" => ""
),

array( "name" => "Send a copy of booking email to customer",
	"desc" => "Check this option to send a booking email to customer when they booked table",
	"id" => SHORTNAME."_reservation_email_customer",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Reservation Date & Time Settings</h2>Date Format",
	"desc" => "Enter date format for reservation form",
	"id" => SHORTNAME."_reservation_date_format",
	"type" => "text",
	"validation" => "text",
	"std" => "mm/dd/yy"
),

array( "name" => "Open Time",
	"desc" => "Enter open time of your restaurant",
	"id" => SHORTNAME."_reservation_start_time",
	"type" => "text",
	"validation" => "text",
	"std" => "11:00"
),

array( "name" => "End Time",
	"desc" => "Enter end time of your restaurant",
	"id" => SHORTNAME."_reservation_end_time",
	"type" => "text",
	"validation" => "text",
	"std" => "21:00"
),

array( "name" => "Step",
	"desc" => "Enter number of minutes to step the time by",
	"id" => SHORTNAME."_reservation_time_step",
	"type" => "text",
	"validation" => "text",
	"std" => "30"
),

array( "name" => "Show 24 hours time format",
	"desc" => "Check this option to display time slot in 24 hours format",
	"id" => SHORTNAME."_reservation_24hours",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Contact Form Settings</h2>Your contact email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => SHORTNAME."_contact_email",
	"type" => "text",
	"validation" => "email",
	"std" => ""

),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => SHORTNAME."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),

array( "name" => "<h2>Google Maps Setting</h2>API Key",
	"desc" => "Enter Google Maps API Key <a href=\"https://themegoods.ticksy.com/article/7785/\" target=\"_blank\">How to get API Key</a>",
	"id" => SHORTNAME."_googlemap_api_key",
	"type" => "text",
	"std" => ""
),

array( "name" => "Custom Google Maps Style",
	"desc" => "Enter javascript style array of map. You can get sample one from <a href=\"https://snazzymaps.com\" target=\"_blank\">Snazzy Maps</a>",
	"id" => SHORTNAME."_googlemap_style",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "<h2>GDPR Settings</h2>Enable GDPR Compliant",
	"desc" => "If you enable this option, contact page add checkbox to support GDPR privacy law",
	"id" => SHORTNAME."_contact_enable_gdpr",
	"type" => "iphone_checkboxes",
	"std" => 1,
),

array( "name" => "<h2>Captcha Settings</h2>Enable Captcha",
	"desc" => "If you enable this option, contact page will display captcha image to prevent possible spam",
	"id" => SHORTNAME."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1,
),

array( "name" => "<h2>Custom Sidebar Settings</h2>Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => SHORTNAME."_sidebar0",
	"type" => "text",
	"validation" => "text",
	"std" => "",
),

array( "type" => "close"),
//End second tab "General"


//Begin second tab "Styling"
/*array( "name" => "Styling",
	"type" => "section",
	"icon" => "dashicons-art",
),

array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_get_styling_button",
	"type" => "html",
	"html" => $customizer_styling_html,
),
 
array( "type" => "close"),*/


//Begin fifth tab "Social Profiles"
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "dashicons-facebook",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook page URL",
	"desc" => "Enter full Facebook page URL",
	"id" => SHORTNAME."_facebook_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Twitter Username",
	"desc" => "Enter Twitter username",
	"id" => SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Flickr Username",
	"desc" => "Enter Flickr username",
	"id" => SHORTNAME."_flickr_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Youtube Profile URL",
	"desc" => "Enter Youtube Profile URL",
	"id" => SHORTNAME."_youtube_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Vimeo Username",
	"desc" => "Enter Vimeo username",
	"id" => SHORTNAME."_vimeo_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Tumblr Username",
	"desc" => "Enter Tumblr username",
	"id" => SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Dribbble Username",
	"desc" => "Enter Dribbble username",
	"id" => SHORTNAME."_dribbble_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Linkedin URL",
	"desc" => "Enter full Linkedin URL",
	"id" => SHORTNAME."_linkedin_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Pinterest Username",
	"desc" => "Enter Pinterest username",
	"id" => SHORTNAME."_pinterest_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Instagram Username",
	"desc" => "Enter Instagram username",
	"id" => SHORTNAME."_instagram_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Behance Username",
	"desc" => "Enter Behance username",
	"id" => SHORTNAME."_behance_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Tripadvisor URL",
	"desc" => "Enter full Tripadvisor URL",
	"id" => SHORTNAME."_tripadvisor_url",
	"type" => "text",
	"std" => ""
),
array( "name" => "Yelp URL",
	"desc" => "Enter full Yelp URL",
	"id" => SHORTNAME."_yelp_url",
	"type" => "text",
	"std" => ""
),
array( "name" => "<h2>Twitter API Settings</h2>Twitter Consumer Key <a href=\"https://themegoods.ticksy.com/article/3778\">See instructions</a>",
	"desc" => "Enter Twitter API Consumer Key",
	"id" => SHORTNAME."_twitter_consumer_key",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Twitter Consumer Secret",
	"desc" => "Enter Twitter API Consumer Secret",
	"id" => SHORTNAME."_twitter_consumer_secret",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Twitter Consumer Token",
	"desc" => "Enter Twitter API Consumer Token",
	"id" => SHORTNAME."_twitter_consumer_token",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Twitter Consumer Token Secret",
	"desc" => "Enter Twitter API Consumer Token Secret",
	"id" => SHORTNAME."_twitter_consumer_token_secret",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "type" => "close"),

//End fifth tab "Social Profiles"


//Begin second tab "Script"
array( "name" => "Script",
	"type" => "section",
	"icon" => "dashicons-format-aside",
),

array( "type" => "open"),

array( "name" => "<h2>CSS Settings</h2>Custom CSS for desktop",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for iPad Portrait View",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css_tablet_portrait",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for iPhone Landscape View",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css_mobile_landscape",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for iPhone Portrait View",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css_mobile_portrait",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),
array( "name" => "<h2>CSS and Javascript Optimisation Settings</h2>Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time.",
	"id" => SHORTNAME."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Cache theme's custom CSS",
	"desc" => "Cache theme custom CSS code which generate by customizer options to help improving loading speed",
	"id" => SHORTNAME."_advance_cache_custom_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's js files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Cache Settings</h2>Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => SHORTNAME."_advance_clear_cache",
	"type" => "html",
	"html" => '<br/><a id="'.SHORTNAME.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close"),

//Begin second tab "System"
/*array( 	"name" => "System",
		"type" => "section",
		"icon" => "dashicons-dashboard",	
),
array( "type" => "open"),

array( "name" => "<h2>System Information</h2>",
	"desc" => "",
	"id" => SHORTNAME."_system",
	"type" => "html",
	"html" => $system_info_html,
),

array( "type" => "close"),*/
//End second tab "System"


//Begin second tab "Demo"
array( "name" => "Demo-Content",
	"type" => "section",
	"icon" => "dashicons-download",
),

array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_import_demo_notice",
	"type" => "html",
	"html" => '<h1>Checklist before Importing Demo</h1><br/><strong>IMPORTANT</strong>: Demo importer can vary in time. The included required plugins need to be installed and activated before you import demo. Please check the Server Environment below to ensure your server meets all requirements for a successful import. <strong>Settings that need attention will be listed in red</strong>.
	',
),
array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_import_demo_content",
	"type" => "html",
	"html" => $system_info_html,
),
 
array( "type" => "close"),

array( 	"name" => "Buy-Another-License",
"type" => "section",
"icon" => "",		
),
array( "type" => "open"),

array( "type" => "close"),
 
);

$options[] = array( "type" => "close");

function add_menu_icons_styles(){
?>
 
<style>
#adminmenu .menu-icon-events div.wp-menu-image:before {
  content: '\f145';
}
#adminmenu .menu-icon-menus div.wp-menu-image:before {
  content: '\f119';
}
#adminmenu .menu-icon-galleries div.wp-menu-image:before {
  content: '\f161';
}
#adminmenu .menu-icon-testimonials div.wp-menu-image:before {
  content: '\f155';
}
#adminmenu .menu-icon-team div.wp-menu-image:before {
  content: '\f307';
}
#adminmenu .menu-icon-pricing div.wp-menu-image:before {
  content: '\f214';
}
</style>
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

//Create theme admin panel
function pp_add_admin() {
 
global $themename, $shortname, $options;

if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
 
	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
		$redirect_uri = '';
 
		//check if verify purchase code
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Register')
		{
			if(!empty($_REQUEST['pp_envato_personal_token']) && strlen($_REQUEST['pp_envato_personal_token']) == 36) {
				$url = THEMEGOODS_API.'/register-purchase';
				$data = array(
					'purchase_code' => $_REQUEST['pp_envato_personal_token'], 
					'domain' => $_REQUEST['themegoods-site-domain'],
					'item_id' => ENVATOITEMID,
				);
				$data = wp_json_encode( $data );
				$args = array( 
					'method'   	=> 'POST',
					'body'		=> $data,
				);
				//print '<pre>'; var_dump($args); print '</pre>';
				
				$response = wp_remote_post( $url, $args );
				$response_body = wp_remote_retrieve_body( $response );
				$response_obj = json_decode($response_body);
				
				$response_json = urlencode($response_body);
				//print '<pre>'; var_dump($response_body); print '</pre>';
				//print '<pre>'; var_dump("admin.php?page=admin.lib.php&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']); print '</pre>';
				//die;
				
				if(is_bool($response_obj->response_code)) {
					if($response_obj->response_code) {
						$success_message = "Purchase code is registered.";
						
						if(!empty($response_obj->response)) {
							$error_message = $response_obj->response;
						}
						
						grandrestaurant_register_theme($_REQUEST['pp_envato_personal_token'], $_REQUEST['themegoods-site-domain']);
						wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
						
						die;
					}
					else {
						$error_message = "Purchase code is invalid.";
						
						wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
						
						die;
					}
				}
				else {
					$error_message = "Purchase code is invalid";
					
					wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
					
					die;
				}
			}
			else {
				$error_message = "Purchase code is invalid";
				wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
				
				die;
			}
		}
		
		//check if unregister purchase code
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Unregister')
		{
			if(!empty($_REQUEST['pp_envato_personal_token']) && strlen($_REQUEST['pp_envato_personal_token']) == 36) {
				$url = THEMEGOODS_API.'/unregister-purchase';
				$data = array(
					'purchase_code' => $_REQUEST['pp_envato_personal_token'], 
					'domain' => $_REQUEST['themegoods-site-domain'],
					'item_id' => ENVATOITEMID,
				);
				$data = wp_json_encode( $data );
				$args = array( 
					'method'   	=> 'POST',
					'body'		=> $data,
				);
				$response = wp_remote_post( $url, $args );
				$response_body = wp_remote_retrieve_body( $response );
				$response_obj = json_decode($response_body);
				
				$response_json = urlencode($response_body);
				/*print '<pre>'; var_dump($args); print '</pre>';
				print '<pre>'; var_dump($response_json); print '</pre>';
				die;*/
				if(is_bool($response_obj->response_code)) {
					if($response_obj->response_code) {
						$success_message = "Purchase code is unregistered.";
						
						if(!empty($response_obj->response)) {
							$error_message = $response_obj->response;
						}
						
						grandrestaurant_unregister_theme();
						wp_redirect(admin_url()."?page=admin.lib.php&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
						
						die;
					}
					else {
						$error_message = "Purchase code is invalid.";
						
						wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
						
						die;
					}
				}
				else {
					$error_message = "Purchase code is invalid";
					
					wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
					
					die;
				}
			}
			else {
				$error_message = "Purchase code is invalid";
				wp_redirect(admin_url()."?page=admin.lib.php&purchase_code=".$_REQUEST['pp_envato_personal_token']."&response=".$response_json."".$redirect_uri.$_REQUEST['current_tab']);
				
				die;
			}
		}
 
		foreach ($options as $value) 
		{
			if($value['type'] != 'image' && isset($value['id']) && isset($_REQUEST[ $value['id'] ]))
			{
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
		}
		
		foreach ($options as $value) {
		
			if( isset($value['id']) && isset( $_REQUEST[ $value['id'] ] )) 
			{ 

				if($value['id'] != SHORTNAME."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
				{
					//if sortable type
					if(is_admin() && $value['type'] == 'sortable')
					{
						$sortable_array = serialize($_REQUEST[ $value['id'] ]);
						
						$sortable_data = $_REQUEST[ $value['id'].'_sort_data'];
						$sortable_data_arr = explode(',', $sortable_data);
						$new_sortable_data = array();
						
						foreach($sortable_data_arr as $key => $sortable_data_item)
						{
							$sortable_data_item_arr = explode('_', $sortable_data_item);
							
							if(isset($sortable_data_item_arr[0]))
							{
								$new_sortable_data[] = $sortable_data_item_arr[0];
							}
						}
						
						update_option( $value['id'], $sortable_array );
						update_option( $value['id'].'_sort_data', serialize($new_sortable_data) );
					}
					elseif(is_admin() && $value['type'] == 'font')
					{
						if(!empty($_REQUEST[ $value['id'] ]))
						{
							update_option( $value['id'], $_REQUEST[ $value['id'] ] );
							update_option( $value['id'].'_value', $_REQUEST[ $value['id'].'_value' ] );
						}
						else
						{
							delete_option( $value['id'] );
							delete_option( $value['id'].'_value' );
						}
					}
					elseif(is_admin())
					{
						if($value['type']=='image')
						{
							update_option( $value['id'], esc_url($_REQUEST[ $value['id'] ])  );
						}
						elseif($value['type']=='textarea')
						{
							if(isset($value['validation']) && !empty($value['validation']))
							{
								update_option( $value['id'], esc_textarea($_REQUEST[ $value['id'] ]) );
							}
							else
							{
								update_option( $value['id'], $_REQUEST[ $value['id'] ] );
							}
						}
						elseif($value['type']=='iphone_checkboxes' OR $value['type']=='jslider')
						{
							update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
						}
						else
						{
							if(isset($value['validation']) && !empty($value['validation']))
							{
								$request_value = $_REQUEST[ $value['id'] ];
								
								//Begin data validation
								switch($value['validation'])
								{
									case 'text':
									default:
										$request_value = sanitize_text_field($request_value);
									
									break;
									
									case 'email':
										$request_value = sanitize_email($request_value);

									break;
									
									case 'javascript':
										$request_value = sanitize_text_field($request_value);

									break;
									
								}
								update_option( $value['id'], $request_value);
							}
							else
							{
								update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
							}
						}
					}
				}
				elseif(is_admin() && isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
				{
					if($value['id'] == SHORTNAME."_sidebar0")
					{
						//get last sidebar serialize array
						$current_sidebar = get_option(SHORTNAME."_sidebar");
						$request_value = $_REQUEST[ $value['id'] ];
						$request_value = sanitize_text_field($request_value);
						
						$current_sidebar[ $request_value ] = $request_value;
			
						update_option( SHORTNAME."_sidebar", $current_sidebar );
					}
					elseif($value['id'] == SHORTNAME."_ggfont0")
					{
						//get last ggfonts serialize array
						$current_ggfont = get_option(SHORTNAME."_ggfont");
						$current_ggfont[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
			
						update_option( SHORTNAME."_ggfont", $current_ggfont );
					}
				}
			} 
			else 
			{ 
				if(is_admin() && isset($value['id']))
				{
					delete_option( $value['id'] );
				}
			} 
			
			//Check writing cache file for theme options
			$advance_cache_custom_css = get_option('pp_advance_cache_custom_css');
			
			if($advance_cache_custom_css)
			{
				$css_cache_path = THEMEUPLOAD.'/custom-css.css';
				
				if(!file_exists($css_cache_path))
				{
					//Get custom CSS code to cache
					ob_start(); 
					get_template_part("/templates/custom-css");
					$grandrestaurant_custom_css = ob_get_contents(); 
					ob_end_clean();
					
				    //Writing cache file
					file_put_contents($css_cache_path, $grandrestaurant_custom_css);
				}
			}
		}

		header("Location: admin.php?page=admin.lib.php&saved=true".$redirect_uri.$_REQUEST['current_tab']);
	}  
} 
 
add_menu_page('Theme Setting', 'Theme Setting', 'administrator', basename(__FILE__), 'pp_admin', '', 3);
}

function pp_enqueue_admin_page_scripts() {

$file_dir=get_template_directory_uri();
global $current_screen;
wp_enqueue_style('thickbox');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, THEMEVERSION, "all");

if(property_exists($current_screen, 'post_type') && $current_screen->post_type == 'page')
{
	wp_enqueue_style("jqueryui", $file_dir."/css/jqueryui/custom.css", false, THEMEVERSION, "all");
}

wp_enqueue_style("colorpicker_css", $file_dir."/functions/colorpicker/css/colorpicker.css", false, THEMEVERSION, "all");
wp_enqueue_style("fancybox", $file_dir."/js/fancybox/jquery.fancybox.admin.css", false, THEMEVERSION, "all");
wp_enqueue_style('icheck', get_template_directory_uri().'/functions/skins/flat/blue.css', false, THEMEVERSION, 'all');
wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, THEMEVERSION, "all");

wp_enqueue_script("jquery-ui-core");
wp_enqueue_script("jquery-ui-sortable");
wp_enqueue_script('jquery-ui-tabs');
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');

$ap_vars = array(
    'url' => get_home_url(),
    'includes_url' => includes_url()
);

wp_register_script( 'ap_wpeditor_init', get_template_directory_uri() . '/functions/js-wp-editor.js', array( 'jquery' ), '1.1', true );
wp_localize_script( 'ap_wpeditor_init', 'ap_vars', $ap_vars );
wp_enqueue_script( 'ap_wpeditor_init' );

wp_enqueue_script("colorpicker_script", $file_dir."/functions/colorpicker/js/colorpicker.js", false, THEMEVERSION);
wp_enqueue_script("eye_script", $file_dir."/functions/colorpicker/js/eye.js", false, THEMEVERSION);
wp_enqueue_script("utils_script", $file_dir."/functions/colorpicker/js/utils.js", false, THEMEVERSION);
wp_enqueue_script("jquery.icheck.min", $file_dir."/functions/jquery.icheck.min.js", false, THEMEVERSION);
wp_enqueue_script("jslider_depend", $file_dir."/functions/jquery.dependClass.js", false, THEMEVERSION);

//Fix WPML plugin script conflict
$tg_screen = get_current_screen();

if($tg_screen->id == 'toplevel_page_functions' && $_GET["page"] == "functions.php")
{
	wp_enqueue_script("jslider", $file_dir."/functions/jquery.slider-min.js", false, THEMEVERSION);
}

wp_enqueue_script("fancybox", $file_dir."/js/fancybox/jquery.fancybox.admin.js", false);
wp_enqueue_script("hint", $file_dir."/js/hint.js", false, THEMEVERSION, true);
wp_enqueue_script('tooltipster', get_template_directory_uri().'/js/jquery.tooltipster.min.js', false, THEMEVERSION);

wp_register_script( "rm_script", $file_dir."/functions/theme_script.js", false, THEMEVERSION, true);
$params = array(
  	'ajaxurl' => admin_url('admin-ajax.php'),
  	'nonce' => wp_create_nonce( 'wp_rest' ),
	'tgurl' => THEMEGOODS_API,
	'itemid' => ENVATOITEMID,
	'purchaseurl' => THEMEGOODS_PURCHASE_URL,
);
wp_localize_script( 'rm_script', 'tgAjax', $params );
wp_enqueue_script( 'rm_script' );

}

add_action('admin_enqueue_scripts',	'pp_enqueue_admin_page_scripts' );

function pp_enqueue_front_page_scripts() {

    //enqueue frontend css files
	$pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	
	//Get theme cache folder
	$upload_dir = wp_upload_dir();
	$cache_dir = '';
	$cache_url = '';
	
	if(isset($upload_dir['basedir']))
	{
		$cache_dir = THEMEUPLOAD;
	}
	
	if(isset($upload_dir['baseurl']))
	{
		$cache_url = THEMEUPLOADURL;
	}
	    
	if(!empty($pp_advance_combine_css))
	{
	    if(!file_exists($cache_dir."combined.css"))
	    {
	    	$cssmin = new CSSMin();
	    	
	    	$css_arr = array(
	    	    get_template_directory().'/css/reset.css',
	    	    get_template_directory().'/css/wordpress.css',
	    	    get_template_directory().'/css/animation.css',
	    	    //get_template_directory().'/css/magnific-popup.css',
	    	    get_template_directory().'/js/modulobox/modulobox.css',
	    	    get_template_directory().'/css/jqueryui/custom.css',
	    	    get_template_directory().'/js/mediaelement/mediaelementplayer.css',
	    	    get_template_directory().'/js/flexslider/flexslider.css',
	    	    get_template_directory().'/css/tooltipster.css',
	    	    get_template_directory().'/css/odometer-theme-minimal.css',
	    	    get_template_directory().'/css/hw-parallax.css',
	    	    get_template_directory().'/css/screen.css',
	    	);
	    	
	    	//If using child theme
	    	if(is_child_theme())
	    	{
	    		$css_arr[] = get_template_directory().'/style.css';
	    	}
	    	
	    	$cssmin->addFiles($css_arr);
	    	
	    	// Set original CSS from all files
	    	$cssmin->setOriginalCSS();
	    	$cssmin->compressCSS();
	    	
	    	$css = $cssmin->printCompressedCSS();
	    	
	    	file_put_contents($cache_dir."combined.css", $css);
	    }
	    
	    wp_enqueue_style("combined_css", $cache_url."combined.css", false, "");
	}
	else
	{
		wp_enqueue_style("reset", get_template_directory_uri()."/css/reset.css", false, "");
		wp_enqueue_style("wordpress", get_template_directory_uri()."/css/wordpress.css", false, "");
		wp_enqueue_style("animation", get_template_directory_uri()."/css/animation.css", false, "", "all");
	    //wp_enqueue_style("magnific-popup", get_template_directory_uri()."/css/magnific-popup.css", false, "", "all");
	    wp_enqueue_style("modulobox", get_template_directory_uri()."/js/modulobox/modulobox.css", false, "", "all");
	    wp_enqueue_style("jquery-ui", get_template_directory_uri()."/css/jqueryui/custom.css", false, "");
	    wp_enqueue_style("mediaelement", get_template_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, "", "all");
	    wp_enqueue_style("flexslider", get_template_directory_uri()."/js/flexslider/flexslider.css", false, "", "all");
	    wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, "", "all");
	    wp_enqueue_style("odometer-theme", get_template_directory_uri()."/css/odometer-theme-minimal.css", false, "", "all");
	    wp_enqueue_style("hw-parallax", get_template_directory_uri().'/css/hw-parallax.css', false, "", "all");
	    wp_enqueue_style("screen", get_template_directory_uri().'/css/screen.css', false, "", "all");
	}
	
	//Check if content builder preview page
	if(isset($_GET['ppb_preview_page']))
	{
		wp_enqueue_style( 'dashicons' );
	}
	
	//Check menu layout
	$tg_menu_layout = get_theme_mod('tg_menu_layout', 'classicmenu');
	
	if($tg_menu_layout == 'leftmenu')
	{
		wp_enqueue_style("leftmenu.css", get_template_directory_uri().'/css/leftmenu.css', false, "", "all");
	}
	else if($tg_menu_layout == 'centermenu')
	{
		wp_enqueue_style("centermenu.css", get_template_directory_uri().'/css/centermenu.css', false, "", "all");
	}
	
	//Add Font Awesome Support if Elementor is not installed
	if (!class_exists("\\Elementor\\Plugin")) 
	{
		wp_enqueue_style("fontawesome", get_template_directory_uri()."/css/font-awesome.min.css", false, "", "all");
	}
	else
	{
		wp_enqueue_style("elementor-icons-shared-0-css", ELEMENTOR_ASSETS_URL."/lib/font-awesome/css/fontawesome.min.css", false, "", "all");
		wp_enqueue_style("elementor-icons-fa-solid-css", ELEMENTOR_ASSETS_URL."/lib/font-awesome/css/solid.min.css", false, "", "all");
	}
	
	wp_enqueue_style("themify-icons", get_template_directory_uri()."/css/themify-icons.css", false, "", "all");
	
	$tg_boxed = get_theme_mod('tg_boxed', 0);
    if(!empty($tg_boxed) && $tg_menu_layout != 'leftmenu')
    {
    	wp_enqueue_style("tg_boxed", get_template_directory_uri().'/css/tg_boxed.css', false, "", "all");
    }
	
	//If using child theme
	if(is_child_theme())
	{
	    wp_enqueue_style('child_theme', get_stylesheet_directory_uri()."/style.css", false, "", "all");
	}
	
	//Get all Google Web font CSS
	global $tg_google_fonts;
	$tg_custom_fonts = get_theme_mod('tg_custom_fonts');
	
	$tg_fonts_family = array();
	if(is_array($tg_google_fonts) && !empty($tg_google_fonts))
	{
		foreach($tg_google_fonts as $tg_font)
		{
			$search_items = array('font_name'=>$tg_font); 
			$selected_font = search_array_by_key_value($tg_custom_fonts, $search_items);
			/*var_dump($search_items);
			var_dump($selected_font);*/
			
			if(!empty($selected_font)) {
				$new_font_family = get_theme_mod($tg_font);
				$tg_fonts_family[] = $new_font_family;
			}
		}
	}

	$tg_fonts_family = array_unique($tg_fonts_family);

	foreach($tg_fonts_family as $key => $tg_google_font)
	{	  
		if(!empty($tg_google_font) && $tg_google_font != 'serif' && $tg_google_font != 'sans-serif' && $tg_google_font != 'monospace')
	    {
	    	wp_enqueue_style('google_font'.$key, "https://fonts.googleapis.com/css?family=".urlencode($tg_google_font).":100,200,300,400,600,700,800,900,400italic&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
	    }
	}
	
	//Enqueue javascripts
	wp_enqueue_script("jquery");
	wp_enqueue_script('smoove', get_template_directory_uri().'/js/jquery-smoove.js', false, '', true);
	
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
		//'jquery.magnific-popup.js',
		'/modulobox/modulobox.js',
		'jquery.easing.js',
	    'waypoints.min.js',
	    'jquery.isotope.js',
	    'jquery.masory.js',
	    'jquery.tooltipster.min.js',
	    'hw-parallax.js',
	    'jquery.stellar.min.js',
	    'jquery.resizeimagetoparent.min.js',
	    'custom_plugins.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists($cache_dir."combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify(file_get_contents($js_path.$file));
    			}
			}
			
			file_put_contents($cache_dir."combined.js", $js);
		}

		wp_enqueue_script("combined_js", $cache_url."combined.js", false, "", true);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_template_directory_uri()."/js/".$file, false, "", true);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'pp_enqueue_front_page_scripts' );


//Enqueue mobile CSS after all others CSS load
function grandrestaurant_register_mobile_css() {
	//Get theme cache folder
	$upload_dir = wp_upload_dir();
	$cache_dir = '';
	$cache_url = '';
	
	if(isset($upload_dir['basedir']))
	{
		$cache_dir = THEMEUPLOAD;
	}
	
	if(isset($upload_dir['baseurl']))
	{
		$cache_url = THEMEUPLOADURL;
	}
	
    //Enable responsive layout
    wp_enqueue_style('responsive', get_template_directory_uri()."/css/grid.css", false, "", "all");
    
	//Check writing cache file for theme options
	$advance_cache_custom_css = get_option('pp_advance_cache_custom_css');
	
	if($advance_cache_custom_css)
	{
		$css_cache_path = THEMEUPLOAD.'/custom-css.css';
		
		if(!file_exists($css_cache_path))
		{
			//Get custom CSS code to cache
			ob_start(); 
			get_template_part("/templates/custom-css");
			$grandrestaurant_custom_css = ob_get_contents(); 
			ob_end_clean();
			
		    //Writing cache file
			file_put_contents($css_cache_path, $grandrestaurant_custom_css);
			
			//Refresh page
			header('Location: '.$_SERVER['REQUEST_URI']);
		}
		
		wp_enqueue_style("grandrestaurant-custom-css", $cache_url."custom-css.css", false, "", "all");
	}
	else
	{
		wp_enqueue_style("grandrestaurant-custom-css", get_template_directory_uri()."/templates/custom-css.php", false, "", "all");
	}
}
add_action('wp_enqueue_scripts', 'grandrestaurant_register_mobile_css', 9999);


function pp_admin() {
 
global $themename, $shortname, $options;
$i=0;

$pp_font_family = get_option('pp_font_family');

if(function_exists( 'wp_enqueue_media' )){
    wp_enqueue_media();
}
?>
	
	<div id="pp_success"><span class="dashicons dashicons-yes"></span><br/><span><?php _e( 'Settings Updated', 'grandrestaurant' ); ?></span></div>
	
	<form id="pp_form" method="post" enctype="multipart/form-data">
	<div class="pp_wrap rm_wrap">
	
	<div class="header_wrap">
		<div style="float:left">
		<h2><?php _e( 'Theme Setting', 'grandrestaurant' ); ?><span class="pp_version">version <?php echo THEMEVERSION; ?></span>
		</div>
		<div style="float:right;margin:32px 0 0 0">
			<!-- input id="save_ppskin" name="save_ppskin" class="button secondary_button" type="submit" value="Save as Skin" / -->
			<input id="save_ppsettings" name="save_ppsettings" class="button button-primary button-large" type="submit" value="<?php _e( 'Save', 'grandrestaurant' ); ?>" />
			<br/><br/>
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_registration" />
			<input type="hidden" name="pp_save_skin_flg" id="pp_save_skin_flg" value="" />
			<input type="hidden" name="pp_save_skin_name" id="pp_save_skin_name" value="" />
		</div>
		<input type="hidden" name="pp_admin_url" id="pp_admin_url" value="<?php echo get_template_directory_uri(); ?>"/>
		<br style="clear:both"/><br/>

<?php
	//Check if theme has new update
?>

	</div>
	
	<div class="pp_wrap">
	<div id="pp_panel">
	<?php 
		foreach ($options as $value) {
			
			$active = '';
			
			if($value['type'] == 'section')
			{
				if($value['name'] == 'Registration')
				{
					$active = 'nav-tab-active';
				}
				echo '<a id="pp_panel_'.strtolower($value['name']).'_a" href="#pp_panel_'.strtolower($value['name']).'" class="nav-tab '.$active.'">'.str_replace('-', ' ', $value['name']).'</a>';
			}
		}
	?>
	</h2>
	</div>

	<div class="rm_opts">
	
<?php 
	$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	foreach ($options as $value) {
	switch ( $value['type'] ) {
	 
	case "open":
	?> <?php break;
	 
	case "close":
	?>
		
		</div>
		</div>
	
	
		<?php break;
	 
	case "title":
	?>
		<br />
	
	
	<?php break;
	 
	case 'text':
		
		//if sidebar input then not show default value
		if($value['id'] != SHORTNAME."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
		{
			$default_val = get_option( $value['id'] );
		}
		else
		{
			$default_val = '';	
		}
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
		
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>"
			value="<?php if ($default_val != "") { echo esc_attr(get_option( $value['id'])) ; } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.intval($value['size']).'"'; } ?> />
		<div class="clearfix"></div>
		
		<?php
		if($value['id'] == SHORTNAME."_sidebar0")
		{
			$current_sidebar = get_option(SHORTNAME."_sidebar");
			
			if(!empty($current_sidebar))
			{
		?>
			<br class="clear"/><br/>
		 	<div class="pp_sortable_wrapper">
			<ul id="current_sidebar" class="rm_list">
	
		<?php
			foreach($current_sidebar as $sidebar)
			{
		?> 
				
				<li id="<?php echo esc_attr($sidebar); ?>"><div class="title"><?php echo esc_html($sidebar); ?></div><a href="<?php echo esc_url($url); ?>" class="sidebar_del" rel="<?php echo esc_attr($sidebar); ?>"><span class="dashicons dashicons-no"></span></a><br style="clear:both"/></li>
		
		<?php
			}
		?>
		
			</ul>
			</div>
			<br style="clear:both"/>
		<?php
			}
		}
		?>
	
		</div>
		<?php
	break;
	
	case 'colorpicker':
	?>
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="text" 
			value="<?php if ( get_option( $value['id'] ) != "" ) { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker" readonly/>
		<div id="<?php echo esc_attr($value['id']); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($value['id']); ?>').click()" style="background:<?php if (get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?> url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png) center no-repeat;">&nbsp;</div>
			<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		
		</div>
		
	<?php
	break;
	 
	case 'textarea':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_textarea"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
			
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		
		<textarea id="<?php echo esc_attr($value['id']); ?>" name="<?php echo esc_attr($value['id']); ?>"
			type="<?php echo esc_attr($value['type']); ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo esc_html($value['std']); } ?></textarea>
		
		<div class="clearfix"></div>
	
		</div>
	
		<?php
	break;
	
	case 'css':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_textarea"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
			
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		
		<textarea id="<?php echo esc_attr($value['id']); ?>" class="css" name="<?php echo esc_attr($value['id']); ?>"
			type="<?php echo esc_attr($value['type']); ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo esc_html($value['std']); } ?></textarea>
		
		<div class="clearfix"></div>
	
		</div>
	
		<?php
	break;
	 
	case 'select':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<select name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>">
			<?php foreach ($value['options'] as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $key) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php } ?>
		</select> <small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	
	case 'font':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_font"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<div id="<?php echo esc_attr($value['id']); ?>_wrapper" style="float:left;font-size:11px;">
		<select class="pp_font" data-sample="<?php echo esc_attr($value['id']); ?>_sample" data-value="<?php echo esc_attr($value['id']); ?>_value" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>">
			<option value="" data-family="">---- <?php esc_html_e('Theme Default Font', 'grandconference' ); ?> ----</option>
			<?php 
				foreach ($pp_font_arr as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($option['css-name']); ?>" data-family="<?php echo esc_attr($option['font-name']); ?>"><?php echo esc_html($option['font-name']); ?></option>
			<?php } ?>
		</select> 
		<input type="hidden" id="<?php echo esc_attr($value['id']); ?>_value" name="<?php echo esc_attr($value['id']); ?>_value" value="<?php echo get_option( $value['id'].'_value' ); ?>"/>
		<br/><br/><div id="<?php echo esc_attr($value['id']); ?>_sample" class="pp_sample_text"><?php esc_html_e('Sample Text', 'grandconference' ); ?></div>
		</div>
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	 
	case 'radio':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/><br/>
	
		<div style="margin-top:5px;float:left;<?php if(!empty($value['desc'])) { ?>width:300px<?php } else { ?>width:500px<?php } ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
		<div style="float:left;<?php if(!empty($value['desc'])) { ?>margin:0 20px 20px 0<?php } ?>">
			<input style="float:left;" id="<?php echo esc_attr($value['id']); ?>" name="<?php echo esc_attr($value['id']); ?>" type="radio"
			<?php if (get_option( $value['id'] ) == $key) { echo 'checked="checked"'; } ?>
				value="<?php echo esc_attr($key); ?>"/><?php echo esc_html($option); ?>
		</div>
		<?php } ?>
		</div>
		
		<?php if(!empty($value['desc'])) { ?>
			<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<?php } ?>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	
	case 'sortable':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<div style="float:left;width:100%;">
		<?php 
		$sortable_array = array();
		if(get_option( $value['id'] ) != 1)
		{
			$sortable_array = unserialize(get_option( $value['id'] ));
		}
		
		$current = 1;
		
		if(!empty($value['options']))
		{
		?>
		<select name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" class="pp_sortable_select">
		<?php
		foreach ($value['options'] as $key => $option) { 
			if($key > 0)
			{
		?>
		<option value="<?php echo esc_attr($key); ?>" data-rel="<?php echo esc_attr($value['id']); ?>_sort" title="<?php echo html_entity_decode($option); ?>"><?php echo html_entity_decode($option); ?></option>
		<?php }
		
				if($current>1 && ($current-1)%3 == 0)
				{
		?>
		
				<br style="clear:both"/>
		
		<?php		
				}
				
				$current++;
			}
		?>
		</select>
		<a class="button pp_sortable_button" data-rel="<?php echo esc_attr($value['id']); ?>" class="button" style="display:inline-block"><?php echo esc_html__('Add', 'grandconference' ); ?></a>
		<?php
		}
		?>
		 
		 <br style="clear:both"/><br/>
		 
		 <div class="pp_sortable_wrapper">
		 <ul id="<?php echo esc_attr($value['id']); ?>_sort" class="pp_sortable" rel="<?php echo esc_attr($value['id']); ?>_sort_data"> 
		 <?php
		 	$sortable_data_array = unserialize(get_option( $value['id'].'_sort_data' ));
	
		 	if(!empty($sortable_data_array))
		 	{
		 		foreach($sortable_data_array as $key => $sortable_data_item)
		 		{
			 		if(!empty($sortable_data_item))
			 		{
		 		
		 ?>
		 		<li id="<?php echo esc_attr($sortable_data_item); ?>_sort" class="ui-state-default"><div class="title"><?php echo esc_html($value['options'][$sortable_data_item]); ?></div><a data-rel="<?php echo esc_attr($value['id']); ?>_sort" href="javascript:;" class="remove"><span class="dashicons dashicons-no"></span></a><br style="clear:both"/></li> 	
		 <?php
		 			}
		 		}
		 	}
		 ?>
		 </ul>
		 
		 </div>
		 
		</div>
		
		<input type="hidden" id="<?php echo esc_attr($value['id']); ?>_sort_data" name="<?php echo esc_attr($value['id']); ?>_sort_data" value="" style="width:100%"/>
		<br style="clear:both"/><br/>
		
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	 
	case "checkbox":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
		<input type="checkbox" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_html($checked); ?> />
	
	
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
	<?php break; 
	
	case "iphone_checkboxes":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
	
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
	
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
		<input type="checkbox" class="iphone_checkboxes" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_html($checked); ?> />
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
	
	case "html":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<small class="description"><?php echo stripslashes($value['desc']); ?></small>
	
		<?php echo stripslashes($value['html']); ?>
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
	
	case "shortcut":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_shortcut">
	
		<ul class="pp_shortcut_wrapper">
		<?php 
			$count_shortcut = 1;
			foreach ($value['options'] as $key_shortcut => $option) { ?>
			<li><a href="#<?php echo esc_attr($key_shortcut); ?>" <?php if($count_shortcut==1) { ?>class="active"<?php } ?>><?php echo esc_html($option); ?></a></li>
		<?php $count_shortcut++; } ?>
		</ul>
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
		
	case "section":
	
	$i++;
	
	?>
	
		<div id="pp_panel_<?php echo strtolower($value['name']); ?>" class="rm_section">
		<div class="rm_title">
		<h3><img
			src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png"
			class="inactive" alt=""><?php echo stripslashes($value['name']); ?></h3>
		<span class="submit"><input class="button-primary" name="save<?php echo esc_attr($i); ?>" type="submit"
			value="Save changes" /> </span>
		<div class="clearfix"></div>
		</div>
		<div class="rm_options"><?php break;
	 
	}
	}
?>
 	
 	<div class="clearfix"></div>
 	</form>
</div>


	<?php
}

add_action('admin_menu', 'pp_add_admin');
?>