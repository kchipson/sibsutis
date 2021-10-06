<?php
/**
 * Custom Walker for Nav Menu Editor.
 *
 * @package    Orbit_Fox
 */

/**
 * Custom Walker for Nav Menu Editor.
 */
class Menu_Icons_OBFX_Walker extends Walker_Nav_Menu_Edit {

	/**
	 * Start the element output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Menu item args.
	 * @param int    $id     Nav menu ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		parent::start_el( $output, $item, $depth, $args, $id );
		$icon    = isset( $item->icon ) ? $item->icon : '';
		$output .= sprintf( '<input type="hidden" name="menu-item-icon[%d]" id="menu-item-icon-%d" value="%s">', $item->ID, $item->ID, $icon );
	}
}
