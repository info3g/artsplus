<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package tokoo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head> 
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assert/css/screen.css">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php  wp_head(); ?> 
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css">
<style>
@media screen and (max-width:635px){
  div#popuppostalcode {
    padding: 44px 13px !important;
}
}
</style>



<?php
if (isset($_REQUEST['step__3'])) {
?>
	<script>jQuery(document).ready(function(){
				//alert(0);
				jQuery('.step__1').hide();
				jQuery('.step__2').hide();
				jQuery('.step__3').show();
			});</script>
<?php } ?>	
</head>

<body <?php body_class(); ?>>
<div class="body_upper"></div>
<div class="site-content<?php tokoo_site_layout(); ?>">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tokoo' ); ?></a>

	<header id="masthead" class="site-header">
	<div class="container">

		<div class="top-header">
			<div class="container">
				
				<?php do_action( 'lecrafts_before_site_title' ); ?>

				<?php  tokoo_site_title(); ?>
				<p class="head_tagline">Free Shipping and Returns!</p>
				

				<?php do_action( 'lecrafts_after_site_title' ); ?>

			</div> <!-- .container -->
		</div> <!-- .top-header -->

		<?php tokoo_header_menu() ?>
		<div class="header-tools">
			<?php if ( is_active_sidebar( 'primary' ) ) : ?>
				
			<?php endif; ?>
			<?php if ( class_exists( 'WooCommerce' ) ) {
					if ( is_user_logged_in() ) { 
						get_template_part( 'menu', 'user' ); ?>
						<a href="<?php echo wp_logout_url( '/' ); ?> "><i class="simple-icon-logout"></i></a>
						<?php }
					 else { 
							wp_nav_menu( array( 'menu' => 'User Menu') ); 
					 }
			 ?>
				<div class="mini-cart">
					<button class="mini-cart__toggle"><i class="fa-shopping-cart fa"></i><span class="amount"><?php echo WC()->cart->cart_contents_count; ?></span></button>
					<?php the_widget( 'WC_Widget_Cart' ); ?>
				</div>
			<?php } ?>
		</div> <!-- .header-tools -->
		</div>
		<div class="shop_category">
			<div class="container">
			<?php wp_nav_menu( array( 'menu' => 'Shop Category') ); ?> 
			<div class="header-search-form">
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
						<i class="simple-icon-magnifier"></i>
						<input type="search" name="s" placeholder="<?php esc_html_e( 'Search here and hit enter', 'tokoo' ); ?>" title="<?php _e( 'Search for:', 'tokoo' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
						<span></span>
					</form>
				</div> <!-- .header-search-form -->
			</div>
		</div>
	</header><!-- #masthead -->
	<div id="customer_l_section" class="slide_section">
	   <div class="woocommerce">        
							
			<div class="col-set" id="customer_login">
			
				<div class="col">
				
					<h2 class="customer_text" style="">Sign in to your account</h2>
					<h2 class="artist_text" style="display:none">Artist Login</h2>
					<span class="artist_text" style="display:none">Sign in to your account.</span>
					<form method="post" class="login" id="woocommerce_login">
					
												
						<input type="hidden" value="af0fe27bad" name="_wpnonce_phoe_login_form" id="_wpnonce_phoe_login_form">

						<p class="form-row form-row-wide">
							<label for="username">Username or email address <span class="required">*</span></label>
							<input type="text" class="input-text" name="username" id="username" value="">
						</p>
						<p class="form-row form-row-wide">
							<label for="password">Password <span class="required">*</span></label>
							<input class="input-text" type="password" name="password" id="password" value="">
						</p>
						<p class="form-row">
							<input type="hidden" id="_wpnonce" name="_wpnonce" value="fd684f83cf">
							<input type="hidden" name="_wp_http_referer" value="https://artsplus.com/my-account/">															</p><p class="lost_password">							<a href="https://artsplus.com/my-account/lost-password/">Forgot your password?</a>							</p>
							<div id="UlArtistErrorMsg" style="display:none"></div>
							<input type="submit" class="button" id="login" name="login" value="Continue">
							<!--label for="rememberme" class="inline">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember me </label-->
								<a href="javascript:void(0)" id="CreateAccount" class="customer_text">New to ArtsPlus? Create an account here.</a>
								<!--a class="faq artist_text" href="/faq" style="display: none;">New to Artsplus? Visit FAQ</a--> 
								<a class="exhibit artist_text" href="https://artsplus.com/apply-to-exhibit/" style="display: none;"><b>NEW ARTISTS: SIGN UP HERE TO BEGIN</b></a>
						<p></p>
						
					</form>
				</div>
			</div>
			</div>
	</div>
	<div class="customer_l_section" style="display:none;">
	<div class="woocommerce">        
							
			<div class="col-set" id="customer_login">
			
				<div class="col">
				
					<h2 class="customer_text" style="">Sign in to your account</h2>
					<h2 class="artist_text" style="display:none">Artist Login</h2>
					<span class="artist_text" style="display:none">Sign in to your account.</span>
					<form method="post" class="login" id="woocommerce_login">
					
												
						<input type="hidden" value="af0fe27bad" name="_wpnonce_phoe_login_form" id="_wpnonce_phoe_login_form">

						<p class="form-row form-row-wide">
							<label for="username">Username or email address <span class="required">*</span></label>
							<input type="text" class="input-text" name="username" id="username" value="">
						</p>
						<p class="form-row form-row-wide">
							<label for="password">Password <span class="required">*</span></label>
							<input class="input-text" type="password" name="password" id="password">
						</p>
						<p class="form-row">
							<input type="hidden" id="_wpnonce" name="_wpnonce" value="fd684f83cf">
							<input type="hidden" name="_wp_http_referer" value="https://artsplus.com/my-account/">															</p><p class="lost_password">							<a href="https://artsplus.com/my-account/lost-password/">Forgot your password?</a>							</p>
							<div id="UlArtistErrorMsg" style="display:none"></div>
							<input type="submit" class="button" id="login" name="login" value="Continue">
							<!--label for="rememberme" class="inline">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember me </label-->
								<a href="javascript:void(0)" id="CreateAccount" class="customer_text">New to ArtsPlus? Create an account here.</a>
								<a class="faq artist_text" href="" style="display: none;">New to Artsplus? Visit FAQ</a> 
								<a class="exhibit artist_text" href="https://artsplus.com/apply-to-exhibit/" style="display: none;">Apply to exhibit here.</a>
						<p></p>
						
					</form>
				</div>
			</div>
			</div>
	</div>
	<div id="customer_s_section" class="slide_section">
		<div class="woocommerce">        
	
			<div class="col-set" id="customer_login">
				<div class="col">
					<h2>Create a new account</h2>
					<form method="post" class="register">	

													
						<input type="hidden" value="02e4c13db9" name="_wpnonce_phoe_register_form" id="_wpnonce_phoe_register_form">
						
						<p class="form-row form-row-wide half_cl"> 
							<label for="username">First Name<span class="required">*</span></label>
							<input type="text" class="input-text" name="username1" id="fistname" value="">
						</p>
						
						<p class="form-row form-row-wide half_cl">
							<label for="username">Last Name<span class="required">*</span></label>
							<input type="text" class="input-text" name="username" id="lastname" value="">
						</p>
					
						<p class="form-row form-row-wide">
							<label for="reg_email">Email address <span class="required">*</span></label>
							<input type="email" class="input-text" name="email" id="reg_email1" value="">
						</p>			
							<p class="form-row form-row-wide">
								<label for="reg_password">Password <span class="required">*</span></label>
								<input type="password" class="input-text" name="password" id="reg_password1">
							</p>

							<p class="form-row form-row-wide">

							<label for="password">Confirm Password <span class="required">*</span></label>

							<input class="input-text" type="password" name="password1" id="password1">

						</p>
						<div style="left: -999em; position: absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1"></div>						
						<p class="form-row">
							<input type="hidden" id="_wpnonce" name="_wpnonce" value="70c2c9e9dd"><input type="hidden" name="_wp_http_referer" value="https://artsplus.com/my-account/"></p><div class="errormsg_register"></div>			
							
							<input type="submit" class="button register_btn" name="register" value="Continue">
						<p></p>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php if ( function_exists( 'woocommerce_demo_store' ) ) : ?>
		<?php woocommerce_demo_store(); ?>
	<?php endif ?>
	<?php /* if(is_front_page()): ?>
		<div class="slider">
        	<div id="wrapper">
                <?php echo do_shortcode('[rev_slider alias="Newslider"]'); ?>
            </div>
        </div>
		<?php endif; */ ?>