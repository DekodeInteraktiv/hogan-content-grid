# Content Grid Module for [Hogan](https://github.com/dekodeinteraktiv/hogan-content-grid)

## Installation
Install the module using Composer `composer require dekodeinteraktiv/hogan-content-grid` or simply by downloading this repository and placing it in `wp-content/plugins`

## Available filters

`hogan/module/content_grid/providers/enabled` Enable/disable providers (Standard, text and image)

Example:

`function enable_image_provider( array $args ) : array {
	$args ['image']['enabled']    = 1;
	return $args;
}
add_filter( 'hogan/module/content_grid/providers/enabled', __NAMESPACE__ . '\\enable_image_provider' );`

- More will be added soon

`hogan/module/content_grid/standard/label/enabled` Enable/disable label field. Default disabled.
