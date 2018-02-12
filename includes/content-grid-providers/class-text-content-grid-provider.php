<?php
/**
 * Text Provider class for Hogan Content Grid
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! \class_exists( '\\Dekode\\Hogan\\Base_Content_Grid_Provider' ) || ! \interface_exists( '\\Dekode\\Hogan\\Content_Grid_Provider' ) ) {
	return;
}

/**
 * Text Content Grid Provider class for Hogan Content Grid
 */
class Text_Content_Grid_Provider extends Base_Content_Grid_Provider implements Content_Grid_Provider {

	/**
	 * WYSIWYG content for use in template.
	 *
	 * @var string $content
	 */
	public $content;

	/**
	 * Get provider identifier, i.e. "text"
	 *
	 * @return string Provider identifier
	 */
	public function get_identifier(): string {
		return 'text';
	}

	/**
	 * Get provider acf label, i.e. "Wysiwyg"
	 *
	 * @return string Provider name
	 */
	public function get_name(): string {
		return esc_html__( 'Text', 'hogan-content-grid' );
	}

	/**
	 * Get provider fields
	 *
	 * @param string $field_key Module field key.
	 *
	 * @return array ACF fields
	 */
	public function get_provider_fields( string $field_key ): array {
		$provider_identifier = $this->get_identifier();
		$fields              = [
			[
				'type'         => 'wysiwyg',
				'key'          => $field_key . '_content',
				'name'         => 'content',
				'label'        => $this->get_name(),
				'required'     => 1,
				'delay'        => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/content/delay', true ),
				'instructions' => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/content/instructions', '' ),
				'tabs'         => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/content/tabs', 'all' ),
				'media_upload' => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/content/allow_media_upload', 1 ),
				'toolbar'      => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/content/toolbar', 'hogan' ),
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
	public function get_content_grid_html( array $raw_content ): string {
		$this->content = $raw_content['content'];

		return parent::render_template();
	}

}
