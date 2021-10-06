/* global plugin_helper */
jQuery(document).ready(function ($) {
    $('body').on('click', '.ta-install-plugin', function(){
        var slug = $(this).attr('data-slug');
        wp.updates.installPlugin({
            slug: slug
        });
        return false;
    });
    
    //Remove activate button and replace with activation in progress button.
    $('.activate').live('DOMNodeInserted', function () {
        var activateButton = $('.activate');
        if( activateButton.length ) {
            var url = activateButton.attr('href');
            if( typeof url !== 'undefined' ){
                //Request plugin activation.
                $.ajax({
                    beforeSend: function () {
                        activateButton.replaceWith('<a class="button updating-message">' + plugin_helper.activating + '...</a>');
                    },
                    async: true,
                    type: 'GET',
                    url: url,
                    success: function () {
                        //Reload the page.
                        location.reload();
                    }
                });
            }
        }
    });

    $('.activate').on('click', function (e) {
        var activateButton = $(this);
        e.preventDefault();
        if( activateButton.length ){
            var url = activateButton.attr('href');
            if( typeof url !== 'undefined' ){
                //Request plugin activation.
                $.ajax({
                    beforeSend: function () {
                        activateButton.replaceWith('<a class="button updating-message">' + plugin_helper.activating + '...</a>');
                    },
                    async: true,
                    type: 'GET',
                    url: url,
                    success: function () {
                        //Reload the page.
                        location.reload();
                    }
                });
            }
        }
    });
});