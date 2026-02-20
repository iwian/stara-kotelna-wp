<?php 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

header('Content-type: text/css');

$pp_advance_combine_css = get_option('pp_advance_combine_css');

if(!empty($pp_advance_combine_css))
{
	//Function for compressing the CSS as tightly as possible
	function compress($buffer) {
	    //Remove CSS comments
	    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	    //Remove tabs, spaces, newlines, etc.
	    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	    return $buffer;
	}

	//This GZIPs the CSS for transmission to the user
	//making file size smaller and transfer rate quicker
	ob_start("ob_gzhandler");
	ob_start("compress");
}
?>

<?php
	//Check if hide portfolio navigation
	$pp_portfolio_single_nav = get_option('pp_portfolio_single_nav');
	if(empty($pp_portfolio_single_nav))
	{
?>
.portfolio_nav { display:none; }
<?php
	}
?>
<?php
	$tg_fixed_menu = get_theme_mod('tg_fixed_menu', 1);
	
	if(!empty($tg_fixed_menu))
	{
		//Check if Wordpress admin bar is enabled
		$menu_top_value = 0;
		if(is_admin_bar_showing())
		{
			$menu_top_value = 30;
		}
?>
.top_bar.fixed
{
	position: fixed;
	animation-name: slideDown;
	-webkit-animation-name: slideDown;	
	animation-duration: 0.5s;	
	-webkit-animation-duration: 0.5s;
	z-index: 999;
	visibility: visible !important;
	top: <?php echo intval($menu_top_value); ?>px;
}

<?php
	$pp_menu_font = get_option('pp_menu_font');
	$pp_menu_font_diff = 16-$pp_menu_font;
?>
.top_bar.fixed #menu_wrapper div .nav
{
	margin-top: <?php echo intval($pp_menu_font_diff); ?>px;
}

.top_bar.fixed #searchform
{
	margin-top: <?php echo intval($pp_menu_font_diff-8); ?>px;
}

.top_bar.fixed .header_cart_wrapper
{
	margin-top: <?php echo intval($pp_menu_font_diff+5); ?>px;
}

.top_bar.fixed #menu_wrapper div .nav > li > a
{
	padding-bottom: 24px;
}

.top_bar.fixed .logo_wrapper img
{
	max-height: 40px;
	width: auto;
}
<?php
	}
?>

<?php
	$tg_sidemenu = get_theme_mod('tg_sidemenu', 1);
	
	if(empty($tg_sidemenu))
	{
?>
@media only screen and (min-width: 961px)
{
	body #mobile_nav_icon
	{
	    display: none;
	}
}
<?php
	}
?>

<?php
	$tg_page_title_align = get_theme_mod('tg_page_title_align', 'left');
	
	if(!empty($tg_page_title_align))
	{
?>
#page_caption .page_title_wrapper
{
	text-align: <?php echo esc_attr($tg_page_title_align); ?>
}
.page_title_inner
{
	float: none;
}
<?php
	}
?>

<?php
	$tg_menu_bg_img = get_theme_mod('tg_menu_bg_img');
	
	if(!empty($tg_menu_bg_img))
	{
?>
.top_bar
{
	background-image: url('<?php echo esc_url($tg_menu_bg_img); ?>');
	background-repeat: repeat;
}
<?php
	}
?>

<?php
	$tg_content_bg_img = get_theme_mod('tg_content_bg_img');
	
	if(!empty($tg_content_bg_img))
	{
?>
body
{
	background-image: url('<?php echo esc_url($tg_content_bg_img); ?>');
	background-repeat: repeat;
}
<?php
	}
?>

<?php
	$tg_footer_bg_img = get_theme_mod('tg_footer_bg_img');
	
	if(!empty($tg_footer_bg_img))
	{
?>
.footer_bar
{
	background-image: url('<?php echo esc_url($tg_content_bg_img); ?>');
	background-repeat: repeat;
}
<?php
	}
?>

<?php
	$tg_footer_copyright_alignment = get_theme_mod('tg_footer_copyright_alignment');
	
	if($tg_footer_copyright_alignment == 'center')
	{
?>
#copyright, #footer_menu, .footer_bar_wrapper .social_wrapper
{
	float: none;
	width: 100%;
	text-align: center;
}

.footer_bar_wrapper .social_wrapper ul
{
	text-align: center;
	margin: auto;
}

#footer_menu, .footer_bar_wrapper .social_wrapper
{
	margin-bottom: 10px;
}

.footer_bar_wrapper
{
	padding-top: 50px;
}

#copyright
{
	margin-bottom: 30px;
}

.footer_bar_wrapper .social_wrapper ul li
{
	float: none;
	display: inline-block;
}
<?php
	}
