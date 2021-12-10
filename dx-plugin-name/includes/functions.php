<?php

/**
 * The plugin functions file.
 *
 * This is used to define general functions, shortcodes etc.
 * 
 * Important: Always use the `dx_` prefix for function names.
 *
 * @link       http://devrix.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     DevriX <office@devrix.com>
 */

if ( ! function_exists( 'dx_footag_shortcode' ) ) {
	/**
	 * Example of a shortcode tag: [footag foo="bar"]
	 *
	 * @param array $atts
	 * @return void
	 */
	function dx_footag_shortcode( $atts ) {
		return "foo = {$atts['foo']}";
	}
}

add_shortcode( 'footag', 'dx_footag_shortcode' );

if ( ! function_exists( 'dx_bartag_shortcode' ) ) {
	/**
	 * Example with attribute defaults: [bartag foo="bar"]
	 * 
	 * @param array $atts
	 * @return void
	 */
	function dx_bartag_shortcode( $atts )  {
		$atts = shortcode_atts(
			array(
				'foo' => 'no foo',
				'baz' => 'default baz'
			), 
			$atts, 'bartag' 
		);

		return "foo = {$atts['foo']}";
	}
}

add_shortcode( 'bartag', 'dx_bartag_shortcode' );

if (! function_exists( 'dx_baztag_func' ) ) {
	/**
	 * Example with enclosed content: [baztag]content[/baztag]
	 *
	 * @param array $atts
	 * @param string $content
	 * @return void
	 */
	function dx_baztag_func( $atts, $content = "" ) {
		return "content = $content";
	}
}

add_shortcode( 'baztag', 'dx_baztag_func' );
