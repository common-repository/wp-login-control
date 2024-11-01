jQuery(document).ready(function($) {

                //Check if browser is IE or not
                if (navigator.userAgent.search("MSIE") >= 0) {

                }
                //Check if browser is Edge or not
                else if (navigator.userAgent.search("Edge") >= 0) {

                }
                //Check if browser is Opera or not
                else if (navigator.userAgent.search("Opera") >= 0 || navigator.userAgent.search("OPR") >= 0) {

                }
                //Check if browser is Chrome or not
                else if (navigator.userAgent.search("Chrome") >= 0) {

                }
                //Check if browser is Firefox or not
                else if (navigator.userAgent.search("Firefox") >= 0) {
                    $("body").on("DOMSubtreeModified", "#column-span_" , function() { //DOMNodeInserted
                        $("#column-span_").remove();
                     });
                }
                //Check if browser is Safari or not
                else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {

                }

});