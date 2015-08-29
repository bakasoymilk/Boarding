<?php
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$conn = mysqli_connect("localhost","root","root","boarding");
	if (mysqli_connect_errno()){
  		echo "Failed to connect to Database: " . mysqli_connect_error();
  	}
  	mysqli_query($conn, "INSERT INTO whiteboard (title, descr) VALUES ('$title', '$desc')");
  	mysqli_close($conn);
  	header('Location: index.php');
?>