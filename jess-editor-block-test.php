<?php
/**
 * Plugin Name: Jess - WordPress Block Editor Test
 * Plugin URI: https://swampthings.org
 * Description: Jess WordPress block editor testing: editable text, enqueued custom css.
 * Author: Jess Planck
 * Author URI: https://swampthings.org
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: jess-block-test
 * Domain Path: /languages
 */

 /*
 * Notes
 * Notes from https://github.com/modularwp/gutenberg-block-editable-example
 * Block Icons https://developer.wordpress.org/resource/dashicons/#block-default
 *
 * Javascript internationalization in WordPress https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/

 * Note JS diffences for ES5 and ESNext on Wordpress.org documentation
 * https://developer.wordpress.org/block-editor/reference-guides/richtext/
 */

// Security - Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue CSS for the block hover effect.
 *
 * @since 1.0.0
 */
function jess_editor_block_test_css_enqueue() {
	wp_register_style( 'jess-editor-block-test-css', plugins_url( 'jess-editor-block-test.css', __FILE__ ),'','', 'screen' );
	wp_enqueue_style( 'jess-editor-block-test-css' );
}
add_action( 'wp_enqueue_scripts', 'jess_editor_block_test_css_enqueue' );

/**
 * Enqueue the block's javascript or other assets for the editor. See note links for details. Note dependcies.
 *
 * @since 1.0.0
 */
function jess_editor_block_test_js_enqueue() {

	// Javascript for editor block. See jess-editor-block-test.js
	wp_enqueue_script(
		'mdlr-editable-block-example-backend-script', // Unique handle.
		plugins_url( 'jess-editor-block-test.js', __FILE__ ), // WP Editor javascript
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Note dependencies, see note links.
		filemtime( plugin_dir_path( __FILE__ ) . 'jess-editor-block-test.js' ) // filemtime — Gets file modification time.
	);

	// Enqueue hover effect CSS so it can be seen while editing. NOTE: future testing for span vs. div testing.
	wp_register_style( 'jess-editor-block-test-css', plugins_url( 'jess-editor-block-test.css', __FILE__ ),'','', 'screen' );
	wp_enqueue_style( 'jess-editor-block-test-css' );
}
add_action( 'enqueue_block_editor_assets', 'jess_editor_block_test_js_enqueue' );
