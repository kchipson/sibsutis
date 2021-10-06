/* global elementor */
(function ($) {

	$( document ).ready(
		function () {
			checkImageSize();
		}
	);

	$( window ).resize(
		function () {
			checkImageSize();
		}
	);

	if ( typeof elementor !== 'undefined' ) {
		$( window ).on(
			'elementor/frontend/init', function () {
                elementor.hooks.addAction(
					'panel/open_editor/widget/obfx-posts-grid', function ( panel ) {
						var $element = panel.$el.find( '.elementor-control-section_grid_image' );
						$element.click(
							function () {
								panel.$el.find( '.elementor-control-grid_image_height .elementor-control-input-wrapper' ).mouseup(
									function () {
										checkImageSize();
									}
								);
							}
						);
					}
				);
			}
		);
	}

	/**
	 * Check the container and image size.
	 */
	function checkImageSize() {
		$( '.obfx-grid .obfx-grid-col' ).each(
			function () {
				var container = $( this ).find( '.obfx-grid-col-image' ),
					containerWidth = $( this ).find( '.obfx-grid-col-image' ).width(),
					containerHeight = $( this ).find( '.obfx-grid-col-image' ).height(),
					imageWidth = $( this ).find( '.obfx-grid-col-image img' ).width(),
					imageHeight = $( this ).find( '.obfx-grid-col-image img' ).height();

				if ( $( this ).find( '.obfx-grid-col-image' ).length > 0 ) {
					if ( containerHeight > imageHeight ) {
						container.addClass( 'obfx-fit-height' );
					}

					if ( (containerWidth - imageWidth > 2) && container.hasClass( 'obfx-fit-height' ) ) {
						container.removeClass( 'obfx-fit-height' );
					}
				}
			}
		);
	}

})( jQuery );
