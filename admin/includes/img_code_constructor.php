<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


$code_structure = '
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('CSS editor',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
<div class="fs-submenu-box">

    <div class="switchcontainer" style="margin-bottom: 10px; margin-top: -10px;">
        <div class="onoffswitch">
            <input type="checkbox" name="activateCode" class="onoffswitch-checkbox" id="activateCode"> <!-- checked -->
            <label class="onoffswitch-label" for="activateCode">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        <div class="onofflabel" style="text-indent: 10px;">' . __('Append this code',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
    </div>
    <div id="img_update_code" class="img_icon img_icon_32"><i id="faimg" class="fa fa-refresh" aria-hidden="true"></i></div><div id="img_clear_code" class="img_icon img_icon_32"  style="position: absolute; width: 34px; height: 34px; right: 21px;"><i class="fa fa-trash" aria-hidden="true"></i></div>
    <textarea id="css_area" wrap="off" spellcheck="false" placeholder="Remember, this version does not check your code." rows="20" cols="100"></textarea>
</div>
';

	$code_array = array(
		'code_structure' => $code_structure,

	);


?>