/* global wp */
/* global customizer_notice_data */
/* global console */
(function (api) {

    api.sectionConstructor['customizer-plugin-notice-section'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function () {
        },

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

})(wp.customize);

jQuery(document).ready(function ($) {

    $('.dismiss-button-recommended-plugin').click(function () {
        var id = $(this).attr('id'),
            action = $(this).attr('data-action');
        $.ajax({
            type: 'GET',
            data: {action: 'dismiss_recommended_plugins', id: id, todo: action},
            dataType: 'html',
            url: customizer_notice_data.ajaxurl,
            beforeSend: function () {
                $('#' + id).parent().append('<div id="temp_load" style="text-align:center"><img src="' + customizer_notice_data.base_path + '/images/spinner-2x.gif" /></div>');
            },
            success: function (data) {
                var container = $('#' + data).parent().parent();
                container.slideToggle().remove();
                
                if( $('.recomended-actions_container > .popularis-recommended-plugins').length === 0 ){
                    $('.control-section-customizer-plugin-notice-section').remove();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
            }
        });
    });

    // Remove activate button and replace with activation in progress button.
    $('.activate-now').live('DOMNodeInserted', function () {
        var activateButton = $('.activate-now');
        if( activateButton.length ){
            var url = activateButton.attr('href');
            if( typeof url !== 'undefined' ){
                //Request plugin activation.
                $.ajax({
                    beforeSend: function () {
                        activateButton.replaceWith('<a class="button updating-message">' + customizer_notice_data.activating_string + '...</a>');
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
    
    $('.activate-now').on('click', function(e){
        var activateButton = $(this);
        e.preventDefault();
        if (activateButton.length) {
            var url = activateButton.attr('href');
            if (typeof url !== 'undefined') {
                //Request plugin activation.
                $.ajax({
                    beforeSend: function () {
                        activateButton.replaceWith('<a class="button updating-message">' + customizer_notice_data.activating_string + '...</a>');
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
