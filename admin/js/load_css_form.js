//"use strict";
jQuery(document).ready(function($) {


    prefix_formId = Id_Form;
    formType = Form_Type;
 /*   String.prototype.stripSlashes = function(){
        return this.replace(/\\(.)/mg, "$1");
    }
*/
    // load css to objects        
    let object_css;

    toggle_changes = JSON.parse(obj_Options[0].stripSlashes()); // toggle box
    custom_css = JSON.parse(obj_Options[1].stripSlashes());     // css editor box
    
    if (obj_Options[2] == undefined) { // google fonts
        google_fonts_in_use = [];
    }
    else {
        google_fonts_in_use = JSON.parse(obj_Options[2].stripSlashes());
    }

    if ( obj_Options[3] != undefined)
        id_origin = JSON.parse(obj_Options[3].stripSlashes()).id;  // shortcode object origin
    
    if ( obj_Options[4] != undefined)
        user_variables = JSON.parse(obj_Options[4].stripSlashes()); // user variables for shortcodes
 
    if ( 'toggle_activateCode' in toggle_changes ) $('body').append( $('<style media="screen" type="text/css" class="custon_css_style">'+ custom_css +'</style>') ); //append custom css

    toggle_changes.toggle_loginForm = true; // first load, always loginForm
    delete toggle_changes.toggle_LostPasswordForm;
    delete toggle_changes.toggle_registerForm;

    if ( toggle_changes.toggle_messageError ) $("DIV#login #login_error").css("display","block");
    if ( toggle_changes.toggle_messageDisconnected) $("p.message").has("#message_disconnected").css("display","block");

    $.each(obj_Path, function(index, val) {


        if ( $(val).length == 0 ) {

            let temp_obj = JSON.parse(obj_new[index].stripSlashes());

            let nodes = $("#" + temp_obj.parent).contents();
            let id_found = false;

            switch (temp_obj.type) {

                
                case "img":
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

                                break;            
                case "i":
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
                                    
                                break;
                default:

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
            

            $(val).data( "new" , temp_obj ); //JSON.parse(obj_new[index].stripSlashes())
        }

        $(val).data( "hover" , JSON.parse(obj_hover[index].stripSlashes()) );
        $(val).data( "css" , JSON.parse(obj_css[index].stripSlashes()) );
        $(val).data( "withoutcss" , JSON.parse(obj_withoutcss[index].stripSlashes()) );
        if(obj_custom[index].length) {
            $(val).data( "custom" , JSON.parse(obj_custom[index].stripSlashes()) );
        }

        object_css = $.extend( {}, $(val).data("css"), $(val).data("withoutcss") );  //set css to object
        

        $.each(object_css, function(key, element) {
            $(val).css( key.replace(/_/g,"-") , element );
        });

    });

    $.each(user_variables, function(index, obj){  //index is name and value is type 


        let variable_tooltip = ""; 

        switch (obj.type) {
            case "text":     
                        variable_tooltip = data_from_php_load_css_form.case_text;

                        break;

            case "attribute":
          
                        variable_tooltip = data_from_php_load_css_form.case_attribute;
            
                        break;
        }

        $("#replaceCode_box > div").append('\
            <div class="user-variable">\
            <div id="replacecode_'+ obj.name +'" draggable="true" ondragstart="drag(event)" object="replacecode_element" attr_type="'+ obj.type +'" class="not_selectable">\
            '+ obj.name +'\
            </div>\
            <i class="fa fa-trash-o delete-user-variable" delete-parent="'+ obj.name +'" aria-hidden="true"></i>\
            <i class="fa fa-cog edit-user-variable tooltip" edit-parent="'+ obj.name +'" aria-hidden="true">\
            ' + variable_tooltip + '\
            </i>\
            </div>\
        ');

        switch (obj.type) {
            case "text":

                        $("#replacecode_" + obj.name).siblings(".fa-cog").find("[data-obj-name='default']").val(obj.default);

                        break;

            case "attribute":
          
                        $("#replacecode_" + obj.name).siblings(".fa-cog").find("[data-obj-name='default']").val(obj.default);
                        $("#replacecode_" + obj.name).siblings(".fa-cog").find("[data-obj-name='attr_type']").val(obj.attr_type);
                        break;
        }

       
    });


});