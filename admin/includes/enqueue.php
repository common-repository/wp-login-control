<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


if(is_admin()){ 


	function loin_ctrl_enqueue_pages($hook) { 
		

        global $WPfs_lc_menu;

        if ( in_array( $hook, $WPfs_lc_menu->slug_to_hook( array('loin_ctrl_forms') ) ) ) {  //,'loin_ctrl_forms'

            wp_register_script( 'loin_ctrl_dialog_enqueue', LOIN_CTRL_PLUGIN_URL . 'admin/js/dialog.js', array('jquery','jquery-ui-dialog'));

            require_once( __DIR__ . '/dialog_translate.php');

            wp_localize_script( 'loin_ctrl_dialog_enqueue', 'data_from_php_dialog', $dialog_array );

            wp_enqueue_script('loin_ctrl_dialog_enqueue');

            wp_enqueue_style('loin_ctrl_font-awesome',  LOIN_CTRL_PLUGIN_URL . 'admin/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all'); // local
            wp_enqueue_style('login');
            wp_enqueue_style('loin_ctrl_dialog-css',  LOIN_CTRL_PLUGIN_URL . 'admin/css/dialog.css', false, null); // local
            
          
            do_action('loin_ctrl_enqueue_forms');
        }
        
        if ( in_array( $hook, $WPfs_lc_menu->slug_to_hook( array('loin_ctrl_about') ) ) ) {

            wp_enqueue_style('loin_ctrl_about_css',  LOIN_CTRL_PLUGIN_URL . 'admin/css/about.css', false, null);
            wp_enqueue_style('loin_ctrl_font-awesome',  LOIN_CTRL_PLUGIN_URL . 'admin/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all'); // local

        }

	}

	add_action("admin_enqueue_scripts", "loin_ctrl_enqueue_pages");

}

?>