<?php
/**
 * Content Grid Module template
 *
 * $this is an instance of the Content Grid object.
 *
 * Available properties:
 * $this->heading (string) Module heading.
 * $this->select_provider (Content_Grid_Provider) Form provider object.
 * $this->get_content_grid_html() (string) Content Grid HTML from provider.
 *
 * @package Hogan
 */

declare( strict_types = 1 );
namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Content_Grid ) ) {
	return; // Exit if accessed directly.
}

if ( ! empty( $this->heading ) ) {
	printf( '<h2>%s</h2>', esc_html( $this->heading ) );
}

// @codingStandardsIgnoreStart
// In content grid builder developers we trust. No need to validate/escape any data here.
//echo $this->get_content_grid_html();
// @codingStandardsIgnoreEnd
?>
<div class="hogan-grid hogan-grid-text-center">
	<div class="hogan-grid-inner">
		<?php
		foreach ( $this->collection as $content ) :
			$classnames = hogan_classnames( 'hogan-content-grid-item' ); //todo: Add type?
			//todo: Get html from front with filter her to change the template
			?>
			<div class="<?php echo esc_attr( $classnames ); ?>">
				<?php
				echo $content; // WPCS: XSS OK.
				?>
			</div>
		<?php
		endforeach;
		?>
	</div>
</div>
