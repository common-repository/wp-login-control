<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

$margin_translation = __("Margin",LOIN_CTRL_PLUGIN_DOMAIN);
$border_translation = __("Border",LOIN_CTRL_PLUGIN_DOMAIN);
$padding_translation = __("Padding",LOIN_CTRL_PLUGIN_DOMAIN);
$content_translation = __("Content",LOIN_CTRL_PLUGIN_DOMAIN);
$boxsizing_translation = __("Sizing",LOIN_CTRL_PLUGIN_DOMAIN);
$height_translation = __("Height",LOIN_CTRL_PLUGIN_DOMAIN);
$width_translation = __("Width",LOIN_CTRL_PLUGIN_DOMAIN);
$top_translation = __("Top",LOIN_CTRL_PLUGIN_DOMAIN);
$bottom_translation = __("Bottom",LOIN_CTRL_PLUGIN_DOMAIN);
$left_translation = __("Left",LOIN_CTRL_PLUGIN_DOMAIN);
$right_translation = __("Right",LOIN_CTRL_PLUGIN_DOMAIN);
$multiselection_translation = __("Box",LOIN_CTRL_PLUGIN_DOMAIN);
$clip_translation = __("Clip",LOIN_CTRL_PLUGIN_DOMAIN);

$box_model_structure = '
<h3 class="fs-submenu not_selectable" > <i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Box Model',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
<div class="fs-submenu-box">
                                <div class ="box_model" >
                                            <div id="box_model_margin" >
                                                <div id="_iboxes1" class="box_sel_top_container"><input type="text" id="margin-top_"  class="box_sel_top" name="1" readonly="readonly"> </div>
                                                <div id="_iboxes4" class="box_sel_bottom_container"><input type="text" id="margin-bottom_" class="box_sel_bottom" name="4" readonly="readonly">  </div>
                                                <div id="_iboxes5" class="box_sel_left_container"><input type="text" id="margin-left_" class="box_sel_left" name="5" readonly="readonly">  </div>
                                                <div id="_iboxes8" class="box_sel_right_container"><input type="text" id="margin-right_" class="box_sel_right" name="8" readonly="readonly">  </div>
                                                <div id="box_model_border" >
                                                    <div id="_iboxes11" class="box_sel_top_container"><input type="text" id="border-top-width_" class="box_sel_top" name="11" readonly="readonly">   </div>
                                                    <div id="_iboxes3" class="box_sel_bottom_container"><input type="text" id="border-bottom-width_" class="box_sel_bottom" name="3" readonly="readonly">   </div>
                                                    <div id="_iboxes6" class="box_sel_left_container"><input type="text" id="border-left-width_" class="box_sel_left" name="6" readonly="readonly">  </div>
                                                    <div id="_iboxes9" class="box_sel_right_container"><input type="text" id="border-right-width_" class="box_sel_right" name="9" readonly="readonly">  </div>
                                                    <div id="box_model_padding" >
                                                            <div id="_iboxes111" class="box_sel_top_container"><input type="text" id="padding-top_" class="box_sel_top" name="111" readonly="readonly">  </div>
                                                            <div id="_iboxes2" class="box_sel_bottom_container"><input type="text" id="padding-bottom_" class="box_sel_bottom" name="2" readonly="readonly"> </div>
                                                            <div id="_iboxes7" class="box_sel_left_container"><input type="text" id="padding-left_" class="box_sel_left" name="7" readonly="readonly">  </div>
                                                            <div id="_iboxes10" class="box_sel_right_container"><input type="text" id="padding-right_" class="box_sel_right" name="10" readonly="readonly">  </div>
                                                            <div id="box_model_content" ></div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
              
                    <br>


        <div id="multiselection_" class="drop-wrap no-css-recover">

             <div id="multiselection-drop" class="combo-box">
                <div id="multiselection_Selected" data-slider="slider-values"><input class="combo-input"  spellcheck="false" type="text" value="0px"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div class="textline editable text-start">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable text-start">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

<div id="slider-values"></div>

</div>

<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down fa-caret-right" aria-hidden="true"></i>' . __('Box size',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa float_right" aria-hidden="true"></i></h3>

