<?php
/**
 * Template for image module
 *
 * $this is an instance of the Image object.
 * Available properties:
 * $this->image (array|null) Image.
 * $this->image_link (array|null) Image Link.
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

printf(
	'<figure class="%s">',
	esc_attr(
		hogan_classnames(
			apply_filters( 'hogan/module/content_grid/image/image/figure_classes', [], $this )
		)
	)
);

if ( ! empty( $this->image_link ) ) :
	printf(
		'<a href="%s"%s>',
		esc_url( $this->image_link['url'] ),
		! empty( $this->image_link['target'] ) ? sprintf( ' target="%s"', esc_attr( $this->image_link['target'] ) ) : ''
	);
endif;

echo wp_get_attachment_image(
	$this->image['id'],
	$this->image['size'],
	$this->image['icon'],
	$this->image['attr']
);

if ( ! empty( $this->image_link ) ) :
	echo '</a>';
	endif;
echo '</figure>';
