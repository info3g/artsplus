<?php
ob_start();
session_start();
/* Template Name: Apply */
get_header();
global $wbdb;
if($_GET['success'] ==1){
echo "<script>jQuery(document).ready(function(){ jQuery('.thanks_msg').show(); jQuery('#content').hide(); });</script>";
  $userdata = array(
        'first_name' => $_SESSION['fname'],
        'last_name' => $_SESSION['lname'],
        'display_name' => $_SESSION['fname'].' '.$_SESSION['lname'],
        'user_email' => $_SESSION['email'],
        'user_pass' => $_SESSION['pass'],
        'user_login' => $_SESSION['fname'],
        'user_nicename' => $_SESSION['fname'],
        'role' => 'seller'
    );
	//echo "app";
	//echo "<pre>";
//print_r($userdata);
//echo "</pre>";
$doken_data= array(
	'store_name' => $_SESSION['fname'].' '. $_SESSION['lname'],
	'social'=>array(
		'fb'=> '',
		'gplus'=> '',
		'twitter'=> '',
		'linkedin'=> '',
		'youtube'=> '',
		'instagram'=> '',
		'flickr'=> ''
	),
	'phone'=>$_SESSION['phone'],
	'show_email'=> 'off',
	'address'=>array(
		'street_1'=>$_SESSION['address'],
		'street_2'=>$_SESSION['address1'],
		'city'=>$_SESSION['city'],
		'zip'=>$_SESSION['zip_code'],
		'country'=>$_SESSION['country'],
		'state'=>$_SESSION['state']
	),
	'location'=> '',
	'banner'=> ''
	
);
//echo "<pre>";
//print_r($doken_data);
//echo "</pre>";
 $do_data= maybe_serialize($doken_data);
//print_r($do_data);
    $user_id = wp_insert_user($userdata); 
	$to = $_SESSION['email'];
	$subject = 'Arts-Work Registration';
	$body = 'We have received your application to exhibit your art on ArtsPlus. Your application is under review and we will contact you within 3 – 5 business days. Please add the email address application@artsplus.com to your address book to prevent the response from ending up in your spam folder.
	
	Once approved, you will need to login to your Artwork Dashboard to add pricing and description for each piece of art. 
	';
	$headers = array('Content-Type: text/html; charset=UTF-8');
 
	wp_mail( $to, $subject, $body, $headers );
	
	
	//echo "query=";
	 $querystr = $wpdb->insert( 'wp_usermeta ', array( 'umeta_id' =>'', 'user_id' => $user_id, 'meta_key' => 'dokan_profile_settings', 'meta_value' => $doken_data));
	
    update_user_meta($user_id, 'dokan_profile_settings', $do_data);
    update_user_meta($user_id, 'dokan_enable_selling', 'no');
    update_user_meta($user_id, 'dob', $_SESSION['dob']);
    update_user_meta($user_id, 'hear', $_SESSION['hear']); 
	//echo "session=";
	//echo "<pre>";
	//print_r($_SESSION);
	//echo "</pre>";
	if($_SESSION['websites_info'] != ''){
		update_user_meta($user_id, 'websites_info', $_SESSION['websites_info']);
	}
	if($_SESSION['s_school'] != ''){
		update_user_meta($user_id, 's_school', $_SESSION['s_school']);
	}
	if($_SESSION['artist_statement'] != ''){
		update_user_meta($user_id, 'artist_statement', $_SESSION['artist_statement']);
	}
	if($_SESSION['education'] != ''){
		update_user_meta($user_id, 'education', $_SESSION['education']);
	}
	if($_SESSION['scholcountry'] != 'select country'){
		update_user_meta($user_id, 'scholcountry', $_SESSION['scholcountry']);
	}
	if($_SESSION['scholstate'] != 'select state'){
    update_user_meta($user_id, 'scholstate', $_SESSION['scholstate']);
	}
	if($_SESSION['degree'] != ''){
		update_user_meta($user_id, 'degree', $_SESSION['degree']);
	}
	if($_SESSION['study'] != ''){
		update_user_meta($user_id, 'study', $_SESSION['study']);
	}
	if($_SESSION['graduation_year'] != ''){
		update_user_meta($user_id, 'graduation_year', $_SESSION['graduation_year']); 
	}
     for ($i = 1; $i <= $_SESSION['count']; $i++) {
         $imge_name    = explode('.', $_SESSION['artname'. $i]);
        $imge_name    = explode('.', $_SESSION['artname'. $i]);
        $post_title   = $_SESSION['width' . $i] . '" X ' . $_SESSION['height' . $i] . '", ' . $imge_name[0];
        $postname     = $_SESSION['width' . $i] . '_-x-' . $_SESSION['height' . $i] . '_-' . $imge_name[0];
        $product_info = array(
            'post_title' => $post_title,
            'post_status' => 'draft',
            'post_author' => $user_id,
            'post_type' => 'product',
            'comment_status' => 'open',
            'ping_status' => 'closed',
            'post_name' => $postname,
            'menu_order' => 0
        );
		//$medium = $_SESSION['medium'.$i];
		$product_ID = wp_insert_post($product_info); 
		$filename = '/home/artsplus/public_html'.$_SESSION['artwork'.$i];
		$filetype = wp_check_filetype( basename( $filename ), null );
		$wp_upload_dir = wp_upload_dir();
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		$attach_id = wp_insert_attachment( $attachment, $filename, $product_ID );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		set_post_thumbnail( $product_ID, $attach_id );
		$term = get_term_by('name', $_SESSION['medium'.$i], 'product_cat');
		wp_set_object_terms($product_ID, $term->term_id, 'product_cat');
        
        // add post meta for product values 
        update_post_meta($product_ID, '_visibility', 'visible');
        update_post_meta($product_ID, '_stock_status', 'instock');
        update_post_meta($product_ID, '_thumbnail_id', $attach_id);
        update_post_meta($product_ID, '_width', $_SESSION['width' . $i]);
        update_post_meta($product_ID, '_height', $_SESSION['height' . $i]);
        update_post_meta($product_ID, '_manage_stock', 'no');
        update_post_meta($product_ID, '_backorders', 'no'); 
        update_post_meta($product_ID, '_year', $_SESSION['year' . $i]); 
        
        
    } 
 
	session_destroy();
	
}
 else if($_GET['success'] == 0 && $GET['Pending']){
	session_destroy();
	echo '<pre>';
	print_r($_SESSION);
} 
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
if (isset($_REQUEST['step__3'])) {
?>
	<script>jQuery(document).ready(function(){
				//alert(0);
				jQuery('.step__1').hide();
				jQuery('.step__2').hide();
				jQuery('.step__3').show();
			});</script>
	<?php
    if (isset($_POST['submit_step2'])) {
		if(isset($_POST['websites_info'])){
			$_SESSION['websites_info']    = $_POST["websites_info"];
		}
		if(isset($_POST['artist_statement'])){
			$_SESSION['artist_statement']    = $_POST["artist_statement"];
		}
		if(isset($_POST['education'])){
			$_SESSION['education']    = $_POST["education"];
		}
		if(isset($_POST['scholcountry'])){
			$_SESSION['scholcountry']    = $_POST["scholcountry"];
		}
		if(isset($_POST['scholstate'])){
			$_SESSION['scholstate']    = $_POST["scholstate"];
		}
		if(isset($_POST['s_school'])){
			$_SESSION['s_school']    = $_POST["s_school"];
		}
		if((isset($_POST['new_school'])) && $_POST['s_school'] == 'select school'){
			$querystr = $wpdb->insert( 'wp_schoolinfo', array( 'e_country' => $_SESSION['scholcountry'], 'e_state' => $_SESSION['scholstate'], 'e_postal' => '', 'e_city' => '',  'e_address' => '','loc_county' => '','biz_name' => $_POST['new_school']));
			$_SESSION['s_school']    = $_POST["new_school"];
		}
		if(isset($_POST["degree"])){
			$_SESSION['degree']           = $_POST["degree"];
		}
		if(isset($_POST["study"])){
			$_SESSION['study'] = $_POST["study"];
		}
		if(isset($_POST["graduation_year"])){
        $_SESSION['graduation_year'] = $_POST["graduation_year"];
		}
        
    }
    
}
if (!empty($_SESSION["artwork1"]) && isset($_SESSION["width1"]) && isset($_SESSION["height1"]) && isset($_SESSION["depth1"]) && isset($_SESSION["year1"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image1').hide();
	});
	</script>
<?php } 
if (!empty($_SESSION["artwork2"]) && isset($_SESSION["width2"]) && isset($_SESSION["height2"]) && isset($_SESSION["depth2"]) && isset($_SESSION["year2"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image2').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork3"]) && isset($_SESSION["width3"]) && isset($_SESSION["height3"]) && isset($_SESSION["depth3"]) && isset($_SESSION["year3"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image3').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork4"]) && isset($_SESSION["width4"]) && isset($_SESSION["height4"]) && isset($_SESSION["depth4"]) && isset($_SESSION["year4"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image4').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork4"]) && isset($_SESSION["width4"]) && isset($_SESSION["height4"]) && isset($_SESSION["depth4"]) && isset($_SESSION["year4"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image4').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork5"]) && isset($_SESSION["width5"]) && isset($_SESSION["height5"]) && isset($_SESSION["depth5"]) && isset($_SESSION["year5"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image5').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork6"]) && isset($_SESSION["width6"]) && isset($_SESSION["height6"]) && isset($_SESSION["depth6"]) && isset($_SESSION["year6"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image6').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork7"]) && isset($_SESSION["width7"]) && isset($_SESSION["height7"]) && isset($_SESSION["depth7"]) && isset($_SESSION["year7"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image7').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork8"]) && isset($_SESSION["width8"]) && isset($_SESSION["height8"]) && isset($_SESSION["depth8"]) && isset($_SESSION["year8"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image8').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork9"]) && isset($_SESSION["width9"]) && isset($_SESSION["height9"]) && isset($_SESSION["depth9"]) && isset($_SESSION["year9"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image9').hide();
	});
	</script>
