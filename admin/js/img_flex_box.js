//"use strict";
jQuery(document).ready(function($) {


    $("#img_flex_box").click(function(ev){

       if ( ! $("#box_flex_box").length) {


            $("#img_code").after('<div id="box_flex_box" class="sub-tools"></div>'); 
            $("#box_flex_box").append( data_from_php_flex_box.box_flex_box_structure );

            $('body').append('<style>\
                #display_::before{content:"'+ data_from_php_flex_box.display +'"!important;}\
                #flex-direction_::before{content:"'+ data_from_php_flex_box.flex_direction +'"!important;}\
                #flex-wrap_::before{content:"'+ data_from_php_flex_box.flex_wrap +'"!important;}\
                #justify-content_::before{content:"'+ data_from_php_flex_box.justify_content +'"!important;}\
                #align-items_::before{content:"'+ data_from_php_flex_box.align_items +'"!important;}\
                #align-content_::before{content:"'+ data_from_php_flex_box.align_content +'"!important;}\
                #align-self_::before{content:"'+ data_from_php_flex_box.align_self +'"!important;}\
            </style>');

            $("#box_flex_box").css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );

            $('#box_flex_box').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
            $("h3.fs-submenu .fa-times").on("click", function(ev){
                $(this).parents("div:first").remove();
            });
            $('#box_flex_box').on("dragstart click", function(){ 
                $("h3.fs-submenu").parent("div").each(function() {
                    $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                });
                $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
            }); 



            $("#box_flex_box .drop-container").hide(); // hidden
            

            //********************************** test update css combos */

            updateCombos();

            //********************************** */
            $("#img_color_textshadow").on("click", function(ev){
                $("#img_color").trigger("click",["text_shadow"]);
            });

            
    } else {
        $("#box_flex_box").remove();
    }


    }); // end img_flex_box


});    // end ready

 