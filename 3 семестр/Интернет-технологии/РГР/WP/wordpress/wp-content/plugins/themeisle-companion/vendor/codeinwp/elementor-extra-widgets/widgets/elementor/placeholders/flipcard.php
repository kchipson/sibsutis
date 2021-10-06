<?php

namespace ThemeIsle\ElementorExtraWidgets;

class Flipcard_Placeholder extends Premium_Placeholder {

	public function get_title() {
		return 'Flipcard';
	}

	public function get_name() {
		return 'eaw_flipcard';
	}

	public function get_pro_element_name() {
		return 'flipcard';
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'fa fa-share-square';
	}
}