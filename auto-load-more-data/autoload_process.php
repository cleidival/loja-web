<?php
include("config.php"); //include config file

if($_POST)
{
	//sanitize post value
	$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	
	//throw HTTP error if group number is not valid
	if(!is_numeric($group_number)){
		header('HTTP/1.1 500 Invalid number!');
		exit();
	}
	
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	
	
	//Limit our results within a specified range. 
	$results = $mysqli->prepare("SELECT id, name, message FROM paginate ORDER BY id ASC LIMIT $position, $items_per_group");
	$results->execute(); //Execute prepared Query
	$results->bind_result($id, $name, $message); //bind variables to prepared statement


	echo '<ul class="page_result">';
	while($results->fetch()){ //fetch values
		echo '<li id="item_'.$id.'"><span class="page_name">'.$id.') '.$name.'</span><span class="page_message">'.$message.'</span></li>';	
	}
	echo '</ul>';

	$mysqli->close();
}
?>