?>

<?php
	$tg_topbar_bg_color = get_theme_mod('tg_topbar_bg_color', '#cfa670');
	$ori_tg_topbar_bg_color = $tg_topbar_bg_color;
	
	if(!empty($tg_topbar_bg_color))
	{
		$tg_topbar_bg_color = HexToRGB($tg_topbar_bg_color);
?>
#wrapper.hasbg .above_top_bar
{
    background: <?php echo $ori_tg_topbar_bg_color; ?> !important;
	background: rgb(<?php echo $tg_topbar_bg_color['r']; ?>, <?php echo $tg_topbar_bg_color['g']; ?>, <?php echo $tg_topbar_bg_color['b']; ?>, 0.9) !important;
	background: rgba(<?php echo $tg_topbar_bg_color['r']; ?>, <?php echo $tg_topbar_bg_color['g']; ?>, <?php echo $tg_topbar_bg_color['b']; ?>, 0.9) !important;
}
<?php
	}
?>

<?php
if(THEMEDEMO)
{
?>
#option_btn
{
	position: fixed;
	top: 150px;
	right: -2px;
	cursor:pointer;
	z-index: 9;
	background: #fff;
	border-right: 0;
	width: 40px;
	padding: 10px 0 10px 0;
	height: 125px;
	text-align: center;
	border-radius: 5px 0px 0px 5px;
	box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
	line-height: 1.4;
}

#option_btn span
{
	font-size: 15px;
	line-height: 31px;
	color: #000;
}

#option_wrapper
{
	position: fixed;
	top: 0;
	right:-401px;
	width: 400px;
	background: #fff;
	z-index: 99999;
	font-size: 13px;
	box-shadow: -1px 1px 10px rgba(0, 0, 0, 0.1);
	overflow: auto;
	height: 100%;
}

#option_wrapper:hover
{
	overflow-y: auto;
}

#option_wrapper h6.demo_title
{
	font-size: 16px;
	font-weight: 600;
	letter-spacing: 0;
}

.demo_color_list
{
	list-style: none;
	display: block;
	margin: 30px 0 10px 0;
}

.demo_color_list > li
{
	display: inline-block;
	position: relative;
	width: 20%;
	height: auto;
	overflow: hidden;
	cursor: pointer;
	padding: 0;
	box-sizing: border-box;
	text-align: center;
	font-size: 11px;
	margin-bottom: 15px;
}

.demo_color_list > li .item_content_wrapper
{1
	width: 100%;
}

.demo_color_list > li .item_content_wrapper .item_content
{
	width: 100%;
	box-sizing: border-box;
}

.demo_color_list > li .item_content_wrapper .item_content .item_thumb
{
	width: 30px;
	height: 30px;
	position: relative;
	line-height: 0;
	border-radius: 250px;
	margin: auto;
}

.demo_label
{
	position: absolute;
	top: 10px;
	left: 10px;
	padding: 12px 15px 12px 15px;
	background: #FA4612;
	color: #fff;
	text-transform: uppercase;
	font-size: 11px;
	font-weight: 600;
	border-radius: 5px;
}

.demo_list
{
	list-style: none;
	display: block;
	float: left;
	margin: 30px 0 30px 0;
}

.demo_list li
{
	float: left;
	position: relative;
	margin-bottom: 24px;
	width: calc(50% - 12px);
	overflow: hidden;
	line-height: 0;
	box-shadow: 0px 1px 10px rgba(0,0,0,.1);
	border-radius: 10px;
}

.demo_list li:nth-child(2n) 
{
	float: right;
}

.demo_list li img
{
	max-width: 100%;
	height: auto;
	line-height: 0;
}

.demo_list li:hover img:not(.no_blur)
{
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
	-webkit-filter: blur(2px);
	filter: blur(2px);
	-moz-filter: blur(2px);
}

.demo_list li:hover .demo_thumb_hover_wrapper 
{
	opacity: 1;
}

.demo_thumb_hover_wrapper 
{
	background-color: rgba(0, 0, 0, 0.5);
	height: 100%;
	left: 0;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	top: 0;
	transition: opacity 0.4s ease-in-out;
	-o-transition: opacity 0.4s ease-in-out;
	-ms-transition: opacity 0.4s ease-in-out;
	-moz-transition: opacity 0.4s ease-in-out;
	-webkit-transition: opacity 0.4s ease-in-out;
	visibility: visible;
	width: 100%;
	line-height: normal;
}

.demo_thumb_hover_inner
{
	display: table;
	height: 100%;
	width: 100%;
	text-align: center;
	vertical-align: middle;
}

.demo_thumb_desc
{
	display: table-cell;
	height: 100%;
	text-align: center;
	vertical-align: middle;
	width: 100%;
	padding: 0 10% 0 10%;
	box-sizing: border-box;
}

.demo_thumb_hover_inner h6
{
	color: #fff !important;
	line-height: 22px;
	font-size: 16px;
	letter-spacing: 0;
}

.demo_thumb_desc .button.white
{
	margin-top: 5px;
	font-size: 14px !important;
	padding: .4em 2.5em .4em 2.5em;
}

.demo_thumb_desc .button.white:hover
{
	background: #fff !important;
	color: #000 !important;
	border-color: #fff !important;
}

#option_wrapper .inner
{
	padding: 20px;
	box-sizing: border-box;
	color: #000;
}

#option_wrapper .inner h5
{
	color: #000;
}

body.admin-bar #option_wrapper .inner
{
	padding-top: 70px;
}

#option_wrapper .demo_desc
{
	box-sizing: border-box;
	margin-top: 10px;
	padding: 0 10px 0 10px;
	font-size: 12px;
	opacity: 0.7;
	color: #000;
}

.demotip
{
	display: block;
}

.purchase_theme_button
{
	margin-bottom: 30px;
}

.purchase_theme_button .button
{
	background: #82B440 !important;
	border-color: #82B440 !important;
	color: #fff !important;
	width: 100%;
	box-sizing: border-box;
	font-weight: 600;
}

.themegoods-navigation-wrapper .nav li.megamenu > .elementor-megamenu-wrapper 
{
	overflow: scroll;
	max-height: 550px;
}

.showcase-grid .widget-image-caption.wp-caption-text
{
	font-weight: 600;
	font-size: 15px;
	opacity: 1;
	padding-bottom: 0;
	width: 100%;
}

@media only screen and (max-width: 767px) {
	#option_btn, #option_wrapper {
		display: none;
	}
}
<?php
}
?>

