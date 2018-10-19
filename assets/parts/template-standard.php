<?php
/**
 * Standard Provider template
 *
 * $this is an instance of the Content Grid Standard Provider object.
 *
 * Available properties:
 * $this->image (array|null) Image.
 * $this->title (string|null) Title
 * $this->text (string|null) Text content / Description
 * $this->call_to_action (array|null)  Call to action link.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Content_Grid_Provider ) ) {
	return; // Exit if accessed directly.
}

if ( ! empty( $this->image ) ) {


	printf( '<figure class="%s">',
		esc_attr( hogan_classnames(
			apply_filters( 'hogan/module/content_grid/standard/image/figure_classes', [], $this )
		) )
	);

	echo wp_get_attachment_image(
		$this->image['id'],
		$this->image['size'],
		$this->image['icon'],
		$this->image['attr']
	);

	echo '</figure>';
}

if ( ! empty( $this->label ) ) {
	echo '<span>' . esc_textarea( $this->label ) . '</span>';
}

if ( ! empty( $this->title ) ) {
	hogan_component( 'heading', [
		'title' => $this->title,
	] );
}

if ( ! empty( $this->text ) ) {
	echo '<p>' . esc_textarea( $this->text ) . '</p>';
}

if ( ! empty( $this->call_to_action ) ) {
	echo '<div>';
	hogan_component( 'button', $this->call_to_action );
	echo '</div>';
}
