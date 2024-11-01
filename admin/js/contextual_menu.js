/* free version */
//"use strict";
jQuery(document).ready(function($) {

    document.oncontextmenu = function() {return false;}; //remove contextual browser menu


    function remove_contextual_menu(){
        
        if ( $("#contextual_menu").length) {
            $("#contextual_menu").remove();
        }
    }

        $(document).on("mousedown",function(){
            if ( $("#contextual_menu").length) {
                $("#contextual_menu").remove();
            }
        });



     $("#designArea").on("mousedown","#contextual_menu",function(ev){   //prevent to be hidden.  
           ev.stopPropagation();
    });




    $("#designArea").mousedown(function(ev){

        if ( ev.target.id == "designArea" && formType == "ObjectBlank") return ;

           if (ev.target.id == "Zindex_mask"){
                $("#Zindex_mask").remove();
                $("#zindex_box").remove();

                //catch element by x,y 

                var el = document.elementFromPoint(ev.pageX,ev.pageY);
           }
       


        if ( $("#contextual_menu").length) {
            remove_contextual_menu();
        }             

                    
        switch (ev.which) {
            case 1:
                break;
            case 2:
                //alert('Middle Mouse button pressed.');
                break;
            case 3:
            //  alert('Right Mouse button pressed. ' + this.id + ' ' + ev.target.id);

            if ( $(ev.target).parents(".not_selectable").length > 0 || $(ev.target).hasClass("not_selectable") ) return; //#elements_box

            var target_clicked = ev.target;

            let contextual_menu = '<div id="contextual_menu">\
            <ul class="top-level_out">\
                <li class="objectname">' + ( ev.target.id != "" ? ev.target.id : ev.target.tagName ) +'</li>\
                ' + (ev.target.id == "designarea_pendiente" ? "" : '<li><a href="#"><nav><div class="img_icon"><i class="fa fa-arrows" aria-hidden="true"></i></div>' + data_from_php_contextual.position + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                    <ul class="last-level">\
                        <li><a id="position_absolute" href="#">' + data_from_php_contextual.absolute + '</a></li>\
                        <li><a id="position_relative" href="#">' + data_from_php_contextual.relative + '</a></li>\
                        <li><a id="position_fixed" href="#">' + data_from_php_contextual.fixed + '</a></li>\
                        <li><a id="position_inherit" href="#">' + data_from_php_contextual.inherit + '</a></li>\
                        ' + (ev.target.tagName == "IMG" ? '<li><a id="background-image_url" href="#">' + data_from_php_contextual.asbackground + '</a></li>' : '') + '\
                    </ul>\
                </li>' ) + '\
                <li><a href="#"><nav><div class="img_icon"><i class="fa fa-stack-overflow" aria-hidden="true"></i></div>' + data_from_php_contextual.overflow + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                    <ul class="last-level">\
                        <li><a id="overflow_visible" href="#">' + data_from_php_contextual.visible + '</a></li>\
                        <li><a id="overflow_hidden" href="#">' + data_from_php_contextual.hidden + '</a></li>\
                        <li><a id="overflow_scroll" href="#">' + data_from_php_contextual.scroll + '</a></li>\
                        <li><a id="overflow_auto" href="#">' + data_from_php_contextual.auto + '</a></li>\
                        <li><a id="overflow_inherit" href="#">' + data_from_php_contextual.inherit + '</a></li>\
                    </ul>\
                </li>' + '\
                ' + ( $(ev.target).css('background-image').indexOf('url') != -1 || $(ev.target).css('background-image').indexOf('none') != -1 ? '<li><a href="#"><nav><span><div id="img_box_model" class="img_icon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>' + data_from_php_contextual.background + '</span><i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                     <ul class="">\
                        <li><a href="#"><nav><div class="img_icon"><i class="fa fa-arrows" aria-hidden="true"></i></div>' + data_from_php_contextual.position + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                            <ul class="last-level">\
                                <li><a id="background-position_center" href="#">' + data_from_php_contextual.center + '</a></li>\
                                <li><a id="background-position_left_top" href="#">' + data_from_php_contextual.left_top + '</a></li>\
                                <li><a id="background-position_center_top" href="#">' + data_from_php_contextual.center_top + '</a></li>\
                            </ul>\
                        </li>\
                        <li><a href="#"><nav><div class="img_icon"><i class="fa fa-clone" aria-hidden="true"></i></div>' + data_from_php_contextual.repetition + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                            <ul class="last-level">\
                                <li><a id="background-repeat_repeat" href="#">' + data_from_php_contextual.repeat + '</a></li>\
                                <li><a id="background-repeat_no-repeat" href="#">' + data_from_php_contextual.no_repeat + '</a></li>\
                            </ul>\
                        </li>\
                        <li><a href="#"><nav><div class="img_icon"><i class="fa fa-paperclip" aria-hidden="true"></i></div>' + data_from_php_contextual.attachment + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                            <ul class="last-level">\
                                <li><a id="background-attachment_fixed" href="#">' + data_from_php_contextual.fixed + '</a></li>\
                                <li><a id="background-attachment_scroll" href="#">' + data_from_php_contextual.scroll + '</a></li>\
                            </ul>\
                        </li>\
                        <li><a href="#"><nav><div class="img_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></div>' + data_from_php_contextual.delete + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                            <ul class="last-level">\
                                <li><a id="remove-background-image_delete" href="#">' + data_from_php_contextual.remove + '</a></li>\
                                <li><a id="remove-background-image_none" href="#">' + data_from_php_contextual.set_none + '</a></li>\
                            </ul>\
                        </li>\
                    </ul>' : '') + '\
                <li id="show_parent"><a href="#"><nav><div class="img_icon"><i class="fa fa-object-group" aria-hidden="true"></i></div>' + data_from_php_contextual.parent + '<i class="fa fa-chevron-right" aria-hidden="true"></i></nav></a>\
                <ul class="last-level">\
                    <li><a id="show-parent-select_" href="#">' + data_from_php_contextual.select + '</a></li>\
                    <li><a id="show-parent-add-to-selected_" href="#">' + data_from_php_contextual.add_to_selected + '</a></li>\
                    <li><a id="show-parent-remove-from-selected_" href="#">' + data_from_php_contextual.remove_from_delected + '</a></li>\
                    <li><a id="show-parent-show-contextual-menu_" href="#">' + data_from_php_contextual.show_contextual_menu + '</a></li>\
                </ul>\
            </li>' + '\
                ' + (ev.target.id == "designArea" ? "" : '<li id="delete"><nav><a href="#"><div class="img_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></div>' + data_from_php_contextual.delete + '</a></nav></li>' ) + '\
            </ul></div>';  

            ev.stopPropagation();


            $("#contextual_menu_container").append(contextual_menu);
            
            //comprobar elementos seleccionado si no seleccionado seleccionar si seleccionado actuar sobre seleccionado
            if( !$(ev.target).hasClass("selected") ) {//} &&  ev.target.id != "resizable"){
                $(".selected").removeClass("selected");
                $(ev.target).addClass("selected");
                $(ev.target).trigger("setSelected");    
            } else if ($(".selected").length > 1) {
                    $("#contextual_menu .objectname").text("selection"); // multiple object selected
            }
            
            //final comprobacion   
            
            //set contextual menu position inside window

            let Obj_selected = $("#"+$(".objectname").text());
            let Contextual_top = ev.pageY; //ev.clientY
            let Contextual_left = ev.pageX; //ev.clientX
            let Contextual_height = 500;
            let Contextual_width = 600;

            if ( $(window).height() - (ev.clientY + Contextual_height ) < 0 ) 
                Contextual_top = ev.pageY - ev.clientY + ( $(window).height() - Contextual_height ) ;
            if (Contextual_top < 0) Contextual_top = ev.pageY;

            if ( $(window).width() - (ev.clientX + Contextual_width ) < 0 ) 
                Contextual_left = ev.pageX - ev.clientX + ( $(window).width() - Contextual_width );
            if (Contextual_left < 0) Contextual_left = ev.pageX;
            
            $("#contextual_menu").offset({top: Contextual_top, left: Contextual_left });

            
            $('#contextual_menu').draggable({containment:'document',opacity:'0.7',handle:'.objectname'});
 
            $('#contextual_menu #show_parent').on( {
                'mouseenter' : function(ev){
                                     //$(target_clicked).parent().css("box-shadow","0px 0px 3px 3px red" ); 
                                     //$(target_clicked).parent().css('cssText', 'box-shadow : 0px 0px 3px 3px red !important;' );
                                     $(target_clicked).parent().css('box-shadow', '0px 0px 3px 3px red' );
                },

                'mouseleave' : function(ev){
                                    $(target_clicked).parent().css("box-shadow","" ); 
                }
            });
 
            $('#contextual_menu .last-level li').bind('click',function(ev){
                //ev.stopPropagation();

                if($(this).find("a i").length) return;
                
                $(this).siblings().find("a i").remove();
                $('#'+ev.target.id).append('<i class="fa fa-check" aria-hidden="true"></i>'); //'<img class="menu_arrow" src="' + PathToAdminImages + 'ok.png">'
 
                cssValue = ev.target.id;
                cssProperty = ev.target.id;
                extendObject = {};

                cssValue = cssValue.slice(cssValue.indexOf("_")+1);
                cssValue = cssValue.replace("_", " ");
                cssProperty = cssProperty.slice(0,cssProperty.indexOf("_")).replace(/-/g,"_");
                extendObject[cssProperty] = cssValue;

                switch( cssProperty ) {
                    
                    case "background_image": // set as background-image

                            let myParent;   
                              $('.selected').each(function() {

                                    if ( $(this).parent().data("css") === undefined ) // No data exist for parent type css 
                                        $(this).parent().data("css", {});

                                    if ( $(this).parent().data("hover") === undefined)  //{ // No data exist for parent type hover
                                        $(this).parent().data("hover", {});

                                    if ( $(this).parent().data("withoutcss") === undefined)  //{ // No data exist for parent type withoutcss
                                        $(this).parent().data("withoutcss", {});

                                    withoutcss_set_unset ( $(this).parent(), "background-image", "background_image");
                                    $.extend( $(this).parent().data($('#hoverButton').data("mode")),{ "background_image" : "url(" + $(this).attr('src') + ")" });
                                    $(this).parent().css("background-image", "url(" + $(this).attr('src') + ")"  );
                                    
                                    myParent = $(this).parent();
                                    $(this).remove();
                                    loin_ctrl_update_content(myParent);
                              });

                                    $('#contextual_menu').remove();
                                    $("body").trigger("click"); //object selection
                            break;

                    case "remove_background_image":

                                if ( cssValue == "none") {
                                    $('.selected').each(function() {

                                        withoutcss_set_unset ( this, "background-image", "background_image");
                                        $(this).css("background-image","none");
                                        $.extend( $(this).data($('#hoverButton').data("mode")),{ "background_image" : "none" });

                                    });
                                }
                                else { // cssValue == "delete"
                                    $('.selected').each(function() {

                                        

                                        if ( $('#hoverButton').data("mode") == "css")
                                        {
                                            //withoutcss_set_unset ( this, "background-image", "background_image");
                                            $(this).css("background-image","none");
                                        }
                                        else { 
 
                                                if ( $(this).data("css").background_image === undefined ) {
                                                    $(this).css("background-image", "none");

                                                    //withoutcss_set_unset ( this, "background-image", "background_image");
                                                }
                                                else {

                                                    $(this).css("background-image",$(this).data("css").background_image);

                                                    if($(this).data("css").background_position !== undefined )
                                                        $(this).css("background-position", $(this).data("css").background_position);
                                                    if($(this).data("css").background_repeat !== undefined )
                                                        $(this).css("background-repeat", $(this).data("css").background_repeat);                                                    
                                                   
                                                }
                                        }

                                        delete $(this).data($('#hoverButton').data("mode")).background_image;
                                        delete $(this).data($('#hoverButton').data("mode")).background_position;
                                        delete $(this).data($('#hoverButton').data("mode")).background_repeat;
                                        
                                    });
                                }

                                $('#contextual_menu').remove();
                                break;

                    case "position":
                                $('.selected').each(function() {

                                    $(this).css("top",0).css("left",0);
                                    $.extend( $(this).data($('#hoverButton').data("mode")),{ "top" : 0 });
                                    $.extend( $(this).data($('#hoverButton').data("mode")),{ "left" : 0 });
                                                                                    
                                });
                                
                                break;
                                
                    case "show_parent_select":
                                $(target_clicked).parent().trigger("click");
                                $(target_clicked).parent().css("box-shadow","" );
                                $('#contextual_menu').remove();
                                break;
                    case "show_parent_add_to_selected":
                                $(target_clicked).parent().addClass("selected");
                                $(target_clicked).parent().css("box-shadow","" );
                                $('#contextual_menu').remove();
                                break;
                    case "show_parent_remove_from_selected":
                                $(target_clicked).parent().removeClass("selected");
                                $(target_clicked).parent().css("box-shadow","" );
                                $('#contextual_menu').remove();
                                break;
                    case "show_parent_show_contextual_menu":
                                //$(target_clicked).parent().trigger("click");
                                $(target_clicked).parent().css("box-shadow","" );
                                $('#contextual_menu').remove();
                                $(target_clicked).parent().trigger({
                                    type: 'mousedown',
                                    which: 3
                                });
                                break;
                    default:

                                object_cssProperty = cssProperty;
                                cssProperty = cssProperty.replace(/_/g,"-");

                                $('.selected').each(function() {

                                    withoutcss_set_unset ( this, cssProperty, object_cssProperty);
                                    $(this).css(cssProperty,cssValue ); // add(target_clicked) //.add(target_clicked)
                                    $.extend( $(this).data($('#hoverButton').data("mode")), extendObject);  //ev.target.id
 
            
                                });
       }         
                
            });
            
            $('#contextual_menu li').bind('click',function(ev){
                                
                     
                switch(this.id) { //ev.target


                    case "delete":


                            $('.selected').not("#designArea").each(function() {
                                
                                if ( $(this).data("new") === undefined ) { 
                                    $(this).css("display","none");
                                    $.extend( $(this).data($('#hoverButton').data("mode")),{ "display" : "none" });
                                }
                                else {
                                    $(this).remove();
                                    $(".edit-icons").remove();
                                }    


                            });

                                 
                            $('#contextual_menu').remove();
                            
                            
                            break;
                                    
                           
                    default:
                }
   
                    
            });
            
            $('#contextual_menu .last-level').on('click','img',function(ev){ev.stopPropagation();});   
               

        }

        }); 
 
 });

