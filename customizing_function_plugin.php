<?php
/**
 * Plugin Name:       Custom function file Code
 * Description:       A small and useful plugin for adding and modify pieces of code in the "function.php" file (for themes that use ionCube Loader). Compatible with WPML for Direction change commands.
 * Plugin URI:        https://github.com/mohammad26845/customizing_function_file_plugin
 * Version:           1.0.0
 * Author:            Mohammad Alizadeh
 * Author URI:        https://m-shiralizadeh.ir/
 * Requires at least: 3.0.0
 * Tested up to:      5.4
 *
 * @package    Customizing_Function_File
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Theme_Customisations Class
 *
 * @class Customizing_Function_File
 * @version	1.0.0
 * @since 1.0.0
 * @package	Customizing_Function_File
 */
final class Customizing_Function_File {

	/**
	 * Initialize the plugin.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'enqueue' ), -1 );
		require_once( 'custom/functions.php' );
	}


	/**
	 * Setup all the things
	 */
	public function enqueue() {
		add_action( 'wp_enqueue_scripts', array( $this, 'custom_css' ), 999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'custom_js' ) );

		
		// echo apply_filters( 'wpml_is_rtl', true );
		// $temp = ICL_LANGUAGE_CODE;
		

		global $ltr;
		$ltr = False;
		$my_current_lang = apply_filters( 'wpml_current_language', NULL );
		if ($my_current_lang == 'fa'){
			$rtl = True;
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_js_rtl' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_css_rtl' ), 999 );
		}
		else{
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_js_ltr' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_css_ltr' ), 999 );
		}
	}


	/**
	 * Enqueue custom CSS RTL
	 *
	 * @return void
	 */
	public function custom_css_rtl() {
		wp_enqueue_style('custom-css-rtl', plugins_url('/custom/style-rtl.css', __FILE__ ));
	}

	/**
	 * Enqueue custom CSS LTR
	 *
	 * @return void
	 */
	public function custom_css_ltr() {
		wp_enqueue_style('custom-css-ltr', plugins_url('/custom/style-lrt.css', __FILE__ ));
	}


	/**
	 * Enqueue custom CSS (Main)
	 *
	 * @return void
	 */
	public function custom_css() {
		wp_enqueue_style('custom-css', plugins_url('/custom/style.css', __FILE__ ));
	}


	/**
	 * Enqueue custom Javascript RTL
	 *
	 * @return void
	 */
	public function custom_js_rtl() {
		wp_enqueue_script( 'custom-js-rtl', plugins_url( '/custom/custom-rtl.js', __FILE__ ), array( 'jquery' ) );
	}


	/**
	 * Enqueue custom Javascript LTR
	 *
	 * @return void
	 */
	public function custom_js_ltr() {
		wp_enqueue_script( 'custom-js-ltr', plugins_url( '/custom/custom-ltr.js', __FILE__ ), array( 'jquery' ) );
	}


	/**
	 * Enqueue custom Javascript (Main)
	 *
	 * @return void
	 */
	public function custom_js() {
		wp_enqueue_script( 'custom-js', plugins_url( '/custom/custom.js', __FILE__ ), array( 'jquery' ) );
	}

} // End Class




/**
 * The 'main' function
 *
 * @return void
 */
function customizing_function_file_plugin() {
	global $my_custom;
	$my_custom = new Customizing_Function_File();
}

/**
 * Initialize the plugin
 */
add_action( 'plugins_loaded', 'customizing_function_file_plugin' );
