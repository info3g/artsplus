<?php 
include('/home/artsplus/public_html/wp-load.php');


$country = $_GET['country'];

global $wpdb;
if(isset($country)){
	$querystr = "SELECT * from wp_states WHERE country_id = '".$country."'";
	$results = $wpdb->get_results($querystr, OBJECT);
	   foreach($results as $row)
	   {
		  echo "<option value=".$row->id.">".$row->name."</option>";
	  }
	
}


   
?>