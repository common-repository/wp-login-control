<?php
//Free version
// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

$str = file_get_contents( LOIN_CTRL_PLUGIN_DIR . '/public/GoogleFonts/json/sort_alpha.json',true);
$json = json_decode($str, true); // decode the JSON into an associative array
$google_fonts = "";

foreach ($json['items'] as $val ){
        $count = 0;
        $string_family = str_replace(" ", ".", $val['family'], $count);
        if ( $count > 0 ) $string_family = "!" . $string_family . "!";
        $google_fonts .= '<div id="font-family_' . $string_family . '" class="textline google-font">' . $val['family'] . ' <span style="pointer-events:none;float:right;font-size:24;font-family:'. $val['family'] .';">Lorem Ipsum</span></div>'; //$value->family
}

$align_translation = __("Align",LOIN_CTRL_PLUGIN_DOMAIN);
$decoration_translation = __("Decoration",LOIN_CTRL_PLUGIN_DOMAIN);
$transform_translation = __("Transform",LOIN_CTRL_PLUGIN_DOMAIN);
$family_translation = __("Family",LOIN_CTRL_PLUGIN_DOMAIN);
$style_translation = __("Style",LOIN_CTRL_PLUGIN_DOMAIN);
$variant_translation = __("Variant",LOIN_CTRL_PLUGIN_DOMAIN);
$weight_translation = __("Weight",LOIN_CTRL_PLUGIN_DOMAIN);
$direction_translation = __("Direction",LOIN_CTRL_PLUGIN_DOMAIN);
$size_translation = __("Size",LOIN_CTRL_PLUGIN_DOMAIN);
$overflow_translation = __("Overflow",LOIN_CTRL_PLUGIN_DOMAIN);
$indent_translation = __("Indent",LOIN_CTRL_PLUGIN_DOMAIN);
$letterspacing_translation = __("Letter&nbsp;Spacing",LOIN_CTRL_PLUGIN_DOMAIN);
$lineheight_translation = __("Line Height",LOIN_CTRL_PLUGIN_DOMAIN);
$wordspacing_translation = __("Word&nbsp;Spacing",LOIN_CTRL_PLUGIN_DOMAIN);
$hshadow_translation = __("Horitzontal",LOIN_CTRL_PLUGIN_DOMAIN);
$vshadow_translation = __("Vertical",LOIN_CTRL_PLUGIN_DOMAIN);
$bshadow_translation = __("Blur",LOIN_CTRL_PLUGIN_DOMAIN);
$cshadow_translation = __("Color",LOIN_CTRL_PLUGIN_DOMAIN);


