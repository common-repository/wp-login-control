<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


$radius_translation = __("Radius",LOIN_CTRL_PLUGIN_DOMAIN);

$box_border_structure = '
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Border',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
<div class="fs-submenu-box">
<ul class="flex_container_out">
    <li>

            <h2>' . __('Corner Roundness',LOIN_CTRL_PLUGIN_DOMAIN) . '</h2>
            <br>
            <div id="border_square_wrap">
                <div id="border-top-left-radius" class="border_square option_selected"></div>
                <div id="border-top-right-radius" class="border_square option_selected"></div>  
                <div id="border-bottom-left-radius" class="border_square option_selected"></div>
                <div id="border-bottom-right-radius" class="border_square option_selected"></div>

                <div id="border-center-all-radius" class="border_square retweet"><i class="fa fa-retweet fa-2x" aria-hidden="true"></i></div>
            </div>  
            
<div id="all-radius" class="radius"></div>

        <div id="radius_" class="drop-wrap">

             <div id="radius-drop" class="combo-box">
                <div id="radius_Selected" data-slider="all-radius"><input class="combo-input" type="text" value="0px"></div>
                <div class="drop-container">
                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >px</div> 
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div>
                </div>
            </div>
        </div>


    </li>


  
    <li>  
        <br>
        <h2>' . __('Style',LOIN_CTRL_PLUGIN_DOMAIN) . '</h2>
        <br>
        <div style="display: inline-block;" id="external_wrap" class="border_square">
            <div id="style_square_wrap">
                <div id="border-top-style" class="border_square border_square_big option_selected"></div>
                <div id="border-right-style" class="border_square border_square_big option_selected"></div>  
                <div id="border-left-style" class="border_square border_square_big option_selected"></div>
                <div id="border-bottom-style" class="border_square border_square_big option_selected"></div>
                
                <div id="border-center-all-style" class="border_square retweet"><i class="fa fa-retweet fa-2x" aria-hidden="true"></i></div>
            </div>  
        </div>
         
        <div style="display: inline-block; margin-top: 18px;margin-left: 6px;" class="">

             <div id="style_box" class="style-drop">

                <div id="styleSelected" class="style-none"></div>
                <div id="btDownStyle" class="pivot-down"></div>

                <div class="style-container">
                    <div class="style-solid"></div>
                    <div class="style-none"></div>
                    <div class="style-dotted"></div>
                    <div class="style-dashed"></div>
                    <div class="style-double"></div>
                    <div class="style-groove"></div>
                    <div class="style-ridge"></div>
                    <div class="style-inset"></div>
                    <div class="style-outset"></div>
                </div>

            </div>
        </div>

    </li>
  
</ul>
</div>

';

	$box_border_array = array(
		'box_border_structure' => $box_border_structure,
        'radius_translation' => $radius_translation
	);

?>