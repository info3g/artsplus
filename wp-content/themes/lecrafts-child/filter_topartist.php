<?php 
include('/home/artsplus/public_html/wp-load.php');
global $wpdb;
 $data = json_decode(stripslashes($_POST['artlist_letter']));
$medium = json_decode(stripslashes($_POST['medium']));
$style = json_decode(stripslashes($_POST['style']));

if(empty($data) and empty($medium) and empty($style)){
	$blogusers = get_users(array('role' => 'seller','meta_key'     => 'dokan_enable_selling','meta_value'   => 'yes'));
		foreach ( $blogusers as $user ) { 
			$user_id = $user->data->ID;
			$nickname = $user->data->nickname;
			$fname = get_user_meta($user_id, 'first_name', true);
			$lname = get_user_meta($user_id, 'last_name', true);
			$name = $fname.' '. $lname; ?>
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
						
                        echo '<p><img src="'.$image_url.'" height="150" /></p>';
						
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
		<?php }
}
if(empty($data) and empty($medium) and !empty($style)){
	foreach($style as $s_style){
		$userdata = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.*,user_meta.*,users.display_name FROM wp_posts product, wp_term_relationships relationships, wp_usermeta user_meta, wp_usermeta users_meta, wp_term_taxonomy taxonomy,wp_terms terms,wp_users users WHERE product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$s_style' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id  AND product.post_author = user_meta.user_id AND user_meta.meta_key='wp_capabilities' AND user_meta.meta_value LIKE '%\"seller\"%' AND users_meta.meta_key='dokan_enable_selling' AND users_meta.meta_value='yes' AND users.ID = user_meta.user_id GROUP BY product.post_author");
		
		foreach($userdata as $user){
			$user_id = $user->post_author;
			 ?>
			 <div class="TopArtist-pic-content">
				<div class="TopArtist-pic">
					<div class="srt_shop">
						<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
						<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
					</div>
					<p class="top-artist-name"><?php echo $user->display_name;?></p>
				</div>
				<div class="products_artist">
				<?php $sel = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.* FROM wp_posts product, wp_term_relationships relationships, wp_term_taxonomy taxonomy,wp_terms terms WHERE product.post_author = {$user_id} AND product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$s_style' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id limit 3");
				
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
						
                        echo '<p><img src="'.$image_url.'" height="150" /></p>';
						
                        echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
                        if($_product->get_price() != "") 
                        {
                            echo '<span>$'.$_product->get_price().'</span>';
                        }
						
						echo '</h2></div>';
						
						
                    } ?>  
					</div>
					</div>
		<?php }
	}
}
if(empty($data) and !empty($medium) and empty($style)){
	foreach($medium as $smedium){
		$userdata = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.*,user_meta.*,users.display_name FROM wp_posts product, wp_term_relationships relationships, wp_usermeta user_meta, wp_term_taxonomy taxonomy,wp_terms terms,wp_users users WHERE product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$smedium' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id  AND product.post_author = user_meta.user_id AND user_meta.meta_key='wp_capabilities' AND user_meta.meta_value LIKE '%\"seller\"%' AND users.ID = user_meta.user_id GROUP BY product.post_author");
		
		foreach($userdata as $user){
			$user_id = $user->post_author;
			 ?>
			 <div class="TopArtist-pic-content">
				<div class="TopArtist-pic">
					<div class="srt_shop">
						<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
						<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
					</div>
					<p class="top-artist-name"><?php echo $user->display_name;?></p>
				</div>
				<div class="products_artist">
				<?php $sel = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.* FROM wp_posts product, wp_term_relationships relationships, wp_term_taxonomy taxonomy,wp_terms terms WHERE product.post_author = {$user_id} AND product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$smedium' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id limit 3");
				
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
						
                        echo '<p><img src="'.$image_url.'" height="150" /></p>';
						
                        echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
                        if($_product->get_price() != "") 
                        {
                            echo '<span>$'.$_product->get_price().'</span>';
                        }
						
						echo '</h2></div>';
						
						
                    } ?>  
					</div>
					</div>
		<?php }
	}
}
if(empty($data) and !empty($medium) and !empty($style)){
	foreach($medium as $smedium){
		foreach($style as $s_style){
		$userdata = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.*, user_meta.*,users.display_name FROM wp_posts product, wp_term_relationships relationship, wp_term_relationships relationships, wp_usermeta user_meta, wp_term_taxonomy taxonomy, wp_term_taxonomy taxonomi, wp_terms terms, wp_terms term, wp_users users WHERE product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id  AND product.post_author = user_meta.user_id AND user_meta.meta_key='wp_capabilities' AND user_meta.meta_value LIKE '%\"seller\"%' AND users.ID = user_meta.user_id AND terms.name = '$s_style' AND relationship.term_taxonomy_id = taxonomi.term_taxonomy_id AND taxonomi.taxonomy= 'product_cat' AND relationship.object_id = product.ID AND term.term_id=taxonomi.term_id AND term.name = '$smedium' GROUP BY product.post_author");
		
		foreach($userdata as $user){
			$user_id = $user->post_author;
			 ?>
			 <div class="TopArtist-pic-content">
				<div class="TopArtist-pic">
					<div class="srt_shop">
						<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
						<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
					</div>
					<p class="top-artist-name"><?php echo $user->display_name;?></p>
				</div>
				<div class="products_artist">
				<?php $sel = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.* FROM wp_posts product, wp_term_relationships relationships, wp_term_relationships relationship, wp_term_taxonomy taxonomy, wp_term_taxonomy taxonomi,wp_terms terms,wp_terms term WHERE product.post_author = {$user_id} AND product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$smedium' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id 
AND relationship.term_taxonomy_id = taxonomi.term_taxonomy_id AND taxonomi.taxonomy= 'product_cat' AND term.name = '$s_style' AND relationship.object_id = product.ID AND term.term_id=taxonomi.term_id limit 3");
				
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
						
                        echo '<p><img src="'.$image_url.'" height="150" /></p>';
						
                        echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
                        if($_product->get_price() != "") 
                        {
                            echo '<span>$'.$_product->get_price().'</span>';
                        }
						
						echo '</h2></div>';
						
						
                    } ?>  
					</div>
					</div>
		<?php }
	}
	}
}
if(!empty($data) and empty($medium) and empty($style) ){
	foreach($data as $letter){
		$querystr = "SELECT SQL_CALC_FOUND_ROWS wp_users.* FROM wp_users INNER JOIN wp_usermeta ON ( wp_users.ID = wp_usermeta.user_id )  INNER JOIN wp_usermeta AS mt1 ON ( wp_users.ID = mt1.user_id ) WHERE 1=1 AND (((( wp_usermeta.meta_key = 'last_name' AND wp_usermeta.meta_value LIKE '$letter%' )) AND ((( mt1.meta_key = 'wp_capabilities' AND mt1.meta_value LIKE '%\"seller\"%' )))))";
		$results = $wpdb->get_results($querystr, OBJECT);
	foreach( $results as $user) {
			$user_id = $user->ID; ?>
			<div class="TopArtist-pic-content">
                <div class="TopArtist-pic">
					<div class="srt_shop">
						<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
                		<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
                    </div>
                    <p class="top-artist-name"><?php echo $user->display_name;?></p>
                </div>
                <div class="products_artist">
                <?php $sel = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_author = {$user_id} AND post_type='product' and post_status='publish' and post_author !=1 limit 3");
				
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
						
                        echo '<p><img src="'.$image_url.'" height="150" /></p>';
						
                        echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
                        if($_product->get_price() != "") 
                        {
                            echo '<span>$'.$_product->get_price().'</span>';
                        }
						
						echo '</h2></div>';
						
						
                    } ?>   
					</div>
                </div>
<?php 	}  
	
}
}
if(!empty($data) and !empty($medium) and empty($style) ){
	foreach($data as $letter){
			$querystr = "SELECT SQL_CALC_FOUND_ROWS wp_users.* FROM wp_users INNER JOIN wp_usermeta ON ( wp_users.ID = wp_usermeta.user_id )  INNER JOIN wp_usermeta AS mt1 ON ( wp_users.ID = mt1.user_id ) WHERE 1=1 AND (((( wp_usermeta.meta_key = 'last_name' AND wp_usermeta.meta_value LIKE '$letter%' )) AND ((( mt1.meta_key = 'wp_capabilities' AND mt1.meta_value LIKE '%\"seller\"%' )))))";
			$results = $wpdb->get_results($querystr, OBJECT);
			foreach( $results as $user) {
				$user_id = $user->ID; 
				foreach($medium as $smedium){
					 $sel= $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.* FROM wp_posts product, wp_term_relationships relationships, wp_term_taxonomy taxonomy,wp_terms terms WHERE product.post_author = {$user_id} AND product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$smedium' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id limit 3");
					 if(count($sel)>0){
				?>
				<div class="TopArtist-pic-content">
					<div class="TopArtist-pic">
						<div class="srt_shop">
							<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
							<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
						</div>
						<p class="top-artist-name"><?php echo $user->display_name; ?></p>
					</div>
					<div class="products_artist">
					<?php 
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
							
							echo '<p><img src="'.$image_url.'" height="150" /></p>';
							
							echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
							if($_product->get_price() != "") 
							{
								echo '<span>$'.$_product->get_price().'</span>';
							}
							
							echo '</h2></div>';
							
							
						}   ?>   
						</div>
					</div>
	<?php 	} 
	}
	} 
		
	} 
} 
if(!empty($data) and empty($medium) and !empty($style) ){
	foreach($data as $letter){
			$querystr = "SELECT SQL_CALC_FOUND_ROWS wp_users.* FROM wp_users INNER JOIN wp_usermeta ON ( wp_users.ID = wp_usermeta.user_id )  INNER JOIN wp_usermeta AS mt1 ON ( wp_users.ID = mt1.user_id ) WHERE 1=1 AND (((( wp_usermeta.meta_key = 'last_name' AND wp_usermeta.meta_value LIKE '$letter%' )) AND ((( mt1.meta_key = 'wp_capabilities' AND mt1.meta_value LIKE '%\"seller\"%' )))))";
			$results = $wpdb->get_results($querystr, OBJECT);
			foreach( $results as $user) {
				$user_id = $user->ID; 
				foreach($style as $s_style){
					 $sel= $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.* FROM wp_posts product, wp_term_relationships relationships, wp_term_taxonomy taxonomy,wp_terms terms WHERE product.post_author = {$user_id} AND product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$s_style' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id limit 3");
					 if(count($sel)>0){
				?>
				<div class="TopArtist-pic-content">
					<div class="TopArtist-pic">
						<div class="srt_shop">
							<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
							<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
						</div>
						<p class="top-artist-name"><?php echo $user->display_name; ?></p>
					</div>
					<div class="products_artist">
					<?php 
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
							
							echo '<p><img src="'.$image_url.'" height="150" /></p>';
							
							echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
							if($_product->get_price() != "") 
							{
								echo '<span>$'.$_product->get_price().'</span>';
							}
							
							echo '</h2></div>';
							
							
						}   ?>   
						</div>
					</div>
	<?php 	} 
	}
	} 
		
	} 
} 
if(!empty($data) and !empty($medium) and !empty($style) ){
 foreach($medium as $smedium){
	foreach($style as $s_style){
			$userdata = $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.*, user_meta.*,users.display_name FROM wp_posts product, wp_term_relationships relationship, wp_term_relationships relationships, wp_usermeta user_meta, wp_usermeta user_me, wp_term_taxonomy taxonomy, wp_term_taxonomy taxonomi, wp_terms terms, wp_terms term, wp_users users WHERE product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id  AND product.post_author = user_meta.user_id AND user_meta.meta_key='wp_capabilities' AND user_meta.meta_value LIKE '%\"seller\"%'  AND user_me.meta_key='last_name' AND user_me.meta_value LIKE 'S%' AND users.ID = user_me.user_id AND users.ID = user_meta.user_id AND terms.name = '$s_style' AND relationship.term_taxonomy_id = taxonomi.term_taxonomy_id AND taxonomi.taxonomy= 'product_cat' AND relationship.object_id = product.ID AND term.term_id=taxonomi.term_id AND term.name = '$smedium'  GROUP BY product.post_author");
		
		foreach($userdata as $user){
			$user_id = $user->post_author; ?>
				<div class="TopArtist-pic-content">
					<div class="TopArtist-pic">
						<div class="srt_shop">
							<?php mt_profile_img( $user_id, array('size' => 'thumbnail','echo' => true ) );?>
							<a href="<?php echo get_author_posts_url( $user_id ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-artist-shop-btn.jpg" /></a>
						</div>
						<p class="top-artist-name"><?php echo $user->display_name; ?></p>
					</div>
				<?php
						$sel= $wpdb->get_results("SELECT product.*, relationships.*, taxonomy.*,terms.* FROM wp_posts product, wp_term_relationships relationships, wp_term_relationships relationship, wp_term_taxonomy taxonomy, wp_term_taxonomy taxonomi,wp_terms terms,wp_terms term WHERE product.post_author = {$user_id} AND product.post_type='product' AND product.post_status='publish' AND relationships.term_taxonomy_id = taxonomy.term_taxonomy_id AND taxonomy.taxonomy= 'product_cat' AND terms.name = '$smedium' AND relationships.object_id = product.ID AND terms.term_id=taxonomy.term_id AND relationship.term_taxonomy_id = taxonomi.term_taxonomy_id AND taxonomi.taxonomy= 'product_cat' AND term.name = '$s_style' AND relationship.object_id = product.ID AND term.term_id=taxonomi.term_id limit 3");
				?>
				<div class="products_artist">
					<?php 
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
							
							echo '<p><img src="'.$image_url.'" height="150" /></p>';
							
							echo '<h2><a href="'.get_post_permalink($sels->ID).'">'. $width.'" x' . $height.'"' .$sels->post_title.'</a>';
							if($_product->get_price() != "") 
							{
								echo '<span>$'.$_product->get_price().'</span>';
							}
							
							echo '</h2></div>';
							
							
						}   ?>   
						</div>
					</div>
	<?php 	} 
	}
	} 
		
	}  
?>