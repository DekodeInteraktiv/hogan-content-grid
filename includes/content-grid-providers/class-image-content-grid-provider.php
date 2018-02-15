<?php
/**
 * Image Provider class for Hogan Content Grid
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! \class_exists( '\\Dekode\\Hogan\\Base_Content_Grid_Provider' ) || ! \interface_exists( '\\Dekode\\Hogan\\Content_Grid_Provider' ) ) {
	return;
}

/**
 * Image Content Grid Provider class for Hogan Content Grid
 */
class Image_Content_Grid_Provider extends Base_Content_Grid_Provider implements Content_Grid_Provider {

	/**
	 * Image
	 *
	 * @var array|null $image
	 */
	public $image;

	/**
	 * Get provider identifier, i.e. "text"
	 *
	 * @return string Provider identifier
	 */
	public function get_identifier() : string {
		return 'image';
	}

	/**
	 * Get provider acf label, i.e. "Wysiwyg"
	 *
	 * @return string Provider name
	 */
	public function get_name() : string {
		return esc_html__( 'Image', 'hogan-content-grid' );
	}

	/**
	 * Get provider fields
	 *
	 * @param string $field_key Module field key.
	 *
	 * @return array ACF fields
	 */
	public function get_provider_fields( string $field_key ) : array {

		$provider_identifier = $this->get_identifier();

		$constraints_defaults = [
			'min_width'  => '',
			'min_height' => '',
			'max_width'  => '',
			'max_height' => '',
			'min_size'   => '',
			'max_size'   => '',
			'mime_types' => '',
		];

		// Merge $args from filter with $defaults.
		$constraints_args = wp_parse_args( apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/image_size/constraints', [] ), $constraints_defaults );

		$fields = [
			[
				'type'          => 'image',
				'key'           => $field_key . '_image_id',
				'name'          => 'image_id',
				'label'         => __( 'Add Image', 'hogan-content-grid' ),
				'required'      => 1,
				'return_format' => 'id',
				'preview_size'  => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/image_size/preview_size', 'medium' ),
				'library'       => apply_filters( 'hogan/module/content_grid/' . $provider_identifier . '/image_size/library', 'all' ),
				'min_width'     => $constraints_args['min_width'],
				'min_height'    => $constraints_args['min_height'],
				'max_width'     => $constraints_args['max_width'],
				'max_height'    => $constraints_args['max_height'],
				'min_size'      => $constraints_args['min_size'],
				'max_size'      => $constraints_args['max_size'],
				'mime_types'    => $constraints_args['mime_types'],
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

		if ( ! empty( $raw_content['image_id'] ) ) {
			$image = wp_parse_args( apply_filters( 'hogan/module/content_grid/' . $this->get_identifier() . '/image/args', [] ), [
				'size' => 'medium',
				'icon' => false,
				'attr' => [],
			] );

			$image['id']   = $raw_content['image_id'];
			$this->image   = $image;

			return parent::render_template();
		}
	}

}