@media only screen and (max-width: 768px) {
	html[data-menu=leftmenu] .mobile_menu_wrapper
	{
		right: 0;
		left: initial;
		
		-webkit-transform: translate(400px, 0px);
		-ms-transform: translate(400px, 0px);
		transform: translate(400px, 0px);
		-o-transform: translate(400px, 0px);
	}
}

html[data-menu=leftmenu] .mobile_main_nav, #sub_menu
{
	clear: both;
}

html[data-menu=leftmenu] #wrapper
{
	padding-top: 0;
}
<?php
/**
*	Get custom CSS for Desktop View
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>

<?php
/**
*	Get custom CSS for iPad Portrait View
**/
$pp_custom_css_tablet_portrait = get_option('pp_custom_css_tablet_portrait');


if(!empty($pp_custom_css_tablet_portrait))
{
?>
@media only screen and (min-width: 768px) and (max-width: 959px) {
<?php
    echo stripslashes($pp_custom_css_tablet_portrait);
?>
}
<?php
}
?>

<?php
/**
*	Get custom CSS for iPhone Portrait View
**/
$pp_custom_css_mobile_portrait = get_option('pp_custom_css_mobile_portrait');


if(!empty($pp_custom_css_mobile_portrait))
{
?>
@media only screen and (max-width: 767px) {
<?php
    echo stripslashes($pp_custom_css_mobile_portrait);
?>
}
<?php
}
?>

<?php
/**
*	Get custom CSS for iPhone Landscape View
**/
$pp_custom_css_mobile_landscape = get_option('pp_custom_css_mobile_landscape');


if(!empty($pp_custom_css_tablet_portrait))
{
?>
@media only screen and (min-width: 480px) and (max-width: 767px) {
<?php
    echo stripslashes($pp_custom_css_mobile_landscape);
?>
}
<?php
}
?>

<?php
if(!empty($pp_advance_combine_css))
{
	ob_end_flush();
	ob_end_flush();
}
?>