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

    $(document).on('click', '.empm-update-user-status', function () {

        let thisButton = $(this),
            thisRow = thisButton.parent().parent(),
            userID = thisRow.data('user-id'),
            userStatusTarget = thisButton.data('status-target');

        thisButton.html('Working...');
        console.log(userID);

        $.ajax({
            url: 'ajax.php',
            type: 'post',
            context: this,
            data: {
                action: 'empm_update_user_status',
                user_id: userID,
                status_target: userStatusTarget,
            },
            success: function (result) {

                let response = JSON.parse(result);

                if (response.status) {
                    setTimeout(function () {
                        thisRow.html(response.message);
                    }, 500);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

        return false;
    });


})(jQuery, window, document);