<?php

/**
 * The plugin functions file.
 *
 * This is used to define general functions, shortcodes etc.
 * 
 * Important: Always use the `my_` prefix for function names.
 *
 * @link       http://yoursite.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Company <contact@yoursite.com>
 */

if ( ! function_exists( 'my_footag_shortcode' ) ) {
	/**
	 * Example of a shortcode tag: [footag foo="bar"]
	 *
	 * @param array $atts
	 * @return void
	 */
	function my_footag_shortcode( $atts ) {
		return "foo = {$atts['foo']}";
	}
}

add_shortcode( 'footag', 'my_footag_shortcode' );

if ( ! function_exists( 'my_bartag_shortcode' ) ) {
	/**
	 * Example with attribute defaults: [bartag foo="bar"]
	 * 
	 * @param array $atts
	 * @return void
	 */
	function my_bartag_shortcode( $atts )  {
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

add_shortcode( 'bartag', 'my_bartag_shortcode' );

if (! function_exists( 'my_baztag_func' ) ) {
	/**
	 * Example with enclosed content: [baztag]content[/baztag]
	 *
	 * @param array $atts
	 * @param string $content
	 * @return void
	 */
	function my_baztag_func( $atts, $content = "" ) {
		return "content = $content";
	}
}

add_shortcode( 'baztag', 'my_baztag_func' );
