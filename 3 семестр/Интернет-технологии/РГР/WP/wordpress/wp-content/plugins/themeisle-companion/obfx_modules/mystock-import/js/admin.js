/* global _wpMediaViewsL10n, mystock_import, jQuery */
function loadMyStockTab($) {
	if(  document.body.classList && document.body.classList.contains( 'block-editor-page' )){
		return;
	}
	var media = wp.media,
		l10n = media.view.l10n = typeof _wpMediaViewsL10n === 'undefined' ? {} : _wpMediaViewsL10n;

	media.view.MediaFrame.Select.prototype.browseRouter = function (view) {
		view.set(
			{
				upload: {
					text: l10n.uploadFilesTitle,
					priority: 20
				},
				browse: {
					text: l10n.mediaLibraryTitle,
					priority: 30
				},
				mystock: {
					text: mystock_import.l10n.tab_name,
					priority: 40
				}
			}
		);
	};

	var bindHandlers = media.view.MediaFrame.Select.prototype.bindHandlers;

	media.view.MediaFrame.Select.prototype.bindHandlers = function () {
		bindHandlers.apply( this, arguments );
		this.on( 'content:create:mystock', this.mystockContent, this );
		this.on(
			'content:render:mystock', function(){
				wp.media.frame.state().get( 'selection' ).reset();
				$( document ).find( '.media-button-select' ).addClass( 'obfx-mystock-featured' ).html( mystock_import.l10n.featured_image_new );
				$( document ).find( '.media-button-insert' ).addClass( 'obfx-mystock-insert' ).html( mystock_import.l10n.insert_image_new );
			}, this
		);
		this.on(
			'content:render:browse content:render:upload', function(){
				$( document ).find( '.media-button-select' ).removeClass( 'obfx-mystock-featured' ).html( mystock_import.l10n.featured_image );
				$( document ).find( '.media-button-insert' ).removeClass( 'obfx-mystock-insert' ).html( mystock_import.l10n.insert_image );
			}, this
		);
	};

	media.view.MediaFrame.Select.prototype.mystockContent = function ( contentRegion ) {
		var state = this.state();

		this.$el.removeClass( 'hide-toolbar' );

		contentRegion.view = new wp.media.view.RemotePhotos(
			{
				controller: this,
				collection: state.get( 'library' ),
				selection:  state.get( 'selection' ),
				model:      state,
				sortable:   state.get( 'sortable' ),
				search:     state.get( 'searchable' ),
				filters:    state.get( 'filterable' ),
				date:       state.get( 'date' ),
				display:    state.has( 'display' ) ? state.get( 'display' ) : state.get( 'displaySettings' ),
				dragInfo:   state.get( 'dragInfo' ),

				idealColumnWidth: state.get( 'idealColumnWidth' ),
				suggestedWidth:   state.get( 'suggestedWidth' ),
				suggestedHeight:  state.get( 'suggestedHeight' ),

				AttachmentView: state.get( 'AttachmentView' )
			}
		);
	};

	// ensure only one scroll request is sent at one time.
	var scroll_called = false;

	media.view.RemotePhotos = media.View.extend(
		{
			tagName: 'div',
			className: 'obfx-attachments-browser',

			initialize: function () {
				// _.defaults(this.options, {});
				var container = this.$el;
				$( container ).html( '<div class="obfx_spinner"></div>' );
				this.loadContent( container,this );
				this.selectItem();
				this.deselectItem();
				this.handleRequest();
			},

			showSpinner: function(container) {
				$( container ).find( '.obfx-image-list' ).addClass( 'obfx_loading' );
				$( container ).find( '.obfx_spinner' ).show();
				$( document ).find( '.media-button-select' ).attr( 'disabled', 'disabled' ).addClass( 'obfx-mystock-featured' ).html( mystock_import.l10n.featured_image_new );
				$( document ).find( '.media-button-insert' ).attr( 'disabled', 'disabled' ).addClass( 'obfx-mystock-insert' ).html( mystock_import.l10n.insert_image_new );
			},
			hideSpinner: function(container) {
				$( container ).find( '.obfx-image-list' ).removeClass( 'obfx_loading' );
				$( container ).find( '.obfx_spinner' ).hide();
			},
			loadContent: function(container, frame){
				this.showSpinner( container );
				$.ajax(
					{
						type : 'POST',
						data : {
							action: 'get-tab-' + mystock_import.slug,
							security : mystock_import.nonce
						},
						url : mystock_import.ajaxurl,
						success : function(response) {
							container.html( response );
							frame.infiniteScroll( container, frame );
						}
					}
				);
			},

			selectItem : function(){
				$( document ).on(
					'click', '.obfx-image', function () {
						$( '.obfx-image' ).removeClass( 'selected details' );
						$( this ).addClass( 'selected details' );
						$( document ).find( '.media-button-insert' ).removeAttr( 'disabled', 'disabled' ).addClass( 'obfx-mystock-insert' ).html( mystock_import.l10n.insert_image_new );
						$( document ).find( '.media-button-select' ).removeAttr( 'disabled', 'disabled' ).addClass( 'obfx-mystock-featured' ).html( mystock_import.l10n.featured_image_new );
					}
				);
			},

			deselectItem :function () {
				$( document ).on(
					'click', '.obfx-image-check', function (e) {
						e.stopPropagation();
						$( this ).parent().removeClass( 'selected details' );
						$( document ).find( '.media-button-insert' ).attr( 'disabled', 'disabled' );
						$( document ).find( '.media-button-select' ).attr( 'disabled', 'disabled' );
					}
				);
			},

			infiniteScroll : function (container, frame) {
				$( '#obfx-mystock .obfx-image-list' ).on(
					'scroll',function() {
						if ($( this ).scrollTop() + $( this ).innerHeight() + 10 >= $( this )[0].scrollHeight) {
							var current_page = parseInt( $( '#obfx-mystock' ).data( 'pagenb' ) );
							if (parseInt( mystock_import.pages ) === current_page) {
								return;
							}
							if (scroll_called) {
								return;
							}
							scroll_called = true;
							frame.showSpinner( container );
							$.ajax(
								{
									type : 'POST',
									data : {
										'action': 'infinite-' + mystock_import.slug,
										'page' : $( '#obfx-mystock' ).data( 'pagenb' ),
										'security' : mystock_import.nonce
									},
									url : mystock_import.ajaxurl,
									success : function(response) {
										scroll_called = false;
										if ( response ) {
											var imageList = $( '.obfx-image-list' );
											var listWrapper = $( '#obfx-mystock' );
											var nextPage = parseInt( current_page ) + 1;
											listWrapper.data( 'pagenb', nextPage );
											imageList.append( response );
										}
										frame.hideSpinner( container );
										frame.deselectItem();
									}

								}
							);
						}
					}
				);
			},

			handleRequest : function () {
				$( document ).on(
					'click','.obfx-mystock-insert', function () {
						$( document ).find( '.media-button-insert' ).attr( 'disabled', 'disabled' ).html( mystock_import.l10n.upload_image );
						$.ajax(
							{
								method : 'POST',
								data : {
									'action': 'handle-request-' + mystock_import.slug,
									'url' : $( '.obfx-image.selected' ).attr( 'data-url' ),
									'security' : mystock_import.nonce
								},
								url : mystock_import.ajaxurl,
								success : function(data) {
									$( document ).find( '.media-button-insert' ).attr( 'disabled', 'disabled' ).html( mystock_import.l10n.insert_image_new );
									if ( 'mystock' === wp.media.frame.content.mode() ) {
										wp.media.frame.content.get( 'library' ).collection.props.set( { '__ignore_force_update': (+ new Date()) } );
										wp.media.frame.content.mode( 'browse' );
										$( document ).find( '.media-button-insert' ).attr( 'disabled', 'disabled' );
										wp.media.frame.state().get( 'selection' ).reset( wp.media.attachment( data.data.id ) );
										$( document ).find( '.media-button-insert' ).trigger( 'click' );
									}
								}
							}
						);
					}
				);

				$( document ).on(
					'click','.obfx-mystock-featured', function () {
						$( document ).find( '.media-button-select' ).attr( 'disabled', 'disabled' ).html( mystock_import.l10n.upload_image );
						$.ajax(
							{
								method : 'POST',
								data : {
									'action': 'handle-request-' + mystock_import.slug,
									'url' : $( '.obfx-image.selected' ).attr( 'data-url' ),
									'security' : mystock_import.nonce
								},
								url : mystock_import.ajaxurl,
								success : function(data) {
									$( document ).find( '.media-button-select' ).attr( 'disabled', 'disabled' ).html( mystock_import.l10n.featured_image_new );
									if ( 'mystock' === wp.media.frame.content.mode() ) {
										wp.media.frame.content.get( 'library' ).collection.props.set( { '__ignore_force_update': (+ new Date()) } );
										wp.media.frame.content.mode( 'browse' );
										$( document ).find( '.media-button-select' ).attr( 'disabled', 'disabled' );
										wp.media.frame.state().get( 'selection' ).reset( wp.media.attachment( data.data.id ) );
										$( document ).find( '.media-button-select' ).trigger( 'click' );
									}
								}
							}
						);
					}
				);
			}
		}
	);
}
document.addEventListener('DOMContentLoaded', function() {
	loadMyStockTab(jQuery);
});