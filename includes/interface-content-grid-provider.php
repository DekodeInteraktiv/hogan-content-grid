<?php
/**
 * Content Grid Provider interface
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

/**
 * Form Provider interface
 */
interface Content_Grid_Provider {

	/**
	 * Get provider acf name
	 *
	 * @return string Provider name
	 */
	public function get_name(): string;
	/**
	 * Get provider acf label, i.e. "Wysiwyg"
	 *
	 * @return string Provider name
	 */
	public function get_label(): string;

	/**
	 * Get provider fields
	 *
	 * @param string $field_key Module field key.
	 *
	 * @return array ACF fields
	 */
	public function get_provider_fields( string $field_key ): array;

	/**
	 * Get rendered content_grid HTML
	 *
	 * @param array $raw_content Content values.
	 * @return string Content Grid HTML
	 */
	public function get_content_grid_html( array $raw_content ): string;

	/**
	 * Finds whether a provider is enabled
	 *
	 * @return bool Returns TRUE if provider is enabled, FALSE otherwise.
	 */
	public function enabled(): bool;
}
