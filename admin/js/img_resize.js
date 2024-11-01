//"use strict";
jQuery(document).ready(function($) {

   $("#designArea__out").on({
        
        mousedown: function(ev){
            


            circleRedObject = null;
            circleBlueObject = null;
            circlePurpleObject = null;
            
            ev.preventDefault(); // prevent ghost copy default
            ev.stopPropagation();

            if ($(this).hasClass("circle_red")) {
                $(this).addClass("circle_red_click");
                $(".circle_blue, .circle_purple").remove();
                circleRedObject = this;
            }
            
            if ($(this).hasClass("circle_blue")) {
                $(this).addClass("circle_blue_click");
                $(".circle_red, .circle_purple").remove();
                circleBlueObject = this;
            }
            
            if ($(this).hasClass("circle_purple")) {
                $(this).addClass("circle_purple_click");
                $(".circle_blue, .circle_red").remove();
                circlePurpleObject = this;
            }
            
            //circleRadius = $(".circle_red").width()/2;
            
            // se tiene que hacer por cada uno
            circleCenterDifX = $(this).offset().left + circleRadius - ev.clientX ; // distancia a offset de circulo del mouse al pulsar //".circle_red"
            circleCenterDifY = $(this).offset().top + circleRadius - ev.clientY ; //".circle_red"
            
            //CircleCenterOffsetX;// CircleCenterOffsetY; //

            circleDragging = true;
            circleDragStarted = true;

            SelectedObject = $(".selected:first"); //$(".selected:first"); // <-- this
            SelectedObjects = $(".selected");
            

        },
        
 
   },".circle_red, .circle_blue, .circle_purple");    
      
});
