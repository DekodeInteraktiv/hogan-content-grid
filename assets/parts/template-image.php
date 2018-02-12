<?php
/**
 * Template for image module
 *
 * $this is an instance of the Image object.
 * Available properties:
 * $this->image (array|null) Image.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Content_Grid_Provider ) ) {
	return; // Exit if accessed directly.
}

if ( empty( $this->image ) ) {
	return;
}

printf( '<figure class="%s">',
	esc_attr( hogan_classnames(
		apply_filters( 'hogan/module/content_grid/image/image/figure_classes', [], $this )
	) )
);

echo wp_get_attachment_image(
	$this->image['id'],
	$this->image['size'],
	$this->image['icon'],
	$this->image['attr']
);

echo '</figure>';
