/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/admin/js
 */

var obfx_admin = function ( $ ) {
	'use strict';
	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(
		function () {
			// if ( $( '#toplevel_page_jetpack' ).length ) {
			// var obfx_menu = $( '#toplevel_page_obfx_menu' ).clone().wrap( '<p/>' ).parent().html();
			// $( '#toplevel_page_obfx_menu' ).remove();
			// $( '#toplevel_page_jetpack' ).before( obfx_menu );
			// }
		}
	);

	$(
		function () {
			// Scroll to module if url hash.
			$( document ).ready(
				function() {
					var hash = $( '#' + window.location.hash.substr( 1 ) );
					hash.find( '.btn-expand' ).click();
					scrollToAnchor( hash );
				}
			);

			$( '.obfx-mod-switch' ).on(
				'click', function () {
					var switch_ref = $( this );
					var checked = switch_ref.is( ':checked' );
					var name = switch_ref.attr( 'name' );
					var noance = switch_ref.val();
					var formSwitch = $( switch_ref ).parent();
					$( formSwitch ).addClass( 'loading' ).removeClass( 'activated' );
					if ( $( this ).hasClass( 'obfx-mod-confirm-intent' ) ) {
						var modal = $( '.modal#' + name );
					}

					var post_data = {
						noance: noance,
						name: name,
						checked: checked
					};
					var json_data = JSON.stringify( post_data );

					var ajax_data = {
						'action': 'obfx_update_module_active_status',
						'data': json_data
					};

					$.post(
						'admin-ajax.php', ajax_data, function ( response ) {
							formSwitch.removeClass( 'loading' );
							if ( response.type === 'success' ) {
								var modulePanel = $( '#obfx-mod-' + name );
								if ( checked ) {
                                    formSwitch.addClass( 'activated' );
									$( modulePanel ).find( 'fieldset' ).removeAttr( 'disabled' );
									$( modulePanel ).show();
									if ( modal ) {
										modal.addClass( 'active' );
									} else {
										$( modulePanel ).find( '.btn-expand' ).click();
										scrollToAnchor( modulePanel );
									}
								} else {
									$( modulePanel ).hide();
									$( modulePanel ).find( 'fieldset' ).attr( 'disabled', true );
								}
							} else {
								switch_ref.attr( 'checked', ! switch_ref.attr( 'checked' ) );
							}
						}, 'json'
					);
				}
			);

			function scrollToAnchor(anchor_id){
				if ( anchor_id.length ) {
					$( 'html,body' ).animate( { scrollTop: anchor_id.offset().top }, 'slow' );
				}
			}

			$( '.accept-confirm-intent, .close-confirm-intent' ).on(
				'click', function () {
					var modal = $( this ).closest( '.modal' );
					modal.removeClass( 'active' );
					var switch_ref = modal.prev().find( 'input' );
					var name = switch_ref.attr( 'name' );
					var optionsPanel = $( '#obfx-mod-' + name );
					optionsPanel.find( '.btn-expand' ).click();
					scrollToAnchor( optionsPanel );
					optionsPanel.find( '.form-input:first-of-type' ).focus();

				}
			);

			$( '.close-confirm-intent' ).on(
				'click', function () {
					var modal = $( this ).closest( '.modal' );
					modal.removeClass( 'active' );
				}
			);

			$( '.obfx-toast-dismiss' ).on(
				'click', function () {
					$( this ).closest( '.obfx-mod-toast' ).slideUp(
						400, function () {
							$( this ).removeClass( 'toast-success' );
							$( this ).removeClass( 'toast-error' );
							$( this ).removeClass( 'toast-warning' );
						}
					);
				}
			);

			$( '.btn-expand' ).on(
				'click', function () {
					if ( $( this ).hasClass( 'active' ) ) {
						$( this ).removeClass( 'active' );
						$( this ).closest( '.panel-header' ).siblings( '.obfx-module-form' ).removeClass( 'active' ).parent().removeClass('active');

					} else {
						$( this ).addClass( 'active' );
						$( this ).closest( '.panel-header' ).siblings( '.obfx-module-form' ).addClass( 'active' ).parent().addClass( 'active' );
					}
				}
			);

			$( '.obfx-module-form' ).on(
				'submit reset', function ( e ) {
					e.preventDefault();
					return false;
				}
			);

			$( '.obfx-module-form' ).on(
				'keyup change', 'input, select, textarea', function () {
					$( this ).closest( 'form' ).find( '[class*="obfx-mod-btn"]:disabled' ).removeAttr( 'disabled' );
				}
			);

			$( '.obfx-mod-btn-cancel' ).on(
				'click', function () {
					$( this ).closest( 'form' ).trigger( 'reset' );
					$( this ).closest( 'form' ).find( '[class*="obfx-mod-btn"]' ).attr( 'disabled', true );
				}
			);

			$( '.obfx-mod-btn-save' ).on(
				'click', function () {
					var module_form = $( this ).closest( 'form' );
					module_form.find( '[class*="obfx-mod-btn"]' ).attr( 'disabled', true );
					module_form.find( '.obfx-mod-btn-save' ).addClass( 'loading' );
					module_form.find( $( 'input:checkbox:not(:checked)' ) ).each(
						function () {
							var input = $( '<input />' );
							input.attr( 'type', 'hidden' );
							input.attr( 'name', $( this ).attr( 'name' ) );
							input.attr( 'value', '0' );
							var form = $( this )[ 0 ].form;
							$( form ).append( input );
						}
					);
					var form_data = module_form.serializeArray();
					var maped_array = {};
					$.each(
						form_data, function ( i, elem ) {
							maped_array[ elem.name ] = elem.value;
						}
					);

					form_data = JSON.stringify( maped_array );

					var ajax_data = {
						'action': 'obfx_update_module_options',
						'data': form_data
					};

					$.post(
						'admin-ajax.php', ajax_data, function ( response ) {
							module_form.find( '.obfx-mod-btn-save' ).removeClass( 'loading' );
							if ( response.type ) {
								module_form.closest( '.panel' ).find( '.obfx-mod-toast' ).addClass( 'toast-' + response.type );
								module_form.closest( '.panel' ).find( '.obfx-mod-toast span' ).html( response.message );
								module_form.closest( '.panel' ).find( '.obfx-mod-toast' ).show();
								setTimeout(
									function () {
										module_form.closest( '.panel' ).find( '.obfx-toast-dismiss' ).trigger( 'click' );
									}, 2000
								);
							}
						}, 'json'
					);

				}
			);

		}
	);

};

obfx_admin( jQuery );
