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

	//Option 1
	/*$providers = apply_filters( 'hogan/module/content_grid/providers/enabled', [
		'text',
		'image',
	] );

	foreach ( $providers as $provider ) {
		switch ( $provider ) {
			case 'text':
				require_once 'includes/content-grid-providers/class-text-content-grid-provider.php';
				if ( class_exists( '\\Dekode\\Hogan\\Text_Content_Grid_Provider' ) ) {
					$module->register_content_grid_provider( new \Dekode\Hogan\Text_Content_Grid_Provider() );
				}
				break;
			case 'image':
				require_once 'includes/content-grid-providers/class-image-content-grid-provider.php';
				if ( class_exists( '\\Dekode\\Hogan\\Image_Content_Grid_Provider' ) ) {
					$module->register_content_grid_provider( new \Dekode\Hogan\Image_Content_Grid_Provider() );
				}
				break;
			default;

		}
	}*/

	//Or option 2?
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
