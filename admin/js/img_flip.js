"use strict";
jQuery(document).ready(function($) {
    
    
    $("#img_flip_horizontal").click(function(){ 

        $(".selected").not("#designArea").each(function(){

            let transformString = $(this).data($('#hoverButton').data("mode")).transform;

            let newtransformString = "scale(-1,1)";
            let scaleValue;

            if ( transformString != undefined && transformString.indexOf('scale(') != -1) {
            
                newtransformString = transformString.slice(0,transformString.indexOf("scale(")+6);
                transformString = transformString.slice(transformString.indexOf("scale(")+6);
                scaleValue = parseInt(transformString.slice(0,transformString.indexOf(","))) * -1 ;
                newtransformString = newtransformString + scaleValue + transformString.slice(transformString.indexOf(","))
            } else if ( transformString != undefined ){
                
                newtransformString = $(this).data($('#hoverButton').data("mode")).transform + " " + newtransformString;
            }
          
            withoutcss_set_unset ( this, "transform", "transform");
            $.extend( $(this).data($('#hoverButton').data("mode")),{ "transform" : newtransformString });
            $(this).css( "transform", $(this).data($('#hoverButton').data("mode")).transform );
            
        });

     //   $(".selected:first").trigger("UpdateCodeBox");

    });

    $("#img_flip_vertical").click(function(){ 


        $(".selected").not("#designArea").each(function(){

            let transformString = $(this).data($('#hoverButton').data("mode")).transform;
            let newtransformString = "scale(1,-1)";
            let scaleValue;

            if ( transformString != undefined && transformString.indexOf('scale(') != -1) {
            
                newtransformString = transformString.slice(0,transformString.indexOf("scale(")+6);
                transformString = transformString.slice(transformString.indexOf("scale(")+6);
                scaleValue = parseInt(transformString.slice(transformString.indexOf(",")+1,transformString.indexOf(")"))) * -1 ;
                newtransformString = newtransformString + transformString.slice(0,transformString.indexOf(",")+1);
                transformString = transformString.slice(transformString.indexOf(")"));
                newtransformString = newtransformString + scaleValue + transformString;
            } else if ( transformString != undefined ){
                
                newtransformString = $(this).data($('#hoverButton').data("mode")).transform + " " + newtransformString;
            }
          
            withoutcss_set_unset ( this, "transform", "transform");
            $.extend( $(this).data($('#hoverButton').data("mode")),{ "transform" : newtransformString });
            $(this).css( "transform", $(this).data($('#hoverButton').data("mode")).transform );
        });

     //   $(".selected:first").trigger("UpdateCodeBox");

    });
    
});
