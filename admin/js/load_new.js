"use strict";
//loads new front-end elements in login page, no shortcodes

jQuery(document).ready(function($) {

  String.prototype.stripSlashes = function(){
        return this.replace(/\\(.)/mg, "$1");
    }

    $.each(obj_new, function(index, val) {
                
        let temp_obj = JSON.parse(val.stripSlashes());

        let nodes = $("#" + temp_obj.parent).contents();
        let id_found = false;

        switch (temp_obj.type) {
            case "img":
                if( temp_obj.parent == "designArea") {
                    $("body").append('<img id="' + temp_obj.id + '" object="' + temp_obj.type + '" src="' + temp_obj.src + '">');
                }
                else{
                    $.each(nodes, function(){ //index, value
                        
                        if ( this.nodeType == 3){ // is text node
                                if ( this.textContent == "#" + temp_obj.id){
                                    $(this).after('<img id="' + temp_obj.id + '" object="' + temp_obj.type + '" src="' + temp_obj.src + '">');
                                    $(this).remove();
                                    id_found = true;
                                }
                        }
                    });

                    if ( !id_found ){
                        $("#" + temp_obj.parent).append('<img id="' + temp_obj.id + '" object="' + temp_obj.type + '" src="' + temp_obj.src + '">');
                    }
                        
                }
                break;

            case "i":
                if( temp_obj.parent == "designArea") {
                    $("body").append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '" class="fa ' + JSON.parse(obj_custom[index].stripSlashes()).font_awesome_fa_name + '" aria-hidden="true"></'+ temp_obj.type +'>');
                }
                else{
                    $.each(nodes, function(){ //index, value // cuidado ya utilizamos index exterior, si se necesita cambiar index por index_2 oparecido
                        
                        if ( this.nodeType == 3){ // is text node
                                if ( this.textContent == "#" + temp_obj.id){
                                    $(this).after('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '" class="fa ' + JSON.parse(obj_custom[index].stripSlashes()).font_awesome_fa_name + '" aria-hidden="true"></'+ temp_obj.type +'>');
                                    $(this).remove();
                                    id_found = true;
                                }
                        }
                    });
                    if ( !id_found ){
                        $("#" + temp_obj.parent).append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '" class="fa ' + JSON.parse(obj_custom[index].stripSlashes()).font_awesome_fa_name + '" aria-hidden="true"></'+ temp_obj.type +'>');
                    }

                }
                break;
                

                
            case "a": 

                let temp_custom_obj = JSON.parse(obj_custom[index].stripSlashes());

                if( temp_obj.parent == "designArea") {
                    $("body").append('<'+ temp_obj.type + ' href="'+ temp_custom_obj.linkpath +'" ' +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
                }
                else{
                    $.each(nodes, function(){ //index, value
                        
                        if ( this.nodeType == 3){ // is text node
                                if ( this.textContent == "#" + temp_obj.id){
                                    $(this).after('<'+ temp_obj.type + ' href="'+ temp_custom_obj.linkpath +'" ' +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
                                    $(this).remove();
                                    id_found = true;
                                }
                        }
                    });
                    if ( !id_found ){
                        $("#" + temp_obj.parent).append('<'+ temp_obj.type + ' href="'+ temp_custom_obj.linkpath +'" ' +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
                    }
                    
                }
                
                //add content

                if (temp_obj.content != undefined ) { // solo si hay texto en el objeto y contiene el orden de sus hijos entre el texto
                    
                                                        $.each(temp_obj.content, function( index, obj){
                                                            switch ( obj.type){
                                                                case "text":
                                                                            $("#" + temp_obj.id).append(obj.content);
                                                                            break;
                                                                case "br":
                                                                            $("#" + temp_obj.id).append("<br>");
                                                                            break;
                                                                case "id":
                                                                            $("#" + temp_obj.id).append("#" + obj.content);
                                                                            break;
                                                            }
                                                            
                                                        });
                    
                                                    }

                break;

            default:

                if( temp_obj.parent == "designArea") {
                    $("body").append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
                }
                else{
                    $.each(nodes, function(){ //index, value
                        
                        if ( this.nodeType == 3){ // is text node
                                if ( this.textContent == "#" + temp_obj.id){
                                    $(this).after('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
                                    $(this).remove();
                                    id_found = true;
                                }
                        }
                    });
                    if ( !id_found ){
                        $("#" + temp_obj.parent).append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
                    }

                }

                //add content

                if (temp_obj.content != undefined ) { // solo si hay texto en el objeto y contiene el orden de sus hijos entre el texto
                    
                                                        $.each(temp_obj.content, function( index, obj){
                                                            switch ( obj.type){
                                                                case "text":
                                                                            $("#" + temp_obj.id).append(obj.content);
                                                                            break;
                                                                case "br":
                                                                            $("#" + temp_obj.id).append("<br>");
                                                                            break;
                                                                case "id":
                                                                            $("#" + temp_obj.id).append("#" + obj.content);
                                                                            break;
                                                            }
                                                            
                                                        });
                    
                                                    }

                break;
        }
        
    });
    
});