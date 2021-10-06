/* globals ajaxurl, tinymce */
/**
 * WPForms Challenge function.
 *
 * @since 1.5.0
 */
'use strict';

if ( typeof WPFormsChallenge === 'undefined' ) {
	var WPFormsChallenge = {};
}

WPFormsChallenge.embed = window.WPFormsChallenge.embed || ( function( document, window, $ ) {

	/**
	 * Public functions and properties.
	 *
	 * @since 1.5.0
	 *
	 * @type {Object}
	 */
	var app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.5.0
		 */
		init: function() {

			$( document ).ready( app.ready );
			$( window ).load( app.load );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.5.0
		 */
		ready: function() {
			app.setup();
			app.events();
		},

		/**
		 * Window load.
		 *
		 * @since 1.5.0
		 */
		load: function() {

			// TinyMCE's iframe is treated like a separate window and needs its own 'blur' and 'focus' events.
			if ( typeof tinymce !== 'undefined' && tinymce.activeEditor !== null ) {
				tinymce.dom.Event.bind( tinymce.activeEditor.getWin(), 'blur', function() {
					WPFormsChallenge.core.timer.pause();
				} );
				tinymce.dom.Event.bind( tinymce.activeEditor.getWin(), 'focus', function() {
					WPFormsChallenge.core.timer.resume();
				} );
			}

			if ( WPFormsChallenge.core.isGutenberg() ) {
				WPFormsChallenge.core.initTooltips( 5, '.block-editor .components-notice-list', { side: 'bottom' } );
			} else {
				WPFormsChallenge.core.initTooltips( 5, '.wpforms-insert-form-button', { side: 'right' } );
			}

			WPFormsChallenge.core.updateTooltipUI();
		},

		/**
		 * Initial setup.
		 *
		 * @since 1.5.0
		 */
		setup: function() {

			if ( 5 === WPFormsChallenge.core.loadStep() ) {
				app.showPopup();
			}

			$( '.wpforms-challenge' ).show();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.0
		 */
		events: function() {

			$( '.wpforms-challenge-step5-done' ).click( function() {
				WPFormsChallenge.core.timer.pause();
				WPFormsChallenge.core.stepCompleted( 5 );
				app.showPopup();
			} );

			$( '.wpforms-challenge-popup-close' ).click( function() {
				app.completeChallenge();
			} );

			$( '.wpforms-challenge-popup-rate-btn' ).click( function() {
				app.completeChallenge();
			} );

			$( '#wpforms-challenge-contact-form' ).submit( function( e ) {
				e.preventDefault();
				app.submitContactForm()
					.done( app.completeChallenge );
			} );
		},

		/**
		 * Show either 'Congratulations' or 'Contact Us' popup.
		 *
		 * @since 1.5.0
		 */
		showPopup: function() {

			var secondsLeft = WPFormsChallenge.core.timer.getSecondsLeft();

			$( '.wpforms-challenge-popup-container' ).show();

			if ( 0 < secondsLeft ) {
				var secondsSpent = WPFormsChallenge.core.timer.getSecondsSpent( secondsLeft );

				$( '#wpforms-challenge-congrats-minutes' )
					.text( WPFormsChallenge.core.timer.getMinutesFormatted( secondsSpent ) );
				$( '#wpforms-challenge-congrats-seconds' )
					.text( WPFormsChallenge.core.timer.getSecondsFormatted( secondsSpent ) );
				$( '#wpforms-challenge-congrats-popup' ).show();
			} else {
				$( '#wpforms-challenge-contact-popup' ).show();
			}
		},

		/**
		 * Hide the popoup.
		 *
		 * @since 1.5.0
		 */
		hidePopup: function() {
			$( '.wpforms-challenge-popup-container' ).hide();
			$( '.wpforms-challenge-popup' ).hide();
		},

		/**
		 * Complete Challenge.
		 *
		 * @since 1.5.0
		 */
		completeChallenge: function() {

			var optionData = {
				status       : 'completed',
				seconds_spent: WPFormsChallenge.core.timer.getSecondsSpent(),
				seconds_left : WPFormsChallenge.core.timer.getSecondsLeft(),
			};

			app.hidePopup();

			WPFormsChallenge.core.removeChallengeUI();
			WPFormsChallenge.core.clearLocalStorage();

			WPFormsChallenge.admin.saveChallengeOption( optionData )
				.done( WPFormsChallenge.core.triggerPageSave ); // Save and reload the page to remove WPForms Challenge JS.
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.0
		 *
		 * @returns {Object} jqXHR object from AJAX call.
		 */
		submitContactForm: function() {
			var $form = $( '#wpforms-challenge-contact-form' );

			var data = {
				action      : 'wpforms_challenge_send_contact_form',
				_wpnonce    : WPFormsChallenge.admin.l10n.nonce,
				contact_data: {
					message   : $form.find( '.wpforms-challenge-contact-message' ).val(),
					contact_me: $form.find( '.wpforms-challenge-contact-permission' ).prop( 'checked' ),
				},
			};

			return $.post( ajaxurl, data, function( response ) {
				if ( ! response.success ) {
					console.error( 'Error sending WPForms Challenge Contact Form.' );
				}
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsChallenge.embed.init();
