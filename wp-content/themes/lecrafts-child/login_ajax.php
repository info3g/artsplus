<?php 
include('/home/artsplus/public_html/wp-load.php');

session_start();
$username = $_GET['userName'];
$pass = $_GET['pass'];

global $wpdb;
if(isset($username) && isset($pass)){
	$creds = array();
    $creds['user_login'] = $username;
    $creds['user_password'] = $pass;
	$creds['remember'] = true;
	
     $user = wp_signon( $creds, false );
	 if ( is_wp_error($user) ){
			echo $user->get_error_message();
		}
		else{
			$user_id =$user->ID;
			$enable_seller = get_user_meta($user_id, 'dokan_enable_selling', true); 
			if($user->roles[0] == 'seller' && $enable_seller=='yes'){
				echo "Login Successfully.";
				echo"<script>window.location.assign('/dashboard/')</script>";
			}
			if($user->roles[0] == 'seller' && $enable_seller=='no'){
				echo "Please Wait for Approval. You can't Login";
				wp_logout();
			}
			if($user->roles[0] == 'customer'){
				echo "Login Successfully.";
				echo"<script>window.location.assign('/my-account/')</script>";
			}
			
		} 
}
$fistname =$_GET['fistname'];
$lastname =$_GET['lastname'];
$email =$_GET['email'];
$pass =$_GET['pass'];

if(isset($fistname) && isset($lastname) && isset($email)&& isset($pass)){
	$querystr = "SELECT * from wp_users WHERE user_email = '".$email."'";
	$results = $wpdb->get_results($querystr, OBJECT);
	$count =0;
	foreach($results as $row)
	{
		  $count =$count+1;
	}
	if($count == 0){
		 $userdata = array(
			'first_name' => $fistname,
			'role' => 'customer',
			'last_name' => $lastname,
			'display_name' => $fistname,
			'user_email' => $email,
			'user_pass' => $pass,
			'user_login' => $fistname,
			'user_nicename' => $fistname,
		   
		);
		
		
		
		$user_id = wp_insert_user($userdata);
		
		
		
		global $wpdb;
		
		 $query="SELECT `user_login`, `user_pass` FROM `wp_users` WHERE  `ID` ='".$user_id."'";
		$wpdb->query($query);
        
		$cart_item_detail  =  $wpdb->last_result;
		
		
	    $username = $cart_item_detail[0]->user_login;
		
		$creds = array();
		$creds['user_login'] = $username;
		$creds['user_password'] = $pass;
		$creds['remember'] = true;

			$user = wp_signon( $creds, false );
			if ( is_wp_error($user) ){
				echo $user->get_error_message();
			}else{
				//wp_redirect('http://artsplus.com/my-account/');
				echo "<script>window.location.assign('/my-account/')</script>";
			}
				
		
		//echo "<script>window.location.assign('/my-account/')</script>";
		
	}
	else{
		echo "Email address already exists.";
	}
	//echo ($results->user_email);
	/* */
}
$country = $_GET['country'];
if(isset($country)){
	$querystr = "SELECT e_state from wp_schoolinfo WHERE e_country = '".$country."'";
	$results = $wpdb->get_results($querystr, OBJECT);
	$results  = $wpdb->get_results($querystr, OBJECT);
	foreach( $results as $key => $row) {
			$e_state[] = $row->e_state;
	}
	$state = array_unique($e_state);
	foreach ($state as $key => $val) {
			echo "<option>" . $val."</option>";
		}
} 


$state = $_GET['state'];
if(isset($state)){
	$querystr = "SELECT biz_name from wp_schoolinfo WHERE e_state = '".$state."'";
	$results = $wpdb->get_results($querystr, OBJECT);
	//$results = $wpdb->get_results($querystr, OBJECT);
	foreach( $results as $key => $row) {
			$e_school[] = $row->biz_name;
	}
	$school = array_unique($e_school);
	foreach ($school as $key => $val) {
			echo "<option>" . $val."</option>";
		}
}   

