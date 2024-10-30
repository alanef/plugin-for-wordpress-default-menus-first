<?php
/*
Plugin Name: Default Menus First
Plugin URI: https://github.com/alanef/plugin-for-wordpress-default-menus-first
GitHub Plugin URI: https://github.com/alanef/plugin-for-wordpress-default-menus-first
Update URI: https://github.com/alanef/plugin-for-wordpress-default-menus-first
Description: Ensures that WordPress Core Default Menus stay above any added by plugins
Version: 1.1
Author: Alan Fuller
Author URI: https://fullworksplugins.com
License: GPL2
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'admin_menu', function () {
	global $menu;
	$default_menus = array();
	$custom_menus  = array();

	// Separate default and custom menus
	foreach ( $menu as $key => $menu_item ) {
		if ( strpos( $menu_item[1], 'edit_' ) === 0 && ! in_array( $menu_item[1], array(
				'edit_posts',
				'edit_pages'
			) ) ) {
			$custom_menus[ $key ] = $menu_item;
		} else {
			$default_menus[ $key ] = $menu_item;
		}
	}

	//  loop backwards through
	krsort( $default_menus );
	$default_renumbered = array();
	$i=-5000;
	foreach ( $default_menus as $key => $menu_item ) {
		$default_renumbered[ $i ] = $menu_item;
		$i++;
	}
	$menu = $default_renumbered + $custom_menus;

}, 10, - 9999 );