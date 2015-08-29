<?php
	$id = $_GET['id'];
	$conn = mysqli_connect("localhost","root","root","boarding");
	if (mysqli_connect_errno()){
  		echo "Failed to connect to Database: " . mysqli_connect_error();
  	}
  	mysqli_query($conn, "DELETE FROM whiteboard WHERE id='$id'");
  	mysqli_close($conn);
  	header('Location: index.php');
?>