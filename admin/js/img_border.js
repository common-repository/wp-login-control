//"use strict";
jQuery(document).ready(function($) {

    $("#img_box_border").click(function(ev){

       if ( ! $("#box_border").length) {

            $("#img_code").after('<div id="box_border" class="sub-tools"></div>'); 
            $("#box_border").append( data_from_php_border.box_border_structure );

            $('body').append('<style>#radius_::before{content:"'+ data_from_php_border.radius_translation +'"!important;}\
            </style>');

            $("#box_border").css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );

            $('#box_border').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
            $("h3.fs-submenu .fa-times").on("click", function(ev){
                $(this).parents("div:first").remove();
            });

            $('#box_border').on("dragstart click", function(){ 
                $("h3.fs-submenu").parent("div").each(function() {
                    $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                });
                $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
            }); 

            
            $("#all-radius").slider({
                    orientation: "horizontal",
                    range: "min",
                    max: 100,
                    value: 0,
                    slide: refreshRadius,
                    change: refreshRadius
            });
            
            $( "#box_border .border_square" ).click(function(ev) {

                if ( $(".selected").length == 0) {
                    alert("Please, select an object first");
                    return;
                }

                $(this).removeClass("border_square_hover");
                
                if(this.id == "border-center-all-radius"){
                    $( "#border_square_wrap .border_square" ).toggleClass("option_selected");
                    $(this).removeClass("option_selected");
                }
                else if(this.id == "border-center-all-style"){
                    $( "#style_square_wrap .border_square" ).toggleClass("option_selected");
                    $(this).removeClass("option_selected");
                } else
                    $(this).toggleClass("option_selected");
                // ev.stopPropagation();
            });
                
            $( "#box_border .border_square" ).mouseenter(function(ev) {  //.not(".retweet")
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

            $(".style-container").toggle().click(function(ev){ ev.stopPropagation(); }); // hidden

             $("#style_box").on("click",function() { //btDownStyle
            $(".style-container").toggle(); 
        });

        $(".style-drop .style-container > div").on("click",function(){
    
            $("#styleSelected").removeClass().addClass($(this).attr("class"));
            $(".style-container").toggle();

            let style_name = $(this).attr("class");
            style_name = style_name.slice(style_name.indexOf("-")+1);

            $("#style_square_wrap .option_selected").each(function(){     
                let style_id = this.id;
                let style_new_object = {};
                
                $( ".selected" ).each(function(){

                    withoutcss_set_unset ( this, style_id, style_id);
                    $(this).css( style_id, style_name);
                    style_new_object[style_id] = style_name;
                    $.extend( $(this).data($('#hoverButton').data("mode")), style_new_object ); 
                });

              //  $(".selected:first").trigger("UpdateCodeBox");

            });    

        });


        $("#box_border .drop-container").hide();

            
    } else {
        $("#box_border").remove();
    }


     }); // end img_box_model


});    // end ready


function refreshRadius(event,ui) {


    
    //var radius = jQuery( "#Radius" ).val();
    var radius = jQuery( "#radius_ .combo-input" ).val(); 
    
    if( parseInt(radius) <= parseInt(jQuery("#all-radius").slider("option", "max")) || ui.value != parseInt(jQuery("#all-radius").slider("option", "max")) ) {
     //jQuery( "#Radius" ).val(ui.value);
     jQuery( "#radius_ .combo-input" ).val(ui.value + jQuery( "#radius_ .combo-input" ).val().replace(/[0-9]/g,"") );
    }

    jQuery("#border_square_wrap .option_selected").each(function(){

            let border_id = this.id;
            let border_new_object = {};

            jQuery( ".selected" ).each(function(){
                withoutcss_set_unset ( this, border_id, border_id);
                jQuery( this ).css( border_id, radius);// + jQuery("#Units-radius" + " option:selected").text()); 
                border_new_object[border_id] = radius;// + jQuery("#Units-radius" + " option:selected").text();
                jQuery.extend( jQuery(this).data(jQuery('#hoverButton').data("mode")), border_new_object ); 
            });
        
            //jQuery(".selected:first").trigger("UpdateCodeBox");
    });


}