<?php
/**
 * Content Grid module class.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( '\\Dekode\\Hogan\\Content_Grid' ) && class_exists( '\\Dekode\\Hogan\\Module' ) ) {

	/**
	 * Content Grid module class.
	 *
	 * @extends Modules base class.
	 */
	class Content_Grid extends Module {

		/**
		 * Content Grid Provider collection
		 *
		 * @var array $collection
		 */
		public $collection;

		/**
		 * Content Grid Providers (Objects that implements interface Content_Grid_Provider)
		 *
		 * @var array $_providers
		 */
		private $_providers;

		/**
		 * Module constructor.
		 */
		public function __construct() {

			$this->label    = __( 'Content Grid', 'hogan-content-grid' );
			$this->template = HOGAN_CONTENT_GRID_PATH . 'assets/template.php';

			parent::__construct();
		}

		/**
		 * Field definitions for module.
		 *
		 * @return array $fields Fields for this module
		 */
		public function get_fields(): array {

			$fields = [];

			// Heading field can be disabled using filter hogan/module/form/heading/enabled (true/false).
			hogan_append_heading_field( $fields, $this );

			// TODO: Lead text
			array_push(
				$fields, [
					'key'          => $this->field_key . '_flex', // hogan_module_content_grid_flex
					'label'        => '',
					'name'         => 'flex_grid',
					'type'         => 'flexible_content',
					'button_label' => esc_html__( 'Add content', 'hogan-content-grid' ),
					'wrapper'      => [
						'class' => 'grid-layouts',
					],
					'layouts'      => $this->_get_select_field_choices(),
				]
			);

			return $fields;
		}

		/**
		 * Validate module content before template is loaded.
		 *
		 * @return bool Whether validation of the module is successful / filled with content.
		 */
		public function validate_args(): bool {
			return ( ! empty( $this->collection ) );
		}

		/**
		 * Map raw fields from acf to object variable.
		 *
		 * @param array $raw_content Content values.
		 * @param int   $counter Module location in page layout.
		 *
		 * @return void
		 */
		public function load_args_from_layout_content( array $raw_content, int $counter = 0 ) {

			$this->collection = [];

			if ( isset( $raw_content['flex_grid'] ) && ! empty( $raw_content['flex_grid'] ) ) :
				foreach ( $raw_content['flex_grid'] as $group ) {
					$provider = $this->_get_provider( $group['acf_fc_layout'] );
					if ( null !== $provider ) {
						$this->collection[] = $provider->get_content_grid_html( $group );
					}
				}
			endif;

			parent::load_args_from_layout_content( $raw_content, $counter );
		}

		/**
		 * Register a Content Grid provider
		 *
		 * @param Content_Grid_Provider $provider Object that implements interface Content_Grid_Provider.
		 *
		 * @return void
		 */
		public function register_content_grid_provider( Content_Grid_Provider $provider ) {
			$this->_providers[] = $provider;
		}

		/**
		 * Get the currently selected Content Grid Provider
		 *
		 * @param string $identifier Provider identifier.
		 *
		 * @return Content_Grid_Provider|null $provider Provider instance.
		 */
		private function _get_provider( string $identifier ) {

			if ( is_array( $this->_providers ) && ! empty( $this->_providers ) ) {
				foreach ( $this->_providers as $provider ) {
					if ( $identifier === $provider->get_name() ) {
						return $provider;
					}
				}
			}

			return null;
		}

		/**
		 * Get aggregated choices from all Content Grid Providers as associative array for the acf layout value.
		 *
		 * @return array $layouts
		 */
		private function _get_select_field_choices(): array {
			// Include Content Grid Provider interface before including content grid providers.
			require_once 'interface-content-grid-provider.php';

			do_action( 'hogan/module/content_grid/register_providers', $this );
			$layouts = [];
			if ( is_array( $this->_providers ) && ! empty( $this->_providers ) ) {
				foreach ( $this->_providers as $provider ) {
					if ( true === $provider->enabled() ) {
						$provider_content_grid = $provider->get_provider_fields( $this->field_key );
						if ( is_array( $provider_content_grid ) && ! empty( $provider_content_grid ) ) {

							$layouts[] = [
								'key'        => $this->field_key . '_flex_' . $provider->get_name(),
								'name'       => $provider->get_name(),
								'label'      => $provider->get_label(),
								'display'    => 'block',
								'sub_fields' => $provider_content_grid,
							];
						}
					}
				}
			}

			return $layouts;
		}

	}

}
