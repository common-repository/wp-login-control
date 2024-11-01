//"use strict";
jQuery(document).ready(function($) {

    $('.designer_tool').draggable({containment:'document',opacity:'0.7',handle:'h3.fs-menu'}); 
    
    
    $('.designer_tool').on("dragstart click", function(){ 
        $(".designer_tool").css("z-index","98");
        $(this).css("z-index","99");
     });    
    
    
    $("#elements_box").on("mouseenter",".icon-container",function(){ 
        
        document.getElementById(this.id).addEventListener("dragstart",drag); //Mozilla only works with addEventListener 
    
    });
    
    $("#elements_box").on("mouseover",".icon-container",function(){ 
        $(this).find("div").addClass("icon-close");
        }).on("mouseleave",".icon-container",function(){
            $(this).find("div").removeClass("icon-close");
            }).on("click",".icon-close",function(){
                $(this).parent().remove(); //remove image  
            });
    
    //************ media ***************//
    
    $(".media-button").click(open_media_window);   
    
    function open_media_window() {

    var tabIndex = 0;      


        $(this).parents("div").find(".fa:first-child").removeClass("fa-caret-right");
        $(this).parents("div").removeClass("collapsed");

           
        if (this.window === undefined) {

            this.window = wp.media({
                title: obj_translation.Insert_a_media_image,
                library: {type: 'image'},
                multiple: true,
                button: {text: obj_translation.Insert_image}
            });



        // this.window.on('escape',function(){alert('n');}); //funciona ok
        //this.window.on('all',function(n){alert(n);});

                        
        var self = this; // Needed to retrieve our variable in the anonymous function below

        this.window.on('select',function(n){

            var selection = self.window.state().get('selection').toArray();      
            let last_index;

            last_index =  $(".icons-container > div").length;
            if ( last_index > 0 ) last_index =  parseInt($(".icons-container > div:last").attr("id").substring( 13 )) + parseInt(1); // len "img_template_"

            $.each(selection,function(index,element){
        //         alert(element.toJSON().url);                //recorre todos los elementos seleccionados

                    $(".icons-container").append('<div id="img_template_'+ ( parseInt(last_index) + parseInt(index) ) +'" class="icon-container not_selectable" style="background-image: url(' + element.toJSON().url + ')" draggable="true" object="image_template"> <div class=""></div></div>'); 

                //      $(self).after('<div id="id_f" class="icon-container" style="background-image: url(' + element.toJSON().url + ')" draggable="true" object="image"> <div class=""></div></div>'); 
                    
        });  
            
            
            //alert(selection[0].toJSON().url);
        });        

        // this.window.on('close', function() {  //cuidado eliminar o poner en if
        //                var first = self.window.state().get('selection').first().toJSON();
        //                wp.media.editor.insert('[myshortcode id="' + first.id + '"]');
        //                $(".media-input").val(first.url);
        //            });
        }

        this.window.open();
                
        return false;
}       
    
    
});

