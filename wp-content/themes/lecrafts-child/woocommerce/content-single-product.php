<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
if($post->ID == 2025){ 
	$already= false;
	foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
		$_product = $values['data'];
		$gift_product = 2025;
		if( $_product->id == $gift_product) {
			$already = true;
		} 
	} 
	if($already){ ?>
		<style>article#product-2025 {display: none;}</style><div class
			="gift_cart"><p>Gift card added to your cart. Only one gift card can be purchased online at a time.</p></div>
	<?php } else { ?>
<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="product-overview">
		
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				//do_action( 'woocommerce_before_single_product_summary' );
			?>
			
				<h2 class="Product-title">
				<?php the_title(); ?>
				</h2>
				<?php 
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5: removed
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20: move to 40
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40: move to 5
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
				
	</div><!-- .product-review -->


	
	
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10: removed
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</article><!-- #product-<?php the_ID(); ?> -->
<?php }
}
else{
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="product-overview">
		<div class="row">
		<div class="col-md-6">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
			<?php $author_id=$post->post_author; ?>
			<div class="TopArtist-details">
				<div class="TopArtist-pic">
					<div class="srt_shop">
						<?php mt_profile_img( $author_id, array('size' => 'thumbnail','echo' => true ) );?>
						<a href="<?php echo get_author_posts_url( $author_id ); ?>"></a>
					</div>
					<?php echo the_author_meta( 'display_name' , $author_id ); ?> 
				</div>
				<div class="description"> <?php echo the_author_meta( 'description' , $author_id ); ?> </div>
				
			</div>
			<div class="artist-more-work">
				<span id="artist-more-work-heading">You might like these pieces by <?php echo the_author_meta( 'display_name' , $author_id ); ?></span>
				<a href="<?php echo get_author_posts_url( $author_id ); ?>" target="_blank">MORE BY THIS ARTIST</a>
				<div class="artist-product-list">
					<?php 
					global $product, $woocommerce_loop;
					$upsells = $product->get_upsells();
					$meta_query = WC()->query->get_meta_query();
					$args = apply_filters( 'woocommerce_upsells_products_args', array(
						'post_type'           => 'product',
						'ignore_sticky_posts' => 1,
						'no_found_rows'       => 1,
						'posts_per_page'      => $posts_per_page,
						'orderby'             => $orderby,
						'post__in'            => $upsells,
						'post__not_in'        => array( $product->id, 2025 ),
						'meta_query'          => $meta_query
					) ) ; 
					$products = new WP_Query( $args );
					$woocommerce_loop['columns'] = $columns;
					if ( $products->have_posts() ) : ?>
						<div class="upsells products related">
							<?php woocommerce_product_loop_start(); ?>
								<?php while ( $products->have_posts() ) : $products->the_post(); ?>
									<?php wc_get_template_part( 'content', 'product' ); ?>
								<?php endwhile; // end of the loop. ?>
							<?php woocommerce_product_loop_end(); ?>
						</div>
					<?php endif;
					wp_reset_postdata();		
					?>
				</div>
			</div>
		</div>
			<div class="summary entry-summary product-summary">
				<h2 class="Product-title">
				<?php the_title(); ?>
				</h2><span> By
				<?php the_author_meta( 'display_name' , $author_id );?>
				</span>
				<?php 
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5: removed
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20: move to 40
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40: move to 5
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
				<?php  woocommerce_output_product_data_tabs(); ?>
				<div class="social_sharing">
					<?php dynamic_sidebar('sl461_271whi'); ?>
				</div>
				<div class="about_artplus">
					<?php the_content(); ?>
				</div>
				<div class="category_content">
					<div itemprop="description">
					     <span id="main-art-heading">-Artwork Details</span>
						 <span>Comments About This Piece</span>
						<?php 
						$apple=apply_filters( 'woocommerce_short_description', $post->post_excerpt );
						if($apple!=''){
						echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ;
						}else{
							echo "No Description Available";
						}
						?>
					</div>
				<?php
			
				global $post;
				
				$terms = get_the_terms( $post->ID, 'product_cat' );
				
				if(is_array($terms)){
					foreach ($terms as $term){
						$product_cat_id = $term->term_id;
						$product_parent_cat_id = $term->parent;
						$arr_parenet_cat = array(102, 103, 104, 105);
						if(in_array($product_parent_cat_id,$arr_parenet_cat))
						{
							echo'<span>'.get_cat_name($product_cat_id).'</span>';
							echo category_description($product_cat_id);
						}
					}
				}

				?>
				
				
				</div>
			</div><!-- .summary -->
 
		</div><!-- .row -->
	</div><!-- .product-review -->


	
	
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10: removed
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</article><!-- #product-<?php the_ID(); ?> -->

<?php }
	/**
	 * @hooked tokoo_single_product_categories_list - 10
	 */
	//do_action( 'woocommerce_after_single_product' ); 
?>