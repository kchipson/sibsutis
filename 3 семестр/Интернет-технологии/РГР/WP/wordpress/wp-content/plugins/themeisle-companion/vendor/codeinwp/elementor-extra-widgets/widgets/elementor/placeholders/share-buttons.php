<?php

namespace ThemeIsle\ElementorExtraWidgets;

class Share_Buttons_Placeholder extends Premium_Placeholder {

	public function get_title() {
		return 'Share Buttons';
	}

	public function get_pro_element_name() {
		return 'share-buttons';
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'fa fa-share-alt';
	}
}