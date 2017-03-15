<?php

/**
 * Template Name: Shop With Sidebar
 *
 * The Template for page template Shop With Sidebar
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

get_header(); ?>

	<?php
		/**
		 * tokoo_before_main_content hook
		 *
		 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'woocommerce_before_main_content' );
	 ?>

	<div class="posts-holder col-md-9">

		<?php
			if ( 0 != get_query_var( 'paged' ) ) {
				$paged = absint( get_query_var( 'paged' ) );
			} elseif ( 0 != get_query_var( 'page' ) ) {
				$paged = absint( get_query_var( 'page' ) );
			} else {
				$paged = 1;
			}

			$page_metas 		= tokoo_get_meta( '_page_details' );
			$portfolio_args   	= array(
				'post_type'         => 'product',
				'posts_per_page'    => ( ! empty( $page_metas['per_page'] ) ) ? $page_metas['per_page'] : 12,
				'post_status'       => 'publish',
				'order'             => 'DESC',
				'orderby'           => 'date',
				'paged'             => $paged
			);

			$temp 		= $wp_query;
			$wp_query 	= null;
			$wp_query 	= new WP_Query();
			$wp_query->query( $portfolio_args );

		if ( $wp_query->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
				<div class="posts-navigation">
					<div class="pagination align-center">
						<?php get_template_part( 'loop', 'nav' ); ?>
					</div><!-- .pagination -->
				</div>
			<?php endif; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php
			endif;
			$wp_query = null;
			$wp_query = $temp;  // Reset
		?>

	</div> <!-- .post-holder -->

	<div class="col-md-3">
		<?php dynamic_sidebar( 'shop' ); ?>
	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer(); ?>
