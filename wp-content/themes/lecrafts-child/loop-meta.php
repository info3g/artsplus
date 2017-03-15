<?php

/**
 * The Template for displaying loop meta
 * used in Taxonomy Pages
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// bounce back in ... well, you know lah
if ( is_page_template( 'templates/fullwidth.php' ) )
	return;

?>

<div id="wrapper" class="other1">
<div class="page-header">

	<?php get_template_part( 'breadcrumbs' ); ?>

	<?php if ( is_404() ) { ?>

		<h2 class="page-title"><?php _e( 'Page Not Found', 'tokoo' ); ?></h2>

	<?php
		} elseif ( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {

			$custom_store_url 	= dokan_get_option( 'custom_store_url', 'dokan_selling', 'store' );
			$seller 			= get_user_by( 'slug', get_query_var( $custom_store_url ) );
			$store_user    		= get_userdata( get_query_var( 'author' ) );
			$store_info    		= dokan_get_store_info( $store_user->ID );

			if ( $seller ) :
	?>
				<h2 class="page-title"><?php printf( __( '%1s: <strong>%2s</strong>', 'tokoo' ), $custom_store_url, esc_html( $store_info['store_name'] ) ); ?></h2>
			<?php endif; ?>
	<?php } elseif ( is_home() ) { ?>

		<?php
		$title = __( 'Blog', 'tokoo' );
		$posts_page = get_option( 'page_for_posts' );
		if ( ! empty( $posts_page ) && is_numeric( $posts_page ) ) {
			$title = get_the_title( $posts_page );
		}
		?>

		<h2 class="page-title"><?php echo esc_attr( $title ); ?></h2>

	<?php } elseif ( is_category() ) { ?>

		<?php $cat_title = single_cat_title( '', false ); ?>
		<h2 class="page-title"><?php printf( __( 'Category: <strong>%s</strong>', 'tokoo' ), $cat_title ); ?></h2>

		<div class="loop-description">
			<?php echo category_description(); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_tag() ) { ?>

		<?php $tag_title = single_tag_title( '', false ); ?>
		<h2 class="page-title"><?php printf( __( 'Tag: <strong>%s</strong>', 'tokoo' ), $tag_title ); ?></h2>

		<div class="loop-description">
			<?php echo tag_description(); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_tax() ) { ?>

		<h2 class="page-title"><?php //single_term_title(); ?></h2>

		<div class="loop-description">
			<?php //echo term_description( '', get_query_var( 'taxonomy' ) ); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_author() ) { ?>

		<?php $author_name = get_the_author_meta( 'display_name', get_query_var( 'author' ) ); ?>
		<?php $author_id = get_the_author_meta( 'ID', get_query_var( 'author' ) ); ?>
		
        <div class="artist-pic">
			<?php mt_profile_img( $author_id, array('size' => 'thumbnail','echo' => true ) );?>
        </div>
        
        <div class="artist-profile-details-right">
			<div class="float-left">
                <h2 class="page-title fn n "><?php printf( __( 'Author: <strong class="author_title">%s</strong>', 'tokoo' ), $author_name ); ?></h2>
				<?php $results = $wpdb->get_results( 'select count(*) as numrow from wp_followingartist where user_id='.get_current_user_id().' AND artist_Ids='.$author_id); ?>
				<div class='thankyou' style='display:none;'>Thank you for following this artist.</div>
				<?php if(!empty($results[0]->numrow))
				{ ?>
					<button id="btnunFollowArtist" type="button" style="" onclick="unArtistFollowPopup(<?php echo $author_id; ?>);" class="follow-artist-btn">Unfollow this Artist</button>
		<?php   }
				else {
				?>
					<button id="btnFollowArtist" type="button" style="" onclick="ArtistFollowPopup(<?php echo $author_id; ?>);" class="follow-artist-btn">Follow this Artist</button>
			<?php } ?>
                <div class="loop-description">
                    <?php //echo wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) ); 
					$profile=wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) );
				$profile=explode("^^^",$profile);
                 echo $profile[0];
					
					?>
                </div><!-- .loop-description -->
			</div>
        </div>
        
        
        <dl class="accordion">
              <dt class="accordion__title">ART FOR SALE</dt>
              <dd class="accordion__content">
                <?php 
				$sel = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = {$author_id} AND post_type='product' and post_status='publish'");
				
                    foreach($sel as $sels)
                    { 
						$_product = new WC_Product( $sels->ID );
						$pro_id = $_product->id;
						$pr_status = get_post_meta($pro_id,'_stock_status',true);
						if($pr_status == 'instock'){
							echo '<div class="product_inner">';
							
							$width = get_post_meta($pro_id,'_width',true);
							$height = get_post_meta($pro_id,'_height',true);
							$ids = get_post_thumbnail_id( $sels->ID );
							$image = get_post_meta($ids,'_wp_attached_file',true);
							$image_url = site_url().'/wp-content/uploads/'.$image;
							
							echo '<p><img src="'.$image_url.'" height="150" /></p>';
							
							echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
							if($_product->get_price() != "") 
							{
								echo '<span>$'.$_product->get_price().'</span>';
							}
							
							echo '</h2></div>';
							
						}
                    }
				?>
              </dd>
              <dt class="accordion__title">SOLD WORKS</dt>
              <dd class="accordion__content">
              <?php   $sel = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = {$author_id} AND post_type='product' and post_status='publish'");
				
                    foreach($sel as $sels)
                    {       
						$_product = new WC_Product( $sels->ID );
						$pro_id = $_product->id;
						$pr_status = get_post_meta($pro_id,'_stock_status',true);
						if($pr_status == 'outofstock'){
							echo '<div class="product_inner">';
							echo "<div class='sold-out'>Sold Out</div>";
							$width = get_post_meta($pro_id,'_width',true);
							$height = get_post_meta($pro_id,'_height',true);
							$ids = get_post_thumbnail_id( $sels->ID );
							$image = get_post_meta($ids,'_wp_attached_file',true);
							$image_url = site_url().'/wp-content/uploads/'.$image;
							
							echo '<p><img src="'.$image_url.'" height="150" /></p>';
							
							echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
							if($_product->get_price() != "") 
							{
								echo '<span>$'.$_product->get_price().'</span>';
							}
							
							echo '</h2></div>';
						}
						
                    }?>
              </dd>
              <dt class="accordion__title">REQUEST CUSTOM ART</dt>
              <dd class="accordion__content">
                <?php echo do_shortcode('[contact-form-7 id="1643" title="Custom Art"]'); ?>
              </dd>
              <dt class="accordion__title">PROFILE</dt>
              <dd class="accordion__content">
                <p>
				<?php 
				$profile=wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) );
				$profile=explode("^^^",$profile);
                 echo $profile[1];
				?></p>
              </dd>
              <dt class="accordion__title">COMMENTS</dt>
              <dd class="accordion__content">
                <p><b>Artist and Customer Comment</b></p>
				<?php $args = array(
				'comment_field' => '<p class="comment-form-comment"><textarea class="input-text" id="comment" name="comment" cols="45" rows="8" placeholder="'.__( 'Your Comment *', 'tokoo' ).'" aria-required="true"></textarea></p>',
			);

			comment_form( $args ); ?>
				<?php $args = array('ID' => $author_id);
				$comments = get_comments($args);?>
				<div class="comments">
				<?php foreach($comments as $comment) :
					echo '<div class="single_comment"><strong>'.$comment->comment_author .'</strong><span class="post_date"> '.get_the_date() .'</span>';
					echo '<br /><p>' . $comment->comment_content .'</p></div>';
				endforeach; ?>
				</div>
              </dd>
        </dl>
	<?php } elseif ( is_search() ) { ?>

		<h2 class="page-title"><?php echo esc_attr( get_search_query() ); ?></h2>

		<div class="loop-description">
			<?php echo wpautop( sprintf( __( 'You are browsing the search results for "%s"', 'tokoo' ), esc_attr( get_search_query() ) ) ); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_post_type_archive() ) { ?>

		<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

		<h2 class="page-title">
			<?php
			if ( is_post_type_archive( 'product' ) ) {
				woocommerce_page_title();
			} else {
				post_type_archive_title();
			}
			?>
		</h2>

		<div class="loop-description">
			<?php
			if ( is_post_type_archive( 'product' ) ) {
				do_action( 'woocommerce_archive_description' );
			} elseif ( !empty( $post_type->description ) ) {
				echo wpautop( $post_type->description );
			}
			?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_day() || is_month() || is_year() ) { ?>

		<?php
			if ( is_day() )
				$date = get_the_time( __( 'F d, Y', 'tokoo' ) );
			elseif ( is_month() )
				$date = get_the_time( __( 'F Y', 'tokoo' ) );
			elseif ( is_year() )
				$date = get_the_time( __( 'Y', 'tokoo' ) );
		?>

		<h2 class="page-title"><?php printf( $date ); ?></h2>

		<div class="loop-description">
			<?php echo wpautop( sprintf( __( 'You are browsing the site archives for %s.', 'tokoo' ), $date ) ); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_archive() ) { ?>

		<?php
			the_archive_title( '<h2 class="page-title">', '</h1>' );
			the_archive_description( '<div class="loop-description">', '</div>' );
		?>

	<?php } elseif ( get_page_template_slug( get_the_ID() ) ) { // check if the page using page template ?>

		<h2 class="page-title"><?php echo get_post_field( 'post_title', get_queried_object_id() ); ?></h2>

		<?php if ( ! is_page_template( 'templates/contact.php' ) && ! is_page_template( 'templates/fullwidth.php' ) ) : // don't show description for some page templates ?>
			<div class="loop-description">
				<?php echo apply_filters( 'the_content', get_post_field( 'post_content', get_queried_object_id() ) ); ?>
			</div><!-- .loop-description -->
		<?php endif; ?>

	<?php } elseif ( is_singular() ) { ?>

		<h2 class="page-title"><?php single_post_title(); ?></h2>

	<?php } // End if check ?>
    
 
 
 <script>
jQuery( document ).ready(function() {
if(jQuery(window).width() > 768){

// Hide all but first tab content on larger viewports
jQuery('.accordion__content:not(:first)').hide();

// Activate first tab
jQuery('.accordion__title:first-child').addClass('active');

} else {
  
// Hide all content items on narrow viewports
jQuery('.accordion__content').hide();
};

// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
jQuery( ".accordion__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

// The clicking action
jQuery('.accordion__title').on('click', function() {
jQuery('.accordion__content').hide();
jQuery(this).next().show().prev().addClass('active').siblings().removeClass('active');
});
});
</script>

 <!-- .page-header -->
</div>