<?php

/**
 * tokoo functions and definitions
 *
 * @package tokoo
 */

/* Define static constant */

register_sidebar( array(
		'name' => __( 'Newfooter1', 'LeCrafts' ),
		'id' => 'sidebar-21',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'LeCrafts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
register_sidebar( array(
		'name' => __( 'Newfooter2', 'LeCrafts' ),
		'id' => 'sidebar-22',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'LeCrafts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
register_sidebar( array(
		'name' => __( 'Newfooter3', 'LeCrafts' ),
		'id' => 'sidebar-23',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'LeCrafts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
register_sidebar( array(
		'name' => __( 'Newfooter4', 'LeCrafts' ),
		'id' => 'sidebar-24',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'LeCrafts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
register_sidebar( array(
		'name' => __( 'Newfooter5', 'LeCrafts' ),
		'id' => 'sidebar-25',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'LeCrafts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	function get_users_custom()
	{	
		$blogusers = get_users(array('role' => 'seller' ));
		
		// Array of WP_User objects.
		
		?>
		<div class="all-users">
		<?php
		
		foreach ( $blogusers as $user ) { ?>
			<p><img src="<?php echo get_avatar_url($user);?>"></p>
			<p><?php echo $user->nickname;?></p>
		<?php } ?>
	</div>
	<?php }
	add_shortcode( 'allusers', 'get_users_custom' );
	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    unset( $tabs['seller'] );  	// Remove the seller information tab

    return $tabs;

}


?>