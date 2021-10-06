;(function($) {

	var WPFormsBuilderLite = {

		/**
		 * Start the engine.
		 *
		 * @since 1.0.0
		 */
		init: function() {

			// Document ready
			$(document).ready(function() {
				WPFormsBuilderLite.ready();
			});

			WPFormsBuilderLite.bindUIActions();
		},

		/**
		 * Document ready.
		 *
		 * @since 1.0.0
		 */
		ready: function() {
		},

		/**
		 * Element bindings.
		 *
		 * @since 1.0.0
		 */
		bindUIActions: function() {

			// Warn users if they disable email notifications.
			$( document ).on( 'change', '#wpforms-panel-field-settings-notification_enable', function() {
				WPFormsBuilderLite.formBuilderNotificationAlert( $( this ).val() );
			} );
		},

		/**
		 * Warn users if they disable email notifications.
		 *
		 * @since 1.5.0
		 */
		formBuilderNotificationAlert: function( value ) {

			if ( '0' !== value ) {
				return;
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: wpforms_builder_lite.disable_notifications,
				backgroundDismiss: false,
				closeIcon: false,
				icon: 'fa fa-exclamation-circle',
				type: 'orange',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ]
					}
				}
			} );
		}
	};

	WPFormsBuilderLite.init();

})(jQuery);
