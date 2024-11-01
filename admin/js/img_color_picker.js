//"use strict";

var first_change_load;

jQuery(document).ready(function($) {


    $("#designer_box").mousedown(function(ev){ ev.stopPropagation(); }); //si no no podemos hacer click

    $("#img_color").click(function(ev, param1){
        
    if ( ! $("#box_color").length) {   

            first_change_load = true;

            $("#img_box_model").after('<div id="box_color" class="sub-tools"><h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' + data_from_php_color.color_translation + '<i class="fa fa-times float_right" aria-hidden="true"></i></h3></div>'); 

            $('#box_color').css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
                   
            $('#box_color').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});

            $("h3.fs-submenu .fa-times").on("click", function(ev){
                $(this).parents("div:first").remove();
            });

            $('#box_color').on("dragstart click", function(){ 
                $("h3.fs-submenu").parent("div").each(function() {
                    $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                });
                $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
            }); 

            $("#box_color").append( data_from_php_color.color_picker_structure );


            $("input[name='color-property-type']").change(function(){
                if( $(this).val() == "border" )
                    $("#external_wrap").css("visibility","visible");
                else
                    $("#external_wrap").css("visibility","hidden");

                updateColor(true);
            });

            $('#colorpickerhook').ColorPicker({  //#box_color
                //color: RGBToHex($(".selected").css("background-color")), //cuidado si nada seleccionado fallara
                flat: true,
                onChange: function (hsb, hex, rgb) {

                    //implementar si es fondo de trabajo enviar a la capa de rejilla, en caso contrario no se mostrara la rejilla.

                    if( $("input[name='color-property-type']:checked").val()  == "border") {
                        $("#color_square_wrap .option_selected").each(function(){     
                            let border_id = this.id;
                            let border_new_object = {};
                            
                            $( ".selected" ).not("#contenteditableBox").each(function(){

                                withoutcss_set_unset ( this, border_id, border_id);

                                $(this).css( border_id, "rgba("+ rgb.r + ","+ rgb.g + "," + rgb.b + ","  +  $("#opacity").val() + ")");
                                border_new_object[border_id] = "rgba("+ rgb.r + ","+ rgb.g + "," + rgb.b + ","  +  $("#opacity").val() + ")";
                                $.extend( $(this).data($('#hoverButton').data("mode")), border_new_object ); 
                            });
                            
                            //$(".selected:first").trigger("UpdateCodeBox");
                        
                        });     

                    }

                    if( $("input[name='color-property-type']:checked").val() == "text") {

                        $(".selected").each(function(){

                            withoutcss_set_unset ( this, "color", "color");

                            $.extend( $(this).data($('#hoverButton').data("mode")),{ "color" :  "rgba("+ rgb.r + ","+ rgb.g + "," + rgb.b + ","  +  $("#opacity").val() + ")" } ); // pasar a hex o rgb
                            $(this).css('color', $(this).data( $('#hoverButton').data("mode") ).color); 

                        });

                    }


                    if( $("input[name='color-property-type']:checked").val() == "background") {
                    
                        $(".selected").not("#contenteditableBox").each(function(){
                        
                            withoutcss_set_unset ( this, "background-color", "background_color");

                            $.extend( $(this).data($('#hoverButton').data("mode")),{ "background_color" :  "rgba("+ rgb.r + ","+ rgb.g + "," + rgb.b + ","  +  $("#opacity").val() + ")" } ); 
                            $(this).css('background-color', $(this).data( $('#hoverButton').data("mode") ).background_color); 

                        });     
                    }

                    if( $("input[name='color-property-type']:checked").val() == "textshadow") {
   
                        $(".selected").each(function(){
                        
                            $("#text-shadow_c .shadow_color").text("rgba("+ rgb.r + ","+ rgb.g + "," + rgb.b + ","  +  $("#opacity").val() + ")").trigger("update_shadow_color");

                        });     
                    }

                    if( $("input[name='color-property-type']:checked").val() == "boxshadow") {

                            $(".selected").each(function(){
                                
                                $("#box-shadow_c .shadow_color").text("rgba("+ rgb.r + ","+ rgb.g + "," + rgb.b + ","  +  $("#opacity").val() + ")").trigger("update_box_shadow_color");
    
                            });     
                        }

                            
                }


                
            });


            

        $(".selected:first").each(function(){
            $("#colorpickerhook").ColorPickerSetColor(RGBToHex($(this).css("background-color"))); //#box_color
        });



 //       let SeletedObjOpacity = 1; // set  value of selected element,  to do yet !!!!
        
        $("#color-opacity").slider({
            orientation: "horizontal",
            range: "max",
            max: 100,
            value: 0,
            slide: refreshColorOpacity,
            change: refreshColorOpacity
        });

   //     $("#color-opacity" ).slider("value",100 - SeletedObjOpacity * 100 ); // inicializamos a 0
        

        $("#opacity").keypress(function(e) {

            switch (true) {
                // supr,.,backspace,.,enter,escape
                case (e.which >= 48 && e.which <= 57):
                case (e.which == 13 || e.which == 46):

                        break;
                default:
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
            }        
        });


        $("#opacity").keyup(function(e, param1) {
            if ( param1 == "selection_added") selection_added = true;
            if ( $(this).val() === "")
                $("#color-opacity" ).slider("option", "value",100 * 100);
            else
                $("#color-opacity" ).slider("option", "value",100 - parseFloat($(this).val())  * 100);

        });

        $("#box_color").mousedown(function(ev){   //prevent #box_color to be hidden.
            ev.stopPropagation();
        });


//**********


        $("input[name='color-type']").change(function(){
            
            if ( $("input[name='color-type']:checked").val() == "transparent" ) {
                $("#opacity").val(0).trigger("keyup");
                //$("#color-opacity" ).slider("value", 0 );
            } 
            else { // solid
                $("#opacity").val(1).trigger("keyup");
            }

            let $this = $(".selected");



        if( $("input[name='color-property-type']:checked").val()  == "border") {

                        $("#color_square_wrap .option_selected").each(function(){     
                            let border_id = this.id;
                            let border_new_object = {};
                            
                            $( ".selected" ).each(function(){

                                withoutcss_set_unset ( this, border_id, border_id);

                                border_new_object[border_id] = ( $("input[name='color-type']:checked").val() == "transparent" ) ? "transparent" : "rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + $("#opacity").val() + ")" ;
                                $(this).css( border_id, border_new_object[border_id] );
                                $.extend( $(this).data($('#hoverButton').data("mode")), border_new_object ); 
                            });
                            
                        
                        });
        }

        if( $("input[name='color-property-type']:checked").val() == "background") {

                withoutcss_set_unset ( $this, "background-color", "background_color");

                $.extend( $($this).data($('#hoverButton').data("mode")),{ "background_color" :  ( $("input[name='color-type']:checked").val() == "transparent" ) ? "transparent" : "rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + $("#opacity").val() + ")" } );
        
                $($this).css('background-color', $($this).data( $('#hoverButton').data("mode") ).background_color); 
                

        }

 


    });

//*********

        $("#opacity").val(rgb_alpha);
        $("#opacity").trigger("keyup");
            
            
    } else {
        $("#box_color").remove();
    }

   
        
 

    //**********************************************

    //set color from first border selected of first element if exist


    $( "#color_square_wrap div" ).on("click", function(ev) {


        let border_id = this.id;

        if ($(".selected:first").data("css")[border_id]) $('#box_color').ColorPickerSetColor($(".selected:first").data("css")[border_id]);

    });

    $( "#box_color .border_square" ).click(function(ev) {

        if ( $(".selected").length == 0) {
            alert("Please, select an object first");
            return;
        }

        $(this).removeClass("border_square_hover");
        
        if (this.id == "border-center-all-color"){
            $( "#color_square_wrap .border_square" ).toggleClass("option_selected");
            $(this).removeClass("option_selected");
        }        
         else
            $(this).toggleClass("option_selected");
       // ev.stopPropagation();
    });
    
    $( "#box_color .border_square" ).mouseenter(function(ev) {
        if( ! $(this).hasClass("retweet") )
            $(this).addClass("border_square_hover");
        else
            $(this).css("color","cornflowerblue");

    }).mouseleave(function(ev) { 
        if( ! $(this).hasClass("retweet") )
            $(this).removeClass("border_square_hover");
        else
            $(this).css("color","grey");
    });

    if ( param1 == "text_shadow" ) $("#textshadow_option").prop('checked',true);
    if ( param1 == "box_shadow" ) $("#boxshadow_option").prop('checked',true);

     }); // end image color click

});    

    var rgb_alpha = 1;

