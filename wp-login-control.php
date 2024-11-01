<?php
/*
Plugin Name: WP Login Control
Plugin URI: https://wplogincontrol.com
Description: This plugin allows you to visualy customize the appearance of the WordPress Login Screen.
Version: 2.0.0
Author: FORSYS SOFTWARE S.L.U.
Author URI: https://wplogincontrol.com
Text Domain: wp-login-control
Domain Path: /translations
License: GPL2
 
WP Login Control is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP Login Control is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with WP Login Control.
*/

// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) {
	die();
}


define( 'LOIN_CTRL_PLUGIN', __FILE__ );

define( 'LOIN_CTRL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( 'LOIN_CTRL_PLUGIN_NAME', trim( dirname( LOIN_CTRL_PLUGIN_BASENAME ), '/' ) );

define( 'LOIN_CTRL_PLUGIN_URL', plugins_url( "/", __FILE__ ) );

define( 'LOIN_CTRL_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

define( 'LOIN_CTRL_PLUGIN_URL_TEMP', plugins_url( "/", __FILE__ ) . 'temp');

define( 'LOIN_CTRL_PLUGIN_DIR_TEMP', plugin_dir_path( __FILE__ ) . 'temp');

define( 'LOIN_CTRL_PLUGIN_DOMAIN', LOIN_CTRL_PLUGIN_NAME);


if ( is_admin() ) {

	add_action('init', 'loin_ctrl_init');

    function loin_ctrl_init() {
        
        load_plugin_textdomain( LOIN_CTRL_PLUGIN_DOMAIN, false,  plugin_basename(dirname( __FILE__ ) ) . '/translations' ); 
        
    }

	$plugin_description = __('This plugin allows you to visualy customize the appearance of the WordPress Login Screen.',LOIN_CTRL_PLUGIN_DOMAIN);

	require_once( __DIR__ . '/classes/class.MySql.php');

	require_once( __DIR__ . '/admin/includes/sql-tables.php');


	$Wpfs_installer = new loin_ctrl_MySql( __FILE__, $WPfs_sql, "4.0.0" );

	require_once( __DIR__ . '/classes/class.menu.php');

	// render menu pages and subpages
	
	require_once( __DIR__ . '/admin/includes/render-menu.php');


	$WPfs_lc_menu = new loin_ctrl_menu( $parametros_menu, $parametros_submenu );


	//add_action('lc_designer','page_before',11);

	add_action('loin_ctrl_forms','loin_ctrl_FormsTable',11);

	require_once( __DIR__ ."/admin/includes/addons.php");

	require_once( __DIR__ ."/admin/includes/enqueue.php");
	require_once( __DIR__ ."/admin/includes/ajax_callback.php");
	require_once( __DIR__ ."/admin/includes/functions.php");

}

else{

	require_once( __DIR__ ."/admin/includes/addons.php");

	require_once( __DIR__ ."/public/includes/enqueue.php");
	require_once( __DIR__ ."/public/includes/functions.php");

	//used on front-end editor
	add_filter('show_admin_bar','__return_false');
	
}

?>