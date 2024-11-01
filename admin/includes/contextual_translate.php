<?php
// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


    $Position_translation = __("Position",LOIN_CTRL_PLUGIN_DOMAIN);
    $Static_translation = __("Static",LOIN_CTRL_PLUGIN_DOMAIN);
    $Absolute_translation = __("Absolute",LOIN_CTRL_PLUGIN_DOMAIN);
    $Relative_translation = __("Relative",LOIN_CTRL_PLUGIN_DOMAIN);
    $Fixed_translation = __("Fixed",LOIN_CTRL_PLUGIN_DOMAIN);
    $Inherit_translation = __("Inherit",LOIN_CTRL_PLUGIN_DOMAIN);
    $asbackground_translation = __("As Background",LOIN_CTRL_PLUGIN_DOMAIN);
    $remove_property = __("Remove property",LOIN_CTRL_PLUGIN_DOMAIN);

    $Overflow_translation = __("Overflow",LOIN_CTRL_PLUGIN_DOMAIN);
    $Visible_translation = __("Visible",LOIN_CTRL_PLUGIN_DOMAIN);
    $Hidden_translation = __("Hidden",LOIN_CTRL_PLUGIN_DOMAIN);
    $Scroll_translation = __("Scroll",LOIN_CTRL_PLUGIN_DOMAIN);
    $Auto_translation = __("Auto",LOIN_CTRL_PLUGIN_DOMAIN);

    $Background_translation = __("Background image",LOIN_CTRL_PLUGIN_DOMAIN);
    
    $Blend_mode_translation = __("Blend mode",LOIN_CTRL_PLUGIN_DOMAIN);
    $Normal_translation = __("Normal",LOIN_CTRL_PLUGIN_DOMAIN);
    $Multiply_translation = __("Multipy",LOIN_CTRL_PLUGIN_DOMAIN);
    $Screen_translation = __("Screen",LOIN_CTRL_PLUGIN_DOMAIN);
    $Overlay_translation = __("Overlay",LOIN_CTRL_PLUGIN_DOMAIN);
    $Darken_translation =__("Darken",LOIN_CTRL_PLUGIN_DOMAIN);
    $Lighten_translation = __("Lighten",LOIN_CTRL_PLUGIN_DOMAIN);
    $Color_dodge_translation = __("Color dodge",LOIN_CTRL_PLUGIN_DOMAIN);
    $Saturation_translation = __("Saturation",LOIN_CTRL_PLUGIN_DOMAIN);
    $Color_translation = __("Color",LOIN_CTRL_PLUGIN_DOMAIN);
    $Luminosity_translation = __("Luminosity",LOIN_CTRL_PLUGIN_DOMAIN);

    $Left_top_translation = __("Left top",LOIN_CTRL_PLUGIN_DOMAIN);
    $Left_center_translation = __("Left center",LOIN_CTRL_PLUGIN_DOMAIN);
    $Left_bottom_translation = __("Left bottom",LOIN_CTRL_PLUGIN_DOMAIN);
    $Right_top_translation = __("Right top",LOIN_CTRL_PLUGIN_DOMAIN);
    $Right_center_translation = __("Right center",LOIN_CTRL_PLUGIN_DOMAIN);
    $Right_bottom_translation = __("Right bottom",LOIN_CTRL_PLUGIN_DOMAIN);
    $Center_top_translation = __("Center top",LOIN_CTRL_PLUGIN_DOMAIN);
    $Center_translation = __("Center",LOIN_CTRL_PLUGIN_DOMAIN);
    $Center_bottom_translation = __("Center bottom",LOIN_CTRL_PLUGIN_DOMAIN);
    $Initial_translation = __("Initial",LOIN_CTRL_PLUGIN_DOMAIN);
    $Xpos_translation = __("X",LOIN_CTRL_PLUGIN_DOMAIN);
    $Ypos_translation = __("Y",LOIN_CTRL_PLUGIN_DOMAIN);
    $Absolute_Lengths = __("Absolute Lengths",LOIN_CTRL_PLUGIN_DOMAIN);
    $Relative_Lengths = __("Relative Lengths",LOIN_CTRL_PLUGIN_DOMAIN);
    $Other_Lengths = __("Other lengths",LOIN_CTRL_PLUGIN_DOMAIN);
    $Custom = __("Custom",LOIN_CTRL_PLUGIN_DOMAIN);

    $Size_translation = __("Size",LOIN_CTRL_PLUGIN_DOMAIN);
    $Cover_translation = __("Cover",LOIN_CTRL_PLUGIN_DOMAIN);
    $Contain_translation = __("Contain",LOIN_CTRL_PLUGIN_DOMAIN);
    $SizeWidth_translation = __("Width",LOIN_CTRL_PLUGIN_DOMAIN);
    $SizeHeight_translation = __("Height",LOIN_CTRL_PLUGIN_DOMAIN);

    $Repetition_translation = __("Repetition",LOIN_CTRL_PLUGIN_DOMAIN);
    $Repeat_translation = __("Repeat",LOIN_CTRL_PLUGIN_DOMAIN);
    $Repetition_x_translation = __("Reapet x",LOIN_CTRL_PLUGIN_DOMAIN);
    $Repetition_y_translation = __("Reapet y",LOIN_CTRL_PLUGIN_DOMAIN);
    $No_repeat_translation = __("No repeat",LOIN_CTRL_PLUGIN_DOMAIN);

    $Attachment_translation = __("Attachment",LOIN_CTRL_PLUGIN_DOMAIN);
    $Local_translation = __("Local",LOIN_CTRL_PLUGIN_DOMAIN);

    $Origin_translation = __("Origin",LOIN_CTRL_PLUGIN_DOMAIN);
    $Padding_box_translation = __("Padding Box",LOIN_CTRL_PLUGIN_DOMAIN);
    $Border_box_translation = __("Border Box",LOIN_CTRL_PLUGIN_DOMAIN);
    $Content_box_translation =  __("Content Box",LOIN_CTRL_PLUGIN_DOMAIN);

    $Remove_translation = __("Remove",LOIN_CTRL_PLUGIN_DOMAIN);
    $Delete_translation = __("Delete",LOIN_CTRL_PLUGIN_DOMAIN);
    $Set_none_translation = __("None",LOIN_CTRL_PLUGIN_DOMAIN);

    $Parent_translation = __("Parent",LOIN_CTRL_PLUGIN_DOMAIN);


    $contextual_array = array(
        'position' => $Position_translation,
        'static' => $Static_translation,
        'absolute'  => $Absolute_translation,
        'relative'  => $Relative_translation,
        'fixed'  => $Fixed_translation,
        'inherit'  => $Inherit_translation,
        'asbackground' => $asbackground_translation,
        'remove_property' => $remove_property,

        'overflow' => $Overflow_translation,
        'visible'  => $Visible_translation,
        'hidden'  => $Hidden_translation,
        'scroll'  => $Scroll_translation,
        'auto'  => $Auto_translation,


        'blend_mode' => $Blend_mode_translation,
        'normal' => $Normal_translation,
        'multiply' => $Multiply_translation,
        'screen' => $Screen_translation,
        'overlay' => $Overlay_translation,
        'darken' => $Darken_translation,
        'lighten' => $Lighten_translation,
        'color_dodge' => $Color_dodge_translation,
        'saturation' => $Saturation_translation,
        'color' => $Color_translation,
        'luminosity' => $Luminosity_translation,

        'size' => $Size_translation,
        'cover' => $Cover_translation,
        'contain' => $Contain_translation,
        'sizewidth' => $SizeWidth_translation,
        'sizeheight' => $SizeHeight_translation,  

        'background' => $Background_translation,

 
        'left_top'  => $Left_top_translation,
        'left_center' => $Left_center_translation,
        'left_bottom' => $Left_bottom_translation,

        'right_top' => $Right_top_translation,
        'right_center' => $Right_center_translation,
        'right_bottom' => $Right_bottom_translation,

        'center_top' => $Center_top_translation,
        'center'  => $Center_translation,
        'center_bottom' => $Center_bottom_translation,

        'initial' => $Initial_translation,
        'xpos' => $Xpos_translation,
        'ypos' => $Ypos_translation,
        'absolute_lengths' => $Absolute_Lengths,
        'relative_lengths' => $Relative_Lengths,
        'other_lengths' => $Other_Lengths,
        'custom' => $Custom,


        'repetition'  => $Repetition_translation,
        'repeat'  => $Repeat_translation,
        'repeat_x' => $Repetition_x_translation,
        'repeat_y' => $Repetition_y_translation,
        'no_repeat'  => $No_repeat_translation,
        'attachment' => $Attachment_translation,
        'local' => $Local_translation,
        'origin' => $Origin_translation,
        'padding_box' => $Padding_box_translation,
        'border_box' => $Border_box_translation,
        'content_box' => $Content_box_translation,
        'remove'  => $Remove_translation,
        'delete'  => $Delete_translation,
        'set_none'  => $Set_none_translation,
        
        'parent'  => $Parent_translation,
        'select' => __("Select",LOIN_CTRL_PLUGIN_DOMAIN),
        'add_to_selected' => __("Add to selected",LOIN_CTRL_PLUGIN_DOMAIN),
        'remove_from_delected' => __("Remove from selected",LOIN_CTRL_PLUGIN_DOMAIN),
 
        'display' => __("Display",LOIN_CTRL_PLUGIN_DOMAIN),  
        'inline' => __("Inline",LOIN_CTRL_PLUGIN_DOMAIN),
        'block' => __("Block",LOIN_CTRL_PLUGIN_DOMAIN),
        'flex' => __("Flex",LOIN_CTRL_PLUGIN_DOMAIN),
        'inline_block' => __("Inline block",LOIN_CTRL_PLUGIN_DOMAIN),
        'inline_flex' => __("Inline flex",LOIN_CTRL_PLUGIN_DOMAIN),
        'inline_table' => __("Inline table",LOIN_CTRL_PLUGIN_DOMAIN),
        'list_item' => __("List item",LOIN_CTRL_PLUGIN_DOMAIN),
        'run_in' => __("Run in",LOIN_CTRL_PLUGIN_DOMAIN),
        'table' => __("Table",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_caption' => __("Table caption",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_column_group' => __("Table column group",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_header_group' => __("Table header group",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_footer_group' => __("Table footer group",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_row_group' => __("Table row group",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_cell' => __("Table cell",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_column' => __("Table Column",LOIN_CTRL_PLUGIN_DOMAIN),
        'table_row' => __("Table row",LOIN_CTRL_PLUGIN_DOMAIN),
        'none' => __("None",LOIN_CTRL_PLUGIN_DOMAIN),
        'float' => __("Float",LOIN_CTRL_PLUGIN_DOMAIN),
        'clear' => __("Clear",LOIN_CTRL_PLUGIN_DOMAIN),
        'top' => __("Top",LOIN_CTRL_PLUGIN_DOMAIN),
        'bottom' => __("Bottom",LOIN_CTRL_PLUGIN_DOMAIN),
        'left' => __("Left",LOIN_CTRL_PLUGIN_DOMAIN),
        'right' => __("Right",LOIN_CTRL_PLUGIN_DOMAIN),
        'both' => __("Both",LOIN_CTRL_PLUGIN_DOMAIN),
        'width' => __("Width",LOIN_CTRL_PLUGIN_DOMAIN),
        'height' => __("Height",LOIN_CTRL_PLUGIN_DOMAIN),
        'box_shadow' => __("Box Shadow",LOIN_CTRL_PLUGIN_DOMAIN),
        'text_shadow' => __("Text Shadow",LOIN_CTRL_PLUGIN_DOMAIN),
        'box_sizing' => __("Box Sizing",LOIN_CTRL_PLUGIN_DOMAIN),
        'margin_top' => __("Margin Top",LOIN_CTRL_PLUGIN_DOMAIN),
        'show_contextual_menu' => __("Contextual menu",LOIN_CTRL_PLUGIN_DOMAIN),
        'background_color' => __("Background color",LOIN_CTRL_PLUGIN_DOMAIN),
        'margin_bottom' => __("Margin bottom",LOIN_CTRL_PLUGIN_DOMAIN),
        'margin_left' => __("Margin left",LOIN_CTRL_PLUGIN_DOMAIN),
        'margin_right' => __("Margin right",LOIN_CTRL_PLUGIN_DOMAIN),
        'padding_top' => __("Padding top",LOIN_CTRL_PLUGIN_DOMAIN),
        'padding_bottom' => __("Padding bottom",LOIN_CTRL_PLUGIN_DOMAIN),
        'padding_left' => __("Padding left",LOIN_CTRL_PLUGIN_DOMAIN),
        'padding_right' => __("Padding right",LOIN_CTRL_PLUGIN_DOMAIN),
        'border_top_width' => __("Border top width",LOIN_CTRL_PLUGIN_DOMAIN),
        'border_bottom_width' => __("Border bottom width",LOIN_CTRL_PLUGIN_DOMAIN),
        'border_left_width' => __("Border left width",LOIN_CTRL_PLUGIN_DOMAIN),
        'border_right_width' => __("Border right width",LOIN_CTRL_PLUGIN_DOMAIN)

    );

?>