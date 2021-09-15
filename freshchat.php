<?php
	include_once 'includes/dbh.inc.php';

	$sqlFreshChat = "DELETE FROM chat;";

	if(mysqli_query($conn, $sqlFreshChat)){
      		
	#	echo '<script> alert("Success")</script>';
	}else{
		echo '<script>alert("Error")</script>';
		echo mysqli_error($conn);
	}
