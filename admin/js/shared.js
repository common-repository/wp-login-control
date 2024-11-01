//"use strict";
var PathToAdminImages;
var prefix_formId = "";
var formType = "";

var toggle_changes = {};
var custom_css = "";
var id_origin = "designArea";
var google_fonts_in_use = [];
var obj_pos_on_creation = "absolute";
var user_variables = [];

var selection_added = false; // colorpicker opacity refresh
var selection_count = 0;
var content_editable_open = {"open":false,"x":0,"y":0};

var circleRedObject;
var circleDragging = false;
var circleCenterDifX;
var circleCenterDifY;
var ObjectOffsetX;
var ObjectOffsetY;
var circleRadius;
var circleDragStarted = false;
var SelectedObject;
var SelectedObjects;
var circleGreenObject;
var circleBlueObject;
var circlePurpleObject;

var CircleCenterOffsetX;
var CircleCenterOffsetY;


var MouseButton1 = 0;

var dif_mov_x;
var dif_mov_y;

jQuery(document).ready(function($) {
    
    // get path to admin images
    
    PathToAdminImages = $("#img_path").attr("src");
    PathToAdminImages = PathToAdminImages.substring(0,PathToAdminImages.lastIndexOf("/") + 1);  // included last '/'
 
    // end path to admin images
    
 //   document.onselectstart = function() {return false;} //deactivate text select --> added on css

});


function withoutcss_set_unset($this, css_prop, data_prop){


    if ( jQuery('#hoverButton').data("mode") == "hover" && jQuery($this).data("css")[data_prop] == undefined &&  jQuery($this).data("withoutcss")[data_prop] == undefined){
        let new_object = {};

        new_object[data_prop] = jQuery($this).css(css_prop);
        jQuery.extend( jQuery($this).data("withoutcss"), new_object);
    }
    if ( jQuery('#hoverButton').data("mode") == "css" && jQuery($this).data("withoutcss")[data_prop] != undefined )
        delete jQuery($this).data("withoutcss")[data_prop];

}



//make buttons toggle

    function toggleButton(toggleElement){
    
    jQuery(toggleElement).on("click",function(ev){
        ev.stopPropagation();
        if( !jQuery(this).hasClass("button-primary") ) {
            jQuery(this).siblings().removeClass("button-primary").addClass("button-secondary");
            jQuery(this).removeClass("button-secondary").addClass("button-primary");
        } 
    });
    
 //end make buttons toogle
    
}

function rotatedegree(object){


    let SelectedObjDegCss = jQuery(object).data("css").transform;
    if (SelectedObjDegCss) {

        if(SelectedObjDegCss.indexOf("rotate(") > -1) {

            SelectedObjDegCss = SelectedObjDegCss.slice(SelectedObjDegCss.indexOf("rotate(")+7);
            SelectedObjDegCss = SelectedObjDegCss.slice(0,SelectedObjDegCss.indexOf("deg)"));
            return parseFloat(SelectedObjDegCss);
        } 
        else return 0;
    }
    else return 0;

}


function isHighDensity(){
    return ((window.matchMedia && (window.matchMedia('only screen and (min-resolution: 124dpi), only screen and (min-resolution: 1.3dppx), only screen and (min-resolution: 48.8dpcm)').matches || window.matchMedia('only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (min-device-pixel-ratio: 1.3)').matches)) || (window.devicePixelRatio && window.devicePixelRatio > 1.3));
}

function isRetina(){
    return ((window.matchMedia && (window.matchMedia('only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx), only screen and (min-resolution: 75.6dpcm)').matches || window.matchMedia('only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (min--moz-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2)').matches)) || (window.devicePixelRatio && window.devicePixelRatio >= 2)); //&& /(iPad|iPhone|iPod)/g.test(navigator.userAgent)
}


// extends


jQuery.fn.extend({
    hasClasses: function (selectors) {
        var self = this;
        for (var i in selectors) {
            if (jQuery(self).hasClass(selectors[i])) 
                return true;
        }
        return false;
    }
});

String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

String.prototype.stripSlashes = function(){
    return this.replace(/\\(.)/mg, "$1");
}


// check if an element exists in array using a comparer function
// comparer : function(currentElement)
Array.prototype.inArray = function(comparer) { 
    for(var i=0; i < this.length; i++) { 
        if(comparer(this[i])) return true; 
    }
    return false; 
}; 

// adds an element to the array if it does not already exist using a comparer 
// function
Array.prototype.pushIfNotExist = function(element, comparer) { 
    if (!this.inArray(comparer)) {
        this.push(element);
    }
}; 


jQuery.extend({
    replaceTag: function (currentElem, newTag, keepProps) {
        var $currentElem = jQuery(currentElem);
        //$newTag = jQuery(newTagObj);//.clone();
        var element = document.createElement(newTag);

        if (keepProps) {
            //$newTag.attr('class', $currentElem.attr('class'));

            for (var i = 0; i < currentElem.attributes.length; i++) {
                var attr = currentElem.attributes.item(i);
                element.setAttribute(attr.nodeName, attr.nodeValue);
                //$newTag.attr(attr.nodeName, attr.nodeValue);
            }

            jQuery(element).attr("object", newTag);// newTagObj.substring(1,newTagObj.length -1));
            jQuery(element).attr("id", newTag + "_" + prefix_formId.replace(/ /g,"_") + "_" + get_next_id(element));

            jQuery(element).data("css",jQuery.extend({},jQuery(currentElem).data("css")));  // copy data to next id object
            jQuery(element).data("new",jQuery.extend({},jQuery(currentElem).data("new")));
            jQuery(element).data("withoutcss",jQuery.extend({},jQuery(currentElem).data("withoutcss")));
            jQuery(element).data("hover",jQuery.extend({},jQuery(currentElem).data("hover")));
            jQuery(element).data("custom",jQuery.extend({},jQuery(currentElem).data("custom")));

            jQuery.extend( jQuery(element).data("new"), { id : jQuery(element).attr("id") } );
            jQuery.extend( jQuery(element).data("new"), { type : newTag } );

        }

        $currentElem.wrapAll( jQuery(element) );

        if($currentElem.contents().length == 0){ //check text node exists
            $currentElem.remove();
        }
        else{
            $currentElem.contents().unwrap();
        }
        

        //return this; 
    }
});

jQuery.fn.extend({
    replaceTag: function (newTag, keepProps) {
        return this.each(function() {
            jQuery.replaceTag(this, newTag, keepProps);
        });
    }
});