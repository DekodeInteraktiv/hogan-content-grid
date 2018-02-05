<?php
/**
 * Plugin Name: Hogan Module: Content Grid
 * Plugin URI: https://github.com/dekodeinteraktiv/hogan-content-grid
 * GitHub Plugin URI: https://github.com/dekodeinteraktiv/hogan-content-grid
 * Description: Content Grid Module for Hogan.
 * Version: 1.0.0
 * Author: Dekode
 * Author URI: https://dekode.no
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * Text Domain: hogan-content-grid
 * Domain Path: /languages/
 *
 * @package Hogan
 * @author Dekode
 */

declare( strict_types = 1 );

namespace Dekode\Hogan\Content_Grid;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HOGAN_CONTENT_GRID_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_textdomain' );
add_action( 'hogan/include_modules', __NAMESPACE__ . '\\register_module' );
add_action( 'hogan/module/content_grid/register_providers', __NAMESPACE__ . '\\register_default_content_grid_providers' );

/**
 * Register module text domain
 *
 * @return void
 */
function load_textdomain() {
	\load_plugin_textdomain( 'hogan-content-grid', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Register module in Hogan
 *
 * @return void
 */
function register_module() {

	// Include form and register module class.
	require_once 'includes/class-content-grid.php';
	\hogan_register_module( new \Dekode\Hogan\Content_Grid() );
}

/**
 * Register default content grid providers
 *
 * @param \Dekode\Hogan\Content_Grid $module Content Grid instance.
 */
function register_default_content_grid_providers( \Dekode\Hogan\Content_Grid $module ) {

	require_once 'includes/content-grid-providers/class-text-provider.php';

	if ( class_exists( '\\Dekode\\Hogan\\Text_Provider' ) ) {
		$module->register_content_grid_provider( new \Dekode\Hogan\Text_Provider() );
	}

}