if(isset($_GET['delete1'])){
	unlink($_SESSION['artwork1']);
	 unset($_SESSION['type1']);
	unset($_SESSION['artname1']);
	unset($_SESSION['medium1']);
	unset($_SESSION['width1']);
	unset($_SESSION['height1']);
	unset($_SESSION['depth1']);
	unset($_SESSION['year1']); 
	unset($_SESSION['artwork1']);  
}
if(isset($_GET['delete2'])){
	unlink($_SESSION['artwork2']);
	 unset($_SESSION['type2']);
	unset($_SESSION['artname2']);
	unset($_SESSION['medium2']);
	unset($_SESSION['width2']);
	unset($_SESSION['height2']);
	unset($_SESSION['depth2']);
	unset($_SESSION['year2']); 
	unset($_SESSION['artwork2']);  
}
if(isset($_GET['delete3'])){
	unlink($_SESSION['artwork3']);
	 unset($_SESSION['type3']);
	unset($_SESSION['artname3']);
	unset($_SESSION['medium3']);
	unset($_SESSION['width3']);
	unset($_SESSION['height3']);
	unset($_SESSION['depth3']);
	unset($_SESSION['year3']); 
	unset($_SESSION['artwork3']);  
}
if(isset($_GET['delete4'])){
	unlink($_SESSION['artwork4']);
	 unset($_SESSION['type4']);
	unset($_SESSION['artname4']);
	unset($_SESSION['medium4']);
	unset($_SESSION['width4']);
	unset($_SESSION['height4']);
	unset($_SESSION['depth4']);
	unset($_SESSION['year4']); 
	unset($_SESSION['artwork4']);  
}
if(isset($_GET['delete5'])){
	unlink($_SESSION['artwork5']);
	 unset($_SESSION['type5']);
	unset($_SESSION['artname5']);
	unset($_SESSION['medium5']);
	unset($_SESSION['width5']);
	unset($_SESSION['height5']);
	unset($_SESSION['depth5']);
	unset($_SESSION['year5']); 
	unset($_SESSION['artwork5']);  
}
if(isset($_GET['delete6'])){
	unlink($_SESSION['artwork6']);
	 unset($_SESSION['type6']);
	unset($_SESSION['artname6']);
	unset($_SESSION['medium6']);
	unset($_SESSION['width6']);
	unset($_SESSION['height6']);
	unset($_SESSION['depth6']);
	unset($_SESSION['year6']); 
	unset($_SESSION['artwork6']);  
}
if(isset($_GET['delete7'])){
	unlink($_SESSION['artwork7']);
	 unset($_SESSION['type7']);
	unset($_SESSION['artname7']);
	unset($_SESSION['medium7']);
	unset($_SESSION['width7']);
	unset($_SESSION['height7']);
	unset($_SESSION['depth7']);
	unset($_SESSION['year7']); 
	unset($_SESSION['artwork7']);  
}
if(isset($_GET['delete8'])){
	unlink($_SESSION['artwork8']);
	 unset($_SESSION['type8']);
	unset($_SESSION['artname8']);
	unset($_SESSION['medium8']);
	unset($_SESSION['width8']);
	unset($_SESSION['height8']);
	unset($_SESSION['depth8']);
	unset($_SESSION['year8']); 
	unset($_SESSION['artwork8']);  
}
if(isset($_GET['delete9'])){
	unlink($_SESSION['artwork9']);
	 unset($_SESSION['type9']);
	unset($_SESSION['artname9']);
	unset($_SESSION['medium9']);
	unset($_SESSION['width9']);
	unset($_SESSION['height9']);
	unset($_SESSION['depth9']);
	unset($_SESSION['year9']); 
	unset($_SESSION['artwork9']);  
}
if(isset($_GET['delete10'])){
	unlink($_SESSION['artwork10']);
	 unset($_SESSION['type10']);
	unset($_SESSION['artname10']);
	unset($_SESSION['medium10']);
	unset($_SESSION['width10']);
	unset($_SESSION['height10']);
	unset($_SESSION['depth10']);
	unset($_SESSION['year10']); 
	unset($_SESSION['artwork10']);  
}



/* apply to exibit first form */
if( isset( $_POST['urls'] ) == 'validation' )
{
	
	if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['country']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip_code']) && isset($_POST['phone']) && isset($_POST['dob']) && isset($_POST['hear']) && isset($_POST['email']) && isset($_POST['pass']))
	{
 
		$results = $wpdb->get_results( "SELECT user_email from wp_users where user_email= '".$_POST['email']."'" );
		$count = $wpdb->num_rows;
		
		if( $count ==0 )
		{
			//echo $count;
			$_SESSION['fname']    = $_POST["fname"];
			$_SESSION['lname']    = $_POST["lname"];
			$_SESSION['email']    = $_POST["email"];
			$_SESSION['pass']     = $_POST["pass"];
			$_SESSION['country']  = $_POST["country"];
			$_SESSION['address']  = $_POST["address"] ;
			$_SESSION['address1']  = $_POST["address1"] ;
			$_SESSION['city']     = $_POST["city"];
			$_SESSION['state']    = $_POST["state"];
			$_SESSION['zip_code'] = $_POST["zip_code"];
			$_SESSION['phone']    = $_POST["phone"];
			$_SESSION['dob']      = $_POST["dob"];
			$_SESSION['hear']     = $_POST["hear"];
		}
		else{
			echo "error";
		} 	
	} 
 }
 
 
?>

