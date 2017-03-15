<?php
/**
 * Template Name: Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tokoo
 */ ?>
<?php get_header(); ?>  
<!--content start-->
	<div id="content">
    	<div id="wrapper">
        	<div class="home_service">
<?php the_content();
/* $prod_cat_args = array(
  'taxonomy'     => 'product_cat', //woocommerce
  'orderby'      => 'name',
  'empty'        => 0
);

$woo_categories = get_categories( $prod_cat_args );

foreach ( $woo_categories as $woo_cat ) {
    $woo_cat_id = $woo_cat->term_id; //category ID
    $woo_cat_name = $woo_cat->name; //category name
    $woo_cat_slug = $woo_cat->slug; //category slug
	$cat_thumb_id = get_woocommerce_term_meta( $woo_cat_id, 'thumbnail_id', true );
	$shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
	
$neglacted_cat=array('art-for-autumn', 'best-of-impressionism', 'new-art','open-studios-blog','staff-favorites','the-showroom');
if (in_array($woo_cat_slug, $neglacted_cat)):
 ?>	
            	<div class="home_ser1">
                	<?php  echo '<a href="' . get_term_link( $woo_cat_slug, 'product_cat' ) . '"><img src="'.$shop_catalog_img[0].'" alt="Service" title="Service" /><p>' . $woo_cat_name . '</p></a>';
					?>
                </div>
<?php
	endif;
}//end of $woo_categories foreach  
  */?>
</div>
        </div>
    </div>
<!--content end-->

<?php get_footer(); ?>

