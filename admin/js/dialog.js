"use strict";
jQuery(document).ready(function($) {

        var dialog, form,

        emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
        name = $( "#name" ),
        type = $( "#Type" ),

        allFields = $( [] ).add( name ),
        tips = $( ".validateTips" );
    
        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }
    
        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
                updateTips( "Length of " + n + " must be between " +
                min + " and " + max + "." );
                return false;
            } else {
                return true;
            }
        }
    
        function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }
    
        function addForm( action, clone_name_id="" ) {
            var valid = true;
            allFields.removeClass( "ui-state-error" );
        
            valid = valid && checkLength( name, "name", 3, 16 );
        
            valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, data_from_php_dialog.error_message_translation ); // /^[a-z]([0-9a-z_\s])+$/i
        
            if ( valid ) {

            //if ( dialog.data('clone_name_id') != null ) // if is new Form, don't create index will be ignored later
            //    js_array_new[name.val()] = js_array_new[dialog.data('clone_name_id')];

            if ( clone_name_id.length > 0 ) // if is new Form, don't create index will be ignored later
                //js_array_new[name.val()] = js_array_new[clone_name_id];
                //change id inside
                js_array_new[name.val()] = JSON.parse(JSON.stringify(js_array_new[clone_name_id]).replace(new RegExp( clone_name_id , 'g'), name.val()));

             //*************************** AJAX *****************************************
            // animated css icon
            //<div class="newform"><div class="ajax_waitting"></div></div>
            $("table th:first").append('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">Creating...</span></div>'); //

            $.ajax({
                type: "POST",
                url: ajaxurl,
                // Add action and nonce to our collected data
                data: {
                        security: $('#_ajax_custom_list_nonce_2').val(),
                        action: 'loin_ctrl_action_save_new_form', // clone too
                        formname: name.val(),
                        formname_clone: clone_name_id,  // can be null 
                        type: type.val(),
                        action_to_do: action
                        
                    },

                    
                // Handle the successful result
                success: function( response ) {

                    list.refresh(parseInt(response));
                    
                }
            });



//**************************************************************************
            //dialog.dialog( "close" );
            $( "#btn-new-form-close" ).trigger("click");
        }
        return valid;
        }
/*    
    dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
  //    resizable: false,
  //    dialogClass: 'info',
  //    draggable: true,
        height: 'auto',
        width: 350,
        modal: true,
        buttons: [{
                text: data_from_php_dialog.button_create_translation,
                click: addForm
            },
                {
                    text: data_from_php_dialog.button_cancel_translation,
                    click: function() {       // los mismo que "cancel"
                            dialog.dialog( "close" );
                            }
            }
        ],
        close: function() {
            form[ 0 ].reset();
            allFields.removeClass( "ui-state-error" );
        }
    });
    
    form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        addForm();
    });
*/

$("#btn-new-form").on( "click", function() {
    //'action','new'
    addForm('new');
});  

