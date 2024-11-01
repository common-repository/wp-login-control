//"use strict";
jQuery(document).ready(function($) {
    
    
        $("#img_text_font").click(function(ev){
    
           if ( ! $("#box_text_font").length) {
    
    
                $("#img_box_model").after('<div id="box_text_font" class="sub-tools"></div>'); 
                $("#box_text_font").append( data_from_php_text_font.box_text_font_structure );
    
                $('body').append('<style>#text-align_::before{content:"'+ data_from_php_text_font.align_translation +'"!important;}\
                #text-decoration_::before{content:"'+ data_from_php_text_font.decoration_translation +'"!important;}\
                #text-transform_::before{content:"'+ data_from_php_text_font.transform_translation +'"!important;}\
                #font-family_::before{content:"'+ data_from_php_text_font.family_translation +'"!important;}\
                #font-style_::before{content:"'+ data_from_php_text_font.style_translation +'"!important;}\
                #font-variant_::before{content:"'+ data_from_php_text_font.variant_translation +'"!important;}\
                #font-weight_::before{content:"'+ data_from_php_text_font.weight_translation +'"!important;}\
                #direction_::before{content:"'+ data_from_php_text_font.direction_translation +'"!important;}\
                #font-size_::before{content:"'+ data_from_php_text_font.size_translation +'"!important;}\
                #text-overflow_::before{content:"'+ data_from_php_text_font.overflow_translation +'"!important;}\
                #vertical-align_::before{content:"'+ data_from_php_text_font.verticalalign_translation +'"!important;}\
                #text-indent_::before{content:"'+ data_from_php_text_font.indent_translation +'"!important;}\
                #letter-spacing_::before{content:"'+ data_from_php_text_font.letterspacing_translation +'"!important;}\
                #line-height_::before{content:"'+ data_from_php_text_font.lineheight_translation +'"!important;}\
                #word-spacing_::before{content:"'+ data_from_php_text_font.wordspacing_translation +'"!important;}\
                #text-shadow_h::before{content:"'+ data_from_php_text_font.hshadow_translation +'"!important;}\
                #text-shadow_v::before{content:"'+ data_from_php_text_font.vshadow_translation +'"!important;}\
                #text-shadow_b::before{content:"'+ data_from_php_text_font.bshadow_translation +'"!important;}\
                #text-shadow_c::before{content:"'+ data_from_php_text_font.cshadow_translation +'"!important;}\
                #list-style-type_::before{content:"'+ data_from_php_text_font.type_translation +'"!important;}\
                #list-style-position_::before{content:"'+ data_from_php_text_font.position_translation +'"!important;}\
                #column-count_::before{content:"'+ data_from_php_text_font.count_translation +'"!important;}\
                #column-gap_::before{content:"'+ data_from_php_text_font.gap_translation +'"!important;}\
                #column-rule-style_::before{content:"'+ data_from_php_text_font.rule_style_translation +'"!important;}\
                #column-rule-width_::before{content:"'+ data_from_php_text_font.rule_width_translation +'"!important;}\
                #column-span_::before{content:"'+ data_from_php_text_font.span_translation +'"!important;}\
                </style>');
                $("#box_text_font").css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
    
                $('#box_text_font').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
                $("h3.fs-submenu .fa-times").on("click", function(ev){
                    $(this).parents("div:first").remove();
                });
                $('#box_text_font').on("dragstart click", function(){ 
                    $("h3.fs-submenu").parent("div").each(function() {
                        $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                    });
                    $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
                }); 
    
    
    
                $("#box_text_font .drop-container").hide(); // hidden
                
    
                //********************************** test update css combos */
    
                updateCombos();
    
                //********************************** */
                $("#img_color_textshadow").on("click", function(ev){
                    $("#img_color").trigger("click",["text_shadow"]);
                });
    
                $("#ButtonFontAwesome").on("click", function(ev){
                    if ( ! $("#box_font_awesome").length) {
                        $("#box_text_font").after('<div id="box_font_awesome" class="sub-tools"></div>'); //designArea
                        $("#box_font_awesome").append( data_from_php_font_awesome.font_awesome_structure );
                        $("#box_font_awesome").css("z-index", parseInt($("#box_text_font").css("z-index")) + parseInt(2) );
                        $("#box_font_awesome").offset({ top: window.innerHeight / 2 - $("#box_font_awesome").height() / 2, left: window.innerWidth / 2 - $("#box_font_awesome").width() / 2});
                        $('#box_font_awesome').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
    
                        $("h3.fs-submenu .fa-times").on("click", function(ev){
                            $(this).parents("div:first").remove();
                        });
                        $('#box_font_awesome').on("dragstart click", function(){ 
                            $("h3.fs-submenu").parent("div").each(function() {
                                $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                            });
                            $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
                        });
                        
                        $("#font_awesome_draggable_color").on("change", function(){
                            if ($(this).attr('checked')) {
                                 $(".awesome-sample-icon i").css("color", "white");
                            }
                            else{
                                $(".awesome-sample-icon i").css("color", "black");
                            }
                        });
                    }
                    else {
                        $("#box_font_awesome").remove();
                    }
                });
                
        } else {
            $("#box_text_font").remove();
        }
    
    
        }); // end img_text_font
    
    
    });    // end ready