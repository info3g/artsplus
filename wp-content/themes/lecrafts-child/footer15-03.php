<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tokoo
 */
?>
<?php do_action( 'lecrafts_before_footer' ); ?>	
<div id="footer">
	<div class="top_footer">
    	<div id="wrapper">
            <div class="top_f_left">
                 <?php dynamic_sidebar('sl461_860inl');?>
                <div class="art-delivered-content">                    	
					<?php dynamic_sidebar('sl461_412cyr');?>
				</div>
               
				<div class="art-delivered-content">                    	
					<?php dynamic_sidebar('sl461_556vei');?>
				</div>
               
               <div class="art-delivered-content">                    	
					<?php dynamic_sidebar('sl461_647xlz');?>
				</div>
            </div>
   
            <div class="footer-top-right">          
				   <?php dynamic_sidebar('sl461_727wga');?>  
                  <div class="footer-certification-link"> 
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/paypal.jpg" /></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" /></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/mastercard.jpg" /></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/american.jpg" /></a>
                  </div>
            </div><!-- footer-top-right End -->
        </div>
    </div><!-- Top-Footer End -->
    
	<div class="bottom_foot">
    	<div id="wrapper">
			<div class="footer-bottom-SocialMedia">
				<?php dynamic_sidebar('Newfooter1');?>
			</div>
				  
			<div class="footer-bottom-CompanyLink">
				<?php dynamic_sidebar('Newfooter2');?>
			</div>
				
			<div class="footer-bottom-CompanyLink margin15">
				<?php dynamic_sidebar('Newfooter3');?>
			</div>
				
			<div class="footer-address">
			<?php dynamic_sidebar('Newfooter4');?>
			</div>
				
			<div class="footer-bottom-LearnMore">
			   <?php dynamic_sidebar('Newfooter5');?>
			</div>
        </div>
    </div>
</div><!-- Footer End -->
	<div class="overlay-smith" style="display:none"></div>
	<div id="popupcontainer" style="display:none">
		<div id="popup-window">
			<div class="popup-wrap">
		<h2><img src="https://artsplus.com/wp-content/themes/lecrafts-child/images/welcometoart.jpg" alt="Artsplus"/></h2>
		<p>Receive advance access to hundreds of new works each week and the latest art world stories in your inbox.</p>
		<h3>PLUS RECEIVE 10% OFF YOUR  FIRST PURCHASE</h3>
			<?php echo do_shortcode('[mc4wp_form id="1640"]'); ?>
			</div>
		</div>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<div class="modal fade" id="popuppostalcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<a href="https://artsplus.com/dashboard/products/"><button type="button" id="popup-close-btn" ><i class="fa fa-times" aria-hidden="true"></i></button></a>
								 <h4 class="modal-title" id="myModalLabel"> Welcome! You must add price and description to each art piece that is submitted. Thank you!</h4>
							</div>
							<div class="modal-footer"> 
								<button type="button" id="close-rate" data-dismiss="modal" style="display:none;">Close</button> 
							</div>
						</div>
					</div>
				</div>
	<?php 
	    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		if(($host == 'artsplus.com/dashboard/')&&(is_user_logged_in()))
		{
			$user = new WP_User(get_current_user_id());
			if($user->roles[0]=='Seller'||$user->roles[0]=='seller')
			{
				// $user_seller_id=get_current_user_id();
				// $params = array('orderby' =>  'post_date' , 'order' => 'ASC' , 'post_type' => 'product', 'author' =>  $user_seller_id,);
                // $wc_query = new WP_Query($params);
				// if ($wc_query->have_posts()){ 
					// while ($wc_query->have_posts())
					// {
						// $wc_query->the_post(); 
						// the_content();
					// } 
					// wp_reset_postdata(); 
				// }	
				// else
				// {  
					// echo "no data";
				// }	
	?>				
				
				<!-- Pop up(Bootstrap modal) shown when Artist Login     -->
				<!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
				
				<div class="modal fade" id="popuppostalcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<a href="https://artsplus.com/dashboard/products/"><button type="button" id="popup-close-btn" ><i class="fa fa-times" aria-hidden="true"></i></button></a>
								 <h4 class="modal-title" id="myModalLabel"> Welcome! You must add price and description to each art piece that is submitted. Thank you!</h4>
							</div>
							<div class="modal-footer"> 
								<button type="button" id="close-rate" data-dismiss="modal" style="display:none;">Close</button> 
							</div>
						</div>
					</div>
				</div>
				<script>
					jQuery(document).ready(function(){
						jQuery('.overlay-smith').css('display','block');
						jQuery('#popuppostalcode').modal('show');
						jQuery('#popup-close-btn').click(function()
						{   
							jQuery('.overlay-smith').css('display','none');
							jQuery('#popuppostalcode').css('display','none');
						});
					});	
				</script>
	<?php
			} //End If user is "Seller(Artist)"
		} //End If page and user login condition
	?>