<?php }
if (!empty($_SESSION["artwork10"]) && isset($_SESSION["width10"]) && isset($_SESSION["height10"]) && isset($_SESSION["depth10"]) && isset($_SESSION["year10"])){?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#multi_image10').hide();
	});
	</script>
<?php }
if (isset($_POST['submit_data'])) {
   $count = 0;
   //$count = 5;
	if (!empty($_SESSION["artwork1"]) && isset($_SESSION["width1"]) && isset($_SESSION["height1"]) && isset($_SESSION["depth1"]) && isset($_SESSION["year1"])) {
        $count = $count + 1;
    }
    if (!empty($_SESSION["artwork2"]) && isset($_SESSION["width2"]) && isset($_SESSION["height2"]) && isset($_SESSION["depth2"]) && isset($_SESSION["year2"])) {
        $count = $count + 1;
    }
    if (!empty($_SESSION["artwork3"]) && isset($_SESSION["width3"]) && isset($_SESSION["height3"]) && isset($_SESSION["depth3"]) && isset($_SESSION["year3"])) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork4"])) && (isset($_SESSION["width4"])) && (isset($_SESSION["height4"])) && (isset($_SESSION["depth4"])) && (isset($_SESSION["year4"]))) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork5"])) && (isset($_SESSION["width5"])) && (isset($_SESSION["height5"])) && (isset($_SESSION["depth5"])) && (isset($_SESSION["year5"]))) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork6"])) && (isset($_SESSION["width6"])) && (isset($_SESSION["height6"])) && (isset($_SESSION["depth6"])) && (isset($_SESSION["year6"]))) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork7"])) && (isset($_SESSION["width7"])) && (isset($_SESSION["height7"])) && (isset($_SESSION["depth7"])) && (isset($_SESSION["year7"]))) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork8"])) && (isset($_SESSION["width8"])) && (isset($_SESSION["height8"])) && (isset($_SESSION["depth8"])) && (isset($_SESSION["year8"]))) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork9"])) && (isset($_SESSION["width9"])) && (isset($_SESSION["height9"])) && (isset($_SESSION["depth9"])) && (isset($_SESSION["year9"]))) {
        $count = $count + 1;
    }
    if ((!empty($_SESSION["artwork10"])) && (isset($_SESSION["width10"])) && (isset($_SESSION["height10"])) && (isset($_SESSION["depth10"])) && (isset($_SESSION["year10"]))) {
        $count = $count + 1;
    }
	if($count <5){
		echo "<script>alert('Please Add At-least 5 Artwork information');window.location.href='https://artsplus.com/apply-to-exhibit/?step__3';</script>";
		
		
	}
	else{
		$_SESSION['count'] =$count; 
		}
		?>

    <script>
	jQuery(document).ready(function(){
	//alert(0);
		jQuery('.step__3').hide();
		jQuery('.step__2').hide();
		jQuery('.step__1').hide();
		jQuery('.step__4').show();
	});
	</script>
