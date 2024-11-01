//"use strict";
jQuery(document).ready(function($) {

      
    $("body").on("click","#box_text_font, #box_border, #box_model", function(ev){
        $(this).find(".drop-container").hide();
        $(this).find(".combo-box").removeClass("dropped");
    }); // hidden

    $("body").on("keypress",".combo-input", function(ev) { //.combo-box

        ev.stopPropagation();

        switch (true) {
            // supr,.,backspace,.,enter,escape
            case ev.which == 0 || ev.which == 8: // Firefox patch
            case ev.which >= 48 && ev.which <= 57: // [0-91]
            case ev.which == 13: // return
            case ev.which == 46 && ev.target.selectionStart == 0: // .
            case ev.which == 46 && ev.target.selectionStart > 0 && ($(this).val().match(/\./g) || []).length == 0:
            case ev.which == 45 && ev.target.selectionStart == 0: // - only first position
                    break;
            default:
                    ev.preventDefault();
                    return false;
        }        
       });

    $("body").on("select",".combo-input", function(ev) {

            let regex = /[^\.\-\d]/;
            let match = regex.exec($(this).val().substring(ev.target.selectionStart,ev.target.selectionEnd)); //
            if ( match ) $(this).trigger("focus") ; // match.index 


    });


    $("body").on("keydown",".combo-input", function(ev) { // evitamos que con las flechas modifiquemos las unidades

            ev.stopPropagation();
            let regex = /[^\.\-\d]/;
            let matchIndex = 0;

            if ( regex.test($(this).val())) {
                let match = regex.exec($(this).val());
                matchIndex = match.index;
            }
            

            switch (true) {

                case ev.which == 40 || ev.which == 35:

                        ev.target.selectionStart = matchIndex; //match.index;
                        ev.target.selectionEnd = matchIndex; //match.index;
                        ev.preventDefault();
                        return false;
                        
                        break;

                case ev.which == 39 || ev.which == 46 :
    
                        if ( ev.target.selectionStart ==  matchIndex && matchIndex !=0 ) { //match.index
                            ev.preventDefault();
                            return false;
                        }
                        
                        break;

        }

    });

    $("body").on("click",".combo-box",function(ev) { 
        ev.stopPropagation();

        $(this).parents(".sub-tools").find(".drop-container").not($(this).find(".drop-container")).hide();
        $(this).parents(".sub-tools").find(".combo-box").not(this).removeClass("dropped");
        $(this).find(".drop-container").toggle();
        $(this).toggleClass("dropped");

        let regex = /[^\.\-\d]/;
        let match = regex.exec($(this).find(".combo-input").val());
        if( match == undefined ) return;
        if (ev.target.selectionStart > match.index ) 
            ev.target.selectionStart = ev.target.selectionEnd = match.index;

    });

    $('body').on('blur', '.combo-input', function(ev){ // select

        if( $(this).val().length < 3 ) {
            $(this).val("0" + $(this).val());
            $(this).trigger("change");
        }
    });

    $('body').on('focus', '.combo-input', function(ev){ // select

        let regex = /[^\.\-\d]/;

        ev.target.selectionStart = ev.target.selectionEnd = 0;

        if ( regex.test($(this).val()) ) {
            let match = regex.exec($(this).val());
            ev.target.selectionEnd = match.index;  //read and write
        }


    });


    $('body').on('update_shadow_color update_box_shadow_color', '.shadow_color', function(ev){

        cssProperty = $(ev.target).parents('.drop-wrap').attr('id');
        cssProperty = cssProperty.slice(0,cssProperty.indexOf("_"));

        if(ev.type == "update_shadow_color"){
            cssValue = $("#text-shadow_c .shadow_color").text() + " " + $("#text-shadow_h .combo-input").val() + " " + $("#text-shadow_v .combo-input").val() + " " + $("#text-shadow_b .combo-input").val();
        }
        else if(ev.type == "update_box_shadow_color") {
            cssValue = $("#box-shadow_c .shadow_color").text() + " " + $("#box-shadow_h .combo-input").val() + " " + $("#box-shadow_v .combo-input").val() + " " + $("#box-shadow_b .combo-input").val();
        }
        cssValue = cssValue.trim();
        extendObject = {};
        cssProperty = cssProperty.replace(/-/g,"_");
        extendObject[cssProperty] = cssValue;
        object_cssProperty = cssProperty;
        cssProperty = cssProperty.replace(/_/g,"-");

        $('.selected').not("#designArea").each(function() {

            withoutcss_set_unset ( this, cssProperty, object_cssProperty);
            $(this).css(cssProperty,cssValue );  
            $.extend( $(this).data($('#hoverButton').data("mode")), extendObject); 

        });

    });

    $('body').on('change', '.combo-input', function(ev){ 

        let regex = /[^\.\-\d]/;
        let matchIndex = 0;

        if ( regex.test($(this).val()) ){
            let match = regex.exec($(this).val());
            matchIndex = match.index;
        }

        let extendObject;
        let object_cssProperty;

        let cssValue = $(this).val();

        $(ev.target).parents(".drop-wrap").data("current_cssvalue",cssValue);

        if ( parseInt( cssValue ,10) == 0 ) {
            cssValue = 0;
        }
        else {
            cssValue = cssValue.replace(/^0+/, '');
            $(this).val(cssValue);
        }


        let cssProperty = $(ev.target).parents('.drop-wrap').attr('id');//replace("_", "");//
        cssProperty = cssProperty.slice(0,cssProperty.indexOf("_"));


        switch( cssProperty ) {
                        
            case "text-shadow":  

                                if ( ! $("#text-shadow_v").is(":visible") ) {
                                    $("#text-shadow_v div div:first, #text-shadow_b div div:first").html('<input class="combo-input" spellcheck="false" type="text" value="0px">');
                                    $("#text-shadow_c  div div:first").html('<i class="shadow_color">Black</i>');
                                    
                                    $("#text-shadow_v, #text-shadow_b, #text-shadow_c").show();
                                }

                                cssValue = $("#text-shadow_c .shadow_color").text() + " " + $("#text-shadow_h .combo-input").val() + " " + $("#text-shadow_v .combo-input").val() + " " + $("#text-shadow_b .combo-input").val();

                                break;

            case "box-shadow":  
            
                                if ( ! $("#box-shadow_v").is(":visible") ) {
                                    $("#box-shadow_v div div:first, #box-shadow_b div div:first").html('<input class="combo-input" spellcheck="false" type="text" value="0px">');
                                    $("#box-shadow_c  div div:first").html('<i class="shadow_color">Black</i>');
                                    
                                    $("#box-shadow_v, #box-shadow_b, #box-shadow_c").show();
                                }

                                cssValue = $("#box-shadow_c .shadow_color").text() + " " + $("#box-shadow_h .combo-input").val() + " " + $("#box-shadow_v .combo-input").val() + " " + $("#box-shadow_b .combo-input").val();

                                break;

            case "radius":  

                                if ($(this).parent().attr('data-slider')) $("#" + $(this).parent().attr('data-slider')).slider("value",parseInt(cssValue , 10));

                                ev.target.selectionStart = 0;
                                ev.target.selectionEnd = matchIndex;//match.index;

                                return;
                                //break;

            case "multiselection":  

                                if ( ! isNaN ( parseInt(cssValue , 10) ) ) // is number
                                    {
                                        if ($(this).parent().attr('data-slider'))
                                            $("#" + $(this).parent().attr('data-slider')).slider("value",parseInt(cssValue , 10));
                                    }
                                else{ // is not number

                                    $(".box_model input.box_sel").each(function(){

                                        $(this).val(cssValue);
                                        cssProperty = this.id;
                                        cssProperty = cssProperty.slice(0,cssProperty.indexOf("_")).replace(/-/g,"_");
                                        extendObject = {};
                                        extendObject[cssProperty] = cssValue;
                                        object_cssProperty = cssProperty;

                                        $('.selected').not("#designArea").each(function() {

                                            cssProperty = cssProperty.replace(/_/g,"-");

                                            withoutcss_set_unset ( this, cssProperty, object_cssProperty);
                                            $(this).css(cssProperty,cssValue ); 
                                            $.extend( $(this).data($('#hoverButton').data("mode")), extendObject);  
                    
                                        });

                                    });
                                }

                                ev.target.selectionStart = 0;
                                ev.target.selectionEnd = matchIndex; //match.index;     

                                return;
                                //break;

        }


        extendObject = {};
        cssProperty = cssProperty.replace(/-/g,"_");
        extendObject[cssProperty] = cssValue;
        object_cssProperty = cssProperty;
        cssProperty = cssProperty.replace(/_/g,"-");

        $('.selected').not("#designArea").each(function() {

            withoutcss_set_unset ( this, cssProperty, object_cssProperty);
            $(this).css(cssProperty,cssValue );  
            $.extend( $(this).data($('#hoverButton').data("mode")), extendObject); 

        });

        ev.target.selectionStart = 0;
        ev.target.selectionEnd = matchIndex; //match.index;  //read and write

        switch( cssProperty ) {
             case "width":
                        $(".edit-icons").trigger("reposition"); // reposition edit and trash icons
                        break;
        }

    });



    $("body").on("mouseleave",".drop-container",function(ev) { // recuperamos la propiedad css en el diseñador al salir del combo sin seleccionar

 
        if ($(this).parents(".drop-wrap").data("current_cssvalue") == "") return; // or in not num
        
        if ( $(this).parents("#text-shadow_c").length ) return;
        if ( $(this).parents("#box-shadow_c").length ) return;

        let $this = this; 
        let cssProperty = $(ev.target).parents('.drop-wrap').attr('id');
        cssProperty = cssProperty.slice(0,cssProperty.indexOf("_"));
        
        $('.selected').not("#designArea").each(function() {
            $(this).css(cssProperty,$($this).parents(".drop-wrap").data("current_cssvalue") );
        });


    });


            $("body").on("click mouseenter",".drop-container i , .drop-container .textline:not(.disabled)",function(ev) {  //combo-box

                let cssValue = ev.target.id;
                let cssProperty = ev.target.id;
                let extendObject = {};
                let object_cssProperty;

                cssValue = cssValue.slice(cssValue.indexOf("_")+1);
                cssValue = cssValue.replace("_", " ");
                cssValue = cssValue.replace(/\./g," "); // replace . by space
                cssValue = cssValue.replace(/!/g,"'"); // replace ! by ' 

                cssProperty = cssProperty.slice(0,cssProperty.indexOf("_")).replace(/-/g,"_");
            
                extendObject[cssProperty] = cssValue;

                if ( ev.type == "click" && cssProperty == "obj_pos_on_creation"){
                    obj_pos_on_creation = cssValue;
                }
                                
                if ( ev.type == "click" && $(ev.target).hasClass("google-font") ){  
                    
                    var fontName = "";
                    fontName = ev.target.id;
                    fontName = fontName.replace("font-family_","").replace(/\./g," ").replace(/\!/g,"");
                    if (google_fonts_in_use.find(function(font){return font == fontName;}) == undefined ) google_fonts_in_use.push(fontName.replace(/ /g,"+"));
                /*    var apiUrl = [];
                    var url = "";
                    var fontName = "";

                    apiUrl.push('https://fonts.googleapis.com/css?family=');
                    fontName = ev.target.id;
                    fontName = fontName.replace("font-family_","").replace(/\./g," ").replace(/\!/g,"");
                    apiUrl.push(fontName.replace(/ /g,"+"));
                    url = apiUrl.join('');
                    $('.google-fonts-design[data-font="'+ fontName + '"]').each(function() {
                        if( $(this).hasClass("lorem-ipsum")) {
                            $('head').append( $('<link rel="stylesheet" class="google-fonts-design">').attr("data-font", fontName).attr("href", url));
                            $(this).remove();
                        }
                    });
                    */
                }

                if ( ev.type == "click" ){
                    ev.stopPropagation();

                    $(ev.target).parents(".combo-box").find(".drop-container").hide();
                    $(".combo-box").removeClass("dropped"); //#align-drop

                    if (! $(ev.target).hasClass("textline")) // <i> icons
                        {
                        $(ev.target).parents(".combo-box").find("div:first").html($(ev.target).parent().html()).find("i").removeAttr("id");
                        }
                    else
                        if ( $(ev.target).hasClass("editable")){
                            if( $(ev.target).hasClass("number"))
                                $(ev.target).parents(".combo-box").find("div:first").html('<input class="combo-input" type="text" spellcheck="false" value="' + $(ev.target).html() + '">');
                            else if ( ! $(ev.target).hasClass("text-start")){ // if is text not add 0
                                $(ev.target).parents(".combo-box").find("div:first").html('<input class="combo-input" type="text" spellcheck="false" value="' +  parseInt( "0" + $(ev.target).parents(".combo-box").find(".combo-input").val() ,10) + $(ev.target).html() + '">');
                            }
                                else
                                $(ev.target).parents(".combo-box").find("div:first").html('<input class="combo-input" type="text" spellcheck="false" value="' + $(ev.target).html() + '">');

                            $(ev.target).parents('.drop-wrap').find('.combo-input').focus().trigger('change');
                        }
                        else if ( $(ev.target).hasClass("shadow_color_option")){
                            $(ev.target).parents(".combo-box").find("div:first").html("<i class='shadow_color'>"+ $(ev.target).html() + "</i>");
                        }

                        else

                        {
                            $(ev.target).parents(".combo-box").find("div:first").html("<i>"+ $(ev.target).html() + "</i>"); // .textline
                        }

                } 




                if ( ! $(this).is(".editable, .not-editable") || $(this).is(".number") ) //hasClass("editable")

                    switch( cssProperty ) {
                        
                        case "obj_pos_on_creation":
                                                    return;
                                                    break;

                        case "radius": // do nothing
                                       //disabled
                                       break;

                        case "multiselection":
                                        //disabled
                                        //$("#slider-values" ).slider("value",$this.val());

                                        break;
                        case "text_shadow":  

                            if ( ev.type == "click" ){

                                if( cssValue == "none" ) {
                                    $("#text-shadow_v, #text-shadow_b, #text-shadow_c").hide();
                                    $("#text-shadow_h  div div:first").html('<input class="combo-input" type="text" value="None">');
                                    //cssValue = "none";
                                } else {
                                    cssValue = $("#text-shadow_c .shadow_color").text() + " " + $("#text-shadow_h .combo-input").val() + " " + $("#text-shadow_v .combo-input").val() + " " + $("#text-shadow_b .combo-input").val();
                                }



                                extendObject = {};
                                extendObject[cssProperty] = cssValue;
                                object_cssProperty = cssProperty;

                                $('.selected').not("#designArea").each(function() {

                                    cssProperty = cssProperty.replace(/_/g,"-");
                                    withoutcss_set_unset ( this, cssProperty, object_cssProperty);
                                    $(this).css(cssProperty,cssValue ); 
                                    $.extend( $(this).data($('#hoverButton').data("mode")), extendObject);  

                                });


                            }
                                break;

                        case "box_shadow":  
                        
                                if ( ev.type == "click" ){
    
                                    if( cssValue == "none" ) {
                                        $("#box-shadow_v, #box-shadow_b, #box-shadow_c").hide();
                                        $("#box-shadow_h  div div:first").html('<input class="combo-input" type="text" value="None">');
                                        //cssValue = "none";
                                    } else {
                                        cssValue = $("#box-shadow_c .shadow_color").text() + " " + $("#box-shadow_h .combo-input").val() + " " + $("#box-shadow_v .combo-input").val() + " " + $("#box-shadow_b .combo-input").val();
                                    }
    
    
    
                                    extendObject = {};
                                    extendObject[cssProperty] = cssValue;
                                    object_cssProperty = cssProperty;
    
                                    $('.selected').not("#designArea").each(function() {
    
                                        cssProperty = cssProperty.replace(/_/g,"-");
                                        withoutcss_set_unset ( this, cssProperty, object_cssProperty);
                                        $(this).css(cssProperty,cssValue ); 
                                        $.extend( $(this).data($('#hoverButton').data("mode")), extendObject);  
    
                                    });
    
    
                                }
                                    break;

                        default:

                                    object_cssProperty = cssProperty;
                                    cssProperty = cssProperty.replace(/_/g,"-");

                                    $('.selected').not("#designArea").each(function() {
                                        
                                        withoutcss_set_unset ( this, cssProperty, object_cssProperty); // o en click pero tendriamos que recuperar del combo
                                        $(this).css(cssProperty,cssValue ); // add(target_clicked) //.add(target_clicked)

                                        if ( ev.type == "click" ) {
                                            
                                            $.extend( $(this).data($('#hoverButton').data("mode")), extendObject);  //ev.target.id
                
                                        }

                                        

                                    });
                            
                    }  


                    if ( ev.type == "click" ){   
                        

                        $(ev.target).parents(".drop-wrap").data("current_cssvalue",cssValue);
                        if ($(this).hasClass("shadow_color_option")) {

                            cssProperty = $(ev.target).parents('.drop-wrap').attr('id');//replace("_", "");//
                            cssProperty = cssProperty.slice(0,cssProperty.indexOf("_"));

                            switch ( cssProperty ) {
                                case "text-shadow":
                                                    cssValue = $("#text-shadow_c .shadow_color").text() + " " +  $("#text-shadow_h .combo-input").val() + " " + $("#text-shadow_v .combo-input").val() + " " + $("#text-shadow_b .combo-input").val();
                                                    break;
                                case "box-shadow":
                                                    cssValue = $("#box-shadow_c .shadow_color").text() + " " +  $("#box-shadow_h .combo-input").val() + " " + $("#box-shadow_v .combo-input").val() + " " + $("#box-shadow_b .combo-input").val();
                                                    break;
                            }
                            
                            
                            extendObject = {};
                            cssProperty = cssProperty.replace(/-/g,"_");
                            extendObject[cssProperty] = cssValue;
                            object_cssProperty = cssProperty;
                            cssProperty = cssProperty.replace(/_/g,"-");

                            $('.selected').not("#designArea").each(function() {

                                withoutcss_set_unset ( this, cssProperty, object_cssProperty);
                                $(this).css(cssProperty,cssValue ); 
                                $.extend( $(this).data($('#hoverButton').data("mode")), extendObject); 

                            });

                        }
                        
                    }

                    switch( cssProperty ) {
                        case "box-sizing":
                                        $(".edit-icons").trigger("reposition");
                                        break;
                    }
            
    });

});    // end ready


