/* global FLBuilder */

( function ( $ )  {
	$( 'body' ).delegate(
		'.btn-switch__label', 'click', function ( e ) {
			$.proxy( FLBuilder.preview.delayPreview( e ), FLBuilder.preview );
		}
	);
} )( jQuery );
