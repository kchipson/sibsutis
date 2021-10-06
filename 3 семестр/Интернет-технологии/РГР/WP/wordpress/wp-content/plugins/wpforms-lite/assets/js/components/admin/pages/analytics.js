/* global wpforms_pluginlanding, wpforms_admin */

/**
 * Analytics Sub-page.
 *
 * @since 1.5.7
 */

'use strict';

var WPFormsPagesAnalytics = window.WPFormsPagesAnalytics || ( function( document, window, $ ) {

	/**
	 * Elements.
	 *
	 * @since 1.5.7
	 *
	 * @type {object}
	 */
	var el = {};

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

			app.initVars();
			app.events();
		},

		/**
		 * Init variables.
		 *
		 * @since 1.5.7
		 */
		initVars: function() {

			el = {
				$stepInstall:    $( 'section.step-install' ),
				$stepInstallNum: $( 'section.step-install .num img' ),
				$stepSetup:      $( 'section.step-setup' ),
				$stepSetupNum:   $( 'section.step-setup .num img' ),
				$stepAddon:      $( 'section.step-addon' ),
				$stepAddonNum:   $( 'section.step-addon .num img' ),
			};
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.7
		 */
		events: function() {

			// Step 'Install' button click.
			el.$stepInstall.on( 'click', 'button', app.stepInstallClick );

			// Step 'Setup' button click.
			el.$stepSetup.on( 'click', 'button', app.gotoURL );

			// Step 'Addon' button click.
			el.$stepAddon.on( 'click', 'button', app.gotoURL );
		},

		/**
		 * Step 'Install' button click.
		 *
		 * @since 1.5.7
		 *
		 */
		stepInstallClick: function() {

			var $btn = $( this ),
				action = $btn.attr( 'data-action' ),
				plugin = $btn.attr( 'data-plugin' ),
				ajaxAction = '';

			if ( $btn.hasClass( 'disabled' ) ) {
				return;
			}

			switch ( action ) {
				case 'activate':
					ajaxAction = 'wpforms_activate_addon';
					$btn.text( wpforms_pluginlanding.activating );
					break;

				case 'install':
					ajaxAction = 'wpforms_install_addon';
					$btn.text( wpforms_pluginlanding.installing );
					break;

				case 'goto-url':
					window.location.href = $btn.attr( 'data-url' );
					return;

				default:
					return;
			}

			$btn.addClass( 'disabled' );
			app.showSpinner( el.$stepInstallNum );

			var data = {
				action: ajaxAction,
				nonce : wpforms_admin.nonce,
				plugin: plugin,
				type  : 'plugin',
			};
			$.post( wpforms_admin.ajax_url, data )
				.done( function( res ) {
					app.stepInstallDone( res, $btn, action );
				} )
				.always( function() {
					app.hideSpinner( el.$stepInstallNum );
				} );
		},

		/**
		 * Done part of the step 'Install'.
		 *
		 * @since 1.5.7
		 *
		 * @param {object} res    Result of $.post() query.
		 * @param {jQuery} $btn   Button.
		 * @param {string} action Action (for more info look at the app.stepInstallClick() function).
		 */
		stepInstallDone: function( res, $btn, action ) {

			if ( res.success ) {
				el.$stepInstallNum.attr( 'src', el.$stepInstallNum.attr( 'src' ).replace( 'step-1.', 'step-complete.' ) );
				$btn.addClass( 'grey' ).text( wpforms_pluginlanding.activated );
				app.stepInstallPluginStatus();
			} else {
				var url = 'install' === action ? wpforms_pluginlanding.mi_manual_install_url : wpforms_pluginlanding.mi_manual_activate_url,
					msg = 'install' === action ? wpforms_pluginlanding.error_could_not_install : wpforms_pluginlanding.error_could_not_activate,
					btn = 'install' === action ? wpforms_pluginlanding.download_now : wpforms_pluginlanding.plugins_page;

				$btn.removeClass( 'grey disabled' ).text( btn ).attr( 'data-action', 'goto-url' ).attr( 'data-url', url );
				$btn.after( '<p class="error">' + msg + '</p>' );
			}
		},

		/**
		 * Callback for step 'Install' completion.
		 *
		 * @since 1.5.7
		 */
		stepInstallPluginStatus: function() {

			var data = {
				action: 'wpforms_analytics_page_check_plugin_status',
				nonce : wpforms_admin.nonce,
			};
			$.post( wpforms_admin.ajax_url, data ).done( app.stepInstallPluginStatusDone );
		},

		/**
		 * Done part of the callback for step 'Install' completion.
		 *
		 * @since 1.5.7
		 *
		 * @param {object} res Result of $.post() query.
		 */
		stepInstallPluginStatusDone: function( res ) {

			if ( ! res.success ) {
				return;
			}

			el.$stepSetup.removeClass( 'grey' );
			el.$stepSetupBtn = el.$stepSetup.find( 'button' );

			if ( res.data.setup_status > 0 ) {
				el.$stepSetupNum.attr( 'src', el.$stepSetupNum.attr( 'src' ).replace( 'step-2.svg', 'step-complete.svg' ) );
				el.$stepAddon.removeClass( 'grey' );
				el.$stepAddon.find( 'button' ).attr( 'data-url', res.data.step3_button_url ).removeClass( 'grey' ).removeClass( 'disabled' );

				if ( res.data.license_level === 'pro' ) {
					var buttonText = res.data.addon_installed > 0 ? wpforms_pluginlanding.activate_now : wpforms_pluginlanding.install_now;
					el.$stepAddon.find( 'button' ).text( buttonText );
				}
			} else {
				el.$stepSetupBtn.removeClass( 'grey' ).removeClass( 'disabled' );
			}
		},

		/**
		 * Go to URL by click on the button.
		 *
		 * @since 1.5.7
		 */
		gotoURL: function() {

			var $btn = $( this );

			if ( $btn.hasClass( 'disabled' ) ) {
				return;
			}

			window.location.href = $btn.attr( 'data-url' );
		},

		/**
		 * Display spinner.
		 *
		 * @since 1.5.7
		 *
		 * @param {jQuery} $el Section number image jQuery object.
		 */
		showSpinner: function( $el ) {

			$el.siblings( '.loader' ).removeClass( 'hidden' );
		},

		/**
		 * Hide spinner.
		 *
		 * @since 1.5.7
		 *
		 * @param {jQuery} $el Section number image jQuery object.
		 */
		hideSpinner: function( $el ) {

			$el.siblings( '.loader' ).addClass( 'hidden' );
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsPagesAnalytics.init();
