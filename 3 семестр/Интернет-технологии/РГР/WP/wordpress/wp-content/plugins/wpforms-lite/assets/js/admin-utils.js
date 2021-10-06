;
var wpf = {

	cachedFields: {},
	savedState: false,
	initialSave: true,
	orders:  {
		fields: [],
		choices: {}
	},

	// This file contains a collection of utility functions.

	/**
	 * Start the engine.
	 *
	 * @since 1.0.1
	 */
	init: function() {

		wpf.bindUIActions();

		jQuery(document).ready(wpf.ready);
	},

	/**
	 * Document ready.
	 *
	 * @since 1.0.1
	 */
	ready: function() {

		// Load initial form saved state.
		wpf.savedState = wpf.getFormState( '#wpforms-builder-form' );

		// Save field and choice order for sorting later.
		wpf.setFieldOrders();
		wpf.setChoicesOrders();
	},

	/**
	 * Element bindings.
	 *
	 * @since 1.0.1
	 */
	bindUIActions: function() {

		// The following items should all trigger the fieldUpdate trigger.
		jQuery(document).on('wpformsFieldAdd', wpf.setFieldOrders);
		jQuery(document).on('wpformsFieldDelete', wpf.setFieldOrders);
		jQuery(document).on('wpformsFieldMove', wpf.setFieldOrders);
		jQuery(document).on('wpformsFieldAdd', wpf.setChoicesOrders);
		jQuery(document).on('wpformsFieldChoiceAdd', wpf.setChoicesOrders);
		jQuery(document).on('wpformsFieldChoiceDelete', wpf.setChoicesOrders);
		jQuery(document).on('wpformsFieldChoiceMove', wpf.setChoicesOrders);
		jQuery(document).on('wpformsFieldAdd', wpf.fieldUpdate);
		jQuery(document).on('wpformsFieldDelete', wpf.fieldUpdate);
		jQuery(document).on('wpformsFieldMove', wpf.fieldUpdate);
		jQuery(document).on('focusout', '.wpforms-field-option-row-label input', wpf.fieldUpdate);
		jQuery(document).on('wpformsFieldChoiceAdd', wpf.fieldUpdate);
		jQuery(document).on('wpformsFieldChoiceDelete', wpf.fieldUpdate);
		jQuery(document).on('wpformsFieldChoiceMove', wpf.fieldUpdate);
		jQuery(document).on('focusout', '.wpforms-field-option-row-choices input.label', wpf.fieldUpdate);
	},

	/**
	 * Store the order of the fields.
	 *
	 * @since 1.4.5
	 */
	setFieldOrders: function() {

		wpf.orders.fields = [];

		jQuery( '.wpforms-field-option' ).each(function() {
			wpf.orders.fields.push( jQuery( this ).data( 'field-id' ) );
		});
	},

	/**
	 * Store the order of the choices for each field.
	 *
	 * @since 1.4.5
	 */
	setChoicesOrders: function() {

		wpf.orders.choices = {};

		jQuery( '.choices-list' ).each(function() {
			var fieldID = jQuery( this ).data( 'field-id' );
			wpf.orders.choices[ 'field_'+ fieldID ] = [];
			jQuery( this ).find( 'li' ).each( function() {
				wpf.orders.choices[ 'field_' + fieldID ].push( jQuery( this ).data( 'key' ) );
			});
		});
	},

	/**
	 * Return the order of choices for a specific field.
	 *
	 * @since 1.4.5
	 *
	 * @param int id Field ID.
	 *
	 * @return array
	 */
	getChoicesOrder: function( id ) {

		var choices = [];

		jQuery( '#wpforms-field-option-'+id ).find( '.choices-list li' ).each( function() {
			choices.push( jQuery( this ).data( 'key' ) );
		});

		return choices;
	},

	/**
	 * Trigger fired for all field update related actions.
	 *
	 * @since 1.0.1
	 */
	fieldUpdate: function() {

		var fields = wpf.getFields();

		jQuery(document).trigger('wpformsFieldUpdate', [fields] );

		wpf.debug('fieldUpdate triggered');
	},

	/**
	 * Dynamically get the fields from the current form state.
	 *
	 * @since 1.0.1
	 * @param array allowedFields
	 * @param bool useCache
	 * @return object
	 */
	getFields: function( allowedFields, useCache ) {

		useCache = useCache || false;

		if ( useCache && ! jQuery.isEmptyObject(wpf.cachedFields) ) {

			// Use cache if told and cache is primed.
			var fields = jQuery.extend({}, wpf.cachedFields);

			wpf.debug('getFields triggered (cached)');

		} else {

			// Normal processing, get fields from builder and prime cache.
			var formData       = wpf.formObject( '#wpforms-field-options' ),
				fields         = formData.fields,
				fieldOrder     = [],
				fieldsOrdered  = [],
				fieldBlacklist = ['html','divider','pagebreak'];

			if (!fields) {
				return false;
			}

			for( var key in fields) {
				if ( ! fields[key].type || jQuery.inArray(fields[key].type, fieldBlacklist) > -1 ){
					delete fields[key];
				}
			}

			// Cache the all the fields now that they have been ordered and initially
			// processed.
			wpf.cachedFields = jQuery.extend({}, fields);

			wpf.debug('getFields triggered');
		}

		// If we should only return specfic field types, remove the others.
		if ( allowedFields && allowedFields.constructor === Array ) {
			for( var key in fields) {
				if ( jQuery.inArray( fields[key].type, allowedFields ) === -1 ){
					delete fields[key];
				}
			}
		}

		return fields;
	},

	/**
	 * Get field settings object.
	 *
	 * @since 1.4.5
	 *
	 * @param int id Field ID.
	 *
	 * @return object
	 */
	getField: function( id ) {

		var field = wpf.formObject( '#wpforms-field-option-'+id );

		return field.fields[ Object.keys( field.fields )[0] ];
	},

	/**
	 * Toggle the loading state/indicator of a field option.
	 *
	 * @since 1.2.8
	 */
	fieldOptionLoading: function(option, unload) {

		var $option = jQuery(option),
			$label  = $option.find('label'),
			unload  = (typeof unload === 'undefined') ? false : true,
			spinner = '<i class="fa fa-spinner fa-spin wpforms-loading-inline"></i>';

		if (unload) {
			$label.find('.wpforms-loading-inline').remove();
			$label.find('.wpforms-help-tooltip').show();
			$option.find('input,select,textarea').prop('disabled', false);
		} else {
			$label.append(spinner);
			$label.find('.wpforms-help-tooltip').hide();
			$option.find('input,select,textarea').prop('disabled', true);
		}
	},

	/**
	 * Get form state.
	 *
	 * @since 1.3.8
	 * @param object el
	 */
	getFormState: function( el ) {

		// Serialize tested the most performant string we can use for
		// comparisons.
		return jQuery( el ).serialize();
	},

	/**
	 * Remove items from an array.
	 *
	 * @since 1.0.1
	 * @param array array
	 * @param mixed item index/key
	 * @return array
	 */
	removeArrayItem: function(array, item) {
		var removeCounter = 0;
		for (var index = 0; index < array.length; index++) {
			if (array[index] === item) {
				array.splice(index, 1);
				removeCounter++;
			index--;
			}
		}
		return removeCounter;
	},

	/**
	 * Sanitize string.
	 *
	 * @since 1.0.1
	 * @deprecated 1.2.8
	 *
	 * @param string str String to sanitize.
	 *
	 * @return string
	 */
	sanitizeString: function( str ) {

		if (typeof str === 'string' || str instanceof String) {
			return str.trim();
		}
		return str;
	},

	/**
	 * Update query string in URL.
	 *
	 * @since 1.0.0
	 */
	updateQueryString: function(key, value, url) {

		if (!url) url = window.location.href;
		var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
			hash;

		if (re.test(url)) {
			if (typeof value !== 'undefined' && value !== null)
				return url.replace(re, '$1' + key + "=" + value + '$2$3');
			else {
				hash = url.split('#');
				url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
				if (typeof hash[1] !== 'undefined' && hash[1] !== null)
					url += '#' + hash[1];
				return url;
			}
		} else {
			if (typeof value !== 'undefined' && value !== null) {
				var separator = url.indexOf('?') !== -1 ? '&' : '?';
				hash = url.split('#');
				url = hash[0] + separator + key + '=' + value;
				if (typeof hash[1] !== 'undefined' && hash[1] !== null)
					url += '#' + hash[1];
				return url;
			}
			else
				return url;
		}
	},

	/**
	 * Get query string in a URL.
	 *
	 * @since 1.0.0
	 */
	getQueryString: function(name) {

		var match = new RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
		return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
	},

	/**
	 * Is number?
	 *
	 * @since 1.2.3
	 */
	isNumber: function(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	},

	/**
	 * Sanitize amount and convert to standard format for calculations.
	 *
	 * @since 1.2.6
	 */
	amountSanitize: function(amount) {

		amount = amount.replace(/[^0-9.,]/g,'');

		if ( wpforms_builder.currency_decimal == ',' && ( amount.indexOf(wpforms_builder.currency_decimal) !== -1 ) ) {
			if ( wpforms_builder.currency_thousands == '.' && amount.indexOf(wpforms_builder.currency_thousands) !== -1 ) {;
				amount = amount.replace(wpforms_builder.currency_thousands,'');
			} else if( wpforms_builder.currency_thousands == '' && amount.indexOf('.') !== -1 ) {
				amount = amount.replace('.','');
			}
			amount = amount.replace(wpforms_builder.currency_decimal,'.');
		} else if ( wpforms_builder.currency_thousands == ',' && ( amount.indexOf(wpforms_builder.currency_thousands) !== -1 ) ) {
			amount = amount.replace(wpforms_builder.currency_thousands,'');
		}

		return wpf.numberFormat( amount, 2, '.', '' );
	},

	/**
	 * Format amount.
	 *
	 * @since 1.2.6
	 */
	amountFormat: function(amount) {

		amount = String(amount);

		// Format the amount
		if ( wpforms_builder.currency_decimal == ',' && ( amount.indexOf(wpforms_builder.currency_decimal) !== -1 ) ) {
			var sepFound = amount.indexOf(wpforms_builder.currency_decimal);
				whole    = amount.substr(0, sepFound);
				part     = amount.substr(sepFound+1, amount.strlen-1);
				amount   = whole + '.' + part;
		}

		// Strip , from the amount (if set as the thousands separator)
		if ( wpforms_builder.currency_thousands == ',' && ( amount.indexOf(wpforms_builder.currency_thousands) !== -1 ) ) {
			amount = amount.replace(',','');
		}

		if ( wpf.empty( amount ) ) {
			amount = 0;
		}

		return wpf.numberFormat( amount, 2, wpforms_builder.currency_decimal, wpforms_builder.currency_thousands );
	},

	/**
	 * Format number.
	 *
	 * @link http://locutus.io/php/number_format/
	 * @since 1.2.6
	 */
	numberFormat: function (number, decimals, decimalSep, thousandsSep) {

		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number;
		var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
		var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
		var dec = (typeof decimalSep === 'undefined') ? '.' : decimalSep;
		var s = '';

		var toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k).toFixed(prec)
		};

		// @todo: for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}

		return s.join(dec)
	},

	/**
	 * Empty check similar to PHP.
	 *
	 * @link http://locutus.io/php/empty/
	 * @since 1.2.6
	 */
	empty: function(mixedVar) {

		var undef;
		var key;
		var i;
		var len;
		var emptyValues = [undef, null, false, 0, '', '0'];

		for ( i = 0, len = emptyValues.length; i < len; i++ ) {
			if (mixedVar === emptyValues[i]) {
				return true;
			}
		}

		if ( typeof mixedVar === 'object' ) {
			for ( key in mixedVar ) {
				if ( mixedVar.hasOwnProperty( key ) ) {
					return false;
				}
			}
			return true;
		}

		return false;
	},

	/**
	 * Debug output helper.
	 *
	 * @since 1.3.8
	 * @param msg
	 */
	debug: function( msg ) {

		if ( wpf.isDebug() ) {
			if ( typeof msg === 'object' || msg.constructor === Array ) {
				console.log( 'WPForms Debug:' );
				console.log( msg )
			} else {
				console.log( 'WPForms Debug: '+msg );
			}
		}
	},

	/**
	 * Is debug mode.
	 *
	 * @since 1.3.8
	 */
	isDebug: function() {
		return ( ( window.location.hash && '#wpformsdebug' === window.location.hash ) || wpforms_builder.debug );
	},

	/**
	 * Focus the input/textarea and put the caret at the end of the text.
	 *
	 * @since 1.4.1
	 */
	focusCaretToEnd: function( el ) {
		el.focus();
		var $thisVal = el.val();
		el.val('').val($thisVal);
	},

	/**
	 * Creates a object from form elements.
	 *
	 * @since 1.4.5
	 */
	formObject: function( el ) {

		var form         = jQuery( el ),
			fields       = form.find( '[name]' ),
			json         = {},
			arraynames   = {};

		for ( var v = 0; v < fields.length; v++ ){

			var field     = jQuery( fields[v] ),
				name      = field.prop( 'name' ).replace( /\]/gi,'' ).split( '[' ),
				value     = field.val(),
				lineconf  = {};

			if ( ( field.is( ':radio' ) || field.is( ':checkbox' ) ) && ! field.is( ':checked' ) ) {
				continue;
			}
			for ( var i = name.length-1; i >= 0; i-- ) {
				var nestname = name[i];
				if ( typeof nestname === 'undefined' ) {
					nestname = '';
				}
				if ( nestname.length === 0 ){
					lineconf = [];
					if ( typeof arraynames[name[i-1]] === 'undefined' )  {
						arraynames[name[i-1]] = 0;
					} else {
						arraynames[name[i-1]] += 1;
					}
					nestname = arraynames[name[i-1]];
				}
				if ( i === name.length-1 ){
					if ( value ) {
						if ( value === 'true' ) {
							value = true;
						} else if ( value === 'false' ) {
							value = false;
						}else if ( ! isNaN( parseFloat( value ) ) && parseFloat( value ).toString() === value ) {
							value = parseFloat( value );
						} else if ( typeof value === 'string' && ( value.substr( 0,1 ) === '{' || value.substr( 0,1 ) === '[' ) ) {
							try {
								value = JSON.parse( value );
							} catch (e) {}
						} else if ( typeof value === 'object' && value.length && field.is( 'select' ) ){
				 			var new_val = {};
							for ( var i = 0; i < value.length; i++ ){
								new_val[ 'n' + i ] = value[ i ];
							}
				 		 	value = new_val;
						}
			 	 	}
			  		lineconf[nestname] = value;
				} else {
					var newobj = lineconf;
					lineconf = {};
					lineconf[nestname] = newobj;
				}
		  	}
			jQuery.extend( true, json, lineconf );
		}

		return json;
	},

	/**
	 * Initialize WPForms admin area tooltips.
	 *
	 * @since 1.4.8
	 */
	initTooltips: function() {

		jQuery( '.wpforms-help-tooltip' ).tooltipster( {
			contentAsHTML: true,
			position: 'right',
			maxWidth: 300,
			multiple: true,
			interactive: true
		} );
	}
};
wpf.init();
