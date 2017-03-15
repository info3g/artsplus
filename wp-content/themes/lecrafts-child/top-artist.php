<?php
/**
 * Template Name: Top Artist
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tokoo
 */ ?>
<?php get_header(); ?> 

<?php 
global $wpdb, $woocommerce;
global $product;


	$blogusers = get_users(array('role' => 'seller','meta_key'     => 'dokan_enable_selling','meta_value'   => 'yes'));
	/* echo "<pre>";
	print_r($blogusers); */
	?> 
	<div class="custom_filter">
		<a href="javascript:void(0);" class="filter_my">
		<span class="filter">Filter By: </span>
		<span class="f_medium">Medium </span>
		<span class="f_style">Style </span>
		<span class="f_last_name">Last Name </span>
		</a>
		<div class="filter_options">
		<div class="filter_container"></div>
		<div class="filter_container">
			<div class="f_medium_v">
		<?php	$cat_ary = array(); 
				foreach ($blogusers as $user) { 
					$user_id = $user->data->ID;
					$sel = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = {$user_id} AND post_type='product' and post_status='publish'");
					foreach($sel as $sels)
                    {
						$_product = new WC_Product($sels->ID);
						$pro_id = $_product->id;
						$terms = get_the_terms($pro_id , 'product_cat');
						
						if (is_array($terms) || is_object($terms))
						{
							foreach($terms as $term){
								if($term->parent == 102){
									$category_name = $term->name;
									array_push($cat_ary,$category_name);
								}
							}
						}
					}
				}	 
				$medium_cat = array_unique($cat_ary);
				?> <ul>
				<?php foreach($medium_cat as $medium){ ?>
					
                      <li><input class="top-artist-medium" value="<?php echo $medium; ?>" name="artist_medium" type="checkbox" onchange="artist_data();"> <span><?php echo $medium; ?></span></li>
			<?php 	}
			?>
			</ul>
			</div>
		</div>
		<div class="filter_container">
			<div class="f_style_v"><?php	$cat_ary = array(); 
				foreach ($blogusers as $user) { 
					$user_id = $user->data->ID;
					$sel = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = {$user_id} AND post_type='product' and post_status='publish'");
					foreach($sel as $sels)
                    {
						$_product = new WC_Product( $sels->ID );
						$pro_id = $_product->id;
						$terms = get_the_terms( $pro_id , 'product_cat' );
						if (is_array($terms) || is_object($terms))
						{
							foreach ($terms as $term) {
								if($term->parent == 103){
									$category_name = $term->name;
									array_push($cat_ary,$category_name);
								}
							}
						}
					}
				}	 
				$style_cat = array_unique($cat_ary);
				?> <ul>
				<?php foreach($style_cat as $style){ ?>
					
                      <li><input class="top-artist-style" value="<?php echo $style; ?>" name="artist_style" type="checkbox" onchange="artist_data();"> <span><?php echo $style; ?></span></li>
			<?php 	}
			?>
			</ul> </div>
		</div>
		<!--div class="filter_container">
			<div class="f_region">Region </div>
			<div class="f_region_v">Region </div>
		</div-->
		<div class="filter_container">
			<div class="f_last_name_v">
				<ul style="float:left;">
				<?php foreach (range('A', 'M') as $char) { ?>
					<li><input class="top-artist-letter" value="<?php echo $char; ?>" NAME="artlist_letter" onchange="artist_data();"  type="checkbox"> <span><?php echo $char; ?></span></li>
				<?php } ?>
				</ul>
				<ul style="float:left; margin-left:20px;">
				<?php foreach (range('N', 'Z') as $char) { ?>
					<li><input class="top-artist-letter" value="<?php echo $char; ?>" NAME="artlist_letter" onchange="artist_data();"  type="checkbox"> <span><?php echo $char; ?></span></li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	</div>
		<?php
		?>
		<div class="all-users">
        	<div id="wrapper" class="ajax-users">
		<?php
		foreach ( $blogusers as $user ) { 
			$user_id = $user->data->ID;
			$fname = get_user_meta($user_id, 'first_name', true);
			$lname = get_user_meta($user_id, 'last_name', true);
			$name = $fname.' '. $lname;
		?>
			<div class="TopArtist-pic-content">
                <div class="TopArtist-pic">
					<div class="srt_shop">
						<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
                		<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
                    </div>
                    <p class="top-artist-name"><?php echo ucfirst($name);?></p>
                </div>
                <div class="products_artist">
                <?php 
                //echo "SELECT * FROM $wpdb->posts WHERE post_author = {$user_id} AND post_type='product' and post_status='publish' and post_author !=1 limit 3";
                $sel = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = {$user_id} AND post_type='product' and post_status='publish' and post_author !=1 limit 3");
				
                    foreach($sel as $sels)
                    { 
						
						echo '<div class="product_inner">';
                        $_product = new WC_Product( $sels->ID );
						$pro_id = $_product->id;
						$width = get_post_meta($pro_id,'_width',true);
						$height = get_post_meta($pro_id,'_height',true);
                        $ids = get_post_thumbnail_id( $sels->ID );
                        $image = get_post_meta($ids,'_wp_attached_file',true);
                        $image_url = site_url().'/wp-content/uploads/'.$image;
						
                        echo '<p><a href="'.get_post_permalink($sels->ID).'"><img src="'.$image_url.'" height="150" /></a></p>';
						
                        echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
                        if($_product->get_price() != "") 
                        {
                            echo '<span>$'.$_product->get_price().'</span>';
                        }
						
						echo '</h2></div>';
						
						
                    }
                ?>
                </div>
                </div>
		<?php } ?>
        	</div>
		</div>
	

<?php get_footer(); ?>

