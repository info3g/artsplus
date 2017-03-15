<?php 
/* Template Name: Fav */
get_header(); 
?>
<main class="main-content" id="content">

	<div class="container">

<div id="wrapper" class="other1">
	<div class="page-header">
		<h2 class="page-title"><?php the_title(); ?></h2>
	</div> <!-- .page-header -->
</div>
	<div id="post-1042" class="post-1042 page type-page status-publish hentry">
		<div class="post-content">
			<div class="content">
				<div class="entry-content">
					<nav class="woocommerce-MyAccount-navigation">
						<ul>
							<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
								<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
									<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php /* global $wbdb;
?>
<div class="container">
<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
<p>Select an existing favorites list or create a new one.</p>

<select name="createwishlist" onchange="createwishlist();">
	<option selected="selected" value="0">CREATE NEW FAVORITES LIST</option>
	<?php $result = $wpdb->get_results( 'select * from wp_favlist where user_id='.get_current_user_id()); 
	if (is_array($result) || is_object($result))
	{
		foreach($result as $list_name){
			echo '<option name='.$list_name->listname .' value='.$list_name->ID .'>'. $list_name->listname .'</option>';
		}
	}
	?> 
	</select>
<form class="favlist" name="favlist" method='POST'>
	<p>Favorites Title:</p>
	<input type='text' name='fav_title' class='fav_title' />
	<p>Description:</p>
	<textarea name='list_description' class='list_description'></textarea>
	<input type='submit' name='submit' value="Save"/>
</form>

</div>
<?php 
if(isset($_POST['submit']) &&(!empty($_POST['fav_title']))){
 $user_id = get_current_user_id();
$listname= $_POST['fav_title'];
$description= $_POST['list_description'];
$wpdb->insert( 
	'wp_favlist', 
	array( 
		'user_id' => $user_id, 
		'listname' => $listname,
		'description'=>$description
	), 
	array( 
		'%d', 
		'%s', 
		'%s' 
	) 
); 
}

$result = $wpdb->get_results( 'select * from wp_favlist where user_id='.get_current_user_id());
if (is_array($result) || is_object($result))
	{
		foreach($result as $list_name){?>
				<div class="<?php echo $list_name->ID;?> <?php echo $list_name->listname;?>">
					<?php if(isset($list_name->product_ids)){
						echo $list_name->product_ids;
					}
					else{
						
					}	?>
				</div>
<?php 	}
	}
 ?>


<?php */ get_footer();
?>