<?php
/**
 * Plugin Name: Hogan Module: Content Grid
 * Plugin URI: https://github.com/dekodeinteraktiv/hogan-content-grid
 * GitHub Plugin URI: https://github.com/dekodeinteraktiv/hogan-content-grid
 * Description: Content Grid Module for Hogan
 * Version: 1.0.3
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
add_action( 'hogan/include_modules', __NAMESPACE__ . '\\register_module', 10, 1 );
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
 * @param \Dekode\Hogan\Core $core Hogan Core instance.
 * @return void
 */
function register_module( \Dekode\Hogan\Core $core ) {
	require_once 'includes/class-content-grid.php';
	$core->register_module( new \Dekode\Hogan\Content_Grid() );
}

/**
 * Register default content grid providers
 *
 * @param \Dekode\Hogan\Content_Grid $module Content Grid instance.
 */
function register_default_content_grid_providers( \Dekode\Hogan\Content_Grid $module ) {

	foreach (
		$providers = apply_filters( 'hogan/module/content_grid/providers/enabled', [
			'standard' => [
				'file_path' => 'includes/content-grid-providers/class-standard-content-grid-provider.php',
				'class'     => '\\Dekode\\Hogan\\Standard_Content_Grid_Provider',
				'enabled'   => true,
			],
			'text'     => [
				'file_path' => 'includes/content-grid-providers/class-text-content-grid-provider.php',
				'class'     => '\\Dekode\\Hogan\\Text_Content_Grid_Provider',
				'enabled'   => false,
			],
			'image'    => [
				'file_path' => 'includes/content-grid-providers/class-image-content-grid-provider.php',
				'class'     => '\\Dekode\\Hogan\\Image_Content_Grid_Provider',
				'enabled'   => false,
			],
		] ) as $provider
	) {

		if ( isset( $provider['enabled'] ) && ! empty( $provider['enabled'] ) ) {
			require_once $provider['file_path'];
			if ( class_exists( $provider['class'] ) ) {
				$module->register_content_grid_provider( new $provider['class']() );
			}
		}
	}
}
