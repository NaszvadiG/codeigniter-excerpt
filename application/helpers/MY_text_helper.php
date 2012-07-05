<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Safely extracts not more than the first $count characters from html string.
 *
 * UTF-8, tags and entities safe prefix extraction. Entities inside will *NOT*
 * be counted as one character. For example &amp; will be counted as 4, &lt; as
 * 3, etc.
 *
 * @access	public
 * @param string $str String to get the excerpt from.
 * @param integer $count Maximum number of characters to take.
 * @param string The end character. Usually an ellipsis.
 * @return string The excerpt.
 */
function html_excerpt( $str, $count=500, $end_char = '&#8230;' ) {
	$str = strip_all_tags( $str, true );
	$str = mb_substr( $str, 0, $count );
	// remove part of an entity at the end
	$str = preg_replace( '/&[^;\s]{0,6}$/', '', $str );
	return $str.$end_char;
}

/**
 * Properly strip all HTML tags including script and style
 *
 *
 * @param string $string String containing HTML tags
 * @param bool $remove_breaks optional Whether to remove left over line breaks and white space chars
 * @return string The processed string.
 */
function strip_all_tags($string, $remove_breaks = false) {
	$string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
	$string = strip_tags($string);

	if ( $remove_breaks ) {
		$string = preg_replace('/[\r\n\t ]+/', ' ', $string);
	}

	return trim( $string );
}

// ------------------------------------------------------------------------