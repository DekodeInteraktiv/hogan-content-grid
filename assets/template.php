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

if ( ! empty( $this->lead ) ) {
	echo wp_kses_post( $this->lead );
}

?>
<div class="hogan-content-grid">
	<div class="hogan-grid-inner">
		<?php
		foreach ( $this->collection as $card_args ) :
			$classnames = hogan_classnames( 'hogan-content-grid-item', 'hogan-grid-item-type-' . $card_args['provider'] );
			?>
			<div class="<?php echo esc_attr( $classnames ); ?>">
				<?php
				echo $card_args['markup']; // WPCS: XSS OK.
				?>
			</div>
		<?php
		endforeach;
		?>
	</div>
</div>