function RGBToHex(rgb_or_rgba) {

    let rgb_array;
    let rgb = {};


    if ( rgb_or_rgba.indexOf("rgba") != -1 ){
        rgb_array = rgb_or_rgba.substring(5).split(",");
        rgb_alpha = parseFloat(rgb_array[3]);

        jQuery("#opacity").val(rgb_alpha);
        
    }
    else{
        rgb_array = rgb_or_rgba.substring(4).split(",");
        jQuery("#opacity").val(1);
    }

    rgb = {r:parseInt(rgb_array[0]),g:parseInt(rgb_array[1]),b:parseInt(rgb_array[2])};

    var hex = [
        rgb.r.toString(16),
        rgb.g.toString(16),
        rgb.b.toString(16)
    ];
    jQuery.each(hex, function (nr, val) {
        if (val.length == 1) {
            hex[nr] = '0' + val;
        }
    });

    return hex.join('');
}



function refreshColorOpacity(event,ui) {

    if (first_change_load || selection_added) {
        first_change_load = false; 
        selection_added = false;
        return;
    }

    let cadena = this.id;
    let input_id =  cadena.substring(cadena.indexOf("-")+1);

    let opacity = jQuery( "#opacity" ).val(); 

    if ( opacity == "-" ) {
        jQuery("#" + input_id).val( 0 );
        jQuery("#color-opacity" ).slider("value",100 );
        return;
    }
    else if( opacity > 1) 
        jQuery("#" + input_id).val( ( 100 - parseInt(ui.value) ) / 100);
    else if (opacity.indexOf(".") + 1 != opacity.length)   
        jQuery("#" + input_id).val( ( 100 - parseInt(ui.value) ) / 100);


    if ( opacity == 0 ){
        jQuery("#transparent").prop('checked',true);
    } else {
        jQuery("#solid").prop('checked',true);
    }

    (function($){
        

        if( $("#AllObject").is(':checked') ){
            $(".selected").each(function(){

                withoutcss_set_unset ( this, "opacity", "opacity");

                $.extend( $(this).data($('#hoverButton').data("mode")),{ "opacity" :  ( 100 - parseInt(ui.value) ) / 100 } ); 
                $(this).css('opacity', $(this).data( $('#hoverButton').data("mode") ).opacity); 
            });
            return;
        }

        
        if( $("input[name='color-property-type']:checked").val()  == "border") {

                        $("#color_square_wrap .option_selected").each(function(){     
                            let border_id = this.id;
                            let border_new_object = {};
                            
                            $( ".selected" ).each(function(){

                                withoutcss_set_unset ( this, border_id, border_id);

                                $(this).css( border_id, "rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + ( 100 - parseInt(ui.value) ) / 100 + ")" );
                                border_new_object[border_id] = "rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + ( 100 - parseInt(ui.value) ) / 100 + ")" ;
                                $.extend( $(this).data($('#hoverButton').data("mode")), border_new_object ); 
                            });
                            
                        
                        });
        }


        if( $("input[name='color-property-type']:checked").val() == "background") {

            $(".selected").each(function(){
                    
                    withoutcss_set_unset ( this, "background-color", "background_color");

                    $.extend( $(this).data($('#hoverButton').data("mode")),{ "background_color" :  "rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + ( 100 - parseInt(ui.value) ) / 100 + ")"  } ); 
                    $(this).css('background-color', $(this).data( $('#hoverButton').data("mode") ).background_color); 
            });
        }


        if( $("input[name='color-property-type']:checked").val() == "textshadow") {
        
            $(".selected").each(function(){
            
                $("#text-shadow_c .shadow_color").text("rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + ( 100 - parseInt(ui.value) ) / 100 + ")").trigger("update_shadow_color");

            });     
        }

        if( $("input[name='color-property-type']:checked").val() == "boxshadow") {
            
                $(".selected").each(function(){
                
                    $("#box-shadow_c .shadow_color").text("rgba("+ $('#box_color .colorpicker_rgb_r input').val() + ","+ $('#box_color .colorpicker_rgb_g input').val() + "," + $('#box_color .colorpicker_rgb_b input').val() + ","  + ( 100 - parseInt(ui.value) ) / 100 + ")").trigger("update_box_shadow_color");
    
                });     
            }
        
    
    })(jQuery);

}    

