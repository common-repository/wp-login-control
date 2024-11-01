<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

	$mofile = LOIN_CTRL_PLUGIN_DIR . 'translations/'. LOIN_CTRL_PLUGIN_NAME . '-' . get_locale() . '.mo';
	$result = load_textdomain( LOIN_CTRL_PLUGIN_DOMAIN, $mofile );
	
    $parametros_menu = array( 	'page_title'	=>	__('Login Forms / Widgets', LOIN_CTRL_PLUGIN_DOMAIN),
								'menu_title'	=> 	__('Login Control', LOIN_CTRL_PLUGIN_DOMAIN),
								'menu_slug'		=>	'loin_ctrl_forms'
							);

	$parametros_submenu = array (

									array( 	'page_title'	=>	__('Login Forms / Widgets', LOIN_CTRL_PLUGIN_DOMAIN),
											'menu_title'	=> 	__('Forms', LOIN_CTRL_PLUGIN_DOMAIN),
											'menu_slug'		=>	'loin_ctrl_forms',
											'metaboxes'		=>	''
									),
									array( 	'page_title'	=>	__('Welcome to WP Login Control', LOIN_CTRL_PLUGIN_DOMAIN) . ' 2.0',
											'menu_title'	=> 	__('About', LOIN_CTRL_PLUGIN_DOMAIN),
											'menu_slug'		=>	'loin_ctrl_about',
											'metaboxes'		=>	array(
																		array (	'id' 			=>	'about_id_box',
																				'title'			=>	__('Introduction', LOIN_CTRL_PLUGIN_DOMAIN),	
																				'callback'		=> 	'loin_ctrl_about_box'

																			),
																		array (	'id' 			=>	'help_id_box',
																				'title'			=>	__('Help', LOIN_CTRL_PLUGIN_DOMAIN),	
																				'callback'		=> 	'loin_ctrl_help_box'

																			),
																		array (	'id' 			=>	'updates_id_box',
																				'title'			=>	__('Updates', LOIN_CTRL_PLUGIN_DOMAIN),	
																				'callback'		=> 	'loin_ctrl_updates_box'

																			)

			
																	)
									)	

				);


?>