<?php }
?>
<script>
jQuery(document).ready(function(){
	//jQuery('.step__two').hide();
	//jQuery('.step__3').hide();
	jQuery('.country').change(function(){
		var s_country = jQuery(this).val();
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo get_stylesheet_directory_uri(); ?>/getstate.php?country='+ s_country,
			success: function(data) {
				jQuery(".state").html("<option>select state</option>"+data); 
			}
				
		});
	});
});

</script>

<?php
/*  echo "<pre>";
print_r($_SESSION);  */
?>	
<div class="container">
	<div class="thanks_msg" style="display:none">
		<h2>Congratulations!</h2>
		<p>We have received your application to exhibit your art on ArtsPlus. Your application is under review and we will contact you within 3 – 5 business days. Please add the email address <a href="mailto:application@artsplus.com">application@artsplus.com</a> to your address book to prevent the response from ending up in your spam folder.</p>
		<p>Once approved, you will need to login to your Artwork Dashboard to add pricing and description for each piece of art.</p>
	</div>
</div>
<main id="content" class="main-content apply__page">
	<div class="container">
		<div class="page-header">
			<div class="breadcrumb-trail breadcrumbs"></div>
				<h2 class="page-title"><?php echo the_title(); ?></h2>	
		</div>
		<?php echo the_content(); ?>
		<div id="msform">
			<div class="step__1">
				<h3 class="sub__title"><span>Page 1 of 4:</span> Contact Information</br></h3>
				<p>Please note, once you begin the application, you must complete it within one hour. If you exit prior to finishing,</br>
				your information will not be saved.</p>
				<p>Your email and telephone number will be used to notify you when a piece of art has been purchased.</br>
				Your address will be used to mail payment for purchased artwork. </p>
				<div class="errormsgs" style="display:none;"></div>
				<form action="" method="POST" name="contact_info" id="contact_info" runat="server">
					<div class="left__50">
						<label>First Name <span style="color:red;">*</span></label>
						<input type="text" class="fname" name="fname" placeholder="" />
					  
						<label>Last Name <span style="color:red;">*</span></label>
						<input type="text" class="lname" name="lname" placeholder=""  />
					  
						<label>Country <span style="color:red;">*</span></label>
						<select class="country" name="country" >
							<option value="">select country</option>
							<?php
								global $wpdb;
								$querystr = "select * from wp_countries";
								$results  = $wpdb->get_results($querystr, OBJECT);
								foreach ($results as $row) {
									echo "<option value=" . $row->id . " shortname='". $row->sortname ."'>" . $row->name . "</option>";
								}
							?>
						</select>
		  
						<label>Address <span style="color:red;">*</span></label>
						<input type="text" name="address" class="address" placeholder=""  />
						<label>Address 1 </label>
						<input type="text" name="address1" class="address1" placeholder=""/>
		  
						<label>City <span style="color:red;">*</span></label>
						<input type="text" name="city" class="city" placeholder=""  />
	  
						<label>State <span style="color:red;">*</span></label>
						<select class="state" name="state"  >
						  <option value='0'>select state</option>
						</select>
		   
						<label>Zip code <span style="color:red;">*</span></label>
						<input type="text" name="zip_code" class="zip_code" placeholder="Zip code"  />
					</div>
					<div class="right__50">
					  <label>Email Address <span style="color:red;">*</span></label>
					  <input type="email" id="email" class="email" name="email" placeholder="" />
					  
					  <label>Confirm Email Address <span style="color:red;">*</span></label>
					  <input type="email" id="cemail" class="confirm-email" name="email" placeholder="" />
					  
					  <label>Telephone <span style="color:red;">*</span></label>
					  <input type="tel" name="phone" class="phone" placeholder="" />
					  
					  <label>Password <span style="color:red;">*</span></label>
					  <input type="password" class="pass" name="pass" placeholder=""  />
					  
					  <label>Confirm Password <span style="color:red;">*</span></label>
					  <input type="password" class="confirm-cpass" name="cpass" placeholder=""  />
					  
					  <label>Date Of Birth <span style="color:red;">*</span></label>
					  <input type="text" name="dob" class="dob" id="datepicker" placeholder="MM/DD/YY"  />
					  
					  <label>How did you hear about us? <span style="color:red;">*</span></label>
					  <select name="hear" class="hear" >
					  <option value="0">Please Select A Referral</option>
						<option>Arizona Commission on the Arts</option>
						<option>ArtDeadline.com</option>
						<option>Artist Opportunities Monthly</option>
						<option>Artshow.com</option>
						<option>ArtSpring</option>
						<option>ArtSquare</option>
						<option>ArtsWeschester</option>
						<option>Blog</option>
						<option>CAA</option>
						<option>Call for Entries</option>
						<option>Chicago Artists Resource</option>
						<option>Facebook</option>
						<option>Friends/Family</option>
						<option>Google</option>
						<option>Instagram</option>
						<option>Magazine/Newspaper Article</option>
						<option>NYFA</option>
						<option>Other</option>
						<option>Pinterest</option>
						<option>Professional Artist Magazine</option>
						<option>re-title.com</option>
						<option>Television Show</option>
						<option>Twitter</option>
						<option>ArtsPlus Artist</option>
						<option>ArtsPlus Event</option>
						<option>Vermont Arts Council</option>
						<option>Yahoo</option>
					  </select>
					  
					</div>
					<input type="submit" name="submit_next" id="form1_submit" class="next action-button" value="Next Step" />
				</form>
			</div><!-- Step_1 END -->
	<div class="step__2" style="display:none">
	<h3 class="sub__title"><span>Page 2 of 4:</span> Artistic Background</br></h3>
	<form  action="<?php
