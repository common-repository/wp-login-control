//"use strict";
jQuery(document).ready(function($) {

    $("body").attr("id","designArea").attr("ondrop","drop_handler(event)").attr("ondragover","dragover_handler(event)").attr("ondragenter","dragenter_handler(event)").attr("ondragleave","dragleave_handler(event)");
    $("body").addClass("login login-action-login wp-core-ui");

    $("body").data("css", {});
    $("body").data("hover", {});
    $("body").data("withoutcss", {});
    $("body").data("custom", {});

    $("body").on("DOMNodeInserted", ".media-modal, #contextual_menu" , function() { 
        $(this).parent().addClass("not_selectable").find("*").addClass("not_selectable"); 
    }); 

    $("#img_administrator_back").on("click",function(ev){
        // animated css icon
        $("#icons_menu_container").after('<div class="ajax_box_waitting not_selectable"><i class="fa fa-spinner fa-pulse fa-fw lc_centered"></i><span class="lc_centered">Dashboard...</span></div>');
    });


    $("body").on("keydown keypress","input", function(ev) {
        ev.stopPropagation(); // evitamos enviar el "supr" al elemento seleccionado
    });


    $("body").on("keydown", function(ev) { //keypress
        //delete key supr
        //46 && 110 -> supr
        if (ev.which == 46 || ev.which == 110){
            $('.selected').not("#designArea").each(function() {
                
                if ( $(this).data("new") === undefined ) {  //objetos no disenyados con este plugin
                    $(this).css("display","none");
                    $.extend( $(this).data($('#hoverButton').data("mode")),{ "display" : "none" });
                }
                else {

                    //reset origin if id_origin object is deleted
                    if( this.id == id_origin) {
                        $('#img_marker').trigger({
                            type: 'mousedown',
                            which: 3
                        });
                    setTimeout(function(){
                        $("#sliderInfoBox_1").addClass('slideInfoBox_End');
                        }, 500);
                    }

                    let parentId = $(this).parent().attr("id");
                    $(this).remove();
                    if ( parentId != "designArea" ) loin_ctrl_update_content( $("#" + parentId) );
                    $(".edit-icons").remove();


                }    


            });
        }
    });

    $("#designArea").on("selected",".selected",function(ev){
        $(this).trigger("unsetSelected");
        $(this).trigger("setSelected");
        selection_count = $(".selected").length;
    }); 

    $("#designArea").on("click", "#edit-trash", function(ev){
        ev.stopPropagation();
        $(".edit-icons").remove();
        $(".selected").not("#designArea").each(function(){ // only one selected
            let parentId = $(this).parent().attr("id");

            //reset origin if id_origin object is deleted
            if( this.id == id_origin) {
                $('#img_marker').trigger({
                    type: 'mousedown',
                    which: 3
                });
            setTimeout(function(){
                $("#sliderInfoBox_1").addClass('slideInfoBox_End');
                }, 500);
            }

            $(this).remove();
            if ( parentId != "designArea" ) loin_ctrl_update_content( $("#" + parentId) );
        });
    });


    $("#designArea").on("click", "#edit-ok", function(ev){
            ev.stopPropagation();

            loin_ctrl_update_content( $("#" + $("#contenteditableBox").attr("data-element")) );

            $("#contenteditable_container").remove();
            $("#edit-ok").remove();
    });

    $("#designArea").on("click", "#h-up-down", function(ev){
        ev.stopPropagation();
    });

    $("#designArea").on("mousedown", "#h-up-down", function(ev){
        ev.stopPropagation();

        switch (ev.which) {
            case 1:

                        header_number = $(".selected")[0].tagName;
                        header_number = header_number.substring(1);  
                        new_header_number = parseInt(header_number) - 1;
                        if ( new_header_number == 0 ) new_header_number = 6;

                        $(".selected").replaceTag('h' + new_header_number, true);
                                $('body').append('<style>\
                                #h-up-down::after{content:"'+ new_header_number +'"!important;}\
                                </style>');

                        break;
            case 2:
                //alert('Middle Mouse button pressed.');
                        break;
            case 3:
                //  alert('Right Mouse button pressed. ' + this.id + ' ' + ev.target.id);
                header_number = $(".selected")[0].tagName;
                header_number = header_number.substring(1);  
                new_header_number = (parseInt(header_number) % 6 ) + 1;

                $(".selected").replaceTag('h' + new_header_number, true);
                        $('body').append('<style>\
                        #h-up-down::after{content:"'+ new_header_number +'"!important;}\
                        </style>');

                        break;

        }

    });

    $("#designArea").on("click", "#edit-link", function(ev){
        ev.stopPropagation();

    let inputLink = '\
                <div id="msgbox-link" class="lightbox not_selectable">\
                    <div id="msg-box-content" class="box-centered not_selectable">\
		                <div id="form-content" style="position: relative;">\
			                <i id="btn-msg-box-close" style="position: absolute; right: 0;font-size: 20px; margin: 5px;" class="fa fa-times" aria-hidden="true"></i>\
			                <p id="msgboxTitle">Please enter the link</p>\
            				<!-- <label for="link-path">Name</label> -->\
                            <input type="text" name="link-path" id="link-path" placeholder="Link name" class="text ui-widget-content ui-corner-all" autofocus>\
                        </div>\
                        <div id="btn-add-link">\
                            <span class="fa-stack fa-lg">\
                                <i class="fa fa-circle-thin fa-stack-2x"></i>\
                                <i class="fa fa-check fa-stack-1x"></i>\
                            </span>Done\
                        </div>\
                    </div>\
                </div>';
        $("#designArea").append(inputLink);
        $("#link-path").focus();

        if ( $(".selected").data("custom").linkpath != undefined) $("#link-path").val( $(".selected").data("custom").linkpath );

        $("#msgbox-link").click(function(ev){
            ev.stopPropagation();
        });
        $("#btn-add-link").click(function(){
            $.extend( $(".selected").data("custom"), { linkpath : $("#link-path").val()} );
            $("#msgbox-link").remove();
        });
        $("#btn-msg-box-close").click(function(){
            $("#msgbox-link").remove();
        });

    });



    $("#designArea").on("click", "#edit-pencil", function(ev){
        ev.stopPropagation();
        let position;
        let marginBtn = 20;
        
        var element = $(".selected");

        // cuenta hasta <br> y este tambien
        var padre =  $(".selected");
        var hijos =  padre[0].childNodes;

        $(".edit-icons").remove();

        $("#designArea").after('<div id="contenteditable_container" class="designer_tool not_selectable"></div>'); //.selected
        $("#contenteditable_container").append( data_from_php_render_designer_box.contenteditable_structure );

        $("#contenteditableBox").attr("data-element", $(".selected").attr("id"))
                                .css({"font-size" : $(element).css("font-size"),
                                    "font-family": $(element).css("font-family")  
                                });
        if ( content_editable_open.open ) {
            content_editable_open.open = false;
            $("#contenteditable_container").offset({top : content_editable_open.y  , left: content_editable_open.x});   
        }
        else{
            $("#contenteditable_container").offset({ top: window.innerHeight / 2 - $("#contenteditable_container").height() / 2, left: window.innerWidth / 2 - $("#contenteditable_container").width() / 2});
        }



        $('#contenteditable_container.designer_tool').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-menu'}); 


        $('#contenteditable_container.designer_tool').on("dragstart click mousedown", function(ev){
            ev.stopPropagation();
            $(".designer_tool").css("z-index","98");
            $(this).css("z-index","99");
        });

        $("#edit-text-ok").on("click", function(){
            $("#edit-ok").trigger("click"); // patch
        });

        $("#img_clear_text").on("click", function(){
            $("#contenteditableBox div").html("");
            $("#contenteditableBox div:first").focus();
        });

        //text editor for text nodes
        let textNode;

        let textNodeCount = 0;

        let items = $(element).contents();
        let num_items = items.length;
        let last_item_index = num_items - 1;


   
        if( num_items == 0 ){

            $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( 0 ) +'" data-next="" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
            textNode = document.createTextNode("");
            $(element).append(textNode);

        }
        else{
            items.each(function(index,item){

                if(  this.nodeType != 3 ) {  
                    if ( index == 0 ){ // first child node
                        $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( 0 ) +'" data-next="" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                        textNodeCount++;
                        textNode = document.createTextNode("");
                        $(item).before(textNode);

                        if ( num_items == 1) {
                            $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( 2 ) +'" data-next="'+ $(item).attr("id") +'" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                            textNode = document.createTextNode("");
                            $(item).after(textNode);                            
                        }
                        else if ( items.eq(index + 1)[0].nodeType != 3) {
                            $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( ++textNodeCount ) +'" data-next="'+ $(item).attr("id") +'" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                            textNode = document.createTextNode("");
                            $(item).after(textNode);
                        }
                        if (this.nodeType == 1 && this.tagName == "BR") { //this.outerHTML == "<br>"
                            $("#contenteditableBox").append('<div class="return-button" data-index="'+ ( index + textNodeCount ) +'">&crarr;</div>');
                        }
                                        }
                                        else if ( index < last_item_index ) {
                        if (this.nodeType == 1 && this.tagName == "BR") { //this.outerHTML == "<br>"
                            $("#contenteditableBox").append('<div class="return-button" data-index="'+ ( index + textNodeCount ) +'">&crarr;</div>');
                        }
                                                        if ( items.eq(index + 1)[0].nodeType != 3) {
                                                $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( index + ++textNodeCount ) +'" data-next="'+ $(item).attr("id") +'" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                                                textNode = document.createTextNode("");
                                                $(item).after(textNode);
                                            }
                                        }
                                        else{ // el ultimo si mas de uno
                        if (this.nodeType == 1 && this.tagName == "BR") { //this.outerHTML == "<br>"
                            $("#contenteditableBox").append('<div class="return-button" data-index="'+ ( index + textNodeCount ) +'">&crarr;</div>');
                        }
                        $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( index + ++textNodeCount ) +'" data-next="'+ $(item).attr("id") +'" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                        textNode = document.createTextNode("");
                        $(item).after(textNode);
                    }
                }
                else{ // node de texto, con o sin texto
                    $("#contenteditableBox").append('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( index + textNodeCount ) +'" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                    $("#contenteditableBox div:last").html($(item).text());

                }
             });
    }

    $("#contenteditableBox div").attr("ondrop","drop_handler(event)").attr("ondragover","dragover_handler(event)").attr("ondragenter","dragenter_handler(event)").attr("ondragleave","dragleave_handler(event)");

    $("#contenteditableBox div:first").focus();

    $("#contenteditableBox").on({
        mouseenter: function(){
            $("#" + $(this).attr("data-next")).wrap( '<div class="text-position"></div>' );
        },

        mouseleave: function(){
            $("#" + $(this).attr("data-next")).unwrap();
        }
    },"div.text-node");


        $("#contenteditableBox").on("keydown",".text-node", function(ev) {

            ev.stopPropagation(); // evita que supr elimine el objeto

            //if ( ev.shiftKey == false)

            if(ev.keyCode === 13) {
                newLine = document.createElement("br");
                textNode = document.createTextNode("");

                //sumar 2 a las cajas, data-index

                $("#contenteditableBox div:eq( "+ parseInt($(this).attr("data-index")) +" ) ~ div").each(function(){
                    $(this).attr("data-index", parseInt($(this).attr("data-index")) + 2 ); 
                });

                $("#" + $("#contenteditableBox").attr("data-element")).contents().eq($(this).attr("data-index")).after(newLine, textNode);
                     
                $(this).after('<div class="text-node" contenteditable="true" spellcheck="false" data-index="'+ ( parseInt($(this).attr("data-index")) + 2 ) +'" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" ondragenter="dragenter_handler(event)" ondragleave="dragleave_handler(event)"></div>');
                $(this).after('<div class="return-button" data-index="'+ ( parseInt($(this).attr("data-index")) + 1 ) +'">&crarr;</div>');
                $(this).next().next().focus();
                return false;
            };

        });

        $("#contenteditableBox").on("click",".return-button",function(){

            let update_after_index;

            $(this).prev()[0].textContent += $(this).next()[0].textContent;
            update_after_index = $(this).attr("data-index") - 1; //parseInt

            $(this).next().remove();
            $(this).remove();                                                                

            $("#"+ $("#contenteditableBox").attr("data-element")).contents().eq(parseInt($(this).attr("data-index"))).remove();
            $("#"+ $("#contenteditableBox").attr("data-element")).contents().eq(parseInt($(this).attr("data-index"))).remove(); //+ parseInt(1)
            
            //restamos 2 a los cuadros e intro restantes
            $("#contenteditableBox div:eq( "+ update_after_index +" ) ~ div").each(function(){
                $(this).attr("data-index", parseInt($(this).attr("data-index")) - 2 ); 
            });
            


        });

        $("#contenteditableBox").on("DOMSubtreeModified","div.text-node", function(ev) { //.text-node
            $("#" + $("#contenteditableBox").attr("data-element")).contents().eq($(this).attr("data-index"))[0].textContent = $(this).html().replace(/<div>/g, "").replace(/<\/div>/g,"").replace(/<br>/g,"\u000D").replace(/&nbsp;/g,"\u00a0"); 
        });

        $("#contenteditableBox").on("paste","div.text-node", function(ev) { // comprovar y reparar por cada 
            // cancel paste
            ev.preventDefault();

            // get text representation of clipboard
            //var text = ev.clipboardData.getData("text/plain");
            var clipboarddata = "";

            if (event.clipboardData != null/false/undefined) { //ignore the incorrectness of the truncation
            clipboarddata = event.clipboardData;
            } else if (window.clipboardData != null/false/undefined) {
            clipboarddata = window.clipboardData;
            } else { //default to the last option even if it is null/false/undefined
            clipboarddata = event.originalEvent.clipboardData;
            }

            var sel = getSelection();
            var allText = $(this).text();
            var caretStart = window.getSelection().anchorOffset;
            var caretEnd = window.getSelection().focusOffset;

            $(this).text(allText.substring(0,window.getSelection().anchorOffset) +  clipboarddata.getData("text/plain") + allText.substring(window.getSelection().focusOffset))

            var range = document.createRange();


            function selectElementContents(el) {
                var textNode = el.childNodes[0]; //text node is the first child node of a span, div, etc.    
                var range = document.createRange();
                //range.selectNodeContents(el);
                //range.setStart(el,0);
                //range.setEnd(el,2);
                range.setStart(textNode, caretStart);
                range.setEnd(textNode, caretStart);
                var sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
            }

            //var el = document.getElementById("contenteditableBox");
            //selectElementContents(el);
            selectElementContents(this);

        });

        //al seleccionar otro cuadro ejecutar el evento click del mismo
        //si no cuadra el texto al copiarlo podrian ser los bordes del cuadro.
        // posicionar el icono en la posicion del edit-pencil, capturar su psicion X_Y en pantalla y copiar
        $("#designArea").append('<i id="edit-ok" style="left: 120px; top:20px;" class="fa fa-check edit-icons not_selectable" aria-hidden="true"></i>');
        position = $("#contenteditableBox").offset();
        $(".edit-icons").css({ top: position.top + "px",  left: position.left + $("#contenteditableBox").outerWidth() + marginBtn + "px"});
        

        $("#contenteditableBox").focus(); //.attr("creator", $(".selected").attr("id"))

    });


    $("input[type=submit]").on("click", function(ev){ ev.preventDefault(); });

    $("#icons_menu_container").on("click",function(ev){
        ev.stopPropagation();
    });

    $(".designer_tool").on("dragstop", function(ev){ //#designer_box
        switch ( ev.target.id ) {
            case "designer_box":
            case "tags_box":
            case "replaceCode_box":
            case "elements_box":
                                    $(this).toggleClass("collapsed");
                                    $(this).find(".fa:first").toggleClass("fa-caret-right"); //-child
                                    break;
        }

    }); 


    $(".designer_tool").on("click", "h3.fs-menu", function(ev){
        $(this).find(".fa:first-child").toggleClass("fa-caret-right");
        $(this).parents("div").toggleClass("collapsed"); //.find("div").
    });
    
    $(".designer_tool").on("click","h3.fs-submenu", function(ev){
        $(this).find(".fa:first-child").toggleClass("fa-caret-right");
        $(this).next().toggleClass("hide_no_space"); //.find("div").
        //$(".designer_tool").css("z-index","98");
        //$(this).parents("div").css("z-index","99");
    });

    $(".designer_tool h3 .fa-window-minimize").on("click", function(ev){
        $(this).parents("div").hide();
    });


     $("#icons_menu_container i").on("click", function(){

         let toolbox_id = $(this).attr("data-toolbox-id");
         if ( toolbox_id === undefined) return;

         $("#" + toolbox_id).toggle();

         //traer al frente si es visible
         if( $("#" + toolbox_id).is(":visible")) {
             zMax = 0;

             $(".designer_tool:visible").each(function(){
                if ( zMax <  parseInt($(this).css("z-index")) ){
                    zMax = parseInt($(this).css("z-index"));
                }
             });
             $("#" + toolbox_id).css("z-index", zMax + parseInt(1));

             $("#" + toolbox_id).removeClass("collapsed");

             if ( toolbox_id == "tags_box" || toolbox_id == "replaceCode_box" ) {
                $( "#" + toolbox_id + " div:first").trigger("click"); //patch, prevents the minimize icon from disappearing
            }
         } 
         
     });
        

    var multiselectStarted = false;
    var topStarted;
    var leftStarted;


    //*********** hoverButton *///

    $('#hoverButton').change( function(){

        if( $(this).is(':checked') ) {
             
             $(this).data("mode","hover");

             $('#designArea, #designArea *').filter(function() {
                return $(this).data('hover') !== undefined; //css
                }).each(function(){
                    //let code_string = "";
                    let object_css = $(this).data("hover");
                    let $this = this; 

                    $.each(object_css, function( prop, value) {
                        $($this).css( prop.replace(/_/g,"-"), value);
                    });

                });

        } else
        
        {
             $(this).data("mode","css");

             $('#designArea, #designArea *').filter(function() {
                return $(this).data('css') !== undefined;
                }).each(function(){
                    //let code_string = "";
                    let object_css = $(this).data("css");
                    let $this = this; 

                    $.each(object_css, function( prop, value) {

                        $($this).css( prop.replace(/_/g,"-"), value);

                    });


                    object_css = $(this).data("withoutcss");

                    $.each(object_css, function( prop, value) {

                        $($this).css( prop.replace(/_/g,"-"), value);

                    });




                 });
        }


        if ( $("#box_text_font, #box_model, #box_flex_box").length) updateCombos();
        if ( $("#box_color").length) updateColor(); // data necesita ser definido antes

    });

    //************ patternSwitch */
    $('#patternButton').change( function(){
        
        if( $(this).is(':checked') ) 

            $("#designArea").css("background-image", "url(" + PathToAdminImages + "transparent.png)");

        else

            $("#designArea").css("background-image", "none");


    });

    //

        //*********** RetinaSwitch *///

    $('#retinaswitch').change( function(){


        //alert("is HightDensity :" + isHighDensity());
        //alert("is Retina :" + isRetina());
        let file_sufix; //retina sufix
        let Patterntolookfor;

        // if ( ! isRetina() ) return;

        if( $(this).is(':checked') ) {
            file_sufix = "@x2"; //retina sufix
            Patterntolookfor = ".";
        }
        else {
            file_sufix = "";
            Patterntolookfor = "@x2";
        }


            $('#designArea, #designArea *').filter(function() {
            return $(this).data('hover') !== undefined || $(this).data('css') !== undefined || $(this).data('withoutcss') !== undefined; 
            }).each(function(){
                

                if ($(this).data('css') !== undefined)
                    if ($(this).data('css').background_image !== undefined && $(this).data('css').background_image.lastIndexOf(".") != -1 ) {

                        var url_file = $(this).data('css').background_image;
                        var url_newfile = url_file.substr(0, url_file.lastIndexOf(Patterntolookfor)) || url_file;
                        var extension_file = url_file.substr(url_file.lastIndexOf(".")) || url_file;
                        //alert( url_newfile + file_sufix + extension_file );
                        $(this).data('css' , { "background_image" : url_newfile + file_sufix + extension_file });
                        $(this).css("background-image", url_newfile + file_sufix + extension_file );
                        // regrabar el nom del fitxer millor
                    }
                        
                if ($(this).data('hover') !== undefined)
                    if ($(this).data('hover').background_image !== undefined && $(this).data('hover').background_image.lastIndexOf(".") != -1) {

                        var url_file = $(this).data('hover').background_image;
                        var url_newfile = url_file.substr(0, url_file.lastIndexOf(Patterntolookfor)) || url_file;
                        var extension_file = url_file.substr(url_file.lastIndexOf(".")) || url_file;
                        //alert( url_newfile + file_sufix + extension_file );
                        //$(this).css("background-image", "url(" + $(this).attr('src') + ")"  );
                    }
                if ($(this).data('withoutcss') !== undefined)
                    if ($(this).data('withoutcss').background_image !== undefined && $(this).data('withoutcss').background_image.lastIndexOf(".") != -1) {

                        var url_file = $(this).data('withoutcss').background_image;
                        var url_newfile = url_file.substr(0, url_file.lastIndexOf(Patterntolookfor)) || url_file;
                        var extension_file = url_file.substr(url_file.lastIndexOf(".")) || url_file;
                        //alert( url_newfile + file_sufix + extension_file );
                        //$(this).css("background-image", "url(" + $(this).attr('src') + ")"  );
                    }


/*                let object_css = $(this).data("hover");
                $this = this; 

                $.each(object_css, function( prop, value) {
                    $($this).css( prop.replace(/_/g,"-"), value);
                });
*/
            });


     

});


    $('#hoverButton').trigger("change");

    //**************** click *******************//

    $(" #designArea ").on("click", function(ev){
        //alert(ev.target.id);

        if( ev.target.id == "contenteditableBox" ) return;
        if( formType == "ObjectBlank" && ev.target.id == "designArea") return;

        let position;
        let marginBtn = 20;

        if ( $(ev.target).parents(".not_selectable").length ) return;
        ev.stopPropagation();  // termina la propagacion de eventos // window.event.cancelBubble = true
        
        $("#target_selected").text(ev.target.tagName);

        if (ev.ctrlKey) {
            
            if (jQuery(ev.target).hasClass("selected")  && jQuery(".selected").length == 1 ) {  //trying deselect last element not allowed
                //nothing               
            } else if (jQuery(ev.target).hasClass("selected") && jQuery(".selected").length == 2 ) {
                jQuery(ev.target).toggleClass("selected");
                jQuery(".selected:first").trigger("selected");
                
            }
            
            else{
                jQuery(ev.target).toggleClass("selected");
                jQuery(".selected:first").trigger("selected");
                if ($("#edit-ok").length) $("#edit-ok").trigger("click");
                $(".edit-icons").remove();
            }
            
        }

        else {
                jQuery(".selected").removeClass("selected").removeClass("selectedover");//.children("i.edit-icons").remove();//.removeClass("edit-icons");
                $(".edit-icons").each(function(){
                    if (this.id == "edit-ok") {
                        $(this).trigger("click");
                    
                    }
                    else {
                        $(this).remove();
                    }
                });
                jQuery(ev.target).addClass("selected");
                if ( ev.target.hasAttribute("object") ) { //&& jQuery(ev.target).attr("object") != "img" && jQuery(ev.target).attr("object") != "i"
                    //jQuery(ev.target).addClass("edit-icons");
                    let shortcode_variables_array = "Empty";

                if (jQuery(ev.target).data("custom").Shortcode_variable_name !== undefined && jQuery(ev.target).data("custom").Shortcode_variable_name.length > 0 ){
                    shortcode_variables_array = "";
                    jQuery.each ( jQuery(ev.target).data("custom").Shortcode_variable_name, function( index, value){
                        //crear la linea con el icono basura
                        shortcode_variables_array = shortcode_variables_array + '<div class="line-delete">' + '<i  class="fa fa-trash-o not_selectable" data-remove-variable-name="' + value.name + '" ></i>' + value.name + '</div>';
                    });
                }
                if ( jQuery(ev.target).attr("object") != "hr" && jQuery(ev.target).attr("object") != "img" && jQuery(ev.target).attr("object") != "i"){
                    jQuery("#designArea").append('<i id="edit-pencil" class="fa fa-pencil-square-o edit-icons not_selectable" aria-hidden="true"></i>');
                    jQuery("#designArea").append('<i id="edit-trash" class="fa fa-trash-o edit-icons not_selectable" aria-hidden="true"></i>');
                    jQuery("#designArea").append('<i id="edit-ellipsis" class="fa fa-ellipsis-v edit-icons tooltip not_selectable" aria-hidden="true"><span class="tooltiptext">\
                                                ' + shortcode_variables_array + '\
                                                </span></i>');
                }
                else if ( jQuery(ev.target).attr("object") != "img" || jQuery(ev.target).attr("object") != "i"){
                    jQuery("#designArea").append('<i id="edit-trash" style="margin-top: 0;" class="fa fa-trash-o edit-icons not_selectable" aria-hidden="true"></i>');
                    jQuery("#designArea").append('<i id="edit-ellipsis" style="margin-top: 50px;" class="fa fa-ellipsis-v edit-icons tooltip not_selectable" aria-hidden="true"><span class="tooltiptext">\
                                                ' + shortcode_variables_array + '\
                                                </span></i>');
                }
                else {
                    jQuery("#designArea").append('<i id="edit-trash" style="margin-top: 0;" class="fa fa-trash-o edit-icons not_selectable" aria-hidden="true"></i>');
                }
                if ( jQuery(ev.target).attr("object") == "a"){
                    jQuery("#designArea").append('<i id="edit-link" class="fa fa-link edit-icons not_selectable" aria-hidden="true"></i>');
                }
                switch ( jQuery(ev.target).attr("object") ){

                    case "h1":
                    case "h2":
                    case "h3":
                    case "h4":
                    case "h5":
                    case "h6":
                                jQuery("#designArea").append('<i id="h-up-down" class="fa fa-header edit-icons not_selectable" aria-hidden="true"></i>');
                                $('body').append('<style>\
                                #h-up-down::after{content:"'+ jQuery(ev.target).attr("object").substring(1) +'"!important;}\
                                </style>');
                }
                position = $(ev.target).offset();

                $(".edit-icons").css({ top: position.top + "px",  left: position.left + $(ev.target).outerWidth() + marginBtn + "px"});

                $(".edit-icons").on("reposition", function(){
                    let position;
                    let marginBtn = 20;

                    position = $(".selected").offset();
                    $(".edit-icons").css({ top: position.top + "px",  left: position.left + $(".selected").outerWidth() + marginBtn + "px"});
                });

               }
            jQuery(ev.target).trigger("selected");

        }

        // update color in designArea
        
        if ( $(ev.target).attr("id") == "designArea") {
            if($(ev.target).hasClass("selected")) updateColor();
        }

        // reopen content_editable_box
        if ( content_editable_open.open ){
            $("#edit-pencil").trigger("click");
        }

    }); // end //


//hover css for objects//    

    //$("#designArea *").not(" #selectionbox, #resizeWrap, not_selectable, not_selectable * ").add("#resizeWrap .template").hover( function(){
        $("#designArea").on({
            
            mouseenter: function(){
                
                let object_css_hover = $(this).data("hover");  //if undefined $.each works too.

                let self = this;

                $.each(object_css_hover, function(key, element) {
                    $(self).css( key.replace(/_/g,"-") ,element );
                });

            },
            
            mouseleave: function(){

                if ( $('#hoverButton').data("mode") == "hover") return;  //evitamos cambiar a css si el modo es hover

                let object_css = $(this).data("css"); 
                let object_css_hover = $(this).data("hover"); 

                let object_css_merged = $.extend( {} , object_css, $(this).data("withoutcss") ); //merge $(this).data("withoutcss") into object_css
    
                let self = this;

                $.each(object_css_hover, function(key, element) {
                    $(self).css( key.replace(/_/g,"-") ,object_css_merged[key] );
                });

            },

        },"*" ); //end// //  *[object] -> cambiar por este pero en login se tendra que cambiar la plantilla, mas rapido

     //***************selected efect**************//

      $("#designArea").on({
           
        mouseenter: function(ev) { 

            $(".selectedover").removeClass("selectedover");
            $(ev.target).addClass("selectedover");

        },
        
        mouseleave: function(ev) {
            if($(this).parent().attr("id") == "resizeWrap") return; // return if father is resizeWrap
            $(this).removeClass("selectedover");
            if ($(this).parent().attr("id") != "designArea") $(this).parent().addClass("selectedover");
        }
        
    },"*:not( #selectionbox, .not_selectable, .not_selectable *, .media-modal-content)"); 


    //**************************//

    var mouse_up = false;
    var target_starter;  // object clicked on selection start

    $("#designArea").on({
        
        
        mousedown: function(ev){

            if ( $(ev.target).hasClass('not_selectable') || ( $(ev.target).hasClass('selected') && ev.target.id != 'designArea' ) ) return;

            mouse_up = false;
            target_starter = ev.target;

            if ( ev.which == 1) { 
                
                setTimeout(function() {

                    if ( ! mouse_up ) {

                        $("#selectionbox").remove(); // por si salimos sin hacer click
                        multiselectStarted = true;   
                        $("#designArea *").css("pointer-events","none");
                        //anadimos cuadrado de seleccion
                        var selectionbox = $("<div id='selectionbox' class='selectionbox'></div>");

                        $(selectionbox).appendTo("#designArea"); 
                        $(selectionbox).offset({top: ev.pageY, left: ev.pageX });// clientY, clientX

                        topStarted = ev.pageY;
                        leftStarted = ev.pageX;

                    }
                
                } , 200);  // poner variable para poder cambiar velocidad en opciones para el usuario

                
            }
        },
        
        mouseup: function(ev){

            mouse_up = true;

            if (multiselectStarted) {
              
                let selectionboxWidth = $("#selectionbox").outerWidth() / 2;
                let selectionboxHeight = $("#selectionbox").outerHeight() / 2;
                let selectionboxMiddlePointX = $("#selectionbox").offset().left + selectionboxWidth;
                let selectionboxMiddlePointY = $("#selectionbox").offset().top + selectionboxHeight;
  
                let ThisWidth;
                let ThisHeight;            
                let ThisMiddlePointX;
                let ThisMiddlePointY;
                let a = 0, b = 0;
                let firstTime = true;
                //collision detection
                let objectElements;
                
                if (ev.ctrlKey) 
                    objectElements = $(target_starter).find("*").not("#selectionbox").not("#resizeWrap").not(".not_selectable, .not_selectable *, span.content"); 
                else 
                    objectElements = $("#designArea *").not("SCRIPT, STYLE").not("#selectionbox").not("#resizeWrap").not(".not_selectable, .not_selectable *, span.content").add("#resizeWrap .template"); 

                objectElements.each(function(){

                    ThisWidth = $(this).outerWidth() / 2;
                    ThisHeight = $(this).outerHeight() / 2;
                    ThisMiddlePointX = $(this).offset().left + ThisWidth;
                    ThisMiddlePointY = $(this).offset().top + ThisHeight;
                    a = Math.abs(ThisMiddlePointX - selectionboxMiddlePointX);
                    b = Math.abs(ThisMiddlePointY - selectionboxMiddlePointY);
    
               
                    if ( a <= ( selectionboxWidth + ThisWidth ) && b <= ( selectionboxHeight + ThisHeight ) ) { // collision detected

                         if (firstTime){
                            $(".selected").removeClass("selected");    
                            firstTime = false;
                            
                            $(this).addClass("selected");
                            $(this).trigger("selected"); 
                            
                         }
                         else 
                            $(this).addClass("selected");
                                                     
            
                    }

                });

                $(".selected:last").trigger("setSelected");                    // jQuery.event.trigger("setSelected");
                
                $("#selectionbox").remove();
                multiselectStarted = false;
                selection_count = $(".selected").length;
                $("#designArea *").css("pointer-events","initial"); //initial or ""
            }
            

            if ( circleDragging && circleDragStarted) {  //resizing
                

                circleDragging = false;

                
                circleDragStarted = false;

                $(".circle_red, .circle_blue, .circle_purple").remove();

            $("<div class='circle_blue'></div>").appendTo($("#resizeWrap"));
            $("<div class='circle_purple'></div>").appendTo($("#resizeWrap"));
            $("<div class='circle_red'></div>").appendTo($("#resizeWrap"));


            thisWrap = $("#resizeWrap");

            $(".circle_red").css({top: $(thisWrap).height() - circleRadius ,left: $(thisWrap).width() - circleRadius});
    
            $(".circle_blue").css({top: $(thisWrap).height() /2 - circleRadius,left: $(thisWrap).width() - circleRadius});  
            $(".circle_purple").css({top: $(thisWrap).height() - circleRadius,left: $(thisWrap).width()/2 - circleRadius});
                
            }
            

            
        },
        
        mousemove: function(ev){
            
            if ( $("#selectionbox").length ) { // squre for select object is defined
            
                if (ev.pageX < leftStarted ) {  //$("#selectionbox").offset().left
                    $(selectionbox).offset({left: ev.pageX });
                    $("#selectionbox").width(leftStarted - ev.pageX);
                }
                else{
                    $(selectionbox).offset({left: leftStarted });
                    $("#selectionbox").width(ev.pageX - $("#selectionbox").offset().left);
                }
    
    
                if (ev.pageY < topStarted ) {  //$("#selectionbox").offset().left
                    $(selectionbox).offset({top: ev.pageY });
                    $("#selectionbox").height(topStarted - ev.pageY);
                }
                else{
                    $(selectionbox).offset({top: topStarted });
                    $("#selectionbox").height(ev.pageY - $("#selectionbox").offset().top);
                }       
                
                
                //************************ circle center *************

            } else if(circleDragging) {


        let cursorX = ev.clientX;
        let cursorY = ev.clientY;

        //$("#debugger").html("Cursor X: " + cursorX + " Cursor Y " + cursorY + "</br> resize_ghost_top offset Top: " + $("#resize_ghost_top").offset().top + "</br> resize_ghost_top offset left: " + $("#resize_ghost_top").offset().left + "</br> resize_ghost_top Top: " + $("#resize_ghost_top").position().top + "</br> resize_ghost_top left: " + $("#resize_ghost_top").position().left );

        let currentCircle = circleRedObject;
        if(currentCircle == null)  currentCircle = circleBlueObject;
        if(currentCircle == null)  currentCircle = circlePurpleObject;

        $(currentCircle).offset({top: cursorY - circleCenterDifY - circleRadius   , left: cursorX - circleCenterDifX - circleRadius  });  //circleRedObject

        let angulo = Math.atan((cursorY - ObjectOffsetY) / (cursorX - ObjectOffsetX));


        let hipotenusa = Math.sqrt(Math.pow((cursorY - ObjectOffsetY - circleCenterDifY) , 2) + Math.pow((cursorX - ObjectOffsetX - circleCenterDifX), 2));

        /*
        let SelectedObjDegCss = $(".selected:first").data("css").transform;
        if (SelectedObjDegCss) {

            if(SelectedObjDegCss.indexOf("rotate(") > -1) {
                
                SelectedObjDegCss = SelectedObjDegCss.slice(SelectedObjDegCss.indexOf("rotate(")+7);
                SelectedObjDegCss = SelectedObjDegCss.slice(0,SelectedObjDegCss.indexOf("deg)"));
            }
        }

        let thisWrap = $("#resize_ghost_top");

        */

        angulo =  (angulo * 180 / Math.PI) ;
        //angulo1 = 90 - parseFloat(SelectedObjDegCss) - angulo1; 


        y =  Math.sin(angulo * Math.PI / 180) * hipotenusa;

        x =  Math.cos(angulo * Math.PI / 180) * hipotenusa;


            if(ev.shiftKey) {
                if(circleBlueObject) $(SelectedObjects).add("#resizeWrap").add('#resize_ghost_left').add('#resize_ghost_right').outerHeight( x );
                else $(SelectedObjects).add("#resizeWrap").add('#resize_ghost_top').add('#resize_ghost_bottom').outerWidth( y );
            }

            if( circleRedObject || circleBlueObject ) $(SelectedObjects).add("#resizeWrap").add('#resize_ghost_top').add('#resize_ghost_bottom').outerWidth( x ); //#resize_ghost_top,
            if( circleRedObject || circlePurpleObject ) $(SelectedObjects).add("#resizeWrap").add('#resize_ghost_left').add('#resize_ghost_right').outerHeight( y ); //#resize_ghost_top,



        ///////////////////////////////

                    }

                    else if ($(".move").length) {

                        ev.stopPropagation();
                        ev.preventDefault();
                        //$(".move").offset({top : (ev.pageY - 20)  , left: (ev.pageX - 50)});
                        $(".move").offset({top : (ev.pageY - dif_mov_y )  , left: (ev.pageX - dif_mov_x)});
                    }

                }
                
    }); // ,"*:not( #selectionbox, .not_selectable, .not_selectable *)"


/* ************************************************** */

    $("#designArea").on("unsetSelected",".selected",function(ev){


    /*    let prevSelected = $("#resize_ghost_top");

        if ( prevSelected.length ) {

            ThisObj = $("#resizeWrap").children(".template");

            $(".circle_red, .circle_blue, .circle_purple").remove();

            $("#resize_ghost_top, #resize_ghost_left, #resize_ghost_right, #resize_ghost_bottom").remove();

            $(ThisObj).removeClass("selectedover");

            $(ThisObj).unwrap(); // delete resizeWrap


            $(ThisObj).css("margin-left", $(ThisObj).data("css").margin_left );
            $(ThisObj).css("margin-right", $(ThisObj).data("css").margin_right );
            $(ThisObj).css("margin-top", $(ThisObj).data("css").margin_top );
            $(ThisObj).css("margin-bottom", $(ThisObj).data("css").margin_bottom );

            $(ThisObj).css("top",$(ThisObj).data("css").top);
            $(ThisObj).css("left",$(ThisObj).data("css").left);

        }
*/
    });

    
    $("#designArea").on("setSelected",".selected",function(ev){  

        $(".selected").each(function(){

            if ( $(this).data("css") === undefined ) {// No data exist for type css 

                $(this).data("css", {});

            }

            if ( $(this).data("hover") === undefined) { //{ // No data exist for type hover

                $(this).data("hover", {});

            }

            if ( $(this).data("withoutcss") === undefined) { //{ // No data exist for type hover

                $(this).data("withoutcss", {});

            }


            if ( $(this).data("custom") === undefined) { //{ // No data exist for type hover
                
                $(this).data("custom", {});
                
            }

        });


        if ( $("#box_text_font, #box_model, #box_flex_box").length) updateCombos();
        if ( $("#box_color").length) updateColor(); // data necesita ser definido antes


            /*        ThisObj = $(".selected:first");
            //      $(ThisObj).trigger("UpdateCodeBox");
            //      $(ThisObj).trigger("UpdateBoxModel");


                    if ( ThisObj.length ) {

                        //$(ThisObj).addClass("selectedSet");
                        $(ThisObj).wrap("<div id='resizeWrap' style='position:"+ $(ThisObj).css("position") +"; margin-top:"+ $(ThisObj).css("margin-top") +"; margin-left:"+ $(ThisObj).css("margin-left")  +"; margin-right:"+ $(ThisObj).css("margin-right")  +"; margin-bottom:"+ $(ThisObj).css("margin-bottom") +"; width:"+ $(ThisObj).outerWidth() +"px; height:"+ $(ThisObj).outerHeight() +"px; display: inline-block;border: 0px solid red;'></div>"); //border: 0px solid red;


            $.extend( $(ThisObj).data("css"),{"margin_top" : $(ThisObj).css("margin-top")});
            $.extend( $(ThisObj).data("css"),{"margin_left" : $(ThisObj).css("margin-left")});
            $.extend( $(ThisObj).data("css"),{"margin_bottom" : $(ThisObj).css("margin-bottom")});
            $.extend( $(ThisObj).data("css"),{"margin_right" : $(ThisObj).css("margin-right")});

            $(ThisObj).css("margin", 0 ); //guarda margins

            ObjectOffsetY = $("#resizeWrap").offset().top;
            ObjectOffsetX = $("#resizeWrap").offset().left;

            $("#resizeWrap").append("<div class='designer' id='resize_ghost_top' style='position: absolute;'></div>");
            $("#resizeWrap").append("<div class='designer' id='resize_ghost_left' style='position: absolute;'></div>");
            $("#resizeWrap").append("<div class='designer' id='resize_ghost_right' style='position: absolute;'></div>");
            $("#resizeWrap").append("<div class='designer' id='resize_ghost_bottom' style='position: absolute;'></div>");

            
            let thisWrap = $("#resizeWrap");
            let ghostSquare = $("#resize_ghost_top");
            let ghostSquareleft = $("#resize_ghost_left");
            let ghostSquareRight = $("#resize_ghost_right");
            let ghostSquareBottom = $("#resize_ghost_bottom");
            
          


                      $(ghostSquare).css("top", 0); // + parseInt($($this).css("marginTop").replace('px', ''))
                      $(ghostSquare).css("left", 0); // + parseInt($($this).css("marginLeft").replace('px', ''))

                      $(ghostSquareBottom).css("bottom", 0);
                      $(ghostSquareBottom).css("left", 0);

                      $(ghostSquareleft).css("top", 0); 
                      $(ghostSquareleft).css("left", 0);

                      $(ghostSquareRight).css("top", 0); 
                      $(ghostSquareRight).css("right", 0);
                      
                      
                      $(ghostSquare).outerWidth($(thisWrap).outerWidth());
                        $(ghostSquareBottom).outerWidth($(thisWrap).outerWidth());
                      
                        $(ghostSquareleft).outerHeight($(thisWrap).outerHeight());
                      $(ghostSquareRight).outerHeight($(thisWrap).outerHeight());


            if (!ev.shiftKey) $("<div id='resizeBottomRight' class='circle_red designer'></div>").appendTo(thisWrap);

            $("<div class='circle_blue designer'></div>").appendTo(thisWrap);
            $("<div class='circle_purple designer'></div>").appendTo(thisWrap);
            circleRadius = $(".circle_blue").width()/2;


            if (!ev.shiftKey) circleRedObject = $(".circle_red");

            circleBlueObject = $(".circle_blue");
            circlePurpleObject = $(".circle_purple");
            if (!ev.shiftKey) $(circleRedObject).css({top: $(thisWrap).height() - circleRadius ,left: $(thisWrap).width() - circleRadius});
    
            $(circleBlueObject).css({top: $(thisWrap).height() /2 - circleRadius,left: $(thisWrap).width() - circleRadius});  
            $(circlePurpleObject).css({top: $(thisWrap).height() - circleRadius,left: $(thisWrap).width()/2 - circleRadius});

        }
*/
    });


/* ************************************************** */


// javascript for Box variables
$("#designArea").on({
    mouseenter: function(){
        $(this).find("i").css("visibility","visible");
    }, 
    mouseleave: function(){
        $(this).find("i").css("visibility","hidden");
    }
},".line-delete");


$("#designArea").on("click",".line-delete",function(ev){
    ev.stopPropagation();
});

$("#designArea").on("click","div.line-delete i",function(){

    for(var i = 0 ; i < $(".selected").data("custom").Shortcode_variable_name.length ; i++){
        if( $(".selected").data("custom").Shortcode_variable_name[i].name.indexOf( $(this).attr("data-remove-variable-name") ) != -1 ) {
            $(".selected").data("custom").Shortcode_variable_name.splice(i,1);
        }
    }

    if( $(".selected").data("custom").Shortcode_variable_name.length == 0)
        $("#edit-ellipsis .tooltiptext").text("Empty");

    $(this).parent().remove();
});

    $("#replaceCode_box").on("click",".delete-user-variable", function(){

        for(var i = 0 ; i < user_variables.length ; i++){
            if( user_variables[i].name.indexOf( $(this).attr("delete-parent") ) != -1 ) {
                user_variables.splice(i,1);
            }
        }

        $("#replacecode_" + $(this).attr("delete-parent")).parent().remove();
    });

$("#replaceCode_box").on({
    mouseenter: function(){
        $(this).find("i").css("visibility","visible");
    }, 
    mouseleave: function(){
        $(this).find("i").css("visibility","hidden");
    }
},".user-variable");


$("#replaceCode_box").on("change",".case-combo, .case-text", function(){

    for(var i = 0 ; i < user_variables.length ; i++){
        if( user_variables[i].name.indexOf( $(this).parents("[edit-parent]").attr("edit-parent") ) != -1 ) {
            user_variables[i][$(this).attr("data-obj-name")] = $(this).val();
        }
    }


});

    $("#add_variable").on("click", function(){
        let inputVariable = '\
        <div id="msgbox-variable" class="lightbox not_selectable">\
            <div id="msg-box-content" class="box-centered not_selectable">\
                <div id="form-content" style="position: relative;">\
                    <i id="btn-msg-box-close" style="position: absolute; right: 0;font-size: 20px; margin: 5px;" class="fa fa-times" aria-hidden="true"></i>\
                    <p id="msgboxTitle">' + data_from_php_render_designer_box.title + '</p>\
                    <!-- <label for="variableName">Name</label> -->\
                    <input type="text" name="variableName" id="variableName" placeholder="Variable name" class="text ui-widget-content ui-corner-all" autofocus>\
                    <!--<label>VariableType</label> -->\
                    <select id="VariableType" style="display: block;margin-left: 10%; font-size: 20px;">\
                            <option value="text" selected="selected">Text</option>\
                    ' + data_from_php_render_designer_box.combo_type + '\
                    </select>\
                </div>\
                <div id="btn-add-variable">\
                    <span class="fa-stack fa-lg">\
                        <i class="fa fa-circle-thin fa-stack-2x"></i>\
                        <i class="fa fa-check fa-stack-1x"></i>\
                    </span>' + data_from_php_render_designer_box.button + '\
                </div>\
            </div>\
        </div>';

        $("#designArea").append(inputVariable);
        $("#variableName").focus();

        $("#btn-msg-box-close").click(function(){
            $("#msgbox-variable").remove();
        });

        $("#btn-add-variable").click(function(){
            let variable_tooltip = "";
            let variable_type = $("#VariableType").val();
            let variable_name = $("#variableName").val().toLowerCase();
            if (variable_name.length) {
            
            switch ( variable_type ) {
                case "text":
                            variable_tooltip = data_from_php_render_designer_box.case_text;
                            user_variables.push({
                                name: variable_name,
                                type: variable_type,
                                default: ""
                            });
                            break;
                case "attribute":
                            variable_tooltip = data_from_php_render_designer_box.case_attribute;
                            user_variables.push({
                                name: variable_name,
                                type: variable_type,
                                default: "",
                                attr_type: "href"     // default in combo
                            });
                            break;

            }

                $("#replaceCode_box > div").append('\
                    <div class="user-variable">\
                        <div id="replacecode_'+ variable_name +'" draggable="true" ondragstart="drag(event)" object="replacecode_element" attr_type="'+ variable_type +'" class="not_selectable">\
                        '+ variable_name +'\
                        </div>\
                        <i class="fa fa-trash-o delete-user-variable" delete-parent="'+ variable_name +'" aria-hidden="true"></i>\
                        <i class="fa fa-cog edit-user-variable tooltip" edit-parent="'+ variable_name +'" aria-hidden="true">\
                        '+ variable_tooltip +'\
                        </i>\
                    </div>\
                ');

                //user_variables[variable_name] = variable_type;

            }
    
            $("#msgbox-variable").remove();
        });

    });
//

}); // end jQuery(document).ready


function dragenter_handler(ev) {
    //ev.preventDefault();
    if ( ! ( jQuery(ev.target).hasClass('not_selectable') || jQuery(ev.target).parents().hasClass('not_selectable') ) ) {
        jQuery(ev.target).addClass("selectedover");

    }

}

function dragleave_handler(ev) {

    //ev.preventDefault();
    jQuery(ev.target).removeClass("selectedover");

}

function dragover_handler(ev) {

    ev.preventDefault();
//jQuery("#imatge_amb_ghost").css("pointer-events", "none");
}

function drag(ev) {

    ev.dataTransfer.clearData();

    ev.dataTransfer.setData("text/plain", ev.target.id); //text/plain
    ev.dataTransfer.effectAllowed = "move"; //copy
    
    // Now we'll create a dummy image for our dragImage
    //var dragImage = document.createElement('div');
    //pointer-events: none; 
    //dragImage.setAttribute('style', 'position: absolute; left: 0px; top: 0px; width: 40px; height: 40px; background: red;');
    //document.body.appendChild(dragImage);

    switch ( jQuery(ev.target).attr("object") ) {

        case "image_template":



                            var image_path = jQuery(ev.target).css("background-image");
                            image_path = image_path.replace(/"/g,'');

                            var dragImage = document.createElement("img");
                            dragImage.id = "ghostImage";
                            dragImage.setAttribute('style', 'position: absolute; left: -999px; top: -999px; width: 64px; height: 64px; object-fit: contain;');
                            dragImage.src = image_path.substring(4,image_path.length -1);
                            document.body.appendChild(dragImage);
                            // And finally we assign the dragImage and center it on cursor
                            ev.dataTransfer.setDragImage(dragImage, 0, 0);
                            //jQuery("#ghostImage").remove();
                            break;

        case "tag_element":
                            //default drag & drop
                            break;

    }

}

function drop_handler(ev) {

    ev.preventDefault();   

    let offset;
    
    var data= ev.dataTransfer.getData("text");

    var itm = document.getElementById(data);

    //#edit-ellipsis

    // for edit contenteditable
    if(jQuery(ev.target).parents("#contenteditable_container").length){
        let variable_name = jQuery(itm).attr("id").substring(12);
        ev.target.textContent = ev.target.textContent + "{" + variable_name + "}";
    }
    // end edit contenteditable

    if ( jQuery(ev.target).parents(".designer_tool").length || jQuery(ev.target).parents("#icons_menu_container").length || ev.target.id == "icons_menu_container" ) return;  

    jQuery(itm).data("css", {});
    jQuery(itm).data("hover", {});
    jQuery(itm).data("withoutcss", {});
    jQuery(itm).data("custom", {});

    //to know the first positioned parent 
    itm_check = document.createElement("div");
    jQuery(itm_check).attr("id","only_check");
    ev.target.appendChild(itm_check);
    offset = jQuery("#only_check").offsetParent().offset();
    jQuery("#only_check").remove();

    switch (jQuery(itm).attr("object")) {

        case "image_template":
                            var image_path = jQuery(itm).css("background-image");
                            image_path = image_path.replace(/"/g,'');

                            if ( ev.target.tagName.toUpperCase() == "IMG") { // overwrite image
                                jQuery(ev.target).attr("src",image_path.substring(4,image_path.length -1));
                                jQuery(ev.target).data("new").src = image_path.substring(4,image_path.length -1);
                                //ev.dataTransfer.clearData();
                                jQuery("#ghostImage").remove();  // remove dragImage
                                return;
                            }

                            itm = document.createElement("img");
                            jQuery(itm).attr("src",image_path.substring(4,image_path.length -1));
                            jQuery(itm).attr("object","img");

                            ////// jQuery(itm).attr("draggable","true");
                            
                            jQuery(itm).css( "position", obj_pos_on_creation); //"absolute"
                            jQuery(itm).data("css", { position: obj_pos_on_creation });

                            if( obj_pos_on_creation == "absolute") {
                                jQuery(itm).offset({top: ev.pageY - offset.top});
                                jQuery(itm).offset({left: ev.pageX - offset.left});

                                jQuery.extend(jQuery(itm).data("css"),{ top : jQuery(itm).css( "top") });
                                jQuery.extend(jQuery(itm).data("css"),{ left : jQuery(itm).css( "left") });
                            }

                           
                            jQuery(itm).data("new", { type : "img", 
                                                    src : jQuery(itm).attr("src"),
                                                    parent : ev.target.id }); // body //ev.target.nodeName
                            break;
        case "font_awesome_element":
                            //jQuery(ev.target).append(<i class="fa fa-sort" aria-hidden="true"></i>);
                            //alert(jQuery(itm).attr("id"));
                            font_awesome_name = jQuery(itm).attr("id");
                            itm = document.createElement("i");
                            jQuery(itm).addClass("fa").addClass(font_awesome_name);
                            jQuery(itm).attr("aria-hidden", true);
                            jQuery(itm).attr("object","i");
                            jQuery(itm).css( "font-size", "32px");

                            jQuery(itm).css( "position", obj_pos_on_creation);
                            jQuery(itm).data("css", { position: obj_pos_on_creation });

                            if( obj_pos_on_creation == "absolute") {
                                jQuery(itm).offset({top: ev.pageY - offset.top});
                                jQuery(itm).offset({left: ev.pageX - offset.left});

                                jQuery.extend(jQuery(itm).data("css"),{ top : jQuery(itm).css( "top") });
                                jQuery.extend(jQuery(itm).data("css"),{ left : jQuery(itm).css( "left") });
                            }

                            jQuery(itm).data("custom",{ "font_awesome_fa_name" : font_awesome_name });


                            jQuery.extend(jQuery(itm).data("css"),{ "font_size" : "32px" });



                            if (jQuery("#font_awesome_draggable_color").attr('checked')) {
                                jQuery(itm).css( "color", "	rgb(255, 255, 255)"); // cambiar por RGB
                                jQuery.extend(jQuery(itm).data("css"),{ "color" : "rgb(255, 255, 255)" }); // cambiar por RGB
                            }
                            else{
                                jQuery(itm).css( "color", "	rgb(0, 0, 0)"); // cambiar por RGB
                                jQuery.extend(jQuery(itm).data("css"),{ "color" : "rgb(0, 0, 0)" }); // cambiar por RGB
                            }

                            jQuery(itm).data("new", { type : "i",
                                parent : ev.target.id });

                            //return;
                            break;
        case "tag_element":

                            let tagType = itm.id.toLowerCase().replace("tag_","");
                            itm = document.createElement(tagType);
                            jQuery(itm).attr("object",tagType);
                            //jQuery(itm).attr("spellcheck", false);
                            if ( jQuery(ev.target).css("display") != "flex" && jQuery(ev.target).css("display") != "inline-flex"){

                                jQuery(itm).css( "position", obj_pos_on_creation);
                                jQuery(itm).data("css", { position: obj_pos_on_creation });

                                if( obj_pos_on_creation == "absolute") {  
                                    jQuery(itm).offset({top: ev.pageY - offset.top});
                                    jQuery(itm).offset({left: ev.pageX - offset.left});

                                    jQuery.extend(jQuery(itm).data("css"),{ top : jQuery(itm).css( "top") });
                                    jQuery.extend(jQuery(itm).data("css"),{ left : jQuery(itm).css( "left") });
                                }

                            }
                            else {
                                jQuery(itm).css( "position", "static");
                                jQuery(itm).data("css", { position: "static" });
                            }

                            switch ( tagType ) {

                                case "div":

                                            jQuery(itm).css( "width", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                            jQuery(itm).css( "height", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "200px" });
                                            jQuery(itm).css( "background-color", "rgba(0, 0, 0, 0.5)");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"rgba(0, 0, 0, 0.5)" });

                                            break;

                                case "span":
                                            jQuery(itm).css( "width", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                            jQuery(itm).css( "height", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "200px" });
                                            jQuery(itm).css( "border-width", "1px");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_width : "1px" });
                                            jQuery(itm).css( "border-style", "solid");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_style : "solid" });
                                            jQuery(itm).css( "border-color", "rgb(0, 0, 0)");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_color : "rgb(0, 0, 0)" });
                                            jQuery(itm).css( "background-color", "transparent");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"transparent" });
                                            break;

                                case "p":
                                            jQuery(itm).css( "width", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                            jQuery(itm).css( "height", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "200px" });
                                            jQuery(itm).css( "background-color", "rgb(255, 255, 255)");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"rgb(255, 255, 255)" });
                                            break;

                                case "label":
                                            jQuery(itm).css( "width", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                            jQuery(itm).css( "height", "20px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "20px" });
                                            /*jQuery(itm).css( "min-height", "20px");*/
                                            jQuery(itm).css( "border-width", "1px");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_width : "1px" });
                                            jQuery(itm).css( "border-style", "solid");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_style : "solid" });
                                            jQuery(itm).css( "border-color", "rgb(0, 0, 0)");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_color : "rgb(0, 0, 0)" });
                                            jQuery(itm).css( "background-color", "transparent");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"transparent" });
                                            break;

                                case "hr":
                                            jQuery(itm).css( "width", "600px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "600px" });
                                            jQuery(itm).css( "height", "4px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "4px" });
                                            jQuery(itm).css( "border-width", "0");  // do reset for designArea
                                            jQuery.extend(jQuery(itm).data("css"),{ border_width : "0" }); // do reset for designArea
                                            jQuery(itm).css( "background-color", "rgb(128, 128, 128)");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"rgb(128, 128, 128)" });
                                            break;

                                case "h1":
                                case "h2":
                                case "h3":
                                case "h4":
                                case "h5":
                                case "h6":
                                            jQuery(itm).css( "width", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                            jQuery(itm).css( "height", "36px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "36px" });
                                            /*jQuery(itm).css( "min-height", "20px");*/
                                            jQuery(itm).css( "border-width", "1px");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_width : "1px" });
                                            jQuery(itm).css( "border-style", "solid");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_style : "solid" });
                                            jQuery(itm).css( "border-color", "rgb(0, 0, 0)");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_color : "rgb(0, 0, 0)" });
                                            jQuery(itm).css( "background-color", "transparent");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"transparent" });
                                            break;

                                case "a":
                                            jQuery(itm).css( "width", "200px");
                                            jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                            jQuery(itm).css( "height", "20px");
                                            jQuery.extend(jQuery(itm).data("css"),{ height : "20px" });
                                            /*jQuery(itm).css( "min-height", "20px");*/
                                            jQuery(itm).css( "border-width", "1px");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_width : "1px" });
                                            jQuery(itm).css( "border-style", "solid");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_style : "solid" });
                                            jQuery(itm).css( "border-color", "rgb(0, 0, 0)");
                                            jQuery.extend(jQuery(itm).data("css"),{ border_color : "rgb(0, 0, 0)" });
                                            jQuery(itm).css( "background-color", "transparent");
                                            jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"transparent" });
                                            jQuery(itm).data("custom", { linkpath : "https://" });

                                            break;

                                
                                default:
                                //objects on the fly

                                array_obj = JSON.parse(data_from_php_render_designer_box.new_tags);
                                array_new_tags = [];
                                array_obj.forEach(function(currentValue) {
                                    array_new_tags.push(currentValue.tag);
                                });

                                let position = jQuery.inArray( tagType, array_new_tags );

                                for(var propertyName in array_obj[position]) {
                                    if (propertyName != 'tag') { // is tag name, not a property
                                        jQuery(itm).css( propertyName.replace(/_/g, '-'), array_obj[position][propertyName]);
                                        obj = {};
                                        obj[propertyName] = array_obj[position][propertyName];
                                        jQuery.extend(jQuery(itm).data("css"), obj);
                                    }
                                }
                             

                                break;

                             }


                            jQuery(itm).data("new", { type : tagType,
                                                    parent : ev.target.id }); // body //ev.target.nodeName
                            

                            break;

        case "chart_addon":
                                    itm = document.createElement('CANVAS');
                                    //jQuery(document).append('<canvas id="myChart" width="400" height="400"></canvas>');
                                    jQuery(itm).attr("object","canvas"); //tagType
                                
                                    jQuery(itm).css( "width", "200px");
                                    jQuery.extend(jQuery(itm).data("css"),{ width : "200px" });
                                    jQuery(itm).css( "height", "200px");
                                    jQuery.extend(jQuery(itm).data("css"),{ height : "200px" });
                                    jQuery(itm).css( "background-color", "rgba(128, 0, 0, 0.5)");
                                    jQuery.extend(jQuery(itm).data("css"),{ background_color : 	"rgba(128, 0, 0, 0.5)" });
                            

                                break;

        case "replacecode_element":

                            if ( ev.target.id == "designArea") return;
                           
                            let variable_name = jQuery(itm).attr("id").substring(12);

                            if ( !$(ev.target).hasClass("not_selectable")) {
                                jQuery(".selected").removeClass("selected");
                                jQuery("#" + ev.target.id).addClass("selected");
                            }

                            if ( jQuery(itm).attr("attr_type") == "text" || jQuery(itm).attr("id") == "replacecode_content"){

                                //jQuery("#" + ev.target.id).append('{' + variable_name + '}');
                                jQuery(".selected").append('{' + variable_name + '}');
                                loin_ctrl_update_content(jQuery("#" + ev.target.id));
                            }


                            if ( jQuery(itm).attr("attr_type") == "attribute"){
                                let variable_name_array = [];
                                let element = { name: variable_name };
                                //if ( jQuery("#" + ev.target.id).data("custom").Shortcode_variable_name !== undefined){
                                //    variable_name_array = jQuery("#" + ev.target.id).data("custom").Shortcode_variable_name;
                                //}
                                if ( jQuery(".selected").data("custom").Shortcode_variable_name !== undefined){
                                    variable_name_array = jQuery(".selected").data("custom").Shortcode_variable_name;
                                }
                                variable_name_array.pushIfNotExist(element, function(e) { 
                                    return e.name === element.name ; 
                                });
                                //jQuery.extend( jQuery("#" + ev.target.id).data("custom"), { Shortcode_variable_name : variable_name_array });
                                jQuery.extend( jQuery(".selected").data("custom"), { Shortcode_variable_name : variable_name_array });
                                //jQuery("#" + ev.target.id).trigger("click"); // refresh list in button
                                jQuery(".selected").trigger("click"); // refresh list in button


                            }

                            return;

                            break;

}
 

