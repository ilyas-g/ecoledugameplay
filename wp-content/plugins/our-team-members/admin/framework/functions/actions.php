<?php
if (! defined ( 'ABSPATH' )) {
	die ();
} // Cannot access pages directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *         
 */
if (! function_exists ( 'wpsf_get_icons' )) {
	function wpsf_get_icons() {
		do_action ( 'wpsf_add_icons_before' );
		
		$jsons = apply_filters ( 'wpsf_add_icons_json', glob ( WPSF_DIR . '/fields/icon/*.json' ) );
		
		if (! empty ( $jsons )) {
			
			foreach ( $jsons as $path ) {
				
				$object = wpsf_get_icon_fonts ( 'fields/icon/' . basename ( $path ) );
				
				if (is_object ( $object )) {
					
					echo (count ( $jsons ) >= 2) ? '<h4 class="wpsf-icon-title">' . esc_html($object->name) . '</h4>' : '';
					
					foreach ( $object->icons as $icon ) {
						echo '<a class="wpsf-icon-tooltip" data-wpsf-icon="' . esc_attr($icon) . '" data-title="' . esc_attr($icon) . '"><span class="wpsf-icon wpsf-selector"><i class="' . esc_attr($icon) . '"></i></span></a>';
					}
				} else {
					echo '<h4 class="wpsf-icon-title">' . esc_html__ ( 'Error! Can not load json file.', 'our-team-members' ) . '</h4>';
				}
			}
		}
		
		do_action ( 'wpsf_add_icons' );
		do_action ( 'wpsf_add_icons_after' );
		
		die ();
	}
	add_action ( 'wp_ajax_wpsf-get-icons', 'wpsf_get_icons' );
}


/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *         
 */
if (! function_exists ( 'wpsf_set_icons' )) {
	function wpsf_set_icons() {
		echo '<div id="wpsf-icon-dialog" class="wpsf-dialog" title="' . esc_html__ ( 'Add Icon', 'our-team-members' ) . '" style="display:none">';
		echo '<div class="wpsf-dialog-header wpsf-text-center"><input type="text" placeholder="' . esc_html__ ( 'Search a Icon...', 'our-team-members' ) . '" class="wpsf-icon-search" /></div>';
		echo '<div class="wpsf-dialog-load"><div class="wpsf-icon-loading">' . esc_html__ ( 'Loading...', 'our-team-members' ) . '</div></div>';
		echo '</div>';
	}
	add_action ( 'admin_footer', 'wpsf_set_icons' );
	add_action ( 'customize_controls_print_footer_scripts', 'wpsf_set_icons' );
}