$_SERVER['PHP_SELF'];
?>?step__3" method="post" name="study_info" id="study_info" runat="server">
      <h3 class="fs-subtitle">The following information helps us build our community of artists.  Please take a moment to fill out your artistic background.  We will contact you from time-to-time useful information.</h3>
      <p>Do you have a personal website or do you currently exhibit your work on another art related site?</p>
	  <label>If yes, please list the address(es) below.</label>
	  <textarea name="websites_info" class="websites_info"></textarea>
	  <label>If you have an artist statement, please paste it here. If you have not prepared an artist statement, you may use the prompts below to tell us about your work.</label>
	  <textarea name="artist_statement" class="artist_statement"></textarea>
	  <label>What is the highest level of art education you have accomplished?</label>
	  <select class="education" name="education" >
		<option value="1">No formal art education</option>
		<option value="2">High school art classes</option>
		<option value="3">Some adult/college art classes</option>
		<option value="4">Undergraduate art degree</option>
		<option value="5">Graduate art degree</option>
	  </select>
	
	  <label style="width:100%;">If you have a degree(s) in art, please list below.</label>
	  <label>School Country</label>
	   <select class="scountry country" name="scholcountry" >
	  <option>select country</option>
	  <?php
global $wpdb;
$querystr = "select e_country from wp_schoolinfo";
$results  = $wpdb->get_results($querystr, OBJECT);
foreach( $results as $key => $row) {
		$e_country[] = $row->e_country;
	}
	$country = array_unique($e_country);
foreach ($country as $key => $val) {
		echo "<option>" . $val."</option>";
	}