$("#btn-clone-form").on( "click", function() {
    //'action','clone'
    addForm('clone', $("#cloneName").val());

});  


    
    $( "#create-form" ).on( "click", function() { //.button()
        
        $("#form-new-form, #btn-new-form").css("display","block");
        $("#type, label[for=type]").css("display","inline");
        $("#name, #type").val("");
        
        $("#btn-clone-form").css("display","none");

        $("#formTitle").text(data_from_php_dialog.new_form_translation);


    });

    $( "#btn-new-form-close" ).on( "click", function() {
        $("#form-new-form").css("display","none");
    });

    $( "#export" ).on( "click", function() {
        $("#export span").text(data_from_php_dialog.working);
        $("#export i").removeClass("fa-cloud-download").addClass("fa fa-refresh fa-spin fa-3x fa-fw");
        window.location = $(this).attr("data-href");
        // aqui sustituir el windows.location por AJAX y llamar al href desde php para ajustar al tiempo de descarga
        setTimeout(function () {
            $("#export span").text(data_from_php_dialog.export);
            $("#export i").addClass("fa-cloud-download").removeClass("fa-refresh fa-spin fa-3x fa-fw");
        }, 5000);
    });


    $( "#import" ).on({ //patch for "Edge", which auto-run click after selecting the file
        mouseenter: function(ev) {
          $(this).data('hovering', true);
        },
        mouseleave: function(ev) {
          $(this).data('hovering', false);
        }
      });

    $( "#import" ).on( "click", function(ev) {  
        if ($(this).hasClass("import")){
            $("#file-upload").trigger("click");
        }
        if ($(this).hasClass("send") && $(this).data("hovering")){ //$(this).data("hovering") --> patch for "Edge", which auto-run click after selecting the file

            var fd = new FormData();
            
                    var file = $(document).find('input[type="file"]');
                    var individual_file = file[0].files[0];
                    fd.append("file", individual_file);
             
                    fd.append('action', 'loin_ctrl_action_save_new_form');
                    fd.append('action_to_do', 'import');
                    fd.append('security', $('#_ajax_custom_list_nonce_2').val());
                    
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: fd,
                        enctype: "multipart/form-data",
                        contentType: false,
                        processData: false,
                        // Add action and nonce to our collected data
            /*            data: {
                                security: $('#_ajax_custom_list_nonce_2').val(),
                                action: 'loin_ctrl_action_save_new_form', // new and clone too
                                action_to_do: 'import' //this.id
                                
                            },
            */
            
                        beforeSend: function(){
                            $("#import span").text('Loading ...');
                            $("#back").remove();
                            $("#import i:first").text("").addClass("fa fa-refresh fa-spin fa-3x fa-fw").css({"font-size":"64px"});
                        },    
                      
                        // Handle the successful result
                        success: function( response ) {

                            var obj = JSON.parse(response);
                            
                            //convertir cadena json a objecte javascript
                            list.refresh(1); // refresh table to page 1
                            $('#wpbody-content h2').append('<div id="upload-notice" class="notice '+ obj.notice +' is-dismissible">'+ obj.message +'<button type="button" class="notice-dismiss"><span class="screen-reader-text"> </span></button></div>');
                            
                            $("#import i:first").removeClass("fa fa-refresh fa-spin fa-3x fa-fw").addClass("fa fa-download");
                            $("#import span").text('Import File');
                            $("#import").addClass("import").removeClass("send").css({"border-color":"rgba(222,222,222,1)","color":"rgba(110,110,110,1)"}).mouseover(function() {
                                $(this).css({"border-color":"Black","color":"White"});
                            }).mouseout(function() {
                                $(this).css({"border-color":"rgba(222,222,222,1)","color":"rgba(110,110,110,1)"});
                            });
                            // Make notices dismissible
                            //clear file-upload
                            $("#file-upload").val('');
                            
                            
                        }
                    });
        }
        
    });

    $('#file-upload').on("change", function(){
        if($(this).val() == ""){ //Cancel button pressed
            $("#import i:last").remove();
            $("#import i:first").text('').addClass("fa fa-download").css("font-size","64px");
            $("#import span").text('Import File');
            $("#import").addClass("import").removeClass("send").css({"border-color":"rgba(222,222,222,1)","color":"rgba(110,110,110,1)"}).mouseover(function() {
                $(this).css({"border-color":"Black","color":"White"});
            }).mouseout(function() {
                $(this).css({"border-color":"rgba(222,222,222,1)","color":"rgba(110,110,110,1)"});
            });
            return;
        }

        $("#import i:first").text( $(this).val().substring( $(this).val().indexOf('fakepath')+9, $(this).val().indexOf('fakepath')+9+18 ) ).removeClass("fa fa-download").css({"font-size":"16px"});
        if ($("#back").length == 0) {

            $("#import span").text('Submit');
            $("#import").removeClass("import").addClass("send").css({"border-color":"Orange","color":"White"}).mouseover(function() {
                $(this).css("border-color","DarkOrange");
            }).mouseout(function() {
                $(this).css("border-color","Orange");
            });
            $("#import").append('<i id="back" class="fa fa-download" style="position: absolute; font-size:20px; top:-35px; left:5px; width:20px; height:20px;" aria-hidden="true"></i>');
            $("#back").on("click", function(ev){
                ev.stopPropagation();
                $("#file-upload").trigger("click");
            });

        }
        
    });

      

    $( "#wpwrap" ).on( "click",".action-icon.dialog", function() {
        $("#type, label[for=type], #btn-new-form").css("display","none");
        $("#form-new-form, #btn-clone-form").css("display","block");
        $("#formTitle").text(data_from_php_dialog.clone_form_translation);
        $("#name").val("");
        $("#cloneName").val($(this).parents('tr').find('input[type=checkbox]').val());

    });



    /* ******** mostrar y ocultar iconos de la tabla ***************** */

    $("table").on({
        mouseenter: function(){
            $(this).find(".action-icon, .action-button").css("visibility","visible");
        },
        mouseleave: function(){
            $(this).find(".action-icon, .action-button").css("visibility","hidden");
        }
    },"tr");

    $( '#wpwrap' ).on('click.wp-dismiss-notice','#upload-notice', function(ev) {
        
        //var $this = $( this ),
        //    $button = $( '<button type="button" class="notice-dismiss"><span class="screen-reader-text"></span></button>' ),
        //    btnText = '';//caldera_commonL10n.dismiss || '';

        // Ensure plain text
        //$button.find( '.screen-reader-text' ).text( btnText );

        //$this.append( $button );

        //$button.on( 'click.wp-dismiss-notice', function( event ) {
            ev.preventDefault();
            $(this).fadeTo( 100 , 0, function() {
                $(this).slideUp( 100, function() {
                    $(this).remove();
                });
            });
        //});

    });

});



