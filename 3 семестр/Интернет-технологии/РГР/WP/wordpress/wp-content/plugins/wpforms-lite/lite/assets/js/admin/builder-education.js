/* globals wpforms_builder_lite, wpforms_builder */
/**
 * WPForms Form Builder Education function.
 *
 * @since 1.5.1
 */

'use strict';

var WPFormsBuilderEducation = window.WPFormsBuilderEducation || ( function( document, window, $ ) {

	/**
	 * Public functions and properties.
	 *
	 * @since 1.5.1
	 *
	 * @type {Object}
	 */
	var app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.5.1
		 */
		init: function() {
			$( document ).ready( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.5.1
		 */
		ready: function() {
			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.1
		 */
		events: function() {
			app.clickEvents();
		},

		/**
		 * Registers JS click events.
		 *
		 * @since 1.5.1
		 */
		clickEvents: function() {

			$( document ).on(
				'click',
				'.wpforms-add-fields-button, .wpforms-panel-sidebar-section, .wpforms-builder-settings-block-add, .wpforms-field-option-group-toggle',
				function( event ) {

					var $this = $( this );

					if ( $this.hasClass( 'upgrade-modal' ) ) {

						event.preventDefault();
						event.stopImmediatePropagation();

						if ( $this.hasClass( 'wpforms-add-fields-button' ) ) {
							app.upgradeModal( $this.text() + ' ' + wpforms_builder.field );
						} else {
							app.upgradeModal( $this.data( 'name' ) );
						}
					}
				}
			);
		},

		/**
		 * Upgrade modal.
		 *
		 * @since 1.5.1
		 *
		 * @param {string} feature Feature name.
		 */
		upgradeModal: function( feature ) {

			var message    = wpforms_builder_lite.upgrade_message.replace( /%name%/g, feature ),
				upgradeURL = encodeURI( wpforms_builder_lite.upgrade_url + '&utm_content=' + feature.trim() );

			$.alert( {
				title   : feature + ' ' + wpforms_builder_lite.upgrade_title,
				icon    : 'fa fa-lock',
				content : message,
				boxWidth: '550px',
				onOpenBefore: function() {
					this.$btnc.after( '<div class="discount-note">' + wpforms_builder_lite.upgrade_bonus + wpforms_builder_lite.upgrade_doc + '</div>' );
					this.$body.find( '.jconfirm-content' ).addClass( 'lite-upgrade' );
				},
				buttons : {
					confirm: {
						text    : wpforms_builder_lite.upgrade_button,
						btnClass: 'btn-confirm',
						keys    : [ 'enter' ],
						action: function () {
							window.open( upgradeURL, '_blank' );
							$.alert({
								title   : false,
								content : wpforms_builder_lite.upgrade_modal,
								icon    : 'fa fa-info-circle',
								type    : 'blue',
								boxWidth: '565px',
								buttons : {
									confirm: {
										text    : wpforms_builder.ok,
										btnClass: 'btn-confirm',
										keys    : [ 'enter' ]
									}
								}
							} );
						}
					}
				}
			} );
		}
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

// Initialize.
WPFormsBuilderEducation.init();
