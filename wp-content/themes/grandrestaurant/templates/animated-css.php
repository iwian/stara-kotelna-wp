<?php 
	header("Content-Type: text/css");
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );

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
?>
.top_bar.fixed
{
	position: fixed;
	animation-name: fadeIn;
	-webkit-animation-name: fadeIn;	
	animation-duration: 0.5s;	
	-webkit-animation-duration: 0.5s;
	visibility: visible !important;
}
<?php
}
?>

<?php
	//Hack animation CSS for Safari
	$current_browser = getBrowser();
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	
	if($pp_animation)
	{
?>
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@-ms-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
 
.fade-in {
    animation-name: fadeIn;
	-webkit-animation-name: fadeIn;
	-ms-animation-name: fadeIn;	

	animation-duration: 0.7s;	
	-webkit-animation-duration: 0.7s;
	-ms-animation-duration: 0.7s;

	animation-timing-function: ease-out;	
	-webkit-animation-timing-function: ease-out;	
	-ms-animation-timing-function: ease-out;	

	-webkit-animation-fill-mode:forwards; 
    -moz-animation-fill-mode:forwards;
    -ms-animation-fill-mode:forwards;
    animation-fill-mode:forwards;
    
    visibility: visible !important;
}
<?php
	}
?>