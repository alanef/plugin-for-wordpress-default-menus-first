<?php
/*
Plugin Name: Default Menus First
Plugin URI: https://github.com/alanef/plugin-for-wordpress-default-menus-first
GitHub Plugin URI: https://github.com/alanef/plugin-for-wordpress-default-menus-first
Update URI: https://github.com/alanef/plugin-for-wordpress-default-menus-first
Description: Ensures that WordPress Core Default Menus stay above any added by plugins
Version: 1.0
Author: Alan Fuller
Author URI: https://fullworksplugins.com
License: GPL2
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'admin_menu', function () {
	global $menu;
	$sorted = array();
	foreach ( $menu as $key => $menu_item ) {
		if ( strpos( $menu_item[1], 'edit_' ) === 0 && ! in_array( $menu_item[1], array(
				'edit_posts',
				'edit_pages'
			) ) ) {
			$sorted[ $key ] = $menu_item;
		} else {
			$sorted[ $key - 50000 ] = $menu_item;
		}
	}
	ksort( $sorted );
	$menu = $sorted;
}, 10, - 9999 );