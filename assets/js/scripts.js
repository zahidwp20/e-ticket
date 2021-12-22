/* globals Chart:false, feather:false */
(function ($, window, document) {
    "use strict";

(function () {
    'use strict'
    feather.replace({'aria-hidden': 'true'})
})()

    $( function() {
        $( "#datepicker" ).datepicker();
    } );


    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
    });

})(jQuery, window, document);