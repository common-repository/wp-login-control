<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

//not_selectable -> VOD no select this class

function loin_ctrl_make_contextual_menu(){
    ?>
        <div id="contextual_menu_container" class="not_selectable"></div>
    <?php 
}

function loin_ctrl_make_icons_menu(){
    ?>
        <div id="icons_menu_container" class="not_selectable">

            <i class="fa fa-wrench" aria-hidden="true" data-toolbox-id="designer_box"></i>
            <i class="fa fa-picture-o" aria-hidden="true" data-toolbox-id="elements_box"></i>
            <i class="fa fa-tags" aria-hidden="true" data-toolbox-id="tags_box"></i>
            <i class="fa fa-compress" aria-hidden="true" data-toolbox-id="replaceCode_box"></i>
            <i class="fa fa-floppy-o" id="img_save" aria-hidden="true"></i>
            <i class="fa fa-tachometer" id="img_administrator_back" onclick="window.location='<?php echo admin_url() . 'admin.php?page=loin_ctrl_forms' ?>'" aria-hidden="true"></i>

        </div>
    <?php 
}

function loin_ctrl_make_toolbar(){
    ?>
        


    <div id="designer_box" class="designer_tool not_selectable">    

            <h3 class="fs-menu"><i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp<?php esc_html_e('Tools',LOIN_CTRL_PLUGIN_DOMAIN )?><i class="fa fa-window-minimize float_right" aria-hidden="true"></i></h3>
            <div>
                
                <div id="img_color" class="img_icon"><i class="fa fa-tint" aria-hidden="true"></i></div>
                <div id="img_text_font" class="img_icon"><i class="fa fa-font" aria-hidden="true"></i></div>
                <div id="img_box_model" class="img_icon"><i class="fa fa-cube" aria-hidden="true"></i></div>
                <div id="img_box_border" class="img_icon"><i class="fa fa-square-o" aria-hidden="true"></i></div>
                <div id="img_flex_box" class="img_icon"><i class="fa fa-plus-square-o" aria-hidden="true"></i></div>
                <div id="img_code" class="img_icon"><i class="fa fa-code" aria-hidden="true"></i></div>
                <div id="img_flip_horizontal" class="img_icon"><i class="fa fa-share" aria-hidden="true"></i></div>
                <div id="img_flip_vertical" class="img_icon"><i class="fa fa-share fa-rotate-90" aria-hidden="true"></i></div>
                <div id="img_toggle" class="img_icon"><i class="fa fa-toggle-on" aria-hidden="true"></i></div>
                <div id="img_marker" class="img_icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <!--<div id="img_trash" class="img_icon" ondrop="drop_delete(event)" ondragover="dragover_handler(event)"><i class="fa fa-trash" aria-hidden="true"></i></div> -->
                <img id="img_path" style="display: none;" src=<?php echo LOIN_CTRL_PLUGIN_URL . 'admin/images/w-logo-blue.png'; ?> width="0" height="0">  
                <!-- <br><br> -->

                <div class="switchcontainer">
                    <div class="onofflabel">Hover</div>
                    <div class="onoffswitch">
                        <input type="checkbox" name="hoverButton" class="onoffswitch-checkbox" id="hoverButton"> <!-- checked -->
                        <label class="onoffswitch-label" for="hoverButton">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                    <br>
                    <div class="onofflabel patternButton_part">Pattern</div>
                    <div class="onoffswitch patternButton_part">
                        <input type="checkbox" name="patternButton" class="onoffswitch-checkbox" id="patternButton" checked> <!-- checked -->
                        <label class="onoffswitch-label" for="patternButton">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                    <br>
            
                    <div style="margin-top:10px;"><?php _e('Position when creating',LOIN_CTRL_PLUGIN_DOMAIN) ?></div>
                    <div id="obj-pos-on-creation_" class="drop-wrap">

                            <div id="obj-pos-on-creation-drop" class="combo-box">
                            <div id="obj-pos-on-creation_Selected"><i><?php _e('Absolute',LOIN_CTRL_PLUGIN_DOMAIN) ?></i></div>
                            <div class="drop-container" style="display:none;">
                                <div id="obj-pos-on-creation_static" class="textline"><?php _e('Static',LOIN_CTRL_PLUGIN_DOMAIN) ?> </div>
                                <div id="obj-pos-on-creation_absolute" class="textline"><?php _e('Absolute',LOIN_CTRL_PLUGIN_DOMAIN) ?> </div>
                                <div id="obj-pos-on-creation_fixed" class="textline"><?php _e('Fixed',LOIN_CTRL_PLUGIN_DOMAIN) ?> </div>
                                <div id="obj-pos-on-creation_relative" class="textline"><?php _e('Relative',LOIN_CTRL_PLUGIN_DOMAIN) ?> </div>
                            </div>
                        </div>
                    </div>

                    <div class="Temporarily_hide">
                        <span class="onofflabel">Retina</span>
                        <div class="onoffswitch">
                            <input type="checkbox" name="retinaswitch" class="onoffswitch-checkbox" id="retinaswitch"> <!-- checked -->
                            <label class="onoffswitch-label" for="retinaswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <label id="target_selected"></label>
                <br>
            </div>
        
    </div>

        
    <?php 
}

    	
function loin_ctrl_img_icons_box(){
		?>
    <div id="elements_box" class="designer_tool not_selectable">
            

            <h3 class="not_selectable fs-menu"><i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp<?php esc_html_e('Images - Icons',LOIN_CTRL_PLUGIN_DOMAIN)?><i class="fa fa-window-minimize float_right" aria-hidden="true"></i><i class="fa fa-folder-open float_right media-button" aria-hidden="true"></i></h3>

            <div class="icons-container not_selectable">
            
            </div>    

    </div>
    <?php
}

