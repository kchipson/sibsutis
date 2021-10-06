/* globals ajaxurl, wpforms_admin */

/**
 * WPForms Admin Education module.
 *
 * @since 1.5.7
 */

'use strict';

var WPFormsAdminEducation = window.WPFormsAdminEducation || ( function( document, window, $ ) {

	/**
	 * Public functions and properties.
	 *
	 * @since 1.5.7
	 *
	 * @type {object}
	 */
	var app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.5.7
		 */
		init: function() {
			$( document ).ready( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.5.7
		 */
		ready: function() {
			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.7
		 */
		events: function() {

			// Notice bar: click on the dissmiss button.
			$( '#wpforms-notice-bar' ).on( 'click', '.dismiss', function( e ) {

				var $btn = $( this ),
					$notice = $btn.closest( '#wpforms-notice-bar' ),
					data = {
						action: 'wpforms_notice_bar_dismiss',
						nonce: wpforms_admin.nonce,
						page: $btn.attr( 'data-page' ),
					};

				$notice.addClass( 'out' );
				setTimeout(
					function() {
						$notice.remove();
					},
					300
				);

				$.get( ajaxurl, data );
			} );
		},

	};

	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsAdminEducation.init();
