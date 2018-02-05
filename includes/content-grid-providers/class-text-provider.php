<?php
/**
 * Contact Form 7 Form Provider class for Hogan Form
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! \interface_exists( '\\Dekode\\Hogan\\Content_Grid_Provider' ) ) {
	return;
}

/**
 * Text Content Grid Provider class for Hogan Content Grid
 */
class Text_Provider implements Content_Grid_Provider {

	/**
	 * WYSIWYG content for use in template.
	 *
	 * @var string $content
	 */
	public $content;

	/**
	 * Get provider acf name
	 *
	 * @return string Provider name
	 */
	public function get_name(): string {
		return 'text_provider';
	}

	/**
	 * Get provider acf label, i.e. "Wysiwyg"
	 *
	 * @return string Provider name
	 */
	public function get_label(): string {
		return esc_html__( 'Content Editor', 'hogan-content-grid' );
	}

	/**
	 * Get provider fields
	 *
	 * @param string $field_key Module field key.
	 *
	 * @return array ACF fields
	 */
	public function get_provider_fields( string $field_key ) : array {
		$provider_name = $this->get_name();
		$fields        = [
			[
				'type'         => 'wysiwyg',
				'key'          => $field_key . '_content',
				'name'         => 'content',
				'label'        => __( 'Content Editor', 'hogan-content-grid' ),
				'instructions' => apply_filters( 'hogan/module/content_grid/' . $provider_name . '/instructions', '' ),
				'tabs'         => apply_filters( 'hogan/module/content_grid/' . $provider_name . '/tabs', 'all' ),
				'media_upload' => apply_filters( 'hogan/module/content_grid/' . $provider_name . '/allow_media_upload', 1 ),
				'toolbar'      => apply_filters( 'hogan/module/content_grid/' . $provider_name . '/toolbar', 'hogan' ),
			],
		];

		return $fields;
	}

	/**
	 * Get rendered content_grid HTML
	 *
	 * @param array $raw_content Content values.
	 *
	 * @return string Content Grid HTML
	 */
	public function get_content_grid_html( array $raw_content ) : string {
		$this->content = $raw_content['content'];

		$template_part = HOGAN_CONTENT_GRID_PATH . 'assets/parts/template-text.php';
		$template_part = apply_filters( 'hogan/module/content_grid/template/text', $template_part, $this );

		if ( ! file_exists( $template_part ) || 0 !== validate_file( $template_part ) ) {
			return '';
		}

		ob_start();
		// Include provider template.
		include $template_part;

		return ob_get_clean();
	}

	/**
	 * Finds whether a provider is enabled
	 *
	 * @return bool Returns TRUE if provider is enabled, FALSE otherwise.
	 */
	public function enabled(): bool {
		$enabled = apply_filters( 'hogan/module/content_grid/' . $this->get_name() . '/enabled', true ) ?? false;

		return $enabled;
	}
}
