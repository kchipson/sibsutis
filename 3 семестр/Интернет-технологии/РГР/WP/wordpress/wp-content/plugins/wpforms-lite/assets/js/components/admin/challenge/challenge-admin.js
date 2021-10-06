/* globals wpforms_challenge_admin, ajaxurl */
/**
 * WPForms Challenge Admin function.
 *
 * @since 1.5.0
 */
'use strict';

if ( typeof WPFormsChallenge === 'undefined' ) {
	var WPFormsChallenge = {};
}

WPFormsChallenge.admin = window.WPFormsChallenge.admin || ( function( document, window, $ ) {

	/**
	 * Public functions and properties.
	 *
	 * @since 1.5.0
	 *
	 * @type {Object}
	 */
	var app = {

		l10n: wpforms_challenge_admin,

		/**
		 * Start the engine.
		 *
		 * @since 1.5.0
		 */
		init: function() {

			$( document ).ready( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.5.0
		 */
		ready: function() {

			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.0
		 */
		events: function() {

			$( '.wpforms-challenge-skip' ).click( function() {
				app.skipChallenge();
			} );

			$( '.block-timer .caret-icon' ).click( function() {
				app.toggleList( $( this ) );
			} );
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.0
		 *
		 * @param {Object} $caretIcon Caret icon jQuery element.
		 */
		toggleList: function( $caretIcon ) {

			var $listBlock = $( '.wpforms-challenge-list-block' );

			if ( ! $listBlock.length || ! $caretIcon.length ) {
				return;
			}

			if ( $caretIcon.hasClass( 'closed' ) ) {
				$listBlock.show();
				$caretIcon.removeClass( 'closed' );
			} else {
				$listBlock.hide();
				$caretIcon.addClass( 'closed' );
			}
		},

		/**
		 * Skip the Challenge without starting it.
		 *
		 * @since 1.5.0
		 */
		skipChallenge: function() {

			var optionData = {
				status       : 'skipped',
				seconds_spent: 0,
				seconds_left : app.l10n.minutes_left * 60,
			};

			$( '.wpforms-challenge' ).remove();

			app.saveChallengeOption( optionData )
				.done( location.reload.bind( location ) ); // Reload the page to remove WPForms Challenge JS.
		},

		/**
		 * Set Challenge parameter(s) to Challenge option.
		 *
		 * @since 1.5.0
		 *
		 * @param {Object} optionData Query using option schema keys.
		 */
		saveChallengeOption: function( optionData ) {

			var data = {
				action     : 'wpforms_challenge_save_option',
				option_data: optionData,
				_wpnonce   : app.l10n.nonce,
			};

			return $.post( ajaxurl, data, function( response ) {
				if ( ! response.success ) {
					console.error( 'Error saving WPForms Challenge option.' );
				}
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

WPFormsChallenge.admin.init();
