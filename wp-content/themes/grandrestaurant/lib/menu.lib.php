<?php
/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'grandrestaurant' ) );
	register_nav_menu( 'top-menu', __( 'Top Bar Menu', 'grandrestaurant' ) );
	register_nav_menu( 'side-menu', __( 'Side (Mobile) Menu', 'grandrestaurant' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'grandrestaurant' ) );
}

class GrandRestaurant_walker extends Walker_Nav_Menu {

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args=array(), &$output='') {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
            $element->classes[] = 'arrow'; //enter any classname you like here!
        }
        
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	    $object = $item->object;
    	$type = $item->type;
    	$title = $item->title;
    	$description = $item->description;
    	$permalink = $item->url;
    	$megamenu = get_post_meta( $item->ID, 'menu-item-megamenu', true );
    	
    	//If globally disable mega menu then remove
    	if(!GRANDRESTAURANT_MEGAMENU)
    	{
	    	$megamenu = '';
    	}
    	
	    $item_classes = '';
		if(is_array($item->classes)) {
			$item_classes = implode(" ", $item->classes);
		}
		else if(is_string($item->classes)) {
			$item_classes = $item->classes;
		}
		$output .= "<li class='" . $item_classes;
	    
	    if($depth == 0 && !empty($megamenu))
	    {
		    $output .= " elementor-megamenu megamenu arrow";
		}
		
		$output .= "'>";
	    
	    $output .= '<a href="'.esc_url($permalink).'" ';
	    
	    if(!empty($item->target)) {
	    	$output.= 'target="' . esc_attr( $item->target ) .'"';  
	    }
	    
	    $output .= '>'.$title;
		$output .= '</a>';
		
		if($depth == 0 && !empty($megamenu) && GRANDRESTAURANT_MEGAMENU)
	    {
		    if(!empty($megamenu) && class_exists("\\Elementor\\Plugin"))
			{
		    	$output .= '<div class="elementor-megamenu-wrapper"> '.grandrestaurant_get_elementor_content($megamenu).'</div>';
		    }
		}
	}
}
?>