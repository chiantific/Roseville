/**
 * This file contains the General Functions javascript namespace.
 * It contains functions that apply both on the front and back
 * end of the application.
 *
 * @namespace GeneralFunctions
 */
var GeneralFunctions = {
    /**
     * Hide the preloader animation
     */
    hidePreloader: function() {
        $("#status").fadeOut("slow");
        $("#preloader").delay(500).fadeOut("slow").remove();
    },

    /**
     * Automatically display or hide the navbar while scrolling
     */
    autoToggleNavbar: function() {
        // Hide .navbar first
        $(".navbar").hide();

        // Fade in .navbar
        $(function() {
            $(window).scroll(function () {
                // set distance user needs to scroll before we fadeIn navbar
                if ($(this).scrollTop() > 200) {
                    $('.navbar').fadeIn();
                } else {
                    $('.navbar').fadeOut();
                }
            });
        });
    }
};
