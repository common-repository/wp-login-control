<?php
    // Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


    $error_message_translation = __("Name may consist of a-z, 0-9, underscores, spaces and must begin with a letter.",LOIN_CTRL_PLUGIN_DOMAIN);
    $new_form_translation = __("Create new form",LOIN_CTRL_PLUGIN_DOMAIN);
    $clone_form_translation = __("Clone form",LOIN_CTRL_PLUGIN_DOMAIN);
    $button_create_translation = __("Create form",LOIN_CTRL_PLUGIN_DOMAIN);
    $bitton_cancel_translation = __("Cancel",LOIN_CTRL_PLUGIN_DOMAIN);

    $dialog_array = array(
        'error_message_translation' => $error_message_translation,
        'new_form_translation'  => $new_form_translation,
        'clone_form_translation'  => $clone_form_translation,
        'button_create_translation'  => $button_create_translation,
        'button_cancel_translation'  => $bitton_cancel_translation,
        'working' => __("Working ...",LOIN_CTRL_PLUGIN_DOMAIN),
        'export' => __("Export All",LOIN_CTRL_PLUGIN_DOMAIN)
    );

?>