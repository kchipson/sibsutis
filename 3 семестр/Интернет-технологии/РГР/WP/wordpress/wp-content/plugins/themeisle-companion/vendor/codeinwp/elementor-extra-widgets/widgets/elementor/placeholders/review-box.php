<?php

namespace ThemeIsle\ElementorExtraWidgets;

class Review_Box_Placeholder extends Premium_Placeholder {

	public function get_title() {
		return 'Review Box';
	}

	public function get_pro_element_name() {
		return 'review-box';
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'fa fa-star';
	}
}