//ev.dataTransfer.clearData();    
 
var cln = itm.cloneNode(true);


let cadena = "";
let father_same_type = 0;


jQuery(cln).data("css",jQuery.extend({},jQuery(itm).data("css")));  // copy data to next id object
jQuery(cln).data("new",jQuery.extend({},jQuery(itm).data("new")));
jQuery(cln).data("withoutcss",jQuery.extend({},jQuery(itm).data("withoutcss")));


jQuery(cln).data("hover",jQuery.extend({},jQuery(itm).data("hover")));
jQuery(cln).data("custom",jQuery.extend({},jQuery(itm).data("custom")));


jQuery(cln).attr("id",jQuery(itm).attr("object") + "_" + prefix_formId.replace(/ /g,"_") + "_" + get_next_id(itm));  // jQuery(itm).data("new").type   <-- cambiar por este
jQuery.extend( jQuery(cln).data("new"), { id : jQuery(cln).attr("id") } );
//jQuery(cln).data("extra",jQuery.extend({},{"type":"dinamic"})); // dinamic -> added -- static or nothing -> template or wordpress object page
//jQuery(cln).data("hover",jQuery.extend({},jQuery(itm).data("hover")));

/*    jQuery(cln).data("new",{ customtype : "img" });
    jQuery(cln).data("new",{ id : jQuery(cln).attr("id") });
    jQuery(cln).data("new",{ src : jQuery(cln).attr("src") });
    jQuery(cln).data("new",{ parent : ev.target });
*/
//alert(jQuery(cln).data("new").type);   
//alert(jQuery(cln).data("new").parent.nodeName);
//alert(jQuery(cln).data("new").id);
//alert(jQuery(cln).data("new").src);
//////cln.addEventListener("dragstart",drag);  // la imagen se puede volver a arrastrar
// recorreomos los hijos si tiene