function loin_ctrl_tags_box(){
		?>
    <div id="tags_box" class="designer_tool not_selectable">
            

            <h3 class="not_selectable fs-menu"><i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-tags" aria-hidden="true"></i>&nbsp<?php esc_html_e('Tags',LOIN_CTRL_PLUGIN_DOMAIN)?><i class="fa fa-window-minimize float_right" aria-hidden="true"></i></h3>

            <div class="not_selectable">

                <div id="tag_div" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    DIV
                </div>
                <div id="tag_span" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    SPAN
                </div>
                <div id="tag_p" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    P
                </div>
                <div id="tag_label" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    LABEL
                </div>
                <div id="tag_hr" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    HR
                </div>
                <div id="tag_h1" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    H1 - H6
                </div>
                <div id="tag_a" draggable="true" ondragstart="drag(event)" object="tag_element" class="not_selectable">
                    A
                </div>
            <!--    <div id="tag_chart" draggable="true" ondragstart="drag(event)" object="chart_addon" class="not_selectable">
                    CHART
                </div>
        -->     
                <?php 
                $add_tags = '';
                $add_tags = apply_filters( 'loin_ctrl_tag_filter', $add_tags );
                echo $add_tags;                
                ?>
            </div>    

    </div>
    <?php
}

function loin_ctrl_replaceCode_box(){
    ?>
    <div id="replaceCode_box" class="designer_tool not_selectable">
            

            <h3 class="not_selectable fs-menu"><i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-compress" aria-hidden="true"></i>&nbsp<?php esc_html_e('Variables',LOIN_CTRL_PLUGIN_DOMAIN)?><i class="fa fa-window-minimize float_right" aria-hidden="true"></i></h3>

            <div class="not_selectable">
                <div id="add_variable" draggable="false" class="not_selectable">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                </div>
                <div id="replacecode_content" draggable="true" ondragstart="drag(event)" object="replacecode_element" class="not_selectable">
                    content
                </div>
        
            </div>    

    </div>
<?php
}