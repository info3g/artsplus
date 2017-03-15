<?php 
include('/home/artsplus/public_html/wp-load.php');
global $wpdb,$WC;
$mediums = json_decode(stripslashes($_POST['mediums']));
$orientations = json_decode(stripslashes($_POST['orientations']));
$styles = json_decode(stripslashes($_POST['styles']));
$subjects = json_decode(stripslashes($_POST['subjects']));
$colors = json_decode(stripslashes($_POST['colors']));
$min_width = $_POST['min_width'];
$max_width = $_POST['max_width'];
$max_height = $_POST['max_height'];
$min_height = $_POST['min_height'];
$min_price =$_POST['min_price'];
$max_price =$_POST['max_price'];
$parent_cat_id =$_POST['parent_cat_id'];
$sort_val= $_POST['sort_val'];
$query .= "SELECT product.*,CONVERT(SUBSTRING_INDEX(price.meta_value,'-',-1),UNSIGNED INTEGER) as p_price FROM wp_posts product , wp_postmeta price ";
$query_from ="";
$where_clause .= " WHERE product.post_type='product' AND product.post_status='publish' AND price.meta_key= '_regular_price' AND price.meta_value >=0 AND price.post_id =product.ID ";
if(!empty($mediums)) {
	$query_from .= ",wp_term_relationships medium";
	$where_clause .= "AND medium.term_taxonomy_id IN (".implode(',',$mediums).") AND medium.object_id IN (product.ID) ";
}
if(!empty($orientations)) {
	$query_from .= ",wp_term_relationships orientations";
	$where_clause .= "AND orientations.term_taxonomy_id IN (".implode(',',$orientations).") AND orientations.object_id IN (product.ID) ";
}
if(!empty($styles)) {
	$query_from .= ",wp_term_relationships styles";
	$where_clause .= "AND styles.term_taxonomy_id IN (".implode(',',$styles).") AND styles.object_id IN (product.ID) ";
}
if(!empty($subjects)) {
	$query_from .= ",wp_term_relationships subjects";
	$where_clause .= "AND subjects.term_taxonomy_id IN (".implode(',',$subjects).") AND subjects.object_id IN (product.ID) ";
}
if(!empty($parent_cat_id)) {
	$query_from .= ",wp_term_relationships parent";
	$where_clause .= " AND parent.term_taxonomy_id = $parent_cat_id AND parent.object_id = product.ID" ;
} 
if(!empty($colors)){
	$query_from .= ",wp_term_relationships colors";
	$where_clause .= " AND colors.term_taxonomy_id IN (".implode(',',$colors).") AND colors.object_id IN (product.ID)";
}
if(isset($min_width) and isset($max_width)){
	$query_from .= ",wp_postmeta width ";
	$where_clause .= " AND width.meta_key= '_width' AND width.meta_value >=$min_width AND width.post_id =product.ID";if($max_width<60){
		$where_clause .= " AND width.meta_key= '_width' AND width.meta_value <=$max_width AND width.post_id=product.ID";
	}
}
if(isset($min_height) and isset($max_height)){
	$query_from .= ",wp_postmeta height "; 
	$where_clause .= " AND height.meta_key= '_height' AND height.meta_value >=$min_height AND height.post_id =product.ID";
	if($max_height<60){
		$where_clause .= " AND height.meta_key= '_height' AND height.meta_value <=$max_height AND height.post_id=product.ID";
	}
}
if(isset($min_price) and isset($max_price)){
	if($min_price>0){
		$where_clause .= " AND price.meta_key= '_regular_price' AND price.meta_value >=$min_price AND price.post_id =product.ID";
	}
	if($max_price!='u'){
		$where_clause .= " AND price.meta_key= '_regular_price' AND price.meta_value <=$max_price AND price.post_id=product.ID";
	}
}
if(isset($sort_val)){
	if($sort_val=='featured'){
		//$order_by .= " ORDER BY p_price ASC ";
	}
	else if($sort_val=='price'){
		$order_by .= " ORDER BY p_price ASC ";
	}
	else if($sort_val=='price-desc'){
		$order_by .= " ORDER BY p_price DESC ";
	}
	else{
		$order_by .= " ORDER BY product.ID DESC ";
	}
}
$my_query = $query . $query_from . $where_clause . $order_by;
$results =$wpdb->get_results($my_query);
foreach($results as $result){ 
	?>
	<div class="card-item post-<?php echo $result->ID;  ?> product type-product status-<?php echo $result->post_status ?>">
		<div class="product__inner">
			<figure href="<?php echo get_permalink($result->ID); ?>" class="product__image">
				<a href="<?php echo get_permalink($result->ID); ?>" class="image">
					<?php echo get_the_post_thumbnail($result->ID,'medium');  ?>
				</a>
				<a href="<?php echo get_permalink($result->ID); ?>" class="detail-circle"><i class="simple-icon-magnifier"></i><em>View Details</em></a>
				<div class="action-addon">
					<?php if ( class_exists( 'YITH_WCQV' ) ) :
							$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
							echo '<a href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '"><span class="tooltip">'.$label.'</span><i class="simple-icon-eye"></i></a>';
						  endif; 
						  if ( class_exists( 'YITH_WCWL' ) ) :
							echo do_shortcode( '[yith_wcwl_add_to_wishlist label= ""]' ); 
						  endif; ?>
				</div>
			</figure>
			<div class="product__detail">
				<h2 class="product__title">
				<?php 
				if(get_post_meta($result->ID, '_width', true)){
						echo get_post_meta($result->ID, '_width', true).'&quot;';
					}
					if(get_post_meta($result->ID, '_height', true)){
						echo 'X '. get_post_meta($result->ID, '_height', true). '&quot; ';
					}
					$get_medium = get_the_terms($result->ID,'product_cat');
					if(!empty($get_medium)){
						foreach($get_medium as $medium){
							if($medium->parent==102){
								echo $medium->name;
							}
						}
					} 
					$result->post_title;
					if(get_post_meta($result->ID, '_price',true)){
						echo ' $' . get_post_meta($result->ID, '_price',true) ;
					}
				?></h2>
				<div class="product__action">
					<a rel="nofollow" href="<?php echo get_permalink($result->ID); ?>" data-quantity="1" data-product_id="<?php echo $result->ID; ?>" data-product_sku="" class="button product_type_simple ajax_add_to_cart">Quick Shop</a><a href="#" class="button yith-wcqv-button" data-product_id="<?php echo $result->ID; ?>">Quick View</a>	
				</div>
			</div>
		</div>
	</div>
<?php	
}
?>
