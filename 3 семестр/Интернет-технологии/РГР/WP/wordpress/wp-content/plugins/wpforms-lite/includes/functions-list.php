<?php
/**
 * Helper functions to work with multidimensional arrays easier.
 *
 * @since      1.5.6
 * @author     WPForms
 * @package    WPForms
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */

/**
 * Determine whether the given value is array accessible.
 *
 * @since 1.5.6
 *
 * @param mixed $value Checkin to accessible.
 *
 * @return bool
 */
function wpforms_list_accessible( $value ) {

	return is_array( $value ) || $value instanceof ArrayAccess;
}

/**
 * Set an array item to a given value using "dot" notation.
 *
 * If no key is given to the method, the entire array will be replaced.
 *
 * @since 1.5.6
 *
 * @param array  $array     Existing array.
 * @param string $key       Path to set.
 * @param mixed  $value     Value to set.
 * @param string $separator Separator.
 *
 * @return array New array.
 */
function wpforms_list_set( $array, $key, $value, $separator = '.' ) {

	if ( ! wpforms_list_accessible( $array ) ) {
		return $value;
	}

	if ( is_null( $key ) ) {
		$array = $value;

		return $array;
	}

	$keys       = explode( $separator, $key );
	$count_keys = count( $keys );
	$values     = array_values( $keys );
	$last_key   = $values[ $count_keys - 1 ];
	$tmp_array  = &$array;

	for ( $i = 0; $i < $count_keys - 1; $i ++ ) {
		$k         = $keys[ $i ];
		$tmp_array = &$tmp_array[ $k ];
	}
	$tmp_array[ $last_key ] = $value;

	return $array;
}

/**
 * Determine if the given key exists in the provided array.
 *
 * @since 1.5.6
 *
 * @param \ArrayAccess|array $array Existing array.
 * @param string|int         $key   To check.
 *
 * @return bool
 */
function wpforms_list_exists( $array, $key ) {

	if ( ! wpforms_list_accessible( $array ) ) {
		return false;
	}
	if ( $array instanceof ArrayAccess ) {
		return $array->offsetExists( $key );
	}

	return array_key_exists( $key, $array );
}

/**
 * Get an item from an array using "dot" notation.
 *
 * @since 1.5.6
 *
 * @param \ArrayAccess|array $array   Where we want to get.
 * @param string             $key     Key with dot's.
 * @param mixed              $default Value.
 *
 * @return mixed
 */
function wpforms_list_get( $array, $key, $default = null ) {

	if ( ! wpforms_list_accessible( $array ) ) {
		return $default;
	}
	if ( is_null( $key ) ) {
		return $array;
	}
	if ( ! is_string( $key ) ) {
		return $default;
	}
	if ( wpforms_list_exists( $array, $key ) ) {
		return $array[ $key ];
	}
	foreach ( explode( '.', $key ) as $segment ) {
		if ( wpforms_list_accessible( $array ) && wpforms_list_exists( $array, $segment ) ) {
			$array = $array[ $segment ];
		} else {
			return $default;
		}
	}

	return $array;
}

/**
 * Check if an item exists in an array using "dot" notation.
 *
 * @since 1.5.6
 *
 * @param \ArrayAccess|array $array To check.
 * @param string             $key   Keys with dot's.
 *
 * @return bool
 */
function wpforms_list_has( $array, $key ) {

	if ( ! $array ) {
		return false;
	}
	if ( is_null( $key ) || ! is_string( $key ) ) {
		return false;
	}
	if ( wpforms_list_exists( $array, $key ) ) {
		return true;
	}
	foreach ( explode( '.', $key ) as $segment ) {
		if ( wpforms_list_accessible( $array ) && wpforms_list_exists( $array, $segment ) ) {
			$array = $array[ $segment ];
		} else {
			return false;
		}
	}

	return true;
}

/**
 * Determines if an array is associative.
 *
 * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
 *
 * @since 1.5.6
 *
 * @param array $array To check.
 *
 * @return bool
 */
function wpforms_list_is_assoc( $array ) {

	$keys = array_keys( $array );

	return array_keys( $keys ) !== $keys;
}

/**
 * Get a subset of the items from the given array.
 *
 * @since 1.5.6
 *
 * @param array        $array To get.
 * @param array|string $keys  To filter.
 *
 * @return array
 */
function wpforms_list_only( $array, $keys ) {

	return array_intersect_key( $array, array_flip( (array) $keys ) );
}

/**
 * Remove one or many array items from a given array using "dot" notation.
 *
 * @since 1.5.6
 *
 * @param array        $array To forget.
 * @param array|string $keys  To exclude.
 *
 * @return array
 */
function wpforms_list_forget( $array, $keys ) {

	$tmp_array = &$array;
	$keys      = (array) $keys;

	if ( count( $keys ) === 0 ) {
		return $array;
	}

	foreach ( $keys as $key ) {
		// if the exact key exists in the top-level, remove it.
		if ( wpforms_list_exists( $array, $key ) ) {
			unset( $array[ $key ] );
			continue;
		}

		$parts      = explode( '.', $key );
		$count_keys = count( $parts );
		$values     = array_values( $parts );
		$last_key   = $values[ $count_keys - 1 ];

		for ( $i = 0; $i < $count_keys - 1; $i ++ ) {
			$k         = $parts[ $i ];
			$tmp_array = &$tmp_array[ $k ];
		}
		unset( $tmp_array[ $last_key ] );
	}

	return $array;
}
