//"use strict";
jQuery(document).ready(function($) {

    $("#img_box_model").click(function(ev){

       if ( ! $("#box_model").length) {  

            $("#img_box_model").after('<div id="box_model" class="sub-tools"></div>'); 
            $("#box_model").append( data_from_php_model.box_model_structure );
            $('body').append('<style>#box_model_margin::before{content:"'+ data_from_php_model.margin_translation +'"!important;}\
                        #box_model_border::before{content:"'+ data_from_php_model.border_translation +'"!important;}\
                        #box_model_padding::before{content:"'+ data_from_php_model.padding_translation +'"!important;}\
                        #box_model_content::before{content:"'+ data_from_php_model.content_translation +'"!important;}\
                        #box-sizing_::before{content:"'+ data_from_php_model.boxsizing_translation +'"!important;}\
                        #height_::before{content:"'+ data_from_php_model.height_translation +'"!important;}\
                        #width_::before{content:"'+ data_from_php_model.width_translation +'"!important;}\
                        #top_::before{content:"'+ data_from_php_model.top_translation +'"!important;}\
                        #bottom_::before{content:"'+ data_from_php_model.bottom_translation +'"!important;}\
                        #left_::before{content:"'+ data_from_php_model.left_translation +'"!important;}\
                        #right_::before{content:"'+ data_from_php_model.right_translation +'"!important;}\
                        #multiselection-drop::before{content:"'+ data_from_php_model.multiselection_translation +'"!important;}\
                        #background-clip_::before{content:"'+ data_from_php_model.clip_translation +'"!important;}\
                        #box-shadow_h::before{content:"'+ data_from_php_model.horitzontal_translation +'"!important;}\
                        #box-shadow_v::before{content:"'+ data_from_php_model.vertical_translation +'"!important;}\
                        #box-shadow_b::before{content:"'+ data_from_php_model.blur_translation +'"!important;}\
                        #box-shadow_c::before{content:"'+ data_from_php_model.color_translation +'"!important;}\
                        </style>');
            $("#box_model").css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );

            $('#box_model').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
            $("h3.fs-submenu .fa-times").on("click", function(ev){
                $(this).parents("div:first").remove();
            });
            $('#box_model').on("dragstart click", function(){ 
                $("h3.fs-submenu").parent("div").each(function() {
                    $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                });
                $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
            }); 

            $("#slider-values").slider({ // model box
                orientation: "horizontal",
                range: "min",
                max: 100,
                value: 0,
                slide: refreshBox,
                change: refreshBox
            });
            $("#slider-values" ).slider("value",0); // inicializamos a 0

                 //change colors to boxes selection
            $( ".box_model input[type=text]" ).click(function(ev) {
                $(this).toggleClass("box_sel");
            //  $( "#box-values").val($(this).val());
                if ($(this).hasClass("box_sel")) $(".selected-boxes" ).slider("value",( $( "#box-values").val() > $(this).val()) ? $( "#box-values").val() : $(this).val() ); 
                
                ev.stopPropagation();
            });

            $("#box_model_margin, #box_model_border, #box_model_padding").click(function(ev) {
                $("#" + this.id + " > div").find(" > input[type=text]").toggleClass("box_sel");
                ev.stopPropagation();
            });   

            $("#box_model .drop-container").hide(); // hidden

            updateCombos();

            $("#img_color_textshadow_box").on("click", function(ev){
                $("#img_color").trigger("click",["box_shadow"]);
            });
        } else {
            $("#box_model").remove();
        }


     }); // end img_box_model


});    // end ready

 

function refreshBox(event,ui) {

    let regex = /[^\.\d]+/;
    let match = regex.exec(jQuery("#multiselection_Selected .combo-input").val());

    jQuery(".edit-icons").trigger("reposition");
    
    jQuery(".box_sel").val(ui.value);
    jQuery("#multiselection_Selected .combo-input").val(ui.value + match);

    let box_new_object = {};

    jQuery(".box_sel").each(function () {

        let box_sel_id = this.id;

        let box_sel_data_id_css = box_sel_id.slice(0,box_sel_id.indexOf("_"));
        let box_sel_data_id = box_sel_data_id_css.replace(/-/g,"_");

        jQuery( ".selected" ).each(function(){

            withoutcss_set_unset ( this, box_sel_data_id_css, box_sel_data_id);
            
            jQuery( this ).css(box_sel_data_id_css, jQuery("#" + box_sel_id).val() + jQuery( "#multiselection_ input" ).val().replace(/[0-9]/g,"") );//jQuery("#Units-values" + " option:selected").text() ); //#slider-values
            
            box_new_object[box_sel_data_id] = jQuery("#" + box_sel_id).val() + jQuery( "#multiselection_ input" ).val().replace(/[0-9]/g,"");//jQuery("#Units-values" + " option:selected").text();
            jQuery.extend( jQuery(this).data(jQuery('#hoverButton').data("mode")), box_new_object );
        });    

     //   jQuery(".selected:first").trigger("UpdateCodeBox");
        
    });

}