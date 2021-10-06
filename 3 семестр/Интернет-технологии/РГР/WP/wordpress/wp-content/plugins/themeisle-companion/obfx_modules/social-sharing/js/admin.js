/**
 * Social Sharing Module Admin Script
 *
 * @since    1.0.0
 * @package obfx_modules/social-sharing/js
 *
 * @author    ThemeIsle
 */

var obfx_sharing_module_admin = function( $ ) {
	'use strict';

	$(
		function() {
				$( '.network-toggle input:checkbox:not(:checked)' ).each(
					function () {
						$( this ).parents( '.obfx-row' ).find( '.show input' ).attr( 'disabled', true ).parent().addClass( 'obfxHiddenOption' );
					}
				);

				$( '.network-toggle input' ).on(
					'change', function () {
						if ( $( this ).is( ':checked' ) ) {
							$( this ).parents( '.obfx-row' ).find( '.show input' ).attr( 'disabled', false ).parent().removeClass( 'obfxHiddenOption' );
						} else {
							$( this ).parents( '.obfx-row' ).find( '.show input' ).attr( 'disabled', true ).parent().addClass( 'obfxHiddenOption' );
						}
					}
				);

		}
	);

};

obfx_sharing_module_admin( jQuery );
