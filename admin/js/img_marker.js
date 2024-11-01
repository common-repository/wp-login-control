"use strict";
jQuery(document).ready(function($) {
    
 
    $("#img_marker").click(function(){ 

        if ( $(".selected").length > 1) {

            if($("#sliderInfoBox_1").length) $("#sliderInfoBox_1").remove();
            $("#designArea").append("<div id='sliderInfoBox_1' class='slideInfoBox_Start sliderAlert'>" + data_from_php_marker.Info_only_one + "</div>");
            $("#img_marker").on("mouseleave", function(){
                $("#sliderInfoBox_1").addClass('slideInfoBox_End');
            });

        }
        else if ( $(".selected").length == 0) {

            if($("#sliderInfoBox_1").length) $("#sliderInfoBox_1").remove();
            $("#designArea").append("<div id='sliderInfoBox_1' class='slideInfoBox_Start sliderAlert'>" + data_from_php_marker.Info_you_must_select + "</div>");
            $("#img_marker").on("mouseleave", function(){
                $("#sliderInfoBox_1").addClass('slideInfoBox_End');
            });

        }
        else{
            id_origin = $(".selected").attr("id");

            if($("#sliderInfoBox_1").length) $("#sliderInfoBox_1").remove();
            $("#designArea").append("<div id='sliderInfoBox_1' class='slideInfoBox_Start'>" + data_from_php_marker.Info_origin + "</div>");
            $("#img_marker").on("mouseleave", function(){
                $("#sliderInfoBox_1").addClass('slideInfoBox_End');
            });
            
        }

    });

    $("#img_marker").mousedown(function(ev){
        if (ev.which == 3) {

            id_origin = "designArea";
            
            if($("#sliderInfoBox_1").length) $("#sliderInfoBox_1").remove();
            $("#designArea").append("<div id='sliderInfoBox_1' class='slideInfoBox_Start'>" + data_from_php_marker.Info_origin_reset + "</div>");
            $("#img_marker").on("mouseleave", function(){
                $("#sliderInfoBox_1").addClass('slideInfoBox_End');
            });
        }
    });
  
});
