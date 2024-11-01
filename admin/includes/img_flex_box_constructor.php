<?php
//Free version
// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();
    
    $box_flex_box_structure = '
    <h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Flex container',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
    <div class="fs-submenu-box">
            <div id="display_" class="drop-wrap"> 
    
                 <div id="display-drop" class="combo-box">
                    <div id="display_Selected"></div>
                    <div class="drop-container">
                        <div id="display_flex" class="textline">' . __('Flex',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                        <div id="display_inline-flex" class="textline">' . __('Inline flex',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    </div>
                </div>
            </div>
    
            <div id="flex-direction_" class="drop-wrap">
    
                 <div id="flex-direction-drop" class="combo-box">
                    <div id="flex-direction_Selected"></div>
                    <div class="drop-container">
                        <div id="flex-direction_row" class="textline">' . __('Row',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                        <div id="flex-direction_row-reverse" class="textline">' . __('Row reverse',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                        <div id="flex-direction_column" class="textline">' . __('Column',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                        <div id="flex-direction_column-reverse" class="textline">' . __('Column reverse',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    </div>
                </div>
            </div>
       
    ';
    
    
    $box_flex_array = array(
        'box_flex_box_structure' => $box_flex_box_structure,
        'display'  => __("Display",LOIN_CTRL_PLUGIN_DOMAIN),
        'flex_direction' => __("Direction",LOIN_CTRL_PLUGIN_DOMAIN),
        'flex_wrap' => __("Wrap",LOIN_CTRL_PLUGIN_DOMAIN),
        'justify_content' => __("Justify",LOIN_CTRL_PLUGIN_DOMAIN),
        'align_items' => __("Align items",LOIN_CTRL_PLUGIN_DOMAIN),
        'align_content' => __("Align content",LOIN_CTRL_PLUGIN_DOMAIN),
        'align_self' => __("Align self",LOIN_CTRL_PLUGIN_DOMAIN)
    
    );
    
    ?>