$box_text_font_structure = '
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Text',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
<div class="fs-submenu-box">
        <div id="text-align_" class="drop-wrap"> 

             <div id="align-drop" class="combo-box">
                <div id="align_Selected" class="has-icons"></div>
                <div class="drop-container">
                    <div><i id="text-align_left" class="fa fa-align-left " aria-hidden="true"></i></div>
                    <div><i id="text-align_right" class="fa fa-align-right " aria-hidden="true"></i></div>
                    <div><i id="text-align_center" class="fa fa-align-center " aria-hidden="true"></i></div>
                    <div><i id="text-align_justify" class="fa fa-align-justify " aria-hidden="true"></i></div>
                    <div id="text-align_start" class="textline">' . __('Start',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-align_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-align_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="text-decoration_" class="drop-wrap">

             <div id="decoration-drop" class="combo-box">
                <div id="decoration_Selected" class="has-icons"></div>
                <div class="drop-container">
                    <div><i id="text-decoration_none" class="fa fa-ban " aria-hidden="true"></i></div>
                    <div><i id="text-decoration_overline" class="fa fa-underline fa-rotate-180 " aria-hidden="true"></i></div>
                    <div><i id="text-decoration_line-through" class="fa fa-strikethrough " aria-hidden="true"></i></div>
                    <div><i id="text-decoration_underline" class="fa fa-underline " aria-hidden="true"></i></div>
                    <div id="text-decoration_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-decoration_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="line-height_" class="drop-wrap">

             <div id="height-drop" class="combo-box">
                <div id="height_Selected"><input class="combo-input" type="text"></div>
                <div class="drop-container">

                    <div class="textline disabled">' . __('Absolute Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable">px</div>
                    <div class="textline editable">cm</div>
                    <div class="textline editable" >mm</div>       
                    <div class="textline editable" >in</div>
                    <div class="textline editable" >pt</div>
                    <div class="textline editable" >pc</div>     
                    <div class="textline disabled"><br>' . __('Relative Lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div class="textline editable" >vw</div>
                    <div class="textline editable" >vh</div>
                    <div class="textline disabled"><br>' . __('Other lengths',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                    <div id="line-height_normal" class="textline">' . __('Normal',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="line-height_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="line-height_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

<br>
</div>
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Text Shadow',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>
<div class="fs-submenu-box">      
        <div id="text-shadow_h" class="drop-wrap">

             <div id="hshadow-drop" class="combo-box">
                <div id="hshadow_Selected"><input class="combo-input" type="text" value="0px"></div>
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

                    <div id="text-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="text-shadow_v" class="drop-wrap no-css-recover">

             <div id="vshadow-drop" class="combo-box">
                <div id="vshadow_Selected"><input class="combo-input" type="text" value="0px"></div>
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

                    <div id="text-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="text-shadow_b" class="drop-wrap no-css-recover">

             <div id="bshadow-drop" class="combo-box">
                <div id="bshadow_Selected"><input class="combo-input" type="text" value="0px"></div>
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

                    <div id="text-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="text-shadow_c" class="drop-wrap no-css-recover">

             <div id="cshadow-drop" class="combo-box">
                <div id="cshadow_Selected" class="has-icons"><i class="shadow_color">Black</i></div>
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
                    <div id="text-shadow_none" class="textline">' . __('None',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="text-shadow_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

        <div id="img_color_textshadow" class="img_icon">
            <i class="fa fa-tint" aria-hidden="true"></i>
        </div>
<br>
</div>
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Font',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>
<div class="fs-submenu-box">
        <div id="font-family_" class="drop-wrap">

             <div id="family-drop" class="combo-box">
                <div id="family_Selected"></div>
                <div class="drop-container">
                    <div id="font-family_Arial,.sans-serif" class="textline">Arial, sans-serif</div>
                    <div id="font-family_Helvetica,.sans-serif" class="textline">Helvetica, sans-serif</div>
                    <div id="font-family_Verdana,.sans-serif" class="textline">Verdana, sans-serif</div>
                    <div id="font-family_!Trebuchet.MS!,.sans-serif" class="textline">Trebuchet MS, sans-serif</div>
                    <div id="font-family_!Gill.Sans!,.sans-serif" class="textline">Gill Sans, sans-serif</div>
                    <div id="font-family_Avantgarde,.sans-serif" class="textline">Avantgarde, sans-serif</div>
                    <div id="font-family_!Arial.Narrow!,.sans-serif" class="textline">Arial Narrow, sans-serif</div>
                    <div id="font-family_Impact,.sans-serif" class="textline">Impact, sans-serif</div>
                    <div id="font-family_Charcoal,.sans-serif" class="textline">Charcoal, sans-serif</div>
                    <div id="font-family_sans-serif" class="textline">sans-serif</div>

                    <div id="font-family_Times,.serif" class="textline">Times, serif</div>
                    <div id="font-family_!Times.New.Roman!,.serif" class="textline">Times New Roman, serif</div>
                    <div id="font-family_Georgia,.serif" class="textline">Georgia, serif</div>
                    <div id="font-family_Palatino,.serif" class="textline">Palatino, serif</div>
                    <div id="font-family_Bookman,.serif" class="textline">Bookman, serif</div>
                    <div id="font-family_!New.Century.Schoolbook!,.serif" class="textline">New Century Schoolbook, serif</div>
                    <div id="font-family_serif" class="textline">serif</div>

                    <div id="font-family_!Andale.Mono!,.monospace" class="textline">Andale Mono, monospace</div>
                    <div id="font-family_!Courier.New!,.monospace" class="textline">Courier New, monospace</div>
                    <div id="font-family_Courier,.monospace" class="textline">Courier, monospace</div>
                    <div id="font-family_FreeMono,.monospace" class="textline">FreeMono, monospace</div>
                    <div id="font-family_!OCR.A.Std!,.monospace" class="textline">OCR A Std, monospace</div>
                    <div id="font-family_monospace" class="textline">monospace</div>

                    <div id="font-family_!Comic.Sans.MS!,.Comic.Sans,.cursive" class="textline">Comic Sans MS, Comic Sans, cursive</div>
                    <div id="font-family_!Apple.Chancery!,.cursive" class="textline">Apple Chancery, cursive</div>
                    <div id="font-family_!Caflisch.Script.Pro!,.cursive" class="textline">Caflisch Script Pro, cursive</div>
                    <div id="font-family_!Brush.Script.Std!,.!Brush.Script.MT!,.cursive" class="textline">Brush Script Std, Brush Script MT, cursive</div>
                    <div id="font-family_!Snell.Roundhand!,.cursive" class="textline">Snell Roundhand, cursive</div>
                    <div id="font-family_cursive" class="textline">cursive</div>

                    <div id="font-family_Impact,.fantasy" class="textline">Impact, fantasy</div>
                    <div id="font-family_Chalkduster,.fantasy" class="textline">Chalkduster, fantasy</div>
                    <div id="font-family_!Jazz.LET!,.fantasy" class="textline">Jazz LET, fantasy</div>
                    <div id="font-family_Blippo,.fantasy" class="textline">Blippo, fantasy</div>
                    <div id="font-family_!Stencil.Std!,.fantasy" class="textline">Stencil Std, fantasy</div>
                    <div id="font-family_fantasy" class="textline">fantasy</div>
                    '.
                    
                    $google_fonts
                    
                    .'
                    <div id="font-family_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-family_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>

                </div>
            </div>
        </div>

        <div id="font-size_" class="drop-wrap">

             <div id="size-drop" class="combo-box">
                <div id="size_Selected"><input class="combo-input" type="text"></div>
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

                    <div id="font-size_medium" class="textline">' . __('Medium',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_xx-small" class="textline">' . __('xx-small',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_x-small" class="textline">' . __('Extra small',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_small" class="textline">' . __('Small',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_large" class="textline">' . __('Large',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_x-large" class="textline">' . __('Extra large',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_xx-large" class="textline">' . __('xx-large',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_smaller" class="textline">' . __('smaller than parent',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_larger" class="textline">' . __('larger than parent',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_initial" class="textline">' . __('Initial',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                    <div id="font-size_inherit" class="textline">' . __('Inherit',LOIN_CTRL_PLUGIN_DOMAIN) . '</div>
                </div>
            </div>
        </div>

</div>
<h3 id="ButtonFontAwesome" class="button-h3 not_selectable"><i class="fa fa-flag" aria-hidden="true"></i>' . __('Font Awesome',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>

';


$text_font_array = array(
    'box_text_font_structure' => $box_text_font_structure,
    'align_translation'  => $align_translation,
    'decoration_translation' => $decoration_translation,
    'transform_translation' => $transform_translation,
    'family_translation' => $family_translation,
    'style_translation' => $style_translation,
    'variant_translation' => $variant_translation,
    'weight_translation' => $weight_translation,
    'direction_translation' => $direction_translation,
    'size_translation' => $size_translation,
    'overflow_translation' => $overflow_translation,
    'indent_translation' => $indent_translation,
    'letterspacing_translation' => $letterspacing_translation,
    'lineheight_translation' => $lineheight_translation,
    'wordspacing_translation' => $wordspacing_translation,
    'hshadow_translation' => $hshadow_translation,
    'vshadow_translation' => $vshadow_translation,
    'bshadow_translation' => $bshadow_translation,
    'cshadow_translation' => $cshadow_translation

);

?>