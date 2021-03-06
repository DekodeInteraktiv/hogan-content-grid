<?php
/**
 * Core Provider class for Hogan Content Grid
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

/**
 * The base class for content grid providers.
 */
abstract class Base_Content_Grid_Provider {

	/**
	 * Get provider identifier, i.e. "text"
	 *
	 * @return string Provider identifier
	 */
	abstract public function get_identifier() : string;

	/**
	 * Get rendered content_grid HTML
	 *
	 * @return string Content Grid HTML
	 */
	protected function render_template(): string {

		if ( true !== $this->validate_args() ) {
			return '';
		}

		$template_part = HOGAN_CONTENT_GRID_PATH . 'assets/parts/template-' . $this->get_identifier() . '.php';
		$template_part = apply_filters( 'hogan/module/content_grid/template/' . $this->get_identifier(), $template_part, $this );

		if ( ! file_exists( $template_part ) || 0 !== validate_file( $template_part ) ) {
			return '';
		}

		ob_start();
		// Include provider template.
		include $template_part;

		return ob_get_clean();
	}

	/**
	 * Validate sub module content before template is loaded.
	 *
	 * @return bool Whether validation of the sub module is successful / filled with content.
	 */
	protected function validate_args() {
		return true;
	}

}
