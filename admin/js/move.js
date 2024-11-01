"use strict";
jQuery(document).ready(function($) {
// move

var ThisIsWrapped = false;
var SelectedObjDegCss = 0;
var ThisObj;
var iniX, iniY;
var dragging_obj = false;

   $("#designArea").on({
        
        mousedown: function(ev){
                 
            dragging_obj = false;
            
            if(ev.which == 1 ) {
                selection_count = 1;
                if ( $("#contextual_menu").length) {
                    $("#contextual_menu").remove();
                }
            }
    
            if(ev.which == 1 && !ev.ctrlKey)
                { 
                        //MouseButton1 = 1
                        
                        if (this.id != ev.target.id && $("#edit-ok").length) return;
                        dragging_obj = true;
                        ThisObj = this;
                        ev.preventDefault();
                        ev.stopPropagation();

                        $(".selected:first").trigger("unsetSelected");

                        $(".edit-icons").each(function(){
                            
                            if (this.id == "edit-ok") { // if contenteditable_container is opened
                                content_editable_open.open = true;
                                let contenteditable_container_position = $("#contenteditable_container").offset();
                                content_editable_open.x = contenteditable_container_position.left;
                                content_editable_open.y = contenteditable_container_position.top;
                                //$(this).trigger("click");
                            }
                            else {
                                $(this).remove();
                            }
                        });                        
                        $(".selected").removeClass("selected");//.children("i.edit-icons").remove();//.removeClass("edit-icons");
                        $(this).addClass("selected");

                        if ($(ThisObj).data("css").position != "static" ) { // $(ThisObj);//.addClass("move");
                            dif_mov_y = ev.pageY - $(ThisObj).offset().top;
                            dif_mov_x = ev.pageX - $(ThisObj).offset().left;
                        }
                        else{
                            dragging_obj = false;
                        }


    } 
            
        },
        
        mousemove: function(ev){

            if( ev.which == 1 && dragging_obj && selection_count == 1 ) { //selection_count -> at the moment only one object is allowed to move at a time
                    $(ThisObj).addClass("move");
                    ev.preventDefault();
                    ev.stopPropagation();
                    $(ThisObj).offset({top : (ev.pageY - dif_mov_y )  , left: (ev.pageX - dif_mov_x)});

            }
            
        },


        mouseup: function(ev){
            
            dragging_obj = false;

            if( $(ThisObj).hasClass("move") ){

                var position = $(ThisObj).position();
                
                if ( $(ThisObj).data("css").top !== undefined) // if is 0 by default is number

                    if ( $(ThisObj).data("css").top.toString().indexOf("%") == -1 ) { // not found
                        
                        $.extend( $(ThisObj).data("css"),{"top" : $(ThisObj).css("top")});
                        
                    }
                    else { // % found
                        $.extend( $(ThisObj).data("css"),{"top" : Math.round( position.top / $(ThisObj).parent().height() * 100 * 100) / 100 + "%"} );
                    }


                if ( $(ThisObj).data("css").left !== undefined)

                    if ( $(ThisObj).data("css").left.toString().indexOf("%") == -1 ) { // not found
                        $.extend( $(ThisObj).data("css"),{"left" : $(ThisObj).css("left")});
                    }
                    else { // % found
                        $.extend( $(ThisObj).data("css"),{"left" : Math.round( position.left / $(ThisObj).parent().width() * 100 * 100) / 100 + "%"} );
                    }


                $(ThisObj).trigger("setSelected");
                $(ThisObj).removeClass("move");
                
            }
            
        },
 
    }, data_from_php_move.tag_permitted);

});