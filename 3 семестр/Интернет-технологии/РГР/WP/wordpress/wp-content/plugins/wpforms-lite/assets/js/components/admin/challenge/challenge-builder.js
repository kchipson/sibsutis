/* globals WPFormsBuilder, ajaxurl */
/**
 * WPForms Challenge function.
 *
 * @since 1.5.0
 */
'use strict';

if ( typeof WPFormsChallenge === 'undefined' ) {
	var WPFormsChallenge = {};
}

WPFormsChallenge.builder = window.WPFormsChallenge.builder || ( function( document, window, $ ) {

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

			WPFormsChallenge.core.updateTooltipUI();

			$( '.wpforms-challenge' ).show();
		},

		/**
		 * Initial setup.
		 *
		 * @since 1.5.0
		 */
		setup: function() {

			var tooltipAnchors = [
				'#wpforms-setup-name',
				'.wpforms-setup-title.core',
				'.wpforms-add-fields-heading[data-group="standard"] span',
				'#wpforms-panel-field-settings-notification_enable-wrap',
			];

			$.each( tooltipAnchors, function( i, anchor ) {

				WPFormsChallenge.core.initTooltips( i + 1, anchor );
			} );
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.0
		 */
		events: function() {

			$( '#wpforms-builder' )
				.off( 'click', '.wpforms-template-select' ) // Intercept Form Builder's form template selection and apply own logic.
				.on( 'click', '.wpforms-template-select', function( e ) {
					app.builderTemplateSelect( this, e );
				} )
				.on( 'wpformsPanelSwitch wpformsPanelSectionSwitch', function() {
					WPFormsChallenge.core.updateTooltipUI();
				} );

			$( '.wpforms-challenge-step1-done' ).click( function() {
				WPFormsChallenge.core.stepCompleted( 1 );
			} );

			$( '.wpforms-challenge-step3-done' ).click( function() {
				WPFormsChallenge.core.stepCompleted( 3 );
				WPFormsBuilder.panelSwitch( 'settings' );
				WPFormsBuilder.panelSectionSwitch( $( '.wpforms-panel .wpforms-panel-sidebar-section-notifications' ) );
			} );

			$( 'body' ).on( 'click', '.wpforms-challenge-step4-done', function() {
				WPFormsChallenge.core.stepCompleted( 4 );
				app.saveFormAndRedirect();
			} );

			$.tooltipster.on( 'ready', function( event ) {

				var step = $( event.origin ).data( 'wpforms-challenge-step' );
				var formId = $( '#wpforms-builder-form' ).data( 'id' );

				step = parseInt( step, 10 ) || 0;
				formId = parseInt( formId, 10 ) || 0;

				// Save challenge form ID right after it's created.
				if ( 3 === step && formId > 0 ) {
					WPFormsChallenge.admin.saveChallengeOption( { form_id: formId } );
				}
			} );
		},

		/**
		 * Save the second step before a template is selected.
		 *
		 * @since 1.5.0
		 *
		 * @param {string} el Element selector.
		 * @param {Object} e Event.
		 */
		builderTemplateSelect: function( el, e ) {

			var step = WPFormsChallenge.core.loadStep();

			if ( 0 === step || 1 === step ) {
				WPFormsChallenge.core.stepCompleted( 2 )
					.done( WPFormsBuilder.templateSelect.bind( null, el, e ) );
				return;
			}

			WPFormsBuilder.templateSelect( el, e );
		},

		/**
		 * Save the form and redirect to form embed page.
		 *
		 * @since 1.5.0
		 */
		saveFormAndRedirect: function() {

			WPFormsBuilder.formSave().success( app.embedPageRedirect );
		},

		/**
		 * Redirect to form embed page.
		 *
		 * @since 1.5.0
		 *
		 * @param {Object} formSaveResponse AJAX response from a form saving method.
		 */
		embedPageRedirect: function( formSaveResponse ) {

			// Do not redirect if the form wasn't saved correctly.
			if ( ! formSaveResponse.success ) {
				return;
			}

			var data = {
				action  : 'wpforms_challenge_embed_page_url',
				_wpnonce: WPFormsChallenge.admin.l10n.nonce,
			};

			$.post( ajaxurl, data, function( response ) {
				if ( response.success ) {
					window.location = response.data;
				}
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsChallenge.builder.init();
