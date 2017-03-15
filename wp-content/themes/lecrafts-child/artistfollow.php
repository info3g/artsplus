<?php 
include('/home/artsplus/public_html/wp-load.php');
global $wpdb;
if(isset($_POST['artistid'])){
	if(is_user_logged_in()){
		$artistid= $_POST['artistid'];
		$user_id= get_current_user_id();
		$date = date('m/d/Y');
		$wpdb->insert( 
			'wp_followingartist', 
			array( 
				'user_id' => $user_id, 
				'following_date' => date('Y-m-d', strtotime($date)),
				'artist_Ids'=>$artistid
			), 
			array( 
				'%d', 
				'%s', 
				'%d' 
			) 
		); 
	}
	else{
		echo 'login';
	}
}
if(isset($_POST['dartistid'])){
	$artistid= $_POST['dartistid'];
	$user_id= get_current_user_id();
	$wpdb->delete( 
		'wp_followingartist', 
		array( 
			'user_id' => $user_id, 
			'artist_Ids'=>$artistid
		), 
		array( 
			'%d',
			'%d' 
		) 
	); 
	echo 'delete successful';
}
?>