<div class="fs-submenu-box hide_no_space">

        <div id="box-sizing_" class="drop-wrap">

             <div id="box-sizing-drop" class="combo-box">
                <div id="box-sizing_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">
                    <div id="box-sizing_content-box" class="textline">' . __('Content box',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-sizing_border-box" class="textline">' . __('Border box',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-sizing_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-sizing_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="height_" class="drop-wrap">

             <div id="height-drop" class="combo-box">
                <div id="height_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="height_auto" class="textline">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="height_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="height_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>


        <div id="width_" class="drop-wrap">

             <div id="width-drop" class="combo-box">
                <div id="width_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="width_auto" class="textline">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="width_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="width_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>
</div>

<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down fa-caret-right" aria-hidden="true"></i>' . __('Box position',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa float_right" aria-hidden="true"></i></h3>

<div class="fs-submenu-box hide_no_space">

        <div id="top_" class="drop-wrap">

             <div id="top-drop" class="combo-box">
                <div id="top_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="top_auto" class="textline">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="top_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="top_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="bottom_" class="drop-wrap">

             <div id="bottom-drop" class="combo-box">
                <div id="bottom_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="bottom_auto" class="textline">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="bottom_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="bottom_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="left_" class="drop-wrap">

             <div id="left-drop" class="combo-box">
                <div id="left_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="left_auto" class="textline">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="left_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="left_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="right_" class="drop-wrap">

             <div id="right-drop" class="combo-box">
                <div id="right_Selected"><input class="combo-input" type="text" spellcheck="false"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="right_auto" class="textline">' . __('Auto',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="right_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="right_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>
</div>

<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down fa-caret-right" aria-hidden="true"></i>' . __('Background',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa float_right" aria-hidden="true"></i></h3>

<div class="fs-submenu-box hide_no_space">

        <div id="background-clip_" class="drop-wrap">

             <div id="background-clip-drop" class="combo-box">
                <div id="background-clip_Selected" class="has-icons"></div>
                <div class="drop-container">
                    <div id="background-clip_border-box" class="textline">' . __('Border box',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="background-clip_padding-box" class="textline">' . __('Padding box',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="background-clip_content-box" class="textline">' . __('Content box',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="background-clip_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="background-clip_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>
</div>

<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down fa-caret-right" aria-hidden="true"></i>' . __('Box Shadow',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>
<div class="fs-submenu-box hide_no_space">      
        <div id="box-shadow_h" class="drop-wrap">

             <div id="bhshadow-drop" class="combo-box">
                <div id="bhshadow_Selected"><input class="combo-input" type="text" value="0px"></div>
                <div class="drop-container">
                    
                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="box-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="box-shadow_v" class="drop-wrap no-css-recover">

             <div id="bvshadow-drop" class="combo-box">
                <div id="bvshadow_Selected"><input class="combo-input" type="text" value="0px"></div>
                <div class="drop-container">
                    
                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="box-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="box-shadow_b" class="drop-wrap no-css-recover">

             <div id="bbshadow-drop" class="combo-box">
                <div id="bbshadow_Selected"><input class="combo-input" type="text" value="0px"></div>
                <div class="drop-container">
                    
                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >%</div> 
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="box-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="box-shadow_c" class="drop-wrap no-css-recover">

             <div id="bcshadow-drop" class="combo-box">
                <div id="bcshadow_Selected" class="has-icons"><i class="shadow_color">Black</i></div>
                <div class="drop-container">
                    
                    <div class="textline disabled">' . __('Color Names',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                        <div class="textline shadow_color_option" >AliceBlue</div> 
                        <div class="textline shadow_color_option" >AntiqueWhite</div>
                        <div class="textline shadow_color_option" >Aqua</div>
                        <div class="textline shadow_color_option" >Aquamarine</div>
                        <div class="textline shadow_color_option" >Azure</div>
                        <div class="textline shadow_color_option" >Beige</div>
                        <div class="textline shadow_color_option" >Bisque</div>
                        <div class="textline shadow_color_option" >Black</div>
                        <div class="textline shadow_color_option" >BlanchedAlmond</div>
                        <div class="textline shadow_color_option" >BlueViolet</div>
                        <div class="textline shadow_color_option" >Brown</div>
                        <div class="textline shadow_color_option" >BurlyWood</div>
                        <div class="textline shadow_color_option" >CadetBlue</div>
                        <div class="textline shadow_color_option" >Chartreuse</div>
                        <div class="textline shadow_color_option" >Chocolate</div>
                        <div class="textline shadow_color_option" >Coral</div>
                        <div class="textline shadow_color_option" >CornflowerBlue</div>
                        <div class="textline shadow_color_option" >Cornsilk</div>
                        <div class="textline shadow_color_option" >Crimson</div>
                        <div class="textline shadow_color_option" >Cyan</div>
                        <div class="textline shadow_color_option" >DarkBlue</div>
                        <div class="textline shadow_color_option" >DarkCyan</div>
                        <div class="textline shadow_color_option" >DarkGoldenRod</div>
                        <div class="textline shadow_color_option" >DarkGray</div>
                        <div class="textline shadow_color_option" >DarkGrey</div>
                        <div class="textline shadow_color_option" >DarkGreen</div>
                        <div class="textline shadow_color_option" >DarkKhaki</div>
                        <div class="textline shadow_color_option" >DarkMagenta</div>
                        <div class="textline shadow_color_option" >DarkOliveGreen</div>
                        <div class="textline shadow_color_option" >DarkOrange</div>
                        <div class="textline shadow_color_option" >DarkOrchid</div>
                        <div class="textline shadow_color_option" >DarkRed</div>
                        <div class="textline shadow_color_option" >DarkSalmon</div>
                        <div class="textline shadow_color_option" >DarkSeaGreen</div>
                        <div class="textline shadow_color_option" >DarkSlateBlue</div>
                        <div class="textline shadow_color_option" >DarkSlateGray</div>
                        <div class="textline shadow_color_option" >DarkSlateGrey</div>
                        <div class="textline shadow_color_option" >DarkTurquoise</div>
                        <div class="textline shadow_color_option" >DarkViolet</div>
                        <div class="textline shadow_color_option" >DeepPink</div>
                        <div class="textline shadow_color_option" >DeepSkyBlue</div>
                        <div class="textline shadow_color_option" >DimGray</div>
                        <div class="textline shadow_color_option" >DimGrey</div>
                        <div class="textline shadow_color_option" >DodgerBlue</div>
                        <div class="textline shadow_color_option" >FireBrick</div>
                        <div class="textline shadow_color_option" >FloralWhite</div>
                        <div class="textline shadow_color_option" >ForestGreen</div>
                        <div class="textline shadow_color_option" >Fuchsia</div>
                        <div class="textline shadow_color_option" >Gainsboro</div>
                        <div class="textline shadow_color_option" >GhostWhite</div>
                        <div class="textline shadow_color_option" >GoldenRod</div>
                        <div class="textline shadow_color_option" >Gray</div>
                        <div class="textline shadow_color_option" >Grey</div>
                        <div class="textline shadow_color_option" >GreenYellow</div>
                        <div class="textline shadow_color_option" >HoneyDew</div>
                        <div class="textline shadow_color_option" >HotPink</div>
                        <div class="textline shadow_color_option" >IndianRed</div>
                        <div class="textline shadow_color_option" >Indigo</div>
                        <div class="textline shadow_color_option" >Ivory</div>
                        <div class="textline shadow_color_option" >Khaki</div>
                        <div class="textline shadow_color_option" >Lavender</div>
                        <div class="textline shadow_color_option" >LavenderBlush</div>
                        <div class="textline shadow_color_option" >LawnGreen</div>
                        <div class="textline shadow_color_option" >LemonChiffon</div>
                        <div class="textline shadow_color_option" >LightBlue</div>
                        <div class="textline shadow_color_option" >LightCoral</div>
                        <div class="textline shadow_color_option" >LightCyan</div>
                        <div class="textline shadow_color_option" >LightGoldenRodYellow</div>
                        <div class="textline shadow_color_option" >LightGray</div>
                        <div class="textline shadow_color_option" >LightGrey</div>
                        <div class="textline shadow_color_option" >LightGreen</div>
                        <div class="textline shadow_color_option" >LightPink</div>
                        <div class="textline shadow_color_option" >LightSalmon</div>
                        <div class="textline shadow_color_option" >LightSeaGreen</div>
                        <div class="textline shadow_color_option" >LightSkyBlue</div>
                        <div class="textline shadow_color_option" >LightSlateGray</div>
                        <div class="textline shadow_color_option" >LightSteelBlue</div>
                        <div class="textline shadow_color_option" >LightYellow</div>
                        <div class="textline shadow_color_option" >Lime</div>
                        <div class="textline shadow_color_option" >LimeGreen</div>
                        <div class="textline shadow_color_option" >Linen</div>
                        <div class="textline shadow_color_option" >Magenta</div>
                        <div class="textline shadow_color_option" >Maroon</div>
                        <div class="textline shadow_color_option" >MediumAquaMarine</div>
                        <div class="textline shadow_color_option" >MediumBlue</div>
                        <div class="textline shadow_color_option" >MediumOrchid</div>
                        <div class="textline shadow_color_option" >MediumPurple</div>
                        <div class="textline shadow_color_option" >MediumSeaGreen</div>
                        <div class="textline shadow_color_option" >MediumSlateBlue</div>
                        <div class="textline shadow_color_option" >MediumSpringGreen</div>
                        <div class="textline shadow_color_option" >MediumTurquoise</div>
                        <div class="textline shadow_color_option" >MediumVioletRed</div>
                        <div class="textline shadow_color_option" >MidnightBlue</div>
                        <div class="textline shadow_color_option" >MintCream</div>
                        <div class="textline shadow_color_option" >MistyRose</div>
                        <div class="textline shadow_color_option" >Moccasin</div>
                        <div class="textline shadow_color_option" >NavajoWhite</div>
                        <div class="textline shadow_color_option" >Navy</div>
                        <div class="textline shadow_color_option" >OldLace</div>
                        <div class="textline shadow_color_option" >Olive</div>
                        <div class="textline shadow_color_option" >OliveDrab</div>
                        <div class="textline shadow_color_option" >Orange</div>
                        <div class="textline shadow_color_option" >OrangeRed</div>
                        <div class="textline shadow_color_option" >Orchid</div>
                        <div class="textline shadow_color_option" >PaleGoldenRod</div>
                        <div class="textline shadow_color_option" >PaleGreen</div>
                        <div class="textline shadow_color_option" >PaleTurquoise</div>
                        <div class="textline shadow_color_option" >PaleVioletRed</div>
                        <div class="textline shadow_color_option" >PapayaWhip</div>
                        <div class="textline shadow_color_option" >PeachPuff</div>
                        <div class="textline shadow_color_option" >Peru</div>
                        <div class="textline shadow_color_option" >Pink</div>
                        <div class="textline shadow_color_option" >Plum</div>
                        <div class="textline shadow_color_option" >PowderBlue</div>
                        <div class="textline shadow_color_option" >Purple</div>
                        <div class="textline shadow_color_option" >RebeccaPurple</div>
                        <div class="textline shadow_color_option" >Red</div>
                        <div class="textline shadow_color_option" >RosyBrown</div>
                        <div class="textline shadow_color_option" >RoyalBlue</div>
                        <div class="textline shadow_color_option" >SaddleBrown</div>
                        <div class="textline shadow_color_option" >Salmon</div>
                        <div class="textline shadow_color_option" >SandyBrown</div>
                        <div class="textline shadow_color_option" >SeaGreen</div>
                        <div class="textline shadow_color_option" >SeaShell</div>
                        <div class="textline shadow_color_option" >Sienna</div>
                        <div class="textline shadow_color_option" >Silver</div>
                        <div class="textline shadow_color_option" >SkyBlue</div>
                        <div class="textline shadow_color_option" >SlateBlue</div>
                        <div class="textline shadow_color_option" >SlateGray</div>
                        <div class="textline shadow_color_option" >SlateGrey</div>
                        <div class="textline shadow_color_option" >Snow</div>
                        <div class="textline shadow_color_option" >SpringGreen</div>
                        <div class="textline shadow_color_option" >SteelBlue</div>
                        <div class="textline shadow_color_option" >Tan</div>
                        <div class="textline shadow_color_option" >Teal</div>
                        <div class="textline shadow_color_option" >Thistle</div>
                        <div class="textline shadow_color_option" >Tomato</div>
                        <div class="textline shadow_color_option" >Turquoise</div>
                        <div class="textline shadow_color_option" >Violet</div>
                        <div class="textline shadow_color_option" >Wheat</div>
                        <div class="textline shadow_color_option" >White</div>
                        <div class="textline shadow_color_option" >WhiteSmoke</div>
                        <div class="textline shadow_color_option" >Yellow</div>
                        <div class="textline shadow_color_option" >YellowGreen</div>
                       



                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="box-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="img_color_textshadow_box" class="img_icon">
            <i class="fa fa-tint" aria-hidden="true"></i>
        </div>
<br>
</div>
';

$box_model_array = array(
    'box_model_structure' => $box_model_structure,
    'margin_translation'  => $margin_translation,
    'border_translation'  => $border_translation,
    'padding_translation' => $padding_translation,
    'content_translation' => $content_translation,
    'boxsizing_translation' => $boxsizing_translation,
    'height_translation' => $height_translation,
    'width_translation' => $width_translation,
    'top_translation' => $top_translation,
    'bottom_translation' => $bottom_translation,
    'left_translation' => $left_translation,
    'right_translation' => $right_translation,
    'multiselection_translation' => $multiselection_translation,
    'clip_translation' => $clip_translation,
    'horitzontal_translation' => __("Horitzontal",LOIN_CTRL_PLUGIN_DOMAIN),
    'vertical_translation' => __("Vertical",LOIN_CTRL_PLUGIN_DOMAIN),
    'blur_translation' => __("Blur",LOIN_CTRL_PLUGIN_DOMAIN),
    'color_translation' => __("Color",LOIN_CTRL_PLUGIN_DOMAIN)

);

?>