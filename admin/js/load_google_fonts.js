"use strict";

jQuery.each(JSON.parse(familiesArray),function(index, value){
    if ( shortcode_google_fonts.indexOf(value) == -1) shortcode_google_fonts.push(value);
});

//reescribimos la variable en bucle, solo se carga la ultima

WebFontConfig = {
            //typekit: { id: 'xxxxxx' }
            google: {
                families: shortcode_google_fonts//['Black+Ops+One','Bilbo+Swash+Caps','Caesar+Dressing','Cherry+Swash','Felipa']//shortcode_google_fonts//['Black+Ops+One']//, //[ 'Roboto+Condensed', 'Source+Sans+Pro','Eater' ]
                //text: 'Lorem Ipsum'  // Failed to decode download font !!!
            }
        };
