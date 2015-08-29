<html>
	<body>
		<h1>Diocesan Boys' School Boarding School</h1>
		<h2>Admin Page</h2>
		<form method="POST" action="post.php">
			<input type="text" size="120" name="title" placeholder="Title" />
			<br /><br />
			<textarea cols="80" rows="10" name="desc" placeholder="Content"></textarea>
			<br /><br />
			<input type="submit" />
		</form>
		<table border="1">
			<tr>
				<th>id</th>
				<th>title</th>
				<th>content</th>
				<th>date & time</th>
				<th>Delete</th>
			</tr>
		<?php
			$conn = mysqli_connect("localhost","root","root","boarding");
			if (mysqli_connect_errno()){
  				echo "Failed to connect to Database: " . mysqli_connect_error();
  			}
  			$result = mysqli_query($conn,"SELECT * FROM whiteboard ORDER BY `whiteboard`.`id` DESC ");
			while($row = mysqli_fetch_array($result)){
  				echo '<tr>';
  				echo '<td>'.$row['id'].'</td>';
  				echo '<td>'.$row['title'].'</td>';
  				echo '<td>'.$row['descr'].'</td>';
  				echo '<td>'.$row['timestamp'].'</td>';
  				echo '<td><a href="del.php?id='.$row['id'].'">Delete</a></td>';
  				echo '</tr>';
  			}
  			mysqli_close($conn);
		?>
		</table>
		<br /><br /><br />
		<hr />
		<i>Version 1.0.0 (08/01/2014)</i>
		<br /><br />
	</body>
</html>