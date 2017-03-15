<?php

/**
 * Template Name: Blog Classic
 * 
 * The Template for page template blog standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php get_header(); // Loads the header.php template. ?>

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

	$block_args = array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> get_option( 'posts_per_page' ),
		'paged' 			=> $paged
	); 
	$blocks = new WP_Query ( $block_args );
?>

<?php if ( $blocks->have_posts() ) : ?>

	<div class="content bloggg">

		<?php
			// for injecting num pages
			$wp_query->max_num_pages = $blocks->max_num_pages;
		?>

		<div class="posts-holder posts-holder--classic">

			<?php while ( $blocks->have_posts() ) : $blocks->the_post(); ?>
				
				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // End while loop. ?>
			
		</div><!-- .post-list -->

		<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
			<div class="pagination align-center">
				<?php get_template_part( 'loop', 'nav' ); ?>
			</div><!-- .pagination -->
		<?php endif; ?>	

	</div><!-- .content -->

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; // End if check. ?>

<?php wp_reset_postdata(); ?>

<?php 
	/**
	 * tokoo_after_main_content hook
	 *
	 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'tokoo_after_main_content' );
 ?>

<?php get_footer(); // Loads the footer.php template. ?>