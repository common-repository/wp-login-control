<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

$mofile = LOIN_CTRL_PLUGIN_DIR . 'translations/'. LOIN_CTRL_PLUGIN_NAME . '-' . get_locale() . '.mo';
$result = load_textdomain( LOIN_CTRL_PLUGIN_DOMAIN, $mofile );

$color_translation = __("Color",LOIN_CTRL_PLUGIN_DOMAIN);

$color_picker_structure = '
<div class="fs-submenu-box">
    <div id="colorpickerhook"></div>
    <div class="colopickerAdded">
        <div class="">
            <input id="background_option" type="radio" name="color-property-type" value="background" checked><label for="background_option">' . __('Background',LOIN_CTRL_PLUGIN_DOMAIN) . '</label>
            <br><input id="text_option" type="radio" name="color-property-type" value="text"><label for="text_option">' . __('Text',LOIN_CTRL_PLUGIN_DOMAIN) . '</label>
            <br><input id="border_option" type="radio" name="color-property-type" value="border"><label for="border_option">' . __('Border',LOIN_CTRL_PLUGIN_DOMAIN) . '</label>
            <br><input id="textshadow_option" type="radio" name="color-property-type" value="textshadow"><label for="textshadow_option">' . __('Text <br> Shadow',LOIN_CTRL_PLUGIN_DOMAIN) . '</label>
            <br><input id="boxshadow_option" type="radio" name="color-property-type" value="boxshadow"><label for="boxshadow_option">' . __('Box <br> Shadow',LOIN_CTRL_PLUGIN_DOMAIN) . '</label>
        </div>
        <div id="external_wrap" class="border_square" style="visibility:hidden;">
            <div id="color_square_wrap">
                <div id="border-top-color" class="border_square border_square_big option_selected"></div>
                <div id="border-right-color" class="border_square border_square_big option_selected"></div>
                <div id="border-left-color" class="border_square border_square_big option_selected"></div>
                <div id="border-bottom-color" class="border_square border_square_big option_selected"></div>
                <div id="border-center-all-color" class="border_square retweet"><i class="fa fa-retweet fa-2x" aria-hidden="true"></i></div>
            </div>
        </div>
        <div style="width:100%;margin-top:10px;"><input id="AllObject" type="checkbox" name="AllObject" value="AllObject"> ' . __('Whole object',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
        <div style="width:100%;" id="Opacity_text">' . __('Opacity',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
        <div style="width:28%"><input type="text" id="opacity" value="1" ></div>
        <div style="width:58%; margin-right: 5%; margin-left: 5%;"  id="color-opacity" class="radius"></div>
        <input type="radio" id="transparent" name="color-type" value="transparent" >' . __('Transparent',LOIN_CTRL_PLUGIN_DOMAIN) . ' <input id="solid" type="radio" name="color-type" value="solid" checked> ' . __('Solid',LOIN_CTRL_PLUGIN_DOMAIN) . ' 
    </div>
</div>
';

$color_picker_array = array(
    'color_picker_structure' => $color_picker_structure,
    'color_translation'  => $color_translation
);

?>