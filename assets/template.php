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

$classnames = hogan_classnames( apply_filters( 'hogan/module/content_grid/template/outer_classes', [
	'hogan-content-grid',
], $this ) );

?>
<div class="<?php echo esc_attr( $classnames ); ?>">
	<?php
	$classnames = hogan_classnames( apply_filters( 'hogan/module/content_grid/template/inner_classes', [
		'hogan-grid-inner',
	], $this ) );
	?>
	<div class="<?php echo esc_attr( $classnames ); ?>">
		<?php
		$classes = apply_filters( 'hogan/module/content_grid/template/item_classes', [ 'hogan-content-grid-item' ], $this );
		foreach ( $this->collection as $card_args ) :
			$classnames = hogan_classnames( $classes, 'hogan-grid-item-type-' . $card_args['provider'] );
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
