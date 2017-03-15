<?php

/**
 * Template Name: Portfolios
 * 
 * The Template for page template portfolios
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>
	
	<?php 
		/**
		 * tokoo_before_main_content hook
		 *
		 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'tokoo_before_main_content' );
	?>
		
		<?php
			if ( 0 != get_query_var( 'paged' ) ) {
				$paged = absint( get_query_var( 'paged' ) );
			} elseif ( 0 != get_query_var( 'page' ) ) {
				$paged = absint( get_query_var( 'page' ) );
			} else {
				$paged = 1;
			}

			$posts_per_page 	= tokoo_get_meta( '_page_details' );
			$portfolio_args   	= array(
				'post_type'         => 'tokoo-portfolio',
				'posts_per_page'    => ( ! empty( $posts_per_page['per_page'] ) ) ? $posts_per_page['per_page'] : 12,
				'post_status'       => 'publish',
				'order'             => 'DESC',
				'orderby'           => 'date',
				'paged'             => $paged
			); 
			$portfolios = new WP_Query ( $portfolio_args ); 

		if ( $portfolios->have_posts() ) : ?>

			<div class="content">
				
				<?php tokoo_loop_nav_above(); ?>
				
				<div class="posts-navigation">
					<div class="browse-bytag pull-left filterable-nav">
						<?php $terms = get_terms( 'project_categories', 'hide_empty=1' ); ?>
						<strong><?php _e( 'Filter:', 'tokoo' ); ?> </strong>
						<a class="current" href="#" data-filter="*"><?php _e( 'All', 'tokoo' ); ?></a>
						<?php foreach ( $terms as $term ) { ?>
							<a href="#" data-filter=".<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_attr( $term->name ); ?></a>
						<?php } ?>
					</div> <!-- .browse-bytag -->
					
					<?php
					// for injecting num pages
					$wp_query->max_num_pages = $portfolios->max_num_pages;
					?>

					<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
						<div class="pagination pull-right">
							<?php get_template_part( 'loop', 'nav' ); ?>
						</div><!-- .pagination -->
					<?php endif; ?>	
				</div> <!-- .post-navigation -->

				<div class="portfolio-holder card packery-layout columns-5">

					<?php while ( $portfolios->have_posts() ) : $portfolios->the_post(); ?>

						<?php get_template_part( 'content', 'portfolio' ); ?>

					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>

				</div> <!-- .portfolio-holder -->

				<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
					<div class="pagination align-center">
						<?php get_template_part( 'loop', 'nav' ); ?>
					</div><!-- .pagination -->
				<?php endif; ?>	

			</div> <!-- .content -->

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		
	<?php 
		/**
		 * tokoo_after_main_content hook
		 *
		 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'tokoo_after_main_content' );
	 ?>

<?php get_footer(); ?>
