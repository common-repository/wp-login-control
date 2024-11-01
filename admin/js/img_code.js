//"use strict";
jQuery(document).ready(function($) {


    $("#img_code").click(function(ev){

       if ( ! $("#box_code").length) {


            $("#img_code").after('<div id="box_code" class="sub-tools"></div>'); 
            $("#box_code").append( data_from_php_code.code_structure );

            $("#box_code").css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );

            $('#box_code').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-submenu'});
            $("h3.fs-submenu .fa-times").on("click", function(ev){
                $(this).parents("div:first").remove();
            });
            $('#box_code').on("dragstart click", function(){ 
                $("h3.fs-submenu").parent("div").each(function() {
                    $(this).css("z-index", parseInt($(this).css("z-index")) - 1 );
                });
                $(this).css("z-index", parseInt(90) + parseInt($("h3.fs-submenu").parent("div").length) );
            }); 

            $('#img_clear_code').on('click', function(ev) {
                $('#css_area').val('');
            });

            $('#img_update_code i').addClass('img_update_rotate').css({ animation:'none'});

            $('#img_update_code').on('click', function(ev) {

                var element = $(this).children('i');
                $(this).children('i').css({ animation:'none'});
                setTimeout( function(){ $(element).css({'animation': ''})},10); //setTimeout( function(){ element.style.animation = ''; },10); -> esto no funciona                  

                custom_css = $('#css_area').val();

                if ( $("#activateCode").is(':checked') ) {
                    //Embedding CSS into the HTML dinamically
                    $('body .custon_css_style').remove();
                    $('body').append( $('<style media="screen" type="text/css" class="custon_css_style">'+ custom_css +'</style>') ); 
                    //end css
                }

            });

            $('#css_area').val(custom_css); // load custom css from DB

            $("#box_code .onoffswitch-checkbox").each(function(){
                $(this).prop("checked",toggle_changes["toggle_" + this.id]); 
            });

            $('#box_code .onoffswitch-checkbox').change( function(){

                if( $(this).is(':checked') ) {

                    switch(this.id){


                        case "activateCode":
                                                toggle_changes.toggle_activateCode = true;
                                                $('#img_update_code').trigger('click');
                                                break;
                    }
                }
                else{
                                switch(this.id){


                        case "activateCode":
                                                delete toggle_changes.toggle_activateCode;
                                                $('body .custon_css_style').remove();
                                                break;
                    }
                }

            });


            $("#css_area").on("paste", function(ev) { // comprovar y reparar por cada 
                // cancel paste
                ev.preventDefault();
                return; // option not suported in this version
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
                var allText = $(this).val();
                var caretStart = window.getSelection().anchorOffset;
                var caretEnd = window.getSelection().focusOffset;

                $(this).val(allText.substring(0,window.getSelection().anchorOffset) +  clipboarddata.getData("text/plain") + allText.substring(window.getSelection().focusOffset))
    
                var range = document.createRange();

                function selectElementContents(el) {
                    var textNode = el.childNodes[0]; //text node is the first child node of a span, div, etc.    
                    var range = document.createRange();

                    range.setStart(textNode, caretStart);
                    range.setEnd(textNode, caretStart);
                    var sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
    
                //selectElementContents(this);
    
            });

            $('#css_area').on('keydown', function(ev) {
                ev.stopPropagation();
                var keyCode = ev.keyCode || ev.which;

                if (keyCode == 9) {
                    ev.preventDefault();
                    var start = this.selectionStart;
                    var end = this.selectionEnd;
                    var val = this.value;
                    var selected = val.substring(start, end);
                    var re, count;

                    if(ev.shiftKey) {
                        re = /^\t/gm;
                        count = -selected.match(re).length;
                        this.value = val.substring(0, start) + selected.replace(re, '') + val.substring(end);
                        // todo: add support for shift-tabbing without a selection
                    } else {
                        re = /^/gm;
                        count = selected.match(re).length;
                        this.value = val.substring(0, start) + selected.replace(re, '\t') + val.substring(end);
                    }

                    if(start === end) {
                        this.selectionStart = end + count;
                    } else {
                        this.selectionStart = start;
                    }

                    this.selectionEnd = end + count;
                }
            });
           
    } else {
        $("#box_code").remove();
    }

    }); // end img_code


});    // end ready