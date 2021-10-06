/* globals wp */
/**
 * WPForms Challenge function.
 *
 * @since 1.5.0
 */
'use strict';

if ( typeof WPFormsChallenge === 'undefined' ) {
	var WPFormsChallenge = {};
}

WPFormsChallenge.core = window.WPFormsChallenge.core || ( function( document, window, $ ) {

	/**
	 * Timer functions and properties.
	 *
	 * @since 1.5.0
	 *
	 * @type {Object}
	 */
	var timer = {

		/**
		 * Number of minutes to complete the challenge.
		 *
		 * @since 1.5.0
		 *
		 * @type {number}
		 */
		initialSecondsLeft: WPFormsChallenge.admin.l10n.minutes_left * 60,


		/**
		 * Load timer ID.
		 *
		 * @since 1.5.0
		 *
		 * @returns {string} ID from setInterval().
		 */
		loadId: function() {

			return localStorage.getItem( 'wpformsChallengeTimerId' );
		},

		/**
		 * Save timer ID.
		 *
		 * @since 1.5.0
		 *
		 * @param {number|string} id setInterval() ID to save.
		 */
		saveId: function( id ) {

			localStorage.setItem( 'wpformsChallengeTimerId', id );
		},

		/**
		 * Run the timer.
		 *
		 * @since 1.5.0
		 *
		 * @param {number} secondsLeft Number of seconds left to complete the Challenge.
		 *
		 * @returns {string} ID from setInterval().
		 */
		run: function( secondsLeft ) {

			if ( 5 === app.loadStep() ) {
				return;
			}

			var timerId = setInterval( function() {

				app.updateTimerUI( secondsLeft );
				secondsLeft --;
				if ( 0 > secondsLeft ) {
					timer.saveSecondsLeft( 0 );
					clearInterval( timerId );
				}
			}, 1000 );

			timer.saveId( timerId );

			return timerId;
		},

		/**
		 * Pause the timer.
		 *
		 * @since 1.5.0
		 */
		pause: function() {

			var timerId;
			var elSeconds;
			var secondsLeft = timer.getSecondsLeft();

			if ( 0 === secondsLeft || 5 === app.loadStep() ) {
				return;
			}

			timerId = timer.loadId();
			clearInterval( timerId );

			elSeconds = $( '#wpforms-challenge-timer' ).data( 'seconds-left' );

			if ( elSeconds ) {
				timer.saveSecondsLeft( elSeconds );
			}
		},

		/**
		 * Resume the timer.
		 *
		 * @since 1.5.0
		 */
		resume: function() {

			var timerId;
			var secondsLeft = timer.getSecondsLeft();

			if ( 0 === secondsLeft || 5 === app.loadStep() ) {
				return;
			}

			timerId = timer.loadId();

			if ( timerId ) {
				clearInterval( timerId );
			}

			timer.run( secondsLeft );
		},

		/**
		 * Clear all frontend saved timer data.
		 *
		 * @since 1.5.0
		 */
		clear: function() {

			localStorage.removeItem( 'wpformsChallengeSecondsLeft' );
			localStorage.removeItem( 'wpformsChallengeTimerId' );
			localStorage.removeItem( 'wpformsChallengeTimerStatus' );
			$( '#wpforms-challenge-timer' ).removeData( 'seconds-left' );
		},

		/**
		 * Get number of seconds left to complete the Challenge.
		 *
		 * @since 1.5.0
		 *
		 * @returns {number} Number of seconds left to complete the Challenge.
		 */
		getSecondsLeft: function() {

			var secondsLeft = localStorage.getItem( 'wpformsChallengeSecondsLeft' );
			secondsLeft = parseInt( secondsLeft, 10 ) || 0;

			return secondsLeft;
		},

		/**
		 * Get number of seconds spent completing the Challenge.
		 *
		 * @since 1.5.0
		 *
		 * @param {number} secondsLeft Number of seconds left to complete the Challenge.
		 *
		 * @returns {number} Number of seconds spent completing the Challenge.
		 */
		getSecondsSpent: function( secondsLeft ) {

			secondsLeft = secondsLeft || timer.getSecondsLeft();

			return timer.initialSecondsLeft - secondsLeft;
		},

		/**
		 * Save number of seconds left to complete the Challenge.
		 *
		 * @since 1.5.0
		 *
		 * @param {number|string} secondsLeft Number of seconds left to complete the Challenge.
		 */
		saveSecondsLeft: function( secondsLeft ) {

			localStorage.setItem( 'wpformsChallengeSecondsLeft', secondsLeft );
		},

		/**
		 * Get 'minutes' part of timer display.
		 *
		 * @since 1.5.0
		 *
		 * @param {number} secondsLeft Number of seconds left to complete the Challenge.
		 *
		 * @returns {number} 'Minutes' part of timer display.
		 */
		getMinutesFormatted: function( secondsLeft ) {

			secondsLeft = secondsLeft || timer.getSecondsLeft();

			return Math.floor( secondsLeft / 60 );
		},

		/**
		 * Get 'seconds' part of timer display.
		 *
		 * @since 1.5.0
		 *
		 * @param {number} secondsLeft Number of seconds left to complete the Challenge.
		 *
		 * @returns {number} 'Seconds' part of timer display.
		 */
		getSecondsFormatted: function( secondsLeft ) {

			secondsLeft = secondsLeft || timer.getSecondsLeft();

			return secondsLeft % 60;
		},

		/**
		 * Get formatted timer for display.
		 *
		 * @since 1.5.0
		 *
		 * @param {number} secondsLeft Number of seconds left to complete the Challenge.
		 *
		 * @returns {string} Formatted timer for display.
		 */
		getFormatted: function( secondsLeft ) {

			secondsLeft = secondsLeft || timer.getSecondsLeft();

			var timerMinutes = timer.getMinutesFormatted( secondsLeft );
			var timerSeconds = timer.getSecondsFormatted( secondsLeft );

			return timerMinutes + ( 9 < timerSeconds ? ':' : ':0' ) + timerSeconds;
		},
	};

	/**
	 * Public functions and properties.
	 *
	 * @since 1.5.0
	 *
	 * @type {Object}
	 */
	var app = {

		/**
		 * Public timer functions and properties.
		 *
		 * @since 1.5.0
		 */
		timer: timer,

		/**
		 * Start the engine.
		 *
		 * @since 1.5.0
		 */
		init: function() {

			$( document ).ready( app.ready );
			$( window ).load( app.load );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.5.0
		 */
		ready: function() {

			app.setup();
			app.events();
		},

		/**
		 * Window load.
		 *
		 * @since 1.5.0
		 */
		load: function() {

			app.timer.run( app.timer.getSecondsLeft() );
		},

		/**
		 * Initial setup.
		 *
		 * @since 1.5.0
		 */
		setup: function() {

			var secondsLeft;
			var timerId = app.timer.loadId();

			if ( timerId ) {
				clearInterval( timerId );
				secondsLeft = app.timer.getSecondsLeft();
			}

			if ( ! timerId && 0 === app.loadStep() ) {
				secondsLeft = app.timer.initialSecondsLeft;
			}

			app.refreshStep();
			app.updateListUI();
			app.updateTimerUI( secondsLeft );
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.5.0
		 */
		events: function() {

			$( [ window, document ] ).blur( function() {
				app.timer.pause();
			} );

			$( [ window, document ] ).focus( function() {
				app.timer.resume();
			} );

			$( '.wpforms-challenge-cancel' ).click( function() {
				app.timer.pause();
				app.cancelChallenge();
			} );
		},

		/**
		 * Get last saved step.
		 *
		 * @since 1.5.0
		 *
		 * @returns {number} Last saved step.
		 */
		loadStep: function() {

			var step = localStorage.getItem( 'wpformsChallengeStep' );
			step = parseInt( step, 10 ) || 0;

			return step;
		},

		/**
		 * Save Challenge step.
		 *
		 * @param {number|string} step Step to save.
		 *
		 * @returns {Object} jqXHR object from saveChallengeOption().
		 */
		saveStep: function( step ) {

			localStorage.setItem( 'wpformsChallengeStep', step );

			return WPFormsChallenge.admin.saveChallengeOption( { step: step } );
		},

		/**
		 * Update a step with backend data..
		 *
		 * @since 1.5.0
		 */
		refreshStep: function() {

			var savedStep = $( '.wpforms-challenge' ).data( 'wpforms-challenge-saved-step' );
			savedStep = parseInt( savedStep, 10 ) || 0;

			// Step saved on a backend has a priority.
			if ( app.loadStep() !== savedStep ) {
				app.saveStep( savedStep );
			}
		},

		/**
		 * Complete Challenge step.
		 *
		 * @since 1.5.0
		 *
		 * @param {number|string} step Step to complete.
		 *
		 * @returns {Object} jqXHR object from saveStep().
		 */
		stepCompleted: function( step ) {

			app.updateListUI( step );
			app.updateTooltipUI( step );

			return app.saveStep( step );
		},

		/**
		 * Initialize Challenge tooltips.
		 *
		 * @since 1.5.0
		 *
		 * @param {number|string} step Last saved step.
		 * @param {string} anchor Element selector to bind tooltip to.
		 * @param {Object} args Tooltipster arguments.
		 */
		initTooltips: function( step, anchor, args ) {

			var $dot = $( '<span class="wpforms-challenge-dot wpforms-challenge-dot-step' + step + '" data-wpforms-challenge-step="' + step + '">&nbsp;</span>' );
			var tooltipsterArgs = {
				content          : $( '#tooltip-content' + step ),
				trigger          : null,
				interactive      : true,
				animationDuration: 0,
				delay            : 0,
				theme            : [ 'tooltipster-default', 'wpforms-challenge-tooltip' ],
				functionReady    : function( instance, helper ) {
					$( helper.tooltip ).addClass( 'wpforms-challenge-tooltip-step' + step );

					// Reposition is needed to render max-width CSS correctly.
					instance.reposition();
				},
			};

			if ( typeof args === 'object' && args !== null ) {
				$.extend( tooltipsterArgs, args );
			}

			$dot.insertAfter( anchor ).tooltipster( tooltipsterArgs );
		},

		/**
		 * Update tooltips appearance.
		 *
		 * @since 1.5.0
		 *
		 * @param {number|string} step Last saved step.
		 */
		updateTooltipUI: function( step ) {

			var nextStep;

			step = step || app.loadStep();
			nextStep = step + 1;

			$( '.wpforms-challenge-dot' ).each( function( i, el ) {

				var $el = $( el );
				var elStep = $el.data( 'wpforms-challenge-step' );

				if ( elStep < nextStep ) {
					$el.addClass( 'wpforms-challenge-dot-completed' );
				}

				if ( elStep > nextStep ) {
					$el.addClass( 'wpforms-challenge-dot-next' );
				}

				if ( elStep === nextStep ) {
					$el.removeClass( 'wpforms-challenge-dot-completed wpforms-challenge-dot-next' );
				}

				// Zero timeout is needed to properly detect $el visibility.
				setTimeout( function() {
					if ( $el.is( ':visible' ) && elStep === nextStep ) {
						$el.tooltipster( 'open' );
					} else {
						$el.tooltipster( 'close' );
					}
				}, 0 );
			} );
		},

		/**
		 * Update Challenge task list appearance.
		 *
		 * @since 1.5.0
		 *
		 * @param {number|string} step Last saved step.
		 */
		updateListUI: function( step ) {

			step = step || app.loadStep();

			$( '.wpforms-challenge-list li:lt(' + step + ')' ).addClass( 'wpforms-challenge-item-completed' );
			$( '.wpforms-challenge-list li:eq(' + step + ')' ).addClass( 'wpforms-challenge-item-current' );
			$( '.wpforms-challenge-bar div' ).css( 'width', ( step * 20 ) + '%' );
		},

		/**
		 * Update Challenge timer appearance.
		 *
		 * @since 1.5.0
		 *
		 * @param {number} secondsLeft Number of seconds left to complete the Challenge.
		 */
		updateTimerUI: function( secondsLeft ) {

			if ( ! secondsLeft || isNaN( secondsLeft ) || '0' === secondsLeft ) {
				secondsLeft = 0;
			}

			app.timer.saveSecondsLeft( secondsLeft );
			$( '#wpforms-challenge-timer' ).text( app.timer.getFormatted( secondsLeft ) ).data( 'seconds-left', secondsLeft );
		},

		/**
		 * Remove Challenge interface.
		 *
		 * @since 1.5.0
		 */
		removeChallengeUI: function() {
			$( '.wpforms-challenge-dot' ).remove();
			$( '.wpforms-challenge' ).remove();
		},

		/**
		 * Clear all Challenge frontend saved data.
		 *
		 * @since 1.5.0
		 */
		clearLocalStorage: function() {

			localStorage.removeItem( 'wpformsChallengeStep' );
			app.timer.clear();
		},

		/**
		 * Cancel Challenge after stating it.
		 *
		 * @since 1.5.0
		 */
		cancelChallenge: function() {

			var optionData = {
				status       : 'canceled',
				seconds_spent: app.timer.getSecondsSpent(),
				seconds_left : app.timer.getSecondsLeft(),
				feedback_sent: false,
			};

			app.removeChallengeUI();
			app.clearLocalStorage();

			if ( typeof WPFormsBuilder !== 'undefined' ) {
				WPFormsChallenge.admin.saveChallengeOption( optionData )
					.done( WPFormsBuilder.formSave ) // Save the form before reloading if we're in a WPForms Builder.
					.done( location.reload.bind( location ) ); // Reload the page to remove WPForms Challenge JS.
			} else {
				WPFormsChallenge.admin.saveChallengeOption( optionData )
					.done( app.triggerPageSave ); // Assume we're on form embed page.
			}
		},

		/**
		 * Check if we're in Gutenberg editor.
		 *
		 * @since 1.5.0
		 *
		 * @returns {boolean} Is Gutenberg or not.
		 */
		isGutenberg: function() {
			return typeof wp !== 'undefined' && wp.hasOwnProperty( 'blocks' );
		},

		/**
		 * Trigger form embed page save potentially reloading it.
		 *
		 * @since 1.5.0
		 */
		triggerPageSave: function() {

			if ( app.isGutenberg() ) {
				app.gutenbergPageSave();

				// TODO: Find a way to reload Gutenberg editor after save.
			} else {
				$( '#post #publish' ).trigger( 'click' );
			}
		},

		/**
		 * Save page for Gutenberg
		 *
		 * @since 1.5.2
		 */
		gutenbergPageSave: function() {
			// use MutationObserver to wait while guttenberg create panel with Publish button
			var obs = {
				targetNode  : $('.block-editor .edit-post-layout')[0],
				config      : {
					childList: true
				},
			};

			obs.callback = function ( mutationsList, observer ) {
				var mutation;
				for (var i in mutationsList) {
					mutation = mutationsList[i];
					if ( mutation.type === 'childList' ) {
						var $btn = $( '.block-editor .editor-post-publish-button');
						if ($btn.length > 0) {
							$btn.trigger( 'click' );
							observer.disconnect();
						}
					}
				}
			}

			obs.observer = new MutationObserver( obs.callback );
			obs.observer.observe( obs.targetNode, obs.config );

			$( '.block-editor .edit-post-toggle-publish-panel__button').trigger( 'click' );
		}




	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );

WPFormsChallenge.core.init();
