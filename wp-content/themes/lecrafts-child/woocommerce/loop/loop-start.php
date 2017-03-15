<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
$shop_page_display = get_option( 'woocommerce_shop_page_display' );
?>
<?php if ( 'classic' == get_theme_mod( 'tokoo_shop_item_style' ) ) : ?>
	<div class="products-holder classic-style">
<?php else : ?>
	<div class="products-holder card card--1x1 ">
<?php endif; ?>