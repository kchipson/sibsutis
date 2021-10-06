/**
 * Social Sharing Module Admin Script
 *
 * @since    1.0.0
 * @package obfx_modules/theme-update-check/js
 *
 * @author    ThemeIsle
 */
/* globals safe_updates */
var obfx_theme_check = function ($) {
	'use strict';

	$(
		function () {
			if (typeof  safe_updates === 'undefined') {
				return;
			}
			if (typeof  safe_updates.check_msg !== 'undefined') {
				checkUpdateThemeUpdateCore();
				setInterval(checkUpdateTheme, 500);
			}

			function checkUpdateTheme() {
				var safe_update_data = $('#obfx-safe-updates-data');
				if (safe_update_data.length > 0) {
					return;
				}
				$('div.theme.active .theme-id-container').prepend('<p id="obfx-safe-updates-data" style="position: absolute;bottom: 37px;background: #ccc;background: #fff8e5;padding: 5px;padding-left: 15px;">' + safe_updates.check_msg + '</p>');
				safe_update_data.on('click', 'a', function (e) {
					e.stopPropagation();
				});
			}

			function checkUpdateThemeUpdateCore() {

				$('#update-themes-table input[value=' + safe_updates.slug + ']').parent().next().find('p').append('<p>' + safe_updates.check_msg + '</p>');

			}

		}
	);

};

obfx_theme_check(jQuery);
