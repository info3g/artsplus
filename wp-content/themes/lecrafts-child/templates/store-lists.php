<?php

/**
 * Template Name: Store List
 *
 * The Template for page template store list
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
		if ( function_exists( 'dokan_get_sellers' ) ) :

			/**
			* Filter return the number of store listing number per page.
			*
			* @since 2.2
			*
			* @param array
			*/
			$posts_per_page 	= tokoo_get_meta( '_page_details' );
			$paged  			= max( 1, get_query_var( 'paged' ) );
			$limit  			= ( ! empty( $posts_per_page['per_page'] ) ) ? $posts_per_page['per_page'] : 12;
			$offset 			= ( $paged - 1 ) * $limit;
			$arg 				= array(
				'number'     => $limit,
				'offset'     => $offset,
			);
			$sellers 			= dokan_get_sellers( $limit, $offset );

			if ( $sellers['users'] ) : ?>

				<div class="store-list">

					<?php
					foreach ( $sellers['users'] as $seller ) {
						$store_info = dokan_get_store_info( $seller->ID );
						$banner_id  = isset( $store_info['banner'] ) ? $store_info['banner'] : 0;
						$store_name = isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : esc_html__( 'N/A', 'tokoo' );
						$store_url  = dokan_get_store_url( $seller->ID );
						?>

						<div class="store">

							<?php if ( $banner_id ) :
									$get_banner_url = wp_get_attachment_image_src( $banner_id, 'large' );
									$banner_url 	= $get_banner_url[0];
								else :
									$banner_url = dokan_get_no_seller_image();
								endif;
							?>

							<div class="store__image" data-bg-image="<?php echo esc_url( $banner_url ); ?>">
								<figure class="store__avatar">
									<?php echo get_avatar( $seller->ID, 80 ); ?>
									<figcaption>
										<h3 class="store__name"><?php printf( $store_name ); ?></h3>
									</figcaption>
								</figure>
							</div> <!-- .thumbnail -->
							<div class="store__detail">
								<address>
									<?php if ( isset( $store_info['address'] ) && !empty( $store_info['address'] ) ) {
										$address 		= $store_info['address'];
										$country_obj 	= new WC_Countries();
										$countries   	= $country_obj->countries;
										$states      	= $country_obj->states;
										echo isset( $address['street_1'] ) ? $address['street_1'] : '';
										echo isset( $address['street_2'] ) ? $address['street_2'] : '';
										echo ', ';
										echo isset( $address['city'] ) ? $address['city'] : '';
										echo ', ';
										echo isset( $address['zip'] ) ? $address['zip'] : '';
										echo ', ';
										$country_code = isset( $address['country'] ) ? $address['country'] : '';
										$state_code   = isset( $address['state'] ) ? $address['state'] : '';
										$state_code   = ( $address['state'] == 'N/A' ) ? '' : $address['state'];
										echo isset( $countries[$country_code] ) ? $countries[$country_code] : '';
										echo ', ';
										echo isset( $states[$country_code][$state_code] ) ? $states[$country_code][$state_code] : $state_code;
									} ?>
								</address>
								<?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
									<a href="tel:<?php echo esc_html( $store_info['phone'] ); ?>">
										<i class="fa fa-phone"></i> <?php echo esc_html( $store_info['phone'] ); ?>
									</a>
								<?php } ?>
								<a href="<?php echo esc_url( $store_url ); ?>" class="button"><?php esc_html_e( 'Visit store', 'tokoo' ); ?></a>
							</div>

						</div> <!-- .single-seller -->
					<?php } ?>

				</div> <!-- .dokan-seller-wrap -->

			<?php
				global $post;

				$user_count   = $sellers['count'];
				$num_of_pages = ceil( $user_count / $limit );

				if ( $num_of_pages > 1 ) {
					echo '<div class="posts-navigation clearfix">';
					$page_links = paginate_links( array(
							'current'   => $paged,
							'total'     => $num_of_pages,
							'base'      => str_replace( $post->ID, '%#%', esc_url( get_pagenum_link( $post->ID ) ) ),
							'type'      => 'array',
							'prev_text' => __( '&larr; Previous', 'tokoo' ),
							'next_text' => __( 'Next &rarr;', 'tokoo' ),
						) );

					if ( $page_links ) {
						$pagination_links  = '<div class="pagination">';
						$pagination_links .= join( $page_links );
						$pagination_links .= '</div>';

						echo ''.$pagination_links;
					}

					echo '</div>';
				}

			endif;
		endif;
		?>

	<?php
		/**
		 * tokoo_after_main_content hook
		 *
		 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'tokoo_after_main_content' );
	 ?>

<?php get_footer(); ?>
