<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

    require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/font-awesome.php');

$icons = "";

foreach ( $data_font_awesome as $key => $value ){
    $icons .= '<div id="' . $key . '" class="awesome-icons not_selectable" draggable="true" ondragstart="drag(event)" object="font_awesome_element"><i class="fa ' . $key . '" aria-hidden="true"></i></div>';
}

$font_awesome_structure = '
<h3 class="fs-submenu not_selectable" style="position: relative;"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Font Awesome 4.7 (675 icons)',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
<div class="fs-submenu-box">

    <div class="switchcontainer" class="not_selectable" style="margin-bottom: 10px; margin-top: -10px;">
        <div class="onoffswitch">
            <input type="checkbox" name="font_awesome_draggable_color" class="onoffswitch-checkbox" id="font_awesome_draggable_color"> <!-- checked -->
            <label class="onoffswitch-label" for="font_awesome_draggable_color">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        <div class="onofflabel" style="text-indent: 10px;">' . __('Invert default color',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
        <div class="awesome-sample-icon not_selectable" draggable="false"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>

    <div class="font-awesome-container">' . $icons . '</div>

</div>
';

	$font_awesome_array = array(
		'font_awesome_structure' => $font_awesome_structure,

	);


?>