<?php 
	  $display_sidebar_shop 	= get_theme_mod( 'tokoo_display_shop_page_sidebar' );
	if ( class_exists( 'WooCommerce' ) && ( is_shop() ) && false == $display_sidebar_shop ) {
	tokoo_maybe_has_sidebar( 'shop' );
	} else {
		tokoo_maybe_has_sidebar( 'primary' ); 
	}
	

?>
 <?php 
$theme_mods_lecrafts = get_option( 'theme_mods_lecrafts' );
$shop_page_display= $theme_mods_lecrafts['tokoo_product_per_page'];
?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/owl.carousel.min.js" type="text/javascript" defer></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.firstVisitPopup.min.js" type="text/javascript" defer></script>
    <script>
	 jQuery(document).ready(function(){ 
		jQuery(".contact_op").change(function(){
        jQuery(this).find("option:selected").each(function(){
            if(jQuery(this).attr("value")=="red"){
                jQuery(".box").not(".red").hide();
                jQuery(".red").show();
            }
            else if(jQuery(this).attr("value")=="green"){
                jQuery(".box").not(".green").hide();
                jQuery(".green").show();
            }
            else if(jQuery(this).attr("value")=="blue"){
                jQuery(".box").not(".blue").hide();
                jQuery(".blue").show();
            }
            else{
                jQuery(".box").hide();
            }
        });
    }).change();
		jQuery('#popupcontainer').firstVisitPopup({
			cookieName : 'homepage'
		});
		jQuery(".featured_products .products-holder").owlCarousel({
			 items : 4,
			 autoPlay:false,
			 nav: true,
			 loop: true,
			 responsiveClass:true,
			 responsive : {
			    // breakpoint from 0 up
			    0 : {
			       items:1,
			    },
			     // breakpoint from 480 up
			    480 : {
			         items:2,
			    },
			    // breakpoint from 767 up
			    767 : {
			         items:3,
			    },
			    // breakpoint from 991 up
			    991 : {
			       items:4,
		            loop:false
			    }
			}
		});
		jQuery(".woocommerce-MyAccount-navigation ul li:nth-child(4n)").add('ul li:last').after('<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--fav_list"><a href="https://artsplus.com/my-account/wishlist/">Favorites</a></li>');
		jQuery(".woocommerce-MyAccount-navigation ul li:nth-child(5n)").add('ul li:last').after('<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--follow"><a href="https://artsplus.com/my-account/following-artists/">Following Artists</a></li>');
		var url      = window.location.href; 
		var lasturl = url.split('/');
		var lurl = lasturl[lasturl.length - 2];
		if(lurl =='wishlist'){
			jQuery('.woocommerce-MyAccount-navigation-link--fav_list').addClass('is-active');
		}
		if(lurl=='following-artists'){
			jQuery('.woocommerce-MyAccount-navigation-link--follow').addClass('is-active');
			jQuery('.woocommerce-MyAccount-navigation-link--dashboard').removeClass('is-active');
		}
		var page = 2;
		jQuery( document ).on( 'click', '.loadmore', function () {
			jQuery(this).text('Loading...');
			  jQuery.ajax({
				url: window.location.href+'page/'+page,
				type: 'GET',
				data: {
				  page:jQuery(this).data('page'),
				},
				success: function(response){
					var success =  jQuery(jQuery.parseHTML(response)).find(".products-holder"); 
					page=page+1;
					jQuery(".products-holder").append(success);
					jQuery('.loadmore').text('Load More');
				}
			  });
		});
		var min_width = jQuery(".size-width #price-min").val();
		var max_width = jQuery(".size-width #price-max").val();
		jQuery('.width_value').text(min_width+'"- '+max_width+'"');
		var min_height = jQuery(".size-height #price-min").val();
		var max_height = jQuery(".size-height #price-max").val();
		jQuery('.height_value').text(min_height+'"- '+max_height+'"');
		var count_val = jQuery(".woocommerce-result-count").html();
		jQuery('.count_val').html(count_val);
		jQuery(".size-width #price-min").change(function (){
			
		});
		jQuery(".size-width #price-max").change(function (){
			var max_width = jQuery(".size-width #price-max").val();
			console.log(max_width);
		});
	 /* upload image form validation */
	  jQuery("#multi_image1").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file1').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium1').val() == '' || jQuery('.medium1').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width1').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height1').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth1').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year1').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							jQuery('#multi_image1').hide();
							alert('One(1) image uploaded successfully.');
							location.reload();	 
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	 jQuery("#multi_image2").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file2').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium2').val() == '' || jQuery('.medium2').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width2').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height2').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth2').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year2').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log(data);
						//console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							alert('Two(2) image uploaded successfully.');
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image3").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file3').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium3').val() == '' || jQuery('.medium3').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width3').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height3').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth3').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year3').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							alert('Three(3) images uploaded successfully.');
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image4").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file4').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium4').val() == '' || jQuery('.medium4').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width4').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height4').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth4').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year4').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
						    alert('Only one step away.');
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image5").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file5').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium5').val() == '' || jQuery('.medium5').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width5').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height5').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth5').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year5').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							alert('You can submit now.');
							location.reload();	
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image6").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file6').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium6').val() == '' || jQuery('.medium6').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width6').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height6').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth6').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year6').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image7").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file7').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium7').val() == '' || jQuery('.medium7').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width7').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height7').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth7').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year7').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							location.reload();
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image8").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file8').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium8').val() == '' || jQuery('.medium8').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width8').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height8').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth8').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year8').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image9").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file9').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium9').val() == '' || jQuery('.medium9').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width9').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height9').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth9').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year9').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	  jQuery("#multi_image10").on('submit',(function(e) {
		e.preventDefault();
		var isValid = true;
			jQuery('.errormsg').html('');
			if (jQuery('#file10').val() == '') {
				jQuery('.errormsg').append('<li>Please Upload Image.</li>');
				isValid = false;
			}
			if (jQuery('.medium10').val() == '' || jQuery('.medium10').val()== 0) {
				jQuery('.errormsg').append('<li>Please Select Medium.</li>');
				isValid = false;
			}
			if (jQuery('.width10').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter width.</li>');
				isValid = false;
			} 
			if (jQuery('.height10').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Height.</li>');
				isValid = false;
			} 
			if (jQuery('.depth10').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Depth.</li>');
				isValid = false;
			}
			if (jQuery('.year10').val() == '') {
				jQuery('.errormsg').append('<li>Please Enter Year.</li>');
				isValid = false;
			}
			jQuery('.errormsg').show();
			if(isValid){
				jQuery.ajax({
					url: "<?php echo get_stylesheet_directory_uri(); ?>/ajax_php_file.php", 
					type: "POST",      
					data: new FormData(this), 
					contentType: false,      
					cache: false,             
					processData:false,        
					success: function(data)  
					{
						console.log( jQuery.trim(data) );
						if( jQuery.trim(data) === "success" )
						{
							location.reload();
						}
						else if(jQuery.trim(data)=== 'Invalid'){
							jQuery('.errormsg').append("<li>Invalid file Size or Type.</li>");
						}
					}
				});
			}
			
	 }));
	 
		/* apply to exibit validation */
		 jQuery('#form1_submit').click(function(e){
			e.preventDefault();
			var isValid = true;
			jQuery('.errormsgs').html('');
			if (jQuery('.fname').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter First Name.</li>');
				isValid = false;
			}
			if (jQuery('.lname').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Last Name.</li>');
				isValid = false;
			}
			if (jQuery('.country').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Country.</li>');
				isValid = false;
			} 
			if (jQuery('.address').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Address.</li>');
				isValid = false;
			} 
			if (jQuery('.city').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter City.</li>');
				isValid = false;
			}
			if (jQuery('.state').val() == '0' || jQuery('.state').val() == '' ) {
				jQuery('.errormsgs').append('<li>Please Enter State.</li>');
				isValid = false;
			} 
			if (jQuery('.zip_code').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Zip code.</li>');
				isValid = false;
			} 
			if (jQuery('#email').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter email.</li>');
				isValid = false;
			}
			if (jQuery('#cemail').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Confirm Email.</li>');
				isValid = false;
			}
			if (jQuery('.phone').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Phone No.</li>');
				isValid = false;
			} 
			if (jQuery('.pass').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter password.</li>');
				isValid = false;
			} 
			if (jQuery('.confirm-cpass').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter Confirm password.</li>');
				isValid = false;
			}
			if (jQuery('.dob').val() == '') {
				jQuery('.errormsgs').append('<li>Please Enter DOB.</li>');
				isValid = false;
			}
			if (jQuery('.hear').val() == ''|| jQuery('.hear').val() == '0') {
				jQuery('.errormsgs').append('<li>Please Enter Referral.</li>');
				isValid = false;
			} 
			if (((jQuery('.pass').val() != '') && (jQuery('.confirm-cpass').val() != ''))&& ((jQuery('.confirm-cpass').val() != jQuery('.pass').val()))) {
				jQuery('.errormsgs').append('<li>MisMatch password.</li>');
				isValid = false;
			}
			if (((jQuery('#email').val() != '') && (jQuery('#cemail').val() != ''))&& ((jQuery('#cemail').val() != jQuery('#email').val()))) {
				jQuery('.errormsgs').append('<li>MisMatch Email.</li>');
				isValid = false;
			}
			jQuery('.errormsgs').show();
			if( isValid )
			{
				var fname 		= jQuery('.fname').val();
				var lname 		= jQuery('.lname').val();
				var country 	= jQuery('.country :selected').attr('shortname');
				var address 	= jQuery('.address').val();
				var address1 	= jQuery('.address1').val();
				var city 		= jQuery('.city').val();
				var state 		= jQuery('.state :selected').html();
				var zip_code 	= jQuery('.zip_code').val();
				var email 		= jQuery('#email').val();
				var phone 		= jQuery('.phone').val();
				var pass 		= jQuery('.pass').val();
				var dob 		= jQuery('.dob').val();
				var hear 		= jQuery('.hear').val();
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php',
					data : {'urls':'validation','fname':fname,'lname':lname, 'country':country, 'address':address, 'address1': address1, 'city':city, 'state':state,'zip_code': zip_code,'email':email,'phone':phone,'pass':pass,'dob':dob,'hear':hear},
					success: function( data ){
							console.log( jQuery.trim(data) );
							if( jQuery.trim(data) === "error" )
							{
								jQuery('.errormsgs').append('<li>Email Address Already Exist.</li>');
								jQuery('.errormsgs').show();
							}else{
								jQuery('.step__1').hide();
								jQuery('.step__2').show();	 	
							}
										
					}
				});
			} 
		});
			jQuery('a.filter_my').click(function(){
				jQuery('.filter_options').toggleClass('active');
				jQuery(this).toggleClass('is-active');
			});
			jQuery(".main-content .sidebar-left h3").click(function(){
				jQuery(this).toggleClass("active");
				jQuery(this).next('div').slideToggle();
			});
			jQuery('#delete1').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete1=delete1',
					success: function(data){
						$('.artworks1').hide();
						$('#multi_image1').show();
					}
				});
					
			});
			jQuery('#delete2').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete2=delete2',
					success: function(data){
						$('.artworks2').hide();
						$('#multi_image2').show();
					}
				});
					
			});
			jQuery('#delete3').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete3=delete3',
					success: function(data){
						$('.artworks3').hide();
						$('#multi_image3').show();
					}
				});
					
			});
			jQuery('#delete4').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete4=delete4',
					success: function(data){
						$('.artworks4').hide();
						$('#multi_image4').show();
					}
				});
					
			});
			jQuery('#delete5').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete5=delete5',
					success: function(data){
						$('.artworks5').hide();
						$('#multi_image5').show();
					}
				});
					
			});
			jQuery('#delete6').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete6=delete6',
					success: function(data){
						$('.artworks6').hide();
						$('#multi_image6').show();
					}
				});
					
			});
			
			
			jQuery('#delete7').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete7=delete7',
					success: function(data){
						$('.artworks7').hide();
						$('#multi_image7').show();
					}
				});
					
			});
			jQuery('#delete8').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete8=delete8',
					success: function(data){
						$('.artworks8').hide();
						$('#multi_image8').show();
					}
				});
					
			});
			jQuery('#delete9').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete9=delete9',
					success: function(data){
						$('.artworks9').hide();
						$('#multi_image9').show();
					}
				});
					
			});
			jQuery('#delete10').click(function(){
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?delete10=delete10',
					success: function(data){
						$('.artworks10').hide();
						$('#multi_image10').show();
					}
				});
					
			});
	 var author_title = jQuery('.author_title').html();
	 jQuery('.author-name').hide();
	 jQuery('.author-name input').val(author_title);
	 //alert(jQuery('.author-name input').val());
		 jQuery( ".scountry" ).change(function() {
				var s_country = jQuery( ".scountry option:selected" ).val();
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?country='+s_country,
					success: function(data) {
						console.log(data);
							jQuery(".s_state").append(data);
					}						
				});
			});
			jQuery('.s_state').change(function(){	
				var s_state = jQuery( ".s_state option:selected" ).val();
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?state='+s_state,
					success: function(data) {
						console.log(data);
						jQuery(".s_school").append(data);
					}
				});
			}); 
			
			jQuery('.body_upper').click(function(){
				jQuery('.body_upper').hide();
			});
			
		jQuery('#menu-user-menu  li a').attr("href", "javascript:void(0);");
		 jQuery('.body_upper').hide();
		jQuery('#menu-item-1582 a').click(function(){
			jQuery('#customer_l_section').css('transform','translate3d(0px, 0px, 0px)');
			jQuery( "#customer_l_section" ).addClass( "slider_box" );
			jQuery('.mc').show();
			jQuery('.artist_text').show();
			jQuery('.body_upper').show();
			jQuery('.customer_text').hide();
		});
		jQuery('#CreateAccount a').click(function(){
			jQuery('#customer_s_section').css('transform','translate3d(0px, 0px, 0px)');
			jQuery( "#customer_s_section" ).addClass( "slider_box" );
			jQuery('.mc').show();
			
			jQuery('#customer_l_section').css('transform','translate3d(100%, 0px, 0px)');
		});
		jQuery('#menu-item-1581 a').click(function(){
			jQuery('#customer_l_section').css('transform','translate3d(0px, 0px, 0px)');
			jQuery( "#customer_l_section" ).addClass( "slider_box" );
			jQuery('.mc').show();
			jQuery('.artist_text').hide();
			jQuery('.body_upper').show();
			jQuery('.customer_text').show();
			jQuery('#customer_s_section').css('transform','translate3d(100%, 0px, 0px)');
		});
		
		
	 
	jQuery(document).mouseup(function (e)
	{
	//alert(0)
		var container = jQuery("#menu-item-1581");
		if (!container.is(e.target) && container.has(e.target).length === 0)
		{
		//alert(2);
			var login_div = jQuery('#customer_l_section');
			if (!login_div.is(e.target) && login_div.has(e.target).length === 0) {
				//jQuery('#customer_l_section').hide();
				//alert(3);
				jQuery('#customer_l_section').css('transform','translate3d(100%, 0px, 0px)');
				jQuery( "#customer_l_section" ).removeClass( "slider_box" );
				
				jQuery('.mc').hide();
			}
		}
		else{
		//alert(4);
			jQuery('#customer_l_section').css('transform','translate3d(0, 0px, 0px)');
			jQuery( "#customer_l_section" ).addClass( "slider_box" );
			jQuery('.mc').show();
		}
		
		/*  create account*/
		var container = jQuery("#CreateAccount");
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			var login_div = jQuery('#customer_s_section');
			if (!login_div.is(e.target) && login_div.has(e.target).length === 0) {
				jQuery('#customer_s_section').css('transform','translate3d(100%, 0px, 0px)');
				jQuery( "#customer_s_section" ).removeClass( "slider_box" );
				
				jQuery('.mc').hide();
			}
		}
		else{
			jQuery('#customer_s_section').css('transform','translate3d(0px, 0px, 0px)');
			jQuery( "#customer_s_section" ).addClass( "slider_box" );
			jQuery('.mc').show();
		}
		/* artist login */
		var container = jQuery("#artist_login");
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			var login_div = jQuery('#customer_l_section');
			if (!login_div.is(e.target) && login_div.has(e.target).length === 0) {
				jQuery('#customer_l_section').css('transform','translate3d(100%, 0px, 0px)');
				jQuery( "#customer_l_section" ).removeClass( "slider_box" );
			
				jQuery('.mc').hide();
			}
		}
		else{
			jQuery('#customer_l_section').show();
			jQuery( "#customer_l_section" ).addClass( "slider_box" );
			jQuery('.mc').show();
		}
	});
	
	jQuery('#login').click(function(e){
		e.preventDefault();
		var isValid = true;
		jQuery('#UlArtistErrorMsg').html('');
		if (jQuery('#username').val() == '') {
			jQuery('#UlArtistErrorMsg').append('<li>Please enter email address.</li>');
			isValid = false;
		}
		if (jQuery('#password').val() == '') {
			jQuery('#UlArtistErrorMsg').append('<li>Please enter password.</li>');
			isValid = false;
		}
	
	if(isValid)
	{
		 var userName = jQuery('#username').val();
		 var pass=  jQuery('#password').val();
		 jQuery(".woo_user").val(userName);
		 jQuery(".woo_pass").val(pass);
		/*  alert(jQuery('.woo_pass').val());
		 alert(jQuery('.woo_user').val()); */
		  jQuery.ajax({
			type: "POST",
			url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?userName='+ userName+'&pass='+pass,
			success: function(data) {
				console.log(data);
				jQuery('#UlArtistErrorMsg').append('<li>'+data+'</li>');
				jQuery("#UlArtistErrorMsg").show();
			}
		});   
	}
	else
	{
		jQuery("#UlArtistErrorMsg").show();
	}
	});
	jQuery('.register_btn').click(function(e){
		e.preventDefault();
		var isValid = true;
		jQuery('.errormsg_register').html('');
		if (jQuery('#fistname').val() == '') {
			jQuery('.errormsg_register').append('<li>Please enter First Name.</li>');
			isValid = false;
		}
		if (jQuery('#lastname').val() == '') {
			jQuery('.errormsg_register').append('<li>Please enter Last Name.</li>');
			isValid = false;
		}
		if (jQuery('#reg_email1').val() == '') {
			jQuery('.errormsg_register').append('<li>Please enter Email.</li>');
			isValid = false;
		}
		if (jQuery('#reg_password1').val() == '') {
			jQuery('.errormsg_register').append('<li>Please enter password.</li>');
			isValid = false;
		}
		if (jQuery('#password1').val() == '') {
			jQuery('.errormsg_register').append('<li>Please enter Confirm password.</li>');
			isValid = false;
		}
		if (((jQuery('#password1').val() != '') && (jQuery('#reg_password1').val() != ''))&& ((jQuery('#reg_password1').val() != jQuery('#password1').val()))) {
			jQuery('.errormsg_register').append('<li>MisMatch password.</li>');
			isValid = false;
		} 
	
	if(isValid)
	{
		
		 var fistname = jQuery('#fistname').val();
		 var lastname =  jQuery('#lastname').val();
		 var email =  jQuery('#reg_email1').val();
		 var pass =  jQuery('#reg_password1').val();
		 jQuery(".woo-reg_emil").val(email);
		 jQuery(".woo-pass").val(pass);
		 
		 
		// alert(fistname);
		 //alert(lastname);
		 //alert(email);
		 //alert(pass); 
		 jQuery.ajax({
			type: "POST",
			url: '<?php echo get_stylesheet_directory_uri(); ?>/login_ajax.php?fistname='
			+fistname+'&lastname='+ lastname+'&email='+email+'&pass='+pass,
			success: function(data) {
				jQuery('.errormsg_register').append('<li>'+data+'</li>');
				jQuery(".errormsg_register").show();
			}
		}); 
	}
	else
	{
		jQuery(".errormsg_register").show();
	}
	});
	
	jQuery(".overlay-smith").click( function() {
		jQuery('.thankyou').hide();
		jQuery('.overlay-smith').hide();
	});
	
	jQuery('.ui-collapsible:nth-child(1) > h3, .ui-collapsible:nth-child(2) > h3, .ui-collapsible:nth-child(3) > h3').trigger('click');
	
	
	var checker = document.getElementById('agree');
	var sendbtn = document.getElementById('submit_data');
	 // when unchecked or checked, run the function
	checker.onchange = function(){
		if(this.checked){
			sendbtn.disabled = false;
			sendbtn.setAttribute("class", "");
		} else {
			sendbtn.disabled = true;
			sendbtn.setAttribute("class", "submit_data_term");
		}

	}

	
});
	function filter_product(){
		var subject = jQuery('input[name=subject]:checked').map(function()
		{
			return jQuery(this).val();
		});
		
		var subjects = JSON.stringify(subject.get());
		//console.log(subjects);
		var medium = jQuery('input[name=medium]:checked').map(function()
		{
			return jQuery(this).val();
		});
		var mediums = JSON.stringify(medium.get());
		var style = jQuery('input[name=style]:checked').map(function()
		{
			return jQuery(this).val();
		});
		var styles = JSON.stringify(style.get());
		var orientation = jQuery('input[name=orientation]:checked').map(function()
		{
			return jQuery(this).val();
		});
		var orientations = JSON.stringify(orientation.get());
		var color = jQuery('input[name=color]:checked').map(function()
		{
			return jQuery(this).val();
		});
		var colors = JSON.stringify(color.get());
		var min_width = jQuery(".size-width #price-min").val();
		var max_width = jQuery(".size-width #price-max").val();
		jQuery('.width_value').text(min_width+'"- '+max_width+'"');
		var min_height = jQuery(".size-height #price-min").val();
		var max_height = jQuery(".size-height #price-max").val();
		jQuery('.height_value').text(min_height+'"- '+max_height+'"');
		var min_price = jQuery('input[name=price]:checked').attr('minval');
		var max_price = jQuery('input[name=price]:checked').attr('maxval');
		var sort_val = jQuery('.orderby').val();
		var parent_cat_id =jQuery('.parent_cat_id').html();
		   jQuery.ajax({
			type: 'POST',
			data: {orientations: orientations,mediums: mediums,styles:styles,subjects:subjects,colors:colors,min_height: min_height,max_height: max_height, min_width: min_width,max_width: max_width,parent_cat_id: parent_cat_id, min_price:min_price, max_price:max_price,sort_val:sort_val},
			url: '<?php echo get_stylesheet_directory_uri(); ?>/filters.php',
			success: function(data) {
				jQuery(".products-holder").html(data); 
				/* jQuery.ajax({
					type: 'POST',
					data: {orientations: orientations,mediums: mediums,styles:styles,subjects:subjects,colors:colors,min_height: min_height,max_height: max_height, min_width: min_width,max_width: max_width,parent_cat_id: parent_cat_id, min_price:min_price, max_price:max_price},
					url: '<?php echo get_stylesheet_directory_uri(); ?>/sidebarfilters.php',
					success: function(data) {
						console.log(data);
						jQuery(".accordion").html(data);
					}	
				});  */
			 }
		});   
	}
	
	 function artist_data(){
			var artlist_letter = jQuery('input[name=artlist_letter]:checked').map(function()
            {
                return jQuery(this).val();
            });
			var alphabets = JSON.stringify(artlist_letter.get());
			/* selected categories of get values medium  */
			var artist_medium = jQuery('input[name=artist_medium]:checked').map(function()
			{
				return jQuery(this).val();
			});
			var mediums = JSON.stringify(artist_medium.get());
			/* selected categories of get values  Style  */
			var artist_style = jQuery('input[name=artist_style]:checked').map(function()
			{
				return jQuery(this).val();
			});
			var styles = JSON.stringify(artist_style.get());
			jQuery.ajax({
					type: 'POST',
					data: {artlist_letter: alphabets,medium: mediums,style:styles},
					url: '<?php echo get_stylesheet_directory_uri(); ?>/filter_topartist.php',
					success: function(data) {
						console.log(data);
						jQuery( ".ajax-users" ).replaceWith('<div id="wrapper" class="ajax-users">'+data+'</div>');
					}						
				});
	} 
	function createwishlist(){
		
	}
	function ArtistFollowPopup(artistid){
		jQuery.ajax({
			type: 'POST',
			data: {artistid: artistid},
			url: '<?php echo get_stylesheet_directory_uri(); ?>/artistfollow.php',
			success: function(data) {
				if(data=='login'){
					 jQuery( "#menu-item-1581 a" ).trigger( "click" );
				}
				else{
					jQuery('.thankyou').show();
					jQuery('.overlay-smith').show();
					jQuery('#btnFollowArtist').replaceWith('<button id="btnunFollowArtist" type="button" style="" onclick="unArtistFollowPopup('+artistid+')" class="follow-artist-btn">Unfollow this Artist</button>'); 
				}
			}						
		});
	}
	
	function closeQuickView(){
		jQuery('.thankyou').hide();
		jQuery('.overlay-smith').hide();
	}
	function unArtistFollowPopup(dartistid){
		 if(confirm("Do you want to delete?")) {
			jQuery.ajax({
				type: 'POST',
				data: {dartistid: dartistid},
				url: '<?php echo get_stylesheet_directory_uri(); ?>/artistfollow.php',
				success: function(data) {
					jQuery('#btnunFollowArtist').replaceWith('<button id="btnFollowArtist" type="button" style="" onclick="ArtistFollowPopup('+dartistid+');" class="follow-artist-btn">Follow this Artist</button>');
				}						
			});
		 }
	}
</script>
<?php wp_footer(); ?>
</body>
</html>
