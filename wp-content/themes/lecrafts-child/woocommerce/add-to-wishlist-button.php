<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product;
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id ) ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>" class="<?php echo esc_attr( $link_classes ); ?>" >
    <?php printf( $icon ); ?>
    <?php if ( is_singular( 'product' ) ) : ?>
   		<?php printf( $label ); ?>
    <?php endif; ?>
</a>
<img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ) ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />