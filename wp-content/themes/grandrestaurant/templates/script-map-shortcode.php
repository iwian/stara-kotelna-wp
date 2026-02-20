<?php
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
<?php
$marker = '{ ';
$marker.= 'MapOptions: { ';

$pp_googlemap_style = get_option('pp_googlemap_style');
if(!empty($pp_googlemap_style))
{
	$marker.= 'styles: '.stripslashes($pp_googlemap_style).',';
}
$marker.= ' }';
$marker.= ' }';

?>
jQuery(document).ready(function(){
	var mapType = jQuery("#map<?php echo esc_js($_GET['id']); ?>").attr('data-type');
	var mapZoom = jQuery("#map<?php echo esc_js($_GET['id']); ?>").attr('data-zoom');

	jQuery("#map<?php echo esc_js($_GET['id']); ?>").simplegmaps( {
		MapOptions: {
			scrollwheel: false,
			zoom: parseInt(mapZoom)
		}
	}); 
});
jQuery(document).ready(function(){ jQuery("#<?php echo esc_js($map_data['id']); ?>").simplegmaps(<?php echo $marker; ?>); });
<?php
if(isset($_GET['fullheight']) && $_GET['fullheight'] == 'true')
{
?>
jQuery(document).ready(function(){ 
	var mapHeight = jQuery("#<?php echo esc_js($map_data['id']); ?>").parent().parent().height();
	if(mapHeight>0)
	{
		jQuery("#<?php echo esc_js($map_data['id']); ?>").css('height', mapHeight+'px');
	}
});
<?php
}
?>