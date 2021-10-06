jQuery( document ).ready(function($){

	var currentCategories = [];

	$.each( icons.icons, function(index,el){

		var currentIconCategories = '';

		// collect all icons' categories
		$.each(el.categories, function(c_index,category){
			var aux = category.toLowerCase();
			aux = aux.replace( /\s+/g, '-' );
			currentIconCategories = currentIconCategories + aux + ' ';
			if ( $.inArray( category, currentCategories ) < 0 ) {
				currentCategories.push( category );
			}
		});

		if ( el.filter != undefined ) {
			var search = el.filter;
			search.push( el.name );
			search = search.join( ' ' );
		} else {
			var search = el.name;
		}

		var css_class = 'fa fa-' + el.id;
		var icon_html = '<a href="#" data-search="' + search + '" data-class="' + css_class + '" class="' + currentIconCategories + 'rhea-fontawesome-icon"><i class="' + css_class + '"></i></a>';
		$( '#fontawesome-popup .right-side' ).append( icon_html );

	});

	currentCategories.sort();

	$.each(currentCategories, function( index, category ){
		var aux = category.toLowerCase();
		aux = aux.replace( /\s+/g, '-' );
		$( '.filter-icons' ).append( '<li data-filter="' + aux + '">' + category + '</li>' );
	});

	$( '#fontawesome-popup .filter-icons li' ).live('click', function(){
		$( '#fontawesome-popup .filter-icons li.active' ).removeClass( 'active' );
		$( this ).addClass( 'active' );
		var filter = $( this ).data( 'filter' );
		if ( filter != 'all' ) {
			$( '#fontawesome-popup .rhea-fontawesome-icon.' + filter ).show();
			$( '#fontawesome-popup .rhea-fontawesome-icon' ).not( '.' + filter ).hide();
		} else {
			$( '#fontawesome-popup .rhea-fontawesome-icon' ).show();
		}
	});

	var Rhea_FP = {'element':''};

	Rhea_FP.open = function( element ){
		Rhea_FP.element = element;
		$( "#fontawesome-popup" ).dialog({
			title: "Select Icon",
			resizable: false,
			minHeight: 520,
			width: 980,
			modal: true,
			closeOnEscape: true,
			dialogClass: 'rhea-fontawesome-dialog',
		});
	};

	Rhea_FP.close = function(){
		Rhea_FP.element = '';
		$( "#fontawesome-popup" ).dialog( "close" );
	};

	$( '.add-icon-button' ).live('click', function(){
		var parent = $( this ).parent().parent();
		Rhea_FP.open( parent );
	});

	$( '.rhea-fontawesome-icon' ).live('click', function( evt ){
		evt.preventDefault();
		var icon = $( this ).data( 'class' );
		Rhea_FP.element.removeClass( 'empty-icon' );
		Rhea_FP.element.find( 'input' ).val( icon );
		Rhea_FP.element.find( '.icon-holder i' ).attr( 'class', icon );
		Rhea_FP.close();
	});

	$( '.change-icon-button' ).live('click', function(){
		var parent = $( this ).parent().parent();
		Rhea_FP.open( parent );
	});

	$( '.remove-icon-button' ).live('click', function(){
		$( this ).parent().parent().addClass( 'empty-icon' );
		$( this ).parent().parent().find( 'input' ).val( '' );
	});

});