// para clonacion objeto
/*
jQuery("[id$='-template']").each(function(){
 
 
                 //recorremos otra vez todo el dom para buscar el indice mas grande
                //alert(this.id);
                father_same_type = 0;
                
                if (jQuery(itm).attr("object") == jQuery(this).attr("object") ) {
                    father_same_type = 1;
                }
                
                let new_val_id = 0;
                
                jQuery("[object='" + jQuery(this).attr("object") + "']").each(function() {
                
                    cadena = this.id;
                    value = parseInt(cadena.substring(cadena.indexOf("_")+1)); 
                    
                    
                    if(  value > new_val_id) {
                        new_val_id = value ;
                    }
                    
                    
                 });
 
            
            jQuery(cln).find("[object='" + jQuery(this).attr("object") + "']").each(function(){ //children   "*"
                
     
                new_val_id += 1;
                jQuery(this).attr("id",jQuery(this).attr("object") + "_" + parseInt(new_val_id + father_same_type));
 /////               this.addEventListener("click", myFunction);
                
                
              //  this.addEventListener("dragstart",drag);
                
                
            });

});

*/

    if ( jQuery(cln).attr("object") == "img" ) {
            if ( parseInt(jQuery(ev.target).css('text-indent')) < 0 || ev.target.tagName == "INPUT") {
                
                jQuery(ev.target).text('').css('text-indent', '0');
                jQuery(ev.target).css('background-image', 'url(' + jQuery(cln).attr("src") + ')' ) ;

                jQuery(ev.target).addClass("selected");
                jQuery(ev.target).trigger("setSelected");

                //setTimeout(function () {
                jQuery.extend( jQuery(ev.target).data(jQuery('#hoverButton').data("mode")),{ "background_image" : "url(" + jQuery(cln).attr('src') + ")" });//DO OTHER THINGS AFTER THE FIRST THING
                //}, 1000);

                

            } else
            {
                ev.target.appendChild(cln);
                jQuery(cln).trigger(jQuery.Event("click"));
                if ( jQuery(cln).parent().attr("id") != "designArea" ) loin_ctrl_update_content( jQuery(cln).parent() );
            }
    } else 
    
    {
        ev.target.appendChild(cln);
        jQuery(cln).trigger(jQuery.Event("click"));
        if ( jQuery(cln).parent().attr("id") != "designArea" ) loin_ctrl_update_content( jQuery(cln).parent() );

    }   

 //ev.dataTransfer.clearData();

    jQuery("#ghostImage").remove();  // remove dragImage
}




