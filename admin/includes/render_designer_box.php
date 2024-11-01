<?php
//Free version
// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


$render_designer_box_array = array(
    'title' => __("Please enter the name of the variable and type.",LOIN_CTRL_PLUGIN_DOMAIN),
    'button' => __("Done",LOIN_CTRL_PLUGIN_DOMAIN),
    'combo_type'  => '',
    'case_text' => '<span class="tooltiptext">' . __('Default',LOIN_CTRL_PLUGIN_DOMAIN) . '<input class="case-text"  data-obj-name="default" spellcheck="false"></input></span>',
    'contenteditable_structure' => '
    <h3 class="fs-menu">' . __('Text editor',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>
    <div style="border-width: 0; padding: 0;">
    <div id="edit-text-ok" class="img_icon_32"><i class="fa fa-check" aria-hidden="true"></i></div><div id="img_clear_text" class="img_icon_32"><i class="fa fa-trash" aria-hidden="true"></i></div>
        <div id="contenteditableBox" ></div>
    </div>
'

);

?>