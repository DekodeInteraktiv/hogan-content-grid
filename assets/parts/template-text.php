<?php
/**
 * Text Provider template
 *
 * $this is an instance of the Content Grid Text Provider object.
 *
 * Available properties:
 * $this->content (string) HTML content.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Content_Grid_Provider ) ) {
	return; // Exit if accessed directly.
}

echo $this->content; // WPCS: XSS OK.