function updateCombos(){

    (function($){

    $('.selected').not("#designArea").each(function(index) {

        let $this = this;

        $(".box_model input").each(function(){
            let cssProperty = $(this).attr("id");
            cssProperty = cssProperty.slice(0,cssProperty.indexOf("_"));
            let cssValue = $($this).css(cssProperty); // Value of the retrieved object
            let object_cssProperty = cssProperty.replace(/-/g,"_");

            if ( $('#hoverButton').data("mode") == "css"){
                if( $($this).data("css")[object_cssProperty] !== undefined )
                    cssValue = $($this).data("css")[object_cssProperty];
                else if( $($this).data("withoutcss")[object_cssProperty] !== undefined ) //withoutcss
                    cssValue = $($this).data("withoutcss")[object_cssProperty];
            } 

            else {
                if( $($this).data("hover")[object_cssProperty] !== undefined )
                cssValue = $($this).data("hover")[object_cssProperty];
            } 

            if ( index == 0 ) {  // first line
                
                switch(cssValue){
                    case "Auto":
                    case "Inherit":
                                $(this).val(cssValue);
                                break;
                    default:
                                $(this).val(parseInt(cssValue));

                }
                
            }
            else
                if ( $(this).val() != parseInt(cssValue)) $(this).val("");

                


        });

        $("#box_text_font .drop-wrap, #box_model .drop-wrap, #box_flex_box .drop-wrap").not(".no-css-recover").each(function(){

            let cssProperty = $(this).attr("id");
            cssProperty = cssProperty.slice(0,cssProperty.indexOf("_"));

            let cssValue = $($this).css(cssProperty); // Value of the retrieved object
            if ( cssProperty != "text-shadow")
                cssValue = cssValue.split(" ")[0]; //  patch for chrome that returns more than one value in some properties , ex. text-decoration

            let object_cssProperty = cssProperty.replace(/-/g,"_");

            if ( $('#hoverButton').data("mode") == "css"){
                if( $($this).data("css")[object_cssProperty] !== undefined ){
                    cssValue = $($this).data("css")[object_cssProperty];
                    
                }
                else if( $($this).data("withoutcss")[object_cssProperty] !== undefined ) //withoutcss
                    cssValue = $($this).data("withoutcss")[object_cssProperty];
            } 

            else {
                if( $($this).data("hover")[object_cssProperty] !== undefined )
                cssValue = $($this).data("hover")[object_cssProperty];
            }     

            //particular cases

            if (cssProperty == "text-shadow") {

                if ( cssValue.indexOf("rgb") != -1 ) { // or rgba runs too.
                    if ( cssValue.indexOf(", rgb") != -1 ) cssValue = cssValue.slice(0,cssValue.indexOf(", rgb"))
                    cssValue = cssValue.replace(/,\s/g,",");
                    cssValue = cssValue.split(" ");
                }
                else if ( cssValue.indexOf(",") != -1 ) {// is edge or other
                    cssValue = cssValue.slice(0,cssValue.indexOf(","));
                    cssValue = cssValue.replace(/,\s/g,",");
                    cssValue = cssValue.split(" ");
                    // reorder

                    let cssTemp = "";
                    cssTemp = cssValue[3];
                    cssValue[3] = cssValue[2];
                    cssValue[2] = cssValue[1];
                    cssValue[1] = cssValue[0];
                    cssValue[0] = cssTemp;
                }
                else{ // none 
                    cssValue = cssValue.split(" ");
                }


                if ( cssValue[0] == "none") {
                    $("#text-shadow_h .combo-input").val(cssValue[0]); // none
                    $("#text-shadow_v, #text-shadow_b, #text-shadow_c").hide();
                    //$("#text-shadow_none").trigger("click");
                } else {
                    $("#text-shadow_h .combo-input").val(cssValue[1]);
                    $("#text-shadow_v .combo-input").val(cssValue[2]);
                    $("#text-shadow_b .combo-input").val(cssValue[3]);
                    $("#text-shadow_c .shadow_color").html('<i class="shadow_color">' + cssValue[0] + '</i>');
                    
                    $("#text-shadow_v, #text-shadow_b, #text-shadow_c").show();
                }

                return true; //salta una iteracion
            }

            //////

            if (cssProperty == "box-shadow") {
                
                if ( cssValue.indexOf("rgb") != -1 ) { // or rgba runs too.
                    if ( cssValue.indexOf(", rgb") != -1 ) cssValue = cssValue.slice(0,cssValue.indexOf(", rgb"))
                    cssValue = cssValue.replace(/,\s/g,",");
                    cssValue = cssValue.split(" ");
                }
                else if ( cssValue.indexOf(",") != -1 ) {// is edge or other
                    cssValue = cssValue.slice(0,cssValue.indexOf(","));
                    cssValue = cssValue.replace(/,\s/g,",");
                    cssValue = cssValue.split(" ");
                    // reorder

                    let cssTemp = "";
                    cssTemp = cssValue[3];
                    cssValue[3] = cssValue[2];
                    cssValue[2] = cssValue[1];
                    cssValue[1] = cssValue[0];
                    cssValue[0] = cssTemp;
                }
                else{ // none 
                    cssValue = cssValue.split(" ");
                }


                if ( cssValue[0] == "none") {
                    $("#box-shadow_h .combo-input").val(cssValue[0]); // none
                    $("#box-shadow_v, #box-shadow_b, #box-shadow_c").hide();
                    //$("#text-shadow_none").trigger("click");
                } else {
                    $("#box-shadow_h .combo-input").val(cssValue[1]);
                    $("#box-shadow_v .combo-input").val(cssValue[2]);
                    $("#box-shadow_b .combo-input").val(cssValue[3]);
                    $("#box-shadow_c .shadow_color").html('<i class="shadow_color">' + cssValue[0] + '</i>');
                    
                    $("#box-shadow_v, #box-shadow_b, #box-shadow_c").show();
                }

                return true; //salta una iteracion
            }
        
        // patch for 0 values
        if ( cssValue == 0 ) cssValue = "0px";
            // end particular cases

        if( isNaN( parseInt(cssValue) ) ) {
      
            if ( index == 0 ) { // first line
            
                if ( $(this).find(".combo-box div:first").hasClass("has-icons")){
                            
                    let optionID = "#" + cssProperty + "_" + cssValue;

                    if ( $(optionID).hasClass("textline"))
                        $(this).find(".combo-box div:first").html("<i>"+ cssValue + "</i>"); // .textline
                    else // fa class
                        $(this).find(".combo-box div:first").html( $(optionID).parent().html() ).find("i").removeAttr("id") ; //icons or textline , with search id 
  
                }
                else
                    $(this).find(".combo-box div:first").html("<i>"+ cssValue + "</i>"); // .textline
            }
            else{ // next lines                        
                
                if ( $(this).find(".combo-box div:first").hasClass("has-icons")){
                    optionID = "#" + cssProperty + "_" + cssValue;
                    if ( $(optionID).hasClass("textline")){
                        if ($(this).find(".combo-box div:first").html().localeCompare('<i>' + cssValue + '</i>' ) != 0 ){
                            $(this).find(".combo-box div:first").html('<input class="combo-input" type="text" spellcheck="false" value="">');
                        }
                    }
                    else {// fa class
                            var tempObj = $(optionID).parent().clone();
                            $(tempObj).find("i").removeAttr("id");
                            if ($(this).find(".combo-box div:first").html().localeCompare($(tempObj).html()) != 0 )
                                $(this).find(".combo-box div:first").html('<input class="combo-input" type="text" spellcheck="false" value="">');
                    }
                }
                else {

                    if ($(this).find(".combo-box div:first").html().localeCompare('<i>' + cssValue + '</i>' ) != 0 ){
                        $(this).find(".combo-box div:first").html('<input class="combo-input" type="text" spellcheck="false" value="">');
                    }

                }

            }


        }
        else{ // is a number

            if ( index == 0 ) // first line
                $(this).find(".combo-box div:first").html('<input class="combo-input" type="text" spellcheck="false" value="' + cssValue + '">');
            else{ // next lines

                if ($(this).find(".combo-box div:first").html().localeCompare('<input class="combo-input" type="text" spellcheck="false" value="' + cssValue + '">' ) != 0 ){
                    $(this).find(".combo-box div:first").html('<input class="combo-input" type="text" spellcheck="false" value="">');
                }

            }
        }

        $(this).data("current_cssvalue",cssValue);

        });

    });

    })(jQuery);
}