////////************************/////////////////

function get_next_id(itm,ObjClone){

        let value;
        let new_val_id = 0;
        let ThisObj;
        let str_val_id = "0000"; 
        
        jQuery("[object='" + jQuery(itm).attr("object") + "']").each(function() {
            
            let cadena = this.id;
            value = parseInt(cadena.substring(cadena.lastIndexOf("_")+1)); //indexOf
            
            if(  value > new_val_id) {
                new_val_id = value ;
            }
        
        });
        
        if (ObjClone) ObjClone[jQuery(itm).attr("object")] = new_val_id + 1;
       
        str_val_id = str_val_id + parseInt(new_val_id + 1);

        return str_val_id.substr(str_val_id.length - 5); // 5 digits for id

}


function drop_delete(ev) {
    
    ev.preventDefault();
    var data= ev.dataTransfer.getData("text");
    var itm = document.getElementById(data);
    
    //alert(jQuery(itm).attr("id"));    //cln.addEventListener("dragstart",drag); ----    jQuery(itm).attr("draggable","true");
    jQuery(".selected").remove();
    //itm.parentNode.removeChild(itm);


}


function updateColor( ignore_check_change = false){

    jQuery(".selected:first").each(function(){

        let cssValue = "";

        switch( jQuery("input[name='color-property-type']:checked").val() ){
            
            case "border": if (!ignore_check_change) jQuery("input[name='color-property-type'][value='background']").attr('checked', 'checked');
            case "background":
                        cssValue = jQuery(this).css("background-color"); // current value

                        if ( jQuery('#hoverButton').data("mode") == "css"){
                            if( jQuery(this).data("css").background_color !== undefined )
                                cssValue = jQuery(this).data("css").background_color;
                            else if ( jQuery(this).data("withoutcss").background_color !== undefined )//withoutcss
                                cssValue = jQuery(this).data("withoutcss").background_color;
                        } 
                
                        else {
                            if( jQuery(this).data("hover").background_color !== undefined )
                            cssValue = jQuery(this).data("hover").background_color;
                        } 
                        break;

            case "textshadow": if (!ignore_check_change) jQuery("input[name='color-property-type'][value='text']").attr('checked', 'checked');
            case "text":
                        cssValue = jQuery(this).css("color"); // current value

                        if ( jQuery('#hoverButton').data("mode") == "css"){
                            if( jQuery(this).data("css").color !== undefined )
                                cssValue = jQuery(this).data("css").color;
                            else if ( jQuery(this).data("withoutcss").color !== undefined )//withoutcss
                                cssValue = jQuery(this).data("withoutcss").color;
                        } 
                
                        else {
                            if( jQuery(this).data("hover").color !== undefined )
                            cssValue = jQuery(this).data("hover").color;
                        } 

                        break;

            
 /*             cssValue = jQuery(this).css("text-shadow"); // current value

                      if ( jQuery('#hoverButton').data("mode") == "css"){
                            if( jQuery(this).data("css").color !== undefined )
                                cssValue = jQuery(this).data("css").color;
                            else if ( jQuery(this).data("withoutcss").color !== undefined )//withoutcss
                                cssValue = jQuery(this).data("withoutcss").color;
                        } 
                
                        else {
                            if( jQuery(this).data("hover").color !== undefined )
                            cssValue = jQuery(this).data("hover").color;
                        } 
*/
                        break;

        }
       


        if ( cssValue == "transparent") {
            cssValue = "rgba(255,255,255,0)"; //for RGBToHex
            jQuery("#colorpickerhook").ColorPickerSetColor(RGBToHex(cssValue));
            jQuery("#transparent").trigger("click");
        }
        else{
            jQuery("#colorpickerhook").ColorPickerSetColor(RGBToHex(cssValue));
            jQuery("#solid").prop('checked',true);
            jQuery("#opacity").trigger("keyup",["selection_added"]);
        }
    });

}


function loin_ctrl_update_content( element ){

    var items = element.contents();// $("#" + $("#contenteditableBox").attr("data-element")).contents();
    
    var item_content = [];
    var item_obj = {};

    items.each(function(index,item){
                
                item_obj = {};
                
                if(  this.nodeType == 3 ) { 
                    item_obj.index = index;
                    item_obj.type = "text";
                    item_obj.content = this.textContent;
                }
                else {
                    if(this.tagName == "BR"){ //outerHTML
                        item_obj.index = index;
                        item_obj.type = "br";
                        item_obj.content = "@br@";
                    }
                    else{ // all other objects
                        item_obj.index = index;
                        item_obj.type = "id";
                        item_obj.content = this.id;
                    }
                }

                item_content.push( item_obj );

    });

    jQuery.extend( element.data("new"), { content : item_content } );

}