?>
	  </select>
	  <label>School state</label>
	  <select class="s_state state" name="scholstate" >
		<option>select state</option>
	  </select>
	  <label>School Name</label>
	  <select class="s_school" name="s_school" >
		<option>select school</option>
	  </select>
	  <label>or Add a New School: </label>
	  <input type="text" class="newschool" name="new_school" />
		<label>Degree:</label>
		<select class="degree" name="degree">
		<option>Please Select</option>
		<option>Associate of Arts</option>
		<option>Bachelor of Architecture</option>
		<option>Bachelor of Arts</option>
		<option>Bachelor of Fine Arts</option>
		<option>Bachelor of Science</option>
		<option>Doctor of Philosophy</option>
		<option>High School Diploma</option>
		<option>Master of Architecture</option>
		<option>Master of Arts</option>
		<option>Master of Fine Arts</option>
		<option>Master of Science</option>
		</select>
		<label>Field of Study:</label>
		<input type="text" name="study" class="study" />
		<label>Graduation Year:</label>
		<input type="text" name="graduation_year" class="graduation_year" />
		<div class="clear"></div>
      <a href="/apply-to-exhibit" class="prevstep">Previous Step</a>
      <input type="submit" name="submit_step2" class="next action-button" value="Next Step" />
    </form>
	</div>
    <div  class="step__3" style="display:none;">
		<h3 class="sub__title"><span>Page 3 of 4:</span> Artwork Information</br></h3>
		<p>As a next step, you must upload a minimum of five (5) pieces of artwork to create your account on ArtsPlus.</p>
		<p>Images must be cropped, well lit, true to color, and in focus. Files must be .jpg or .gif format, and cannot exceed 2MB each. For works on paper and photography, please enter a depth of 0.</p>
		<p>Note: Please upload one (1) image at a time. Once you have provided details for the first artwork, click upload before proceeding the next artwork.</p>
		<div class="errormsg errormsgs" style="display:none">	</div>
		<div class="row artworks artworks1">
			<?php
				// echo "<pre>";
				//print_r($_SESSION); 
				 //echo "</pre>";
				if (!empty($_SESSION['artwork1'])) {
					echo "<span class='art_w_img'> <label>Artwork 1</label><img src='" . $_SESSION['artwork1'] . "' alt='' width='80' height='80' /></span>";
				}
				if (!empty($_SESSION['medium1'])) {
					echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium1']."</p></span>";
				}
				if (!empty($_SESSION['width1'])) {
					echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width1'] . " inches</p></span>";
				}
				if (!empty($_SESSION['height1'])) {
					echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height1'] . " inches</p></span>";
				}
				if (!empty($_SESSION['depth1'])) {
					echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth1'] . " inches</p></span>";
				}
				/* else{
					echo "<span class='art_depth'><label>depth: </label><p>0 inches</p></span>";
				} */
				if (!empty($_SESSION['year1'])) {
					echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year1']."</p></span>";
					echo "<div class='delete' id='delete1'>Delete</div>";
				}
			?>
		</div>
		<form enctype="multipart/form-data" id="multi_image1" action ="" novalidate name="multi_image1" method='POST'>
			<div class="artwork artwork-1st">
				<div class="file_div">
					<label>Artwork 1</label>
					<input type="file" name="file1" id="file1">
				</div>
				<div class="select-form">
					<label>Medium</label>
					<select class="medium1" name="medium1">
						<?php
							$args = array(
								'number'     => $number,
								'orderby'    => $orderby,
								'order'      => $order,
								'hide_empty' => $hide_empty,
								'include'    => $ids,
								'parent'     => 102,
								'orderby'    => 'name',
								'order'      => 'ASC'
							);
							$product_categories = get_terms( 'product_cat', $args );
							echo "<option value='0'>Please Select</option>";
							foreach( $product_categories as $cat ) {
								echo "<option>" . $cat->name. "</option>";
							}//end foreach
						?>
					</select>
				</div>
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="width1" placeholder="width" class="width1" />
				<div class="file_div">
				 <label>(In Inches)</label>
				</div>
				<input type="text" name="height1" placeholder="Height" class="height1" />
				<div class="file_div">
				 <label>(In Inches)</label>
				</div>
				<input type="text" name="depth1" placeholder="depth" class="depth1" />
				<!--input type="text" name="year1" placeholder="year" class="year1" /-->
				<div class="file_div">
					<label>Year</label>
				</div>
				<select id="year1" name="year1" class="year1">
				  <?php
				  for($i = 2000; $i < date("Y")+1; $i++){
					  echo '<option value="'.$i.'">'.$i.'</option>';
				  }
				  ?>
				</select>
				<input type="submit" name='submit_image1' id="submit_image1" class="btn btn-lg btn-primary" value="Upload">
			</div><!-- First row Div END-->
		</form>
		<div class="row artworks artworks2">
			<?php
				/* echo "<pre>";
				print_r($_SESSION); */
				if (!empty($_SESSION['artwork2'])) {
					echo "<span class='art_w_img'> <label>Artwork 2</label><img src='" . $_SESSION['artwork2'] . "' alt='' width='80' height='80' /></span>";
				}
				if (!empty($_SESSION['medium2'])) {
					echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium2']."</p></span>";
				}
				if (!empty($_SESSION['width2'])) {
					echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width2'] . " inches</p></span>";
				}
				if (!empty($_SESSION['height2'])) {
					echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height2'] . " inches</p></span>";
				}
				if (!empty($_SESSION['depth2'])) {
					echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth2'] . " inches</p></span>";
				}
				if (!empty($_SESSION['year2'])) {
					echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year2']."</p></span>";
					echo "<div class='delete' id='delete2'>Delete</div>";
				}
			?>
		</div>
		<form enctype="multipart/form-data" id="multi_image2" action ="" novalidate name="multi_image2" method='POST'>
			<div class="artwork artwork-2st">
				<div class="file_div">
					<label>Artwork 2</label>
					 <input type="file" name="file2" required>
				</div>
				<div class="select-form">
					<label>Medium</label>
					<select class="medium2" name="medium2">
						<?php
							$args = array(
								'number'     => $number,
								'orderby'    => $orderby,
								'order'      => $order,
								'hide_empty' => $hide_empty,
								'include'    => $ids,
								'parent'     => 102,
								'orderby'    => 'name',
								'order'      => 'ASC'
							);
							$product_categories = get_terms( 'product_cat', $args );
							echo "<option>Please Select</option>";
							foreach( $product_categories as $cat ){
								echo "<option>" . $cat->name. "</option>"; 
							}
						?>
					</select>
				</div>
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="width2" placeholder="width" class="width2" />
				<div class="file_div">
				 <label>(In Inches)</label>
				</div>
				<input type="text" name="height2" placeholder="Height" class="height2" />
				<div class="file_div">
				 <label>(In Inches)</label>
				</div>
				<input type="text" name="depth2" placeholder="depth" class="depth2" />
				<!--input type="text" name="year2" placeholder="year" class="year2" /-->
				<div class="file_div">
				 <label>Year</label>
				</div>
				<select id="year2" name="year2" class="year1">
				  <?php
				  for($i = 2000; $i < date("Y")+1; $i++){
					  echo '<option value="'.$i.'">'.$i.'</option>';
				  }
				  ?>
				</select>
				<input type="submit" name='submit_image2' class="btn btn-lg btn-primary" value="Upload">
			</div>
		</form>
	<div class="row artworks">
	    <?php
			/* echo "<pre>";
			print_r($_SESSION); */
			if (!empty($_SESSION['artwork3'])) {
				echo "<span class='art_w_img'> <label>Artwork 3</label><img src='" . $_SESSION['artwork3'] . "' alt='' width='80' height='80' /></span>";
			}
			if (!empty($_SESSION['medium3'])) {
				echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium3']."</p></span>";
			}
			if (!empty($_SESSION['width3'])) {
				echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width3'] . " inches</p></span>";
			}
			if (!empty($_SESSION['height3'])) {
				echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height3'] . " inches</p></span>";
			}
			if (!empty($_SESSION['depth3'])) {
				echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth3'] . " inches</p></span>";
			}
			if (!empty($_SESSION['year3'])) {
				echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year3']."</p></span>";
				echo "<div class='delete' id='delete3'>Delete</div>";
			}
		?>
    </div>
	<form enctype="multipart/form-data" id="multi_image3" action ="" novalidate name="multi_image3" method='POST'>
		<div class="artwork artwork-3st">
			<div class="file_div">
				<label>Artwork 3</label>
				<input type="file" name="file3" required>
			</div>
			<div class="select-form">
				<label>Medium</label>
				<select class="medium3" name="medium3">
					<?php
					/* $terms = get_terms("pa_medium");
					foreach ($terms as $term) {
						echo "<option>" . $term->name . "</option>";
					} */
					$args = array(
						'number'     => $number,
						'orderby'    => $orderby,
						'order'      => $order,
						'hide_empty' => $hide_empty,
						'include'    => $ids,
						'parent'     => 102,
						'orderby'    => 'name',
						'order'      => 'ASC'
					);

					$product_categories = get_terms( 'product_cat', $args );
					echo "<option>Please Select</option>";
					foreach( $product_categories as $cat ){
						echo "<option>" . $cat->name. "</option>";
					}
					?>
				</select>
			</div>
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="width3" placeholder="width" class="width3" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="height3" placeholder="Height" class="height3" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="depth3" placeholder="depth" class="depth3" />
			<!--input type="text" name="year3" placeholder="year" class="year3" /-->
			<div class="file_div">
				<label>Year</label>
			</div>
			<select id="year3" name="year3" class="year1">
			  <?php
			  for($i = 2000; $i < date("Y")+1; $i++){
				  echo '<option value="'.$i.'">'.$i.'</option>';
			  }
			  ?>
			</select>
			<input type="submit" name='submit_image3' class="btn btn-lg btn-primary" value="Upload">
		</div>
	</form>
	<div class="row artworks">
	    <?php
			/* echo "<pre>";
			print_r($_SESSION); */
			if (!empty($_SESSION['artwork4'])) {
				echo "<span class='art_w_img'> <label>Artwork 4</label><img src='" . $_SESSION['artwork4'] . "' alt='' width='80' height='80' /></span>";
			}
			if (!empty($_SESSION['medium4'])) {
				echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium4']."</p></span>";
			}
			if (!empty($_SESSION['width4'])) {
				echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width4'] . " inches</p></span>";
			}
			if (!empty($_SESSION['height4'])) {
				echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height4'] . " inches</p></span>";
			}
			if (!empty($_SESSION['depth4'])) {
				echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth4'] . " inches</p></span>";
			}
			if (!empty($_SESSION['year4'])) {
				echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year4']."</p></span>";
				echo "<div class='delete' id='delete4'>Delete</div>";
			}
		?>
    </div>
	<form enctype="multipart/form-data" id="multi_image4" action ="" novalidate name="multi_image4" method='POST'>
		<div class="artwork artwork-4st">
			<div class="file_div">
				<label>Artwork 4</label>
				<input type="file" name="file4" required>
			</div>
			<div class="select-form">
				<label>Medium</label>
				<select class="medium4" name="medium4">
					<?php
						/* $terms = get_terms("pa_medium");
						foreach ($terms as $term) {
							echo "<option>" . $term->name . "</option>";
						} */
						$args = array(
							'number'     => $number,
							'orderby'    => $orderby,
							'order'      => $order,
							'hide_empty' => $hide_empty,
							'include'    => $ids,
							'parent'     => 102,
							'orderby'    => 'name',
							'order'      => 'ASC'
						);

						$product_categories = get_terms( 'product_cat', $args );

						echo "<option>Please Select</option>";
						foreach( $product_categories as $cat ) {
							echo "<option>" . $cat->name. "</option>";
						}
					?>
				</select>
			</div>
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="width4" placeholder="width" class="width4" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="height4" placeholder="Height" class="height4" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="depth4" placeholder="depth" class="depth4" />
			<!--input type="text" name="year4" placeholder="year" class="year4" /-->
			<div class="file_div">
				<label>Year</label>
			</div>
			<select id="year4" name="year4" class="year1">
				  <?php
					  for($i = 2000; $i < date("Y")+1; $i++){
						  echo '<option value="'.$i.'">'.$i.'</option>';
					  }
				  ?>
			</select>
			<input type="submit" name='submit_image4' class="btn btn-lg btn-primary" value="Upload">
		</div>
	</form>
	<div class="row artworks">
		<?php
			if (!empty($_SESSION['artwork5'])) {
				echo "<span class='art_w_img'> <label>Artwork 5</label><img src='" . $_SESSION['artwork5'] . "' alt='' width='80' height='80' /></span>";
			}
			if (!empty($_SESSION['medium5'])) {
				echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium5']."</p></span>";
			}
			if (!empty($_SESSION['width5'])) {
				echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width5'] . " inches</p></span>";
			}
			if (!empty($_SESSION['height5'])) {
				echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height5'] . " inches</p></span>";
			}
			if (!empty($_SESSION['depth5'])) {
				echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth5'] . " inches</p></span>";
			}
			if (!empty($_SESSION['year5'])) {
				echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year5']."</p></span>";
				echo "<div class='delete' id='delete5'>Delete</div>";
			}
		?>
    </div>
	<form enctype="multipart/form-data" id="multi_image5" action ="" novalidate name="multi_image5" method='POST'>
		<div class="artwork artwork-5st">
			<div class="file_div">
			 <label>Artwork 5</label>
			  <input type="file" name="file5" required>
			</div>
			<div class="select-form">
				<label>Medium</label>
				<select class="medium5" name="medium5">
					<?php
						/* $terms = get_terms("pa_medium");
						foreach ($terms as $term) {
							echo "<option>" . $term->name . "</option>";
						} */
						$args = array(
							'number'     => $number,
							'orderby'    => $orderby,
							'order'      => $order,
							'hide_empty' => $hide_empty,
							'include'    => $ids,
							'parent'     => 102,
							'orderby'    => 'name',
							'order'      => 'ASC'
						);
						$product_categories = get_terms( 'product_cat', $args );
						echo "<option>Please Select</option>";
						foreach( $product_categories as $cat ) {
							echo "<option>" . $cat->name. "</option>";  
						}
					?>
				</select>
			</div>
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="width5" placeholder="width" class="width5" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="height5" placeholder="Height" class="height5" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="depth5" placeholder="depth" class="depth5" />
			<!--input type="text" name="year5" placeholder="year" class="year5" /-->
			<div class="file_div">
				<label>Year</label>
			</div>
			<select id="year5" name="year5" class="year1">
			  <?php
			  for($i = 2000; $i < date("Y")+1; $i++){
				  echo '<option value="'.$i.'">'.$i.'</option>';
			  }
			  ?>
			</select>
			<input type="submit" name='submit_image5' class="btn btn-lg btn-primary" value="Upload">
		</div>
	</form>	
	<div class="row artworks">
		<?php
			/* echo "<pre>";
			print_r($_SESSION); */
			if (!empty($_SESSION['artwork6'])) {
				echo "<span class='art_w_img'> <label>Artwork 6</label><img src='" . $_SESSION['artwork6'] . "' alt='' width='80' height='80' /></span>";
			}
			if (!empty($_SESSION['medium6'])) {
				echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium6']."</p></span>";
			}
			if (!empty($_SESSION['width6'])) {
				echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width6'] . " inches</p></span>";
			}
			if (!empty($_SESSION['height6'])) {
				echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height6'] . " inches</p></span>";
			}
			if (!empty($_SESSION['depth6'])) {
				echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth6'] . " inches</p></span>";
			}
			if (!empty($_SESSION['year6'])) {
				echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year6']."</p></span>";
				echo "<div class='delete' id='delete6'>Delete</div>";
			}
		?>
    </div>
	<form enctype="multipart/form-data" id="multi_image6" action ="" novalidate name="multi_image6" method='POST'>
		<div class="artwork artwork-6st">
			<div class="file_div">
				<label>Artwork 6</label>
				<input type="file" name="file6">
			</div>
			<div class="select-form">
				<label>Medium</label>
				<select class="medium6" name="medium6">
					<?php
						/* $terms = get_terms("pa_medium");
						foreach ($terms as $term) {
							echo "<option>" . $term->name . "</option>";
						} */
						$args = array(
							'number'     => $number,
							'orderby'    => $orderby,
							'order'      => $order,
							'hide_empty' => $hide_empty,
							'include'    => $ids,
							'parent'     => 102,
							'orderby'    => 'name',
							'order'      => 'ASC'
						);

						$product_categories = get_terms( 'product_cat', $args );

						echo "<option>Please Select</option>";
						foreach( $product_categories as $cat ) {
							echo "<option>" . $cat->name. "</option>";
						}
					?>
				</select>
			</div>
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="width6" placeholder="width" class="width6" />
			<div class="file_div">
				<label>(In Inches)</label>
			</div>
			<input type="text" name="height6" placeholder="Height" class="height6" />
			<div class="file_div">
			   <label>(In Inches)</label>
			</div>
			<input type="text" name="depth6" placeholder="depth" class="depth6" />
			<!--input type="text" name="year6" placeholder="year" class="year6" /-->
			<div class="file_div">
			 <label>Year</label>
			</div>
			<select id="year6" name="year6" class="year1">
			  <?php
			  for($i = 2000; $i < date("Y")+1; $i++){
				  echo '<option value="'.$i.'">'.$i.'</option>';
			  }
			  ?>
			</select>
			<input type="submit" name='submit_image6' class="btn btn-lg btn-primary" value="Upload">
		</div>
	</form>
	<div class="row artworks">
		<?php
			/* echo "<pre>";
			print_r($_SESSION); */
			if (!empty($_SESSION['artwork7'])) {
				echo "<span class='art_w_img'> <label>Artwork 7</label><img src='" . $_SESSION['artwork7'] . "' alt='' width='80' height='80' /></span>";
			}
			if (!empty($_SESSION['medium7'])) {
				echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium7']."</p></span>";
			}
			if (!empty($_SESSION['width7'])) {
				echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width7'] . " inches</p></span>";
			}
			if (!empty($_SESSION['height7'])) {
				echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height7'] . " inches</p></span>";
			}
			if (!empty($_SESSION['depth7'])) {
				echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth7'] . " inches</p></span>";
			}
			if (!empty($_SESSION['year7'])) {
				echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year7']."</p></span>";
				echo "<div class='delete' id='delete7'>Delete</div>";
			}
			?>
    	</div>
		<form enctype="multipart/form-data" id="multi_image7" action ="" novalidate name="multi_image7" method='POST'>
			<div class="artwork artwork-7st">
				<div class="file_div">
					<label>Artwork 7</label>
					<input type="file" name="file7">
				</div>
				<div class="select-form">
					<label>Medium</label>
					<select class="medium7" name="medium7">
							<?php
						/* $terms = get_terms("pa_medium");
						foreach ($terms as $term) {
							echo "<option>" . $term->name . "</option>";
						} */
						$args = array(
							'number'     => $number,
							'orderby'    => $orderby,
							'order'      => $order,
							'hide_empty' => $hide_empty,
							'include'    => $ids,
							'parent'     => 102,
							'orderby'    => 'name',
							'order'      => 'ASC'
						);

						$product_categories = get_terms( 'product_cat', $args );
						echo "<option>Please Select</option>";
						foreach( $product_categories as $cat ) {
							echo "<option>" . $cat->name. "</option>";
						}
						?>
					</select>
				</div>
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="width7" placeholder="width" class="width7" />
				<div class="file_div">
				 <label>(In Inches)</label>
				</div>
				<input type="text" name="height7" placeholder="Height" class="height7" />
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="depth7" placeholder="depth" class="depth7" />
				<!--input type="text" name="year7" placeholder="year" class="year7" /-->
				<div class="file_div">
					<label>Year</label>
				</div>
				<select id="year7" name="year7" class="year1">
					  <?php
					  for($i = 2000; $i < date("Y")+1; $i++){
						  echo '<option value="'.$i.'">'.$i.'</option>';
					  }
					  ?>
				</select>
				<input type="submit" name='submit_image7' class="btn btn-lg btn-primary" value="Upload">
			</div>
		</form>	
		<div class="row artworks">
			<?php
				/* echo "<pre>";
				print_r($_SESSION); */
				if (!empty($_SESSION['artwork8'])) {
					echo "<span class='art_w_img'> <label>Artwork 8</label><img src='" . $_SESSION['artwork8'] . "' alt='' width='80' height='80' /></span>";
				}
				if (!empty($_SESSION['medium8'])) {
					echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium8']."</p></span>";
				}
				if (!empty($_SESSION['width8'])) {
					echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width8'] . " inches</p></span>";
				}
				if (!empty($_SESSION['height8'])) {
					echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height8'] . " inches</p></span>";
				}
				if (!empty($_SESSION['depth8'])) {
					echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth8'] . " inches</p></span>";
				}
				if (!empty($_SESSION['year8'])) {
					echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year8']."</p></span>";
					echo "<div class='delete' id='delete8'>Delete</div>";
				}
			?>
    	</div>
		<form enctype="multipart/form-data" id="multi_image8" action ="" novalidate name="multi_image8" method='POST'>
			<div class="artwork artwork-8st">
				<div class="file_div">
					<label>Artwork 8</label>
					<input type="file" name="file8">
				</div>
				<div class="select-form">
					<label>Medium</label>
					<select class="medium8" name="medium8">
						<?php
							/* $terms = get_terms("pa_medium");
							foreach ($terms as $term) {
								echo "<option>" . $term->name . "</option>";
							} */
							$args = array(
								'number'     => $number,
								'orderby'    => $orderby,
								'order'      => $order,
								'hide_empty' => $hide_empty,
								'include'    => $ids,
								'parent'     => 102,
								'orderby'    => 'name',
								'order'      => 'ASC'
							);
							$product_categories = get_terms( 'product_cat', $args );
							echo "<option>Please Select</option>";
							foreach( $product_categories as $cat ) {
								echo "<option>" . $cat->name. "</option>";
							}
						?>
					</select>
				</div>
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="width8" placeholder="width" class="width8" />
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="height8" placeholder="Height" class="height8" />
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="depth8" placeholder="depth" class="depth8" />
				<div class="file_div">
					<label>Year</label>
				</div>
				<!--input type="text" name="year8" placeholder="year" class="year8" /-->
				<select id="year8" name="year8" class="year1">
				  <?php
				  for($i = 2000; $i < date("Y")+1; $i++){
					  echo '<option value="'.$i.'">'.$i.'</option>';
				  }
				  ?>
				</select>
				<input type="submit" name='submit_image8' class="btn btn-lg btn-primary" value="Upload">
			</div>
		</form>	
		<div class="row artworks">
			<?php
				if (!empty($_SESSION['artwork9'])) {
					echo "<span class='art_w_img'> <label>Artwork 9</label><img src='" . $_SESSION['artwork9'] . "' alt='' width='80' height='80' /></span>";
				}
				if (!empty($_SESSION['medium9'])) {
					echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium9']."</p></span>";
				}
				if (!empty($_SESSION['width9'])) {
					echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width9'] . " inches</p></span>";
				}
				if (!empty($_SESSION['height9'])) {
					echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height9'] . " inches</p></span>";
				}
				if (!empty($_SESSION['depth9'])) {
					echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth9'] . " inches</p></span>";
				}
				if (!empty($_SESSION['year9'])) {
					echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year9']."</p></span>";
					echo "<div class='delete' id='delete9'>Delete</div>";
				}
				?>
    	</div>
		<form enctype="multipart/form-data" id="multi_image9" action ="" novalidate name="multi_image9" method='POST'>
			<div class="artwork artwork-9st">
				<div class="file_div">
					<label>Artwork 9</label>
					<input type="file" name="file9">
				</div>
				<div class="select-form">
					<label>Medium</label>
					<select class="medium9" name="medium9">
						<?php
							/* $terms = get_terms("pa_medium");
							foreach ($terms as $term) {
								echo "<option>" . $term->name . "</option>";
							} */
							$args = array(
								'number'     => $number,
								'orderby'    => $orderby,
								'order'      => $order,
								'hide_empty' => $hide_empty,
								'include'    => $ids,
								'parent'     => 102,
								'orderby'    => 'name',
								'order'      => 'ASC'
							);

							$product_categories = get_terms( 'product_cat', $args );
							echo "<option>Please Select</option>";
							foreach( $product_categories as $cat ) {
								echo "<option>" . $cat->name. "</option>";			
							}
						?>
					</select>
				</div>
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="width9" placeholder="width" class="width9" />
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="height9" placeholder="Height" class="height9" />
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="depth9" placeholder="depth" class="depth9" />
				<!--input type="text" name="year9" placeholder="year" class="year9" /-->
				<div class="file_div">
					<label>Year</label>
				</div>
				<select id="year9" name="year9" class="year1">
				  <?php
				  for($i = 2000; $i < date("Y")+1; $i++){
					  echo '<option value="'.$i.'">'.$i.'</option>';
				  }
				  ?>
				</select>
				<input type="submit" name='submit_image9' class="btn btn-lg btn-primary" value="Upload">
			</div>
		</form>
		<div class="row artworks">
			<?php
					if (!empty($_SESSION['artwork10'])) {
						echo "<span class='art_w_img'> <label>Artwork 10</label><img src='" . $_SESSION['artwork10'] . "' alt='' width='80' height='80' /></span>";
					}
					if (!empty($_SESSION['medium10'])) {
						echo "<span class='artw_medium'><label>medium: </label><p>" . $_SESSION['medium10']."</p></span>";
					}
					if (!empty($_SESSION['width10'])) {
						echo "<span class='art_width'><label>width: </label><p>" . $_SESSION['width10'] . " inches</p></span>";
					}
					if (!empty($_SESSION['height10'])) {
						echo "<span class='art_height'><label>height: </label><p>" . $_SESSION['height10'] . " inches</p></span>";
					}
					if (!empty($_SESSION['depth10'])) {
						echo "<span class='art_depth'><label>depth: </label><p>" . $_SESSION['depth10'] . " inches</p></span>";
					}
					if (!empty($_SESSION['year10'])) {
						echo "<span class='art_year'><label>Year: </label><p>" . $_SESSION['year10']."</p></span>";
						echo "<div class='delete' id='delete10'>Delete</div>";
					} 
			?>
    	</div>
		<form enctype="multipart/form-data" id="multi_image10" action ="" novalidate name="multi_image10" method='POST'>
			<div class="artwork artwork-10st">
				<div class="file_div">
					<label>Artwork 10</label>
					<input type="file" name="file10">
				</div>
				<div class="select-form">
					<label>Medium</label>
					<select class="medium10" name="medium10">
						<?php
							/* $parent_term_id = 102; // term id of parent term

							$taxonomies = array( 'category',
							);

							$args = array(
								'parent'         => $parent_term_id,
								// 'child_of'      => $parent_term_id, 
							); 

							$terms = get_the_terms($taxonomies, $args);
							echo "<prE>";
							print_r($terms);
							foreach ($categories as $term) {
								echo "<option>" . $term->name . "</option>";
							} */
							$args = array(
								'number'     => $number,
								'orderby'    => $orderby,
								'order'      => $order,
								'hide_empty' => $hide_empty,
								'include'    => $ids,
								'parent'     => 102,
								'orderby'    => 'name',
								'order'      => 'ASC'
							);

							$product_categories = get_terms( 'product_cat', $args );

							echo "<option>Please Select</option>";
							foreach( $product_categories as $cat ) {
								echo "<option>" . $cat->name. "</option>";
							}
						?>
					</select>
				</div>
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="width10" placeholder="width" class="width10" />
				<div class="file_div">
					<label>(In Inches)</label>
				</div>
				<input type="text" name="height10" placeholder="Height" class="height10" />
				<div class="file_div">
				<label>(In Inches)</label>
				</div>
				<input type="text" name="depth10" placeholder="depth" class="depth10" />
				<!--input type="text" name="year10" placeholder="year" class="year10" /-->
				<div class="file_div">
					<label>Year</label>
				</div>
				<select id="year2" name="year2" class="year1">
					<?php
					  for($i = 2000; $i < date("Y")+1; $i++){
						  echo '<option value="'.$i.'">'.$i.'</option>';
					  }
					?>
				</select>
				<input type="submit" name='submit_image10' class="btn btn-lg btn-primary" value="Upload">
			</div>
			<div class="artwork artwork-11st">
				<input type="checkbox" name="checkbox"  value="check" id="agree" /> I have read and agree to the <a href="/privacy-policy" target="_blank">Terms and Conditions and Privacy Policy</a>
			</div>
		</form>	
		<form action="<?php $_SERVER['PHP_SELF']; ?>?step__4" method="POST" name="whole_data" id="whole_data">
		
		<input type="submit" name="submit_data" class="submit_data_term" value="Submit data" id="submit_data" disabled/>
		</form>
	</div>	

	<div class="step__4" style="display:none;">
		<h3 class="sub__title"><span>Page 4 of 4:</span> Payment Information</br></h3>
		<form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="5EZWXAMH4ZZSU">
			<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_cart_LG.gif" class="pay_pal_image" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		<!--form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="VVEFL7266UTJU">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form-->
	</div>
</div>
</div>
</main>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

  jQuery(document).ready(function($) {
         $("#datepicker").datepicker();
    });
</script>


<?php
get_footer();
?>
