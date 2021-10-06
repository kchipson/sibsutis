/* global FLBuilder */

( function ( $ )  {
	$( 'body' ).delegate(
		'.obfx-number-field', 'change', function ( e ) {
			$.proxy( FLBuilder.preview.delayPreview( e ), FLBuilder.preview );
		}
	);
} )( jQuery );
