<?php 
/* Template Name: Following Artists  */
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
					<div class="follwing-artist">
						<div class="follwing-heading">
							<h3>ArtistName</h3> 
							<h3>Sign Up</h3>
							<h3>Action</h3>
						</div>
						
						
						<?php $results = $wpdb->get_results( 'select follow.*,user.display_name  from wp_followingartist  follow , wp_users user where follow.user_id='.get_current_user_id().' and follow.artist_ids=user.ID');
						foreach($results as $result){	
							echo '<div class="divFollowArtists"><p>'. $result->display_name .'</p>';
							echo '<p>'. $result->following_date .'</p>';
							echo '<button id="btnunFollowArtist" type="button" style="" onclick="unArtistFollowPopup(' .$result->artist_Ids . ');" class="follow-artist-btn">Unfollow this Artist</button></div>';
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</main>
<?php get_footer(); ?>