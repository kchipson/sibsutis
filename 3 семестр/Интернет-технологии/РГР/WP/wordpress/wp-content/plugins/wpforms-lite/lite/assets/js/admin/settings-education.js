/* globals wpforms_admin */
/**
 * WPForms Settings Education function.
 *
 * @since 1.5.5
 */

'use strict';

var WPFormsSettingsEducation = window.WPFormsSettingsEducation || ( function( document, window, $ ) {

	/**
	 * Public functions and properties.
	 *
	 * @since 1.5.5
	 *
	 * @type {Object}
	 */
	var app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.5.5
		 */
		init: function() {
			$( document ).ready( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.5.5
		 */
		ready: function() {
			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.5
		 */
		events: function() {
			app.clickEvents();
		},

		/**
		 * Registers JS click events.
		 *
		 * @since 1.5.5
		 */
		clickEvents: function() {

			$( document ).on(
				'click',
				'.wpforms-settings-provider.education-modal',
				function( event ) {

					var $this = $( this );

					event.preventDefault();
					event.stopImmediatePropagation();

					app.upgradeModal( $this.data( 'name' ) );
				}
			);
		},

		/**
		 * Upgrade modal.
		 *
		 * @since 1.5.5
		 *
		 * @param {string} feature Feature name.
		 */
		upgradeModal: function( feature ) {

			var message    = wpforms_admin.upgrade_message.replace( /%name%/g, feature ),
				upgradeURL = encodeURI( wpforms_admin.upgrade_url + '&utm_content=' + feature.trim() );

			$.alert( {
				title   : feature + ' ' + wpforms_admin.upgrade_title,
				icon    : 'fa fa-lock',
				content : message,
				boxWidth: '550px',
				onOpenBefore: function() {
					this.$btnc.after( '<div class="discount-note">' + wpforms_admin.upgrade_bonus + wpforms_admin.upgrade_doc + '</div>' );
					this.$body.find( '.jconfirm-content' ).addClass( 'lite-upgrade' );
				},
				buttons : {
					confirm: {
						text    : wpforms_admin.upgrade_button,
						btnClass: 'btn-confirm',
						keys    : [ 'enter' ],
						action: function() {
							window.open( upgradeURL, '_blank' );
							$.alert( {
								title   : false,
								content : wpforms_admin.upgrade_modal,
								icon    : 'fa fa-info-circle',
								type    : 'blue',
								boxWidth: '565px',
								buttons : {
									confirm: {
										text    : wpforms_admin.ok,
										btnClass: 'btn-confirm',
										keys    : [ 'enter' ],
									},
								},
							} );
						},
					},
				},
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsSettingsEducation.init();
