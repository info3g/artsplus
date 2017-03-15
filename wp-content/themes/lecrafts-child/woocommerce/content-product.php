<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php if ( 'classic' != get_theme_mod( 'tokoo_shop_item_style' ) ) : ?>

	<div <?php post_class( 'card-item' ); ?>>
	
		<div class="product__inner">

			<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10 : removed
				 */
				do_action( 'woocommerce_before_shop_loop_item' );
			?>

			<figure href="<?php the_permalink(); ?>" class="product__image">
				
				<?php 
					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10 : removed
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' ); 
				 ?>
				
				<a href="<?php the_permalink(); ?>" class="image"><?php tokoo_template_loop_product_thumbnail_alt( 'shop_catalog' ); ?></a>

				<a href="<?php the_permalink(); ?>" class="detail-circle"><i class="simple-icon-magnifier"></i><em><?php esc_html_e( 'View Details', 'tokoo' ); ?></em></a>
				
				<div class="action-addon">
					<?php 
						if ( class_exists( 'YITH_WCQV' ) ) :
							$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
							echo '<a href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '"><span class="tooltip">'.$label.'</span><i class="simple-icon-eye"></i></a>';
						endif;
					?>
					<?php 
						if ( class_exists( 'YITH_WCWL' ) ) :
							echo do_shortcode( '[yith_wcwl_add_to_wishlist label= ""]' ); 
						endif;
					?>
				</div>
			</figure>
			
			<div class="product__detail">
				<?php 

					/**
					 * woocommerce_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10 : removed
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
					if(get_post_meta(get_the_ID(), '_width', true)){
						echo get_post_meta(get_the_ID(), '_width', true).'&quot;';
					}
					if(get_post_meta(get_the_ID(), '_height', true)){
						echo 'X '. get_post_meta(get_the_ID(), '_height', true). '&quot; ';
					}
					$get_medium = get_the_terms(get_the_ID(),'product_cat');
					if(!empty($get_medium)){
						foreach($get_medium as $medium){
							if($medium->parent==102){
								echo $medium->name;
							}
						}
					} 
					tokoo_product_title() ;
					if(get_post_meta(get_the_ID(), '_price',true)){
						echo ' $' . get_post_meta(get_the_ID(), '_price',true) ;
					}
					tokoo_product_category(); 
				?>

				<div class="product__action">
					<?php 
						/**
						 * woocommerce_after_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );

						/**
						 * woocommerce_after_shop_loop_item hook.
						 *
						 * @hooked woocommerce_template_loop_product_link_close - 5 : removed
						 * @hooked woocommerce_template_loop_add_to_cart - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item' );
					?>
				</div>
			</div>
		</div>

	</div>

<?php else : ?>

	<article <?php post_class( 'card-item' ); ?>>

		<div class="inner-product card-inner">

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

			<?php tokoo_template_loop_product_thumbnail( 'shop_catalog' ); ?>

			<div class="product-detail">
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10: removed
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				<?php tokoo_product_category(); ?>
				<?php tokoo_product_title(); ?>
				<?php tokoo_product_star_rating(); ?>
				<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5: removed
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
	 

			<div class="product-action">
				<a href="<?php the_permalink(); ?>" class="block-link"></a>
				<?php
					/**
					 * woocommerce_after_shop_loop_item hook
					 *
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>

				<div class="bottom-action">
					<?php 
						if ( class_exists( 'YITH_WCQV' ) ) :
							$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
							echo '<a href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '"><span class="tooltip">'.$label.'</span><i class="simple-icon-eye"></i></a>';
						endif;
					?>
					<a href="<?php the_permalink(); ?>" class="detail"><?php _e( 'Detail', 'tokoo' ); ?></a>
					<?php 
						if ( class_exists( 'YITH_WCWL' ) ) :
							echo do_shortcode( '[yith_wcwl_add_to_wishlist label= ""]' ); 
						endif;
					?>
				</div>

			</div>

		</div><!-- .inner-product -->

	</article>
	
<?php endif; ?>