/**
 * Social Sharing Module Public Script
 *
 * @since	1.0.0
 * @package obfx_modules/social-sharing/js
 *
 * @author	ThemeIsle
 */

var obfx_sharing_module = function( $ ) {
	'use strict';

	$(
		function() {
				$( '.obfx-sharing a, .obfx-sharing-inline a' ).not( '.whatsapp, .mail, .viber' ).on(
					'click', function(e) {
						e.preventDefault();
						var link = $( this ).attr( 'href' );

						window.open( link, 'obfxShareWindow', 'height=450, width=550, top=' + ( $( window ).height() / 2 - 275 ) + ', left=' + ( $( window ).width() / 2 - 225 ) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0' );
						return true;
					}
				);
		}
	);
};

obfx_sharing_module( jQuery );
