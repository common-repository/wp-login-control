//"use strict";
jQuery(document).ready(function($) {


    $("#img_toggle").click(function(ev){

       if ( ! $("#box_toggle").length) {


            $("#img_code").after('<div id="box_toggle" class="sub-tools"></div>'); 
            $("#box_toggle").append( data_from_php_toggle.toggle_structure );

            $("#box_toggle").css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );

            $('#box_toggle').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
            $("h3.fs-submenu .fa-times").on("click", function(ev){
                $(this).parents("div:first").remove();
            });
            $('#box_toggle').on("dragstart click", function(){ 
                $("h3.fs-submenu").parent("div").each(function() {
                    $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                });
                $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
            }); 


            //$.extend(data_from_php_toggle, toggle_changes);        


            $("#box_toggle .onoffswitch-checkbox").each(function(){
                $(this).prop("checked",toggle_changes["toggle_" + this.id]); 
            });

            if ( toggle_changes.toggle_hideError ) $(".messageError").slideUp(0);
          
            $("#titleLogo, #logoLink").each(function(){
                if ( this.id in toggle_changes ) $(this).val(toggle_changes[this.id]);
            });
            
            $("#titleLogo, #logoLink").change(function(){
                if ( $(this).val() != "")
                    toggle_changes[this.id] = $(this).val();
                else
                    delete toggle_changes[this.id];
            });

//******************************* */

    $('#box_toggle .onoffswitch-checkbox').change( function(){

        var foundChecked = false;

                            // do bucle with string array

                            if ( $("DIV#login FORM#loginform P.forgetmenot").data("css") === undefined ) // Prevent no data exist
                                $("DIV#login FORM#loginform P.forgetmenot").data("css", {});
                            if ( $("DIV#login FORM#loginform P.forgetmenot").data("hover") === undefined)  //{ // No data exist for type hover
                                $("DIV#login FORM#loginform P.forgetmenot").data("hover", {});
                            if ( $("DIV#login FORM#loginform P.forgetmenot").data("withoutcss") === undefined) //{ // No data exist for type hover
                                $("DIV#login FORM#loginform P.forgetmenot").data("withoutcss", {});

                            if ( $("DIV#login P#nav").data("css") === undefined ) // Prevent no data exist
                                $("DIV#login P#nav").data("css", {});
                            if ( $("DIV#login P#nav").data("hover") === undefined)  //{ // No data exist for type hover
                                $("DIV#login P#nav").data("hover", {});
                            if ( $("DIV#login P#nav").data("withoutcss") === undefined) //{ // No data exist for type hover
                                $("DIV#login P#nav").data("withoutcss", {});

                            if ( $("DIV#login P#backtoblog").data("css") === undefined ) // Prevent no data exist
                                $("DIV#login P#backtoblog").data("css", {});
                            if ( $("DIV#login P#backtoblog").data("hover") === undefined)  //{ // No data exist for type hover
                                $("DIV#login P#backtoblog").data("hover", {});
                            if ( $("DIV#login P#backtoblog").data("withoutcss") === undefined) //{ // No data exist for type hover
                                $("DIV#login P#backtoblog").data("withoutcss", {});

                            if ( $("DIV#login #login_error").data("css") === undefined ) // Prevent no data exist
                                $("DIV#login #login_error").data("css", {});
                            if ( $("DIV#login #login_error").data("hover") === undefined)  //{ // No data exist for type hover
                                $("DIV#login #login_error").data("hover", {});
                            if ( $("DIV#login #login_error").data("withoutcss") === undefined) //{ // No data exist for type hover
                                $("DIV#login #login_error").data("withoutcss", {});

        if( $(this).is(':checked') ) {

            switch(this.id){


                case "removeRememberMe":

                            $("DIV#login FORM#loginform P.forgetmenot").css("display","none");
                            $.extend( $("DIV#login FORM#loginform P.forgetmenot").data("css"),{ "display" : "none" });
                            
                            toggle_changes.toggle_removeRememberMe = true;

                            break;                

                case "removeLostPasswordLink":

                            $("DIV#login P#nav").css("display","none");
                            $.extend( $("DIV#login P#nav").data("css"),{ "display" : "none" });
                            
                            toggle_changes.toggle_removeLostPasswordLink = true;

                            break;
                case "removeBackToLink":

                            $("DIV#login P#backtoblog").css("display","none");
                            $.extend( $("DIV#login P#backtoblog").data("css"),{ "display" : "none" });

                            toggle_changes.toggle_removeBackToLink = true;

                            break;

                case "hideError":

                            $.extend( $("DIV#login #login_error").data("css"),{ "display" : "none" });
                            if( $("#messageError").is(':checked') ) {
                                $("#messageError").trigger("click");
                                setTimeout(function(){
                                    $(".messageError").slideUp(0);
                                },400);
                            }
                            else
                                $(".messageError").slideUp(0);
  
                            toggle_changes.toggle_hideError = true;
                            break;

                case "removeShake":
                            toggle_changes.toggle_removeShake = true;
                            break;

                case "rememberMe":
                            toggle_changes.toggle_rememberMe = true;
                            break;                            

                case "messageError":
                            $("DIV#login #login_error").css("display","block").removeClass("hidden_designer");
                            toggle_changes.toggle_messageError = true;
                            break;

                case "messageDisconnected":
                            $("p.message").has("#message_disconnected").css("display","block").removeClass("hidden_designer");
                            toggle_changes.toggle_messageDisconnected = true;
                            break;

                case "loginForm":
                            $.each(["LostPasswordForm","registerForm"], function(index, value){
                                if( $("#" + value).is(':checked') )
                                    $("#" + value).trigger("click");
                            });

                            $(".lostpasswordform_designer, .registerform_designer").css("display","none");
                            $(".loginform_designer").not(".hidden_designer").css("display","block");
                            $(".loginform_designer.inline_designer").css("display","inline");
                            toggle_changes.toggle_loginForm = true;
                            break;
                case "LostPasswordForm":
                            $.each(["loginForm","registerForm"], function(index, value){
                                if( $("#" + value).is(':checked') )
                                    $("#" + value).trigger("click");
                            });

                            $(".loginform_designer, .registerform_designer").css("display","none");
                            $(".lostpasswordform_designer").css("display","block");
                            $(".lostpasswordform_designer.inline_designer").css("display","inline");
                            toggle_changes.toggle_LostPasswordForm = true;
                            break;
                case "registerForm":
                            $.each(["LostPasswordForm","loginForm"], function(index, value){
                                if( $("#" + value).is(':checked') )
                                    $("#" + value).trigger("click");
                            });
                            $(".loginform_designer, .lostpasswordform_designer").css("display","none");
                            $(".registerform_designer").css("display","block");
                            $(".registerform_designer.inline_designer").css("display","inline");
                            toggle_changes.toggle_registerForm = true;
                            break;
                            
            } 


        } else
        
        {
            switch(this.id){

                case "removeRememberMe":
                            $("DIV#login FORM#loginform P.forgetmenot").css("display","block");
                            delete $("DIV#login FORM#loginform P.forgetmenot").data("css").display;
                            delete toggle_changes.toggle_removeRememberMe;
                            break;                
                case "removeLostPasswordLink":
                            $("DIV#login P#nav").css("display","block");
                            delete $("DIV#login P#nav").data("css").display;
                            delete toggle_changes.toggle_removeLostPasswordLink;
                            break;
                case "removeBackToLink":
                            $("DIV#login P#backtoblog").css("display","block");
                            delete $("DIV#login P#backtoblog").data("css").display;
                            delete toggle_changes.toggle_removeBackToLink;
                            break;
                case "hideError":
                            delete $("DIV#login #login_error").data("css").display;
                            $(".messageError").slideDown(0);
                            delete toggle_changes.toggle_hideError;
                            break;

                case "removeShake":
                            delete toggle_changes.toggle_removeShake;
                            break;

                case "rememberMe":
                            delete toggle_changes.toggle_rememberMe;
                            break;  

                case "messageError":
                            $("DIV#login #login_error").css("display","none").addClass("hidden_designer");
                            delete toggle_changes.toggle_messageError;
                            break;
                case "messageDisconnected":
                            $("p.message").has("#message_disconnected").css("display","none").addClass("hidden_designer");
                            delete toggle_changes.toggle_messageDisconnected;
                            break;
                case "loginForm":
                            $.each(["LostPasswordForm","loginForm","registerForm"], function(index, value){
                                if( $("#" + value).is(':checked') )
                                    foundChecked = true;
                            });
                            if (foundChecked == false) $("#LostPasswordForm").trigger("click");

                            delete toggle_changes.toggle_loginForm;
                            break;

                case "LostPasswordForm":
                            $.each(["LostPasswordForm","loginForm","registerForm"], function(index, value){
                                if( $("#" + value).is(':checked') )
                                    foundChecked = true;
                            });
                            if (foundChecked == false) $("#registerForm").trigger("click");

                            delete toggle_changes.toggle_LostPasswordForm;
                            break;
                case "registerForm":
                            $.each(["LostPasswordForm","loginForm","registerForm"], function(index, value){
                                if( $("#" + value).is(':checked') )
                                    foundChecked = true;
                            });
                            if (foundChecked == false) $("#loginForm").trigger("click");

                            delete toggle_changes.toggle_registerForm;
                            break;                
            }
        }


    });

           
    } else {
        $("#box_toggle").remove();
    }


    }); // end img_toggle


});    // end ready

 