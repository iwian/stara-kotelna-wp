<?php
function grandrestaurant_theme_load() {
	load_theme_textdomain( 'grandrestaurant', get_template_directory().'/languages' );
}
add_action( 'init', 'grandrestaurant_theme_load' );
?>