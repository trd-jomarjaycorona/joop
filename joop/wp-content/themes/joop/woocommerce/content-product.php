<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="item-details">

		<div class="item-details-wrap">
			<div>
			
			<div class="spacer"></div>
			
			<?php woo_single_product_cat(); ?>

			<p class="item-title"><strong><?php

				$title = get_the_title();
				echo $title;

			?></strong></p>

			<?php woocommerce_template_single_price(); ?>

				<div class="spacer"></div>

				<?php
				if ($product->has_attributes()) {
					?>
					<a class="product_hover" href="<?php the_permalink(); ?>" title="<?php echo __('Select options', THEME_SLUG); ?>">
						<i class="fa fa-signal"></i>
					</a>
					<?php
				} else {
					?>
					<a class="product_hover" href="<?php the_permalink(); ?>" title="<?php echo __('View details', THEME_SLUG); ?>">
						<i class="fa fa-eye"></i>
					</a>
					<?php
				}
				?>

				<a class="product_hover add_to_cart_button single_add_to_cart_button product_type_<?php echo $product->product_type; ?>" href="<?php the_permalink(); ?>" rel="nofollow" data-product_id="<?php echo $product->id; ?>" title="<?php echo __('Add to cart', THEME_SLUG); ?>">
					<i class="fa fa-shopping-cart"></i>
				</a>
			</div>
		</div>
	</div>

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>